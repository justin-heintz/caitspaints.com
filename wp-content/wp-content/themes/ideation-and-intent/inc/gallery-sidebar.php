<?php
/**
 * Gallery Sidebar.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */

class Ideation_Gallery_Sidebar {

	/**
	 * Galleries.
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static $galleries = null;

	/**
	 * Set defaults and Hook into WordPress.
	 *
	 * @uses Ideation_Gallery_Sidebar::$galleries
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static function init() {
		self::$galleries = array();
		add_action( 'template_redirect', array( __class__, 'setup_galleries'  ), 11    );
		add_filter( 'posts_where',       array( __class__, 'post_parent__in'  ), 10, 2 );
		add_action( 'switch_theme',      array( __class__, 'flush' ), 10, 2 );

		add_action( 'add_attachment',  array( __class__, 'regenerate_on_attachment_change' ) );
		add_action( 'edit_attachment', array( __class__, 'regenerate_on_attachment_change' ) );
		add_action( 'deleted_post',    array( __class__, 'regenerate_on_attachment_change' ) );

		add_action( 'transition_post_status', array( __class__, 'transition_post_status' ), 10, 3 );
		add_action( 'load-upload.php',        array( __class__, 'add_wp_redirect_filter' ) );
	}

	public static function get( $refresh = false ) {
		$transient = get_transient( 'ideation-gallery' );
		if ( $transient && ! $refresh )
			return $transient;

		$result = array();

		$args = array(
			'meta_key'    => '_ideation_attached_images',
			'numberposts' => 10,
		);

		$post_with_images = get_posts( $args );

		if ( ! $post_with_images ) {
			self::fill_meta();
			$post_with_images = get_posts( $args );
		}

		if ( ! $post_with_images )
			return $result;

		$IDs = wp_list_pluck( $post_with_images, 'ID' );
		foreach ( $IDs as $ID ) {
			$meta = get_post_meta( $ID, '_ideation_attached_images' );
			$result[$ID] = (array) $meta;
		}

		set_transient( 'ideation-gallery', $result );

		return $result;
	}


	/**
	 * Prime caches when post status changes.
	 *
	 * 1. Maybe prime postmeta cache for the post.
	 * 2. Regenerate the transient.
	 *
	 * Hooked into the 'transition_post_status' action.
	 *
	 * @uses Ideation_Gallery_Sidebar::get()
	 */
	function transition_post_status( $new_status, $old_status, $post ) {
		if ( isset( $post->post_type ) && 'revision' == $post->post_type )
			return;

		if ( isset( $post->ID ) )
			self::maybe_set_meta_for_post( $post->ID );

		self::get( 'refresh' );
	}

	/**
	 * Sets '_ideation_attached_images' for a given post if no values currently exist.
	 *
	 * @param int Post ID.
	 */
	private static function maybe_set_meta_for_post( $ID ) {
		$meta = get_post_meta( $ID, '_ideation_attached_images' );

		// Bail if post already has meta.
		if ( ! empty( $meta ) )
			return;

		$images = get_children( array(
			'post_parent'    => $ID,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// No need to continue if there are no attached images.
		if ( empty( $images ) )
			return;

		foreach ( $images as $image_id => $image ) {
			self::add_meta( $ID, $image_id );
		}
	}

	/**
	 * Hooks Ideation_Gallery_Sidebar::wp_redirect() to the 'wp_redirect' filter.
	 */
	function add_wp_redirect_filter() {
		add_filter( 'wp_redirect', array( __class__, 'wp_redirect' ) );
	}

	/**
	 * Update post meta when user attaches an image to a post via wp-admin/update.php
	 *
	 * There did not appear to be a better way to hook into update.php
	 * to regerate the option. The 'wp_redirect' filter was the only place
	 * to hook this functionality. While this process "works" it is not an
	 * example of a best practice. Please see the following core ticket for
	 * more information:
	 *
	 * @uses Ideation_Gallery_Sidebar::get()
	 */
	function wp_redirect( $location ) {
		if ( false === strpos( $location, 'wp-admin/upload.php?attached=1' ) )
			return $location;
		if ( ! isset( $_REQUEST['found_post_id'] ) )
			return $location;
		if ( ! isset( $_REQUEST['media'] ) )
			return $location;

		$parent_id = (int) $_REQUEST['found_post_id'];
		if ( ! $parent_id )
			return $location;

		if ( ! current_user_can( 'edit_post', $parent_id ) )
			return $location;

		$image_ids = array();
		foreach ( (array) $_REQUEST['media'] as $id ) {
			$id = (int) $id;

			if ( ! current_user_can( 'edit_post', $id ) )
				continue;

			$image_ids[] = $id;
		}

		if ( ! empty( $image_ids ) ) {
			foreach ( (array) $image_ids as $ID ) {
				self::add_meta( $parent_id, $ID );
			}
			self::get( 'refresh' );
			return $location;
		}

		return $location;
	}

	/**
	 * @uses Ideation_Gallery_Sidebar::get()
	 */
	function regenerate_on_attachment_change( $attachment_ID ) {
		$image = get_post( $attachment_ID );

		// We only really care about images.
		if ( false === strpos( $image->post_mime_type, 'image' ) )
			return;

		// The image must be attached to a post.
		if ( 0 == $image->post_parent )
			return;

		if ( 'deleted_post' == current_filter() )
			delete_post_meta( $image->post_parent, '_ideation_attached_images', $attachment_ID );
		else
			self::add_meta( $image->post_parent, $attachment_ID );

		self::get( 'refresh' );
	}

	/**
	 * Template tag-style function.
	 *
	 * @uses Ideation_Gallery_Sidebar::$galleries
	 *
	 * @return bool True if galleries exist, false otherwise.
	 * @since Ideation and Intent 1.0
	 */
	public static function has_galleries() {
		if ( empty( self::$galleries ) )
			return false;
		return true;
	}

	/**
	 * Adds ability to include or exclude specific post_parent ID's
	 *
	 * @global WPDB $wpdb
	 * @global WP $wp
	 * @param string $where
	 * @param WP_Query $object
	 * @return string
	 * @since Ideation and Intent 1.0
	 */
	public function post_parent__in( $where, $object = '' ) {
		global $wpdb, $wp;

		// Noop if WP core supports this already
		if ( in_array( 'post_parent__in', $wp->private_query_vars ) )
			return $where;

		// Bail if no object passed
		if ( empty( $object ) )
			return $where;

		// Only 1 post_parent so return $where
		if ( is_numeric( $object->query_vars['post_parent'] ) )
			return $where;

		// Including specific post_parent's
		if ( isset( $object->query_vars['post_parent__in'] ) ) {
			$ids    = implode( ',', array_map( 'absint', $object->query_vars['post_parent__in'] ) );
			$where .= " AND {$wpdb->posts}.post_parent IN ({$ids})";

		// Excluding specific post_parent's
		} elseif ( isset( $object->query_vars['post_parent__not_in'] ) ) {
			$ids    = implode( ',', array_map( 'absint', $object->query_vars['post_parent__not_in'] ) );
			$where .= " AND {$wpdb->posts}.post_parent NOT IN ({$ids})";
		}

		// Return possibly modified $where
		return $where;
	}

	/**
	 * Return the most recent image attachments grouped by parent.
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static function fill_meta() {
		$query = new WP_Query( array(
			'post_type'              => 'attachment',
			'post_parent__not_in'    => array( '0' ),
			'post_mime_type'         => array( 'image/gif', 'image/png', 'image/jpeg' ),
			'post_status'            => 'inherit',
			'orderby'                => 'date',
			'posts_per_page'         => 100,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		) );

		// Bail if no posts
		if ( empty( $query ) )
			return array();

		$images = array();
		while ( $query->have_posts() ) {
			$query->the_post();
			$images[$query->post->post_parent][] = $query->post;
		}

		// Give users the ability to order the posts via the media upload modal.
		foreach ( (array) $images as $k => $image ) {
			self::pluck_sort( $images[$k], 'menu_order' );
			$image_IDs = wp_list_pluck( $images[$k], 'ID' );
			foreach ( $image_IDs as $image_ID ) {
				self::add_meta( $k, $image_ID );
			}
		}
	}

	public function add_meta( $post_ID, $value ) {
		$meta = get_post_meta( $post_ID, '_ideation_attached_images' );
		if ( ! in_array( $value, $meta ) )
			add_post_meta( $post_ID, '_ideation_attached_images', $value );
	}

	/**
	 * Remove post_meta during the "switch_theme" action.
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static function flush() {
		delete_transient( 'ideation-gallery' );
		delete_post_meta_by_key( '_ideation_attached_images' );
	}

	/**
	 * Trim images.
	 *
	 * The first post should be excluded on the first home page.
	 * The queried post should be excluded in the single template.
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static function trim_image( &$images ) {
		$remove = 0;

		if ( is_attachment() ) {
			return;
		} else if ( is_singular() ) {
			$remove = get_queried_object_ID();
		} else if ( is_home() && ! is_paged() ) {
			global $posts;
			if ( isset( $posts[0]->ID ) )
				$remove = absint( $posts[0]->ID );
		}

		if ( ! isset( $images[$remove] ) && 5 < count( $images ) )
			$remove = end( array_keys( $images ) );

		if ( ! empty( $remove ) )
			unset( $images[$remove] );
	}

	/**
	 * Setup the galleries.
	 *
	 * Takes raw data from Ideation_Gallery_Sidebar::get() and
	 * prepares it to be used in a template file.
	 *
	 * @uses Ideation_Gallery_Sidebar::get()
	 *
	 * @since Ideation and Intent 1.0
	 */
	public static function setup_galleries() {

		$image_post_ids = self::get();

		self::trim_image( $image_post_ids );

		if ( empty( $image_post_ids ) )
			return;

		foreach ( $image_post_ids as $parent_id => $images ) {
			$thumbs         = array();
			$thumbs['rows'] = array( $images );
			$thumbs['parent_id'] = $parent_id;

			switch ( count( $images ) ) {
				case 1 :
					$thumbs['class'] = array( 'one-image' );
					$thumbs['sizes'] = array( 'ideation-sidebar-single' );
					break;
				case 2 :
					$thumbs['class'] = array( 'two-images' );
					$thumbs['sizes'] = array( 'ideation-sidebar-double' );
					break;
				case 3 :
					$thumbs['class'] = array( 'three-images' );
					$thumbs['sizes'] = array( 'ideation-sidebar-triple' );
					break;
				case 4 :
					$thumbs['class'] = array( 'four-images' );
					$thumbs['sizes'] = array( 'ideation-thumbnail-square' );
					break;
				case 5 :
					$thumbs['class'] = array( 'two-images', 'three-images' );
					$thumbs['sizes'] = array( 'ideation-sidebar-double', 'ideation-sidebar-triple' );
					$thumbs['rows']  = array( array_slice( $images, 0, 2 ), array_slice( $images, 2, 3 ) );
					break;
				case 6 :
					$thumbs['class'] = array( 'three-images', 'three-images' );
					$thumbs['sizes'] = array( 'ideation-sidebar-triple', 'ideation-sidebar-triple' );
					$thumbs['rows']  = array( array_slice( $images, 0, 3 ), array_slice( $images, 3, 3 ) );
					break;
				case 7 :
					$thumbs['class'] = array( 'three-images', 'four-images' );
					$thumbs['sizes'] = array( 'ideation-sidebar-triple', 'ideation-thumbnail-square' );
					$thumbs['rows']  = array( array_slice( $images, 0, 3 ), array_slice( $images, 3, 4 ) );
					break;
				case 8 :
				default :
					$thumbs['class'] = array( 'four-images', 'four-images' );
					$thumbs['sizes'] = array( 'ideation-thumbnail-square', 'ideation-thumbnail-square' );
					$thumbs['rows']  = array( array_slice( $images, 0, 4 ), array_slice( $images, 4, 4 ) );
					break;
			}

			self::$galleries[] = $thumbs;
		}
	}

	/**
	 * Pluck Sort.
	 *
	 * @param array $list
	 * @param string $key A key to sort by.
	 */
	public static function pluck_sort( &$list, $key, $reverse = '' ) {
		$keys = wp_list_pluck( $list, $key );
		if ( 0 == array_sum( $keys ) )
			return;
		$list = array_combine( $keys, $list );
		ksort( $list );

		if ( ! empty( $reverse ) )
			$list = array_reverse( $list );
		$list = array_values( $list );
	}
}

Ideation_Gallery_Sidebar::init();
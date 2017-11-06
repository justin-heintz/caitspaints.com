<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */

if ( ! function_exists( 'ideation_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Ideation and Intent 1.0
 */
function ideation_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation entry-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation entry-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'ideation' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', __( 'Previous', 'ideation' ) ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', __( 'Next', 'ideation' ) ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'ideation' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'ideation' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // ideation_content_nav

if ( ! function_exists( 'ideation_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'everyday' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ideation' ), ' ' ); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 38 ); ?>
						<cite class="comment-author-name fn"><?php echo get_comment_author_link(); ?></cite>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'everyday' ); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<a class="comment-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'ideation' ), get_comment_date(), get_comment_time() ); ?>
						</time></a>
						<?php edit_comment_link( __( '(Edit)', 'ideation' ), ' ' ); ?>
						<?php comment_reply_link( array_merge( $args, array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
					</div><!-- .comment-meta .commentmetadata -->
				</footer>

				<div class="comment-content"><?php
					comment_text();
				?></div>

			</article><!-- #comment-## -->

		<?php
				break;
		endswitch;
}
endif; // ends check for ideation_comment()

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Ideation and Intent 1.0
 */
function ideation_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ideation_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so ideation_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in ideation_categorized_blog
 *
 * @since Ideation and Intent 1.0
 */
function ideation_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ideation_category_transient_flusher' );
add_action( 'save_post', 'ideation_category_transient_flusher' );

/**
 * Dynamic classes for the menu wrapper.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_menu_class( $classes ) {
	$classes = explode( ' ', $classes );
	$classes = array_map( 'trim', $classes );
	$header_image = get_header_image();
	if ( ! empty( $header_image ) )
		$classes[] = 'main-navigation-lone';

	$classes = array_map( 'esc_attr', $classes );
	print 'class="' . implode( ' ', $classes ) . '"';
}

/**
 * Get Background color for use in CSS.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_get_background_color() {
	$background_color = get_background_color();

	if ( empty( $background_color ) )
		$background_color = get_theme_support( 'custom-background', 'default-color' );

	if ( empty( $background_color ) )
		$background_color = 'transparent';
	else
		$background_color = '#' . $background_color;

	return $background_color;
}

/**
 * Return the featured image or the first attached image.
 *
 * @return string|bool HTML img tag if found; false if no image could be found.
 * @since Ideation and Intent 1.0
 */
function ideation_get_featured_image( $size = 'ideation-thumbnail-rectangle' ) {
	$featured_image = get_the_post_thumbnail( get_the_ID(), $size );

	if ( ! empty( $featured_image ) )
		return $featured_image;

	$images = get_children( array(
		'post_parent'    => get_the_ID(),
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	if ( is_array( $images ) )
		$images = array_values( $images );

	if ( isset( $images[0]->ID ) )
		return wp_get_attachment_image( $images[0]->ID, $size, false, array( 'class' => 'wp-post-image' ) );

	return false;
}
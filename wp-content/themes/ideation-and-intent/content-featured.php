<?php
/**
 * Display a full post with all meta information.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-featured' ); ?>>

	<?php the_title( '<h1 class="entry-title"><a href="' . esc_attr( get_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '" rel="bookmark">', '</a></h1>' ); ?>

	<?php
	$exclude_from_gallery = '';
	$featured_image = get_the_post_thumbnail();
	if ( ! empty( $featured_image ) ) {
		echo $featured_image;
		$exclude_from_gallery = 'exclude="' . absint( get_post_thumbnail_id() ) . '"';
	} else {
		$images = get_children( array(
			'post_parent'    => get_the_ID(),
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );
		$image = array_shift( $images );
		if ( isset( $image->ID ) ) {
			echo wp_get_attachment_image( $image->ID, 'post-thumbnail', false, array( 'class' => 'wp-post-image' ) );
			$exclude_from_gallery = 'exclude="' . absint( $image->ID ) . '"';
		}
	}
	?>

	<div class="entry-meta">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 108 ); ?>

		<?php printf( '<a class="entry-author" href="%1$s" title="%2$s">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'ideation' ), get_the_author() ) ),
			esc_html( sprintf( __( 'By %1$s', 'ideation' ), get_the_author() ) )
		); ?>

		<a class="permalink" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo esc_html( get_the_date() ); ?></time></a>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<?php comments_popup_link(
				__( 'Leave a Comment', 'ideation' ),
				__( '1 Comment',       'ideation' ),
				__( '% Comments',      'ideation' ),
				'entry-comment-link'
			); ?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'ideation' ) ); ?>
	</div><!-- .entry-author -->

	<div class="entry-content">

		<?php the_excerpt(); ?>

		<div class="featured-gallery"><?php
			echo do_shortcode( '[gallery
				columns="6"
				size="ideation-thumbnail-square"
				' . $exclude_from_gallery . '
			]' );
		?></div>

		<?php if ( ! is_singular() ) : ?>
			<a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php _e( 'Read more &raquo;', 'ideation' ); ?></a>
		<?php endif; ?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

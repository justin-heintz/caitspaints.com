<?php
/**
 * Display a shortned version of a post.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-short' ); ?>>

	<?php the_title( '<h1 class="entry-title"><a href="' . esc_attr( get_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '" rel="bookmark">', '</a></h1>' ); ?>

	<?php $featured_image = ideation_get_featured_image(); ?>
	<?php if ( ! empty( $featured_image ) ) : ?>
		<a class="permalink featured-image-permalink" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php echo $featured_image; ?></a>
	<?php endif; ?>

	<footer class="entry-meta">

		<a class="permalink" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo esc_html( get_the_date() ); ?></time></a>

		<?php the_tags( '<span class="tag-links">', ' ', '</span>' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<?php comments_popup_link(
				__( 'Leave a Comment', 'ideation' ),
				__( '1 Comment',       'ideation' ),
				__( '% Comments',      'ideation' ),
				'comment-icon'
			); ?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'ideation' ) ); ?>

	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
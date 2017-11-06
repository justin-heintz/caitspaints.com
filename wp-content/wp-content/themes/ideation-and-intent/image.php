<?php
/**
 * The template for displaying image attachments.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
get_header();
$content_width = 1092;
?>

		<div id="primary" class="site-content image-attachment">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						/**
						 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						 */
						$attachments = array_values( get_children( array(
							'post_parent' => $post->post_parent,
							'post_status' => 'inherit',
							'post_type' => 'attachment',
							'post_mime_type' => 'image',
							'order' => 'ASC',
							'orderby' => 'menu_order ID'
						) ) );

						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
						}
						$k++;
						// If there is more than 1 attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) )
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							else
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
						} else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
					?>

					<div class="queried-image"><?php
							$image_size = apply_filters( 'ideation_image_content_width', array( $content_width, $content_width ) );
							echo wp_get_attachment_image( $post->ID, $image_size );
					?></div><!-- .attachment -->

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="image-caption"><?php
							the_excerpt();
						?></div>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array(
							'before'      => '<div class="page-links">' . __( 'Pages:', 'ideation' ),
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template(); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar( 'image-meta' ); ?>
<?php get_footer(); ?>
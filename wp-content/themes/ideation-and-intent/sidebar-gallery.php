<?php
/**
 * The sidebar which showcases images attached to posts.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */

$galleries = Ideation_Gallery_Sidebar::$galleries;

if ( empty( $galleries ) )
	return;

?>

<div id="sidebar-gallery" class="sidebar sidebar-gallery" role="complementary">
	<h1 class="widget-title"><?php _e( 'Photos', 'ideation' ); ?></h1>

	<?php foreach( (array) $galleries as $key => $gallery ) : ?>

		<aside class="<?php echo esc_attr( 'ideation-gallery' ); ?>">

			<?php foreach ( (array) $gallery['rows'] as $row => $rows ) : ?>

				<div class="<?php echo esc_attr( 'ideation-gallery-row ' . $gallery['class'][$row] ); ?>">
				<?php foreach ( (array) $rows as $image_id ) : ?>

					<a href="<?php echo get_permalink( $gallery['parent_id'] );  ?>">
						<?php echo wp_get_attachment_image( $image_id, $gallery['sizes'][$row], true ); ?>
					</a>

				<?php endforeach; ?>

				</div>

			<?php endforeach; ?>

		</aside>

	<?php endforeach; ?>

</div><!-- #attached-images .sidebar -->

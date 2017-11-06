<?php
/**
 * Meta inforation for the image template.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>

<div id="sidebar-image-meta" class="sidebar sidebar-image-meta" role="complementary">

	<?php the_title( '<h1 class="image-title">', '</h1>' ); ?>

	<div class="image-meta">
		<span class="image-date"><?php
			printf( __( 'Published: %1$s', 'ideation' ), '<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time>' );
		?></span>

		<span class="image-size"><?php
			$metadata = wp_get_attachment_metadata();

			// translators: %1$s is the width of the image and %2$s is the height.
			$dimensions = sprintf( __( '%1$s &times; %2$s', 'ideation' ), absint( $metadata['width'] ), absint( $metadata['height'] ) );

			// translators: Appears in the tool tip when the link is hovered over.
			$title = __( 'Link to full-size image', 'ideation' );

			// translators: %1$s is a link to the full size image.
			printf( __( 'Full-size: %1$s', 'ideation' ), '<a href="' . esc_url( wp_get_attachment_url() ) . '" title="' . esc_attr( $title ) . '">' . esc_html( $dimensions ) . '</a>' );
		?></a>

		<?php edit_post_link( __( 'Edit', 'ideation' ), '<span class="edit-link">', '</span>' ); ?>
	</div>

	<?php
		$siblings = get_children( array(
			'post_parent'    => wp_get_post_parent_id( get_the_ID() ),
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'exclude'        => get_queried_object_id(),
		) );

		if ( $siblings )
			$siblings = array_chunk( (array) $siblings, 4, true );
	?>

	<?php if ( ! empty( $siblings ) ) : ?>
		<aside class="<?php echo esc_attr( 'ideation-gallery' ); ?>">
		<h1 class="widget-title"><?php echo __( 'Similar Images', 'ideation' ); ?></h1>
		<?php foreach ( (array) $siblings as $row => $images ) : ?>
			<div class="ideation-gallery-row four-images">
			<?php foreach ( (array) $images as $image ) : ?>
				<?php echo wp_get_attachment_link( $image->ID, 'ideation-thumbnail-square', true ); ?>
			<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
		</aside>
	<?php endif; ?>

</div><!-- #attached-images .sidebar -->

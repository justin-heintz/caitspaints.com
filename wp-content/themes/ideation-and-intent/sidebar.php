<?php
/**
 * The sidebar containing the widget area.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary .widget-area -->
	<?php endif; ?>

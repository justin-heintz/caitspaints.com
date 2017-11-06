<?php
/**
 * The Sidebar containing the after single post widget areas.
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

if ( is_active_sidebar( 'sidebar-7' ) ) : ?>

	<div id="sidebar-after-singular" class="widget-area" role="complementary">

		<?php dynamic_sidebar( 'sidebar-7' ); ?>

	</div><!-- #sidebar-after-singular -->

<?php endif; ?>
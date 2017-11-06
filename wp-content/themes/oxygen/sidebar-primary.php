<?php
/**
 * The Sidebar containing the primary widget areas.
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>
<div id="secondary" class="clear-fix" role="complementary">

<?php if ( has_nav_menu( 'secondary' ) ) : ?>

	<nav role="navigation" class="site-navigation menu-secondary">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</nav><!-- .menu-secondary -->

<?php endif; ?>

	<div class="widget-area" role="complementary">

	<?php do_action( 'before_sidebar' ); ?>

	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<aside id="categories" class="widget widget_categories">
			<h1 class="widgettitle"><?php _e( 'Categories', 'oxygen' ); ?></h1>
			<ul>
				<?php wp_list_categories( array( 'title_li' => '' ) ); ?>
			</ul>
		</aside>

		<aside id="archives" class="widget widget_archive">
			<h1 class="widgettitle"><?php _e( 'Archives', 'oxygen' ); ?></h1>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

	<?php endif; ?>

	</div><!-- .widget-area -->

</div><!-- #secondary -->
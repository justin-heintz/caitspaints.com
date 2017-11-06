<?php
/**
 * @package Grisaille
 */
?>
<div class="wrap">

	<?php if ( is_active_sidebar( 'grisaillesidebar' ) ) : ?>
		<?php dynamic_sidebar( 'grisaillesidebar' ); ?>

	<?php else : ?>

		<div id="search" class="sidebaritem">
			<?php get_search_form(); ?>
		</div>

 		<div class="sidebaritem">
     		<h3><?php _e( 'Bookmarks:', 'grisaille' ); ?></h3>
			<ul>
				<?php wp_list_bookmarks( 'title_li=& categorize=0&title_before=&title_after=' ); ?>
			</ul>
        </div>

		<div class="sidebaritem">
			<h3><?php _e( 'Categories:', 'grisaille' ); ?></h3>
			<ul>
				<?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</div>

		<div id="archives" class="sidebaritem">
			<h3><?php _e( 'Archives:', 'grisaille' ); ?></h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div>

		<div id="meta" class="sidebaritem">
			<h3><?php _e( 'Meta:', 'grisaille' ); ?></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div>

	<?php endif; ?>

</div><!-- end .wrap -->
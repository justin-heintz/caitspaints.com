<?php
/**
 * @package WordPress
 * @subpackage Modularity
 */
?>
<div id="content" class="span-<?php modularity_sidebar_class(); ?>">
<h3 class="sub"><?php _e( 'Latest', 'modularity' ); ?></h3>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<div class="clear"></div>

		<div class="navigation" id="nav-below">
			<div class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries', 'modularity' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'modularity' ) ); ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e( 'Not Found', 'modularity' ); ?></h2>
		<p class="center"><?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here.', 'modularity' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
</div>
<div class="double-border"></div>
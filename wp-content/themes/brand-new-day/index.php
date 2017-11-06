<?php
/**
 * @package Brand New Day
 */

get_header();

?>

	<div id="content" class="content">
		<?php
			if ( is_search() ) {
				echo "<h2 class='page_title'>" . __( 'You searched for' , 'new-theme' ) . " <em>" . get_search_query() . "</em></h2>";
				get_search_form();
				echo "<hr />";
			}
		?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'content' ); ?>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( '&laquo;' . __( 'Older Entries' , 'brand-new-day' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Newer Entries' , 'brand-new-day' ) . ' &raquo;' ); ?></div>
		</div>

	<?php else : ?>

		<h2 class="page_title"><?php _e( 'Not Found' , 'brand-new-day' ); ?></h2>
		<p class="aligncenter"><?php _e( 'Sorry, no posts matched your criteria.', 'brand-new-day' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

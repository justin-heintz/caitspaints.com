<?php get_header(); ?>

	<div id="content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&laquo; Previous Entries','daydream' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &raquo;','daydream' ) ); ?></div>
		</div>

	<?php else : ?>

		<h4><?php _e( 'Not Found', 'daydream'); ?></h4>
		<p class="center"><?php _e( "Sorry, but you are looking for something that isn't here.", 'daydream' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>

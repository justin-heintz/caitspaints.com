<?php
/**
 * @package Andrea
 */

get_header(); ?>

<div id="content" class="group">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content' ); ?>

<?php endwhile; else: ?>
	<div class="warning">
		<p><?php _e( "Sorry, but you are looking for something that isn't here.", 'andrea' ); ?></p>
	</div>
<?php endif; ?>

	<div class="navigation index group">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries', 'andrea' ) ); ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'andrea' ) ); ?></div>
	</div>

</div><!-- /#content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
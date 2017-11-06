<?php
/**
 * @package Duotone
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'image' ); ?>>
		<div class="nav prev"><?php next_post_link( '%link', '&larr;' ); ?></div>
		<div id="image"><?php echo Duotone::get_singular_image(); ?></div>
		<div class="nav next"><?php previous_post_link( '%link', '&rarr;' ); ?></div>
	</div>
	<?php get_template_part( 'post' ); ?>
	<?php comments_template(); ?>
<?php endwhile; else : ?>
	<h2 class="center"><?php _e( 'Not Found', 'duotone' ); ?></h2>
	<p class="center"><?php _e( "Sorry, but you are looking for something that isn't here.", 'duotone' ); ?></p>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
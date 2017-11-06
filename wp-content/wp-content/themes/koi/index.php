<?php
/**
 * @package WordPress
 * @subpackage Koi
 */
get_header(); ?>

	<div id="content">

	<?php if ( have_posts() )  : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content' ); ?>

		<?php endwhile; ?>

		<p class="post-nav"><span class="previous"><?php next_posts_link( __( '<em>Previous</em> Older Entries', 'ndesignthemes' ) ); ?></span> <span class="next"><?php previous_posts_link( __( '<em>Next</em> Newer Entries', 'ndesignthemes' ) ); ?></span></p>

	<?php else : ?>

		<h2><?php _e( 'Not Found', 'ndesignthemes' ); ?></h2>
		<p><?php _e( 'Sorry, but you are looking for something that isn\'t here', 'ndesignthemes' );?>.</p>

	<?php endif; ?>

	</div>
	<!--/content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * @package WordPress
 * @subpackage Oulipo
 */
?>
<?php get_header(); ?>

<div id="content">

	<div id="entry-content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() );?>

		<?php endwhile; ?>

		<div class="navigation">
			<p class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries', 'oulipo' ) ); ?></p>
			<p class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'oulipo' ) ); ?></p>
		</div>

	<?php else : ?>

		<div class="entry">
			<span class="error"><img src="<?php bloginfo( 'template_directory' ); ?>/images/mal.png" alt="error duck" /></span>
			<p><?php _e( 'Hmmm, seems like what you were looking for isn&rsquo;t here. You might want to give it another try.', 'oulipo' ); ?></p>
		</div>

	<?php endif; ?>

</div> <!-- close entry-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
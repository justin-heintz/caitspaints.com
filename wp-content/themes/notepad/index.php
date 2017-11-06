<?php
/**
 * @package WordPress
 * @subpackage Notepad
 */
?>
<?php get_header(); ?>

	<div id="content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() );?>

		<?php endwhile; ?>

		<p class="post-nav">
			<span class="previous"><?php next_posts_link(__( 'Older Entries','notepad-theme' ) ) ?></span>
			<span class="next"><?php previous_posts_link(__( 'Newer Entries','notepad-theme' ) ) ?></span>
		</p>

	<?php else : ?>

		<h2>
			<?php _e( 'Not Found', 'notepad-theme' ); ?>
		</h2>
		<p>
			<?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here', 'notepad-theme' ); ?>.
		</p>

	<?php endif; ?>

	</div>
	<!--/content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
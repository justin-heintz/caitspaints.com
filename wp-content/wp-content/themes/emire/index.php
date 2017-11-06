<?php
/**
 * @package Emire
 * @since Emire 1.0
 */
?>
<?php get_header(); ?>

<div id="content">
	<?php if ( have_posts() ) :?>
		<?php
			global $postCount;
			$postCount=0;
		?>
		<?php while ( have_posts() ) : the_post();?>
			<?php $postCount++;?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( '&laquo; '.__( 'Previous Entries', 'emire' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries', 'emire' ).' &raquo;' ); ?></div>
		</div>
	<?php else : ?>
		<h2><?php _e( 'Not Found', 'emire' ); ?></h2>
		<div class="entrybody"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'emire' ); ?></div>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
</body>
</html>



<?php
/**
 * @package Vigilance
 */
?>
<?php get_header(); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content' ); ?>
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="navigation index">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'vigilance')); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'vigilance')); ?></div>
		</div><!--end navigation-->
		<?php else : ?>
		<?php endif; ?>
	</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
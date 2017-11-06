<?php
/**
 * @package Ambiru
 */

get_header(); ?>

<div id="content">
	<?php if (have_posts()) :?>
		<?php $postCount = 0; ?>
		<?php while (have_posts()) : the_post();?>
			
			<?php get_template_part( 'content' ); ?>

		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries', 'ambiru')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;', 'ambiru')) ?></div>
		</div>

	<?php else : ?>

		<h2><?php _e('Not Found', 'ambiru'); ?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.", "ambiru"); ?></div>

	<?php endif; ?>

</div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>
</body>
</html>

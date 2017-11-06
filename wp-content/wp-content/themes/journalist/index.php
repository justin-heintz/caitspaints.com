<?php get_header(); ?>

<div id="content" class="group">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'content' ); ?>

<?php endwhile; else: ?>
<div class="warning">
	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'journalist'); ?></p>
</div>
<?php endif; ?>

<div class="navigation group">
	<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'journalist')); ?></div>
	<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'journalist')); ?></div>
</div>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

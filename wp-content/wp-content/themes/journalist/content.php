<div <?php post_class(); ?>>
	<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php if ( comments_open() || have_comments() ) : ?>
		<p class="comments"><a href="<?php comments_link(); ?>"><?php comments_number(__('leave a comment &raquo;','journalist'), __('with one comment','journalist'), __('with % comments','journalist')); ?></a></p>
	<?php endif; ?>

	<div class="main">
		<?php the_content(__('Read the rest of this entry &raquo;','journalist')); ?>
	</div>

	<div class="meta group">
		<div class="signature">
			<p><?php printf(__('Written by %s','journalist'), get_the_author()); ?> <span class="edit"><?php edit_post_link(__('Edit','journalist')); ?></span></p>
			<p><?php printf(__('%s at %s', 'journalist'), get_the_time(get_option('date_format')), get_the_time()); ?></p>
		</div>
		<div class="tags">
			<p><?php printf(__('Posted in %s','journalist'), get_the_category_list(', ')); ?></p>
			<?php if ( the_tags('<p>' .__('Tagged with', 'journalist') . ' ', ', ', '</p>') ) ?>
		</div>
	</div>
</div>

<?php
/*
 * @package Greenery 10
 */
?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent Link to %s' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>

	<p class="postmeta">
	<?php the_time(get_option('date_format')) ?> <?php //_e('at'); ?> <?php //the_time() ?>
	&#183; <?php _e('Filed under'); ?> <?php the_category(', ') ?>
	<?php if (is_callable('the_tags')) the_tags('&#183 Tagged ', ', '); ?>
	<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
	</p>

	<div class="postentry">
	<?php if (is_search()) { ?>
		<?php the_excerpt() ?>
	<?php } else { ?>
		<?php the_content(__('Read the rest of this entry &raquo;')); ?>
		<?php wp_link_pages(); ?>
	<?php } ?>
	</div>

	<p class="postfeedback">
	<?php comments_popup_link(__('Leave a comment &raquo;'), __('Comments (1) &raquo;'), __('Comments (%) &raquo;'), 'commentslink', __('Comments off')); ?>
	</p>
</div>
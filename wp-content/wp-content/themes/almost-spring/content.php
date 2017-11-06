<?php
/**
 * @package Almost Spring
 */
?>

<div <?php post_class(); ?>>

	<h2 class="posttitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'almost-spring' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>

	<p class="postmeta">
	<?php the_time(get_option("date_format")); ?> <?php _e('at','almost-spring'); ?> <?php the_time() ?>
	&#183; <?php _e('Filed under','almost-spring'); ?> <?php the_category(', ') ?>
	<?php the_tags( ' &#183;' . __( 'Tagged' ) . ' ', ', ', ''); ?>
	<?php edit_post_link(__('Edit','almost-spring'), ' &#183; ', ''); ?>
	</p>

	<div class="postentry">
	<?php if (is_search()) { ?>
		<?php the_excerpt() ?>
	<?php } else { ?>
		<?php the_content(__('Read the rest of this entry &raquo;','almost-spring')); ?>
		<?php wp_link_pages( __( 'Pages:', 'almost-spring' ) ); ?>
	<?php } ?>
	</div>

	<p class="postfeedback">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'almost-spring' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="permalink"><?php _e('Permalink'); ?></a>
	<?php comments_popup_link(__('Leave a Comment','almost-spring'), __('Comments (1)','almost-spring'), __('Comments (%)','almost-spring'), 'commentslink', __('Comments off','almost-spring')); ?>
	</p>

</div>

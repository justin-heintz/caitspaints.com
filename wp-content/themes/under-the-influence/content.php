<?php global $uti_author;
/**
 * @package Under_the_Influence
 * @since Under_the_Influence 1.03
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="date"><?php the_time(get_option('date_format')) ?></div>
	<h2>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_attr_e( 'Permalink to', 'uti_theme'); echo ' '; the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<?php
		/* If author is shown */
		if ( isset( $uti_author ) && 'on' == $uti_author ){
	?>
	<span class="author"><?php _e( 'by', 'uti_theme' ); echo ' '; the_author(); ?></span>
	<?php
		}
	?>
	<div class="entry">
		<?php the_content(__('read more &raquo;', 'uti_theme')); ?>
	</div>

	<p class="postmetadata">
		<?php _e( 'Posted in', 'uti_theme' ); echo ' '; the_category( ', ' ); ?> |
		<?php edit_post_link(__('Edit', 'uti_theme'), '', ' | '); ?>
		<?php comments_popup_link(__('Leave a Comment &#187;', 'uti_theme'), __('1 Comment &#187;', 'uti_theme'), __('% Comments &#187;', 'uti_theme')); ?>
	</p>
	<div class="tags">
		<?php the_tags( __( 'Tags:', 'uti_theme' ) . ' ', ', ', '<br />' ); ?>
	</div>
	<div class="ornament"></div>
</div><!-- #post-<?php the_ID(); ?> -->
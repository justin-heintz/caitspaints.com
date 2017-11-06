<?php
/**
 * @package Unsleepable
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('item entry'); ?>>
	<div class="itemhead">
		<h3>
		<?php if ( ! is_single() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'unsleepable' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php else : ?>
			<?php the_title(); ?>
		<?php endif; ?>
		</h3>
		<div class="chronodata"><?php { the_time('dMy') ?><?php } ?></div>

		<!-- The following two sections are for a noteworthy plugin currently in alpha. They'll get cleaned up and integrated better -->
		<?php foreach((get_the_category()) as $cat) {  if ($cat->cat_name == 'Noteworthy') { ?>
			<span class="metalink favorite"><img src="<?php bloginfo('template_url'); ?>/images/favorite.gif" alt="<?php esc_attr_e( 'Favorite Entry', 'unsleepable' ); ?>" /></span>
		<?php } } ?>

			<?php edit_post_link('<img src="'.get_bloginfo( 'template_directory' ).'/images/pencil.png" alt="' . __( 'Edit Link', 'unsleepable' ) . '" />','<span class="editlink">','</span>'); ?>

	</div>

	<div class="itemtext">
		<?php if (is_archive() or is_search()) {
			the_excerpt();
		} else {
			the_content( sprintf( __( 'Continue reading &lsquo;%1$s&rsquo;' ),
				the_title( '', '', false )
			) );
		} ?>

		<?php link_pages('<p><strong>' . __( 'Pages:', 'unsleepable' ) . '</strong> ', '</p>', 'number'); ?>
	</div>
	<br class="clear" />
	<small class="metadata">
		<span class="category"><?php _e( 'Filed under: ', 'unsleepable' ); ?><?php the_category(', '); ?>	</span>
		&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link( __( 'Leave a <span>Comment</span>', 'unsleepable' ), __( '1&nbsp;<span>Comment</span>', 'unsleepable' ), __( '%&nbsp;<span>Comments</span>', 'unsleepable' ), __( 'commentslink', 'unsleepable' ), __( '<span class="commentslink">Closed</span>', 'unsleepable' ) ); ?>
		<br /><?php the_tags( __( 'Tags: ', 'unsleepable' ), ', ', '<br />' ); ?>
	</small>
</div><!-- #post-<?php the_ID(); ?> -->
<?php
/*
 * @package K2Lite
 */

/* Permalink nav has to be inside loop */ if (is_single()) include (TEMPLATEPATH . '/navigation.php'); ?>

	<?php /* Only display asides if sidebar asides are not active */ if(!$post_asides || $k2asidescheck == '0') { ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-head">
				<h3 class="entry-title">
				<?php if ( ! is_single() ) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'k2_domain' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
				</h3>

				<small class="entry-meta">
					<span class="chronodata">
						<?php /* Date & Author */
							printf(	__('Published %1$s','k2_domain'),
								'<abbr class="published" title="'. get_the_time('Y-m-d\TH:i:sO') . '">' .
 								get_the_time(get_option('date_format'))
 								. '</abbr>'
 								);
 						?>
					</span>

					<span class="entry-category"> <?php the_category(' , '); ?></span>

					<?php /* Comments */ comments_popup_link(__('Leave a&nbsp;<span>Comment</span>','k2_domain'), __('1&nbsp;<span>Comment</span>','k2_domain'), __('%&nbsp;<span>Comments</span>','k2_domain'), 'commentslink', '<span class="commentslink">'.__('Closed','k2_domain').'</span>'); ?>

					<?php /* Edit Link */ edit_post_link(__('Edit','k2_domain'), '<span class="entry-edit">','</span>'); ?>

					<br /><?php the_tags(__('Tags: '), ', ', '<br />'); ?>

				</small> <!-- .entry-meta -->
			</div> <!-- .entry-head -->

			<div class="entry-content">
				<?php
					the_content(__('Continue reading','k2_domain') . " '" . the_title('', '', false) . "'");
				?>

				<?php link_pages('<p><strong>'.__('Pages:','k2_domain').'</strong> ', '</p>', 'number'); ?>
			</div> <!-- .entry-content -->
			<div class="clear"></div>
		</div> <!-- #post-ID -->

	<?php } /* End sidebar asides test */ ?>
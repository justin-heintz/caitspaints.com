<?php
/**
 * @package Inuit Types
 */

global $count, $postcount;
?>

<!-- Rest of Entries: START -->

	<div class="post">

		<h2><a title="<?php esc_attr_e( 'Permanent link to ', 'it' ); ?><?php the_title_attribute(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<div class="date-comments">

			<p class="fl">
				<em><?php the_time('F j, Y'); ?></em><br />
				<?php if ( is_multi_author() ) {
					_e( 'by ', 'it' ); ?><em><?php the_author_posts_link(); ?></em>
				<?php } ?>
			</p>

			<p class="fr"><span class="comments"><?php comments_popup_link( '0', '1', '%' ); ?></span></p>

		</div>

		<div class="fix"></div>

		<?php if ( has_post_thumbnail() ) : ?>

				<a title="<?php esc_attr_e( 'Link to ', 'it' ); ?><?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'it-thumbnail' ); ?></a>

		<?php endif; ?>

		<p><?php echo inuit_types_excerpt( get_the_excerpt(), get_permalink() ); ?></p>

		<?php the_tags('<div class="tags">' . __( 'Tagged: ', 'it' ) . '<em>', ', ', '</em></div>'); ?>

		<div class="categories">
			<?php _e( 'Posted in: ', 'it' ); ?><em><?php the_category(', ') ?></em>
		</div>

	</div>

<!-- Rest of Entries: END -->

<?php if ( ! get_option('inuitypes_one_column_posts' ) ) { $count++; if ( $count == 2 ) { $count = 0; ?><div class="fix"></div><?php } } ?>

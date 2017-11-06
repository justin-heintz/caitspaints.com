<?php
/**
 * @package Inuit Types
 */

global $count, $postcount;
?>
<?php get_header(); ?>

		<?php inuit_types_intro(); ?>

		<?php if ( is_paged() ) : ?>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'theme' )); ?></div>
				<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' )); ?></div>
			</div><!-- #nav-below -->


        <?php endif; ?>

		<div class="fix"></div>


	<div class="<?php if ( is_paged() || get_option( 'inuitypes_one_column_posts' ) ) { echo 'full_posts'; } else { echo 'boxed_posts'; } ?> <?php if (is_paged() || get_option('inuitypes_one_column_featposts')) { echo 'full_featposts'; } else { echo 'boxed_featposts'; } ?> blog">

	<?php if ( have_posts() ) : $count = 0; $postcount = 0; ?>

	<?php while ( have_posts() ) : the_post(); $postcount++; ?>

		<!-- Featured Posts: START -->

		<?php if ( $postcount <= get_option( 'inuitypes_featured_entries' ) && ! is_paged() ) { ?>

			<div class="featured_post feat_background fl <?php echo ( ( $postcount % 2 ) ? 'odd' : 'even' ); ?>">

				<?php if ( has_post_thumbnail() ) : ?>
					<a title="<?php esc_attr_e( 'Link to ', 'it' ); ?><?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php
						if ( get_option( 'inuitypes_one_column_featposts' ) )
							the_post_thumbnail( 'one-column-feature' );
						else
							the_post_thumbnail( 'two-column-feature' );
					?></a>
					<span class="date_bg"><?php the_time( get_option( 'date_format' ) ); ?></span>
				<?php endif; ?>

					<div class="featured_content">

						<h2>

						<a title="<?php esc_attr_e( 'Permanent link to ', 'it' ); ?><?php the_title_attribute(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>

						<span class="comments-feat">- <?php comments_popup_link('0', '1', '%'); ?></span>

						</h2>

					</div>

				<div class="fix"></div>

			</div>

		<?php continue; } ?>

		<!-- Split between Featured entries and Rest: START -->

		<?php if ( ( get_option( 'inuitypes_featured_entries' ) + 1) == $postcount  && ! is_paged() ) { ?>

			<div class="fix"><!----></div>

			<div class="hr-border"><!----></div>

		<?php } ?>

		<!-- Split between Featured entries and Rest: END -->

		<!-- Featured Posts: END -->

		<?php get_template_part( 'content' , get_post_format() ); ?>

	<?php endwhile; ?>

	<?php endif; ?>

	<div class="fix"></div>

		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'theme' )); ?></div>
			<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' )); ?></div>
		</div><!-- #nav-below -->

    </div>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

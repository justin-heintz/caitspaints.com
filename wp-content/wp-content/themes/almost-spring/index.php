<?php
/**
 * The main template file.
 *
 * @package Almost Spring
 */

get_header(); ?>

	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if (is_category()) { ?>
		<h2><?php _e('Archive for','almost-spring'); ?> <?php single_cat_title(); ?></h2>

 	  	<?php } elseif (is_tag()) { ?>
		<h2><?php _e('Posts Tagged','almost-spring'); ?> <?php single_tag_title(); ?></h2>

 	  	<?php } elseif (is_day()) { ?>
		<h2><?php _e('Archive for','almost-spring'); ?> <?php the_time('F j, Y'); ?></h2>

	 	<?php } elseif (is_month()) { ?>
		<h2><?php _e('Archive for','almost-spring'); ?> <?php the_time('F, Y'); ?></h2>

		<?php } elseif (is_year()) { ?>
		<h2><?php _e('Archive for','almost-spring'); ?> <?php the_time('Y'); ?></h2>

		<?php } elseif (is_author()) { ?>
		<h2><?php _e('Author Archive','almost-spring'); ?></h2>

		<?php } elseif (is_search()) { ?>
		<h2><?php _e('Search Results','almost-spring'); ?></h2>

		<?php } ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'content' ); ?>
			
		<?php endwhile; ?>

		<div class="post-navigation">
			<?php posts_nav_link(' &#183; ', __('&laquo; Newer Posts','almost-spring'), __('Older Posts &raquo;','almost-spring')); ?>
		</div>

	<?php else : ?>

		<h2><?php _e('Not Found','almost-spring'); ?></h2>

		<p><?php _e('Sorry, but no posts matched your criteria.','almost-spring'); ?></p>

		<h3><?php _e('Search','almost-spring'); ?></h3>

		<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

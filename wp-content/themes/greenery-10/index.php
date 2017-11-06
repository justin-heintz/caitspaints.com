<?php
/*
 * @package Greenery 10
 */

get_header(); ?>

<?php is_tag(); ?>
	<?php if ( have_posts() ) : ?>

		<?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if ( is_category() ) { ?>
		<h2><?php _e( 'Archive for' ); ?> <?php single_cat_title(); ?></h2>

 	  	<?php } elseif (is_tag() ) { ?>
		<h2><?php _e( 'Posts tagged' ); ?> <?php single_tag_title(); ?></h2>

 	  	<?php } elseif ( is_day() ) { ?>
		<h2><?php _e( 'Archive for' ); ?> <?php the_time( 'F j, Y' ); ?></h2>

	 	<?php } elseif ( is_month() ) { ?>
		<h2><?php _e( 'Archive for' ); ?> <?php the_time( 'F, Y' ); ?></h2>

		<?php } elseif ( is_year() ) { ?>
		<h2><?php _e( 'Archive for' ); ?> <?php the_time( 'Y' ); ?></h2>

		<?php } elseif ( is_author() ) { ?>
		<h2><?php _e( 'Author Archive' ); ?></h2>

		<?php } elseif ( is_search() ) { ?>
		<h2><?php _e( 'Search Results' ); ?></h2>

		<?php } ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

			<!-- Page Navigation -->
			<div class="pagenav">
				<div class="alignleft"><?php posts_nav_link( '', '', __( '&laquo; Previous entries' ) ); ?></div>
					<?php // posts_nav_link( ' &#183; ', '', '' ); ?>
				<div class="alignright"><?php posts_nav_link( '', __( 'Next entries &raquo;' ), '' ); ?></div>
			</div>


	<?php else : ?>

		<h2><?php _e( '404 Not Found' ); ?></h2>

		<p><?php _e( 'Oops...! What you requested cannot be found.' ); ?></p>

	<?php endif; ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>

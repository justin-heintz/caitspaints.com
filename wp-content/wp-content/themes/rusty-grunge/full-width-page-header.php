<?php
/**
 * Template Name: Full-width, no sidebar (with header image)
 * Description: A full-width template with no sidebar. Displays the header image at the top.
 *
 * @package WordPress
 * @subpackage Rusty Grunge
 */

get_header(); ?>

		<div id="primary" class="full-width with-header">
			<div id="content" role="main">

			<?php if ( '' != get_header_image() ) : ?>
			<div class="header-image">
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
			</div>
			<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
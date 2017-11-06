<?php
/*
 * @package Hemingway
 */

get_header();

global $first; ?>


	<div id="primary" class="twocol-stories">
		<div class="inside">
			<?php
				// Here is the call to only make two posts show up on the homepage REGARDLESS of your options in the control panel
				query_posts( 'showposts=2' );
			?>
			<?php if (have_posts()) : ?>
				<?php $first = true; $count = 0; ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php if ( $count < 2) { ?>

					<?php $count++; ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php $first = false; ?>

					<?php } ?>
				<?php endwhile; ?>
			<?php else : ?>

				<h2 class="center"><?php _e('Not Found', 'hemingway'); ?></h2>
				<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", 'hemingway'); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>

			<div class="clear"></div>
		</div>
	</div>
	<!-- [END] #primary -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>

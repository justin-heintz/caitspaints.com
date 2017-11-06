<?php
/*
 * @package K2Lite
 */

	/* Headlines for archives */ if ((!is_single() and !is_home()) or is_paged()) { ?>
		<h2>
		<?php // Figure out what kind of page is being shown
			if (is_category()) {
				if ($cat != $k2asidescategory) {
					printf(__('Archive for the \'%s\' Category','k2_domain'), single_cat_title('', false));
				} else {
					single_cat_title();
				}


			} elseif( is_tag() ) {
				printf(__("Posts Tagged '%s'"), single_tag_title('', false) );

			} elseif (is_day()) {
				printf(__('Archive for %s','k2_domain'), get_the_time(__('F jS, Y','k2_domain')));

			} elseif (is_month()) {
				printf(__('Archive for %s','k2_domain'), get_the_time(__('F, Y','k2_domain')));

			} elseif (is_year()) {
				printf(__('Archive for %s','k2_domain'), get_the_time(__('Y','k2_domain')));

			} elseif (is_search()) {
				printf(__('Search Results for \'%s\'','k2_domain'), get_search_query());

			} elseif (function_exists('is_tag') and is_tag()) {
				printf(__('Tag Archive for \'%s\'','k2_domain'), get_query_var('tag') );

			} elseif (is_paged() and ($paged > 1)) {
				 printf(__('Archive Page %s','k2_domain'), $paged );
			} ?>
		</h2>
	<?php } ?>

	<?php if (!is_single() and !is_home() and is_paged()) include (TEMPLATEPATH . '/navigation.php'); ?>

	<?php is_tag(); ?>
	<?php /* Check if there are posts */
		if ( have_posts() ) {

			// Get the user information
			get_currentuserinfo();
			global $user_level;

			// Post index for semantic classes
			$post_index = 1;

	?>

	<?php /* Start the loop */
		while ( have_posts() ) {
			the_post();

	?>

	<?php get_template_part( 'content', get_post_format() ); ?>

	<?php } /* End The Loop */ ?>

<?php /* If there is nothing to loop */  } else { $notfound = '1'; ?>

	<div class="hentry four04">

		<div class="entry-head">
			<h3 class="center"><?php _e('Not Found','k2_domain'); ?></h2>
		</div>

		<div class="entry-content">
			<p><?php _e('Oh no! You\'re looking for something which just isn\'t here! Fear not however, errors are to be expected, and luckily there are tools on the sidebar for you to use in your search for what you need.','k2_domain'); ?></p>
		</div>

	</div> <!-- .hentry .four04 -->

<?php } /* End Loop Init  */ ?>
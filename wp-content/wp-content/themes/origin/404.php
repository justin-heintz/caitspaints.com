<?php
/**
 * @package Origin
 */

get_header(); // Loads the header.php template. ?>

	<div id="content">

		<div class="hfeed">

			<div id="post-0" <?php post_class(); ?>>

				<h1 class="error-404-title entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'origin' ); ?></h1>

				<div class="entry-content">

					<p>
					<?php __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'origin' ); ?>
					</p>

					<?php get_search_form(); // Loads the searchform.php template. ?>

				</div><!-- .entry-content -->

			</div><!-- .hentry -->

		</div><!-- .hfeed -->

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
<?php
/**
 * @package Grisaille
 */
?>

<?php get_header(); ?>

<div id="content" class="error-page">

	<h2><span><?php _e( 'Oops! That page can&rsquo;t be found.', 'grisaille' ); ?></span></h2>

 	<p><strong><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'grisaille' ); ?></strong><br /></p>

	<?php get_search_form(); ?>

</div> <!-- end #content -->

<?php get_footer(); ?>
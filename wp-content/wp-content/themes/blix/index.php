<?php
/**
 * @package Blix
 */

get_header(); ?>

<!-- content ................................. -->
<div id="content">

<?php if ( have_posts() ) : ?>

<?php while (have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content' ); ?>

<?php endwhile; ?>

	<p class="post-navigation">
		<span class="previous"><?php next_posts_link( __( 'Older Posts', 'blix' ) ); ?></span>
		<span class="next"><?php previous_posts_link( __( 'Newer Posts', 'blix' ) ); ?></span>
	</p>


<?php else : ?>

	<h2><?php _e( 'Not Found', 'blix' ); ?></h2>
	<p><?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here.' ); ?></p>

<?php endif; ?>

</div> <!-- /content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

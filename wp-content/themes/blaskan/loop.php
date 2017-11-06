<?php
/**
 * @package Blaskan
 */
?>
<?php if ( ! have_posts() && ! is_front_page() ) : ?>
	<article id="post-0">
		<header>
			<h1><?php _e( 'Not Found', 'blaskan' ); ?></h1>
		</header>

		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'blaskan' ); ?></p>
		<?php get_search_form(); ?>
	</article>
	<!-- /#post-0 -->
<?php elseif ( ! have_posts() && is_front_page() ) : ?>
	<?php // We can't have #content empty. That would break sidebars. ?>
	&nbsp;
<?php endif; ?>

<?php // Start the loop ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content' ); ?>

	<?php comments_template( '', true ); ?>

	<?php if ( is_single() ): ?>
		<nav class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous Post Link', 'blaskan' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next Post Link', 'blaskan' ) . '</span>' ); ?></div>
		</nav>
		<!-- / .navigation -->
	<?php endif; ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav class="navigation" role="navigation">
		<div class="nav-previous"><?php next_posts_link( __( 'Older Posts', 'blaskan' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer Posts', 'blaskan' ) ); ?></div>
	</nav>
	<!-- / .navigation -->
<?php endif; ?>

<?php
/**
 * The featured slider template file.
 *
 * @package WordPress
 * @subpackage iTheme2
 * @since iTheme2 1.1-wpcom
 */

// Proceed only if sticky posts exist.
if ( get_option( 'sticky_posts' ) ) :

	$featured_args = array(
		'post__in'            => itheme2_featuring_posts(),
		'post_status'         => 'publish',
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		'posts_per_page'      => 30,
	);

	// The Featured Posts query.
	$featured = new WP_Query( $featured_args );

	// Proceed only if published posts exist
	if ( $featured->have_posts() ) : ?>

		<div id="featured" class="slider">
			<ul id="featured-posts" class="slides">
			<?php

			// Start the actual featured post loop
			while ( $featured->have_posts() ) : $featured->the_post();
				if ( get_the_post_thumbnail() ) {
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'itheme2' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'small-feature' ); ?></a>
						<a class="feature-post-title" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'itheme2' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</li>
					<?php
				}
			endwhile;

			?>
			</ul>

			<?php if ( 6 <= count( itheme2_featuring_posts() ) ) : ?>
			<div class="slider-nav">
				<a href="#" id="featured-posts-prev" class="prev-slide">Previous</a>
				<a href="#" id="featured-posts-next" class="next-slide">Next</a>
			</div>
			<?php endif; ?>
		</div><!-- #featured .slider -->
		<?php

		// Set the post global back to the original from the main query
		wp_reset_postdata();

	endif; // $featured->have_posts()

endif; // ! empty( $sticky )
?>

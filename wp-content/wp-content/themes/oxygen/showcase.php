<?php
/**
 * Template Name: Showcase Page
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

get_header(); ?>

<div id="content-wrap">

	<?php get_template_part( 'featured-content' ); // Loads the featured-content.php template. ?>

	<div id="primary" class="site-content">

		<div id="content" class="clear-fix" role="main">
			<section class="recent-articles">
				<header class="section-title">
					<h1><?php _e( 'Recent Articles', 'oxygen' ); ?></h1>
				</header>
				<?php
					// Display the latest 3 posts, ignoring Sticky posts.
					$recent_posts_args = array(
						'posts_per_page' => 3,
						'post__not_in' => get_option( 'sticky_posts' )
					);

					$recent_posts_query = new WP_Query( $recent_posts_args );

					while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;

					wp_reset_query();
				?>
			</section><!-- .recent-articles -->

			<section class="more-articles clear-fix">
				<header class="section-title">
					<h1><?php _e( 'More Articles', 'oxygen' ); ?></h1>
				</header>
				<div class="hfeed-more">
				<?php
					// Display the rest of posts excluding the latest 3 posts, ignoring Sticky posts.
					$more_posts_args = array(
						'offset' => 3,
						'post__not_in' => get_option( 'sticky_posts' )
					);

					$more_posts_query = new WP_Query( $more_posts_args );

					$odd_or_even = 'even';

					while ( $more_posts_query->have_posts() ) : $more_posts_query->the_post();

						$odd_or_even = ( 'odd' == $odd_or_even ) ? 'even' : 'odd';

						get_template_part( 'content', 'list' );

					endwhile; // end of the loop.

					wp_reset_postdata();
				?>
				</div>
			</section><!-- .more-articles -->

		</div><!-- #content -->

	</div><!-- #primary .site-content -->

	<?php get_sidebar( 'secondary' ); ?>

</div>

<?php get_sidebar( 'primary' ); ?>

<?php get_footer(); ?>
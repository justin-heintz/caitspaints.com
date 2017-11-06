<?php
/**
 * The template for Featured Content Slider.
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>
<section class="featured-wrapper">
	<div id="featured-content" class="clear-fix">
	<?php

		// Proceed if we have featured posts
		if ( oxygen_featured_posts() ) {

			$featured_args = array(
				'post__in'            => oxygen_featured_posts(),
				'posts_per_page'      => 6,
				'ignore_sticky_posts' => 1
			);

			// The Featured Posts query
			$featured = new WP_Query( $featured_args );

			// We will need to count featured posts starting from zero to create the slider navigation.
			$post_counter = 0;
	?>
		<img class="dummy <?php echo ( $featured->post_count == 1 ) ? 'hidden' : ''; ?>" src="<?php echo get_template_directory_uri() . '/images/empty.gif' ?>" alt="" width="750" height="380" />
	<?php

			// Let's roll.
			while ( $featured->have_posts() ) : $featured->the_post();

				// Increase the counter.
				$post_counter++;

				//Make sure we don't see any posts without thumbnail
				if ( '' != get_the_post_thumbnail() ) { ?>
					<article class="<?php echo ( $post_counter == 1 ) ? 'featured-post first' : 'featured-post'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
							<?php the_post_thumbnail( 'featured-thumbnail' ); ?>
						</a>
						<header>
							<h1 class="post-title entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h1>
						</header>
						<footer class="entry-meta">
							<?php oxygen_posted_on(); ?>
						</footer>
					</article><!-- .featured-post -->
				<?php
				} // '' != get_the_post_thumbnail()
			endwhile;
		}
	?>
		<span id="slider-prev" class="slider-nav">&larr;</span>
		<span id="slider-next" class="slider-nav">&rarr;</span>
	</div><!-- .featured-content -->

	<?php if ( $featured->post_count > 1 ) : ?>

		<div id="slider-nav">

			<ul id="slide-thumbs">
			<?php
				// Reset the counter so that we end up with matching elements
				$slidecount = 0;

				// Begin from zero
				rewind_posts();

				while ( $featured->have_posts() ) : $featured->the_post();

					 //Make sure we don't see any posts without thumbnails
					 if ( '' != get_the_post_thumbnail() ) {
					 	$slidecount++;
						if ( 6 == $slidecount )
							$class = 'class="last"';
						else
							$class = '';
			?>
						<li <?php echo $class; ?>>
							<a href="#featured-post-<?php echo $$slidecount; ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>">
							<?php the_post_thumbnail( 'slider-nav-thumbnail' ); ?>
							</a>
						</li>
					<?php
					}
				endwhile; ?>

			</ul>

		</div>

	<?php endif; ?>

</section>
<?php
/**
 * Template Name: Full Width
 * @package Origin
 */

get_header(); // Loads the header.php template. ?>

	<div id="content">

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

						<div class="entry-content">

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'origin' ) ); ?>

							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'origin' ), 'after' => '</p>' ) ); ?>

						</div><!-- .entry-content -->

						<div class="entry-meta">
							<span class="edit"><?php edit_post_link( __( 'Edit', 'origin' ) ); ?></span>
						</div>

					</div><!-- .hentry -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
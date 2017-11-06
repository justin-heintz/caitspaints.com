<?php
/**
 * @package Origin
 */

get_header(); // Loads the header.php template. ?>



	<div id="content">

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if ( has_post_thumbnail() ) {

								if ( is_sticky ( $post->ID ) ) {

									the_post_thumbnail( 'single-thumbnail', array( 'class' => 'featured' ) );

								} else {

									the_post_thumbnail( 'post-thumbnail', array( 'class' => 'featured thumbnail' ) );

								}

							} ?>

							<div class="sticky-header">

								<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>

								<div class="byline">
									<abbr class="published" title="<?php echo get_the_date(); ?> <?php echo get_the_time(); ?>"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></abbr> <?php _e( '&middot;', 'origin' ); ?>
									<?php _e( 'by', 'origin' ); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span> <?php _e( '&middot;', 'origin' ); ?>
									<?php _e( 'in', 'origin' ); ?> <?php echo get_the_category_list( ', ' ); ?>
									<span class="edit"><?php edit_post_link( __( 'Edit', 'origin' ), __( '&middot;', 'origin' ) ); ?></span>
								</div>

							</div><!-- .sticky-header -->

							<div class="entry-summary">

								<?php the_excerpt(); ?>

								<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'origin' ), 'after' => '</p>' ) ); ?>

							</div><!-- .entry-summary -->

						</div><!-- .hentry -->

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
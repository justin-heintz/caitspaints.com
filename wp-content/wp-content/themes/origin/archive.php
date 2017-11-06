<?php
/**
 * @package Origin
 */

get_header(); // Loads the header.php template. ?>

	<div id="content">

		<div class="hfeed">

			<h1 class="page-title">
				<?php
					if ( is_category() ) {
						printf( __( 'Category Archives: %s', 'origin' ), '<span>' . single_cat_title( '', false ) . '</span>' );

					} elseif ( is_tag() ) {
						printf( __( 'Tag Archives: %s', 'origin' ), '<span>' . single_tag_title( '', false ) . '</span>' );

					} elseif ( is_author() ) {
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'Author Archives: %s', 'origin' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					} elseif ( is_day() ) {
						printf( __( 'Daily Archives: %s', 'origin' ), '<span>' . get_the_date() . '</span>' );

					} elseif ( is_month() ) {
						printf( __( 'Monthly Archives: %s', 'origin' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					} elseif ( is_year() ) {
						printf( __( 'Yearly Archives: %s', 'origin' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					} else {
						_e( 'Archives', 'origin' );

					}
				?>
			</h1>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php if ( has_post_thumbnail() ) the_post_thumbnail( array( 'class' => 'featured thumbnail' ) ); ?>

						<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>

						<div class="byline">
							<abbr class="published" title="<?php echo get_the_date(); ?> <?php echo get_the_time(); ?>"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></abbr> <?php _e( '&middot;', 'origin' ); ?>
							<?php _e( 'by', 'origin' ); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span> <?php _e( '&middot;', 'origin' ); ?>
							<?php _e( 'in', 'origin' ); ?> <?php echo get_the_category_list( ', ' ); ?>
							<span class="edit"><?php edit_post_link( __( 'Edit', 'origin' ), __( '&middot;', 'origin' ) ); ?></span>
						</div>

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
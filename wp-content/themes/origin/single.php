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

						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<div class="byline">
							<abbr class="published" title="<?php echo get_the_date(); ?> <?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></abbr> <?php _e( '&middot;', 'origin' ); ?>
							<?php _e( 'by', 'origin' ); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span> <?php _e( '&middot;', 'origin' ); ?>
							<?php _e( 'in', 'origin' ); ?> <?php echo get_the_category_list( ', ' ); ?>
							<span class="edit"><?php edit_post_link( __( 'Edit', 'origin' ), __( '&middot;', 'origin' ) ); ?></span>
						</div>

						<div class="entry-content">

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'origin' ) ); ?>

							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'origin' ), 'after' => '</p>' ) ); ?>

							<?php
								$tags_list = get_the_tag_list( '', ', ' );
								if ( $tags_list ):
							?>
								<div class="byline">
									<?php printf( __( '<span class="%1$s">Tags:</span> %2$s', 'origin' ), 'tags-label', $tags_list ); ?>
								</div>
							<?php endif; ?>

						</div><!-- .entry-content -->

					</div><!-- .hentry -->

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php comments_template(); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
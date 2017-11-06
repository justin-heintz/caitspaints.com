<?php
/**
 * @package Grisaille
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div id="archives">
		<h2>
		<?php
			if ( is_category() ) {
				printf( __( 'Category Archives: %s', 'grisaille' ), '<span>' . single_cat_title( '', false ) . '</span>' );

			} elseif ( is_tag() ) {
				printf( __( 'Tag Archives: %s', 'grisaille' ), '<span>' . single_tag_title( '', false ) . '</span>' );

			} elseif ( is_author() ) {
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( __( 'Author Archives: %s', 'grisaille' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			} elseif ( is_day() ) {
				printf( __( 'Daily Archives: %s', 'grisaille' ), '<span>' . get_the_date() . '</span>' );

			} elseif ( is_month() ) {
				printf( __( 'Monthly Archives: %s', 'grisaille' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			} elseif ( is_year() ) {
				printf( __( 'Yearly Archives: %s', 'grisaille' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			} else {
				_e( 'Archives', 'grisaille' );

			}
		?>
		</h2>
	</div>

 	<ol id="posts">
		<?php while ( have_posts() ) : the_post(); ?>

			<li id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>

				<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title=" title="<?php echo esc_attr( get_the_title() ); ?>""><?php the_title(); ?></a></h2>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'grisaille' ), __( '1', 'grisaille' ), '%' ); ?></span>
				<?php endif; ?>
			  	<p class="the-date"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a> <?php _e( 'by', 'grisaille' ); ?> <?php the_author(); ?></p>

			  	<div class="post-wrap">
			  		<?php if ( '' != get_the_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_post_thumbnail( 'following-post-thumbnails' ); ?></a>
					<?php } ?>
					<?php the_excerpt( __( 'Continue reading', 'grisaille' ) ); ?>
			  	</div>
			  	<p class="post-meta">
					<small>
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'grisaille' ) );
							if ( $categories_list ) :
						?>
						<span class="cat-links">
							<?php printf( __( 'Category: %1$s', 'grisaille' ), $categories_list ); ?>
						</span>
						<?php endif; // End if categories ?>

						<?php
							/* translators: used between list items, there is a space after the comma */
							$tags_list = get_the_tag_list( '', __( ', ', 'grisaille' ) );
							if ( $tags_list ) :
						?>
						<span class="sep"> | </span>
						<span class="tag-links">
							<?php printf( __( 'Tags: %1$s', 'grisaille' ), $tags_list ); ?>
						</span>
						<?php endif; // End if $tags_list ?>
						<?php edit_post_link( __( 'Edit', 'grisaille' ), ' | ' ); ?>
					</small>
				</p>

			</li>

			<?php comments_template(); ?>

		<?php endwhile; ?>

	</ol><!-- end #posts -->

<?php else : ?>

	<p><?php _e( 'Sorry, no posts matched your criteria.', 'grisaille' ); ?></p>

<?php endif; ?>

<div class="pagination-older"><?php next_posts_link( __( '&laquo; Older Entries', 'grisaille' ) ); ?></div>
<div class="pagination-newer"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'grisaille' ) ); ?></div>

<?php get_footer(); ?>
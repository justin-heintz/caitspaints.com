<?php
/**
 * @package Grisaille
 */

get_header();

if ( have_posts() ) : ?>

	<div id="archives">
		<h2><?php printf( __( 'Search Results for: %s', 'grisaille' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	</div>

 	<ol id="posts">
		<?php while ( have_posts() ) : the_post(); ?>

			<li id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>

				<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h2>
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

			</li><!-- end #post-id -->

			<?php comments_template(); ?>

		<?php endwhile; ?>

	</ol><!-- end #posts -->

<?php else : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'grisaille' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

<div class="pagination-older"><?php next_posts_link( __( '&laquo; Older Entries', 'grisaille' ) ); ?></div>
<div class=" pagination-newer"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'grisaille' ) ); ?></div>

<?php get_footer(); ?>
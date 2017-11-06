<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

if ( ! function_exists( 'oxygen_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Oxygen 0.2.2
 */
function oxygen_content_nav( $nav_id ) {
	global $wp_rewrite, $wp_query, $post;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?> clear-fix">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'oxygen' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'oxygen' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'oxygen' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // pagination for home, archive, and search pages ?>
		<div class="pagination loop-pagination">
		<?php
			/* Get the current page. */
			$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

			/* Get the max number of pages. */
			$max_num_pages = intval( $wp_query->max_num_pages );

			/* Set up arguments for the paginate_links() function. */
			$args = array(
				'base' => add_query_arg( 'paged', '%#%' ),
				'format' => '',
				'total' => $max_num_pages,
				'current' => $current,
				'prev_text' => __( '&larr; Previous', 'oxygen' ),
				'next_text' => __( 'Next &rarr;', 'oxygen' ),
				'mid_size' => 1
			);
			/* Add the $base argument to the array if the user is using permalinks. */
			if( $wp_rewrite->using_permalinks() )
				$args['base'] = user_trailingslashit( trailingslashit( esc_url( get_pagenum_link() ) ) . 'page/%#%' );

			/* If we're on a search results page, we need to change this up a bit. */
			if ( is_search() ) {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$args['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
			}

			echo paginate_links( $args )
		?>
		</div>
	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // oxygen_content_nav

if ( ! function_exists( 'oxygen_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'oxygen' ); ?> <?php comment_author_link(); ?><span class="sep">&middot;</span><?php edit_comment_link( __( 'Edit', 'oxygen' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-meta commentmetadata">
					<?php echo get_avatar( $comment, 40 ); ?>
					
					<span class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%s</cite>', 'oxygen' ), get_comment_author_link() ); ?>
					</span>
					
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php printf( __( '%1$s at %2$s', 'oxygen' ), get_comment_date(), get_comment_time() ); ?></time></a>
					<span class="sep">&middot;</span>
					<?php edit_comment_link( __( 'Edit', 'oxygen' ), ' ' ); ?>
					<span class="sep">&middot;</span>
					<?php comment_reply_link( array_merge( $args, array( 'after' => ' &rarr;', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .comment-meta .commentmetadata -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'oxygen' ); ?></em>
					<br />
				<?php endif; ?>
			</footer>
			<div class="comment-content"><?php comment_text(); ?></div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for oxygen_comment()

if ( ! function_exists( 'oxygen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_posted_on() {
	printf( __( '<span class="entry-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a></span>', 'oxygen' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

if ( ! function_exists( 'oxygen_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post-author.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_posted_by() {
	printf( __( '<span class="byline">by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'oxygen' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'oxygen' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Oxygen 0.2.2
 */
function oxygen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so oxygen_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so oxygen_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in oxygen_categorized_blog
 *
 * @since Oxygen 0.2.2
 */
function oxygen_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'oxygen_category_transient_flusher' );
add_action( 'save_post', 'oxygen_category_transient_flusher' );
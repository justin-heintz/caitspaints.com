<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Grisaille
 * @since Grisaille 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'grisaille' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="post-link site-navigation comment-navigation">
			<h1 class="no-css"><?php _e( 'Comment navigation', 'grisaille' ); ?></h1>
			<div class="pagination-older"><?php previous_comments_link( __( '&laquo; Older Comments', 'grisaille' ) ); ?></div>
			<div class="pagination-newer"><?php next_comments_link( __( 'Newer Comments &raquo;', 'grisaille' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol id="commentlist">
			<?php wp_list_comments(); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="post-link site-navigation comment-navigation">
			<h1 class="no-css"><?php _e( 'Comment navigation', 'grisaille' ); ?></h1>
			<div class="pagination-older"><?php previous_comments_link( __( '&laquo; Older Comments', 'grisaille' ) ); ?></div>
			<div class="pagination-newer"><?php next_comments_link( __( 'Newer Comments &raquo;', 'grisaille' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'grisaille' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->

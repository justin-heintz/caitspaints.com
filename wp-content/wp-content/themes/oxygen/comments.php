<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to oxygen_comment() which is
 * located in the functions.php file.
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>
	<div id="comments" class="comments-area">
	<?php
		if ( post_password_required() )
			return;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One response on &ldquo;%2$s&rdquo;', '%1$s responses on &ldquo;%2$s&rdquo;', get_comments_number(), 'oxygen' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use oxygen_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define oxygen_comment() and that will be used instead.
				 * See oxygen_comment() in functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'oxygen_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation clear-fix">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'oxygen' ); ?></h1>
			<?php paginate_comments_links(); ?>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are no comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'oxygen' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->
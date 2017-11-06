<?php
/**
 * @package Origin
 */

/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<div id="comments-template">

	<div class="comments-wrap">

		<div id="comments">

			<?php if ( have_comments() ) : ?>

				<h3 id="comments-number" class="comments-header block-title"><span><?php comments_number( __( 'Leave a Comment', 'origin' ), __( 'One Comment', 'origin' ), __( '% Comments', 'origin' ) ); ?></span></h3>

				<ol class="commentlist">
					<?php wp_list_comments( array(
												'style' => 'ol',
												'type' => 'all',
												'avatar_size' => 50,
												'callback' => 'origin_comments'
											) ); ?>
				</ol><!-- .comment-list -->

				<?php if ( get_option( 'page_comments' ) ) : ?>
					<div class="comment-navigation comment-pagination">
						<?php paginate_comments_links(); ?>
					</div><!-- .comment-navigation -->
				<?php endif; ?>

			<?php endif; ?>

		</div><!-- #comments -->

		<?php comment_form(); // Loads the comment form. ?>

	</div><!-- .comments-wrap -->

</div><!-- #comments-template -->
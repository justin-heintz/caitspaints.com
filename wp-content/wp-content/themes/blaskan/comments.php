<?php
/**
 * @package Blaskan
 */
?>
<section id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'blaskan' ); ?></p>
		</section>
		<!-- /#comments -->
		<?php return; ?>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>
		<h1 id="comments-title"><?php printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'blaskan' ), number_format_i18n( get_comments_number() ) ); ?></h1>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'blaskan' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'blaskan' ) ); ?></div>
			</nav>
			<!-- / .navigation -->
		<?php endif; ?>

		<ol id="commentlist"><?php wp_list_comments( array( 'callback' => 'blaskan_comment' ) ); ?></ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<footer>
				<nav class="navigation" role="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'blaskan' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'blaskan' ) ); ?></div>
				</nav>
				<!-- / .navigation -->
			</footer>
		<?php endif; ?>
	<?php endif; // end have_comments ?>

	<?php comment_form(); ?>

</section>
<!-- / #comments -->
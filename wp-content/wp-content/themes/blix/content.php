<?php
/**
 * @package Blix
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<?php ($post->post_excerpt != "")? the_excerpt() : the_content(); ?>

	<p class="info"><?php if ($post->post_excerpt != "") { ?><a href="<?php the_permalink(); ?>" class="more"><?php _e( 'Continue Reading', 'blix' ); ?></a><?php } ?>
	<?php blix_posted_on(); ?>
	<?php blix_posted_by(); ?>
	<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<em class="comments-popup">
		<?php comments_popup_link( __( 'Leave a comment' ), __( '1 comment' ), __( '% comments' ), __( 'commentlink', 'blix' ), '' ); ?>
		</em>
	<?php endif; ?>
	<?php edit_post_link( __( 'Edit', 'blix' ), '<span class="editlink">', '</span>' ); ?>
	</p>

</div>
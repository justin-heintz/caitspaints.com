<?php
/**
 * @package Origin
 */
?>

	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . __( '&larr; Return to entry', 'origin' ) . '</span>' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<div class="loop-nav">
			<?php previous_post_link( '<div class="previous">' . __( '&larr; %link', 'origin' ) . '</div>', '%title' ); ?>
			<?php next_post_link( '<div class="next">' . __( '%link', 'origin' ) . ' &rarr;</div>', '%title' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( !is_singular() ) : ?>

		<div class="loop-nav">
			<?php if ( get_next_posts_link() ) : ?>
			<span class="previous"><?php next_posts_link( __( '&larr; Older posts', 'origin' ) ); ?></span>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<span class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'origin' ) ); ?></span>
			<?php endif; ?>
		</div><!-- .loop-nav -->

	<?php endif; ?>
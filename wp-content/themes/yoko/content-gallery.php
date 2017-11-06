<?php
/**
 * @package Yoko
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-post-format">
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr( sprintf( __( 'Permalink to %s', 'yoko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p>
				<?php yoko_posted_on(); ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<?php comments_popup_link( __( ' | Leave a comment', 'yoko' ), __( ' | 1 Comment', 'yoko' ), __( ' | % Comments', 'yoko' ) ); ?>
				<?php endif; ?>
			</p>
		</header><!-- end entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
			<div class="entry-summary">
				<?php the_excerpt( __( 'View the pictures &rarr;', 'yoko' ) ); ?>
			</div><!-- end entry-summary -->
		<?php else : ?>

			<?php if ( post_password_required() ) : ?>
				<?php the_content( __( 'View the pictures &rarr;', 'yoko' ) ); ?>
			<?php else : ?>
				<?php
				$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
				if ( $images ) :
					$total_images = count( $images );
					$image = array_shift( $images );
					$image_img_tag = wp_get_attachment_image( $image->ID, 'medium' );
				?>
					<figure class="gallery-thumb">
						<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					</figure><!-- end gallery-thumb -->
				<?php endif; ?>

				<div class="entry-post-format">
					<?php the_content( __( 'View the pictures &rarr;', 'yoko' ) ); ?>
			<?php endif; ?>

					<p class="pics-count">
						<?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>', $total_images, 'yoko' ), 'href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'yoko' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark"', number_format_i18n( $total_images ) ); ?>
					</p>
				</div><!-- end entry-content-gallery -->
		<?php endif; ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'yoko' ), 'after' => '</div>' ) ); ?>

		<footer class="entry-meta">
			<p>
				<?php yoko_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit &rarr;', 'yoko' ), '| <span class="edit-link">', '</span>' ); ?>
			</p>
		</footer><!-- end entry-meta -->
	</div><!-- end entry-post-format -->
</article>

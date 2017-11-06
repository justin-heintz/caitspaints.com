<?php
/**
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear-fix' ); ?>>
	<div class="featured-image">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
		<?php
			$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

			if ( '' != get_the_post_thumbnail() ) :
				the_post_thumbnail( 'archive-thumbnail' );
			elseif ( $images ) :
				$image = array_shift( $images );
				echo wp_get_attachment_image( $image->ID, 'archive-thumbnail' );
			else :
		?>
			<img src="<?php echo get_template_directory_uri(); ?>/images/archive-thumbnail-placeholder.gif" alt="" class="attachment-archive-thumbnail" />
		<?php endif; ?>
		</a>
	</div>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() ) :
					if ( is_sticky() ) :
						_e( '<span class="entry-format">Featured</span>', 'oxygen' );
					else :
						oxygen_posted_on();
					endif; // End if it's sticky

					oxygen_posted_by();
				endif; // End if 'post' == get_post_type()
			?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'oxygen' ), __( '1 Comment', 'oxygen' ), __( '% Comments', 'oxygen' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'oxygen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-summary clear-fix">
		<?php the_excerpt(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'oxygen' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-summary -->

	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" class="read-more"><?php _e( 'Read Article &rarr;', 'oxygen' ) ?></a>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'oxygen' ) );
				if ( $categories_list && oxygen_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php echo $categories_list; ?>
			</span>
			<?php endif; // End if categories ?>
		<?php endif; // End if 'post' == get_post_type() ?>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
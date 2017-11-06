<?php
/**
 * @package Grisaille
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>

      	<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h1>
       	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'grisaille' ), __( '1', 'grisaille' ), '%' ); ?></span>
		<?php endif; ?>
		<p class="the-date">
			<?php
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'grisaille' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					wp_get_attachment_url(),
					$metadata['width'],
					$metadata['height'],
					get_permalink( $post->post_parent ),
					get_the_title( $post->post_parent )
				);
			?>
			<?php edit_post_link( __( 'Edit', 'grisaille' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
		</p><!-- .the-date -->

		<nav id="image-navigation">
			<span class="previous-image"><?php previous_image_link( false, __( '&laquo; Previous', 'grisaille' ) ); ?></span>
			<span class="next-image"><?php next_image_link( false, __( 'Next &raquo;', 'grisaille' ) ); ?></span>
		</nav><!-- #image-navigation -->
		<div class="post-wrap">
			<div class="entry-attachment">
				<div class="attachment">
					<?php
						/**
						 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						 */
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
						}
						$k++;
						// If there is more than 1 attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) )
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							else
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
						} else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
					?>

					<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
						$attachment_size = apply_filters( '_s_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
						echo wp_get_attachment_image( $post->ID, $attachment_size );
					?></a>
				</div><!-- .attachment -->

				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>
			</div><!-- .entry-attachment -->
			<?php the_content(); ?>
		</div><!-- end .post-wrap -->
		<?php wp_link_pages(
      			  array(	'before'           => '<p class="pages-links">' . __( 'Pages:', 'grisaille' ),
    						'after'            => '</p>',
      						'next_or_number'   => 'number',
    						'nextpagelink'     => __( 'Next page', 'grisaille' ),
    						'previouspagelink' => __( 'Previous page', 'grisaille' ),
    						'pagelink'         => '%' ) ); ?>
	  	<p class="post-meta">
	  		<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
				<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'grisaille' ), get_trackback_url() ); ?>
			<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
				<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'grisaille' ), get_trackback_url() ); ?>
			<?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
				<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'grisaille' ); ?>
			<?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
				<?php _e( 'Both comments and trackbacks are currently closed.', 'grisaille' ); ?>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'grisaille' ), ' <span class="edit-link">', '</span>' ); ?>
	  	</p><!-- end .post-meta -->


    </div><!-- end #posts -->
    <div class="post-link">
 		<div class="pagination-newer"><?php next_post_link( '%link &raquo;' ); ?></div>
		<div class="pagination-older"><?php previous_post_link( '&laquo; %link' ); ?></div>
	</div>

	<?php comments_template(); ?>

<?php endwhile; else: ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'grisaille' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>
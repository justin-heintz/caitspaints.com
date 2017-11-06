<?php
/**
 * @package Clean_Home
 * @since Clean Home 1.2.0
 */
?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'cleanhome' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h1>
	<small class="post-meta"><span class="post-date"><b><?php _e( 'Posted:', 'cleanhome' ); ?></b> <?php the_time( get_option( 'date_format' ) ); ?></span> <span class="author-link">| <b><?php _e( 'Author:', 'cleanhome' ); ?></b> <?php the_author_posts_link(); ?></span> <span class="meta-sep"><?php _e( '|', 'cleanhome'); ?></span> <span class="cat-links"><b><?php _e( 'Filed under:', 'cleanhome' ); ?></b> <?php the_category( ', ' ); ?></span> <span class="tag-links"><?php the_tags( ' | <b>Tags:</b> ', ', ', '' ); ?></span> <span class="edit-link"><?php edit_post_link( __( 'Edit this', 'cleanhome' ), ' |  <b>Modify:</b> ' ); ?></span> <span class="meta-sep"><?php _e( '|', 'cleanhome'); ?></span> <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment &#187;', 'cleanhome' ), __( '<strong>1</strong> Comment &#187;', 'cleanhome' ), __( '<strong>%</strong> Comments &#187;', 'cleanhome' ) ); ?></span></small>
	<?php the_content( __('Read the rest of this entry &raquo;', 'cleanhome') ); ?>
	<?php wp_link_pages( array( 'before' => '<p>' . __('Page:', 'cleanhome') .' ', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
	<hr/>
</div>
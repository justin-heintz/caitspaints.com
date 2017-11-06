<?php
/**
 * @package Choco
 * @since Choco 0.1
 */
?>
<div <?php post_class(); ?>>
	<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'choco' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
	<div class="date">
		<div class="bg">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'choco' ), the_title_attribute( 'echo=0' ) ) ); ?>">
				<span class="day"><?php the_time( 'd' ); ?></span>
				<span><?php the_time( 'M' ); ?></span>
			</a>
		</div>
	</div><!-- .date -->

	<div class="entry">
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'choco' ), the_title_attribute( 'echo=0' ) ) ); ?>">
		<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'post-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>
			</a>
		<?php } ?>
		<?php the_content( 'Read the rest of this entry &raquo;' ); ?>
		<div class="cl">&nbsp;</div>
		<?php wp_link_pages( array( 'before' => '<div class="page-navigation"><p><strong>' . __( 'Pages:', 'choco' ) . ' </strong> ', 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
		<?php edit_post_link( __( '(Edit)', 'choco' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry -->

	<div class="meta">
		<div class="bg">
			<span class="comments-num"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></span>
			<p><?php _e( 'Posted by', 'choco' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'choco' ); ?> <?php echo get_the_date( get_option( 'date_format' ) ); ?> <?php _e( 'in', 'choco' ); ?> <?php the_category( ', ' ); ?></p>
		</div>
		<div class="bot">&nbsp;</div>
	</div><!-- .meta -->
	<?php the_tags( '<p class="tags">' . __( 'Tags:', 'choco' ) . ' ', ', ', '</p>' ); ?>
</div>
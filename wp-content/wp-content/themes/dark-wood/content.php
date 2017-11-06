<?php
/**
 * @package Dark_Wood
 * @since Dark Wood 1.0
 */
?>

<div class="post">

	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Permanent Link to' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

	<div class="post-content">
		<?php the_content( __( 'Read more&hellip;' ) ); ?>
	</div>

	<div class="post-pages">
		<?php wp_link_pages( array( 'before' => 'Part: ', 'after' => '', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>

	<div class="postmeta">
		<span class="date"><img src="<?php bloginfo( 'template_url' ); ?>/images/calendaricon.png" alt="" />&nbsp;<?php the_time( get_option( 'date_format' ) ); ?></span>
		<span class="author"><img src="<?php bloginfo( 'template_url' ); ?>/images/authoricon.png" alt="" />&nbsp;<?php the_author(); ?></span>
		<span class="comment">
			<img src="<?php bloginfo( 'template_url' ); ?>/images/commentsicon.png" alt="" />&nbsp;
			<?php comments_popup_link( __( 'Leave a comment' ), __( '1 Comment', 'theme' ), __( '% Comments' ) ); ?>
		</span>
		<?php edit_post_link( __( 'Edit this' ), '<span class="edit">', '</span>' ); ?>
		<div class="taxonomy">
			<span class="categories"><?php _e( 'Categories:' ); ?>&nbsp;<?php the_category( ', ' ); ?></span>
			<?php the_tags( '<span class="tags">' . __( 'Tags:' ).'&nbsp;',', ','</span>' ); ?>
		</div>
	</div><!-- /postmeta -->

</div><!-- /post -->
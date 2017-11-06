<?php
/**
 * @package Modularity-Lite
 */
 ?>

<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="content">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<div class="entry">
			<?php the_content( __( 'Read the rest of this page &raquo;', 'modularity' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'modularity' ), 'after' => '</div>' ) ); ?>
		</div>
		<div class="clear"></div>
		<p class="postmetadata alt quiet">
			<span class="byline">
				<?php
					printf( __( 'Posted by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'modularity' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %s', '_s' ), get_the_author() ) ),
						esc_html( get_the_author() )
					);
				?>
				&nbsp;|&nbsp;
			</span>
			<?php
				$tag_list = get_the_tag_list( '| Tags: ', ', ' );
				printf( __( '%1$s | Categories: %2$s %3$s | ', 'modularity' ),
					get_the_time( get_option( 'date_format' ) ),
					get_the_category_list( ', ' ),
					$tag_list
				);
			?>
			<?php comments_popup_link( __( 'Leave A Comment &#187;', 'modularity' ), __( '1 Comment &#187;', 'modularity' ), __( '% Comments &#187;', 'modularity' ) ); ?>
			<?php edit_post_link( __( ' Edit', 'modularity'), '| ', '' ); ?>
		</p>
	</div>
</div>
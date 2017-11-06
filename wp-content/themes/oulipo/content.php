<?php
/**
 * @package Oulipo
 * @since Oulipo 1.1
 */
 ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oulipo' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
				<p class="date"><?php the_time( get_option( 'date_format' ) ); ?> <?php comments_popup_link( '<span class="sep">&sect;</span> <span class="commentcount">' . __( 'Leave a Comment', 'oulipo' ) . '</span>', '&sect; <span class="commentcount">' . __( '1 Comment', 'oulipo' ) . '</span>', '&sect; <span class="commentcount">' . __( '% Comments', 'oulipo' ) . '</span>' ); ?></p>

				<div class="entry">
					<?php the_content( __( '&laquo; Read the rest of this entry &raquo;', 'oulipo' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<p>Page: ', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
				</div>
			</div><!-- close post_class -->
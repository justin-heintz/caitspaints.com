<?php
/**
 * @package Notepad
 * @since Notepad 1.2.0
 */
 ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2 class="post-title">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
			<p class="post-date">
				<?php the_time( get_option( 'date_format' ) ) ?>
			</p>
			<p class="post-data">
				<span class="postauthor">
					<?php the_author_link(); ?>
				</span>
				<span class="postcategory">
					<?php the_category( ', ' ) ?>
				</span>
				<?php the_tags( '<span class="posttag">', ', ', '</span>' ); ?>
				<span class="postcomment">
					<?php comments_popup_link(__( 'Leave a comment', 'notepad-theme' ), __( '1 Comment', 'notepad-theme' ), __( '% Comments', 'notepad-theme' ) ); ?>
				</span>
				<?php edit_post_link(__( '[Edit]', 'notepad-theme' ) ); ?>
			</p>
			<div class="post-content">
				<?php the_content(__( 'More', 'notepad-theme' ) ); ?>
			</div>
		</div>
		<!--/post -->
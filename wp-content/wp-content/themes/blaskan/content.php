<?php
/**
 * @package Blaskan
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<?php if ( has_post_thumbnail() && !is_single() ) : ?>
				<figure class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</figure>
			<?php endif; ?>

			<?php if ( get_post_type() !== 'page' ): ?>
				<time datetime="<?php the_date( 'c' ); ?>" pubdate><?php print get_the_date(); ?></time>
			<?php endif; ?>

			<?php if ( !is_single() && get_the_title() ) : ?>
				<h1>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ) ); ?>">
						<?php the_title(); ?>
					</a>
				</h1>
			<?php elseif ( get_the_title() ): ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
		</header>

		<div class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blaskan' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<nav class="page-link" role="navigation">' . __( 'Pages:', 'blaskan' ), 'after' => '</nav>' ) ); ?>

			<?php if ( !is_single() && !get_the_title() ) : ?>
				<p>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ) ); ?>">
					<?php _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blaskan' ); ?>
					</a>
				</p>
			<?php endif; ?>
		</div>
		<!-- / .content -->

		<footer>
			<?php if ( get_post_type() !== 'page' ): ?>
				<span class="author"><span class="author-label"><?php _e( 'Written by', 'blaskan' ); ?></span> <?php the_author_posts_link(); ?></span>
			<?php endif; ?>
			<?php if ( !is_single() ): ?>
				<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
					<span class="comments"><?php comments_popup_link( __( 'Leave a Comment', 'blaskan' ), __( '<span>1</span> Comment', 'blaskan' ), __( '<span>%</span> Comments', 'blaskan' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( count( get_the_category() ) ) : ?>
				<span class="categories">
					<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'blaskan' ), 'categories-label', get_the_category_list( ', ' ) ); ?>
				</span>
			<?php endif; ?>
			<?php
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ):
			?>
				<span class="tags">
					<?php printf( __( '<span class="%1$s">Tagged with</span> %2$s', 'blaskan' ), 'tags-label', $tags_list ); ?>
				</span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit">', '</span>' ); ?>
		</footer>
	</article>
	<!-- / #post-<?php the_ID(); ?> -->
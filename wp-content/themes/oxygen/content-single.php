<?php
/**
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear-fix' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php oxygen_posted_on(); ?>
			<span class="sep">&middot;</span>
			<?php oxygen_posted_by(); ?>
			<span class="sep">&middot;</span>
			<?php
				$category_list = get_the_category_list( __( ', ', 'oxygen' ) );
				if ( ! oxygen_categorized_blog() ) :
					$meta_text = __( 'Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'oxygen' );
				else :
					$meta_text = __( 'in %1$s.', 'oxygen' );
				endif; // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
			?>
			<span class="sep">&middot;</span>
			<?php edit_post_link( __( 'Edit', 'oxygen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clear-fix">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'oxygen' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) :
	?>
		<footer class="entry-meta">
			<?php printf( __( 'Tags: %1$s', 'oxygen' ), $tag_list ); ?>
		</footer><!-- .entry-meta -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

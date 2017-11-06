<?php
/**
 * Default post template.
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-full' ); ?>>

	<?php the_title( '<h1 class="entry-title"><a href="' . esc_attr( get_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '" rel="bookmark">', '</a></h1>' ); ?>

	<div class="entry-meta">
		<?php printf( '<a class="entry-author" href="%1$s" title="%2$s">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'ideation' ), get_the_author() ) ),
			esc_html( sprintf( __( 'By %1$s', 'ideation' ), get_the_author() ) )
		); ?>

		<a class="permalink" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo esc_html( get_the_date() ); ?></time></a>

		<?php the_tags( '<span class="tag-links">', ' ', '</span>' ); ?>

		<?php edit_post_link( __( 'Edit', 'ideation' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-author -->

	<div class="entry-content">

		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'ideation' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-taxonomy">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'ideation' ) );
			if ( $categories_list && ideation_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( 'Posted in %1$s', 'ideation' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>
	</footer><!-- #entry-taxonomy -->
</article><!-- #post-<?php the_ID(); ?> -->

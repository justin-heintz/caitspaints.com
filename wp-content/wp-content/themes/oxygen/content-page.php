<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content clear-fix">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'oxygen' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'oxygen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->

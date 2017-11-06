<?php
/**
 * @package Blaskan
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="content" role="main" <?php post_class(); ?>>

			<header>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</figure>
				<?php endif; ?>

				<?php if ( get_the_title() ): ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
			</header>

			<div class="content"><?php the_content(); ?></div>

			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'blaskan' ), 'after' => '</div>' ) ); ?>

			<footer>

				<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit-link">', '</span>' ); ?>

			</footer>

			<?php comments_template( '', true ); ?>

		</article>
		<!-- #content -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
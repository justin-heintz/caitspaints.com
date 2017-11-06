<?php
/**
 * @package Blaskan
 */
?>

<?php get_header(); ?>


		<article id="content" role="main" class="author">

		<?php if ( have_posts() ) the_post(); ?>

			<header>
				<?php echo blaskan_avatar( get_the_author_meta( 'user_email' ) ); ?>

				<h1 class="author-title"><?php the_author(); ?></h1>
			</header>

			<?php if ( get_the_author_meta( 'description' ) ): ?>
				<div class="author-description"><?php echo nl2br( get_the_author_meta( 'description' ) ); ?></div>
			<?php endif; ?>

      		<h2 class="author-posts"><?php _e( 'Posts', 'blaskan' ); ?></h2>
			<?php rewind_posts(); ?>
			<ul>
				<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ) ); ?>"><time datetime="<?php the_date( 'c' ); ?>"><?php print get_the_date(); ?></time></a>
				</li>
				<?php endwhile; ?>
			</ul>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav class="navigation" role="navigation">
					<div class="nav-previous"><?php next_posts_link( __( 'Older Posts', 'blaskan' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer Posts', 'blaskan' ) ); ?></div>
				</nav>
			<?php endif; ?>
		</article>
	<!-- / #content -->

	<?php get_sidebar(); ?>

	<?php get_footer(); ?>
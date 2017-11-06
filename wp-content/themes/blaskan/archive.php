<?php
/**
 * @package Blaskan
 */
?>

<?php get_header(); ?>

	<?php
		if ( have_posts() ) {
	?>

		<article id="content" role="main">
			<header class="archive-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) {
							printf( __( 'Category: <span>%s</span>', 'blaskan' ), single_cat_title( '', false ) );
						} elseif ( is_tag() ) {
							printf( __( 'Tagged: <span>%s</span>', 'blaskan' ), single_tag_title( '', false ) );
						} elseif ( is_day() ) {
							printf( __( 'Daily Archives: <time format="%s">%s</time>', 'blaskan' ), get_the_date( 'c' ), get_the_date( 'j F, Y' ) );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: <span>%s</span>', 'blaskan' ), get_the_date( 'F, Y' ) );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: <span>%s</span>', 'blaskan' ), get_the_date( 'Y' ) );
						} else {
							_e( 'Archives', 'blaskan' );
						}
					?>
				</h1>
			</header>
			<?php rewind_posts(); ?>
			<?php if( !is_category() && !is_tag() ) : ?>
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
			<?php else : ?>
				<?php get_template_part( 'loop' ); ?>
			<?php endif; ?>

		</article>
		<!-- / #content -->
	<?php } //have_posts ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<?php
/**
 * @package Yoko
 */

get_header(); ?>

<div id="wrap">
<div id="main" <?php yoko_sidebar_class(); ?>>

	<div id="content">
		<?php the_post(); ?>
		<?php get_template_part( 'content', 'page' ); ?>
		<?php comments_template( '', true ); ?>
	</div><!-- end content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
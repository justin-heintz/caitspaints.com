<?php
/**
 * @package WordPress
 * @subpackage Fjords
 */
?>
<?php get_header(); ?>
	<div id="content-inner">

	<?php if ( have_posts() ) : ?>

		<?php $post = $posts[ 0 ]; // Thanks Kubrick for this code ?>

		<?php if ( is_category() ) { ?>
		<h2><?php printf( __( 'Archive for %s', 'fjords' ), single_cat_title( '', false ) ); ?></h2>

 	  	<?php } elseif ( is_tag() ) { ?>
		<h2><?php printf( __( 'Archive for %s', 'fjords' ), single_tag_title( '', false ) ); ?></h2>

 	  	<?php } elseif ( is_day() ) { ?>
		<h2><?php printf( __( 'Archive for %s', 'fjords' ), get_the_time( 'F j, Y' ) ); ?></h2>

	 	<?php } elseif ( is_month() ) { ?>
		<h2><?php printf( __( 'Archive for %s', 'fjords' ), get_the_time( 'F, Y' ) ); ?></h2>

		<?php } elseif ( is_year() ) { ?>
		<h2><?php printf( __( 'Archive for %s', 'fjords' ), get_the_time( 'Y' ) ); ?></h2>

		<?php } elseif ( is_author() ) { ?>
		<h2><?php _e( 'Author Archive', 'fjords' ); ?></h2>

		<?php } elseif ( is_search() ) { ?>
		<h2><?php _e( 'Search Results', 'fjords' ); ?></h2>

		<?php } ?>

		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
		?>

		<div class="navigation">
			<?php posts_nav_link( ' &#183; ',  __('&laquo; Newer entries', 'fjords' ), __( 'Older entries &raquo;', 'fjords' ), '' ); ?>
		</div>

	<?php else : ?>

		<h2><?php _e( 'Not Found', 'fjords' ); ?></h2>

		<p><?php _e( 'Sorry, but no posts matched your criteria.', 'fjords' ); ?></p>

		<h3><?php _e( 'Search', 'fjords' ); ?></h3>

		<?php get_search_form(); ?>

	<?php endif; ?>

	</div><!-- #content-inner -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

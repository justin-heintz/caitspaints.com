<?php
/**
 * @package WordPress
 * @subpackage Under_the_Influence
 */

	get_header();

	global $options, $uti_author;
	foreach ($options as $value) {
		if (array_key_exists('id',$value)) {
			if (get_option( $value['id'] ) === FALSE) {
				$$value['id'] = $value['std'];
			} else {
				$$value['id'] = get_option( $value['id'] );
			}
		}
	}

	$uti_author = $uti_show_author;
	$column = $uti_column;
	$columnwidth = $uti_column_width;
	if ( 'on' == $column )
		$content_width = 370;
	else
		$content_width = $columnwidth;
?>
<div id="content_container">
<?php get_sidebar(); ?>
	<?php if (have_posts()) : ?>
		<div id="content" class="mainpage">
			<?php while (have_posts()) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
		</div><!--#content-->

		<div class="navigation_box">
	  		<div class="navigation bottom">
				<?php next_posts_link( __( '&laquo; Older Entries', 'uti_theme' ) ); ?>&nbsp;&nbsp;&#124;&nbsp;&nbsp;
				<?php previous_posts_link( __( 'Newer Entries &raquo;', 'uti_theme' ) ); ?>
			</div><!--.navigation-->
		</div><!--.navigation_box-->
	<?php else : ?>
		<!-- no posts found -->
		<div class="center">
			<h2>
				<?php _e('Not found', 'uti_theme')?>
			</h2>
			<p>
				<?php _e('Sorry, but you are looking for something that isn&rsquo;t here.', 'uti_theme')?>
			</p>
			<?php get_search_form(); ?>
		</div><!--.center-->
	<?php endif; ?>
</div><!--#content_container-->


<?php get_footer(); ?>
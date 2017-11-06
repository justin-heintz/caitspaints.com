<?php
/**
 * @package Benevolence
 */

get_header(); ?>
<?php get_sidebar(); ?>
<div id="content">

<?php
if (have_posts()) {
	while(have_posts()) {
		the_post();
?>

	<?php get_template_part( 'content' ); ?>

<?php } // closes printing entries with excluded cats ?>

<?php } else { ?>
<?php _e('Sorry, no posts matched your criteria.', 'benevolence'); ?>
<?php } ?>
	<div class="post-navigation">
		<div class="left"><?php next_posts_link( '&laquo; Older Posts' ); ?></div>
		<div class="right"><?php previous_posts_link( 'Newer Posts &raquo;' ); ?></div>
	</div><!-- .post-navigation -->

<br /><br />

</div>

<?php get_footer(); ?>

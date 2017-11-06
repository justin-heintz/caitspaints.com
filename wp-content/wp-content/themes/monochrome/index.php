<?php
/*
 * @package monochrome
 */

 get_header(); ?>

<div id="contents" class="clearfix">

	<div id="left_col">
	<?php $options = get_option('mc_options'); ?>
	<?php
		global $odd_or_even;
		$odd_or_even = 'odd' ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; else: ?>
    <div class="post_odd">
    	<div class="post clearfix">
      		<div class="post_content_wrapper">
       			<?php _e("Sorry, but you are looking for something that isn't here.","monochrome"); ?>
      		</div>
      		<div class="post_meta">
      		</div>
     	</div>
    </div>
<?php endif; ?>

    <div class="content_noside">
    	<?php include('navigation.php'); ?>
	</div>

</div><!-- #left_col end -->

	<?php get_sidebar(); ?>

</div><!-- #contents end -->

<div id="footer">
	<?php get_footer(); ?>
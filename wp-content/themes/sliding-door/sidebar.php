<?php /** * The Sidebar containing the primary and secondary widget areas. * 
 * @package Sliding_Door
*  @since Sliding Door 1.0 */ ?>


<div id="sidebar2" class="widget-area" role="complementary"> <ul class="xoxo"> <?php if ( ! dynamic_sidebar( 'secondary-widget-area' ) ) : ?>


<li class="widget-container"> <h3 class="widget-title"><?php _e( 'Categories', 'slidingdoor' ); ?></h3> <ul> <?php

wp_list_categories(array('title_li' => ''));

?>

</ul> </li>


<?php endif; ?> </ul> </div><!-- #secondary .widget-area -->

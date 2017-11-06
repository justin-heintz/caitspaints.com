<?php
/**
 * @package Koi
 */
?>

<div <?php post_class(); ?>>
	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<p class="post-date"><span class="day"><?php the_time( 'd' ); ?></span> <span class="month"><?php the_time( 'M' ); ?></span> <span class="year"><?php the_time( 'Y' ); ?></span> <span class="postcomment"><?php comments_popup_link( __( 'Leave a Comment', 'ndesignthemes' ), __( '1 Comment', 'ndesignthemes' ), __( '% Comments', 'ndesignthemes' ) ); ?></span></p>
	<p class="post-data">
		<span class="postauthor"><?php printf( __( 'by %1$s', 'ndesignthemes' ), sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url( get_the_author_meta( 'ID' ) ), esc_attr( sprintf( __( 'View all posts by %s', 'ndesignthemes' ), get_the_author() ) ), get_the_author() ) ); ?></span>
		<span class="postcategory"><?php printf( __( 'in %1$s', 'ndesignthemes' ), get_the_category_list( ', ' ) ); ?></span>
		<span class="posttag"><?php the_tags( __( 'Tags: ', 'ndesignthemes' ), ', ' ); ?></span>
		<?php edit_post_link( __( '[Edit]', 'ndesignthemes' ) ); ?>
	</p>
	<?php the_content( __( 'More', 'ndesignthemes' ) ); ?>
</div><!--/post -->

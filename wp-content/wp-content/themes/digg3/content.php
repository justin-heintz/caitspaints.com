<?php
/**
 * @package Digg_3_Column
 * @since Digg 3 Column 1.0.2
 */
?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'digg3' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>

	<div class="postinfo">
		<?php printf( __( 'Posted on %s by %s', 'digg3' ), '<span class="postdate">'.get_the_time( get_option( 'date_format' ) ).'</span>', get_the_author() ); ?>
<?php edit_post_link( __( 'Edit', 'digg3' ), ' &#124; ', '' ); ?>
	</div>

	<div class="entry">

		<?php the_content( __( 'Read more &raquo;', 'digg3' ) ); ?>

		<p class="postinfo">
			<?php printf( __( 'Filed under: %1$s &#124; %2$s', 'digg3' ), get_the_category_list( __( ', ' , 'digg3' ) ), get_the_tag_list( __( 'Tagged:' , 'digg3' ) . ' ', __( ', ' , 'digg3' ), ' &#124;' ) ); ?> <?php comments_popup_link( __( 'Leave a Comment &#187;', 'digg3' ), __( '1 Comment &#187;', 'digg3' ), __( '% Comments &#187;', 'digg3' ) ); ?>
		</p>

	</div>
</div>
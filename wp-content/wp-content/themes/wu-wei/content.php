<?php
/**
 * @package Wu_Wei
 * @since Wu_Wei 1.2.4
 */
?>

<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-info">

		<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wu-wei' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h1>
		<?php if ( is_multi_author() ) { ?>
			<div class="archive-byline">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'wu-wei' ), get_the_author_meta( 'display_name' ) ) ); ?>">
					<?php echo esc_html( sprintf( __( 'By %1$s', 'wu-wei' ), get_the_author_meta( 'display_name' ) ) ) ?>
				</a>
			</div>
		<?php } ?>
		<div class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?> //</div> <?php if ( comments_open() ) : ?><div class="comment-bubble"><?php comments_popup_link( '0', '1', '%' ); ?></a></div><?php endif; ?>
		<div class="clearboth"><!-- --></div>

		<?php edit_post_link( __( 'Edit this entry', 'wu-wei' ), '<p>', '</p>' ); ?>

	</div>

	<div class="post-content">
		<?php the_content( __( 'Read the rest of this entry &raquo;', 'wu-wei' ) ); ?>

		<?php wp_link_pages( array('before' => '<p><strong>' . __( 'Pages:', 'wu-wei' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>

	<div class="clearboth"><!-- --></div>

	<?php the_tags( '<div class="post-meta-data">' . __( 'Tags', 'wu-wei' ) . ' <span>', ', ', '</span></div>' ); ?>

	<div class="post-meta-data"><?php _e( 'Categories', 'wu-wei' ); ?> <span><?php the_category(', '); ?></span></div>

</div><!-- #post-<?php the_ID(); ?> -->
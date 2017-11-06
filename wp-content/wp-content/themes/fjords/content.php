<div <?php post_class(); ?>>

	<h2 class="post-titulo" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'fjords' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>

	<p class="postmeta"><?php printf( __( '%1$s at %2$s', 'fjords' ), get_the_time( get_option( 'date_format' ) ), get_the_time() ); ?> &#183; <?php _e( 'Filed under' ); ?> <?php the_category( ', ' ); ?> <?php the_tags( __( 'and tagged: ', 'fjords' ), ', ', '' ); ?> <?php edit_post_link( __( 'Edit', 'fjords' ), ' &#183; ', '' ); ?></p>

	<?php
		if ( is_search() )
			the_excerpt();
		else
			the_content( __( 'Read the rest of this entry &raquo;', 'fjords' ) );
	?>

	<p class="comentarios-link"><?php comments_popup_link( __( 'Comments', 'fjords' ), __( 'Comments (1)', 'fjords' ), __( 'Comments (%)', 'fjords' ), 'commentslink', __( 'Comments off', 'fjords' ) ); ?></p>

</div>
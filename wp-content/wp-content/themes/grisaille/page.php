<?php
/**
 * @package Grisaille
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      	<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h1>
       	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'grisaille' ), __( '1', 'grisaille' ), '%' ); ?></span>
		<?php endif; ?>
		<div class="bottom-border"></div>
       	<div class="post-wrap">
      		<?php the_content(); ?>
      		<?php wp_link_pages(
					array(	'before'           => '<p class="pages-links">' . __( 'Pages:', 'grisaille' ),
							'after'            => '</p>',
							'next_or_number'   => 'number',
							'nextpagelink'     => __( 'Next page', 'grisaille' ),
							'previouspagelink' => __( 'Previous page', 'grisaille' ),
							'pagelink'         => '%' ) ); ?>
      	</div>
		<p class="post-meta"><?php edit_post_link( __( 'Edit', 'grisaille' ), '' ); ?></p>
    </div><!-- end #post-id -->

	  <?php

		if ( comments_open() || have_comments() ) {
   			comments_template();
}
?>

<?php endwhile; else: ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'grisaille' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>
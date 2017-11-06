<?php
/*
 * @package monochrome
 */

global $odd_or_even;

?>
<div <?php post_class("post_$odd_or_even") ?>>
	<div class="post clearfix">
		<div class="post_content_wrapper">
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<div class="post_content">
				<?php the_content( __( 'Read more', 'monochrome' ) ); ?>
				<?php wp_link_pages( 'before=<div class="page-link">' . __('Pages:') . '&after=</div>' ); ?>
			</div>
		</div>
		<dl class="post_meta">
			<dt class="meta_date"><?php the_time( 'Y' ) ?></dt>
			<dd class="post_date"><?php the_time( 'm' ) ?><span>/<?php the_time( 'd' ) ?></span></dd>
			<?php if ( $options['author'] ) : ?>
				<dt><?php _e( 'POSTED BY','monochrome' ); ?></dt>
				<dd><?php the_author_posts_link(); ?></dd>
			<?php endif; ?>
        <dt><?php _e( 'CATEGORY','monochrome' ); ?></dt>
         <dd><?php the_category( '<br />' ); ?></dd>
        <?php if ( $options['tag'] ) : ?>
         <?php the_tags( __( '<dt>TAGS</dt><dd>','monochrome' ),'<br />','</dd>' ); ?>
        <?php endif; ?>
        <dt class="meta_comment"><?php comments_popup_link( __( 'Leave a comment', 'monochrome' ), __( '1 comment', 'monochrome' ), __( '% comments', 'monochrome' ) ); ?></dt>
         <?php edit_post_link( __( '[ EDIT ]', 'monochrome' ), '<dd>', '</dd>' ); ?>
      </dl>
     </div>
    </div>

<?php $odd_or_even = ( 'odd' == $odd_or_even ) ? 'even' : 'odd'; ?>
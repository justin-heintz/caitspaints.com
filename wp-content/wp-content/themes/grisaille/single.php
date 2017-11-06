<?php
/**
 * @package Grisaille
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>

      	<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title=" title="<?php echo esc_attr( get_the_title() ); ?>""><?php the_title(); ?></a></h1>
       	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'grisaille' ), __( '1', 'grisaille' ), '%' ); ?></span>
		<?php endif; ?>
        <p class="the-date"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a> <?php _e( 'by', 'grisaille' ); ?> <?php the_author(); ?></p>

		<div class="post-wrap">
			<?php the_content(); ?>
			<?php wp_link_pages(
      			  array(	'before'           => '<p class="pages-links">' . __( 'Pages:', 'grisaille' ),
    						'after'            => '</p>',
      						'next_or_number'   => 'number',
    						'nextpagelink'     => __( 'Next page', 'grisaille' ),
    						'previouspagelink' => __( 'Previous page', 'grisaille' ),
    						'pagelink'         => '%' ) ); ?>
		</div><!-- end .post-wrap -->
	  	<p class="post-meta">
			<small>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'grisaille' ) );
					if ( $categories_list ) :
				?>
				<span class="cat-links">
					<?php printf( __( 'Category: %1$s', 'grisaille' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'grisaille' ) );
					if ( $tags_list ) :
				?>
				<span class="sep"> | </span>
				<span class="tag-links">
					<?php printf( __( 'Tags: %1$s', 'grisaille' ), $tags_list ); ?>
				</span>
				<?php endif; // End if $tags_list ?>
				<?php edit_post_link( __( 'Edit', 'grisaille' ), ' | ' ); ?>
			</small>
		</p><!-- end .post-meta -->


    </div><!-- end #post-id -->

    <div class="post-link">
 		<div class="pagination-newer"><?php next_post_link( '%link &raquo;' ); ?></div>
		<div class="pagination-older"><?php previous_post_link( '&laquo; %link' ); ?></div>
	</div>

	<?php comments_template(); ?>

<?php endwhile; else: ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'grisaille' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>
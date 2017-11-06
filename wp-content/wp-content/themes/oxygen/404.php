<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

get_header(); ?>

<div id="primary" class="site-content full-width">
	<div id="content" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'oxygen' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'oxygen' ); ?></p>

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<div class="widget">
					<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'oxygen' ); ?></h2>
					<ul>
					<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
					</ul>
				</div>

				<?php
				/* translators: %1$s: smilie */
				$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'oxygen' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
				?>

			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	</div><!-- #content -->
</div><!-- #primary .site-content -->

<?php get_footer(); ?>
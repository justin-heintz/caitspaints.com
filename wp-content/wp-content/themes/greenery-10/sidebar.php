</div>

<div id="sidebar">
<?php do_action( 'before_sidebar' ); ?>
<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : ?>
</ul>
</div>
<?php else : ?>

	<!-- Search -->
	<li id="sb-search" class="widget widget_search">
		<h2><?php _e('Search'); ?></h2>
		<?php get_search_form(); ?>
	</li>


	<!-- Recent Posts -->
	<?php
				$r = new WP_Query(array('showposts' => '10', 'post_type' => 'any', 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
				if ($r->have_posts()) :	?>
	<li id="sb-posts" class="widget widget_recent_entries">
	<h2><?php _e("Latest"); ?></h2>
			<ul>
					<?php  while ($r->have_posts()) : $r->the_post(); ?>
						<?php if ( !( $post->post_type == ('post') || $post->post_type == ('page') ) ) continue;?>
						<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></li>
					<?php endwhile; ?>
		</ul>
	</li>
	<?php wp_reset_query(); ?>
	<?php endif; ?>


	<!-- Archives -->
	<li id="sb-archives" class="widget widget_archive">
		<h2><?php _e('Archives'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
		</ul>
	</li>


	<!-- Categories -->
	<li id="sb-cates" class="widget widget_categories">
		<h2><?php _e('Categories'); ?></h2>
		<ul>
			<?php wp_list_cats('sort_column=id&hide_empty=0&optioncount=1&hierarchical=1'); ?>
		</ul>
	</li>


	<!-- Feeds -->
	<li id="sb-feeds" class="widget widget_rss_links">
		<h2><?php _e('Feeds'); ?></h2>
		<ul>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php esc_attr_e( 'Syndicate this site using RSS 2.0' ); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php esc_attr_e( 'The latest comments to all posts in RSS 2.0' ); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
			</li>
		</ul>
	</li>


	<!-- Links -->
	<?php wp_list_bookmarks('class=widget') ?>


	<!-- Misc -->
	<li id="sb-misc" class="widget widget_meta">
		<h2><?php _e('Misc'); ?></h2>
		<ul>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</li>

</ul>

</div>
<?php endif; ?>
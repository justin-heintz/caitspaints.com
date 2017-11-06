<?php get_header(); ?>

	<div id="main">
	<div id="content">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<div class="navigation">
			<p align="center"><?php posts_nav_link() ?></p>
		</div>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
</div>
</div>
</body>
</html>

<?php get_header(); ?>

	<div class="narrowcolumnwrapper"><div class="narrowcolumn">

		<div id="content" class="content">

			<?php if ( have_posts() ) : ?>
				
				<?php while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'browse' ); ?>

			<?php else : ?>

				<div <?php post_class(); ?>>

					<h2><?php _e( 'Not Found', 'digg3' ); ?></h2>
	
					<div class="entry">
						<p><?php _e('Sorry, but you are looking for something that isn&#39;t here.', 'digg3'); ?></p>
					</div>

				</div>

			<?php endif; ?>

		</div><!-- End content -->

	</div></div><!-- End narrowcolumnwrapper and narrowcolumn classes -->

<?php get_footer(); ?>
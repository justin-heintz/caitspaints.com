<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content' );
			?>

		<?php endwhile; ?>

			<div class="navigation">
				<div class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries', 'wu-wei' ) ); ?></div>
				<div class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'wu-wei' ) ); ?></div>
				<div class="clearboth"><!-- --></div>
			</div>

	<?php else : ?>

		<div class="post">

			<div class="post-info">

				<h1><?php _e( 'Not Found', 'wu-wei' ); ?></h1>

			</div>

			<div class="post-content">
				<p><?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here.', 'wu-wei'  ); ?></p>

				<?php get_search_form(); ?>
			</div>

			<div class="clearboth"><!-- --></div>

		</div>

	<?php endif; ?>
	
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
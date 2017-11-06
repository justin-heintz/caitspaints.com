<?php
/**
 * @package Origin
 */
?>
			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

		</div><!-- #main -->

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (  is_active_sidebar( 'footer-1'  )
		|| is_active_sidebar( 'footer-2' )
		|| is_active_sidebar( 'footer-3'  )
		|| is_active_sidebar( 'footer-4'  )
	) :
?>
		<div class="sidebar-subsidiary-wrapper">
			<?php get_sidebar( 'footer-1' ); ?>
			<?php get_sidebar( 'footer-2' ); ?>
			<?php get_sidebar( 'footer-3' ); ?>
			<?php get_sidebar( 'footer-4' ); ?>
		</div>
<?php endif; ?>

		<div id="footer">
			<div id="site-generator">
				<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a><br />
				<?php printf( __( 'Theme: %1$s by %2$s.', 'origin' ), 'Origin', '<a href="http://devpress.com" rel="designer">DevPress</a>' ); ?>
			</div><!-- #site-generator -->

		</div><!-- #footer -->

		</div><!-- .wrap -->

	</div><!-- #container -->

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
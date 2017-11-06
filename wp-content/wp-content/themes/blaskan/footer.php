<?php
/**
 * @package Blaskan
 */
?>
		<footer id="footer">
			<?php get_sidebar( 'footer' ); ?>
			<nav id="footer-nav" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'depth' => 1, 'fallback_cb' => false, 'container' => false ) ); ?>
			</nav>
			<div class="colophon">
				<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a> |
				<?php printf( __( 'Theme: %1$s by %2$s.', 'blaskan' ), 'Blaskan', '<a href="http://www.helloper.com" rel="designer">Per Sandstr&ouml;m</a>' ); ?>
			</div>
		</footer>
		<!-- / #footer -->
	</div>
	<!-- / #wrapper -->
</div>
<!-- / #site -->

<?php wp_footer(); ?>
</body>
</html>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>

	</div><!-- #main -->

	<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with three columns of widgets.
		 */
		if ( ! is_404() )
			get_sidebar( 'footer' );
	?>

	<footer id="colophon" class="site-footer clear-fix" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'oxygen_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'oxygen' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'oxygen' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'oxygen' ), 'Oxygen', '<a href="http://devpress.com/" rel="designer">DevPress</a>' ); ?>
		</div><!-- .site-info -->
		<?php if ( has_nav_menu( 'tertiary' ) ) : ?>
			<nav class="menu-tertiary">
				<?php wp_nav_menu( array( 'theme_location' => 'tertiary', 'depth' => 1 ) ); ?>
			</nav><!-- #menu-subsidiary .menu-container -->
		<?php endif; ?>
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
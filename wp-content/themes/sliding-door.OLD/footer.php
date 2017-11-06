<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Sliding_Door
 * @since Sliding Door 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

	<div id="welcomeheading">
					<h1><a href="<?php bloginfo('url'); ?>/">
  					 <img src="http://i.imgur.com/ugU5o.jpg"> 


			<div id="site-generator">
			
		<p>Powered by <a href="http://wordpress.org/">Wordpress</a> and <a href="http://macintoshhowto.com/about">Sliding Door</a> theme.</p>

<p>Cait's Paints <a href="http://caitspaints.com/terms-of-service/">Terms of Service.</a> </p>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
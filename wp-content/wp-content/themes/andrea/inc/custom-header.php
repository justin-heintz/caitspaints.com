<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Andrea
 * @since Andrea 0.4
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses andrea_header_style()
 * @uses andrea_admin_header_style()
 * @uses andrea_admin_header_image()
 *
 * @package Andrea
 */
function andrea_custom_header_setup() {
	$options = andrea_get_theme_options();
	if ( 'fixed-width' == $options['layout_choice'] ) {
		$width = 690;
		$height = 145;
	} else {
		$width = 1270;
		$height = 260;
	}
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '4e8abe',
		'width'                  => $width,
		'height'                 => $height,
		'flex-height'            => true,
		'wp-head-callback'       => 'andrea_header_style',
		'admin-head-callback'    => 'andrea_admin_header_style',
		'admin-preview-callback' => '',
	);

	$args = apply_filters( 'andrea_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'] );
	}
}
add_action( 'after_setup_theme', 'andrea_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Andrea
 * @since Andrea 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'andrea_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see andrea_custom_header_setup().
 *
 * @since Andrea 0.4
 */
function andrea_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php if ( '' != get_header_image() ) { ?>
		#header img {
			max-width: 100%;
		}
		#header {
			position: relative;
		}
		#header h1 {
			position: absolute;
				top: 0;
				left: 20px;
			color: #<?php header_textcolor(); ?>;
		}
	<?php } ?>
	<?php if ( 'blank' != get_header_textcolor() ) { ?>
		#header h1 {
			color: #<?php header_textcolor(); ?>;
		}
	<?php } else { ?>
		#header h1, #header h1 a {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php } ?>
	</style>
	<?php
}
endif; // andrea_header_style

if ( ! function_exists( 'andrea_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see andrea_custom_header_setup().
 *
 * @since Andrea 0.4
 */
function andrea_admin_header_style() {
?>
	<style type="text/css">
		#headimg {
			background-color: #00355f;
			background-repeat: no-repeat;
		}
		#headimg h1, #headimg h1 a, #headimg #desc {
			font-size: 22px;
			font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
			letter-spacing: -1px;
			line-height: 27px;
			margin: 0;
			padding: 10px 5px;
		}
		#headimg h1 {
			float: left;
		}
		#headimg h1 a {
			color: #fff !important;
			text-decoration: none;
		}
		#headimg #desc {
			float: left;
		}
	</style>
<?php
}
endif; // andrea_admin_header_style
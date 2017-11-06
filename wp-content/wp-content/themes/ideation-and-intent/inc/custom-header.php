<?php
/**
 * Implementation of the Custom Header feature.
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */


/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses ideation_header_style()
 * @uses ideation_admin_header_style()
 * @uses ideation_admin_header_image()
 *
 * @package IdeationAndIntent
 */
function ideation_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => 'fc5600',
		'width'                  => 1124,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'ideation_header_style',
		'admin-head-callback'    => 'ideation_admin_header_style',
		'admin-preview-callback' => 'ideation_admin_header_image',
	);

	$args = apply_filters( 'ideation_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'ideation_custom_header_setup' );

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
 * @package Ideation and Intent
 * @since Ideation and Intent 1.0
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

function ideation_custom_header_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' == $hook_suffix )
		wp_enqueue_style( 'ideation-dosis' );
}
add_action( 'admin_enqueue_scripts', 'ideation_custom_header_fonts' );

/**
 * Styles the header image and text displayed on the blog
 *
 * @since Ideation and Intent 1.0
 */
function ideation_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced in ideation_setup().
 *
 * @since Ideation and Intent 1.0
 */
function ideation_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		<?php echo 'background-color: ' . esc_html( ideation_get_background_color() ) . ';'; ?>
		<?php if ( $url = get_background_image() )
			echo 'background-image: url( "' . esc_url( $url ) . '" );';
		?>
		box-shadow: inset 0 10px 15px rgba( 0, 0, 0, .15 );
		padding: 30px;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {

	}
	#headimg h1 a {
		font-family: 'Dosis', sans-serif;
		font-size: 54px;
		font-weight: 700;
		line-height: 1;
		margin: 0;
		text-shadow: 1px 1px 0 <?php echo ideation_get_background_color(); ?>, 3px 3px 0 rgba(0, 0, 0, 0.3) !important;
		text-decoration: none;
		text-transform: uppercase;
	}
	#desc {
		color: rgba( 0, 0, 0, 0.4 ) !important;
		font-family: 'Dosis', sans-serif;
		font-size: 14px;
		line-height: 1.4;
		margin: 15px 0 0 6px;
		text-transform: uppercase;
	}
	#headimg img {
		background-clip: padding-box;
		border: 6px solid rgba( 255, 255, 255, 0.5 );
		border-radius: 6px;
		margin-top: 25px;
	}
	</style>
<?php
}

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in ideation_setup().
 *
 * @since Ideation and Intent 1.0
 */
function ideation_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
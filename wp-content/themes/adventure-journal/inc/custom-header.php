<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Adventurejournal
 * @since Adventurejournal 2.1
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses adventurejournal_header_style()
 * @uses adventurejournal_admin_header_style()
 * @uses adventurejournal_admin_header_image()
 *
 * @package adventurejournal
 * @since Adventurejournal 2.1
 */
function adventurejournal_custom_header_setup() {
	$args = array(
		'header-text'         => false,
		'default-image'       => '%s/images/headers/header-egypt.jpg',
		'default-text-color'  => '000',
		'width'               => 920,
		'height'              => 360,
		'flex-height'         => true,
		'admin-head-callback' => '__return_false',
		'wp-head-callback'    => 'adventurejournal_header_style',
	);

	$args = apply_filters( 'adventurejournal_custom_header_args', $args );

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

	register_default_headers( array(
		'egypt' => array(
			'url' => '%s/images/headers/header-egypt.jpg',
			'thumbnail_url' => '%s/images/headers/header-egypt-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Egypt', 'adventurejournal' )
		),
		'cart' => array(
			'url' => '%s/images/headers/header-cart.jpg',
			'thumbnail_url' => '%s/images/headers/header-cart-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cart', 'adventurejournal' )
		),
		'flower' => array(
			'url' => '%s/images/headers/header-flower.jpg',
			'thumbnail_url' => '%s/images/headers/header-flower-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Flower', 'adventurejournal' )
		),
		'hut' => array(
			'url' => '%s/images/headers/header-hut.jpg',
			'thumbnail_url' => '%s/images/headers/header-hut-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hut', 'adventurejournal' )
		)
	) );
}
add_action( 'after_setup_theme', 'adventurejournal_custom_header_setup' );

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
 * @package Adventurejournal
 * @since Adventurejournal 2.1
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

/**
 * Custom Header Styles.
 *
 * We need to dynamically adjust the positioning of the
 * content wrapper when the custom header image is greater
 * than 360 pixels.
 *
 * Hooks into the "wp_head" action via add_theme_support().
 *
 * @package Adventurejournal
 * @since Adventurejournal 2.1
 */
function adventurejournal_header_style() {
	$height = get_custom_header()->height
?>
	<style>
	#wrapper-content {
		margin-top: -<?php echo absint( $height + 13 ); ?>px;
		padding-top: <?php echo absint( $height + 15 ); ?>px;
	}
	</style>
<?php
}
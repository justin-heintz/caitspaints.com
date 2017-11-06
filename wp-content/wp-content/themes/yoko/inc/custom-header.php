<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package yoko
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses yoko_header_style()
 * @uses yoko_admin_header_style()
 * @uses yoko_admin_header_image()
 *
 * @package yoko
 */
function yoko_custom_header_setup() {
	$args = array(
		'default-image'          => get_template_directory_uri() . '/images/headers/ginko.jpg',
		'default-text-color'     => '',
		'width'                  => 1102,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'yoko_header_style',
		'admin-head-callback'    => 'yoko_admin_header_style',
		'admin-preview-callback' => 'yoko_admin_header_image',
	);

	$args = apply_filters( 'yoko_custom_header_args', $args );

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

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 350 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'ginko' => array(
			'url'           => '%s/images/headers/ginko.jpg',
			'thumbnail_url' => '%s/images/headers/ginko-thumbnail.jpg',
			'description'   => __( 'Ginko', 'yoko' )
		),
		'flowers' => array(
			'url'           => '%s/images/headers/flowers.jpg',
			'thumbnail_url' => '%s/images/headers/flowers-thumbnail.jpg',
			'description'   => __( 'Flowers', 'yoko' )
		),
		'plant' => array(
			'url'           => '%s/images/headers/plant.jpg',
			'thumbnail_url' => '%s/images/headers/plant-thumbnail.jpg',
			'description'   => __( 'Plant', 'yoko' )
		),
		'sailing' => array(
			'url'           => '%s/images/headers/sailing.jpg',
			'thumbnail_url' => '%s/images/headers/sailing-thumbnail.jpg',
			'description'   => __( 'Sailing', 'yoko' )
		),
		'cape' => array(
			'url'           => '%s/images/headers/cape.jpg',
			'thumbnail_url' => '%s/images/headers/cape-thumbnail.jpg',
			'description'   => __( 'Cape', 'yoko' )
		),
		'seagull' => array(
			'url'           => '%s/images/headers/seagull.jpg',
			'thumbnail_url' => '%s/images/headers/seagull-thumbnail.jpg',
			'description'   => __( 'Seagull', 'yoko' )
		)
	) );
}
add_action( 'after_setup_theme', 'yoko_custom_header_setup' );

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
 * @package yoko
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

if ( ! function_exists( 'yoko_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see yoko_custom_header_setup().
 */
function yoko_header_style() {

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
		#site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // yoko_header_style

if ( ! function_exists( 'yoko_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see yoko_custom_header_setup().
 */
function yoko_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#headimg #desc {
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-family: 'Droid Sans', arial, sans-serif;
		font-size: 34px;
		font-weight: bold;
		line-height: 40px;
		text-decoration: none;
		text-transform: uppercase;
	}
	#desc {
		color: #777;
		font-family: 'Droid Sans', arial, sans-serif;
		font-size: 14px;
		font-style: italic;
		padding-bottom: 15px;
	}
	#headimg img {
	}

	</style>
<?php
}
endif; // yoko_admin_header_style

if ( ! function_exists( 'yoko_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see yoko_custom_header_setup().
 */
function yoko_admin_header_image() { ?>
	<div id="headimg"<?php echo $display; ?>>
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // yoko_admin_header_image
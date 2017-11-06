<?php
/**
 * @package Grisaille
 * @since Grisaille 1.3.1-wpcom
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses grisaille_header_style()
 * @uses grisaille_admin_header_style()
 * @uses grisaille_admin_header_image()
 *
 * @package Grisaille
 */
function grisaille_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '334759',
		'width'                  => 960,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'grisaille_header_style',
		'admin-head-callback'    => 'grisaille_admin_header_style',
		'admin-preview-callback' => 'grisaille_admin_header_image',
	);

	$args = apply_filters( 'grisaille_custom_header_args', $args );

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
add_action( 'after_setup_theme', 'grisaille_custom_header_setup' );

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
 * @package Grisaille
 * @since Grisaille 1.3.1-wpcom
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

if ( ! function_exists( 'grisaille_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see grisaille_custom_header_setup().
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
        #site-title {
			min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	 	}
		#site-title h1 a {
		 	color: #<?php header_textcolor(); ?>;
		 	min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
		#site-description {
			color: #<?php header_textcolor(); ?>;
		}
 		<?php if ( 'blank' == get_header_textcolor() ) { ?>
 		#site-title h1 {
 			padding: 0;
 		}
		#site-title h1 a  {
			display: block;
			text-indent: -99999px;
		}
		#site-description {
			display: none;
			text-indent: -99999px;
		}
		<?php if ( 'blank' == get_header_textcolor() ) ?>
		#site-title {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		<?php } ?>
	</style>
	<?php
}
endif; // grisaille_header_style

if ( ! function_exists( 'grisaille_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see grisaille_custom_header_setup().
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_admin_header_style() {
	wp_enqueue_style( 'grisaille-fonts', 'http://fonts.googleapis.com/css?family=Marvel|Bevan' );
?>
	<style type="text/css">
		#headimg {
			margin: 0;
			width: 100%;
		}
		#headimg h1 {
			margin: 0;
			word-wrap: break-word;
        }
		#headimg h1 a {
			font: 70px Bevan, "Times New Roman", Times, serif;
			line-height: 70px;
			text-transform: uppercase;
			text-decoration: none;
		}
		#desc {
			font: 22px Geneva, Verdana, sans-serif;
			line-height: 52px;
   			word-wrap: break-word;
    	}
    	.masthead {
    		padding: 20px 0 0 0;
			width: 100%;
		}
    </style>
<?php
}
endif; // grisaille_admin_header_style

if ( ! function_exists( 'grisaille_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see grisaille_custom_header_setup().
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" />
		<?php endif; ?>
		<div class="masthead">
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		</div>
	</div>
<?php }
endif; // grisaille_admin_header_image
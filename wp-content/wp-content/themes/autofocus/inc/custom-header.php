<?php
/**
 * @package Autofocus
 * @since Autofocus 1.1
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses autofocus_header_style()
 * @uses autofocus_admin_header_style()
 * @uses autofocus_admin_header_image()
 *
 * @package Autofocus
 */

function autofocus_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '444',
		'width'                  => 800,
		'height'                 => 216,
		'flex-height'            => true,
		'wp-head-callback'       => 'autofocus_header_style',
		'admin-head-callback'    => 'autofocus_admin_header_style',
		'admin-preview-callback' => 'autofocus_admin_header_image',
	);

	$args = apply_filters( 'autofocus_custom_header_args', $args );

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
add_action( 'after_setup_theme', 'autofocus_custom_header_setup' );

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
 * @package Autofocus
 * @since Autofocus 1.1
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

if ( ! function_exists( 'autofocus_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see autofocus_custom_header_setup().
 *
 * @since Autofocus 1.1
 */
function autofocus_header_style() {

	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) : ?>
		<style type="text/css">
			#container {
				padding-top: 0;
			}
			#header-image {
				background: url( '<?php echo esc_url( $header_image ); ?>' ) no-repeat;
				float: left;
				margin: 0 0 24px;
				width: 800px;
				height: <?php echo get_custom_header()->height; ?>px;
			}
			#header-image a {
				display: block;
				text-indent: -9999px;
				width: 100%;
				height: 100%;
			}
		</style>
	<?php endif; // $header_image check ?>

	<?php if ( HEADER_TEXTCOLOR != get_header_textcolor() ) : ?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == get_header_textcolor() ) :
		?>
			#header {
				display: none;
			}
			#access,
			div.menu {
				margin: 0 0 24px;
				width: 800px;
			}
			#access li,
			div.menu li {
				float: left;
				width: auto;
			}
			#access ul ul,
			div.menu ul ul {
				top: 21px;
				left: -3px;
			}
			#access ul ul ul,
			div.menu ul ul ul {
				left: 160px;
				top: -3px;
			}

		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
			#site-title a,
			#site-description {
				color: #<?php echo get_header_textcolor(); ?> !important;
			}
		<?php endif; ?>
		</style>
	<?php endif; // custom text color check
}
endif; // autofocus_header_style

if ( ! function_exists( 'autofocus_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see autofocus_custom_header_setup().
 *
 * @since Autofocus 1.1
 */
function autofocus_admin_header_style() {
?>
	<style type="text/css">
		#header-image {
			width: 800px;
		}
		#header {
			padding: 24px 210px 72px 0;
			width: 590px;
		}
		#header-image img {
			display: block;
			margin: 0;
		}
		#autofocus-site-title,
		#desc {
			font-family: "Hoefler Text", "Baskerville old face", Garamond, "Times New Roman", serif;
			padding: 0 0 0 5px;
		}
		#autofocus-site-title {
			font-size: 25px;
			font-weight: normal;
			line-height: 24px;
			margin-bottom: 0;
		}
		#autofocus-site-title a {
			color: #444;
			display: inline-block;
			text-decoration: none;
		}
		#desc {
			font-size: 14px;
			line-height: 24px;
			margin-bottom: 0;
		}
	</style>
<?php
}
endif; // autofocus_admin_header_style

if ( ! function_exists( 'autofocus_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see autofocus_custom_header_setup().
 *
 * @since Autofocus 1.1
 */
function autofocus_admin_header_image() { ?>
	<div id="header-image">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
	<?php
	if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
		$style = ' style="display:none;"';
	else
		$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
	?>
	<div id="header">
		<h1 id="autofocus-site-title"><a id="name"<?php echo $style; ?> onClick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
	</div><!-- #header -->
<?php }
endif; // autofocus_admin_header_image
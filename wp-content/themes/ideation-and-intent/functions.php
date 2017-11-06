<?php
/**
 * Ideation and Intent functions and definitions
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Ideation and Intent 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 525;

/**
 * Adjust the content width depending on the template being loaded.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_content_width() {
	global $content_width;
	if ( is_page() || is_single() )
		$content_width = 812;
}
add_action( 'template_redirect', 'ideation_content_width' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_setup() {

	require( get_template_directory() . '/inc/template-tags.php' );
	require( get_template_directory() . '/inc/tweaks.php' );
	require( get_template_directory() . '/inc/wpcom.php' );

	load_theme_textdomain( 'ideation', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_image_size( 'ideation-thumbnail-square',     52,  52, true );
	add_image_size( 'ideation-thumbnail-rectangle',  96,  47, true );
	add_image_size( 'ideation-sidebar-single',      228, 107, true );
	add_image_size( 'ideation-sidebar-double',      111, 111, true );
	add_image_size( 'ideation-sidebar-triple',       72,  72, true );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 520, 0, true );

	register_nav_menu( 'primary', __( 'Primary Menu', 'ideation' ) );
}
add_action( 'after_setup_theme', 'ideation_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Ideation and Intent 1.0
 */
function ideation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ideation' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ideation_widgets_init' );

/**
 * Enqueue main styles and scripts.
 */
function ideation_enqueue() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'ideation-style', get_template_directory_uri() . '/js/style.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if ( is_singular() && wp_attachment_is_image( get_the_ID() ) )
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
}
add_action( 'wp_enqueue_scripts', 'ideation_enqueue' );

/**
 * Register font styles.
 */
function ideation_register_fonts() {
	// font-family: 'Abel', sans-serif;
	wp_register_style(
		'ideation-Abel',
		'http://fonts.googleapis.com/css?family=Abel:400,700',
		array(),
		'20120521'
	);
	wp_register_style(
		'ideation-dosis',
		'http://fonts.googleapis.com/css?family=Dosis:400,700',
		array(),
		'20120521'
	);
}
add_action( 'init', 'ideation_register_fonts' );

/**
 * Enqueue font styles.
 */
function ideation_enqueue_fonts() {
	wp_enqueue_style( 'ideation-Abel' );
	wp_enqueue_style( 'ideation-dosis' );
}
add_action( 'wp_enqueue_scripts', 'ideation_enqueue_fonts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Gallery sidebar class.
 */
require( get_template_directory() . '/inc/gallery-sidebar.php' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_register_custom_background() {
	$args = array(
		'default-color' => 'f6f4f2',
		'default-image' => get_template_directory_uri() . '/images/background.png',
	);

	$args = apply_filters( 'ideation_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'ideation_register_custom_background' );

/**
 * Tweak styles for the Site Title.
 *
 * Since we are using two layers of text shadow
 * for the Site Title it is important to set the
 * dynamic value for themes that use the custom
 * background color feature.
 *
 * Hooks into the wp_head action.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_tweak_site_title_styles() {
	if ( get_background_color() ) :
?>
<style>
.site-title a {
	text-shadow: 1px 1px 0px <?php echo ideation_get_background_color(); ?>, 3px 3px 0px rgba( 0, 0, 0, 0.3 ) !important;
}
</style>
<?php
	endif;
}
add_action( 'wp_head', 'ideation_tweak_site_title_styles' );

<?php
/**
 * @package Grisaille
 */

if ( ! isset( $content_width ) )
	$content_width  = '590';

if ( ! isset( $themecolors ) ) {
	$themecolors = array(
		'bg' => 'efedee',
		'text' => '464545',
		'link' => 'f9c11a',
		'border' => 'cccccc',
		'url' => 'f9c11a',
	);
}

function grisaille_setup_theme() {

	add_theme_support( 'automatic-feed-links' );

	/**
	* Add Menu Support
	**/

	register_nav_menu( 'main', 'Primary Navigation' );

	/**
	* Add editor style - recommended according to Theme-Check
	**/
	add_editor_style();


	// Custom backgrounds support
	$args = array(
		'default-color' => 'efedee',
		'default-image' => get_template_directory_uri() . '/images/background.jpg',
	);

	$args = apply_filters( 'grisaille_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}

	/**
	* Thumbnail support
	**/

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 590, 275, true ); // 590 pixels wide by 275 pixels tall, hard crop mode
	add_image_size( 'following-post-thumbnails', 250, 200, true ); // 250 pixels wide by 200 pixels tall, hard crop mode

}

add_action( 'after_setup_theme', 'grisaille_setup_theme' );

/**
* Change Excerpt length
**/
function grisaille_new_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'grisaille_new_excerpt_length' );

/**
* Change excerpt [...] to something else
**/

function grisaille_new_excerpt_more( $more ) {
    global $post;
	return ' ... <br /><a class="more-link" href="'. get_permalink( $post->ID ) . __( '">Continue reading</a>', 'grisaille' );
}

add_filter( 'excerpt_more', 'grisaille_new_excerpt_more' );


/**
* Enqueue style.css and Google Fonts
**/
function grisaille_enqueue_scripts_styles() {

	wp_enqueue_style( 'style', get_stylesheet_uri() );
   	wp_enqueue_style( 'grisaille-fonts', 'http://fonts.googleapis.com/css?family=Marvel|Bevan' );

}

add_action( 'wp_enqueue_scripts', 'grisaille_enqueue_scripts_styles' );

/**
* checks if the visitor is browsing either a page or a post and adds the
* JavaScript required for threaded comments if they are
**/
function grisaille_queue_js() {

  	if ( !is_admin() ){
    	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) )
      		wp_enqueue_script( 'comment-reply' );
  	}
}

add_action( 'get_header', 'grisaille_queue_js' );

/**
* register_sidebar()
**/

function grisaille_register_sidebars() {

	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'grisaillesidebar',
			'name' => __( 'Primary Sidebar', 'grisaille' ),
			'before_widget' => '<div class="sidebaritem %1s %2s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
}

add_action( 'widgets_init', 'grisaille_register_sidebars' );

/**
* Load the Theme Options Page for social media icons
*/
require_once ( get_template_directory() . '/inc/theme-options.php' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
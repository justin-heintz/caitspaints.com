<?php
/**
 * @package Adventure_Journal
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = adventurejournal_attachment_width();

/**
 * Tell WordPress to run adventurejournal_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'adventurejournal_setup' );

if ( ! function_exists( 'adventurejournal_setup' ) ):

/*
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override adventurejournal_setup() in a child theme, add your own adventurejournal_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Advenure Journal 1.0
 */
function adventurejournal_setup() {

	/* Make Adventure Journal available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Adventure Journal, use a find and replace
	 * to change 'adventurejournal' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'adventurejournal', get_template_directory() . '/languages' );

	// Load up our theme options page and related code.
	require_once( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in 2 locations.
	register_nav_menus( array(
		'primary-menu' => __( 'Primary Menu', 'adventurejournal' )
	) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( 920, 360, true );

	add_theme_support( 'print-style' );
}
endif;

/**
 * Returns the default options for Adventure Journal.
 *
 * @since Adventure Journal 2.0
 */
function adventurejournal_get_default_theme_options() {
	$default_theme_options = array(
		'theme_layout' => 'col-1',
	);

	return apply_filters( 'adventurejournal_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Adventure Journal.
 *
 * @since Adventure Journal 2.0
 */
function adventurejournal_get_theme_options() {
	return get_option( 'adventurejournal_theme_options', adventurejournal_get_default_theme_options() );
}

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'fcf5f5',
	'border' => 'eeeeee',
	'text' => '000000',
	'link' => '600600',
	'url' => '600600',
);

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Adventure Journal 2.0
 */
function adventurejournal_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'adventurejournal' ),
		'id' => 'sidebar-1',
		'description' => __( 'The primary sidebar widget area', 'adventurejournal' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'adventurejournal' ),
		'id' => 'sidebar-2',
		'description' => __( 'A secondary widget area for your sidebar, only visible with 3-column layouts', 'adventurejournal' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

		register_sidebar( array(
		'name' => __( 'Footer Area One', 'adventurejournal' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your footer', 'adventurejournal' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'adventurejournal' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your footer', 'adventurejournal' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'adventurejournal' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your footer', 'adventurejournal' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'adventurejournal_widgets_init' );

/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function adventurejournal_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'adventurejournal' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'adventurejournal' ), get_the_author() ) ),
			get_the_author()
		)
	);
	edit_post_link( __( 'Edit', 'adventurejournal' ), ' ', '' );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function adventurejournal_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'adventurejournal_get_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own adventurejournal_get_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Adventure Theme 1.0
 */
function adventurejournal_get_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'adventurejournal' ); ?> <?php comment_author_link(); ?></p>
		<?php edit_comment_link( __( 'Edit', 'adventurejournal' ), '<span class="edit-link">', '</span>' ); ?>
	<?php
			break;
		default :
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-meta">
					<?php
						$avatar_size = 64;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 32;

						echo get_avatar( $comment, $avatar_size );
					?>

					<div class="comment-date"><a href="#comment-<?php comment_ID(); ?>" title="Permanent Link"><?php comment_date(); ?></a></div>

					<?php edit_comment_link( __( 'Edit', 'adventurejournal' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'adventurejournal' ); ?></em>
				<?php endif; ?>
			</div>

			<div class="comment-body">
			<div class="comment-author"><?php comment_author_link(); ?></div>
				<?php comment_text(); ?>

				<div class="reply clearfix">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'adventurejournal' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->

			</div>
		</li><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for adventurejournal_get_comments()

/**
 * Set the content width based on the theme's design and stylesheet and options
 */
function adventurejournal_attachment_width() {
	$options = adventurejournal_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( ( $current_layout == 'col-1' ) || is_page_template( 'template-onecol.php' ) )
		return 930;
	elseif ( ( $current_layout == 'col-3' ) || ( $current_layout == 'col-3-left' ) )
		return 470;
	else
		return 690;
}

function adventurejournal_header_css() {
	// Hide the theme-provided background behind the header image area if there is no header image
	if ( '' == get_header_image() ) : ?>
	<style type="text/css">
		#banner {
			display: none;
		}
		#logo {
			position: relative;
			top: 5px;
		}
	</style>
	<?php endif;
}
add_action( 'wp_head', 'adventurejournal_header_css' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

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
 * @since AdventureJournal 1.0
 */
function adventurejournal_register_custom_background() {
	$args = array(
		'default-color' => '693808',
		'default-image' => get_template_directory_uri() . '/images/mp-background-tile.jpg',
	);

	$args = apply_filters( 'adventurejournal_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'adventurejournal_register_custom_background' );
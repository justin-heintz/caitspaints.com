<?php
/**
 * @package Blaskan
 */

if ( ! isset( $themecolors ) ) {
	$themecolors = array(
		'bg' => 'ffffff',
		'text' => '000000',
		'link' => '2E6EB0',
		'border' => 'CCCCCC',
		'url' => '000000',
	);
}

/**
 * Theme setup
 */
if ( ! function_exists( 'blaskan_setup' ) ):
function blaskan_setup() {
	global $content_width;
	$_content_width = $_header_width = 0;

	add_theme_support( 'automatic-feed-links' );

	add_custom_background();

	// Set up widths for each layout.
	if ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) {
		// 3-column layout
		$_content_width = 540;
		$_header_width = 1120;
	} elseif ( is_active_sidebar( 'primary-sidebar' ) || is_active_sidebar( 'secondary-sidebar' ) ) {
		// 2-column layout
		$_content_width = 830;
		$_header_width = 1120;
	} else {
		// 1-column layout
		$_content_width = $_header_width = 540;
	}

	if ( ! isset( $content_width ) )
		$content_width = $_content_width;

	// Post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( $_content_width, 999, true );

	// Add support for custom header.
	add_theme_support( 'custom-header', array(
		// The default header text color.
		'default-text-color' => '000',
		// The height and width of our custom header.
		'width' => apply_filters( 'blaskan_header_image_width', $_header_width ),
		'height' => apply_filters( 'blaskan_header_image_height', 160 ),
		// Callback for styling the header.
		'wp-head-callback' => 'blaskan_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'blaskan_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'blaskan_admin_header_image',
	) );

	// Add two custom menu locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'blaskan' ),
		'footer' => __( 'Footer Navigation', 'blaskan' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'blaskan_setup' );

/**
 * JS init
 */
if ( ! function_exists( 'blaskan_js_init' ) ):
function blaskan_js_init() {
	wp_enqueue_script( 'blaskan', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120303' );
	wp_localize_script( 'blaskan', 'objectL10n', array( 'blaskan_navigation_title' => __( '- Navigation -', 'blaskan' ) ) );
}
endif;
add_action( 'wp_enqueue_scripts', 'blaskan_js_init' );

/**
 * Register widget areas. All are empty by default.
 */
if ( ! function_exists( 'blaskan_widgets_init' ) ):
	function blaskan_widgets_init() {
		// Primary sidebar
		register_sidebar( array(
			'name' => __( 'Primary Widget Area', 'blaskan' ),
			'id' => 'primary-sidebar',
			'description' => __( 'The primary sidebar', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Secondary sidebar
		register_sidebar( array(
			'name' => __( 'Secondary Widget Area', 'blaskan' ),
			'id' => 'secondary-sidebar',
			'description' => __( 'The secondary sidebar', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Footer widgets
		register_sidebar( array(
			'name' => __( 'Footer Widget Area', 'blaskan' ),
			'id' => 'footer-widget-area',
			'description' => __( 'The footer widget area', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
	}
	endif;
add_action( 'widgets_init', 'blaskan_widgets_init' );

/**
 * Add body classes
 */
if ( ! function_exists( 'blaskan_body_class' ) ):
	function blaskan_body_class( $classes ) {
		if ( get_theme_mod( 'background_image' ) || get_theme_mod( 'background_color' ) ) {
			$classes[] = 'background-image';
			if ( get_theme_mod( 'background_color' ) == 'FFFFFF' || get_theme_mod( 'background_color' ) == 'FFF' ) {
				$classes[] = 'background-white';
			}
		}

		if ( get_theme_mod( 'header_image' ) ) {
			$classes[] = 'header-image';
		}

		$nav = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false, 'container' => false ) );
		$nav_links = substr_count( $nav, '<a' );
		$nav_lists = substr_count( $nav, '<ul' );
		if ( $nav_links == 0 ) {
			$classes[] = 'no-menu';
		} elseif ( $nav_links < 9 && $nav_lists < 2 ) {
			$classes[] = 'simple-menu';
		} else {
			$classes[] = 'advanced-menu';
		}

		if ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) {
			$classes[] = 'sidebars';
		} elseif ( is_active_sidebar( 'primary-sidebar' ) || is_active_sidebar( 'secondary-sidebar' ) ) {
			$classes[] = 'sidebar';
			$classes[] = 'content-wide-sidebar';
			$classes[] = 'content-wide';
		} else {
			$classes[] = 'no-sidebars';
		}

		if ( is_active_sidebar( 'footer-widget-area' ) ) {
			$classes[] = 'footer-widgets';
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'blaskan_body_class' );

if ( ! function_exists( 'blaskan_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 */
function blaskan_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: 000 is default, hide text (returns 'blank' ) or any hex value
	if ( get_header_textcolor() == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-name,
		#header-message {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-name a,
		#header-message {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // blaskan_header_style

if ( ! function_exists( 'blaskan_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in blaskan_setup().
 *
 */
function blaskan_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1 {
		color: #000;
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 72px;
		font-weight: bold;
		letter-spacing: -2px;
		line-height: 1;
		margin: 0;
		padding: 0;
		word-wrap: break-word;
		width: 100%;
	}
	#headimg h1 a {
		color: #000;
		text-decoration: none;
	}
	#desc {
		color: #666;
		font: 15px/22px 'Helvetica Neue', Helvetica, Arial, sans-serif;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // blaskan_admin_header_style

if ( ! function_exists( 'blaskan_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in blaskan_setup().
 *
 */
function blaskan_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }
endif; // blaskan_admin_header_image

/**
 * Blaskan header structure
 */
if ( ! function_exists( 'blaskan_header_structure' ) ):
	function blaskan_header_structure() {

		$output = '';

		if ( get_header_image() ):
			$output .= '<figure><a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_header_image().'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"></a></figure>';
		endif;

		$output .= '<h1 id="site-name"><a href="'.home_url( '/' ).'" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';

		$output .= '<div id="header-message">' . get_bloginfo( 'description' ) . '</div>';

		$output .= blaskan_primary_nav();

		return $output;
	}
endif;

/**
 * Returns primary nav
 */
if ( ! function_exists( 'blaskan_primary_nav' ) ):
	function blaskan_primary_nav() {
		$nav = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false, 'container' => false ) );

		// Check nav for links
		if ( strpos( $nav, '<a' ) ) {
			if ( strpos( $nav, 'div class="menu"' ) ) {
				$nav_prepend = '';
				$nav_append = '';
			} else {
				$nav_prepend = '<div class="menu">';
				$nav_append = '</div>';
				$nav = str_replace( 'class="menu"', '', $nav);
			}

			return '<nav id="nav" role="navigation">' . $nav_prepend . $nav . $nav_append . '</nav>';
		} else {
			return;
		}
	}
endif;

if ( ! function_exists( 'blaskan_comment' ) ) :
	function blaskan_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<article>
				<header class="comment-header">
				  	<?php echo blaskan_avatar( $comment ); ?>
				<time><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></a></time>

				<?php if ( $comment->user_id && !$comment->comment_author_url ): ?>
					<cite><a href="<?php echo get_author_posts_url( $comment->user_id ); ?>"><?php echo $comment->comment_author; ?></a></cite>
				<?php else: ?>
				  	<?php printf( '<cite>%s</cite>', get_comment_author_link() ); ?>
				<?php endif; ?>
			</header>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p class="moderation"><em><?php _e( 'Your comment is awaiting moderation.', 'blaskan' ); ?></em></p>
			<?php endif; ?>

			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

				<?php edit_comment_link( __( 'Edit', 'blaskan' ), ' ' ); ?>
			</div><!-- .reply -->
			  </article>
		<?php
				break;
			case 'pingback'  :
		?>
		<li class="pingback">
			<time><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></time>
			<?php _e( 'Pingback:', 'blaskan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'blaskan' ), ' ' ); ?>
		<?php
				break;
			case 'trackback' :
		?>
		<li class="trackback">
			<time><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></time>
			<?php _e( 'Trackback:', 'blaskan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'blaskan' ), ' ' ); ?>
		<?php
				break;
		endswitch;
	}
endif;

/**
 * Display avatar
 */
if ( ! function_exists( 'blaskan_avatar' ) ):
	function blaskan_avatar( $user ) {
		$avatar = get_avatar( $user, 40 );

		if ( !empty( $avatar ) ) {
			return '<figure>' . $avatar . '</figure>';
		} else {
			return;
		}
	}
endif;
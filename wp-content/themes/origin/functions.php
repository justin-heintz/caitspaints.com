<?php
/**
 * @package Origin
 */

/* Theme content_width and color defaults */
if ( ! isset( $content_width ) )
	$content_width = 640;

if ( ! isset( $themecolors ) ) {
	$themecolors = array(
		'bg' => 'ffffff',
		'text' => '000000',
		'link' => 'dd5424',
		'border' => 'CCCCCC',
		'url' => 'dd5424',
	);
}

/* Default content_width if using fullwidth page template */

function origin_content_width() {

	global $content_width;

	if ( is_page_template( 'page-template-fullwidth.php' ) )
		$content_width = 940;
	}

add_action( 'template_redirect', 'origin_content_width' );

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'origin_theme_setup' );

function origin_sidebars() {

	register_sidebar( array(
							'id' 			=> 'primary',
							'name' 			=> __( 'Primary', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

	register_sidebar( array(
							'id' 			=> 'after-singular',
							'name' 			=> __( 'After Post', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

	register_sidebar( array(
							'id' 			=> 'footer-1',
							'name' 			=> __( 'Footer Column 1', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

	register_sidebar( array(
							'id' 			=> 'footer-2',
							'name' 			=> __( 'Footer Column 2', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

	register_sidebar( array(
							'id' 			=> 'footer-3',
							'name' 			=> __( 'Footer Column 3', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

	register_sidebar( array(
							'id' 			=> 'footer-4',
							'name' 			=> __( 'Footer Column 4', 'origin' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h3 class="widget-title">',
							'after_title' 	=> '</h3>'
							)
						);

}

add_action( 'widgets_init', 'origin_sidebars' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 */
function origin_theme_setup() {

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'single-thumbnail', 636, 310, true );

	/* Enqueue Google fonts */
	add_action( 'wp_enqueue_scripts', 'origin_google_fonts' );

	/* Add support for custom backgrounds */
	if ( function_exists( 'get_custom_header' ) )
		add_theme_support( 'custom-background' );
	else
		add_custom_background(); //Compatibility < WordPress 3.4

	/* Custom header properties */
	$header_args = array(
		'width' 					=> 940,
		'flex-width' 				=> false,
		'height' 					=> 150,
		'flex-height' 				=> true,
		'default-image' 			=> '',
		'default-text-color' 		=> '000000',
		'admin-head-callback' 		=> 'origin_admin_header_style',
		'wp-head-callback' 			=> 'origin_header_style',
		'admin-preview-callback' 	=> 'origin_admin_header_image'
	);

	/* Add support for custom headers */
	if ( function_exists( 'get_custom_header' ) ) {
		add_theme_support( 'custom-header', $header_args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $header_args['default-text-color'] );
		define( 'HEADER_IMAGE',        $header_args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $header_args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $header_args['height'] );
		add_custom_image_header( $header_args['wp-head-callback'], $header_args['admin-head-callback'], $header_args['admin-preview-callback'] );
	}

	/* Add support for custom menu */
	register_nav_menu( 'primary', __( 'Navigation', 'origin' ) );

}

//Allow support for flex-width and height custom headers (if they're supported)
function origin_header_image_width() {
	$width = 0;
	if ( function_exists( 'get_custom_header' ) )
		$width = get_custom_header()->width;
	else
		$width = HEADER_IMAGE_WIDTH;
	return absint( $width );
}

function origin_header_image_height() {
	$height = 0;
	if ( function_exists( 'get_custom_header' ) )
		$height = get_custom_header()->height;
	else
		$height = HEADER_IMAGE_HEIGHT;
	return absint( $height );
}

// Referenced by add_theme_support custom-header in origin_theme_setup
function origin_header_style() {

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
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
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
	<?php
}

// Referenced by add_theme_support custom-header in origin_theme_setup
function origin_admin_header_image() { ?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" width="<?php echo origin_header_image_width(); ?>" height="<?php echo origin_header_image_height(); ?>" />
		<?php endif; ?>
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }

// Referenced by add_theme_support custom-header in origin_theme_setup
function origin_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1 {
		clear: both;
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 2.307692307692308em;
		font-weight: bold;
		letter-spacing: -2px;
		line-height: 1em;
		margin: 0 0 20px 0;
		text-transform: uppercase;
		word-wrap: break-word;
	}
	#headimg h1 a {
		border-bottom: none;
		color: #222;
		text-decoration: none;
	}
	#desc {
		border-top: 5px solid #444;
		clear: both;
		color: #333;
		float: left;
		font-family: Bitter, serif;
		font-size: 1.846153em;
		line-height: 1.5em;
		margin: 0;
		padding: 18px 4.25531914893617% 20px 4.25531914893617%;
		text-align: center;
		text-transform: none;
		width: 91.48936170212766%;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#h1 a,
		#desc {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		clear: both;
		float: left;
		margin: 20px 0;
		max-width: 100%;
	}
	</style>
<?php
}

/**
 * Register and enqueue Google fonts
 *
 */
function origin_google_fonts() {

	wp_register_style( 'origin-font-bitter', 'http://fonts.googleapis.com/css?family=Bitter', false, 1.0, 'screen' );
	wp_enqueue_style( 'origin-font-bitter' );

}

/**
 * Add font to admin screen for custom header display
 */
add_action( 'admin_print_styles-appearance_page_custom-header', 'origin_google_fonts' );

/**
 * Comments callback
 *
 */

function origin_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>

	<li id="comment-<?php comment_ID(); ?>" class="<?php comment_class(); ?>">

		<div class="comment-wrap">

			<?php echo get_avatar( $comment, '50' ); ?>

			<div class="comment-meta">
				<?php if ( $comment->user_id && !$comment->comment_author_url ): ?>
					<cite><a href="<?php echo get_author_posts_url( $comment->user_id ); ?>"><?php echo $comment->comment_author; ?></a></cite>
				<?php else: ?>
					<?php printf( '<cite>%s</cite>', get_comment_author_link() ); ?>
				<?php endif; ?>
				&middot; <time><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s - %2$s', 'origin' ), get_comment_date(),  get_comment_time() ); ?></a></time>
				<?php edit_comment_link( __( 'Edit', 'origin' ), ' &middot;' ); ?> &middot; <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'after' => '&rarr;' ) ) ); ?>
			</div>

			<div class="comment-content comment-text">

				<?php if ( '0' == $comment->comment_approved ) : ?>

					<p class="alert moderation"><?php _e( 'Your comment is awaiting moderation.', 'origin' ); ?></p>

				<?php endif; ?>

				<?php comment_text( $comment->comment_ID ); ?>
			</div><!-- .comment-content .comment-text -->

		</div><!-- .comment-wrap -->

	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>

<?php }
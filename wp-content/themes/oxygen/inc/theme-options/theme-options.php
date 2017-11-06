<?php
/**
 * Oxygen Theme Options
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */


/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Oxygen 0.2.2
 *
 */
function oxygen_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'oxygen-theme-options', get_template_directory_uri() . '/inc/theme-options/theme-options.css', false, '20120418' );
	wp_enqueue_script( 'oxygen-theme-options', get_template_directory_uri() . '/inc/theme-options/theme-options.js', array( 'farbtastic' ), '20120418' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'oxygen_admin_enqueue_scripts' );

/**
 * Register the form setting for our oxygen_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, oxygen_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_theme_options_init() {
	register_setting(
		'oxygen_options', // Options group, see settings_fields() call in oxygen_theme_options_render_page()
		'oxygen_theme_options', // Database option, see oxygen_get_theme_options()
		'oxygen_theme_options_validate' // The sanitization callback, see oxygen_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see oxygen_theme_options_add_page()
	);

	add_settings_field( 'font', __( 'Title Font Family:', 'oxygen' ), 'oxygen_settings_field_font_select_options', 'theme_options', 'general' );

	add_settings_field( 'font_size', __( 'Base Font Size:', 'oxygen' ), 'oxygen_settings_field_font_size_select_options', 'theme_options', 'general' );

	add_settings_field( 'link_color', __( 'Link Color', 'oxygen' ), 'oxygen_settings_field_link_color', 'theme_options', 'general' );

}
add_action( 'admin_init', 'oxygen_theme_options_init' );

/**
 * Change the capability required to save the 'oxygen_options' options group.
 *
 * @see oxygen_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see oxygen_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function oxygen_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_oxygen_options', 'oxygen_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'oxygen' ),   // Name of page
		__( 'Theme Options', 'oxygen' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'oxygen_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'oxygen_theme_options_add_page' );

/**
 * Returns an array of font select options registered for Oxygen.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_font_select_options() {
	$font_select_options = array(
		'abel' => array(
			'value' =>	'abel',
			'label' => __( 'Abel', 'oxygen' )
		),
		'oswald' => array(
			'value' =>	'oswald',
			'label' => __( 'Oswald', 'oxygen' )
		),
		'terminal_dosis' => array(
			'value' => 'terminal_dosis',
			'label' => __( 'Terminal Dosis', 'oxygen' )
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => __( 'Bitter', 'oxygen' )
		),
		'georgia' => array(
			'value' => 'georgia',
			'label' => __( 'Georgia', 'oxygen' )
		),
		'droid_serif' => array(
			'value' => 'droid_serif',
			'label' => __( 'Droid Serif', 'oxygen' )
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => __( 'Helvetica', 'oxygen' )
		),
		'arial' => array(
			'value' => 'arial',
			'label' => __( 'Arial', 'oxygen' )
		),
		'droid_sans' => array(
			'value' => 'droid_sans',
			'label' => __( 'Droid Sans', 'oxygen' )
		)
	);

	return apply_filters( 'oxygen_font_select_options', $font_select_options );
}

/**
 * Returns an array of font size select options registered for Oxygen.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_font_size_select_options() {
	$font_size_select_options = array(
		'18' => array(
			'value' =>	'18',
			'label' => __( 'X-Large', 'oxygen' )
		),
		'17' => array(
			'value' =>	'17',
			'label' => __( 'Large', 'oxygen' )
		),
		'16' => array(
			'value' =>	'16',
			'label' => __( 'Default', 'oxygen' )
		),
		'15' => array(
			'value' => '15',
			'label' => __( 'Medium', 'oxygen' )
		),
		'14' => array(
			'value' => '14',
			'label' => __( 'Small', 'oxygen' )
		),
		'13' => array(
			'value' => '13',
			'label' => __( 'X-Small', 'oxygen' )
		)
	);

	return apply_filters( 'oxygen_font_size_select_options', $font_size_select_options );
}

/**
 * Returns the options array for Oxygen.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_get_theme_options() {
	$saved = ( array ) get_option( 'oxygen_theme_options' );
	$defaults = array(
		'font' 			=> 'abel',
		'font_size' 	=> '16',
		'link_color' 	=> '#0da4d3'
	);
	$defaults = apply_filters( 'oxygen_default_theme_options', $defaults );
	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the Font select options setting field.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_settings_field_font_select_options() {
	$options = oxygen_get_theme_options();
	?>
	<select name="oxygen_theme_options[font]" id="font-select-options">
		<?php
			$selected = $options['font'];
			$p = '';
			$r = '';

			foreach ( oxygen_font_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="font_select_options[selectinput]"><?php _e( 'Choose a font for the titles.', 'oxygen' ); ?></label>
	<?php
}

/**
 * Renders the Font Size select options setting field.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_settings_field_font_size_select_options() {
	$options = oxygen_get_theme_options();
	?>
	<select name="oxygen_theme_options[font_size]" id="font-size-select-options">
		<?php
			$selected = $options['font_size'];
			$p = '';
			$r = '';

			foreach ( oxygen_font_size_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="font_size_select_options[selectinput]"><?php _e( 'Adjust the base font size.', 'oxygen' ); ?></label>
	<?php
}

/**
 * Renders the Link Color setting field.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_settings_field_link_color() {
	$options = oxygen_get_theme_options();
	?>
	<input type="text" name="oxygen_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
	<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
	<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'oxygen' ); ?>" />
	<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
	<br />
	<span><?php printf( __( 'Default color: %s', 'oxygen' ), '<span id="default-color">#0da4d3</span>' ); ?></span>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php
			if ( function_exists( 'wp_get_theme' ) ) :
				$theme_name = wp_get_theme();
			else :
				$theme_name = get_current_theme();
			endif;
		?>
		<h2><?php printf( __( '%s Theme Options', 'oxygen' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'oxygen_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see oxygen_theme_options_init()
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_theme_options_validate( $input ) {
	$output = array();

	// The font select option must actually be in the array of select options
	if ( isset( $input['font'] ) && array_key_exists( $input['font'], oxygen_font_select_options() ) )
		$output['font'] = $input['font'];

	// The font size select option must actually be in the array of select options
	if ( isset( $input['font_size'] ) && array_key_exists( $input['font_size'], oxygen_font_size_select_options() ) )
		$output['font_size'] = $input['font_size'];

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	return apply_filters( 'oxygen_theme_options_validate', $output, $input, $defaults );
}

/**
 * Add a style block to the theme for the custom styles.
 *
 * This function is attached to the wp_head action hook.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_custom_style() {
 	$options = oxygen_get_theme_options();
 	$current_font = $options['font'];
 	$current_font = str_replace( '_', ' ', $current_font );
 	$current_font = ucwords( $current_font );
 	$current_font_size = $options['font_size'];
 	$current_link_color = $options['link_color'];
?>
	<style>
		html {
			font-size: <?php echo $current_font_size; ?>px;
		}
		h1, h2, h3, h4, h5, h6, dl dt, blockquote, blockquote blockquote blockquote, .site-title, .main-navigation a, .widget_calendar caption {
			font-family: '<?php echo $current_font; ?>', sans-serif;
		}
		.error, .entry-title a, .entry-content a, entry-summary a, .main-navigation > div > ul > li > a, .widget a, .post-navigation a, #image-navigation a, .pingback a, .logged-in-as a, .more-articles .entry-title a:hover, .widget_flickr #flickr_badge_uber_wrapper a {
			color: <?php echo $current_link_color; ?>;
		}
		a:hover, .comment-meta a, .comment-meta a:visited {
			border-color: <?php echo $current_link_color; ?>;
		}
		a.read-more, a.read-more:visited, .pagination a:hover, .comment-navigation a:hover, button, html input[type="button"], input[type="reset"], input[type="submit"], #infinite-handle span {
			background-color: <?php echo $current_link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'oxygen_custom_style' );
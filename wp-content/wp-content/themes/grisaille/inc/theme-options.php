<?php
/**
 * @package Grisaille
 *
 */

/**
 * Register the form setting for our grisaille_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, grisaille_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_theme_options_init() {
	register_setting(
		'grisaille_options', // Options group, see settings_fields() call in grisaille_theme_options_render_page()
		'grisaille_theme_options', // Database option, see grisaille_get_theme_options()
		'grisaille_theme_options_validate' // The sanitization callback, see grisaille_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see grisaille_theme_options_add_page()
	);

	// Register our individual settings fields
	/* TODO Can't add RSS feed links on .com. May add this back later if we find an alternative.
		add_settings_field(
		'hiderss', // Unique identifier for the field for this section
		__( 'RSS URL', 'grisaille' ), // Setting field label
		'grisaille_settings_field_hiderss', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see grisaille_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);*/

	add_settings_field( 'facebookurl', __( 'Facebook URL', 'grisaille' ), 'grisaille_settings_field_facebookurl', 'theme_options', 'general' );
	add_settings_field( 'twitterurl', __( 'Twitter URL', 'grisaille' ), 'grisaille_settings_field_twitterurl', 'theme_options', 'general' );
	add_settings_field( 'googleplusurl', __( 'Google&#43; URL', 'grisaille' ), 'grisaille_settings_field_googleplusurl', 'theme_options', 'general' );

}
add_action( 'admin_init', 'grisaille_theme_options_init' );

/**
 * Change the capability required to save the 'grisaille_options' options group.
 *
 * @see grisaille_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see grisaille_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function grisaille_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_grisaille_options', 'grisaille_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'grisaille' ),   // Name of page
		__( 'Theme Options', 'grisaille' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'grisaille_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'grisaille_theme_options_add_page' );

/**
 * Returns the options array for Grisaille.
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_get_theme_options() {

	$saved = (array) get_option( 'grisaille_theme_options' );

	$defaults = array(
		'hiderss'       => 'off',
		'facebookurl'     		=> '',
		'twitterurl' 			=> '',
		'googleplusurl'  		=> '',
	);

	$defaults = apply_filters( 'grisaille_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the Hide RSS setting field.
 */
function grisaille_settings_field_hiderss() {
	$options = grisaille_get_theme_options();
	?>
	<label for"hiderss">
		<input type="checkbox" name="grisaille_theme_options[hiderss]" id="hiderss" <?php checked( 'on', $options['hiderss'] ); ?> />
		<?php _e( 'Hide RSS Icon?', 'grisaille' ); ?>
	</label>
	<?php
}

/**
 * Renders the Facebook URL input setting field.
 */
function grisaille_settings_field_facebookurl() {
	$options = grisaille_get_theme_options();
	?>
	<input type="text" name="grisaille_theme_options[facebookurl]" id="facebook-url" value="<?php echo esc_attr( $options['facebookurl'] ); ?>" />
	<label class="description" for="facebook-url"><?php _e( 'Enter your Facebook URL', 'grisaille' ); ?></label>
	<?php
}

/**
 * Renders the Twitter URL input setting field.
 */
function grisaille_settings_field_twitterurl() {
	$options = grisaille_get_theme_options();
	?>
	<input type="text" name="grisaille_theme_options[twitterurl]" id="twitter-url" value="<?php echo esc_attr( $options['twitterurl'] ); ?>" />
	<label class="description" for="twitter-url"><?php _e( 'Enter your Twitter URL', 'grisaille' ); ?></label>
	<?php
}

/**
 * Renders the Google Plus URL input setting field.
 */
function grisaille_settings_field_googleplusurl() {
	$options = grisaille_get_theme_options();
	?>
	<input type="text" name="grisaille_theme_options[googleplusurl]" id="googleplus-url" value="<?php echo esc_attr( $options['googleplusurl'] ); ?>" />
	<label class="description" for="googleplus-url"><?php _e( 'Enter your Google&#43; URL', 'grisaille' ); ?></label>
	<?php
}


/**
 * Renders the Theme Options administration screen.
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'grisaille' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
		<p><?php _e( 'Add social networking icons to the top of the theme by entering the URLs to your profiles.', 'grisaille' ); ?></p>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'grisaille_options' );
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
 * @see grisaille_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Grisaille 1.3.1-wpcom
 */
function grisaille_theme_options_validate( $input ) {
	$output = array();

	// Hide RSS will only be present if checked.
	if ( isset( $input['hiderss'] ) )
		$output['hiderss'] = 'on';

	// The Facebook URL input must be safe text with no HTML tags
	if ( isset( $input['facebookurl'] ) && ! empty( $input['facebookurl'] ) )
		$output['facebookurl'] = wp_filter_nohtml_kses( $input['facebookurl'] );

	// The Twitter URL input must be safe text with no HTML tags
	if ( isset( $input['twitterurl'] ) && ! empty( $input['twitterurl'] ) )
		$output['twitterurl'] = wp_filter_nohtml_kses( $input['twitterurl'] );

	// The Google Plus URL input must be safe text with no HTML tags
	if ( isset( $input['googleplusurl'] ) && ! empty( $input['googleplusurl'] ) )
		$output['googleplusurl'] = wp_filter_nohtml_kses( $input['googleplusurl'] );

	return apply_filters( 'grisaille_theme_options_validate', $output, $input );
}

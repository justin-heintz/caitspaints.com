<?php
/**
 * The template for displaying search forms in _s
 *
 * @package Skylark
 * @since Skylark 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'skylark' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'skylark' ); ?>" />
	</form>

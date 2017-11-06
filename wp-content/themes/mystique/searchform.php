<?php
/**
 * @package WordPress
 * @subpackage Mystique
 */
?>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<div id="searchfield">
		<label for="s" class="screen-reader-text"><?php _e( 'Search for:', 'mystique' ); ?></label>
		<input type="text" name="s" id="s" class="searchtext" />
		<input type="submit" value="<?php echo esc_attr( _x( 'Go', 'Search button', 'mystique' ) ); ?>" class="searchbutton" />
	</div>
</form>
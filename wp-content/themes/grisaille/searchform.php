<?php
/**
 * @package Grisaille
 */
?>
<form id="searchform" method="get" action="<?php echo esc_attr( home_url( '/' ) );  ?>">
	<input type="text" name="s" id="s" size="25" />
	<input type="submit" value="<?php _e( 'Search', 'grisaille' ); ?>" id="error-search" />
</form>

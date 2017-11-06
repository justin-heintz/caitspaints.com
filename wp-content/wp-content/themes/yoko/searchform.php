<?php
/**
 * @package Yoko
 */
?>

<form role="search" method="get" class="searchform" action="<?php home_url(); ?>" >
	<div>
		<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'yoko' ); ?>'</label>
		<input type="text" class="search-input" value="<?php echo get_search_query(); ?>" name="s" id="s" />
		<input type="submit" class="searchsubmit" value="<?php _e( 'Search', 'yoko' ); ?>" />
	</div>
</form>
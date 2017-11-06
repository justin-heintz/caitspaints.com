<?php
/**
 * The template for displaying search forms in Ideation and Intent
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'ideation' ); ?></label>
		<input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'ideation' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'ideation' ); ?>" />
	</form>

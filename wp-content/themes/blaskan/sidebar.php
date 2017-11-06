<?php
/**
 * @package Blaskan
 */
?>

<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	<aside id="primary" role="complementary">
		<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</aside>
<?php endif; ?>

<?php if ( is_active_sidebar( 'secondary-sidebar' ) ) : ?>
	<aside id="secondary" role="complementary">
		<?php dynamic_sidebar( 'secondary-sidebar' ); ?>
	</aside>
<?php endif; ?>
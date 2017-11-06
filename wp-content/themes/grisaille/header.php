<?php
/**
 * @package Grisaille
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>












































































</head>

<body <?php body_class(); ?> >

<div id="canvas">

	<?php $options = get_option( 'grisaille_theme_options' ); ?>

	<div class="social-media">

		<?php if ( isset( $options['twitterurl'] ) && '' != $options['twitterurl'] ) : ?>
			<a href="<?php echo esc_url( $options['twitterurl'] ); ?>" class="twitter" title="<?php esc_attr_e( 'Twitter', 'grisaille' ); ?>"><?php _e( 'Twitter', 'grisaille' ); ?></a>
		<?php endif; ?>

		<?php if ( isset( $options['facebookurl'] ) && '' != $options['facebookurl'] ) : ?>
			<a href="<?php echo esc_url( $options['facebookurl'] ); ?>" class="facebook" title="<?php esc_attr_e( 'Facebook', 'grisaille' ); ?>"><?php _e( 'Facebook', 'grisaille' ); ?></a>
		<?php endif; ?>

		<?php if ( isset( $options['googleplusurl'] ) && '' != $options['googleplusurl'] ) : ?>
			<a href="<?php echo esc_url( $options['googleplusurl'] ); ?>" class="googleplus" title="<?php esc_attr_e( 'Google Plus', 'grisaille' ); ?>"><?php _e( 'Google&#43;', 'grisaille' ); ?></a>
		<?php endif; ?>

		<?php //if ( ! $options['hiderss'] ) : ?>
			<!--<a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss" title="<?php esc_attr_e( 'RSS Feed', 'grisaille' ); ?>"><?php _e( 'RSS Feed', 'grisaille' ); ?></a>-->
		<?php //endif; ?>

	</div><!-- .social-media-->

    <ul class="skip">
		<li><a href=".menu"><?php _e( 'Skip to navigation', 'grisaille' ); ?></a></li>
		<li><a href="#primary-content"><?php _e( 'Skip to main content', 'grisaille' ); ?></a></li>
		<li><a href="#secondary-content"><?php _e( 'Skip to secondary content', 'grisaille' ); ?></a></li>
		<li><a href="#footer"><?php _e( 'Skip to footer', 'grisaille' ); ?></a></li>
    </ul><!-- end .skip-->

    <div id="header-wrap">
   		<div id="header">
   			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( $header_image ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a>
			<?php endif; ?>
       		<div id="site-title">
       			<div class="masthead">
					<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<div id="site-description"><?php bloginfo( 'description' ); ?></div>
				</div>
        	</div><!-- end #site-title -->
  		</div> <!-- end #header-->
		<!--by default your pages will be displayed unless you specify your own menu content under Menu through the admin panel-->
		<div id="top-menu">
			<?php wp_nav_menu( array(
							'theme_location' 	=> 'main',
							'sort_column' 		=> 'menu_order',
							'container_class' 	=> 'menu-header'
							) ); ?>
		</div><!-- end #top-menu -->
 	</div><!-- end #header-wrap-->

	<div id="primary-content">
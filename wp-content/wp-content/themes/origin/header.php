<?php
/**
 * @package Origin
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>












































































</head>

<body <?php body_class(); ?>>

	<div id="container">

		<div class="wrap">

			<?php $header_image = get_header_image(); ?>

			<?php if ( ! empty( $header_image ) ) { ?>

					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="Home">
						<img id="header-image" src="<?php echo $header_image; ?>" width="<?php echo origin_header_image_width(); ?>" height="<?php echo origin_header_image_height(); ?>" />
					</a>

			<?php } //end if header_image ?>

			<div id="header">

				<div id="branding">

					<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="Home">
							<?php echo bloginfo( 'name' ); ?>
						</a>
					</h1>

				</div><!-- #branding -->

				<div id="menu-primary" class="menu-container">

					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '3', 'container_class' => 'menu', 'menu_id' => 'menu-primary-items' ) ); ?>

				</div><!-- #menu-primary .menu-container -->

				<div id="site-description">
					<span><?php echo bloginfo( 'description' ); ?></span>
				</div>

			</div><!-- #header -->

			<div id="main">
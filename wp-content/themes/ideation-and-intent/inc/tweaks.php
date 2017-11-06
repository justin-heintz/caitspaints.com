<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package IdeationAndIntent
 * @since Ideation and Intent 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ideation_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'ideation_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Ideation and Intent 1.0
 */
function ideation_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'ideation_enhanced_image_navigation', 10, 2 );

/**
 * Auto Excerpt More.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'ideation_auto_excerpt_more' );

/**
 * Post class filter.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_post_class( $classes ) {
	$classes[] = 'entry';
	$featured_image = ideation_get_featured_image();
	if ( ! empty( $featured_image ) )
		$classes[] = 'has-featured-image';
	return $classes;
}
add_filter( 'post_class', 'ideation_post_class' );

/**
 * Body class filter.
 *
 * @since Ideation and Intent 1.0
 */
function ideation_body_class( $classes ) {
	if ( is_attachment() && wp_attachment_is_image( get_the_ID() ) ) {
		$classes[] = 'column-2';
		return $classes;
	}

	// Pages and posts always get the photo sidebar if present.
	if ( is_page() || is_single() ) {
		if ( Ideation_Gallery_Sidebar::has_galleries() )
			$classes[] = 'column-3';
		else
			$classes[] = 'column-2';
		return $classes;
	}

	$columns = 1;
	if ( is_active_sidebar( 'sidebar-1' ) )
		$columns++;
	if ( Ideation_Gallery_Sidebar::has_galleries() )
		$columns++;

	$classes[] = 'column-' . $columns;

	return $classes;
}
add_filter( 'body_class', 'ideation_body_class' );

<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'oxygen_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Oxygen 0.2.2
 */
function oxygen_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'oxygen_enhanced_image_navigation', 10, 2 );

/**
 * Sets the post excerpt length to 30 words.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'oxygen_excerpt_length' );

/**
 * Calendar Widget Title
 *
 * For some reason, WordPress will print a non-breaking space
 * entity wrapped in the appropriate tags for the calendar
 * widget even if the title's value is left empty by the user.
 * This function will remove the empty heading tag.
 *
 * Hooked into "widget_title".
 *
 * It is possible that this filter may not be needed in the future:
 *
 * @see http://core.trac.wordpress.org/ticket/17837
 *
 * @param string $title The value of the calendar widget's title for this instance.
 * @param unknown $instance
 * @param string $id_base
 * @return string Calendar widget title.
 */
function oxygen_calendar_widget_title( $title = '', $instance = '', $id_base = '' ) {
	if ( 'calendar' == $id_base && '&nbsp;' == $title )
		$title = '';

	return $title;
}
add_filter( 'widget_title', 'oxygen_calendar_widget_title', 10, 3 );
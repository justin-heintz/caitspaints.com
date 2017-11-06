<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

global $themecolors;

/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors
 * @since Oxygen 0.2.2
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'bbbbbb',
	'text' => '444444',
	'link' => '0da4d3',
	'url' => '0da4d3'
);

/**
 * Add support for WP.com global print CSS
 */
add_theme_support( 'print-style' );

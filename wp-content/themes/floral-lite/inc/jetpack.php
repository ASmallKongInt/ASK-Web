<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Floral
 */

/**
 * Jetpack setup function.
 */
function floral_jetpack_setup() {
	// Social menu.
	add_theme_support( 'jetpack-social-menu' );

	// Responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Featured content.
	add_theme_support( 'featured-content', array(
		'filter'    => 'floral_get_featured_posts',
		'max_posts' => 10,
	) );
}
add_action( 'after_setup_theme', 'floral_jetpack_setup' );

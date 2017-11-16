<?php
/**
 * Back compat functionality
 *
 * Prevents this theme from running on PHP versions prior to 5.4.0
 */

/**
 * Prevent switching to this theme on older versions of PHP.
 *
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
function neville_bc_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'neville_bc_upgrade_notice' );
}
add_action( 'after_switch_theme', 'neville_bc_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * @since 1.0.0
 */
function neville_bc_upgrade_notice() {
	$message = sprintf( __( 'Neville requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'neville' ), PHP_VERSION );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded
 *
 * @since 1.0.0
 */
function neville_bc_customize() {
	wp_die( sprintf( __( 'Neville requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'neville' ), PHP_VERSION ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'neville_bc_customize' );

/**
 * Prevents the Theme Preview from being loaded
 *
 * @since 1.0.0
 */
function neville_bc_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Neville requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'neville' ), PHP_VERSION ) );
	}
}
add_action( 'template_redirect', 'neville_bc_preview' );

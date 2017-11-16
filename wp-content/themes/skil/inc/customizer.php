<?php
/**
 * skil Theme Customizer.
 *
 * @package skil
 */

function skil_default_theme_settings() {
	return array(
		'skil_black_site_logo'      	=> '',
		'skil_home_sidebar_position'    => 'without-sidebar',
		'skil_archive_sidebar_position' => 'without-sidebar',
		'skil_page_sidebar_position' 	=> 'without-sidebar',
		'skil_search_sidebar_position' 	=> 'without-sidebar',
		'skil_article_sidebar_position' => 'without-sidebar',
	);
}

/**
 * Filter theme mods with default valuw when they are not set in database.
 */
function skil_set_default_theme_settings( $mod ) {
	global $skil_mods;
	
	// Cache theme mods array
	if( ! isset( $skil_mods ) ) {
		$skil_mods = get_theme_mods();
	}
	
	$defaults = skil_default_theme_settings();
	$name = str_replace( 'theme_mod_', '', current_filter() );
	
	// No value in database, retrieve from default array
	if( ! isset( $skil_mods[$name] ) ) {
		$mod = $defaults[$name];
	}
	
	return $mod;
}

/**
 * Set default settings filter for each theme mod.
 */
function skil_set_default_theme_settings_filter() {
	$mods = skil_default_theme_settings();
	foreach( $mods as $mod => $value ) {
		add_filter( "theme_mod_{$mod}", 'skil_set_default_theme_settings' );
	}
}
add_action( 'init', 'skil_set_default_theme_settings_filter' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function skil_customize_register( $wp_customize ) {

	$defaults = skil_default_theme_settings();
	$type     = 'theme_mod';
	$cap      = 'edit_theme_options';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_section( 'skil_sideber_options', array(
		'title'          => __( 'Sidebar Options', 'skil' ),
		'priority'       => 35,
	) );
	$wp_customize->add_section( 'skil_contact', array(
		'title'          => __( 'Contact', 'skil' ),
		'priority'       => 35,
	) );
	$wp_customize->add_section( 'skil_author', array(
		'title'          => __( 'Author', 'skil' ),
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'skil_black_site_logo', array(
		'default'           => $defaults['skil_black_site_logo'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_setting( 'skil_home_sidebar_position', array(
		'default'           => $defaults['skil_home_sidebar_position'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'skil_sanitize_select',
	) );
	$wp_customize->add_setting( 'skil_archive_sidebar_position', array(
		'default'           => $defaults['skil_archive_sidebar_position'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'skil_sanitize_select',
	) );
	$wp_customize->add_setting( 'skil_page_sidebar_position', array(
		'default'           => $defaults['skil_page_sidebar_position'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'skil_sanitize_select',
	) );
	$wp_customize->add_setting( 'skil_search_sidebar_position', array(
		'default'           => $defaults['skil_search_sidebar_position'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'skil_sanitize_select',
	) );
	$wp_customize->add_setting( 'skil_article_sidebar_position', array(
		'default'           => $defaults['skil_article_sidebar_position'],
		'type'              => $type,
		'capability'        => $cap,
		'sanitize_callback' => 'skil_sanitize_select',
	) );

	$wp_customize->add_control( 'skil_home_sidebar_position', array(
		'label'      => __( 'Home Sidebar Position', 'skil' ),
		'section'    => 'skil_sideber_options',
		'type'       => 'select',
		'choices'    => skil_sidebar_position_option(),
		'settings'   => 'skil_home_sidebar_position',
	) );
	$wp_customize->add_control( 'skil_archive_sidebar_position', array(
		'label'      => __( 'Archive Sidebar Position', 'skil' ),
		'section'    => 'skil_sideber_options',
		'type'       => 'select',
		'choices'    => skil_sidebar_position_option(),
		'settings'   => 'skil_archive_sidebar_position',
	) );
	$wp_customize->add_control( 'skil_page_sidebar_position', array(
		'label'      => __( 'Page Sidebar Position', 'skil' ),
		'section'    => 'skil_sideber_options',
		'type'       => 'select',
		'choices'    => skil_sidebar_position_option(),
		'settings'   => 'skil_page_sidebar_position',
	) );
	$wp_customize->add_control( 'skil_search_sidebar_position', array(
		'label'      => __( 'Search Sidebar Position', 'skil' ),
		'section'    => 'skil_sideber_options',
		'type'       => 'select',
		'choices'    => skil_sidebar_position_option(),
		'settings'   => 'skil_search_sidebar_position',
	) );
	$wp_customize->add_control( 'skil_article_sidebar_position', array(
		'label'      => __( 'Article Sidebar Position', 'skil' ),
		'section'    => 'skil_sideber_options',
		'type'       => 'select',
		'choices'    => skil_sidebar_position_option(),
		'settings'   => 'skil_article_sidebar_position',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'black_site_logo', array(
		'label'      => esc_html__( 'Black Logo', 'skil' ),
		'section'    => 'title_tagline',
		'settings'   => 'skil_black_site_logo',
	) ) );

}
add_action( 'customize_register', 'skil_customize_register' );

function skil_sidebar_position_option() {
	return array(
		'without-sidebar'  	=> esc_html__( 'Without Sidebar', 'skil' ),
		'left-sidebar'   	=> esc_html__( 'Left Sidebar',    'skil' ),
		'right-sidebar'     => esc_html__( 'Right Sidebar',	  'skil' ),
	);
}

/**
 * Sanitize AJAX Spinners.
 */
function skil_sanitize_select( $input ) {
	if( array_key_exists( $input, skil_sidebar_position_option() ) ) {
		return $input;
	}
	
	return 'wandering-cubes';
}

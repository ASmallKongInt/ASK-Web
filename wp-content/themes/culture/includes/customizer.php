<?php
/**
 * Culture Customizer functionality
 *
 * @subpackage Culture
 * @since Culture 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Culture 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function culture_customize_register( $wp_customize ) 
{	
	$image_dirpath = get_template_directory_uri() . '/images/';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->remove_section( 'colors' );
	
	//-----------------------------------------------------------------
	// CULTURE : CUSTOMIZER PANELS ------------------------------------
	//-----------------------------------------------------------------

	$wp_customize->add_panel( 'general_options', array(
		'title' 	=> __( 'General Options','culture'),
		'priority' 	=> 11,
	));
	
	//-----------------------------------------------------------------
	// CULTURE : HEADER SETTINGS SECTION ------------------------------
	//-----------------------------------------------------------------
	
	// Create "HEDAER SETTINGS" section in customizer 
	$wp_customize->add_section(
		'culture_header_section',
		array(
			'title'       => __('Header Settings','culture'),
			'panel' 	  => 'general_options',
		)
	);
	
	// Mobile Menu Activation Width
	$wp_customize->add_setting( 
		'mob_menu_active', 
		array(
			'default'        => '1024',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'mob_menu_active', 
		array(
			'label'       => __('Mobile Menu Activate Width','culture'),
			'description' => __('Layout width (without unit) after which mobile menu will get activated (default : 1024)','culture'),
			'section'     => 'culture_header_section',
		)
	);
	
	// Header Sticky Option
	
	$wp_customize->add_setting( 
		'header_sticky', 
		array(
			'default'        => 'on',
			'sanitize_callback' => 'culture_sanitize_on_off',
		)
	);
	$wp_customize->add_control(
		'header_sticky', 
		array(
			'label'       => __('Header Sticky (On/Off)','culture'),
			'description' => __('Enable/disable header sticky feature for desktop viewers.','culture'),
			'type'        => 'select',
			'choices'     => array(
				'on' => __('On', 'culture' ),
				'off'=> __('Off', 'culture' ),
			),
			'section'     => 'culture_header_section'
		)
	);
	
	
	//-----------------------------------------------------------------
	// CULTURE : FOOTER SECTION ---------------------------------------
	//-----------------------------------------------------------------
	
	// Create "Footer" section in customizer 
	$wp_customize->add_section(
		'culture_footer_section',
		array(
			'title'       => __('Footer Settings','culture'),
			'description' => __('Add information about footer copyright.','culture'),
			'panel' 	  => 'general_options',
		)
	);
	
	// Footer Copyright
	$wp_customize->add_setting( 
		'culture_copyright', 
		array(
			'default'        => 'Copyright © 2017 WordPress Theme ',
			'sanitize_callback' => 'culture_sanitize_textarea',
		)
	);
	
	$wp_customize->add_control( 
		'culture_copyright', 
		array(
			'label'       => __('Footer Copyright Text','culture'),
			'type'        => 'textarea',
			'section'     => 'culture_footer_section',
		)
	);
	// Facebook Icon URL 
	$wp_customize->add_setting( 
		'footer_fbicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_fbicon', 
		array(
			'label'       => __('Facebook URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);
	
	// Twitter Icon URL 
	$wp_customize->add_setting( 
		'footer_twicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_twicon', 
		array(
			'label'       => __('Twitter URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);
	
	// Google Plus Icon URL 
	$wp_customize->add_setting( 
		'footer_gpicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_gpicon', 
		array(
			'label'       => __('Google+ URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);
	
	// Dribbble Icon URL 
	$wp_customize->add_setting( 
		'footer_dribicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_dribicon', 
		array(
			'label'       => __('Dribbble URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);
	
	// Linkedin Icon URL 
	$wp_customize->add_setting( 
		'footer_linkdicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_linkdicon', 
		array(
			'label'       => __('Linkedin URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);	
	
	// Pinterest Icon URL 
	$wp_customize->add_setting( 
		'footer_piniticon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_piniticon', 
		array(
			'label'       => __('Pinterest URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);
	
	// Flickr Icon URL 
	$wp_customize->add_setting( 
		'footer_flickricon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_flickricon', 
		array(
			'label'       => __('Flickr URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);	
	
	// Instagram Icon URL 
	$wp_customize->add_setting( 
		'footer_instaicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_instaicon', 
		array(
			'label'       => __('Instagram URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);	
	
	// Youtube Icon URL 
	$wp_customize->add_setting( 
		'footer_yticon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_yticon', 
		array(
			'label'       => __('Youtube URL','culture'),
			'section'     => 'culture_footer_section',
		)
	);	
	
	//-----------------------------------------------------------------
	// CULTURE : HEADER BANNER OPTIONS (PANEL) ------------------------
	//-----------------------------------------------------------------
		
	//-----------------------------------------------------------------
	// CULTURE : HEADER BANNER IMAGE CONTENT SECTION ------------------
	//-----------------------------------------------------------------
		
	// Create "Header author Image Content" section in customizer 
	
	$wp_customize->add_section(
		'culture_header_author_content_section',
		array(
			'title'       => __('Header Banner Options','culture'),
			'description' => __('Please add content for header banner section.','culture'),
			'priority' 	=> 11,
		)
	);
	
	// create an empty array
	$user = array();
	
	// we loop over the categories and set the names and
	// labels we need
	foreach ( get_users() as $username ){
		//$user[$category->term_id] = $category->name;
		$user[$username->ID] =  $username->data->display_name ;
	}
	
	// Contact Section
	$wp_customize->add_setting( 'user_id', array(
	  'sanitize_callback' => 'absint',
	  'default' => 'admin',
	) );

	$wp_customize->add_control( 'user_id', array(
	  'type' => 'select',
	  'section' => 'culture_header_author_content_section', // Add a default or your own section
	  'label' => __( 'Please Select User','culture' ),
	  'choices' => $user,
	) );
	
	// Facebook Icon URL 
	$wp_customize->add_setting( 
		'fbicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'fbicon', 
		array(
			'label'       => __('Facebook URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);
	
	// Twitter Icon URL 
	$wp_customize->add_setting( 
		'twicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'twicon', 
		array(
			'label'       => __('Twitter URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);
	
	// Google Plus Icon URL 
	$wp_customize->add_setting( 
		'gpicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'gpicon', 
		array(
			'label'       => __('Google+ URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);
	
	// Dribbble Icon URL 
	$wp_customize->add_setting( 
		'dribicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'dribicon', 
		array(
			'label'       => __('Dribbble URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);
	
	// Linkedin Icon URL 
	$wp_customize->add_setting( 
		'linkdicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'linkdicon', 
		array(
			'label'       => __('Linkedin URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);	
	
	// Pinterest Icon URL 
	$wp_customize->add_setting( 
		'piniticon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'piniticon', 
		array(
			'label'       => __('Pinterest URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);
	
	// Flickr Icon URL 
	$wp_customize->add_setting( 
		'flickricon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'flickricon', 
		array(
			'label'       => __('Flickr URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);	
	
	// Instagram Icon URL 
	$wp_customize->add_setting( 
		'instaicon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'instaicon', 
		array(
			'label'       => __('Instagram URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);	
	
	// Youtube Icon URL 
	$wp_customize->add_setting( 
		'yticon', 
		array(
			'default'        => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'yticon', 
		array(
			'label'       => __('Youtube URL','culture'),
			'section'     => 'culture_header_author_content_section',
		)
	);	
}
add_action( 'customize_register', 'culture_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Culture 1.0
 */
function culture_customize_preview_js() {
	wp_enqueue_script( 'culture-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'culture_customize_preview_js' );

// Santize a Textarea Field
function culture_sanitize_textarea( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

// Sanitize On-Off Field
function culture_sanitize_on_off( $input ) {
	if ( $input == 'on' ) {
        return 'on';
    } else {
        return 'off';
    }
}


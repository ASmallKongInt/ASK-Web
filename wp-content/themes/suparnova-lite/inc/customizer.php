<?php
/**
 * Suparnova Theme Customizer
 *
 * @package Suparnova
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function suparnova_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'suparnova_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function suparnova_lite_customize_preview_js() {
	
	$my_js_ver = date( "ymd-Gis", filemtime( get_template_directory() . '/assets/js/customizer.js' ) );
	wp_enqueue_script( 'suparnova_lite_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), $my_js_ver, true );
	
}
add_action( 'customize_preview_init', 'suparnova_lite_customize_preview_js' );

/**
 * Getting option
 */
function suparnova_lite_theme_option( $option, $default = null, $prefix = 'suparnova_options' ) {

	global $suparnova_lite_default_options;

	$all_def = (array)$suparnova_lite_default_options;

	$default = ( is_null( $default ) && isset( $all_def[ $option ] ) ) ? $all_def[ $option ] : $default;

	if( empty( $prefix ) ) {
		return get_option( $option, $default );
	}

	$options = get_option( $prefix, array() );

	if( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	} else {
		return $default;
	}
}

function suparnova_lite_theme_mod( $option, $prefix = 'suparnova_options' ) {
	return get_theme_mod( $prefix . $option );
}

/**
 * Renders areas for selective refresh
 */
function suparnova_lite_top_header_selective_render() {
	get_template_part( 'components/navigation/navigation', 'top' );
}

function suparnova_lite_main_nav_selective_render() {
	get_template_part( 'components/navigation/navigation', 'main' );
}

function suparnova_lite_logo_selective_render() {
	get_template_part( 'components/header/site', 'branding' );
}

function suparnova_lite_site_footer_selective_render() {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col-md-8">
				<?php get_template_part( 'components/footer/site', 'info' ); ?>
			</div>
			<div class="col-md-4">
				<?php get_template_part( 'components/footer/site', 'socials' ); ?>
			</div>
		</div>
	</footer>
	<?php
}

function suparnova_lite_footer_widgets_selective_render() {
	suparnova_lite_footer_widgets();
}

function suparnova_lite_footer_banner_selective_render() {
	suparnova_lite_footer_banner();
}

/**
 * Sanitize functions
 */
function suparnova_lite_sanitize_html_array() {
	return array(
		'a' => array(
			'href' => array(),
			'rel' => array(),
			'class' => array(),
		),
		'i' => array(),
		'u' => array(),
		'b' => array(),
		'span' => array(
			'class' => array(),
		),
		'strong' => array(
			'class' => array(),
		),
		'em' => array(
			'class' => array(),
		),
	);
}
function suparnova_lite_banner_allowed_html() {
	
	return array(
		'a' => array(
			'href' => array(),
			'rel' => array(),
			'class' => array(),
		),
		'img' => array(
			'src' => array(),
			'alt' => array(),
			'height' => array(),
			'width' => array(),
			'class' => array(),
		),
		'div' => array(
			'class' => array(),
			'style' => array(),
		),
		'strong' => array(
			'class' => array(),
		),
		'em' => array(
			'class' => array(),
		),
		'script' => array(
			'async' => array(),
			'src' => array(),
			'type' => array(),
			'data-id' => array(),
			'data-format' => array(),
		),
		'ins' => array(
			'class' => array(),
			'style' => array(),
			'data-ad-client' => array(),
			'data-ad-slot' => array(),
			'data-ad-format' => array(),
		),
	);
	
}
function suparnova_lite_modify_safe_css( $styles ) {
    $styles[] = 'display';
    return $styles;
}
function suparnova_lite_sanitize_banner( $html ) {
	add_filter( 'safe_style_css', 'suparnova_lite_modify_safe_css' );
	$html = wp_kses( $html, suparnova_lite_banner_allowed_html() );
	remove_filter( 'safe_style_css', 'suparnova_lite_modify_safe_css' );
	return $html;
}
function suparnova_lite_sanitize_html( $html ) {
	return wp_kses( $html, suparnova_lite_sanitize_html_array() );
}

/**
 * Create customizer panels
 */
new Suparnova_Lite_Customizer_API( array(
	'_sn_header' => array(
		'title' => __( 'Header', 'suparnova-lite' ),
		'description' => __( 'Control your site\'s header from here. These options are shipped with suparnova theme only.', 'suparnova-lite' ),
		'priority' => 160,
		'sections' => array(
			'_sn_top_header' => array(
				'title' => __( 'Top Header', 'suparnova-lite' ),
				'fields' => array(
					'top_header' => array(
						'setting' => array(
							'default' => '',
						),
						'control' => array(
							'type' => 'checkbox',
							'priority' => 10,
							'label' => __( 'Disable Top header', 'suparnova-lite' ),
							'input_attrs' => array(
								'value' => 'yes',
							),
						),
						'partial' => array(
							'selector' => '.site-top-header',
							'container_inclusive' => true,
							'render_callback' => 'suparnova_lite_top_header_selective_render',
							'fallback_refresh' => true,
						),
					),
					'top_header_left' => array(
						'setting' => array(
							'default' => 'none',
						),
						'control' => array(
							'type' => 'select',
							'priority' => 10,
							'choices' => array(
								'none' => __( 'None', 'suparnova-lite' ),
								'text' => __( 'Simple text', 'suparnova-lite' ),
								'social' => __( 'Social Menu', 'suparnova-lite' ),
								'nav' => __( 'Nav Menu', 'suparnova-lite' ),
							),
							'label' => __( 'Top header left type', 'suparnova-lite' ),
							'description' => __( 'Only Applies if top header is enabled.', 'suparnova-lite' ),
						),
						'partial' => array(
							'selector' => '.site-top-header',
							'container_inclusive' => true,
							'render_callback' => 'suparnova_lite_top_header_selective_render',
							'fallback_refresh' => true,
						),
					),
					'top_header_left_txt' => array(
						'sanitize' => 'suparnova_lite_sanitize_html',
						'setting' => array(
							'default' => '',
						),
						'control' => array(
							'type' => 'text',
							'priority' => 10,
							'label' => __( 'Left area text', 'suparnova-lite' ),
							'description' => __( 'Only Applies if top header is enabled and text is selected as left area content.', 'suparnova-lite' ),
						),
					),
					'top_header_right' => array(
						'setting' => array(
							'default' => 'none',
						),
						'control' => array(
							'type' => 'select',
							'priority' => 10,
							'choices' => array(
								'none' => __( 'None', 'suparnova-lite' ),
								'text' => __( 'Simple text', 'suparnova-lite' ),
								'social' => __( 'Social Menu', 'suparnova-lite' ),
								'nav' => __( 'Nav Menu', 'suparnova-lite' ),
							),
							'label' => __( 'Top header right type', 'suparnova-lite' ),
							'description' => __( 'Only Applies if top header is enabled.', 'suparnova-lite' ),
						),
						'partial' => array(
							'selector' => '.site-top-header',
							'container_inclusive' => true,
							'render_callback' => 'suparnova_lite_top_header_selective_render',
							'fallback_refresh' => true,
						),
					),
					'top_header_right_txt' => array(
						'sanitize' => 'suparnova_lite_sanitize_html',
						'setting' => array(
							'default' => '',
						),
						'control' => array(
							'type' => 'text',
							'priority' => 10,
							'label' => __( 'Right area text', 'suparnova-lite' ),
							'description' => __( 'Only Applies if top header is enabled and text is selected as left right content.', 'suparnova-lite' ),
						),
					),
					'top_header_color' => array(
						'setting' => array(
							'default' => 'dark',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'dark' => __( 'Dark', 'suparnova-lite' ),
								'white' => __( 'White', 'suparnova-lite' ),
							),
							'label' => __( 'Top header color scheme', 'suparnova-lite' ),
						),
					),
					'top_header_sub_color' => array(
						'setting' => array(
							'default' => 'white',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'dark' => __( 'Dark', 'suparnova-lite' ),
								'white' => __( 'White', 'suparnova-lite' ),
							),
							'label' => __( 'Top header sub-menu color scheme', 'suparnova-lite' ),
						),
					),
				),
			),
			'_sn_logo_area' => array(
				'title' => __( 'Logo area', 'suparnova-lite' ),
				'desc' => __( 'Select the logo image from Site Identity', 'suparnova-lite' ),
				'fields' => array(
					'ad_area' => array(
						'sanitize' => 'suparnova_lite_sanitize_banner',
						'setting' => array(
						),
						'control' => array(
							'type' => 'textarea',
							'priority' => 10,
							'label' => __( 'Banner Code', 'suparnova-lite' ),
							'description' => __( 'Paste your banner code here from google adsense or any other provider or your own custom banner.', 'suparnova-lite' ),
						),
						'partial' => array(
							'selector' => '.site-header .site-branding',
							'container_inclusive' => true,
							'render_callback' => 'suparnova_lite_logo_selective_render',
							'fallback_refresh' => true,
						),
					),
					'logo_area_height' => array(
						'setting' => array(
							'default' => '100',
						),
						'control' => array(
							'type' => 'range',
							'priority' => 10,
							'label' => __( 'Logo Area Height', 'suparnova-lite' ),
							'description' => __( 'Drag to change the height of the logo area. Minimum is 100px and maximum is 1000px. Height must be at least double of normal if center alignment used with a banner.', 'suparnova-lite' ),
							'input_attrs' => array(
								'min' => 100,
								'max' => 1000,
								'step' => 5,
							),
						),
					),
					'logo_alignment' => array(
						'setting' => array(
							'default' => 'left',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'left' => __( 'Left', 'suparnova-lite' ),
								'center' => __( 'Center', 'suparnova-lite' ),
								'right' => __( 'Right', 'suparnova-lite' ),
							),
							'label' => __( 'Logo Alignment', 'suparnova-lite' ),
						),
					),
				),
			),
			'_sn_primary_menu' => array(
				'title' => __( 'Primary Menu area', 'suparnova-lite' ),
				'fields' => array(
					'menu_alignment' => array(
						'setting' => array(
							'default' => 'left',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'left' => __( 'Left', 'suparnova-lite' ),
								'center' => __( 'Center', 'suparnova-lite' ),
								'right' => __( 'Right', 'suparnova-lite' ),
							),
							'label' => __( 'Menu Alignment', 'suparnova-lite' ),
						),
					),
					'menu_color' => array(
						'setting' => array(
							'default' => 'white',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'dark' => __( 'Dark', 'suparnova-lite' ),
								'white' => __( 'White', 'suparnova-lite' ),
							),
							'label' => __( 'Menu bar color scheme', 'suparnova-lite' ),
						),
					),
					'menu_sub_color' => array(
						'setting' => array(
							'default' => 'dark',
						),
						'control' => array(
							'type' => 'radio',
							'priority' => 10,
							'choices' => array(
								'dark' => __( 'Dark', 'suparnova-lite' ),
								'white' => __( 'White', 'suparnova-lite' ),
							),
							'label' => __( 'Sub-menu color scheme', 'suparnova-lite' ),
						),
					),
					'header_search' => array(
						'setting' => array(
							'default' => '',
						),
						'control' => array(
							'type' => 'checkbox',
							'priority' => 10,
							'label' => __( 'Disable Search on menu bar', 'suparnova-lite' ),
							'input_attrs' => array(
								'value' => 'yes',
							),
						),
						'partial' => array(
							'selector' => '.main-navigation',
							'container_inclusive' => true,
							'render_callback' => 'suparnova_lite_main_nav_selective_render',
							'fallback_refresh' => true,
						),
					),
				),
			),
		),
	),
), array(
	'prefix' => 'suparnova_options',
	'transport' => 'postMessage',
	'in_array' => true,
) );

$social_fields = array();
$social_array = suparnova_lite_social_media_array();

foreach ( $social_array as $media => $params ) {
	$social_fields[ '[' . $media . ']' ] = array(
		'prefix' => '_ts_social_media_urls',
		'sanitize' => 'esc_url',
		'setting' => array(
			'default' => '',
			'transport' => 'refresh',
		),
		'control' => array(
			'type' => 'text',
			'priority' => 10,
			'label' => $params['title'],
		),
	);
}

new Suparnova_Lite_Customizer_API( array(
	'colors' => array(
		'title' => __( 'Colors', 'suparnova-lite' ),
		'fields' => array(
			'site_color' => array(
				'setting' => array(
					'default' => 'def',
					'transport' => 'refresh',
				),
				'control' => array(
					'type' => 'radio',
					'priority' => 10,
					'label' => __( 'Skin', 'suparnova-lite' ),
					'choices' => array(
						'def' => __( 'Default', 'suparnova-lite' ),
						'green' => __( 'Green', 'suparnova-lite' ),
						'blue' => __( 'Blue', 'suparnova-lite' ),
						'purple' => __( 'Purple', 'suparnova-lite' ),
					),
				),
			),
		),
	),
	'_sn_socials' => array(
		'title' => __( 'Social Links', 'suparnova-lite' ),
		'description' => __( 'These links will be used all over the site where social menu or urls will be shown.', 'suparnova-lite' ),
		'priority' => 160,
		'fields' => $social_fields,
	),
	'_sn_blog' => array(
		'title' => __( 'Blog Options', 'suparnova-lite' ),
		'description' => __( 'Some extra options for your blog.', 'suparnova-lite' ),
		'priority' => 160,
		'fields' => array(
			'enable_schema' => array(
				'setting' => array(
					'default' => '',
					'transport' => 'refresh',
				),
				'control' => array(
					'type' => 'checkbox',
					'priority' => 10,
					'label' => __( 'Enable Schema.org markup', 'suparnova-lite' ),
				),
			),
			'enable_hrt_comment' => array(
				'setting' => array(
					'default' => '',
					'transport' => 'refresh',
				),
				'control' => array(
					'type' => 'checkbox',
					'priority' => 10,
					'label' => __( 'Enable Human Readable Time for comments', 'suparnova-lite' ),
					'description' => __( 'Aka. xx Minutes ago', 'suparnova-lite' ),
				),
			),
			'enable_hrt_date' => array(
				'setting' => array(
					'default' => '',
					'transport' => 'refresh',
				),
				'control' => array(
					'type' => 'checkbox',
					'priority' => 10,
					'label' => __( 'Enable Human Readable Time for posts', 'suparnova-lite' ),
					'description' => __( 'Aka. xx Minutes ago', 'suparnova-lite' ),
				),
			),
		),
	),
	'_sn_footer' => array(
		'title' => __( 'Footer', 'suparnova-lite' ),
		'description' => __( 'Set up your site\'s footer from here.', 'suparnova-lite' ),
		'priority' => 160,
		'fields' => array(
			'copyright' => array(
				'sanitize' => 'suparnova_lite_sanitize_html',
				'setting' => array(
					/* translators: 1: WordPress.org url, 2: Themestones.net url */
					'default' => sprintf( __( 'Proudly powered by <a href="%1$s">WordPress</a> | Theme: Suparnova by <a href="%2$s">ThemeStones</a>.', 'suparnova-lite' ), esc_url( 'https://wordpress.org/' ), esc_url( 'http://themestones.net/' ) ),
				),
				'control' => array(
					'type' => 'textarea',
					'priority' => 10,
					'label' => __( 'Copyright Text', 'suparnova-lite' ),
				),
			),
			'footer_banner' => array(
				'sanitize' => 'suparnova_lite_sanitize_banner',
				'setting' => array(
					'default' => '',
				),
				'control' => array(
					'type' => 'textarea',
					'priority' => 10,
					'label' => __( 'Footer Banner Code', 'suparnova-lite' ),
				),
				'partial' => array(
					'selector' => '.suparnova-lite-footer-banner',
					'container_inclusive' => true,
					'render_callback' => 'suparnova_lite_footer_banner_selective_render',
					'fallback_refresh' => true,
				),
			),
			'footer_widgets' => array(
				'setting' => array(
					'default' => '',
				),
				'control' => array(
					'type' => 'checkbox',
					'priority' => 10,
					'label' => __( 'Footer Widgets', 'suparnova-lite' ),
				),
				'partial' => array(
					'selector' => '.suparnova-lite-footer-widgets',
					'container_inclusive' => true,
					'render_callback' => 'suparnova_lite_footer_widgets_selective_render',
					'fallback_refresh' => true,
				),
			),
			'footer_socials' => array(
				'setting' => array(
					'default' => '',
				),
				'control' => array(
					'type' => 'checkbox',
					'priority' => 10,
					'label' => __( 'Enable footer social links', 'suparnova-lite' ),
					'input_attrs' => array(
						'value' => 'yes',
					),
				),
				'partial' => array(
					'selector' => 'footer#colophon',
					'container_inclusive' => true,
					'render_callback' => 'suparnova_lite_site_footer_selective_render',
					'fallback_refresh' => true,
				),
			),
		),
	),
), array(
	'prefix' => 'suparnova_options',
	'direct' => true,
	'in_array' => true,
) );
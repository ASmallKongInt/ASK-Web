<?php
# Check if This is read by WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'ShapeShifter_Theme_Customizer' ) ) {

/**
 * Theme Customizer Init
**/
class ShapeShifter_Theme_Customizer {

	# Vars
		/**
		 * Theme Mods
		 * 
		 * @var $theme_mods
		**/
		public $theme_mods = array();

		/**
		 * Icons
		 * 
		 * @var $icons
		**/
		public $icons = array();

		/**
		 * Post Types
		 * 
		 * @var $post_types
		**/
		public $post_types = array();

		/**
		 * Page Types
		 * 
		 * @var $page_types
		**/
		public $page_types = array();

		/**
		 * Widget Areas Settings
		 * 
		 * @var $widget_areas_settings
		**/
		public $widget_areas_settings = array();

		/**
		 * Animate CSS
		 * 
		 * @var $animate_css
		**/
		public $animate_css = array();

		/**
		 * Font Families
		 * 
		 * @var $font_families
		**/
		public $font_families = array();

		/**
		 * Register Widget Areas
		 * 
		 * @var $widget_manager
		**/
		public $widget_manager = array();

		/**
		 * Register Widget Areas
		 * 
		 * @var $shapeshifter_theme_customizer_settings
		**/
		public $shapeshifter_theme_customizer_settings = array();

		/**
		 * ShapeShifter_Theme_Customizer_Settings
		 * 
		 * @var object $wp_customize
		**/
		public $wp_customize;

		/**
		 * Selective Refresh Availability
		 * 
		 * @var bool $can_selective_refresh
		**/
		public $can_selective_refresh;

	/**
	 * Constructors
	**/
	function __construct() {

		global $content_width;
		$this->content_width = $content_width;

		// Define
			// Theme Mods
			$this->theme_mods = ShapeShifter_Theme_Mods::get_theme_mods( SHAPESHIFTER_MAYBE_CHILD_THEME_OPTIONS );
			$this->theme_mods["blogname"] = SHAPESHIFTER_SITE_NAME;
			$this->theme_mods["blogdescription"] = SHAPESHIFTER_SITE_DESCRIPTION;

			// Animate CSS
			$this->animate_css = ShapeShifter_Theme_Mods::get_animate_css_class_array();

			// Font Families
			$this->font_families = ShapeShifter_Theme_Mods::get_shapeshifter_font_families();

			// Image Sizes
			$this->background_image_sizes = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_size();
			// Background Position Row
			$this->background_position_row = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_position_row();
			// Background Position Column
			$this->background_position_column = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_position_column();
			// Background Repeat
			$this->background_repeats = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_repeats();
			// Background Attachment
			$this->background_attachments = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_attachments();

			// Footer Align
			$this->footer_align = ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_footer_aligns();
				
		// Actions
			// Setup Theme Customizer
			add_action( 'customize_register', array( $this, 'set_theme_customizer' ) ); 
			// Preview Scripts
			add_action( 'customize_preview_init', array( $this, 'theme_customizer_live_preview' ), 11 );
			// Control Scripts
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'shapeshifter_theme_customizer_control_scripts' ) );

		// End Trigger
		shapeshifter_trigger_theme_customizer();

	}

	/**
	 * Setup Theme Customizer
	 * 
	 * @see $this->set_wp_default_theme_mods()
	 * @see $this->set_wrapper_theme_mods()
	 * @see $this->set_header_theme_mods()
	 * @see $this->set_nav_menu_theme_mods()
	 * @see $this->set_content_area_theme_mods()
	 * @see $this->set_archive_page_theme_mods()
	 * @see $this->set_singular_page_theme_mods()
	 * @see $this->set_footer_theme_mods()
	 * @see $this->set_standard_widget_areas_theme_mods()
	 * @see $this->set_others_theme_mods()
	**/
	function set_theme_customizer( $wp_customize ) {

		$this->wp_customize =& $wp_customize;
		$this->can_selective_refresh = isset( $this->wp_customize->selective_refresh );

		// WordPress
		$this->set_wp_default_theme_mods();

		// Wrapper
		$this->set_wrapper_theme_mods();

		// Header
		$this->set_header_theme_mods();

		// Nav Menu
		$this->set_nav_menu_theme_mods();

		// Content Area
		$this->set_content_area_theme_mods();

		// Archive
		$this->set_archive_page_theme_mods();

		// Singular
		$this->set_singular_page_theme_mods();

		// Footer
		$this->set_footer_theme_mods();

		// Standard Widget Areas
		$this->set_standard_widget_areas_theme_mods();

		// Others
		$this->set_others_theme_mods();

	}
		/**
		 * WordPress
		 * 		Setting IDs : "blogname", "blogdescription"
		**/
		function set_wp_default_theme_mods() {

			// Site Title
			$this->wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
			// Site Description
			$this->wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		}

			/**
			 * Get Site Name
			 * 
			 * @return Site Name
			**/
			public function partial_refresh_render_callback_for_blogname( $theme_mods ) {

				return $this->theme_mods['blogname'];

			}

			/**
			 * Get Site Description
			 * 
			 * @return Site Name
			**/
			public function partial_refresh_render_callback_for_blogdescription( $theme_mods ) {

				return $this->theme_mods['blogdescription'];

			}

		/**
		 * Wrapper
		 * 		Panel IDs   : "body_styles_panel"
		 * 		Section IDs : "common_styles_section" 
		 * 		Setting IDs : "text_font_family", "is_responsive", "body_background_color", "text_color", "text_link_color"
		**/
		function set_wrapper_theme_mods() {

			// Body Panel
			$this->wp_customize->add_panel( 'body_styles_panel', array(
				//'priority'	   => 3,
				'capability'	 => 'edit_theme_options',
				'title'		  => esc_html__( 'Body', 'shapeshifter' ),
			));

				// Common Style Section
				$this->wp_customize->add_section( 'common_styles_section', array(
					'title' => esc_html__( 'Common Styles', 'shapeshifter' ),
					'panel' => 'body_styles_panel',
				));

					// Font Family
						$this->wp_customize->add_setting( 'text_font_family', array(
							'default'  => $this->theme_mods['text_font_family'],
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
						));
						$this->wp_customize->add_control( 'text_font_family', array(
							'section' => 'common_styles_section',
							'settings' => 'text_font_family',
							'label' => esc_html__( 'Standard Font', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->font_families,
						));

					// Is Responsive
						$this->wp_customize->add_setting( 'is_responsive', array(
							'default'  => false,
							//'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_responsive', array(
							'section' => 'common_styles_section',
							'settings' => 'is_responsive',
							'label' => esc_html__( 'Responsive Design', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Colors
						// Background
							$this->wp_customize->add_setting( 'body_background_color', array( 
								'default' => 'rgba(255,255,255,0.9)', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'body_background_color', array(
								'label' => esc_html__( 'Background Color', 'shapeshifter' ),
								'section' => 'common_styles_section',
								'settings' => 'body_background_color',
							)));

						// Text
							$this->wp_customize->add_setting( 'text_color', array( 
								'default' => '#666666', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'text_color', array(
								'label' => esc_html__( 'General Text Color', 'shapeshifter' ),
								'section' => 'common_styles_section',
								'settings' => 'text_color',
							)));

						// Text Link
							$this->wp_customize->add_setting( 'text_link_color', array( 
								'default' => '#337ab7', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'text_link_color', array(
								'label' => esc_html__( 'General Text Link Color', 'shapeshifter' ),
								'section' => 'common_styles_section',
								'settings' => 'text_link_color',
							)));

		}

		/**
		 * Header
		 * 		Panel IDs   : "header_settings_panel"
		 * 		Section IDs : "header_color_section" 
		 * 		Setting IDs : "header_background_color"
		 * 
		 * @see $this->set_header_title_theme_mods()
		 * @see $this->set_header_top_nav_menu_theme_mods()
		**/
		function set_header_theme_mods() {

			// Panel
				// Header Panel
				$this->wp_customize->add_panel( 'header_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		  => esc_html__( 'Header', 'shapeshifter' ),
					'description'	=> __( 'Styles of Logo ( Some of settings are meaningless for Mobile Devices )', 'shapeshifter' ),
				) );

			// Section
				// Header Section
					$this->wp_customize->add_section( 'header_color_section', array(
						'title' => esc_html__( 'Background', 'shapeshifter' ),
						'panel' => 'header_settings_panel'
					));
				
					// Background Color
						$this->wp_customize->add_setting( 'header_background_color', array( 
							'default' => 'rgba(255,255,255,0.9)', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'header_background_color', array(
							'label' => esc_html__( 'Background Color', 'shapeshifter' ),
							'section' => 'header_color_section',
							'settings' => 'header_background_color',
							'palette' => array(
								'rgba(255,255,255,0.9)',
							),
						)));

				# Header Title
				$this->set_header_title_theme_mods();

				$this->set_header_top_nav_menu_theme_mods();

		}

			/**
			 * Header Title
			 * 		Panel IDs   : "header_settings_panel" added by $this->set_header_theme_mods()
			 * 		Section IDs : "header_title_section" 
			 * 		Setting IDs : "header_site_name_font_family", "header_site_name_color", "header_site_description_font_family", "header_site_description_color"
			**/
			function set_header_title_theme_mods() {

				// Section 
					// Header Title Description Section
					$this->wp_customize->add_section( 'header_title_section', array(
						'title' => esc_html__( 'Title', 'shapeshifter' ),
						'panel' => 'header_settings_panel'
					));

				// Settings
					// Title
						// Font Family
							$this->wp_customize->add_setting( 'header_site_name_font_family', array(
								'default'  => $this->theme_mods['header_site_name_font_family'],
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							));
							$this->wp_customize->add_control( 'header_site_name_font_family', array(
								'section' => 'header_title_section',
								'settings' => 'header_site_name_font_family',
								'label' => esc_html__( 'Font Family of Title', 'shapeshifter' ),
								'type' => 'select',
								'choices' => $this->font_families,
							));

						// Site Name Color
							$this->wp_customize->add_setting( 'header_site_name_color', array( 
								'default' => '#000000', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'header_site_name_color', array(
								'label' => esc_html__( 'Site Name Color', 'shapeshifter' ),
								'section' => 'header_title_section',
								'settings' => 'header_site_name_color',
							)));

					// Description
						// Font Family
							$this->wp_customize->add_setting( 'header_site_description_font_family', array(
								'default'  => $this->theme_mods['header_site_description_font_family'],
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							));
							$this->wp_customize->add_control( 'header_site_description_font_family', array(
								'section' => 'header_title_section',
								'settings' => 'header_site_description_font_family',
								'label' => esc_html__( 'Font Family of Description', 'shapeshifter' ),
								'type' => 'select',
								'choices' => $this->font_families,
							));

						// Site Description Color
							$this->wp_customize->add_setting( 'header_site_description_color', array( 
								'default' => '#000000', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'header_site_description_color', array(
								'label' => esc_html__( 'Site Description Color', 'shapeshifter' ),
								'section' => 'header_title_section',
								'settings' => 'header_site_description_color',
							)));

			}

			/**
			 * Header Top Nav Menu
			 * 		Panel IDs   : "header_settings_panel" added by $this->set_header_theme_mods()
			 * 		Section IDs : "header_top_nav_menu_section" 
			 * 		Setting IDs : "header_top_nav_menu_font_family", "header_top_nav_menu_text_color"
			**/
			function set_header_top_nav_menu_theme_mods() {

				// Sections
					// Top Nav Menu
					$this->wp_customize->add_section( 'header_top_nav_menu_section', array(
						'title' => esc_html__( 'Top Nav Menu', 'shapeshifter' ),
						'panel' => 'header_settings_panel'
					));

				// Settings
					// Font Family
						$this->wp_customize->add_setting( 'header_top_nav_menu_font_family', array(
							'default'  => $this->theme_mods['header_top_nav_menu_font_family'],
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
						));
						$this->wp_customize->add_control( 'header_top_nav_menu_font_family', array(
							'section' => 'header_top_nav_menu_section',
							'settings' => 'header_top_nav_menu_font_family',
							'label' => esc_html__( 'Font Family of Nav Menus', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->font_families,
						));

					// Text Color
						$this->wp_customize->add_setting( 'header_top_nav_menu_text_color', array( 
							'default' => '#000000', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'header_top_nav_menu_text_color', array(
							'label' => esc_html__( 'Top Nav Menu Text Color', 'shapeshifter' ),
							'section' => 'header_top_nav_menu_section',
							'settings' => 'header_top_nav_menu_text_color',
						)));

			}

		/**
		 * Nav Menu
		 * 		Panel IDs : "sub_nav_menu_settings_panel"
		 * 
		 * @see $this->set_nav_menu_display_theme_mods()
		 * @see $this->set_nav_menu_colors_theme_mods()
		 * @see $this->set_nav_menu_background_image_theme_mods()
		 * @see $this->set_nav_menu_mobile_theme_mods()
		**/
		function set_nav_menu_theme_mods() {

			// Nav Menu
			$this->wp_customize->add_panel( 'sub_nav_menu_settings_panel', array(
				'capability'	 => 'edit_theme_options',
				'theme_supports' => '',
				'title'		  => esc_html__( 'Sub Nav Menu', 'shapeshifter' ),
				'description'	=> '',
			) );

			// Display
			$this->set_nav_menu_display_theme_mods();

			// Colors
			$this->set_nav_menu_colors_theme_mods();

			// Background Image
			$this->set_nav_menu_background_image_theme_mods();

			// Mobile
			$this->set_nav_menu_mobile_theme_mods();

		}

			/**
			 * Display
			 * 		Panel IDs   : "sub_nav_menu_settings_panel" added by $this->set_nav_menu_theme_mods()
			 * 		Section IDs : "nav_menu_display_section" 
			 * 		Setting IDs : "nav_text_font_family", "is_nav_menu_fixed", "nav_menu_add_search_box"
			**/
			function set_nav_menu_display_theme_mods() {

				// Sections
					// Nav Menu Section
					$this->wp_customize->add_section( 'nav_menu_display_section', array(
						'title' => esc_html__( 'Styles of Nav Menu', 'shapeshifter' ),
						'panel' => 'sub_nav_menu_settings_panel',
					));

				// Settings
					// Font Family
						$this->wp_customize->add_setting( 'nav_text_font_family', array(
							'default'  => $this->theme_mods['nav_text_font_family'],
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
						));
						$this->wp_customize->add_control( 'nav_text_font_family', array(
							'section' => 'nav_menu_display_section',
							'settings' => 'nav_text_font_family',
							'label' => esc_html__( 'Font Family', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->font_families,
						));

					// Is Nav Menu Fixed
						$this->wp_customize->add_setting( 'is_nav_menu_fixed', array(
							'default'  => false,
							//'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_nav_menu_fixed', array(
							'section' => 'nav_menu_display_section',
							'settings' => 'is_nav_menu_fixed',
							'label' => esc_html__( 'Fix to top when scrolling', 'shapeshifter' ),
							'description' => __( '* Recommend turning this OFF if you set widgets rendered by JavaScript in Widget Area hooked in "After Header" by plugin "WP Theme ShapeShifter Extensions". It\'s because this functionality measures fixing position when document loaded.', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Add Search Box
						$this->wp_customize->add_setting( 'nav_menu_add_search_box', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'nav_menu_add_search_box', array(
							'section' => 'nav_menu_display_section',
							'settings' => 'nav_menu_add_search_box',
							'label' => esc_html__( 'Append Search Box at last', 'shapeshifter' ),
							'type' => 'checkbox',
						));

			}

			/**
			 * Colors
			 * 		Panel IDs   : "sub_nav_menu_settings_panel" added by $this->set_nav_menu_theme_mods()
			 * 		Section IDs : "nav_menu_color_section" 
			 * 		Setting IDs : "nav_font_color", "nav_background_gradient_on", "nav_background_color", "nav_items_background_gradient_on", "nav_items_background_color", "header_image_and_nav_border_color", "nav_items_selected_border_color"
			**/
			function set_nav_menu_colors_theme_mods() {

				// Sections
					// Colors Section
					$this->wp_customize->add_section( 'nav_menu_color_section', array(
						'title' => esc_html__( 'Colors', 'shapeshifter' ),
						'panel' => 'sub_nav_menu_settings_panel',
					));
						
				// Settings
					// Text Color
						$this->wp_customize->add_setting( 'nav_font_color', array( 
							'default' => '#666666',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'nav_font_color', array(
							'label' => esc_html__( 'Text', 'shapeshifter' ),
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_font_color',
						)));

					// Is Nav Background Gradient On
						$this->wp_customize->add_setting( 'nav_background_gradient_on', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'nav_background_gradient_on', array(
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_background_gradient_on',
							'label' => esc_html__( 'Background Color Gradation', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Background Color
						$this->wp_customize->add_setting( 'nav_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'nav_background_color', array(
							'label' => esc_html__( 'Background Color of Nav Menu', 'shapeshifter' ),
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_background_color',
						)));

					// Is Items Background Gradient On
						$this->wp_customize->add_setting( 'nav_items_background_gradient_on', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'nav_items_background_gradient_on', array(
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_items_background_gradient_on',
							'label' => esc_html__( 'Background Color Gradation for Each Item', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Items Background Color
						$this->wp_customize->add_setting( 'nav_items_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'nav_items_background_color', array(
							'label' => esc_html__( 'Background Color of Each Item', 'shapeshifter' ),
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_items_background_color',
						)));

					// Logo Nav Border Color
						$this->wp_customize->add_setting( 'header_image_and_nav_border_color', array( 
							'default' => '#CCCCCC', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'header_image_and_nav_border_color', array(
							'label' => esc_html__( 'Border Top and Bottom', 'shapeshifter' ),
							'section' => 'nav_menu_color_section',
							'settings' => 'header_image_and_nav_border_color',
						)));

					// Selected Item Bottom Color
						$this->wp_customize->add_setting( 'nav_items_selected_border_color', array( 
							'default' => '', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'nav_items_selected_border_color', array(
							'label' => esc_html__( 'Underline Color of Each Items', 'shapeshifter' ),
							'section' => 'nav_menu_color_section',
							'settings' => 'nav_items_selected_border_color',
						)));

			}

			/**
			 * Background Image
			 * 		Panel IDs   : "sub_nav_menu_settings_panel" added by $this->set_nav_menu_theme_mods()
			 * 		Section IDs : "nav_menu_background_image_section" 
			 * 		Setting IDs : "nav_menu_background_image", "nav_menu_items_background_image"
			**/
			function set_nav_menu_background_image_theme_mods() {

				// Sections
					// Background Image Section
					$this->wp_customize->add_section( 'nav_menu_background_image_section', array(
						'title' => esc_html__( 'Background Image', 'shapeshifter' ),
						'panel' => 'sub_nav_menu_settings_panel',
					));

				// Settings
					// Background Image
						$this->wp_customize->add_setting( 'nav_menu_background_image', array(
							'default' => '',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'nav_menu_background_image', array(
								'label' => esc_html__( 'Background Image', 'shapeshifter' ),
								'description' => __( 'Assume to print as Texture ( This image will be repeated )', 'shapeshifter' ),
								'section' => 'nav_menu_background_image_section',
								'settings' => 'nav_menu_background_image',
							)
						));

					// Items Background Image
						$this->wp_customize->add_setting( 'nav_menu_items_background_image', array(
							'default' => '',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'nav_menu_items_background_image', array(
								'label' => esc_html__( 'Background Image for Each Item', 'shapeshifter' ),
								'section' => 'nav_menu_background_image_section',
								'settings' => 'nav_menu_items_background_image',
							)
						));	

			}

			/**
			 * Mobile
			 * 		Panel IDs   : "sub_nav_menu_settings_panel" added by $this->set_nav_menu_theme_mods()
			 * 		Section IDs : "nav_mobile_nav_menu_section" 
			 * 		Setting IDs : "nav_mobile_nav_menu_background_color"
			**/
			function set_nav_menu_mobile_theme_mods() {

				// Sections
					// Mobile Nav Menu Section
					$this->wp_customize->add_section( 'nav_mobile_nav_menu_section', array(
						'title' => esc_html__( 'Mobile Nav Menu', 'shapeshifter' ),
						'panel' => 'sub_nav_menu_settings_panel',
					));

				// Settings
					// Background Color
						$this->wp_customize->add_setting( 'nav_mobile_nav_menu_background_color', array( 
							'default' => '#666666',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'nav_mobile_nav_menu_background_color', array(
							'label' => esc_html__( 'Background Color', 'shapeshifter' ),
							'section' => 'nav_mobile_nav_menu_section',
							'settings' => 'nav_mobile_nav_menu_background_color',
						)));

			}

		/**
		 * Content Area
		 * 		Panel IDs : "content_area_settings_panel"
		 * 
		 * @see $this->set_content_area_design_theme_mods()
		 * @see $this->set_content_area_colors_theme_mods()
		 * @see $this->set_content_area_background_image_theme_mods()
		 * @see $this->set_main_content_background_image_theme_mods()
		**/
		function set_content_area_theme_mods() {

			// Panel
				// Content Area Panel
				$this->wp_customize->add_panel( 'content_area_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		  => esc_html__( 'Content Area', 'shapeshifter' ),
					'description'	=> '',
				) );

			// Design
			$this->set_content_area_design_theme_mods();
			// Colors
			$this->set_content_area_colors_theme_mods();
			// Background Image
			$this->set_content_area_background_image_theme_mods();
			// Main Content Background Image
			$this->set_main_content_background_image_theme_mods();

		}

			/**
			 * Design
			 * 		Panel IDs   : "content_area_settings_panel" added by $this->set_content_area_theme_mods()
			 * 		Section IDs : "content_area_design_section" 
			 * 		Setting IDs : "is_one_column_main_content_max_width_on", $column_id . "_max_width", "is_content_border_on", "main_content_border_radius" 
			**/
			function set_content_area_design_theme_mods() {

				// Sections
					// Design Section
					$this->wp_customize->add_section( 'content_area_design_section', array(
						'title' => esc_html__( 'Design', 'shapeshifter' ),
						'panel' => 'content_area_settings_panel',
					));

				// Settings
					// Is Max Width?
						$this->wp_customize->add_setting( 'is_one_column_main_content_max_width_on', array(
							'default'  => 0,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_one_column_main_content_max_width_on', array(
							'section' => 'content_area_design_section',
							'settings' => 'is_one_column_main_content_max_width_on',
							'label' => esc_html__( 'Is One Column of Max Width', 'shapeshifter' ),
							'description' => esc_html__( 'For One-Column-Content Page, Width size of content area will be the size covering content area.', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Columns
						$columns = array( 
							'sidebar_left' => array(
								'name' => esc_html__( 'Sidebar Left Container', 'shapeshifter' ),
							),
							'main_content' => array(
								'name' => esc_html__( 'Main Content', 'shapeshifter' ),
							),
							'sidebar_right' => array(
								'name' => esc_html__( 'Sidebar Right Container', 'shapeshifter' ),
							),
						);

						foreach( $columns as $id => $data ) {

							$max_width_min = in_array( $id, array( 'main_content' ) ) ? 600 : 200;
							$max_width_default = in_array( $id, array( 'main_content' ) ) ? 660 : 300;
							$max_width_max = in_array( $id, array( 'main_content' ) ) ? 800 : 500;

							// Width
								$this->wp_customize->add_setting( '' . $id . '_max_width', array(
									'default' => $max_width_default,
									'capability' => 'edit_theme_options',
									'transport' => 'postMessage',
									'sanitize_callback' => 'absint',
									'sanitize_js_callback' => 'absint',
								));
								$this->wp_customize->add_control( '' . $id . '_max_width', array(
									'section' => 'content_area_design_section',
									'settings' => '' . $id . '_max_width',
									'label' => sprintf( __( 'Width of %s', 'shapeshifter' ), $data[ 'name' ] ),
									'type' => 'range',
									'description' => '',
									'input_attrs' => array(
										'min' => $max_width_min,
										'max' => $max_width_max,
										'step' => 1,
										'value' => absint( $this->theme_mods[ '' . $id . '_max_width' ] ),
										'id' => '' . $id . '_max_width_id',
										'style' => 'width:100%;',
									),
								));

						}

					// Border
						$this->wp_customize->add_setting( 'is_content_border_on', array(
							'default'  => 1,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_content_border_on', array(
							'section' => 'content_area_design_section',
							'settings' => 'is_content_border_on',
							'label' => esc_html__( 'Border of Main Content', 'shapeshifter' ),
							'type' => 'checkbox',
						));
					
					// Border Radius
						$this->wp_customize->add_setting( 'main_content_border_radius', array(
							'default' => 0,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'main_content_border_radius', array(
							'section' => 'content_area_design_section',
							'settings' => 'main_content_border_radius',
							'label' => esc_html__( 'Border Radius', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 0,
								'max' => 50,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'main_content_border_radius' ] ),
								'id' => 'main_content_border_radius_id',
								'style' => 'width:100%;',
							),
						));

			}

			/**
			 * Colors
			 * 		Panel IDs   : "content_area_settings_panel" added by $this->set_content_area_theme_mods()
			 * 		Section IDs : "content_area_color_section" 
			 * 		Setting IDs : "content_area_background_color", "content_outer_background_color", "main_content_background_color", "content_area_sidebar_left_container_background_color", "content_area_sidebar_right_container_background_color"
			**/
			function set_content_area_colors_theme_mods() {

				// Sections
					// Colors Section
					$this->wp_customize->add_section( 'content_area_color_section', array(
						'title' => esc_html__( 'Colors', 'shapeshifter' ),
						'panel' => 'content_area_settings_panel',
					));

				// Settings
					// Area Background Color
						$this->wp_customize->add_setting( 'content_area_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'content_area_background_color', array(
							'label' => esc_html__( 'Background Color of Content Area', 'shapeshifter' ),
							'section' => 'content_area_color_section',
							'settings' => 'content_area_background_color',
						)));

					// Outer Background Color
						$this->wp_customize->add_setting( 'content_outer_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'content_outer_background_color', array(
							'label' => esc_html__( 'Background Color of Content Outer', 'shapeshifter' ),
							'section' => 'content_area_color_section',
							'settings' => 'content_outer_background_color',
						)));

					// Main Content Background Color
						$this->wp_customize->add_setting( 'main_content_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'main_content_background_color', array(
							'label' => esc_html__( 'Background Color of Main Content', 'shapeshifter' ),
							'section' => 'content_area_color_section',
							'settings' => 'main_content_background_color',
						)));

					// Sidebar Left Backgrund Color
						$this->wp_customize->add_setting( 'content_area_sidebar_left_container_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'content_area_sidebar_left_container_background_color', array(
							'label' => esc_html__( 'Background Color of Sidebar Left Container', 'shapeshifter' ),
							'section' => 'content_area_color_section',
							'settings' => 'content_area_sidebar_left_container_background_color',
						)));
						
					// Sidebar Right Backgrund Color
						$this->wp_customize->add_setting( 'content_area_sidebar_right_container_background_color', array( 
							'default' => 'rgba(255,255,255,0)',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'content_area_sidebar_right_container_background_color', array(
							'label' => esc_html__( 'Background Color of Sidebar Right Container', 'shapeshifter' ),
							'section' => 'content_area_color_section',
							'settings' => 'content_area_sidebar_right_container_background_color',
						)));

			}

			/**
			 * Background Image
			 * 		Panel IDs   : "content_area_settings_panel" added by $this->set_content_area_theme_mods()
			 * 		Section IDs : "content_area_background_image_section" 
			 * 		Setting IDs : "content_area_background_image", "content_area_background_image_size", "content_area_background_image_position_row", "content_area_background_image_position_column", "content_area_background_image_repeat", "content_area_background_image_attachment"
			**/
			function set_content_area_background_image_theme_mods() {

				// Sections
					// Background Image Section
					$this->wp_customize->add_section( 'content_area_background_image_section', array(
						'title' => esc_html__( 'Background Image of Content Area', 'shapeshifter' ),
						'panel' => 'content_area_settings_panel',
					));

				// Settings
					// Background Image
						$this->wp_customize->add_setting( 'content_area_background_image', array(
							'default' => '',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'content_area_background_image', array(
								'label' => esc_html__( 'Background Image of Content Area', 'shapeshifter' ),
								'section' => 'content_area_background_image_section',
								'settings' => 'content_area_background_image',
							)
						));

					// Background Image Size
						$this->wp_customize->add_setting( 'content_area_background_image_size', array(
							'default' => 'auto',
							'capability' => 'edit_theme_options',
							'transport'=> 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ),
						));
						$this->wp_customize->add_control( 'content_area_background_image_size', array(
							'section' => 'content_area_background_image_section',
							'settings' => 'content_area_background_image_size',
							'label' => esc_html__( "Background Size ( 'Horizontal Vertical' )", 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_image_sizes
						));	
				
					// Background Image Position Row
						$this->wp_customize->add_setting( 'content_area_background_image_position_row', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ),
						));
						$this->wp_customize->add_control( 'content_area_background_image_position_row', array(
							'section' => 'content_area_background_image_section',
							'settings' => 'content_area_background_image_position_row',
							'label' => esc_html__( 'Background Position Row', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_row,
						));	

					// Background Image Position Column
						$this->wp_customize->add_setting( 'content_area_background_image_position_column', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ),
						));
						$this->wp_customize->add_control( 'content_area_background_image_position_column', array(
							'section' => 'content_area_background_image_section',
							'settings' => 'content_area_background_image_position_column',
							'label' => esc_html__( 'Background Position Column', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_column,
						));	

					// Background Image Repeat
						$this->wp_customize->add_setting( 'content_area_background_image_repeat', array(
							'default'  => 'no-repeat',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ),
						));
						$this->wp_customize->add_control( 'content_area_background_image_repeat', array(
							'section' => 'content_area_background_image_section',
							'settings' => 'content_area_background_image_repeat',
							'label' => esc_html__( 'Background Repeat', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_repeats,
						));

					// Background Image Attachment
						$this->wp_customize->add_setting( 'content_area_background_image_attachment', array(
							'default'  => 'scroll',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ),
						));
						$this->wp_customize->add_control( 'content_area_background_image_attachment', array(
							'section' => 'content_area_background_image_section',
							'settings' => 'content_area_background_image_attachment',
							'label' => esc_html__( 'Background Attachment', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_attachments,
						));

			}

			/**
			 * Main Content Background Image
			 * 		Panel IDs   : "content_area_settings_panel" added by $this->set_content_area_theme_mods()
			 * 		Section IDs : "main_content_background_image_section" 
			 * 		Setting IDs : "main_content_background_image", "main_content_background_image_size", "main_content_background_image_position_row", "main_content_background_image_position_column", "main_content_background_image_repeat", "main_content_background_image_attachment"
			**/
			function set_main_content_background_image_theme_mods() {

				// Sections 
					// Main Content Background Image
					$this->wp_customize->add_section( 'main_content_background_image_section', array(
						'title' => esc_html__( 'Background Image of Main Content', 'shapeshifter' ),
						'panel' => 'content_area_settings_panel',
					));

				// Settings
					// Background Image
						$this->wp_customize->add_setting( 'main_content_background_image', array(
							'default' => '',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'main_content_background_image', array(
								'label' => esc_html__( 'Background Image of Main Content', 'shapeshifter' ),
								'section' => 'main_content_background_image_section',
								'settings' => 'main_content_background_image',
							)
						));	
					
					// Background Image Size
						$this->wp_customize->add_setting( 'main_content_background_image_size', array(
							'default' => 'auto',
							'capability' => 'edit_theme_options',
							'transport'=> 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ),
						));
						$this->wp_customize->add_control( 'main_content_background_image_size', array(
							'section' => 'main_content_background_image_section',
							'settings' => 'main_content_background_image_size',
							'label' => esc_html__( "Background Size ( 'Horizontal Vertical' )", 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_image_sizes
						));	

					// Background Image Position Row
						$this->wp_customize->add_setting( 'main_content_background_image_position_row', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ),
						));
						$this->wp_customize->add_control( 'main_content_background_image_position_row', array(
							'section' => 'main_content_background_image_section',
							'settings' => 'main_content_background_image_position_row',
							'label' => esc_html__( 'Background Position Row', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_row,
						));	

					// Background Image Position Column
						$this->wp_customize->add_setting( 'main_content_background_image_position_column', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ),
						));
						$this->wp_customize->add_control( 'main_content_background_image_position_column', array(
							'section' => 'main_content_background_image_section',
							'settings' => 'main_content_background_image_position_column',
							'label' => esc_html__( 'Background Position Column', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_column,
						));	

					// Background Image Repeat
						$this->wp_customize->add_setting( 'main_content_background_image_repeat', array(
							'default'  => 'no-repeat',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ),
						));
						$this->wp_customize->add_control( 'main_content_background_image_repeat', array(
							'section' => 'main_content_background_image_section',
							'settings' => 'main_content_background_image_repeat',
							'label' => esc_html__( 'Background Repeat', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_repeats,
						));	

					// Background Image Attachment
						$this->wp_customize->add_setting( 'main_content_background_image_attachment', array(
							'default'  => 'scroll',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ),
						));
						$this->wp_customize->add_control( 'main_content_background_image_attachment', array(
							'section' => 'main_content_background_image_section',
							'settings' => 'main_content_background_image_attachment',
							'label' => esc_html__( 'Background Attachment', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_attachments,
						));

			}

		/**
		 * Archive
		 * 		Panel IDs : "archive_page_settings_panel"
		 * 
		 * @see $this->set_archive_page_design_theme_mods()
		 * @see $this->set_archive_page_animations_theme_mods()
		 * @see $this->set_archive_page_colors_theme_mods()
		 * @see $this->set_archive_page_thumbnails_theme_mods()
		 * @see $this->set_archive_page_texts_theme_mods()
		**/
		function set_archive_page_theme_mods() {

			// Panel
				// Archive Page Panel
				$this->wp_customize->add_panel( 'archive_page_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		  => esc_html__( 'Archive Page', 'shapeshifter' ),
					'description'	=> '',
				) );

			// Design
			$this->set_archive_page_design_theme_mods();
			// Animations
			$this->set_archive_page_animations_theme_mods();
			// Colors
			$this->set_archive_page_colors_theme_mods();
			// Thumbnails
			$this->set_archive_page_thumbnails_theme_mods();
			// Texts
			$this->set_archive_page_texts_theme_mods();

		}

			/**
			 * Design
			 * 		Panel IDs   : "archive_page_settings_panel" added by $this->set_archive_page_theme_mods()
			 * 		Section IDs : "archive_page_design_section" 
			 * 		Setting IDs : "archive_page_is_border_top_on", "archive_page_is_border_left_on", "archive_page_is_border_right_on", "archive_page_is_border_bottom_on", "archive_page_list_item_border_radius" 
			**/
			function set_archive_page_design_theme_mods() {

				// Sections 
					// Design Section
					$this->wp_customize->add_section( 'archive_page_design_section', array(
						'title' => esc_html__( 'Design', 'shapeshifter' ),
						'panel' => 'archive_page_settings_panel',
					));

				// Settings
					// Is Border Top On
						$this->wp_customize->add_setting( 'archive_page_is_border_top_on', array(
							'default'  => 1,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'archive_page_is_border_top_on', array(
							'section' => 'archive_page_design_section',
							'settings' => 'archive_page_is_border_top_on',
							'label' => esc_html__( 'border-top of List Item Box', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Is Border Left On
						$this->wp_customize->add_setting( 'archive_page_is_border_left_on', array(
							'default'  => 1,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'archive_page_is_border_left_on', array(
							'section' => 'archive_page_design_section',
							'settings' => 'archive_page_is_border_left_on',
							'label' => esc_html__( 'border-left of List Item Box', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Is Border Right On
						$this->wp_customize->add_setting( 'archive_page_is_border_right_on', array(
							'default'  => 1,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'archive_page_is_border_right_on', array(
							'section' => 'archive_page_design_section',
							'settings' => 'archive_page_is_border_right_on',
							'label' => esc_html__( 'border-right of List Item Box', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Is Border Bottom On
						$this->wp_customize->add_setting( 'archive_page_is_border_bottom_on', array(
							'default'  => 1,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'archive_page_is_border_bottom_on', array(
							'section' => 'archive_page_design_section',
							'settings' => 'archive_page_is_border_bottom_on',
							'label' => esc_html__( 'border-bottom of List Item Box', 'shapeshifter' ),
							'type' => 'checkbox',
						));
					
					// Border Radius
						$this->wp_customize->add_setting( 'archive_page_list_item_border_radius', array(
							'default' => 0,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'archive_page_list_item_border_radius', array(
							'section' => 'archive_page_design_section',
							'settings' => 'archive_page_list_item_border_radius',
							'label' => esc_html__( 'border-radius of List Item Box', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 0,
								'max' => 50,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'archive_page_list_item_border_radius' ] ),
								'id' => 'archive_page_list_item_border_radius_id',
								'style' => 'width:100%;',
							),
						));

			}

			/**
			 * CSS Animations
			 * 		Panel IDs   : "archive_page_settings_panel" added by $this->set_archive_page_theme_mods()
			 * 		Section IDs : "archive_page_animations_section" 
			 * 		Setting IDs : "archive_page_post_list_animation_hover_select", "archive_page_post_list_animation_enter_select", "archive_page_post_list_title_box_animation_select", "archive_page_is_border_bottom_on", "archive_page_list_item_border_radius" 
			**/
			function set_archive_page_animations_theme_mods() {

				// Sections 
					// CSS Animations Section
					$this->wp_customize->add_section( 'archive_page_animations_section', array(
						'title' => esc_html__( 'Animations', 'shapeshifter' ),
						'description' => __( 'You can set CSS Animation( when Hover and ScrollEnter ) for Post List', 'shapeshifter' ),
						'panel' => 'archive_page_settings_panel',
					));

				//Settings
					// Archive Page
						// List Item Box Hover
							$this->wp_customize->add_setting( 'archive_page_post_list_animation_hover_select', array(
								'default'  => 'none',
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
							));
							$this->wp_customize->add_control( 'archive_page_post_list_animation_hover_select', array(
								'section' => 'archive_page_animations_section',
								'settings' => 'archive_page_post_list_animation_hover_select',
								'label' => esc_html__( 'List Item Box Hover', 'shapeshifter' ),
								'description' => '',
								'type' => 'select',
								'choices' => $this->animate_css[ 'hover' ],
							));

						// List Item Box Enter
							$this->wp_customize->add_setting( 'archive_page_post_list_animation_enter_select', array(
								'default'  => 'none',
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
							));
							$this->wp_customize->add_control( 'archive_page_post_list_animation_enter_select', array(
								'section' => 'archive_page_animations_section',
								'settings' => 'archive_page_post_list_animation_enter_select',
								'label' => esc_html__( 'List Item Box Enter', 'shapeshifter' ),
								'description' => '',
								'type' => 'select',
								'choices' => $this->animate_css[ 'enter' ],
							));

						// List Item Title
							// Title Box
								$this->wp_customize->add_setting( 'archive_page_post_list_title_box_animation_select', array(
									'default'  => 'none',
									'transport' => 'postMessage',
									'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
									'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
								));
								$this->wp_customize->add_control( 'archive_page_post_list_title_box_animation_select', array(
									'section' => 'archive_page_animations_section',
									'settings' => 'archive_page_post_list_title_box_animation_select',
									'label' => esc_html__( 'List Item Title Box', 'shapeshifter' ),
									'description' => '',
									'type' => 'select',
									'choices' => $this->animate_css[ 'hover' ],
								));

			}

			/**
			 * Colors
			 * 		Panel IDs   : "archive_page_settings_panel" added by $this->set_archive_page_theme_mods()
			 * 		Section IDs : "archive_page_color_section" 
			 * 		Setting IDs : "archive_page_text_color", "archive_page_text_link_color", "archive_page_post_list_text_link_color" 
			**/
			function set_archive_page_colors_theme_mods() {

				// Sections 
					// Archive Page Colors Section
					$this->wp_customize->add_section( 'archive_page_color_section', array(
						'title' => esc_html__( 'Colors', 'shapeshifter' ),
						'panel' => 'archive_page_settings_panel',
					));

				// Settings
					// Text Color
						$this->wp_customize->add_setting( 'archive_page_text_color', array( 
							'default' => '#000000', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_text_color', array(
							'label' => esc_html__( 'General Text', 'shapeshifter' ),
							'section' => 'archive_page_color_section',
							'settings' => 'archive_page_text_color',
						)));

					// Text Link Color
						$this->wp_customize->add_setting( 'archive_page_text_link_color', array( 
							'default' => '#337ab7', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_text_link_color', array(
							'label' => esc_html__( 'Link Text', 'shapeshifter' ),
							'section' => 'archive_page_color_section',
							'settings' => 'archive_page_text_link_color',
						)));

					// Categories Tags Color
						$this->wp_customize->add_setting( 'archive_page_post_list_text_link_color', array( 
							'default' => '#337ab7', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_post_list_text_link_color', array(
							'label' => esc_html__( 'Cats and Tags', 'shapeshifter' ),
							'section' => 'archive_page_color_section',
							'settings' => 'archive_page_post_list_text_link_color',
						)));

			}

			/**
			 * Thumbnails
			 * 		Panel IDs   : "archive_page_settings_panel" added by $this->set_archive_page_theme_mods()
			 * 		Section IDs : "archive_page_post_thumbnail_section" 
			 * 		Setting IDs : "archive_page_post_thumbnail_width", "archive_page_post_thumbnail_height", "archive_page_post_thumbnail_radius" 
			**/
			function set_archive_page_thumbnails_theme_mods() {

				// Sections
					// Archive Page Post Thumbnail Section
					$this->wp_customize->add_section( 'archive_page_post_thumbnail_section', array(
						'title' => esc_html__( 'Post Thumbnails', 'shapeshifter' ),
						'panel' => 'archive_page_settings_panel',
					));

				// Settings
					// Thumbnail Width
						$this->wp_customize->add_setting( 'archive_page_post_thumbnail_width', array(
							'default' => 80,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'archive_page_post_thumbnail_width', array(
							'section' => 'archive_page_post_thumbnail_section',
							'settings' => 'archive_page_post_thumbnail_width',
							'label' => esc_html__( 'Width for Post Thumbnails', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 80,
								'max' => 200,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] ),
								'id' => 'archive_page_post_thumbnail_width_id',
								'style' => 'width:100%;',
							),
						));

					// Thumbnail Height
						$this->wp_customize->add_setting( 'archive_page_post_thumbnail_height', array(
							'default' => 80,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'archive_page_post_thumbnail_height', array(
							'section' => 'archive_page_post_thumbnail_section',
							'settings' => 'archive_page_post_thumbnail_height',
							'label' => esc_html__( 'Height for Post Thumbnails', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 80,
								'max' => 200,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'archive_page_post_thumbnail_height' ] ),
								'id' => 'archive_page_post_thumbnail_height_id',
								'style' => 'width:100%;',
							),
						));

					// Thumbnail Radius
						$this->wp_customize->add_setting( 'archive_page_post_thumbnail_radius', array(
							'default' => 40,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'archive_page_post_thumbnail_radius', array(
							'section' => 'archive_page_post_thumbnail_section',
							'settings' => 'archive_page_post_thumbnail_radius',
							'label' => esc_html__( 'Radius for Post Thumbnails', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 0,
								'max' => 100,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] ),
								'id' => 'archive_page_post_thumbnail_radius_id',
								'style' => 'width:100%;',
							),
						));

			}

			/**
			 * Texts
			 * 		Panel IDs   : "archive_page_settings_panel" added by $this->set_archive_page_theme_mods()
			 * 		Section IDs : "archive_page_' . $headline . '_section" 
			 * 		Setting IDs : "archive_page_' . $headline . '_section" 
			**/
			function set_archive_page_texts_theme_mods() {

				// Sections
					// Each Text Section
					$headlines = array( 
						'post_list_title' => __( 'Post List Item Title', 'shapeshifter' ),
					);

					foreach( $headlines as $headline => $title ) {

						// Title
							$this->wp_customize->add_section( 'archive_page_' . $headline . '_section', array(
								'title' => sprintf( esc_html__( 'Settings for %s', 'shapeshifter' ), $title ),
								'panel' => 'archive_page_settings_panel',
							));

								# Font Family
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_font_family', array(
										'default'  => $this->theme_mods['archive_page_' . $headline . '_font_family'],
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
									));
									$this->wp_customize->add_control( 'archive_page_' . $headline . '_font_family', array(
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_font_family',
										'label' => esc_html__( 'Font Family', 'shapeshifter' ),
										'type' => 'select',
										'choices' => $this->font_families,
									));

								# Font Size
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_font_size', array(
										'default' => absint( $this->theme_mods[ 'archive_page_' . $headline . '_font_size' ] ),
										'capability' => 'edit_theme_options',
										'transport' => 'postMessage',
										'sanitize_callback' => 'absint',
										'sanitize_js_callback' => 'absint',
									));
									$this->wp_customize->add_control( 'archive_page_' . $headline . '_font_size', array(
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_font_size',
										'label' => esc_html__( 'Font Size', 'shapeshifter' ),
										'type' => 'range',
										'description' => '',
										'input_attrs' => array(
											'min' => 12,
											'max' => 40,
											'step' => 1,
											'value' => absint( $this->theme_mods[ 'archive_page_' . $headline . '_font_size' ] ),
											'style' => 'width:100%;',
										),
									));
								
								# Text Color
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_text_color', array( 
										'default' => '#666666', 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_text_color', array(
										'label' => esc_html__( 'Text Color', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_text_color',
									)));

								# Text Shadow
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_text_shadow', array( 
										'default' => '', 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_text_shadow', array(
										'label' => esc_html__( 'Text Shadow Color', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_text_shadow',
									)));

								# Gradient Toggle
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_background_gradient_on', array( 
										'default' => false, 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
									));
									$this->wp_customize->add_control( 'archive_page_' . $headline . '_background_gradient_on', array(
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_background_gradient_on',
										'label' => esc_html__( 'Background Color Gradation', 'shapeshifter' ),
										'description' => __( 'Colors used for Gradation Content Background Color and Color Selected below', 'shapeshifter' ),
										'type' => 'checkbox',
									));

								# Background Color
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_background_color', array( 
										'default' => sanitize_text_field( $this->theme_mods[ 'archive_page_' . $headline . '_background_color' ] ), 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_background_color', array(
										'label' => esc_html__( 'Background Color', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_background_color',
										'show_opacity' => true,
										'palette' => array(
											'rgba(255,255,255,0.9)',
										),
									)));

								# Border Bottom Color
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_border_bottom_color', array( 
										'default' => sanitize_text_field( $this->theme_mods[ 'archive_page_' . $headline . '_border_bottom_color' ] ), 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_border_bottom_color', array(
										'label' => esc_html__( 'Border Bottom', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_border_bottom_color',
									)));

								# Border Left Color
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_border_left_color', array( 
										'default' => sanitize_text_field( $this->theme_mods[ 'archive_page_' . $headline . '_border_left_color' ] ), 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_border_left_color', array(
										'label' => esc_html__( 'Border Left', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_border_left_color',
									)));

								# Border Right Color
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_border_right_color', array( 
										'default' => sanitize_text_field( $this->theme_mods[ 'archive_page_' . $headline . '_border_right_color' ] ), 
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									));
									$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'archive_page_' . $headline . '_border_right_color', array(
										'label' => esc_html__( 'Border Right', 'shapeshifter' ),
										'section' => 'archive_page_' . $headline . '_section',
										'settings' => 'archive_page_' . $headline . '_border_right_color',
									)));

								# Background Image
									$this->wp_customize->add_setting( 'archive_page_' . $headline . '_background_image', array(
										'default' => '',
										'transport' => 'postMessage',
										'sanitize_callback' => 'esc_url_raw',
										'sanitize_js_callback' => 'esc_url_raw',
									));
									$this->wp_customize->add_control( new WP_Customize_Image_Control(
										$this->wp_customize, 'archive_page_' . $headline . '_background_image', array(
											'label' => esc_html__( 'Background Image', 'shapeshifter' ),
											'description' => __( '"background-size" value is set "cover" without repeat', 'shapeshifter' ),
											'section' => 'archive_page_' . $headline . '_section',
											'settings' => 'archive_page_' . $headline . '_background_image',
										)
									));

					}

			}

		/**
		 * Singular
		 * 		Panel IDs : "singular_page_settings_panel"
		 * 
		 * @see $this->set_singular_page_display_theme_mods()
		 * @see $this->set_singular_page_animations_theme_mods()
		 * @see $this->set_singular_page_colors_theme_mods()
		 * @see $this->set_singular_page_texts_theme_mods()
		**/
		function set_singular_page_theme_mods() {

			# Singular Page Panel
				$this->wp_customize->add_panel( 'singular_page_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		     => esc_html__( 'Main Content', 'shapeshifter' ),
					'description'	 => '',
				) );

			# Display
				$this->set_singular_page_display_theme_mods();
			# Animations
				$this->set_singular_page_animations_theme_mods();
			# Colors
				$this->set_singular_page_colors_theme_mods();
			# Texts
				$this->set_singular_page_texts_theme_mods();

		}

			/**
			 * Display
			 * 		Panel IDs   : "singular_page_settings_panel" added by $this->set_singular_page_theme_mods()
			 * 		Section IDs : "singular_page_display_section" 
			 * 		Setting IDs : "is_not_single_meta_visible", "is_not_page_meta_visible", "is_not_page_link_visible" 
			**/
			function set_singular_page_display_theme_mods() {

				// Section
					// Display Section
					$this->wp_customize->add_section( 'singular_page_display_section', array(
						'title' => esc_html_x( 'Display', 'theme customizer section name', 'shapeshifter' ),
						'panel' => 'singular_page_settings_panel',
					));

				// Settings
					// Categories Tags Info
						$this->wp_customize->add_setting( 'is_not_single_meta_visible', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_not_single_meta_visible', array(
							'section' => 'singular_page_display_section',
							'settings' => 'is_not_single_meta_visible',
							'label' => esc_html__( 'Not display infos ( Author, Date, Cats, Tags ) about the Post', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Page Meta Visible
						$this->wp_customize->add_setting( 'is_not_page_meta_visible', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_not_page_meta_visible', array(
							'section' => 'singular_page_display_section',
							'settings' => 'is_not_page_meta_visible',
							'label' => esc_html__( 'Not display infos ( Author, Date, Cats, Tags ) about the Page', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Pager
						$this->wp_customize->add_setting( 'is_not_page_link_visible', array(
							'default'  => false,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'is_not_page_link_visible', array(
							'section' => 'singular_page_display_section',
							'settings' => 'is_not_page_link_visible',
							'label' => esc_html__( 'Not display Page links ( links of next post and prev post )', 'shapeshifter' ),
							'type' => 'checkbox',
						));

			}

			/**
			 * CSS Animations
			 * 		Panel IDs   : "singular_page_settings_panel" added by $this->set_singular_page_theme_mods()
			 * 		Section IDs : "singular_page_animations_section" 
			 * 		Setting IDs : "singular_page_' . $element . '_animation_hover_select", "singular_page_' . $element . '_animation_enter_select" 
			**/
			function set_singular_page_animations_theme_mods() {

				// Section
					// CSS Animations
					$this->wp_customize->add_section( 'singular_page_animations_section', array(
						'title' => esc_html__( 'Animations', 'shapeshifter' ),
						'description' => __( 'You can set CSS Animation( when Hover and ScrollEnter ) for Each Elements in Content', 'shapeshifter' ),
						'panel' => 'singular_page_settings_panel',
					));

				// Settings
					$content_elements = array(
						'h1' => esc_html__( 'Title', 'shapeshifter' ),
						'postinfos' => esc_html__( 'Post Infos', 'shapeshifter' ),
						'h2' => esc_html__( 'H2 Tags', 'shapeshifter' ),
						'h3' => esc_html__( 'H3 Tags', 'shapeshifter' ),
						'h4' => esc_html__( 'H4 Tags', 'shapeshifter' ),
						'h5' => esc_html__( 'H5 Tags', 'shapeshifter' ),
						'h6' => esc_html__( 'H6 Tags', 'shapeshifter' ),
						'p' => esc_html__( 'P Tags', 'shapeshifter' ),
						'div' => esc_html__( 'DIV Tags', 'shapeshifter' ),
						'img' => esc_html__( 'IMG Tags', 'shapeshifter' ),
						'table' => esc_html__( 'TABLE Tags', 'shapeshifter' ),
					);

					foreach( $content_elements as $element => $label ) {

						// Hover
							$this->wp_customize->add_setting( 'singular_page_' . $element . '_animation_hover_select', array(
								'default'  => 'none',
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_hover' ),
							));
							$this->wp_customize->add_control( 'singular_page_' . $element . '_animation_hover_select', array(
								'section' => 'singular_page_animations_section',
								'settings' => 'singular_page_' . $element . '_animation_hover_select',
								'label' => sprintf( esc_html__( '%s Hover', 'shapeshifter' ), $label ),
								'description' => '',
								'type' => 'select',
								'choices' => $this->animate_css[ 'hover' ],
							));

						// Enter
							$this->wp_customize->add_setting( 'singular_page_' . $element . '_animation_enter_select', array(
								'default'  => 'none',
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
							));
							$this->wp_customize->add_control( 'singular_page_' . $element . '_animation_enter_select', array(
								'section' => 'singular_page_animations_section',
								'settings' => 'singular_page_' . $element . '_animation_enter_select',
								'label' => sprintf( esc_html__( '%s Enter', 'shapeshifter' ), $label ),
								'description' => '',
								'type' => 'select',
								'choices' => $this->animate_css[ 'enter' ],
							));

					}

			}

			/**
			 * Colors
			 * 		Panel IDs   : "singular_page_settings_panel" added by $this->set_singular_page_theme_mods()
			 * 		Section IDs : "singular_page_color_section" 
			 * 		Setting IDs : "singular_page_bloginfo_background_color", "singular_page_bloginfo_text_color", "singular_page_bloginfo_text_link_color", "singular_page_text_color", "singular_page_text_link_color"
			**/
			function set_singular_page_colors_theme_mods() {

				// Section
					// Colors Section
					$this->wp_customize->add_section( 'singular_page_color_section', array(
						'title' => esc_html__( 'Colors', 'shapeshifter' ),
						'panel' => 'singular_page_settings_panel',
					));

				// Settings
					// Blog Info Background Color
						$this->wp_customize->add_setting( 'singular_page_bloginfo_background_color', array( 
							'default' => '#EEEEEE', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_bloginfo_background_color', array(
							'label' => esc_html__( 'Background of Infos about the Content', 'shapeshifter' ),
							'section' => 'singular_page_color_section',
							'settings' => 'singular_page_bloginfo_background_color',
						)));

					// Blog Info Text Color
						$this->wp_customize->add_setting( 'singular_page_bloginfo_text_color', array( 
							'default' => '#000000', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_bloginfo_text_color', array(
							'label' => esc_html__( 'Text of Infos about the Content', 'shapeshifter' ),
							'section' => 'singular_page_color_section',
							'settings' => 'singular_page_bloginfo_text_color',
						)));

					// Blog Info Text Link Color
						$this->wp_customize->add_setting( 'singular_page_bloginfo_text_link_color', array( 
							'default' => '#337ab7', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_bloginfo_text_link_color', array(
							'label' => esc_html__( 'Text Link of Infos about the Content', 'shapeshifter' ),
							'section' => 'singular_page_color_section',
							'settings' => 'singular_page_bloginfo_text_link_color',
						)));

					// Text Color
						$this->wp_customize->add_setting( 'singular_page_text_color', array( 
							'default' => '#666666', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_text_color', array(
							'label' => esc_html__( 'Text of the Content', 'shapeshifter' ),
							'section' => 'singular_page_color_section',
							'settings' => 'singular_page_text_color',
						)));

					// Text Link Color
						$this->wp_customize->add_setting( 'singular_page_text_link_color', array( 
							'default' => '#337ab7', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_text_link_color', array(
							'label' => esc_html__( 'Text Link of the Content', 'shapeshifter' ),
							'section' => 'singular_page_color_section',
							'settings' => 'singular_page_text_link_color',
						)));

			}

			/**
			 * Texts
			 * 		Panel IDs   : "singular_page_settings_panel" added by $this->set_singular_page_theme_mods()
			 * 		Section IDs : "singular_page_" . $headline . "_section" 
			 * 		Setting IDs : "singular_page_" . $headline . "_font_family", "singular_page_" . $headline . "_font_size", "singular_page_" . $headline . "_text_color", "singular_page_" . $headline . "_text_shadow", "singular_page_" . $headline . "_background_gradient_on", "singular_page_" . $headline . "_background_color", "singular_page_" . $headline . "_border_bottom_color", "singular_page_" . $headline . "_border_left_color", "singular_page_" . $headline . "_border_right_color", "singular_page_" . $headline . "_background_image"
			**/
			function set_singular_page_texts_theme_mods() {

				$headlines = array( 
					'h1' => esc_html__( 'Title', 'shapeshifter' ),
					'h2' => esc_html__( 'H2 Tags', 'shapeshifter' ),
					'h3' => esc_html__( 'H3 Tags', 'shapeshifter' ),
					'h4' => esc_html__( 'H4 Tags', 'shapeshifter' ),
					'h5' => esc_html__( 'H5 Tags', 'shapeshifter' ),
					'h6' => esc_html__( 'H6 Tags', 'shapeshifter' ),
					'p' => esc_html__( 'P Tags', 'shapeshifter' ),
				);
				foreach( $headlines as $headline => $title ) {

					// Section
						// Title
						$this->wp_customize->add_section( 'singular_page_' . $headline . '_section', array(
							'title' => sprintf( esc_html__( 'Styles of %s', 'shapeshifter' ), $title ),
							'panel' => 'singular_page_settings_panel',
						));

					// Settings
						// Font Family
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_font_family', array(
								'default'  => $this->theme_mods['singular_page_' . $headline . '_font_family'],
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							));
							$this->wp_customize->add_control( 'singular_page_' . $headline . '_font_family', array(
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_font_family',
								'label' => esc_html__( 'Font Family', 'shapeshifter' ),
								'type' => 'select',
								'choices' => $this->font_families,
							));

						// Font Size
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_font_size', array(
								'default' => absint( $this->theme_mods[ 'singular_page_' . $headline . '_font_size' ] ),
								'capability' => 'edit_theme_options',
								'transport' => 'postMessage',
								'sanitize_callback' => 'absint',
								'sanitize_js_callback' => 'absint',
							));
							$this->wp_customize->add_control( 'singular_page_' . $headline . '_font_size', array(
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_font_size',
								'label' => esc_html__( 'Font Size', 'shapeshifter' ),
								'type' => 'range',
								'description' => '',
								'input_attrs' => array(
									'min' => 12,
									'max' => 40,
									'step' => 1,
									'value' => absint( $this->theme_mods[ 'singular_page_' . $headline . '_font_size' ] ),
									'style' => 'width:100%;',
								),
							));

						// Text Color
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_text_color', array( 
								'default' => '#666666', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_text_color', array(
								'label' => esc_html__( 'Text Color', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_text_color',
							)));

						// Text Shadow
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_text_shadow', array( 
								'default' => '', 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_text_shadow', array(
								'label' => esc_html__( 'Text Shadow Color', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_text_shadow',
							)));

						// Background Gradient On
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_background_gradient_on', array( 
								'default' => false, 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
							));
							$this->wp_customize->add_control( 'singular_page_' . $headline . '_background_gradient_on', array(
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_background_gradient_on',
								'label' => esc_html__( 'Background Color Gradation', 'shapeshifter' ),
								'description' => __( 'Colors used for Gradation Content Background Color and Color Selected below', 'shapeshifter' ),
								'type' => 'checkbox',
							));

						// Background Color
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_background_color', array( 
								'default' => sanitize_text_field( $this->theme_mods[ 'singular_page_' . $headline . '_background_color' ] ), 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_background_color', array(
								'label' => esc_html__( 'Background Color', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_background_color',
							)));

						// Border Bottom Color
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_border_bottom_color', array( 
								'default' => sanitize_text_field( $this->theme_mods[ 'singular_page_' . $headline . '_border_bottom_color' ] ), 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_border_bottom_color', array(
								'label' => esc_html__( 'Border Bottom', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_border_bottom_color',
							)));

						// Border Left Color
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_border_left_color', array( 
								'default' => sanitize_text_field( $this->theme_mods[ 'singular_page_' . $headline . '_border_left_color' ] ), 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_border_left_color', array(
								'label' => esc_html__( 'Border Left', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_border_left_color',
							)));

						// Border Right Color
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_border_right_color', array( 
								'default' => sanitize_text_field( $this->theme_mods[ 'singular_page_' . $headline . '_border_right_color' ] ), 
								'transport' => 'postMessage',
								'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							));
							$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'singular_page_' . $headline . '_border_right_color', array(
								'label' => esc_html__( 'Border Right', 'shapeshifter' ),
								'section' => 'singular_page_' . $headline . '_section',
								'settings' => 'singular_page_' . $headline . '_border_right_color',
							)));

						// Background Image
							$this->wp_customize->add_setting( 'singular_page_' . $headline . '_background_image', array(
								'default' => '',
								'transport' => 'postMessage',
								'sanitize_callback' => 'esc_url_raw',
								'sanitize_js_callback' => 'esc_url_raw',
							));
							$this->wp_customize->add_control( new WP_Customize_Image_Control(
								$this->wp_customize, 'singular_page_' . $headline . '_background_image', array(
									'label' => esc_html__( 'Background Image', 'shapeshifter' ),
									'description' => __( '"background-size" value is set "cover" without repeat', 'shapeshifter' ),
									'section' => 'singular_page_' . $headline . '_section',
									'settings' => 'singular_page_' . $headline . '_background_image',
								)
							));

				}

			}

		/**
		 * Footer
		 * 		Panel IDs : "footer_settings_panel"
		 * 
		 * @see $this->set_footer_texts_theme_mods()
		 * @see $this->set_footer_background_image_theme_mods()
		 * @see $this->set_footer_colors_theme_mods()
		**/
		function set_footer_theme_mods() {

			// Panel
				// Footer Panel
				$this->wp_customize->add_panel( 'footer_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		     => esc_html__( 'Footer', 'shapeshifter' ),
					'description'	 => '',
				));

			// Texts
			$this->set_footer_texts_theme_mods();
			// Background Image
			$this->set_footer_background_image_theme_mods();
			// Colors
			$this->set_footer_colors_theme_mods();
				
		}

			/**
			 * Texts
			 * 		Panel IDs   : "footer_settings_panel" added by $this->set_footer_theme_mods()
			 * 		Section IDs : "footer_text_section" 
			 * 		Setting IDs : "footer_font_family", "footer_font_size", "footer_align_select", "footer_display_theme", "footer_display_description", "footer_copyright_year", "footer_display_credit_type"
			**/
			function set_footer_texts_theme_mods() {

				// Section
					// Text
					$this->wp_customize->add_section( 'footer_text_section', array(
						'title' => esc_html__( 'Styles of Text', 'shapeshifter' ),
						'panel' => 'footer_settings_panel',
					));

				// Settings
					// Font Family
						$this->wp_customize->add_setting( 'footer_font_family', array(
							'default'  => $this->theme_mods['footer_font_family'],
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
						));
						$this->wp_customize->add_control( 'footer_font_family', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_font_family',
							'label' => esc_html__( 'Font Family', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->font_families,
						));
				
					// Font Size
						$this->wp_customize->add_setting( 'footer_font_size', array(
							'default' => 14,
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'sanitize_js_callback' => 'absint',
						));
						$this->wp_customize->add_control( 'footer_font_size', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_font_size',
							'label' => esc_html__( 'Font Size for Title and Description', 'shapeshifter' ),
							'type' => 'range',
							'description' => '',
							'input_attrs' => array(
								'min' => 10,
								'max' => 20,
								'step' => 1,
								'value' => absint( $this->theme_mods[ 'footer_font_size' ] ),
								'id' => 'footer_font_size_id',
								'style' => 'width:100%;',
							),
							'priority' => 3
						));

					// Alignment
						$this->wp_customize->add_setting( 'footer_align_select', array(
							'default'  => 'center',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_footer_align' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_footer_align' ),
						));
						$this->wp_customize->add_control( 'footer_align_select', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_align_select',
							'label' => esc_html__( 'Text Align', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->footer_align,
						));

					// Display Theme Name
						$this->wp_customize->add_setting( 'footer_display_theme', array(
							'default'  => true,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'footer_display_theme', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_display_theme',
							'label' => esc_html__( 'Display Theme Name', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Display Description
						$this->wp_customize->add_setting( 'footer_display_description', array(
							'default'  => true,
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
						));
						$this->wp_customize->add_control( 'footer_display_description', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_display_description',
							'label' => esc_html__( 'Display Description', 'shapeshifter' ),
							'type' => 'checkbox',
						));

					// Copyright Year
						$this->wp_customize->add_setting( 'footer_copyright_year', array(
							'default' => 2000,
							'capability' => 'edit_theme_options',
							'transport'=> 'postMessage',
							'sanitize_callback' => 'absint', 
							'sanitize_js_callback' => 'absint', 
						));
						$this->wp_customize->add_control( 'footer_copyright_year', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_copyright_year',
							'label' => esc_html__( 'Year for Copyright', 'shapeshifter' ),
							'description' => __( 'Please enter the year of beginning of the website. This number is used for copyright section displayed at the bottom.', 'shapeshifter' ),
							'type' => 'number',
						));

					// Credit Type
						$this->wp_customize->add_setting( 'footer_display_credit_type', array(
							'default'  => 'none',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_credit_type' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_credit_type' ),
						));
						$this->wp_customize->add_control( 'footer_display_credit_type', array(
							'section' => 'footer_text_section',
							'settings' => 'footer_display_credit_type',
							'label' => esc_html__( 'Display License', 'shapeshifter' ),
							'type' => 'select',
							'choices' => ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_credit_types(),
						));

			}

				/**
				 * Get Site Name
				 * 
				 * @return Site Name
				**/
				public function partial_refresh_render_callback_for_footer_copyright_year( $theme_mods ) {

					return $this->theme_mods["footer_copyright_year"];
					//return get_bloginfo( 'name' );

				}

				/**
				 * Get Footer Dislpay Credit Type Text
				 * 
				 * @return Site Name
				**/
				public function partial_refresh_render_callback_for_footer_display_credit_type( $theme_mods ) {

					$type = $this->theme_mods[ 'footer_display_credit_type' ];
					$year = absint( $this->theme_mods[ 'footer_copyright_year' ] );
					$escaped_html_blogname = esc_html( $this->theme_mods["blogname"] );

					if ( $type == 'none' ) {
						$type = null;
						$return = '';
					} elseif ( $type == 'all' ) {
						$type = null;
						$return = sprintf( __( 'Copyright &copy; <span id="copyright-year">%1$d</span> %2$s All Rights Reserved.', 'shapeshifter' ), $year, $escaped_html_blogname );
					} elseif ( $type == 'cc-by' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc-by-sa' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-SA %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc-by-nd' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-ND %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc-by-nc' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc-by-nc-sa' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC-SA %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc-by-nc-nd' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC-ND %s Some Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'cc0' ) {
						$type = null;
						$return = sprintf( __( 'CC0 %s No Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					} elseif ( $type == 'public' ) {
						$type = null;
						$return = sprintf( __( 'Public Domain %s No Rights Reserved.', 'shapeshifter' ), $escaped_html_blogname );
					}

					return apply_filters( 'shapeshifter_filters_footer_license_type', $return, $type, $year );


				}

			/**
			 * Background Image
			 * 		Panel IDs   : "footer_settings_panel" added by $this->set_footer_theme_mods()
			 * 		Section IDs : "footer_background_image" 
			 * 		Setting IDs : "footer_background_image_select", "footer_background_image_size", "footer_background_image_position_row", "footer_background_image_position_column", "footer_background_image_repeat", "footer_background_image_attachment"
			**/
			function set_footer_background_image_theme_mods() {
				
				// Section
					// Background Image Section
					$this->wp_customize->add_section( 'footer_background_image', array(
						'title' => esc_html__( 'Background Image', 'shapeshifter' ),
						'panel' => 'footer_settings_panel',
					));

				// Settings
					// Background Image 
						$this->wp_customize->add_setting( 'footer_background_image_select', array(
							'default' => '',
							'type' => 'option',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'footer_background_image_select', array(
								'label' => esc_html__( 'Background Image', 'shapeshifter' ),
								'section' => 'footer_background_image',
								'settings' => 'footer_background_image_select',
							)
						));

					// Background Image Size
						$this->wp_customize->add_setting( 'footer_background_image_size', array(
							'default' => 'auto',
							'capability' => 'edit_theme_options',
							'transport'=> 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ),
						));
						$this->wp_customize->add_control( 'footer_background_image_size', array(
							'section' => 'footer_background_image',
							'settings' => 'footer_background_image_size',
							'label' => esc_html__( 'Background Size ( "Horizontal Vertical" )', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_image_sizes
						));	

					// Background Image Position Row
						$this->wp_customize->add_setting( 'footer_background_image_position_row', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ),
						));
						$this->wp_customize->add_control( 'footer_background_image_position_row', array(
							'section' => 'footer_background_image',
							'settings' => 'footer_background_image_position_row',
							'label' => esc_html__( 'Background Position Row', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_row,
						));

					// Background Image Position Column
						$this->wp_customize->add_setting( 'footer_background_image_position_column', array(
							'default'  => 'center',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ),
						));
						$this->wp_customize->add_control( 'footer_background_image_position_column', array(
							'section' => 'footer_background_image',
							'settings' => 'footer_background_image_position_column',
							'label' => esc_html__( 'Background Position Column', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_position_column,
						));
				
					// Background Image Repeat
						$this->wp_customize->add_setting( 'footer_background_image_repeat', array(
							'default'  => 'no-repeat',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ),
						));
						$this->wp_customize->add_control( 'footer_background_image_repeat', array(
							'section' => 'footer_background_image',
							'settings' => 'footer_background_image_repeat',
							'label' => esc_html__( 'Background Repeat', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_repeats,
						));
				
					// Background Image Attachment
						$this->wp_customize->add_setting( 'footer_background_image_attachment', array(
							'default'  => 'scroll',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ), 
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ),
						));
						$this->wp_customize->add_control( 'footer_background_image_attachment', array(
							'section' => 'footer_background_image',
							'settings' => 'footer_background_image_attachment',
							'label' => esc_html__( 'Background Attachment', 'shapeshifter' ),
							'type' => 'select',
							'choices' => $this->background_attachments,
						));

			}

			/**
			 * Colors
			 * 		Panel IDs   : "footer_settings_panel" added by $this->set_footer_theme_mods()
			 * 		Section IDs : "footer_color_section" 
			 * 		Setting IDs : "footer_background_color", "footer_text_color"
			**/
			function set_footer_colors_theme_mods() {
				
				// Section
					// Color Section
					$this->wp_customize->add_section( 'footer_color_section', array(
						'title' => esc_html__( 'Colors', 'shapeshifter' ),
						'panel' => 'footer_settings_panel',
					));

				// Settings
					// Background Color
						$this->wp_customize->add_setting( 'footer_background_color', array( 
							'default' => '#000000', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'footer_background_color', array(
							'label' => esc_html__( 'Background', 'shapeshifter' ),
							'section' => 'footer_color_section',
							'settings' => 'footer_background_color',
						)));
					
					// Text Color
						$this->wp_customize->add_setting( 'footer_text_color', array( 
							'default' => '#FFFFFF', 
							'transport' => 'postMessage',
							'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
							'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
						));
						$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'footer_text_color', array(
							'label' => esc_html__( 'Text', 'shapeshifter' ),
							'section' => 'footer_color_section',
							'settings' => 'footer_text_color',
						)));

			}

		/**
		 * Standard Widget Areas
		 * 		Panel IDs : "default_widget_area_settings_panel"
		 * 
		 * @see $this->set_standard_widget_areas_each_theme_mods()
		 * @see $this->set_standard_widget_areas_slidebars_container_theme_mods()
		**/
		function set_standard_widget_areas_theme_mods() {

			# Widget Area Panel
				$this->wp_customize->add_panel( 'default_widget_area_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		     => esc_html__( 'Standard Widget Areas', 'shapeshifter' ),
					'description'	 => '',
				));

			# Each Widget Area
				$this->set_standard_widget_areas_each_theme_mods();
			# Slidebars Container
				$this->set_standard_widget_areas_slidebars_container_theme_mods();
			# Menus for Responsive
				$this->set_standard_widget_areas_slidebars_container_theme_mods();

		}

			/**
			 * Each Widget Area
			 * 		Panel IDs   : "default_widget_area_settings_panel" added by $this->set_standard_widget_areas_theme_mods()
			 * 		Section IDs : "widget_area_{$id}"
			 * 		Setting IDs :
			 			Font Family       :  "{$id}_font_family"
			 *
			 			CSS Animations    :"{$id}_area_animation_enter"
			 *
			 			Outer Background  : "{$id}_outer_background_image", "{$id}_outer_background_image_size", "{$id}_outer_background_image_position_row", "{$id}_outer_background_image_position_column", "{$id}_outer_background_image_repeat", "{$id}_outer_background_image_attachment",
			 *
						Inner Background  : "{$id}_inner_background_image", "{$id}_inner_background_image_size", "{$id}_inner_background_image_position_row", "{$id}_inner_background_image_position_column", "{$id}_inner_background_image_repeat", "{$id}_inner_background_image_attachment",
			 *
						Design            : "{$id}_widget_border", "{$id}_widget_border_radius", "{$id}_widget_margin"
			 *
						Colors            : "{$id}_background_color", "{$id}_title_color", "{$id}_text_color", "{$id}_link_text_color"
			**/
			function set_standard_widget_areas_each_theme_mods() {

				// Widget Area Settings
				$default_widget_areas_args = array(
					'slidebar_left' => array(
						'id' => 'slidebar_left',
						'name' => esc_html__( 'Slidebar Left', 'shapeshifter' ),
					),
					'sidebar_left' => array(
						'id' => 'sidebar_left',
						'name' => esc_html__( 'Sidebar Left', 'shapeshifter' ),
					),
					'sidebar_left_fixed' => array(
						'id' => 'sidebar_left_fixed',
						'name' => esc_html__( 'Sidebar Left Fixed', 'shapeshifter' ),
					),
					'slidebar_right' => array(
						'id' => 'slidebar_right',
						'name' => esc_html__( 'Slidebar Right', 'shapeshifter' ),
					),
					'sidebar_right' => array(
						'id' => 'sidebar_right',
						'name' => esc_html__( 'Sidebar Right', 'shapeshifter' ),
					),
					'sidebar_right_fixed' => array(
						'id' => 'sidebar_right_fixed',
						'name' => esc_html__( 'Sidebar Right Fixed', 'shapeshifter' ),
					),
					'mobile_sidebar' => array(
						'id' => 'mobile_sidebar',
						'name' => esc_html__( 'Mobile Sidebar ( For PC, slidebar on right for responsive design when window width is smaller than content area width )', 'shapeshifter' ),
					),
				);

				foreach( $default_widget_areas_args as $name => $data ) { 

					# Default Widget Area
						if ( is_active_sidebar( $data[ 'id' ] ) ) {

							// Sections
								// Widget Area Section
								$this->wp_customize->add_section( 'widget_area_' . $data[ 'id' ], array(
									'title' => esc_html( $data[ 'name' ] ),
									'panel' => 'default_widget_area_settings_panel',
								));
							
							// Settings
								// Font Family
									$font_family_key = $data[ 'id' ] . '_font_family';
									$this->wp_customize->add_setting( $data[ 'id' ] . '_font_family', array(
										'default'  => $this->theme_mods[ $font_family_key ],
										'transport' => 'postMessage',
										'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
										'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_font_families' ),
									));
									$this->wp_customize->add_control( $data[ 'id' ] . '_font_family', array(
										'section' => 'widget_area_' . $data[ 'id' ],
										'settings' => $data[ 'id' ] . '_font_family',
										'label' => esc_html__( 'Font Family', 'shapeshifter' ),
										'type' => 'select',
										'choices' => $this->font_families,
									));

								// Enter CSS Animation
									// Widget Area
										$this->wp_customize->add_setting( $data[ 'id' ] . '_area_animation_enter', array(
											'default'  => 'none',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_css_animation_enter' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_area_animation_enter', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_area_animation_enter',
											'label' => esc_html__( 'Area Animation Enter', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->animate_css[ 'enter' ]
										));

								// Background Image Outside
									// Outer Background Image
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image', array(
											'default' => '',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => 'esc_url_raw',
											'sanitize_js_callback' => 'esc_url_raw',
										));
										$this->wp_customize->add_control( new WP_Customize_Image_Control(
											$this->wp_customize, $data[ 'id' ] . '_outer_background_image', array(
												'label' => esc_html__( 'Background Image ( Outside )', 'shapeshifter' ),
												'section' => 'widget_area_' . $data[ 'id' ],
												'settings' => $data[ 'id' ] . '_outer_background_image',
											)
										));

									// Background Image Size
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image_size', array(
											'default' => 'auto',
											'capability' => 'edit_theme_options',
											'transport'=> 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_outer_background_image_size', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_outer_background_image_size',
											'label' => esc_html__( 'Background Size ( Outside )', 'shapeshifter' ),
											'description' => __( 'Enter the value like "Horizontal Vertical" with units', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_image_sizes
										));	
								
									// Background Image Position Row
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image_position_row', array(
											'default'  => 'center',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_outer_background_image_position_row', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_outer_background_image_position_row',
											'label' => esc_html__( 'Background Position Row ( Outside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_position_row,
										));

									// Background Image Position Column
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image_position_column', array(
											'default'  => 'center',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_outer_background_image_position_column', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_outer_background_image_position_column',
											'label' => esc_html__( 'Background Position Column ( Outside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_position_column,
										));
								
									// Background Image Repeat
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image_repeat', array(
											'default'  => 'no-repeat',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_outer_background_image_repeat', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_outer_background_image_repeat',
											'label' => esc_html__( 'Background Repeat ( Outside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_repeats,
										));	
								
									// Background Image Attachment
										$this->wp_customize->add_setting( $data[ 'id' ] . '_outer_background_image_attachment', array(
											'default'  => 'scroll',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_outer_background_image_attachment', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_outer_background_image_attachment',
											'label' => esc_html__( 'Background Attachment ( Outside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_attachments,
										));

								// Background Image Inside
									// Innder Background Image
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image', array(
											'default' => '',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => 'esc_url_raw',
											'sanitize_js_callback' => 'esc_url_raw',
										));
										$this->wp_customize->add_control( new WP_Customize_Image_Control(
											$this->wp_customize, $data[ 'id' ] . '_inner_background_image', array(
												'label' => esc_html__( 'Background Image ( Inside )', 'shapeshifter' ),
												'section' => 'widget_area_' . $data[ 'id' ],
												'settings' => $data[ 'id' ] . '_inner_background_image',
											)
										));	
									
									// Background Image Size
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image_size', array(
											'default' => 'auto',
											'capability' => 'edit_theme_options',
											'transport'=> 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_image_size' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_inner_background_image_size', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_inner_background_image_size',
											'label' => esc_html__( 'Background Size ( Inside )', 'shapeshifter' ),
											'description' => __( 'Enter the value like "Horizontal Vertical" with units', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_image_sizes
										));	

									// Background Image Position Row
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image_position_row', array(
											'default'  => 'center',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_row' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_inner_background_image_position_row', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_inner_background_image_position_row',
											'label' => esc_html__( 'Background Position Row ( Inside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_position_row,
										));

									// Background Image Position Column
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image_position_column', array(
											'default'  => 'center',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_position_column' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_inner_background_image_position_column', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_inner_background_image_position_column',
											'label' => esc_html__( 'Background Position Column ( Inside )', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_position_column,
										));	

									// Background Image Repeat
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image_repeat', array(
											'default'  => 'no-repeat',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_repeat' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_inner_background_image_repeat', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_inner_background_image_repeat',
											'label' => esc_html__( 'Background Repeat', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_repeats,
										));	
								
									// Background Image Attachment
										$this->wp_customize->add_setting( $data[ 'id' ] . '_inner_background_image_attachment', array(
											'default'  => 'scroll',
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ), 
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_background_attachment' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_inner_background_image_attachment', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_inner_background_image_attachment',
											'label' => esc_html__( 'Background Attachment', 'shapeshifter' ),
											'type' => 'select',
											'choices' => $this->background_attachments,
											));	

								// Design
									// Widget Border
										$this->wp_customize->add_setting( $data[ 'id' ] . '_widget_border', array(
											'default'  => false,
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_checkbox' ),
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_widget_border', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_widget_border',
											'label' => esc_html__( 'Border for Each Item', 'shapeshifter' ),
											'type' => 'checkbox',
										));

									// Border Radius
										$this->wp_customize->add_setting( $data[ 'id' ] . '_widget_border_radius', array(
											'default' => 0,
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => 'absint',
											'sanitize_js_callback' => 'absint',
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_widget_border_radius', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_widget_border_radius',
											'label' => esc_html__( 'Border Radius', 'shapeshifter' ),
											'type' => 'range',
											'description' => '',
											'input_attrs' => array(
												'min' => 0,
												'max' => 50,
												'step' => 1,
												'value' => absint( $this->theme_mods[ 'sidebar_right_widget_border_radius' ] ),
												'id' => $data[ 'id' ] . '_widget_border_radius_id',
												'style' => 'width:100%;',
											),
										));

									// Margin
										$this->wp_customize->add_setting( $data[ 'id' ] . '_widget_margin', array(
											'default' => 0,
											'capability' => 'edit_theme_options',
											'transport' => 'postMessage',
											'sanitize_callback' => 'absint',
											'sanitize_js_callback' => 'absint',
										));
										$this->wp_customize->add_control( $data[ 'id' ] . '_widget_margin', array(
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_widget_margin',
											'label' => esc_html__( 'Margin for Each Item', 'shapeshifter' ),
											'type' => 'range',
											'description' => '',
											'input_attrs' => array(
												'min' => 0,
												'max' => 50,
												'step' => 1,
												'value' => absint( $this->theme_mods[ 'sidebar_right_widget_margin' ] ),
												'id' => $data[ 'id' ] . '_widget_margin_id',
												'style' => 'width:100%;',
											),
										));

								// Colors
									// Background
										$this->wp_customize->add_setting( $data[ 'id' ] . '_background_color', array( 
											'default' => 'rgba(255,255,255,0)',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										));
										$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, $data[ 'id' ] . '_background_color', array(
											'label' => esc_html__( 'Background Color of Widget Item', 'shapeshifter' ),
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_background_color',
										)));

									// Title
										$this->wp_customize->add_setting( $data[ 'id' ] . '_title_color', array( 
											'default' => '#000000',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										));
										$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, $data[ 'id' ] . '_title_color', array(
											'label' => esc_html__( 'Title Color', 'shapeshifter' ),
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_title_color',
										)));
										
									// Text
										$this->wp_customize->add_setting( $data[ 'id' ] . '_text_color', array( 
											'default' => '#666666',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										));
										$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, $data[ 'id' ] . '_text_color', array(
											'label' => esc_html__( 'Text Color', 'shapeshifter' ),
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_text_color',
										)));
										
									// link Text
										$this->wp_customize->add_setting( $data[ 'id' ] . '_link_text_color', array( 
											'default' => '#337ab7',
											'transport' => 'postMessage',
											'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
											'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
										));
										$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, $data[ 'id' ] . '_link_text_color', array(
											'label' => esc_html__( 'Text Link Color', 'shapeshifter' ),
											'section' => 'widget_area_' . $data[ 'id' ],
											'settings' => $data[ 'id' ] . '_link_text_color',
										)));	

						}

				}

			}

			/**
			 * Slidebars Container
			 * 		Panel IDs   : "default_widget_area_settings_panel" added by $this->set_standard_widget_areas_theme_mods()
			 * 		Section IDs : "widget_area_slidebar_{$left_or_right}" added by $this->set_standard_widget_areas_theme_mods()
			 * 		Setting IDs : "slidebar_{$left_or_right}_background_color", "slidebar_{$left_or_right}_background_image"
			**/
			function set_standard_widget_areas_slidebars_container_theme_mods() {

				$sidebars_args = array(
					'left' => array(
						'name' => esc_html__( 'Left', 'shapeshifter' )
					),
					'right' => array(
						'name' => esc_html__( 'Right', 'shapeshifter' )
					)
				);
				foreach( $sidebars_args as $either => $data ) {

					// Settings
						// Slidebar Container
							// Background Color
								$this->wp_customize->add_setting( 'slidebar_' . $either . '_background_color', array( 
									'default' => 'rgba(255,255,255,0)',
									'transport' => 'postMessage',
									'sanitize_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
									'sanitize_js_callback' => array( 'ShapeShifter_Data_Sanitizer', 'sanitize_color_value' ),
								));
								$this->wp_customize->add_control( new Customize_Alpha_Color_Control( $this->wp_customize, 'slidebar_' . $either . '_background_color', array(
									'label' => esc_html__( 'Background Color', 'shapeshifter' ),
									'section' => 'widget_area_slidebar_' . $either . '',
									'settings' => 'slidebar_' . $either . '_background_color',
								)));

							// Background Image
								$this->wp_customize->add_setting( 'slidebar_' . $either . '_background_image', array(
									'default' => '',
									'capability' => 'edit_theme_options',
									'transport' => 'postMessage',
									'sanitize_callback' => 'esc_url_raw',
									'sanitize_js_callback' => 'esc_url_raw',
								));
								$this->wp_customize->add_control( new WP_Customize_Image_Control(
									$this->wp_customize, 'slidebar_' . $either . '_background_image', array(
										'label' => esc_html__( 'Background Image', 'shapeshifter' ),
										'section' => 'widget_area_slidebar_' . $either . '',
										'settings' => 'slidebar_' . $either . '_background_image',
									)
								));	

				}

			}

		/**
		 * Others
		 * 		Panel IDs : "other_custom_settings_panel"
		 * 
		 * @see $this->set_others_images_theme_mods()
		**/
		function set_others_theme_mods() {

			# Others
				$this->wp_customize->add_panel( 'other_custom_settings_panel', array(
					'capability'	 => 'edit_theme_options',
					'theme_supports' => '',
					'title'		     => esc_html__( 'Others', 'shapeshifter' ),
					'description'	 => '',
				));

			# Images
				$this->set_others_images_theme_mods();

		}

			/**
			 * Images
			 * 		Panel IDs   : "other_custom_settings_panel" added by $this->set_others_theme_mods()
			 * 		Section IDs : "image_section" 
			 * 		Setting IDs : "default_thumbnail_image"
			**/
			function set_others_images_theme_mods() {

				// Section
					// Image Section
						$this->wp_customize->add_section( 'image_section', array(
							'title' => esc_html__( 'Images', 'shapeshifter' ),
							'panel' => 'other_custom_settings_panel',
						));

				// Settings
					// Default Post Thumbnail
						$this->wp_customize->add_setting( 'default_thumbnail_image', array(
							'default' => esc_url( SHAPESHIFTER_ASSETS_DIR_URI . 'images/no-img.png' ),
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
							'sanitize_callback' => 'esc_url_raw',
							'sanitize_js_callback' => 'esc_url_raw',
						));
						$this->wp_customize->add_control( new WP_Customize_Image_Control(
							$this->wp_customize, 'default_thumbnail_image', array(
								'label' => esc_html__( 'Default Thumbnail', 'shapeshifter' ),
								'section' => 'image_section',
								'settings' => 'default_thumbnail_image',
							)
						));

			}

	/**
	 * Preview Scripts
	**/
	function theme_customizer_live_preview() {

		$JSON = array(

			'themeDirectoryURI'         => get_template_directory_uri(),
			'themeAssetsJSDirectoryURI' => get_template_directory_uri() . '/assets/js/',

			'slidingItemType'           => esc_html__( 'Sliding Item Type', 'shapeshifter' ),
			'text'                           => esc_html__( 'Text', 'shapeshifter' ),
			'download'                  => esc_html__( 'Download', 'shapeshifter' ),
			'close'                     => esc_html__( 'Close', 'shapeshifter' ),
			'slidingImage'              => esc_html__( 'Sliding Images', 'shapeshifter' ),
			'itemD'                     => esc_html__( 'Item %d', 'shapeshifter' ),
			'select'                    => esc_html__( 'Select', 'shapeshifter' ),

			'topLeft'                   => esc_html__( 'Top Left', 'shapeshifter' ),
			'topCenter'                 => esc_html__( 'Top Center', 'shapeshifter' ),
			'topRight'                  => esc_html__( 'Top Right', 'shapeshifter' ),
			'bottomLeft'                => esc_html__( 'Bottom Left', 'shapeshifter' ),
			'bottomCenter'              => esc_html__( 'Bottom Center', 'shapeshifter' ),
			'bottomRight'               => esc_html__( 'Bottom Right', 'shapeshifter' ),
			'centerLeft'                => esc_html__( 'Center Left', 'shapeshifter' ),
			'centerCenter'              => esc_html__( 'Center', 'shapeshifter' ),
			'centerRight'               => esc_html__( 'CenterRight', 'shapeshifter' ),

			'itemContentTextD'          => esc_html__( 'Item Content Text %d', 'shapeshifter' ),
			'positionD'                 => esc_html__( 'Position %d', 'shapeshifter' ),
			'textColorD'                => esc_html__( 'Text Color %d', 'shapeshifter' ),
			'backgroundColorD'          => esc_html__( 'Background Color %d', 'shapeshifter' ),

			'mobileSidebar'             => esc_html__( 'Mobile Sidebar', 'shapeshifter' ),
			'afterHeader'                    => esc_html__( 'After the Header', 'shapeshifter' ),
			'beforeContentArea'         => esc_html__( 'Before Content Area', 'shapeshifter' ),
			'beforeContent'             => esc_html__( 'Before the Content', 'shapeshifter' ),
			'beginningOfContent'        => esc_html__( 'At the Beginning of the Content', 'shapeshifter' ),
			'before1stH2OfContent'      => esc_html__( 'Before the First H2 tag of the Content', 'shapeshifter' ),
			'endOfContent'              => esc_html__( 'At the End of the Content', 'shapeshifter' ),
			'afterContent'              => esc_html__( 'After the Content', 'shapeshifter' ),
			'beforeFooter'              => esc_html__( 'Before the Footer', 'shapeshifter' ),
			'inFooter'                  => esc_html__( 'In the Footer', 'shapeshifter' ),

			'allRightsReserved'         => __( 'Copyright © <span id="copyright-year">%1$d</span> <span class="shapeshifter-footer-site-name">%2$s</span> All Rights Reserved.', 'shapeshifter' ),
			'ccBy'                      => __( 'CC-BY <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'ccBySa'                    => __( 'CC-BY-SA <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'ccByNd'                    => __( 'CC-BY-ND <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'ccByNc'                    => __( 'CC-BY-NC <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'ccByNcSa'                  => __( 'CC-BY-NC-SA <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'ccByNcNd'                  => __( 'CC-BY-NC-ND <span class="shapeshifter-footer-site-name">%1$s</span> Some Rights Reserved.', 'shapeshifter' ),
			'cc0'                       => __( 'CC0 <span class="shapeshifter-footer-site-name">%1$s</span> No Rights Reserved.', 'shapeshifter' ),
			'public'                    => __( 'Public Domain <span class="shapeshifter-footer-site-name">%1$s</span> No Rights Reserved.', 'shapeshifter' )
		);

		wp_localize_script( 'shapeshifter-theme-customizer', 'shapeshifterThemeMods', $this->theme_mods );
		wp_localize_script( 'shapeshifter-theme-customizer', 'shapeshifterJSTranslatedObject', $JSON );

		wp_enqueue_script( 'shapeshifter-theme-customizer' );

	}

	/**
	 * Control Scripts
	**/
	function shapeshifter_theme_customizer_control_scripts() {

		wp_enqueue_style( 'customizer-alpha-color-picker' );
		wp_enqueue_script( 'customizer-alpha-color-picker' );

	}

} // End Closure

}


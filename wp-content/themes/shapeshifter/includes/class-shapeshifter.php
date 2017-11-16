<?php

# Check if This is read by WordPress.
	if ( ! defined( 'ABSPATH' ) ) exit;

# Main
/**
 * Core Class
 * This will trigger ShapeShifter
**/	
final class ShapeShifter {

	#
	# Params
	#
		/**
		 * Admin
		 * 
		 * @var $admin
		**/
		public static $admin;

		/**
		 * Theme Customizer
		**/
		public static $theme_customizer;

		/**
		 * Frontend
		**/
		public static $frontend;

	#
	# Settings
	#
		/**
		 * Options Data Array
		 * Without Plugin "WP Theme ShapeShifter Extensions", this only has default values.
		 * 
		 * @var array $options
		**/
		private static $options = array();

		/**
		 * Return Options Array
		 * 
		 * @return array self::$options
		**/
		public static function get_shapeshifter_options() {
			return self::$options;
		}

	#
	# Initializations
	#
		/**
		 * Constructor
		 * Define Consts for Dirs and URIs
		 * 
		 * @see $this->load_textdomain()
		 * @see $this->define_global_functions()
		 * @see $this->define_global_action_functions()
		 * @see shapeshifter_at_the_end_of_globals_constructor()
		 * @see $this->init()                                    by hooked in "after_setup_theme"
		**/
		function __construct( $options = array() ) {

			// Options
			self::$options = $options;

			// Localizations
			$this->load_textdomain();

			// Constants ( Only For Directory and URI )
				// Texts
				if ( ! defined( 'SHAPESHIFTER_NBSP' ) ) define( 'SHAPESHIFTER_NBSP', '&nbsp;' );

				// Theme Root Directory
				if ( ! defined( 'SHAPESHIFTER_THEME_ROOT_DIR' ) ) define( 'SHAPESHIFTER_THEME_ROOT_DIR', get_template_directory() );
				// Theme Root Directory URI
				if ( ! defined( 'SHAPESHIFTER_THEME_ROOT_URI' ) ) define( 'SHAPESHIFTER_THEME_ROOT_URI', esc_url( get_template_directory_uri() ) );

				// Assets Directory in the Theme
				if ( ! defined( 'SHAPESHIFTER_ASSETS_DIR' ) ) define( 'SHAPESHIFTER_ASSETS_DIR', SHAPESHIFTER_THEME_ROOT_DIR . '/assets/' );
				if ( ! defined( 'SHAPESHIFTER_ASSETS_DIR_URI' ) ) define( 'SHAPESHIFTER_ASSETS_DIR_URI', esc_url( SHAPESHIFTER_THEME_ROOT_URI . '/assets/' ) );

				// Templates Directory in the Theme
				if ( ! defined( 'SHAPESHIFTER_TEMPLATES_DIR' ) ) define( 'SHAPESHIFTER_TEMPLATES_DIR', SHAPESHIFTER_THEME_ROOT_DIR . '/templates/' );

				// Includes Directory in the Theme
				if ( ! defined( 'SHAPESHIFTER_INCLUDES_DIR' ) ) define( 'SHAPESHIFTER_INCLUDES_DIR', SHAPESHIFTER_THEME_ROOT_DIR . '/includes/' );
				if ( ! defined( 'SHAPESHIFTER_INCLUDES_DIR_URI' ) ) define( 'SHAPESHIFTER_INCLUDES_DIR_URI', esc_url( SHAPESHIFTER_THEME_ROOT_URI . '/includes/' ) );

				// 3rd Parties Directory in the Theme
				if ( ! defined( 'SHAPESHIFTER_THIRD_DIR' ) ) define( 'SHAPESHIFTER_THIRD_DIR', SHAPESHIFTER_INCLUDES_DIR . '3rd/' );
				if ( ! defined( 'SHAPESHIFTER_THIRD_DIR_URI' ) ) define( 'SHAPESHIFTER_THIRD_DIR_URI', esc_url( SHAPESHIFTER_THEME_ROOT_URI . '/includes/3rd/' ) );

			// Functions
			$this->define_global_functions();
			$this->define_global_action_functions();

			// Classes

			// Initializations
			add_action( 'after_setup_theme', array( $this, 'init' ), 5 );

			// Trigger Actions from outside
			shapeshifter_at_the_end_of_globals_constructor();

		}

		/**
		 * Localizations
		**/
		function load_textdomain() {

			// TextDomain
			load_theme_textdomain( 'shapeshifter', get_template_directory() . '/languages' );

		}

		#
		# Functions
		#
			/**
			 * Generals Functions
			**/
			function define_global_functions() {

				require_once( SHAPESHIFTER_INCLUDES_DIR . 'functions-generals.php' );
				require_once( SHAPESHIFTER_INCLUDES_DIR . 'functions-comments-pings.php' );

			}

			/**
			 * Functions calling do_action()
			**/
			function define_global_action_functions() {

				require_once( SHAPESHIFTER_INCLUDES_DIR . 'functions-do-actions.php' );

			}

		#
		# Classes
		#
			/**
			 * Define Classes
			**/
			function define_global_classes() {

				// Data Sanitizer
				if ( ! class_exists( 'ShapeShifter_Data_Sanitizer' ) )
					require_once( SHAPESHIFTER_INCLUDES_DIR . 'class-shapeshifter-data-sanitizer.php' );

				// Register Widget Areas
				if ( ! class_exists( 'ShapeShifter_Register_Widget_Areas' ) )
					require_once( SHAPESHIFTER_INCLUDES_DIR . 'class-shapeshifter-register-widget-areas.php' );

				// Register Widget Areas
				if ( ! class_exists( 'ShapeShifter_Theme_Mods' ) )
					require_once( SHAPESHIFTER_INCLUDES_DIR . 'class-shapeshifter-theme-mods.php' );

				// Style Handler
				if ( ! class_exists( 'ShapeShifter_Styles_Handler' ) )
					require_once( SHAPESHIFTER_INCLUDES_DIR . 'class-shapeshifter-styles-handler.php' );

			}

		#
		# Actions
		#
			/**
			 * Will be Hooked "after_setup_theme 1"
			 * Define Required Foundation
			**/
			function init() {

				// Defines
					// Constants
					$this->setup_constants();

					// Vars
					$this->setup_vars();

					// Second Constants
					$this->setup_constants_second();

					// Classes
						// Global
						$this->define_global_classes();

						// Public
						$this->define_frontend_classes();

						// Admin
						if ( SHAPESHIFTER_IS_ADMIN ) {
							$this->define_admin_classes();
						}

						// Customizer
						if ( SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW ) {
							$this->define_theme_customizer_classes();
						}

				// WP Setup Trigger ( After Setup Theme )
					// Add Theme Supports
					$this->add_theme_supports();

					// Add Image Sizes
					$this->add_image_sizes();

					// Register Nav Menus
					$this->register_nav_menus();

					// Register CSS JS
					add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
					add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
					add_action( 'customize_preview_init', array( $this, 'register_scripts' ) );
					add_action( 'customize_controls_print_footer_scripts', array( $this, 'register_scripts' ) );

				// Trigger Classes
					// Global
					$this->trigger_global_classes();

					// Frontend
					$this->trigger_frontend_classes();

					// Admin
					if ( SHAPESHIFTER_IS_ADMIN ) {
						$this->trigger_admin_classes();
					}

					// Customizer
					if ( SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW ) {
						$this->trigger_theme_customizer_classes();
					}

			}

		#
		# Defines
		#
			/**
			 * Constants
			**/
			function setup_constants() {

				#
				# Constants used in the Theme
				#
					// Get the Theme Info
					$shapeshifter_theme = wp_get_theme();
						if ( ! defined( 'SHAPESHIFTER_THEME_NAME' ) ) define( 'SHAPESHIFTER_THEME_NAME', $shapeshifter_theme[ 'Name' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_URI' ) ) define( 'SHAPESHIFTER_THEME_URI', $shapeshifter_theme[ 'ThemeURI' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_DESCRIPTION' ) ) define( 'SHAPESHIFTER_THEME_DESCRIPTION', $shapeshifter_theme[ 'Description' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_AUTHOR' ) ) define( 'SHAPESHIFTER_THEME_AUTHOR', $shapeshifter_theme[ 'Author' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_AUTHOR_URI' ) ) define( 'SHAPESHIFTER_THEME_AUTHOR_URI', $shapeshifter_theme[ 'AuthorURI' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_VERSION' ) ) define( 'SHAPESHIFTER_THEME_VERSION', $shapeshifter_theme[ 'Version' ] );
						if ( ! defined( 'SHAPESHIFTER_THEME_TEMPLATE' ) ) define( 'SHAPESHIFTER_THEME_TEMPLATE', $shapeshifter_theme[ 'Template' ] );
					unset( $shapeshifter_theme );

					// Child Theme
					if ( ! defined( 'SHAPESHIFTER_IS_CHILD_THEME' ) ) define( 'SHAPESHIFTER_IS_CHILD_THEME', shapeshifter_boolval( SHAPESHIFTER_THEME_NAME !== 'ShapeShifter' ) );

					// Theme Prefix
					if ( ! defined( 'SHAPESHIFTER_THEME_PREFIX' ) ) define( 'SHAPESHIFTER_THEME_PREFIX', str_replace( array( ' ', '-' ), '_', strtolower( SHAPESHIFTER_THEME_NAME ) ) . '-' );

					// Theme Options Prefix
					if ( ! defined( 'SHAPESHIFTER_THEME_OPTIONS' ) ) define( 'SHAPESHIFTER_THEME_OPTIONS', 'shapeshifter_option_' );
					if ( ! defined( 'SHAPESHIFTER_MAYBE_CHILD_THEME_OPTIONS' ) ) define( 'SHAPESHIFTER_MAYBE_CHILD_THEME_OPTIONS', str_replace( array( ' ', '-' ), '_', SHAPESHIFTER_THEME_PREFIX ) . 'option_' );

					// Theme Post Meta Prefix
					if ( ! defined( 'SHAPESHIFTER_THEME_POST_META' ) ) define( 'SHAPESHIFTER_THEME_POST_META', '_shapeshifter_post_meta_' );

					// Site Name
					if ( ! defined( 'SHAPESHIFTER_SITE_NAME' ) ) define( 'SHAPESHIFTER_SITE_NAME', get_bloginfo( 'name' ) );
					// Site Description
					if ( ! defined( 'SHAPESHIFTER_SITE_DESCRIPTION' ) ) define( 'SHAPESHIFTER_SITE_DESCRIPTION', get_bloginfo( 'description' ) );
					// Site URL
					if ( ! defined( 'SHAPESHIFTER_SITE_URL' ) ) define( 'SHAPESHIFTER_SITE_URL', home_url() );

					// Admin
					if ( ! defined( 'SHAPESHIFTER_IS_ADMIN' ) ) define( 'SHAPESHIFTER_IS_ADMIN', shapeshifter_boolval( is_admin() ) );
					if ( ! defined( 'SHAPESHIFTER_IS_ADMIN_BAR_SHOWING' ) ) define( 'SHAPESHIFTER_IS_ADMIN_BAR_SHOWING', shapeshifter_boolval( is_admin_bar_showing() ) );
					if ( ! defined( 'SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW' ) ) define( 'SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW', shapeshifter_boolval( is_customize_preview() ) );

				#
				# Mobile Detect
				#
					if ( ! class_exists( 'Mobile_Detect' ) ) require_once( SHAPESHIFTER_THIRD_DIR . 'Mobile-Detect/Mobile_Detect.php' );
					$shapeshifter_detect = new Mobile_Detect();
						if ( ! defined( 'SHAPESHIFTER_IS_MOBILE' ) ) define( 'SHAPESHIFTER_IS_MOBILE', shapeshifter_boolval( $shapeshifter_detect->isMobile() ) );
						if ( ! defined( 'SHAPESHIFTER_IS_TABLET' ) ) define( 'SHAPESHIFTER_IS_TABLET', shapeshifter_boolval( $shapeshifter_detect->isTablet() ) );
						if ( ! defined( 'SHAPESHIFTER_IS_IOS' ) ) define( 'SHAPESHIFTER_IS_IOS', shapeshifter_boolval( $shapeshifter_detect->isiOS() ) );
						if ( ! defined( 'SHAPESHIFTER_IS_ANDROIDOS' ) ) define( 'SHAPESHIFTER_IS_ANDROIDOS', shapeshifter_boolval( $shapeshifter_detect->isAndroidOS() ) );
					unset( $shapeshifter_detect );

			}

			/**
			 * Vars
			**/
			function setup_vars() {

			}

			/**
			 * Secondary Constants
			**/
			function setup_constants_second() {

				# Options
					# 

			}

			#
			# Classes
			#
				/**
				 * Public
				**/
				function define_frontend_classes() {

					// ShapeShifter HTML Parts
					if ( ! class_exists( 'ShapeShifter_Frontend_HTML_Parts' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'frontend/class-shapeshifter-frontend-html-parts.php' );
					// ShapeShifter Other Methods
					if ( ! class_exists( 'ShapeShifter_Frontend_Methods' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'frontend/class-shapeshifter-frontend-methods.php' );
					// Public
					if ( ! class_exists( 'ShapeShifter_Frontend' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'frontend/class-shapeshifter-frontend.php' );

				}

				/**
				 * Admin
				**/
				function define_admin_classes() {

					// Admin Main
					if ( ! class_exists( 'ShapeShifter_Admin' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'admin/class-shapeshifter-admin.php' );

					// Admin Meta Boxes
					if ( ! class_exists( 'ShapeShifter_Admin_Meta_Boxes' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'admin/class-shapeshifter-meta-boxes.php' );

				}

				/**
				 * Theme Customizer
				**/
				function define_theme_customizer_classes() {

					// 3rd
						// Customize_Alpha_Color_Control
						if ( ! class_exists( 'Customize_Alpha_Color_Control' ) )
							require_once( SHAPESHIFTER_THIRD_DIR . 'customizer/alpha-color-picker/alpha-color-picker.php' );

						// Customize_Multi_Color_Control
						if ( ! class_exists( 'Customize_Multi_Color_Control' ) )
							require_once( SHAPESHIFTER_THIRD_DIR . 'customizer/multi-color-picker/multi-color-picker.php' );

					// Theme Customizer
					if ( ! class_exists( 'ShapeShifter_Theme_Customizer' ) )
						require_once( SHAPESHIFTER_INCLUDES_DIR . 'theme-customizer/class-shapeshifter-theme-customizer.php' );

				}

		#
		# WP Setup Trigger
		#
			/**
			 * Add Theme Supports
			**/
			function add_theme_supports() { 

				// General Supports
				add_theme_support( 'custom-background' );
				add_theme_support( 'post-thumbnails' );
				add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
				add_theme_support( 'title-tag' );
				add_theme_support( 'editor-style' );
				add_theme_support( 'automatic-feed-links' );

				add_theme_support( 'customize-selective-refresh-widgets' );

				// WooCommerce
				add_theme_support( 'woocommerce' );

			}

			/**
			 * Add Image Sizes
			**/
			function add_image_sizes() {

				add_image_size( 'shapeshifter-thumb80', 80, 80, true );// 表示する時のサイズ
				add_image_size( 'shapeshifter-thumb100', 100, 100, true );// 表示する時のサイズ

			}

			/**
			 * Add Image Sizes
			**/
			function register_nav_menus() {

				register_nav_menus( 
					array( 
						'top_nav' => esc_html__( 'Primary Navi Menu ( PC Only )', 'shapeshifter' ),
						'navbar' => esc_html__( 'Secondary Navi Menu ( PC Only )', 'shapeshifter' ),
						'mobile_nav_menu' => esc_html__( 'Main Navi Menu for Mobile ( Mobile Only )', 'shapeshifter' ), 
						'footer_nav' => esc_html__( 'Footer Navi Menu ( PC and Mobile )', 'shapeshifter' ),
					) 
				);

			}

			/**
			 * Register CSS JS
			**/
			function register_scripts() {

				// CSS
					// Global
						// 3rd
							// Normalize
							wp_register_style( 'normalize', SHAPESHIFTER_THIRD_DIR_URI . 'normalize-css/normalize.css' );
							// Bootstrap 3
							wp_register_style( 'bootstrap3', SHAPESHIFTER_THIRD_DIR_URI . 'bootstrap/css/bootstrap.min.css' );
							// Bootstrap 3 Theme
							wp_register_style( 'bootstrap3-theme', SHAPESHIFTER_THIRD_DIR_URI . 'bootstrap/css/bootstrap-theme.min.css' );
							// Font Awesome
							wp_register_style( 'font-awesome', SHAPESHIFTER_THIRD_DIR_URI . 'font-awesome/css/font-awesome.min.css' );
							// Magnific Popup
							wp_register_style( 'magnific-popup', SHAPESHIFTER_THIRD_DIR_URI . 'Magnific-Popup/dist/magnific-popup.css' );
							// Alpha Color Picker
							wp_register_style(
								'alpha-color-picker',
								SHAPESHIFTER_THIRD_DIR_URI . 'alpha-color-picker/alpha-color-picker.css', // Update to where you put the file.
								array( 'wp-color-picker' ) // You must include these here.
							);
							wp_register_style(
								'customizer-alpha-color-picker',
								SHAPESHIFTER_THIRD_DIR_URI . 'customizer/alpha-color-picker/alpha-color-picker.css',
								array( 'customizer-wp-color-picker' ),
								'1.0.0'
							);
							// Animate CSS
							wp_register_style( 
								'animate-css', 
								SHAPESHIFTER_THIRD_DIR_URI . 'animate.css-master/animate.min.css'
							);

					// Public
					wp_register_style( 
						'shapeshifter-style', 
						SHAPESHIFTER_THEME_ROOT_URI . '/style.css',
						array( 'normalize', 'bootstrap3', 'bootstrap3-theme', 'font-awesome', 'magnific-popup', 'animate-css' ) 
					);

					// Admin
					wp_register_style(
						'shapeshifter-meta-boxes',
						SHAPESHIFTER_ASSETS_DIR_URI . 'css/meta-boxes.css',
						array( 'wp-color-picker', 'alpha-color-picker', 'font-awesome' )
					);

					// Customizer

				// JS
					wp_localize_script( 'jquery', 'shapeshifterJSLocalizedGlobal', array(
					) );
					// Global
						// 3rd
							// Bootstrap 3
							wp_register_script( 
								'bootstrap3', 
								SHAPESHIFTER_THIRD_DIR_URI . 'bootstrap/js/bootstrap.min.js', 
								array( 'jquery' ), 
								false, 
								true
							);
							// Magnific Popup
							wp_register_script( 
								'magnific-popup', 
								SHAPESHIFTER_THIRD_DIR_URI . 'Magnific-Popup/dist/jquery.magnific-popup.min.js', 
								array( 'jquery' ), 
								false, 
								true
							);
							// Alpha Color Picker
							wp_register_script(
								'alpha-color-picker',
								SHAPESHIFTER_THIRD_DIR_URI . 'alpha-color-picker/alpha-color-picker.js',
								array( 'jquery', 'wp-color-picker' ),
								null,
								true
							);
							wp_register_script(
								'customizer-alpha-color-picker',
								SHAPESHIFTER_THIRD_DIR_URI . 'customizer/alpha-color-picker/alpha-color-picker.js',
								array( 'jquery', 'wp-color-picker' ),
								'1.0.0',
								true
							);

						// Theme
							// jQuery Extensions
							wp_register_script( 
								'shapeshifter-jquery-extensions', 
								SHAPESHIFTER_ASSETS_DIR_URI . 'js/jquery-extensions.js', 
								array( 'jquery' ), 
								false, 
								true
							);

					// Public
						// Animate
						wp_register_script( 
							'shapeshifter-animate', 
							SHAPESHIFTER_ASSETS_DIR_URI . 'js/animate.min.js', 
							array( 'jquery', 'shapeshifter-jquery-extensions' ), 
							false, 
							true 
						);
						// Scripts
						wp_register_script( 
							'shapeshifter-javascripts', 
							SHAPESHIFTER_ASSETS_DIR_URI . 'js/javascripts.min.js', 
							array( 'jquery', 'shapeshifter-jquery-extensions', 'bootstrap3', 'magnific-popup' ), 
							false, 
							true 
						);

					// Admin
						// Theme
						wp_register_script( 
							'shapeshifter-meta-boxes', 
							SHAPESHIFTER_ASSETS_DIR_URI . 'js/meta-boxes.js',
							array( 'jquery', 'wp-color-picker', 'shapeshifter-jquery-extensions', 'alpha-color-picker' ),
							null,
							true
						);

					// Customizer
					wp_register_script( 
						'shapeshifter-theme-customizer',
						SHAPESHIFTER_ASSETS_DIR_URI . 'js/theme-customizer.js',
						array( 'jquery', 'customize-preview' ),
						null,
						true
					);

			}

			/**
			 * Global
			**/
			function trigger_global_classes() {

				if ( class_exists( 'ShapeShifter_Register_Widget_Areas' ) )
					$GLOBALS['shapeshifter_register_widget_area'] = new ShapeShifter_Register_Widget_Areas();

				shapeshifter_trigger_global_classes();

			}

			/**
			 * Frontend
			**/
			function trigger_frontend_classes() {

				if ( class_exists( 'ShapeShifter_Frontend' ) )
					$GLOBALS['shapeshifter_frontend'] = new ShapeShifter_Frontend();

				shapeshifter_trigger_frontend_classes();

			}

			/**
			 * Admin
			**/
			function trigger_admin_classes() {

				if ( class_exists( 'ShapeShifter_Admin' ) )
					$GLOBALS['shapeshifter_admin'] = new ShapeShifter_Admin();

				if ( class_exists( 'ShapeShifter_Admin_Meta_Boxes' ) )
					$GLOBALS['shapeshifter_admin_meta_boxes'] = new ShapeShifter_Admin_Meta_Boxes();

				shapeshifter_trigger_admin_classes();

			}

			/**
			 * Theme Customizer
			**/
			function trigger_theme_customizer_classes() {

				if ( class_exists( 'ShapeShifter_Theme_Customizer' ) )
					$GLOBALS['shapeshifter_theme_customizer'] = new ShapeShifter_Theme_Customizer();

				shapeshifter_trigger_theme_customizer_classes();

			}

}

<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'ShapeShifter_Frontend' ) ) {

/**
 * Frontend
 * 
**/
class ShapeShifter_Frontend extends ShapeShifter_Frontend_Methods {

	#
	# Vars
	#
		/**
		 * Theme Mods
		 * 
		 * @var array $theme_mods
		**/
		public $theme_mods = array();

		/**
		 * CSS Animations
		 * 
		 * @var array $css_animations
		**/
		public $css_animations = array();

		/**
		 * Post Formats
		 * 
		 * @var array $post_format_terms
		**/
		public $post_format_terms = array();

		/**
		 * Standard Widget Areas
		 * 
		 * @var array $standard_widget_areas
		**/
		public $standard_widget_areas = array();

		/**
		 * Post Meta
		 * 
		 * @var array $deactivate_widget_areas
		**/
		public $deactivate_widget_areas = array();

		/**
		 * Walker Class
		 * 
		 * @var string $walker_nav_menu_class
		**/
		public $walker_nav_menu_class;

	/**
	 * Construct
	**/
	function __construct() {

		// Theme Mods Data
		$this->theme_mods = $GLOBALS['shapeshifter_theme_mods'] = ShapeShifter_Theme_Mods::get_theme_mods( SHAPESHIFTER_MAYBE_CHILD_THEME_OPTIONS );

		// One Column
		$GLOBALS['shapeshifter_is_one_column_page_width_size_max'] = shapeshifter_boolval( $this->theme_mods['is_one_column_main_content_max_width_on'] );

		// Actions
		$this->add_actions();

		// Filters
		$this->add_filters();

		// End Trigger
		shapeshifter_trigger_frontend();

	}

	/**
	 * Actions
	**/
	function add_actions() {

		// WP
		add_action( 'wp', array( $this, 'init_frontend' ) );

		// Enqueue CSS JS
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 100 );

		// WP Head
		add_action( 'wp_head', array( $this, 'theme_customized_styles' ) );

		#
		# Page Generators
		#
			// Actions
				// header.php
				add_action( 'shapeshifter_header', array( $this, 'shapeshifter_header' ) );

					// Head
					add_action( 'shapeshifter_head', array( $this, 'shapeshifter_head' ) );

					// Body Header
					add_action( 'shapeshifter_starting_body' , array( $this, 'shapeshifter_starting_body' ) );
						add_action( 'shapeshifter_body_header', array( $this, 'shapeshifter_body_header' ) );

							add_action( 'shapeshifter_header_top', array( $this, 'shapeshifter_header_top' ) );
							//add_action( 'shapeshifter_header_logo', array( $this, 'shapeshifter_header_logo' ) );
							add_action( 'shapeshifter_after_header', array( $this, 'shapeshifter_after_header' ) );
							add_action( 'shapeshifter_before_content_area', array( $this, 'shapeshifter_before_content_area' ) );

					// Content Area Start
					add_action( 'shapeshifter_content_area_start', array( $this, 'shapeshifter_content_area_start' ) );

				// footer.php
				add_action( 'shapeshifter_footer', array( $this, 'shapeshifter_footer' ) );

					// Footer Section
					add_action( 'shapeshifter_footer_section', array( $this, 'shapeshifter_footer_section' ) );
						add_action( 'shapeshifter_before_footer', array( $this, 'shapeshifter_before_footer' ) );
						add_action( 'shapeshifter_footer_last', array( $this, 'shapeshifter_footer_last' ) );
						add_action( 'shapeshifter_footer_site_description', array( $this, 'shapeshifter_footer_site_description' ) );
						add_action( 'shapeshifter_footer_license_type', array( $this, 'shapeshifter_footer_license_type' ) );

					// Mobile
						// Footer Menu
						if ( SHAPESHIFTER_IS_MOBILE || shapeshifter_boolval( $this->theme_mods[ 'is_responsive' ] ) ) {
							add_action( 'wp_footer', array( $this, 'shapeshifter_footer_menu_for_mobile' ) );
						}

						// Footer Side Menu
						if ( SHAPESHIFTER_IS_MOBILE ) {
							add_action( 'wp_footer', array( $this, 'shapeshifter_mobile_side_menu' ) );
						}

				// index.php
				add_action( 'shapeshifter_frontend', array( $this, 'shapeshifter_generate_frontend_page' ) );

					// Body
					add_action( 'shapeshifter_body', array( $this, 'shapeshifter_body' ) );

						// Content Area
						add_action( 'shapeshifter_content_area', array( $this, 'shapeshifter_content_area' ) );
						add_action( 'shapeshifter_content_area_end', array( $this, 'shapeshifter_content_area_end' ) );

							// Before Content
							add_action( 'shapeshifter_before_content', array( $this, 'shapeshifter_before_content' ) );

							// Main Content
							add_action( 'shapeshifter_main_content', array( $this, 'shapeshifter_main_content' ) );

								// Page Type
								add_action( 'shapeshifter_main_content_home', array( $this, 'shapeshifter_main_content_home' ) );
								add_action( 'shapeshifter_main_content_front_page', array( $this, 'shapeshifter_main_content_front_page' ) );
								add_action( 'shapeshifter_main_content_blog_page', array( $this, 'shapeshifter_main_content_blog_page' ) );
								add_action( 'shapeshifter_main_content_singular_page', array( $this, 'shapeshifter_main_content_singular_page' ) );
								add_action( 'shapeshifter_main_content_archive_page', array( $this, 'shapeshifter_main_content_archive_page' ) );
								add_action( 'shapeshifter_main_content_woocommerce_page', array( $this, 'shapeshifter_main_content_woocommerce_page' ) );
								add_action( 'shapeshifter_main_content_bbpress_page', array( $this, 'shapeshifter_main_content_bbpress_page' ) );

									// Singular
									add_action( 'shapeshifter_breadcrumb', array( $this, 'shapeshifter_breadcrumb' ) );
									add_action( 'shapeshifter_main_content_singular_page_header', array( $this, 'shapeshifter_main_content_singular_page_header' ) );
									add_action( 'shapeshifter_main_content_singular_page_content', array( $this, 'shapeshifter_main_content_singular_page_content' ) );
									add_action( 'shapeshifter_main_content_singular_page_link_pages', array( $this, 'shapeshifter_main_content_singular_page_link_pages' ) );
									add_action( 'shapeshifter_main_content_singular_page_footer', array( $this, 'shapeshifter_main_content_singular_page_footer' ) );
										add_action( 'shapeshifter_main_content_singular_page_prev_next', array( $this, 'shapeshifter_main_content_singular_page_prev_next' ) );

									// Archive
									add_action( 'shapeshifter_archive_page_title', array( $this, 'shapeshifter_archive_page_title' ) );
									add_action( 'shapeshifter_post_list_item', array( $this, 'shapeshifter_post_list_item' ) );
									add_action( 'shapeshifter_the_excerpt', array( $this, 'shapeshifter_the_excerpt' ) );
									add_action( 'shapeshifter_pagination', array( $this, 'shapeshifter_pagination' ) );

									// BBPress

									// WooCommerce
									add_action( 'shapeshifter_main_content_woocommerce_page', array( $this, 'shapeshifter_main_content_woocommerce_page' ) );
										add_action( 'shapeshifter_wc_shop', array( $this, 'shapeshifter_wc_shop' ) );
										add_action( 'shapeshifter_woocommerce_product_taxonomy', array( $this, 'shapeshifter_woocommerce_product_taxonomy' ) );
										add_action( 'shapeshifter_woocommerce_single_product', array( $this, 'shapeshifter_woocommerce_single_product' ) );
										add_action( 'shapeshifter_woocommerce_cart', array( $this, 'shapeshifter_woocommerce_cart' ) );
										add_action( 'shapeshifter_woocommerce_checkout', array( $this, 'shapeshifter_woocommerce_checkout' ) );
										add_action( 'shapeshifter_woocommerce_account_page', array( $this, 'shapeshifter_woocommerce_account_page' ) );
										add_action( 'shapeshifter_display_product', array( $this, 'shapeshifter_display_product' ) );

							// After Content
							add_action( 'shapeshifter_after_content', array( $this, 'shapeshifter_after_content' ) );

				// Widget Areas
				add_action( 'shapeshifter_widget_areas', array( $this, 'shapeshifter_widget_areas' ) );

					// Standard
					add_action( 'shapeshifter_widget_area_sidebar_left', array( $this, 'shapeshifter_widget_area_sidebar_left' ) );
					add_action( 'shapeshifter_widget_area_sidebar_left_fixed', array( $this, 'shapeshifter_widget_area_sidebar_left_fixed' ) );
					add_action( 'shapeshifter_widget_area_sidebar_right', array( $this, 'shapeshifter_widget_area_sidebar_right' ) );
					add_action( 'shapeshifter_widget_area_sidebar_right_fixed', array( $this, 'shapeshifter_widget_area_sidebar_right_fixed' ) );

					if ( ! SHAPESHIFTER_IS_MOBILE ) {
						add_action( 'wp_footer', array( $this, 'shapeshifter_slidebar_left' ) );
						add_action( 'wp_footer', array( $this, 'shapeshifter_slidebar_right' ) );
						//add_action( 'wp_footer', array( $this, 'shapeshifter_top_right_fixed' ) );
					}

					add_action( 'shapeshifter_widget_areas_mobile_menu', array( $this, 'shapeshifter_widget_areas_mobile_menu' ) );

				// Nav Menu
				add_action( 'shapeshifter_header_nav_menu', array( $this, 'shapeshifter_header_nav_menu' ) );
				add_action( 'shapeshifter_nav_menu', array( $this, 'shapeshifter_nav_menu' ) );
				add_action( 'shapeshifter_footer_nav_menu', array( $this, 'shapeshifter_footer_nav_menu' ) );

				// Wrapper
				add_action( 'shapeshifter_body_wrapper_start', array( $this, 'shapeshifter_body_wrapper_start' ) );
				add_action( 'shapeshifter_body_wrapper_end', array( $this, 'shapeshifter_body_wrapper_end' ) );

				// Others ( Statics )
					// Generated Tag
					add_action( 'shapeshifter_generated_tag', array( __CLASS__, 'shapeshifter_generated_tag' ) );
					// Default Thumbnail URL
					add_action( 'shapeshifter_the_default_thumbnail_url', array( __CLASS__, 'shapeshifter_the_default_thumbnail_url' ) );
					// Thumbnail DIV Tag
					add_action( 'shapeshifter_default_thumbnail_div_tag', array( __CLASS__, 'shapeshifter_default_thumbnail_div_tag' ) );
					// Post Thumbnail DIV Tag
					add_action( 'shapeshifter_post_thumbnail_div_tag', array( __CLASS__, 'shapeshifter_post_thumbnail_div_tag' ) );

	}

	// Methods Except Page Generators
		/**
		 * Hooked in Action Hook "wp"
		**/
		function init_frontend() {

			// WP Query
			global $wp_query;

			// Defines
				// Constants
				$this->setup_constants( $wp_query );

			// CSS Animations
			if ( ! SHAPESHIFTER_IS_MOBILE ) {
				$elements = array( 'h1', 'postinfos', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div', 'img', 'table' );
				$GLOBALS[ 'shapeshifter_css_animations' ] = array();
				foreach( $elements as $index => $element ) {

					if ( ! is_string( $element ) ) continue;

					$this->css_animations[ $element ] = $GLOBALS[ 'shapeshifter_css_animations' ][ $element ] = array(
						'hover' => sanitize_text_field( $GLOBALS[ 'shapeshifter_theme_mods' ][ 'singular_page_' . $element . '_animation_hover_select' ] ),
						'enter' => sanitize_text_field( $GLOBALS[ 'shapeshifter_theme_mods' ][ 'singular_page_' . $element . '_animation_enter_select' ] )
					);
				}
			}

			// WooCommerce( Optional )
			global $woocommerce;
			if ( isset( $woocommerce ) )
				$this->woocommerce = $GLOBALS[ 'shapeshifter_woocommerce' ] = $woocommerce;

			// Post Meta
				// Set up the following vars
				// $this->deactivate_widget_areas
				// $this->outputs_to_widget_area_hook
				if( ! SHAPESHIFTER_IS_ADMIN )
					$this->setup_post_meta_vars_for_contents();

			// After Setup Post Meta Vars
			if( ! SHAPESHIFTER_IS_ADMIN )
				shapeshifter_frontend_after_setup_post_meta_vars();

			// Content Area Width
			$GLOBALS[ 'shapeshifter_sidebar_left_width' ] = absint( $this->theme_mods[ 'sidebar_left_max_width' ] );
			$GLOBALS[ 'shapeshifter_content_inner_width' ] = absint( $this->theme_mods[ 'main_content_max_width' ] );
			$GLOBALS[ 'shapeshifter_sidebar_right_width' ] = absint( $this->theme_mods[ 'sidebar_right_max_width' ] );

			// Mobile Detect
			if ( ! SHAPESHIFTER_IS_MOBILE ) {

				$GLOBALS[ 'shapeshifter_get_standard_sidebar_left_container' ] = $this->shapeshifter_get_standard_sidebar_left_container();
				$GLOBALS[ 'shapeshifter_get_standard_sidebar_right_container' ] = $this->shapeshifter_get_standard_sidebar_right_container();
				$GLOBALS[ 'shapeshifter_sidebar_left_container' ] = shapeshifter_boolval( ! empty( $GLOBALS[ 'shapeshifter_get_standard_sidebar_left_container' ] ) );
				$GLOBALS[ 'shapeshifter_sidebar_right_container' ] = shapeshifter_boolval( ! empty( $GLOBALS[ 'shapeshifter_get_standard_sidebar_right_container' ] ) );

			} else {

				$GLOBALS[ 'shapeshifter_sidebar_left_container' ] = $GLOBALS[ 'shapeshifter_sidebar_right_container' ] = false;

			}

			// About Layout of Content Area
			if ( $GLOBALS[ 'shapeshifter_sidebar_left_container' ] && $GLOBALS[ 'shapeshifter_sidebar_right_container' ] ) {

				$GLOBALS[ 'shapeshifter_content_width' ] = $GLOBALS[ 'shapeshifter_content_inner_width' ] + $GLOBALS[ 'shapeshifter_sidebar_left_width' ] + $GLOBALS[ 'shapeshifter_sidebar_right_width' ];

				$GLOBALS[ 'content_area_layout_class' ] = 'three-columns';

			} elseif ( $GLOBALS[ 'shapeshifter_sidebar_left_container' ] ) {

				$GLOBALS[ 'shapeshifter_content_width' ] = $GLOBALS[ 'shapeshifter_content_inner_width' ] + $GLOBALS[ 'shapeshifter_sidebar_left_width' ];

				$GLOBALS[ 'content_area_layout_class' ] = 'two-columns-left';

			} elseif ( $GLOBALS[ 'shapeshifter_sidebar_right_container' ] ) {

				$GLOBALS[ 'shapeshifter_content_width' ] = $GLOBALS[ 'shapeshifter_content_inner_width' ] + $GLOBALS[ 'shapeshifter_sidebar_right_width' ];

				$GLOBALS[ 'content_area_layout_class' ] = 'two-columns-right';

			} else {

				$GLOBALS[ 'shapeshifter_content_width' ] = $GLOBALS[ 'shapeshifter_content_inner_width' ] + 210;
				$GLOBALS[ 'shapeshifter_content_inner_width' ] = $GLOBALS[ 'shapeshifter_content_inner_width' ] + 210;

				$GLOBALS[ 'content_area_layout_class' ] = 'one-column';

			}

			// Content Width
			global $content_width;
			$content_width = intval( $GLOBALS[ 'shapeshifter_content_width' ] );

			// After Define Content Area Layout
			shapeshifter_frontend_after_define_content_area_layout();

			// Class Data
				// Globals
				$GLOBALS['shapeshifter_frontend_classes'] = array(  );

				// Body Classes
				$GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'] = array( 'shapeshifter-body-' . esc_attr( SHAPESHIFTER_IS_MOBILE ? 'mobile' : 'pc' ) );

					// Wrapper
					array_push( $GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'], 'shapeshifter-' . ( SHAPESHIFTER_IS_MOBILE ? 'max' : 'min' ) . '-width-' . $GLOBALS['shapeshifter_content_width'] );

					// Is One Column Page Width Size Max ?
					if ( $GLOBALS['shapeshifter_is_one_column_page_width_size_max'] )
						array_push( $GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'], 'one-column-content-area-width-max' );

					// Is Responsive ?
					if ( ! SHAPESHIFTER_IS_MOBILE && $this->theme_mods['is_responsive'] )
						array_push( $GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'], 'shapeshifter-is-responsive' );

					// Is Nav Menu Fixed
					if( shapeshifter_boolval( $GLOBALS['shapeshifter_theme_mods']['is_nav_menu_fixed'] ) )
						array_push( $GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'], 'shapeshifter-nav-menu-fixed' );

			// After Define Classes
			shapeshifter_frontend_after_define_classes();

			// Nav Menus
				// Walker
				$GLOBALS[ 'shapeshifter_walker_nav_menu_instance_navbar' ] = $this->shapeshifter_get_walker_nav_menu_instance( 'navbar' );
				$GLOBALS[ 'shapeshifter_walker_nav_menu_instance_mobile_nav_menu' ] = $this->shapeshifter_get_walker_nav_menu_instance( 'mobile_nav_menu' );

				// Header Nav Menu
				ob_start();
					shapeshifter_header_nav_menu();
				$GLOBALS[ 'shapeshifter_top_nav_menu' ] = ob_get_clean();

				// Nav Menu
				ob_start();
					shapeshifter_nav_menu();
				$GLOBALS[ 'shapeshifter_nav_menu' ] = ob_get_clean();

				// Mobile Nav Menu
				ob_start();
					shapeshifter_nav_menu();
				$GLOBALS[ 'shapeshifter_mobile_nav_menu' ] = ob_get_clean();

				// Footer Nav Menu
				ob_start();
					shapeshifter_footer_nav_menu();
				$GLOBALS[ 'shapeshifter_footer_nav_menu' ] = ob_get_clean();

			// After Setup Nav Menu
			shapeshifter_frontend_after_setup_nav_menu();

			// Page Template Name Slug
			//$_GLOBALS['shapeshifter_page_template_slug'] = null;
			//if( SHAPESHIFTER_IS_PAGE ) {
				//$page_template_slug = get_page_template_slug();
				//var_dump( $page_template_slug );
			//}

		}

			/**
			 * Defines Constants
			 * 
			 * @param object $wp_query
			**/
			function setup_constants( $wp_query ) {

				# Conditional Constants
					# HOME
						if ( ! defined( 'SHAPESHIFTER_IS_HOME' ) ) define( 'SHAPESHIFTER_IS_HOME', shapeshifter_boolval( is_home() ) );
					# Front Page
						if ( ! defined( 'SHAPESHIFTER_IS_FRONT_PAGE' ) ) define( 'SHAPESHIFTER_IS_FRONT_PAGE', shapeshifter_boolval( is_front_page() ) );
					# Archive
						if ( ! defined( 'SHAPESHIFTER_IS_ARCHIVE' ) ) define( 'SHAPESHIFTER_IS_ARCHIVE', shapeshifter_boolval( is_archive() ) );
						# Category
						# Tag
						# Author
							if ( ! defined( 'SHAPESHIFTER_IS_AUTHOR' ) ) define( 'SHAPESHIFTER_IS_AUTHOR', shapeshifter_boolval( is_author() ) );

						# Date
							if ( ! defined( 'SHAPESHIFTER_IS_DATE' ) ) define( 'SHAPESHIFTER_IS_DATE', shapeshifter_boolval( is_date() ) );
							# Year
								if ( ! defined( 'SHAPESHIFTER_IS_YEAR' ) ) define( 'SHAPESHIFTER_IS_YEAR', shapeshifter_boolval( is_year() ) );
							# Month
								if ( ! defined( 'SHAPESHIFTER_IS_MONTH' ) ) define( 'SHAPESHIFTER_IS_MONTH', shapeshifter_boolval( is_month() ) );
							# Time
								if ( ! defined( 'SHAPESHIFTER_IS_TIME' ) ) define( 'SHAPESHIFTER_IS_TIME', shapeshifter_boolval( is_time() ) );

					# Singular
						if ( ! defined( 'SHAPESHIFTER_IS_SINGULAR' ) ) define( 'SHAPESHIFTER_IS_SINGULAR', shapeshifter_boolval( is_singular() ) );
						# Single
							if ( ! defined( 'SHAPESHIFTER_IS_SINGLE' ) ) define( 'SHAPESHIFTER_IS_SINGLE', shapeshifter_boolval( is_single() ) );
							# Attachment
								if ( ! defined( 'SHAPESHIFTER_IS_ATTACHMENT' ) ) define( 'SHAPESHIFTER_IS_ATTACHMENT', shapeshifter_boolval( is_attachment() ) );
						# Page
							if ( ! defined( 'SHAPESHIFTER_IS_PAGE' ) ) define( 'SHAPESHIFTER_IS_PAGE', shapeshifter_boolval( is_page() ) );

					# Search
						if ( ! defined( 'SHAPESHIFTER_IS_SEARCH' ) ) define( 'SHAPESHIFTER_IS_SEARCH', shapeshifter_boolval( is_search() ) );
					# 404
						if ( ! defined( 'SHAPESHIFTER_IS_404' ) ) define( 'SHAPESHIFTER_IS_404', shapeshifter_boolval( is_404() ) );

				# Displayed Page Type
					if ( SHAPESHIFTER_IS_404 ) { 

						# 404
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', '404' );

					} elseif ( SHAPESHIFTER_IS_SEARCH ) { 

						# Search
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'search' );

					} elseif ( SHAPESHIFTER_IS_FRONT_PAGE && SHAPESHIFTER_IS_HOME ) { 

						# Default
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'default' );

					} elseif ( SHAPESHIFTER_IS_FRONT_PAGE ) { 

						# Front Page
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'front-page' );

					} elseif ( SHAPESHIFTER_IS_HOME ) { 

						# Home
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'home' );

					} elseif ( SHAPESHIFTER_IS_ARCHIVE ) { 

						# Archive
							if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'archive' );

					} elseif ( SHAPESHIFTER_IS_SINGULAR ) { 

						if ( SHAPESHIFTER_IS_SINGULAR ) {

							# Single
								if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'single' );

						} elseif ( SHAPESHIFTER_IS_PAGE ) {

							# Page
								if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'page' );

						} else {

							# Page
								if ( ! defined( 'SHAPESHIFTER_DISPLAYED_PAGE' ) ) define( 'SHAPESHIFTER_DISPLAYED_PAGE', 'custom-post-type' );

						}

					} else { 
						#Else

					}									

			}

			/**
			 * Setup for Post Meta
			**/
			function setup_post_meta_vars_for_contents() {

				global $wp_query;
				if ( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE ) { # Home
				} elseif ( SHAPESHIFTER_IS_FRONT_PAGE ) { # Front Page

					global $post; $post_id = intval( $post->ID );

				} elseif ( SHAPESHIFTER_IS_HOME ) { # Blog

					$this->home_id = intval( get_option( 'page_for_posts' ) );
					$post_id = intval( $this->home_id );

				} elseif ( SHAPESHIFTER_IS_SINGULAR ) { # Singular

					global $post; $post_id = intval( $post->ID );

				}

				# Setup for Post Meta
					if ( isset( $post_id ) ) 
						$this->set_post_meta_vars_with_post_id( $post_id );

			}

			/**
			 * Setup for Post Meta
			 * 
			 * @param int $post_id
			**/
			function set_post_meta_vars_with_post_id( $post_id ) {

				$this->post_metas = get_post_meta( $post_id );

				// Remove Data Except "index: 0"
					if ( is_array( $this->post_metas ) ) { 
						foreach( $this->post_metas as $index => $data ) {
							$this->post_metas[ $index ] = esc_attr( 
								isset( $data[ 0 ] ) 
									&& ( $data[ 0 ] != '' ) 
								? $data[ 0 ]
								: ''
							);
						} 
					}

				// Settings for Deactivation of Widget Areas
					$deactivate_widget_area = get_post_meta( $post_id, SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area', true );
					$this->deactivate_widget_areas = ( 
						( 
							is_array( $deactivate_widget_area ) 
							&& ! empty( $deactivate_widget_area )
						)
						? $deactivate_widget_area
						: array()
					);
					unset( $deactivate_widget_area );

				# For One Column Page Width Size Check
					$GLOBALS[ 'shapeshifter_is_one_column_page_width_size_max' ] = (
						get_post_meta( $post_id, SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max', false ) !== array()
						? get_post_meta( $post_id, SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max', true )
						: $GLOBALS[ 'shapeshifter_is_one_column_page_width_size_max' ]
					);

				# Do Action at the End
					shapeshifter_frontend_after_set_post_meta_vars_with_post_id( $post_id );

			}

		/**
		 * Enqueue CSS JS
		**/
		function wp_enqueue_scripts() {

			global $post;

			// CSS
				// Style
					// Theme Mods Styles
					$style_handler = new ShapeShifter_Styles_Handler();
					$style_handler->set_styles();
					$theme_mods_styles = wp_strip_all_tags( 
						( SHAPESHIFTER_IS_MOBILE
							? $style_handler->styles['mobile']['total']
							: $style_handler->styles['pc']['total']
						),
						true
					);
					wp_add_inline_style( 'shapeshifter-style', $theme_mods_styles );
					unset( $style_handler, $theme_mods_styles );

				// style.css
					wp_enqueue_style( 'shapeshifter-style' );
					wp_enqueue_style( 'shapeshifter-animate' );

			# JS
				if ( ! SHAPESHIFTER_IS_MOBILE ) {
					wp_localize_script( 
						'shapeshifter-animate', 
						'shapeshifterCSSAnimations', 
						$GLOBALS['shapeshifter_css_animations']
					);
					wp_enqueue_script( 'shapeshifter-animate' );
				}

				$localized_data = array();

				if ( ( ! SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE ) 
					|| SHAPESHIFTER_IS_SINGULAR 
				) {
				} elseif ( SHAPESHIFTER_IS_HOME || SHAPESHIFTER_IS_ARCHIVE || SHAPESHIFTER_IS_SEARCH ) {
					$permalink_structure = get_option( 'permalink_structure', '' );
					$localized_data['structure'] = ( 
						empty( $permalink_structure )
						? 'default' 
						: 'custom'
					);
				}

				$localized_data['imageSource'] = esc_html__( 'Image Source', 'shapeshifter' );
				wp_localize_script( 
					'shapeshifter-javascripts', 
					'shapeshifterOptionPage', 
					$localized_data
				);
				wp_enqueue_script( 'shapeshifter-javascripts' );

		}

		/**
		 * WP Head
		**/
		function theme_customized_styles() { 


		}

	/**
	 * Filters
	**/
	function add_filters() {

		// Others
			// Content
			add_filter( 'the_content', array( $this, 'content_filter' ), 15 );
			// Excerpt
			add_filter( 'the_excerpt', array( $this, 'excerpt_filter' ) );
		
		// Widgets
			// Tag Clouds
			add_filter( 'wp_tag_cloud', array( $this, 'tag_cloud_filter' ), 10, 2 );
			// Categories
			add_filter( 'wp_list_categories', array( $this, 'list_categories_filter' ), 10, 2 );
			// Archives
			add_filter( 'get_archives_link', array( $this, 'archives_link_filter' ) );

		// Widget Areas
		//add_filter( 'shapeshifter_filter_mobile_sidebar', array() );

	}
	// Methods
		// Content
			/**
			 * Hooked in Filter "the_content"
			 * 
			 * @param string $the_content
			 * 
			 * @return string $the_content
			**/
			function content_filter( $content ) {

				// Insert before first H2 tag
				$content = $this->add_ads_before_1st_h2( $content );

				// IMG Tags
					// For Lightbox( Appending selector class used by JS )
					$content = preg_replace(
						'/(<a[^>]+>)(<img[^>]+\/?>)(<\/a>)/iU',
						'<div class="shapeshifter-attachment">${1}${2}${3}</div>',
						$content
					);

				// CSS Animations
				if ( ! SHAPESHIFTER_IS_MOBILE ) {
					if ( is_array( $GLOBALS[ 'shapeshifter_css_animations' ] ) ) { foreach( $GLOBALS[ 'shapeshifter_css_animations' ] as $index => $element ) {
						$content = $this->add_atts_of_css_animations_to_element_in_content( $content, $index );
					} unset( $index, $element ); }
				}

				return $content;

			}

				/**
				 * Insert before first H2 tag
				 * 
				 * @param string $the_content
				 * 
				 * @return string $the_content
				**/
				function add_ads_before_1st_h2( $the_content ) {
					
					global $shapeshifter_content_inner_width;

					$output = '';
				
					if ( SHAPESHIFTER_IS_SINGULAR || SHAPESHIFTER_IS_FRONT_PAGE ) {

						# Widget Area Before First H2
							ob_start();
							//shapeshifter_widget_areas_before_1st_h2_of_content();
							$before_1st_h2_of_content_total = ob_get_clean();

							$before_1st_h2_of_content_total = apply_filters(
								'shapeshifter_filter_before_1st_h2_of_contents',
								$before_1st_h2_of_content_total
							);

							if ( ! empty( $before_1st_h2_of_content_total ) ) {
								$output .= $before_1st_h2_of_content_total;
							} unset( $before_1st_h2_of_content_wrapper, $before_1st_h2_of_content_total );

							if( ! empty( $output ) ) {
								$h2 = '/<h2.*?>/i';
								if ( preg_match( $h2, $the_content, $h2s )) {
									$the_content  = preg_replace( $h2, $output.$h2s[ 0 ], $the_content, 1 );
								}
							}

					}

					return $the_content;

				}

				/**
				 * Append Atts for CSS Animations
				 * 
				 * @param string $content : 
				 * @param string $element :
				 * 
				 * @return string $content
				**/
				function add_atts_of_css_animations_to_element_in_content( $content, $element ) {

					// Animated Class
						// Hover
						if ( isset( $this->theme_mods[ 'singular_page_' . $element . '_animation_hover_select' ] ) 
							&& $this->theme_mods[ 'singular_page_' . $element . '_animation_hover_select' ] != 'none'
						) {

							$content = preg_replace_callback(
								'/<(' . $element . ')([^>]*)?>/ims',
								array( $this, 'get_content_element_with_hover_attr_callback' ),
								$content
							);

						} unset( $this->theme_mods[ 'singular_page_' . $element . '_animation_hover_select' ] );

						// Enter
						if ( isset( $this->theme_mods[ 'singular_page_' . $element . '_animation_enter_select' ] ) 
							&& $this->theme_mods[ 'singular_page_' . $element . '_animation_enter_select' ] != 'none'
						) {

							$content = preg_replace_callback(
								'/<(' . $element . ')([^>]*)?>/ims',
								array( $this, 'get_content_element_with_enter_attr_callback' ),
								$content
							);

						} unset( $this->theme_mods[ 'singular_page_' . $element . '_animation_enter_select' ] );

					return $content;

				}

				// Animated Class
					/**
					 * Hover
					 * 
					 * @param string $content : 
					 * @param string $element :
					 * 
					 * @return string $content
					**/
					function get_content_element_with_hover_attr_callback( $matched_element ) {

						$element = $matched_element[ 1 ];
						$element_atts = $matched_element[ 2 ];

						if ( isset( $matched_element[ 2 ] ) ) {
							$has_class = stripos( $matched_element[ 0 ], ' class=' );
						} else {
							$has_class = false;
						}

						if ( isset( $matched_element[ 2 ] ) ) {
							$has_data_hover = stripos( $matched_element[ 0 ], ' data-animation-hover' );
						} else {
							$has_data_hover = false;
						} unset( $matched_element );

						if ( $has_class === false ) {
							$element_atts = ' class="hover-animated" ' . $element_atts;
						} else {
							$element_atts = preg_replace( 
								'/(class=[\'"])([^\'"]+)([\'"])/i',
								'${1}${2} hover-animated${3}',
								$element_atts
							); $matched_class = null;
						}

						if ( $has_data_hover === false ) {
							$element_atts = ' data-animation-hover="' . esc_attr( $GLOBALS[ 'shapeshifter_css_animations' ][ $element ][ 'hover' ] ) . '" ' . $element_atts;
						}

						unset( $has_class, $has_data_hover );

						return '<' . $element . $element_atts . '>';;

					}

					/**
					 * Enter
					 * 
					 * @param string $content : 
					 * @param string $element :
					 * 
					 * @return string $content
					**/
					function get_content_element_with_enter_attr_callback( $matched_element ) {

						$element = $matched_element[ 1 ];
						$element_atts = $matched_element[ 2 ];

						if ( isset( $matched_element[ 2 ] ) ) {
							$has_class = stripos( $matched_element[ 0 ], ' class="' );
						} else {
							$has_class = false;
						}

						if ( isset( $matched_element[ 2 ] ) ) {
							$has_data_enter = stripos( $matched_element[ 0 ], ' data-animation-enter' );
						} else {
							$has_data_enter = false;
						} unset( $matched_element );


						if ( $has_class === false ) {
							$element_atts = ' class="shapeshifter-hidden enter-animated" ' . $element_atts;
						} else {
							$element_atts = preg_replace( 
								'/(class=[\'"])([^\'"]+)([\'"])/i',
								'${1}${2} shapeshifter-hidden enter-animated${3}',
								$element_atts 
							); $matched_class = null;
						} 

						if ( $has_data_enter === false ) {
							$element_atts = ' data-animation-enter="' . esc_attr( $GLOBALS[ 'shapeshifter_css_animations' ][ $element ][ 'enter' ] ) . '" ' . $element_atts;
						}

						unset( $has_class, $has_data_enter );

						return '<' . $element . $element_atts . '>';;

					}

		// Excerpt
			/**
			 * Hooked in Filter "the_excerpt"
			 * 
			 * @param string $excerpt
			 * 
			 * @return string
			**/
			function excerpt_filter( $excerpt ) {

				// Excerpt
				return $this->shapeshifter_get_the_excerpt( $excerpt );

			}

				/**
				 * Excerpt
				 * 
				 * @param string $post_content
				 * @param int $excerpt_length
				 * 
				 * @see $this->shapeshifter_get_the_excerpt( $post_content, $excerpt_length )
				 * 
				 * echo
				**/
				function shapeshifter_the_excerpt( $post_content, $excerpt_length = 200 ) { 
					echo $this->shapeshifter_get_the_excerpt( $post_content, $excerpt_length );
				}

				/**
				 * Excerpt
				 * 
				 * @param string $post_content
				 * @param int $excerpt_length
				 * 
				 * @return string
				**/
				function shapeshifter_get_the_excerpt( $post_content, $excerpt_length = 200 ) {

					$the_excerpt = preg_replace( '/\[[^\]]+]/i', '', $post_content );
					$the_excerpt = wp_strip_all_tags( $the_excerpt );
					$the_excerpt = str_replace( array( "\n", "\r", '&ensp;', '&emsp;', '&thinsp;', '"', "&nbsp;" ), '', $the_excerpt );
					$the_excerpt = mb_ereg_replace( "/[^a-zA-Z0-9]\s[^a-zA-Z0-9]/i", '', $the_excerpt );

					return mb_substr( $the_excerpt, 0, $excerpt_length );

				}

		// Other Filters
			/**
			 * Widget Tag Cloud hooked in Filter "wp_tag_cloud"
			 * 
			 * @param string $tags
			 * @param array $args
			 * 
			 * @return string $tag
			**/
			function tag_cloud_filter( $tags, $args ) {
				$tags = preg_replace( 
					'/(<a[^>]+>[^<]+<\/a>)/i',
					'<div class="shapeshifter-tag-cloud-item">${1}</div>',
					$tags
				);
				return $tags;
			}

			/**
			 * Widget Categories
			 * 
			 * @param string $tags
			 * @param array $args
			 * 
			 * @return string $tag
			**/
			function list_categories_filter( $tags, $args ) {
				return $tags;
			}

			/**
			 * Widget Archive
			 * 
			 * @param string $tags
			 * 
			 * @return string $tag
			**/
			function archives_link_filter( $tags ) {
				$tags = preg_replace(
					'/(<li[^>]*>[^<]*)(<a[^>]+>[^<]+<\/a>)([^<]*<\/li>)/i',
					'<li class="archive-list-item">${2}${3}',
					$tags
				);
				return $tags;
			}

	#
	# Generators
	#
		/**
		 * Body Inner Wrapper Start
		**/
		function shapeshifter_body_wrapper_start() {

			ob_start();

		}

		/**
		 * Body Inner Wrapper End
		**/
		function shapeshifter_body_wrapper_end() {

			$body_inner = ob_get_clean();

			echo apply_filters( 'shapeshifter_body_inner', $body_inner );

		}

		/**
		 * Print Template for index.php
		 * 
		 * @see $this->shapeshifter_get_generated_frontend_page()
		**/
		function shapeshifter_generate_frontend_page() {
			echo $this->shapeshifter_get_generated_frontend_page();
		}

		/**
		 * Get Template for index.php
		 * 
		 * @see shapeshifter_header()
		 * @see shapeshifter_main_content()
		 * @see shapeshifter_footer()
		 * 
		 * @return string
		**/
		function shapeshifter_get_generated_frontend_page() {
			
			ob_start();

				shapeshifter_header();

				shapeshifter_main_content();

				shapeshifter_footer();

			$generated_frontend_page = ob_get_clean();

			return apply_filters( 'shapeshifter_filters_generated_page', $generated_frontend_page );

		}

			/**
			 * Print Template for header.php
			 * 
			 * @see $this->shapeshifter_get_header()
			**/
			function shapeshifter_header() {
				echo $this->shapeshifter_get_header();
			}

			/**
			 * Get Template for header.php
			 * 
			 * @see shapeshifter_head()
			 * @see shapeshifter_starting_body()
			 * @see shapeshifter_content_area_start()
			 * 
			 * @return string
			**/
			function shapeshifter_get_header() {

				ob_start();

					shapeshifter_head();

					shapeshifter_starting_body();

					shapeshifter_content_area_start();

				$header = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_header', $header );

			}

				/**
				 * Print Template for HEAD tag
				 * 
				 * @see $this->shapeshifter_get_head()
				**/
				function shapeshifter_head() {
					echo $this->shapeshifter_get_head();
				}

				/**
				 * Get Template for HEAD tag
				 * 
				 * @return string
				**/
				function shapeshifter_get_head() { 

					ob_start();

					get_template_part( 'templates/head' );

					$head = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_head', $head );

				}

					/**
					 * Print Template for Starting BODY ( "header.php" - "HEAD Tag" )
					 * 
					 * @see $this->shapeshifter_get_starting_body()
					**/
					function shapeshifter_starting_body() {
						echo $this->shapeshifter_get_starting_body();
					}

					/**
					 * Get Template for Starting BODY ( "header.php" - "HEAD Tag" )
					 * 
					 * @return string
					**/
					function shapeshifter_get_starting_body() {

						ob_start();

							get_template_part( 'templates/header/starting-body' );

						$starting_body = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_starting_body', $starting_body );

					}

						/**
						 * Print Template for Body Header
						 * 
						 * @see $this->shapeshifter_get_body_header()
						**/
						function shapeshifter_body_header() {
							echo $this->shapeshifter_get_body_header();
						}

						/**
						 * Get Template for Body Header
						 * 
						 * @return string
						**/
						function shapeshifter_get_body_header() {

							ob_start();

								get_template_part( 'templates/body/body-header' );

							$body_header = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_body_header', $body_header );

						}

							/**
							 * Print Template for Header Top
							 * 
							 * @see $this->shapeshifter_get_header_top()
							**/
							function shapeshifter_header_top() {
								echo $this->shapeshifter_get_header_top();
							}

							/**
							 * Get Template for Body Header
							 * 
							 * @return string
							**/
							function shapeshifter_get_header_top() {

								ob_start();

								get_template_part( 'templates/header/header-top' );

								$header_top = ob_get_clean();

								return apply_filters( 'shapeshifter_filters_header_top', $header_top );

							}

							/**
							 * Print Template for After Header
							 * 
							 * @see $this->shapeshifter_get_after_header()
							**/
							function shapeshifter_after_header() {
								echo $this->shapeshifter_get_after_header();
							}

							/**
							 * Get Template for After Header
							 * 
							 * @see shapeshifter_widget_areas_after_header()
							 * 
							 * @return string
							**/
							function shapeshifter_get_after_header() {

								ob_start();

									shapeshifter_widget_areas_after_header();

								$after_header = ob_get_clean();

								return apply_filters( 'shapeshifter_filters_after_header', $after_header );

							}

							/**
							 * Print Template for Before Content Area
							 * 
							 * @see $this->shapeshifter_get_before_content_area()
							**/
							function shapeshifter_before_content_area() {
								echo $this->shapeshifter_get_before_content_area();
							}

							/**
							 * Get Template for Before Content Area
							 * 
							 * @see shapeshifter_widget_areas_before_content_area()
							 * 
							 * @return string
							**/
							function shapeshifter_get_before_content_area() {

								ob_start();

									shapeshifter_widget_areas_before_content_area();

								$after_nav_menu = ob_get_clean();

								return apply_filters( 'shapeshifter_filters_before_content_area', $after_nav_menu );

							}

				/**
				 * Print Template for Content Area Start
				 * 
				 * @see $this->shapeshifter_get_content_area_start()
				**/
				function shapeshifter_content_area_start() { 
					echo $this->shapeshifter_get_content_area_start();
				}

				/**
				 * Get Template for Content Area Start
				 * 
				 * @return string
				**/
				function shapeshifter_get_content_area_start() {

					ob_start();

						get_template_part( 'templates/body/content-area-start' );

					$content_area = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_content_area_start', $content_area );

				}


		/**
		 * Print Template for header.php
		 * 
		 * @see $this->shapeshifter_get_body()
		**/
		function shapeshifter_body() {
			echo $this->shapeshifter_get_body();
		}

		/**
		 * Get Template for header.php
		 * 
		 * @see shapeshifter_starting_body()
		 * @see shapeshifter_content_area_start()
		 * @see shapeshifter_main_content()
		 * @see shapeshifter_content_area_end()
		 * @see shapeshifter_footer()
		 * 
		 * @return string
		**/
		function shapeshifter_get_body() {

			ob_start();

				shapeshifter_starting_body();

				shapeshifter_content_area_start();

				shapeshifter_main_content();

				shapeshifter_content_area_end();

				shapeshifter_footer();

			$body = ob_get_clean();

			return apply_filters( 'shapeshifter_filters_body', $body );

		}

			/**
			 * Print Template for Content Area
			 * 
			 * @see $this->shapeshifter_get_content_area()
			**/
			function shapeshifter_content_area() { 
				echo $this->shapeshifter_get_content_area();
			}

			/**
			 * Get Template for Content Area
			 * 
			 * @see shapeshifter_starting_body()
			 * @see shapeshifter_content_area_start()
			 * @see shapeshifter_main_content()
			 * @see shapeshifter_content_area_end()
			 * @see shapeshifter_footer()
			 * 
			 * @return string
			**/
			function shapeshifter_get_content_area() {

				ob_start();

					get_template_part( 'templates/body/content-area' );

				$content_area = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_content_area', $content_area );

			}

				/**
				 * Print Template for Main Content
				 * 
				 * @see $this->shapeshifter_get_main_content()
				**/
				function shapeshifter_main_content() {
					echo $this->shapeshifter_get_main_content();
				}

				/**
				 * Get Template for Content Area
				 * 
				 * @return string
				**/
				function shapeshifter_get_main_content() {

					ob_start();

					get_template_part( 'templates/body/main-content' );

					$main_content = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_main_content', $main_content );

				}

					/**
					 * Print Main Content Template for Home
					 * 
					 * @see $this->shapeshifter_get_main_content_home()
					**/
					function shapeshifter_main_content_home() {
						echo $this->shapeshifter_get_main_content_home();
					}

					/**
					 * Get Main Content Template for Home
					 * 
					 * @see $this->shapeshifter_main_content_archive_page()
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_home() {

						return $this->shapeshifter_main_content_archive_page();

					}

					/**
					 * Print Main Content Template for Front Page
					 * 
					 * @see $this->shapeshifter_get_main_content_front_page()
					**/
					function shapeshifter_main_content_front_page() {
						echo $this->shapeshifter_get_main_content_front_page();
					}

					/**
					 * Get Main Content Template for Front Page
					 * 
					 * @see $this->shapeshifter_get_main_content_singular_page()
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_front_page() {

						return $this->shapeshifter_get_main_content_singular_page();

					}

					/**
					 * Print Main Content Template for Blog Page
					 * 
					 * @see $this->shapeshifter_get_main_content_blog_page()
					**/
					function shapeshifter_main_content_blog_page() {
						echo $this->shapeshifter_get_main_content_blog_page();
					}

					/**
					 * Get Main Content Template for Blog Page
					 * 
					 * @see $this->shapeshifter_get_main_content_archive_page()
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_blog_page() {

						return $this->shapeshifter_get_main_content_archive_page();

					}

					/**
					 * Print Main Content Template for Archive Page
					 * 
					 * @see $this->shapeshifter_get_main_content_archive_page()
					**/
					function shapeshifter_main_content_archive_page() {
						echo $this->shapeshifter_get_main_content_archive_page();
					}

					/**
					 * Get Main Content Template for Archive Page
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_archive_page() { 

						ob_start();

							get_template_part( 'templates/archive/main-content-archive-page' );
						
						$main_content_archive_page = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_archive_page', $main_content_archive_page );

					}

						/**
						 * Print Title Template for Archive Page
						 * 
						 * @see $this->shapeshifter_get_post_list_item()
						**/
						function shapeshifter_archive_page_title( $post ) {
							echo $this->shapeshifter_get_archive_page_title( $post );
						}

						/**
						 * Get Title Template for Archive Page
						 * 
						 * @return string
						**/
						function shapeshifter_get_archive_page_title( $post ) { 

							ob_start();

							get_template_part( 'templates/archive/main-content-archive-page-title' );

							$list_item = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_archive_page_title', $list_item );

						}

						/**
						 * Print List Item Template for Archive Page
						 * 
						 * @see $this->shapeshifter_get_post_list_item()
						**/
						function shapeshifter_post_list_item( $post ) {
							echo $this->shapeshifter_get_post_list_item( $post );
						}

						/**
						 * Get List Item Template for Archive Page
						 * 
						 * @return string
						**/
						function shapeshifter_get_post_list_item( $post ) { 

							ob_start();

							get_template_part( 'templates/archive/post-list-item' );

							$list_item = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_post_list_item', $list_item );

						}

						/**
						 * Print Pagination Template for Archive Page
						 * 
						 * @see $this->shapeshifter_get_pagination()
						**/
						function shapeshifter_pagination() {
							echo $this->shapeshifter_get_pagination();
						}

						/**
						 * Get Pagination Template for Archive Page
						 * 
						 * @return string
						**/
						function shapeshifter_get_pagination( $args = array() ) {

							if ( ! SHAPESHIFTER_IS_MOBILE ) {

								global $wp_query;
								$total = ( 
									isset( $wp_query->max_num_pages ) 
										&& $wp_query->max_num_pages > 1 
									? $wp_query->max_num_pages
									: 1 
								);

								$current = ( 
									get_query_var( 'paged' ) 
									? get_query_var( 'paged' ) 
									: 1
								);

								$default_args = array(
									'end_size'		   => 3,
									'mid_size'		   => 3,
									'prev_text'		  => esc_html__( '&laquo; Previous', 'shapeshifter' ),
									'next_text'		  => esc_html__( 'Next &raquo;', 'shapeshifter' ),
								);
								$args = wp_parse_args( $args, $default_args );

								return apply_filters( 'shapeshifter_filters_pagination_pc', sprintf( '<div class="pagination"><span>' . esc_html__( 'Page: %1$d of %2$d', 'shapeshifter' ) . '</span>%3$s</div>', absint( $current ), absint( $total ), paginate_links( $args ) ) );

							} else {

								$prev = get_previous_posts_link( esc_html__( 'To Prev', 'shapeshifter' ) );
								$next = get_next_posts_link( esc_html__( 'To Next', 'shapeshifter' ) );

								return apply_filters( 'shapeshifter_filters_pagination_mobile',
									'<div class="pagination-mobile">' . ( 
										$prev 
										? '<div class="prev-posts-link-mobile">' . $prev . '</div>' 
										: '' 
									) . ( 
										$next 
										? '<div class="next-posts-link-mobile">' . $next . '</div>' 
										: '' 
									) . '</div>' 
								);

							}

						}

					/**
					 * Print Main Content Template for Singular Page
					 * 
					 * @see $this->shapeshifter_get_main_content_singular_page()
					**/
					function shapeshifter_main_content_singular_page() {
						echo $this->shapeshifter_get_main_content_singular_page();
					}

					/**
					 * Get Main Content Template for Singular Page
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_singular_page() {

						ob_start();

							get_template_part( 'templates/singular/singular-page' );

						$singular_page = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_singular_page', $singular_page );

					}

						/**
						 * Print Breadcrumb Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @see $this->shapeshifter_get_breadcrumb()
						**/
						function shapeshifter_breadcrumb( $post ) {
							echo $this->shapeshifter_get_breadcrumb( $post );
						}

						/**
						 * Get Breadcrumb Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @return string
						**/
						function shapeshifter_get_breadcrumb( $post ) {

							ob_start();

								get_template_part( 'templates/singular/breadcrumb' );

							$str = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_breadcrumb', $str );

						}

						/**
						 * Print Header Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @see $this->shapeshifter_get_main_content_singular_header()
						**/
						function shapeshifter_main_content_singular_page_header( $post ) {
							echo $this->shapeshifter_get_main_content_singular_header( $post );
						}

						/**
						 * Get Header Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @return string
						**/
						function shapeshifter_get_main_content_singular_header( $post ) {

							ob_start();

								get_template_part( 'templates/singular/header' );

							$singular_header = ob_get_clean();
							
							return apply_filters( 'shapeshifter_filters_singular_header', $singular_header );

						}

						/**
						 * Print Content Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @see $this->shapeshifter_get_main_content_singular_page_content()
						**/
						function shapeshifter_main_content_singular_page_content( $post ) { 
							echo $this->shapeshifter_get_main_content_singular_page_content( $post );
						}

						/**
						 * Get Content Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @return string
						**/
						function shapeshifter_get_main_content_singular_page_content( $post ) {  

							ob_start();

								get_template_part( 'templates/singular/page-content' );

							$singular_page_content = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_singular_content', $singular_page_content );

						}

						/**
						 * Print Link Pages Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @see $this->shapeshifter_get_main_content_singular_page_link_pages()
						**/
						function shapeshifter_main_content_singular_page_link_pages( $post ) {
							echo $this->shapeshifter_get_main_content_singular_page_link_pages( $post );
						}

						/**
						 * Get Link Pages Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @return string
						**/
						function shapeshifter_get_main_content_singular_page_link_pages( $post ) {

							ob_start();

								get_template_part( 'templates/singular/link-pages' );

							$link_pages = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_singular_link_pages', $link_pages );

						}

						/**
						 * Print Footer Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @see $this->shapeshifter_get_main_content_singular_page_footer()
						**/
						function shapeshifter_main_content_singular_page_footer( $post ) {
							echo $this->shapeshifter_get_main_content_singular_page_footer( $post );
						}

						/**
						 * Get Footer Template for Singular Page
						 * 
						 * @param WP_Post $post
						 * 
						 * @return string
						**/
						function shapeshifter_get_main_content_singular_page_footer( $post ) {

							ob_start();

								get_template_part( 'templates/singular/footer' );

							$footer = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_singular_footer', $footer );

						}

							/**
							 * Print Prev Next Template for Singular Page
							 * 
							 * @param WP_Post $post
							 * 
							 * @see $this->shapeshifter_get_main_content_singular_page_prev_next()
							**/
							function shapeshifter_main_content_singular_page_prev_next( $post ) { 
								echo $this->shapeshifter_get_main_content_singular_page_prev_next( $post );
							}

							/**
							 * Get Prev Next Template for Singular Page
							 * 
							 * @param WP_Post $post
							 * 
							 * @return string
							**/
							function shapeshifter_get_main_content_singular_page_prev_next( $post ) { 

								ob_start();

									get_template_part( 'templates/singular/prev-next' );

								$prev_next = ob_get_clean();

								return apply_filters( 'shapeshifter_filters_singular_prev_next', $prev_next );

							}

					/**
					 * Print Main Content Template for bbPress
					 * 
					 * @see $this->shapeshifter_get_main_content_bbpress_page()
					**/
					function shapeshifter_main_content_bbpress_page() {
						echo $this->shapeshifter_get_main_content_bbpress_page();
					}

					/**
					 * Get Main Content Template for bbPress
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_bbpress_page() {

						ob_start();

							get_template_part( 'templates/bbpress/bbpress-page' );

						$bbpress_page = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_bbpress_page', $bbpress_page );

					}

					/**
					 * Print Main Content Template for WooCommerce
					 * 
					 * @see $this->shapeshifter_get_main_content_woocommerce_page()
					**/
					function shapeshifter_main_content_woocommerce_page() {
						echo $this->shapeshifter_get_main_content_woocommerce_page();
					}

					/**
					 * Get Main Content Template for WooCommerce
					 * 
					 * @return string
					**/
					function shapeshifter_get_main_content_woocommerce_page() {

						ob_start();

						get_template_part( 'templates/woocommerce/woocommerce-page' );

						$wc_page = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_wc_page', $wc_page );

					}

						/**
						 * Print Shop Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_wc_shop()
						**/
						function shapeshifter_wc_shop() {
							echo $this->shapeshifter_get_wc_shop();
						}

						/**
						 * Get Shop Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_wc_shop() {

							ob_start();

								get_template_part( 'templates/woocommerce/wc-shop' );

							$wc_shop = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_shop', $wc_shop );

						}

						/**
						 * Print Taxonomy Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_product_taxonomy()
						**/
						function shapeshifter_woocommerce_product_taxonomy() { 
							echo $this->shapeshifter_get_woocommerce_product_taxonomy();
						}

						/**
						 * Get Taxonomy Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_product_taxonomy() { 

							ob_start();

								get_template_part( 'templates/woocommerce/wc-product-taxonomy' );

							$wc_product_taxonomy = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_product_taxonomy', $wc_product_taxonomy );

						}

						/**
						 * Print Taxonomy Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_shop_product_archive()
						**/
						function shapeshifter_woocommerce_shop_product_archive() { 
							echo $this->shapeshifter_get_woocommerce_shop_product_archive();
						}

						/**
						 * Get Taxonomy Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_shop_product_archive() { 

							ob_start();

								get_template_part( 'templates/woocommerce/wc-shop-product-archive' );

							$wc_shop_product_archive = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_shop_product_archive', $wc_shop_product_archive );

						}

						/**
						 * Print Single Product Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_single_product()
						**/
						function shapeshifter_woocommerce_single_product() {
							echo $this->shapeshifter_get_woocommerce_single_product();
						}

						/**
						 * Get Single Product Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_single_product() { 

							ob_start();

							get_template_part( 'templates/woocommerce/wc-single-product' );

							$wc_single_product = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_single_product', $wc_single_product );

						}

						/**
						 * Print Cart Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_cart()
						**/
						function shapeshifter_woocommerce_cart() { 
							echo $this->shapeshifter_get_woocommerce_cart();
						}

						/**
						 * Get Cart Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_cart() { 

							ob_start();

							get_template_part( 'templates/woocommerce/wc-cart' );

							$wc_cart = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_cart', $wc_cart );

						}

						/**
						 * Print Checkout Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_checkout()
						**/
						function shapeshifter_woocommerce_checkout() {
							echo $this->shapeshifter_get_woocommerce_checkout();
						}

						/**
						 * Get Checkout Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_checkout() {

							ob_start();

							get_template_part( 'templates/woocommerce/wc-checkout' );

							$wc_checkout = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_checkout', $wc_checkout );

						}

						/**
						 * Print Account Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_account_page()
						**/
						function shapeshifter_woocommerce_account_page() { 
							echo $this->shapeshifter_get_woocommerce_account_page();
						}

						/**
						 * Get Account Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_account_page() { 

							ob_start();

							get_template_part( 'templates/woocommerce/wc-account-page' );

							$wc_account_page = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_account_page', $wc_account_page );

						}

						/**
						 * Print Endpoint URL Template for WooCommerce Main Content
						 * 
						 * @see $this->shapeshifter_get_woocommerce_endpoint_url()
						**/
						function shapeshifter_woocommerce_endpoint_url() { 
							echo $this->shapeshifter_get_woocommerce_endpoint_url();
						}

						/**
						 * Get Endpoint URL Template for WooCommerce Main Content
						 * 
						 * @return string
						**/
						function shapeshifter_get_woocommerce_endpoint_url() { 

							ob_start();

							get_template_part( 'templates/woocommerce/wc-endpoint-url' );

							$wc_endpoint_url = ob_get_clean();

							return apply_filters( 'shapeshifter_filters_wc_endpoint_url', $wc_endpoint_url );

						}

							/**
							 * Print Header Template for WooCommerce Main Content
							 * 
							 * @see $this->shapeshifter_get_wc_header()
							**/
							function shapeshifter_wc_header( $post ) {
								echo $this->shapeshifter_get_wc_header( $post );
							}

							/**
							 * Get Header Template for WooCommerce Main Content
							 * 
							 * @return string
							**/
							function shapeshifter_get_wc_header( $post ) {

								ob_start();

								get_template_part( 'templates/woocommerce/wc-header' );

								$wc_header = ob_get_clean();

								return apply_filters( 'shapeshifter_filters_wc_header', $wc_header );
							}

				/**
				 * Print Template for Before Content
				 * 
				 * @see $this->shapeshifter_get_before_content()
				**/
				function shapeshifter_before_content() {
					echo $this->shapeshifter_get_before_content();
				}

				/**
				 * Get Template for Before Content
				 * 
				 * @see shapeshifter_widget_areas_before_content()
				 * 
				 * @return string
				**/
				function shapeshifter_get_before_content() {

					ob_start();

						shapeshifter_widget_areas_before_content();

					$before_content = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_before_content', $before_content );

				}

				/**
				 * Print Template for After Content
				 * 
				 * @see $this->shapeshifter_get_after_content()
				**/
				function shapeshifter_after_content() {
					echo $this->shapeshifter_get_after_content();
				}

				/**
				 * Get Template for After Content
				 * 
				 * @see shapeshifter_widget_areas_after_content()
				 * 
				 * @return string
				**/
				function shapeshifter_get_after_content() {

					ob_start();

						shapeshifter_widget_areas_after_content();

					$after_content = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_after_content', $after_content );

				}

			#
			# Nav Menus
			#
				/**
				 * Get Walk Nav Menu Object, which can be filtered
				 * 
				 * @param string $theme_location
				 * 
				 * @see $this->shapeshifter_get_after_content()
				 * 
				 * @return Walker_Nav_Menu : Changeable into ShapeShifter_Walker_Nav_Menu by Plugin "WP Theme ShapeShifter Extensions" 
				**/
				function shapeshifter_get_walker_nav_menu_instance( $theme_location ) {

					return apply_filters( 'shapeshifter_filters_walker_nav_menu_instance', new Walker_Nav_Menu(), $theme_location );

				}

				/**
				 * Print Header Nav Menu Template
				 * 
				 * @see $this->shapeshifter_get_header_nav_menu()
				**/
				function shapeshifter_header_nav_menu() {
					echo $this->shapeshifter_get_header_nav_menu();
				}

				/**
				 * Get Header Nav Menu Template
				 * 
				 * @global int $shapeshifter_content_width
				 * 
				 * @see $this->shapeshifter_get_walker_nav_menu_instance( $theme_location )
				 * 
				 * @return string
				**/
				function shapeshifter_get_header_nav_menu() {

					/**
					 * @global int
					**/
					global $shapeshifter_content_width;

					$top_nav_menu_args = array( 
						'container_class' => 'shapeshifter-top-nav-div',
						'menu_class' => 'shapeshifter-top-nav-menu' . esc_attr( ! SHAPESHIFTER_IS_MOBILE ? ' shapeshifter-max-width-' . absint( $shapeshifter_content_width ) : '' ),
						'theme_location' => 'top_nav',
						'depth' => 3,
						'echo' => false, 
						'fallback_cb' => false,
						'walker' => $this->shapeshifter_get_walker_nav_menu_instance( 'top_nav' )
					);

					return apply_filters( 'shapeshifter_filters_header_nav_menu', wp_nav_menu( $top_nav_menu_args ) );

				}

				/**
				 * Print Template for Nav Menu before Content Area
				 * 
				 * @see $this->shapeshifter_get_nav_menu()
				**/
				function shapeshifter_nav_menu() {
					echo $this->shapeshifter_get_nav_menu();
				}

				/**
				 * Get Template for Nav Menu before Content Area
				 * 
				 * @return string
				**/
				function shapeshifter_get_nav_menu() {

					ob_start();

					get_template_part( 'templates/nav-menus/nav-menu' );

					$nav_menu = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_header_nav', $nav_menu );

				}

				/**
				 * Print Template for Footer Nav Menu
				 * 
				 * @see $this->shapeshifter_get_footer_nav_menu()
				**/
				function shapeshifter_footer_nav_menu() {
					echo $this->shapeshifter_get_footer_nav_menu();
				}

				/**
				 * Get Template for Footer Nav Menu
				 * 
				 * @see $this->shapeshifter_get_walker_nav_menu_instance( $theme_location );
				 * 
				 * @return string
				**/
				function shapeshifter_get_footer_nav_menu() {

					$footer_nav_menu_args = array( 
						'container_class' => 'shapeshifter-footer-nav-div',
						'menu_class' => 'shapeshifter-footer-nav-menu',
						'theme_location' => 'footer_nav',
						'fallback_cb' => false,
						'depth' => 1,
						'echo' => false,
						'walker' => $this->shapeshifter_get_walker_nav_menu_instance( 'footer_nav' ),
					);

					return apply_filters( 'shapeshifter_filters_footer_nav', wp_nav_menu( $footer_nav_menu_args ) );

				}

				# Mobile Nav Menu

			#
			# Widget Areas
			#
				/**
				 * Print Template for Standard Widget Areas
				 * 
				 * @param string $id
				 * @param string $class
				 * @param string $wrapper_start
				 * @param string $wrapper_end
				 * 
				 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
				**/
				function shapeshifter_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end ) {
					echo $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end );
				}

				/**
				 * Get Template for Standard Widget Areas
				 * 
				 * @param string $id
				 * @param string $class
				 * @param string $wrapper_start
				 * @param string $wrapper_end
				 * 
				 * @see shapeshifter_post_meta_outputs_in_widget_area_hook( $widget_area_id )
				 * @see $this->shapeshifter_get_filtered_standard_widget_area_by_hook( $widget_area, $class )
				 * 
				 * @return string
				**/
				function shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end ) {

					global $wp_registered_sidebars;

					ob_start();

						echo $wrapper_start;

							// Outputs by Post Meta Setting of Plugin
							shapeshifter_post_meta_outputs_in_widget_area_hook( $wp_registered_sidebars[ $id ] );

							// Check Active or not
							if ( in_array( $id, $this->deactivate_widget_areas ) ) {
							} else {
								if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( $id ) ) {}
							}

						echo $wrapper_end;

					$html = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_each_standard_widget_area', $this->shapeshifter_get_filtered_standard_widget_area_by_hook( $html, $class ) );

				}

					/**
					 * Print Template of Filtered Standard Widget Area
					 * 
					 * @param string $html
					 * @param string $class
					 * 
					 * @see $this->shapeshifter_get_filtered_standard_widget_area_by_hook( $html, $class )
					**/
					function shapeshifter_filtered_standard_widget_area_by_hook( $html, $class ) {
						echo $this->shapeshifter_get_filtered_standard_widget_area_by_hook( $html, $class );
					}

					/**
					 * Get Template of Filtered Standard Widget Area
					 * 
					 * @param string $html
					 * @param string $class
					 * 
					 * @return string
					**/
					function shapeshifter_get_filtered_standard_widget_area_by_hook( $html, $class ) {

						preg_match( 
							sprintf( '/<ul\sclass="widget-area-%s-ul[^>]+>(.+)<\/ul>/ims', $class ),
							$html, 
							$matched_html 
						);

						if ( ! empty( $matched_html[ 1 ] ) ) {
							
							return $html;

						}

						return '';

					}

					/**
					 * Print Template of Standard Widget Area Slidebar Left
					 * 
					 * @see $this->shapeshifter_get_slidebar_left()
					**/
					function shapeshifter_slidebar_left() {
						echo $this->shapeshifter_get_slidebar_left();
					}

					/**
					 * Get Template of Standard Widget Area Slidebar Left
					 * 
					 * @param string $html
					 * @param string $class
					 * 
					 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
					 * 
					 * @return string
					**/
					function shapeshifter_get_slidebar_left() {

						$animate_class = '';
						$animation_type = '';
						if( $this->theme_mods['slidebar_left_area_animation_enter'] !== 'none' ) {
							$animate_class = ' shapeshifter-hidden enter-animated';
							$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['slidebar_left_area_animation_enter'] ) . '"';
						}

						return apply_filters( 'shapeshifter_filters_widget_area_slidebar_left', $this->shapeshifter_get_standard_widget_area_by_hook( 
							'slidebar_left',
							'slidebar-left',
							'<aside class="slidebar-left-container slidebar-left-container-slide-box"><div class="widget-area-slidebar-left widget-area-slidebar-left-slide-box shapeshifter-widget-area-wrapper' . esc_attr( $animate_class ) . '"' . $animation_type . '><ul class="widget-area-slidebar-left-ul widget-area-slidebar-left-ul-slide-box">',
							'</ul></div></aside><a class="slidebar-left-container-trigger fa fa-angle-double-right" href="javascript: void( 0 );"></a>'
						) );

					}

					/**
					 * Print Template of Standard Widget Area Sidebar Left Container
					 * 
					 * @param bool $is_check : Default false
					 * 
					 * @see $this->shapeshifter_get_standard_sidebar_left_container( $is_check )
					**/
					function shapeshifter_standard_sidebar_left_container( $is_check = false ) {
						echo $this->shapeshifter_get_standard_sidebar_left_container( $is_check );
					}

					/**
					 * Get Template of Standard Widget Area Sidebar Left Container
					 * 
					 * @param bool $is_check : Default false
					 * 
					 * @see $this->shapeshifter_sidebar_left()
					 * @see $this->shapeshifter_sidebar_left_fixed()
					 * 
					 * @return string
					**/
					function shapeshifter_get_standard_sidebar_left_container( $is_check = false ) {

						if ( SHAPESHIFTER_IS_MOBILE ) return false;
						
						$sidebar_left_container_total = '';

						ob_start();
						
							echo '<aside class="sidebar-left-container sidebar-left-container-standard">';

								// Get Widget Areas
									ob_start();
										$this->shapeshifter_sidebar_left();
										$this->shapeshifter_sidebar_left_fixed();
									$widget_areas = ob_get_clean();

								// Check
									if( empty( $widget_areas ) ) {

										$widget_area_wrapper = ob_get_clean();
										return false;

									}

								// If $is_check is true
									if( $is_check ) {

										$widget_area_wrapper = ob_get_clean();
										return true;

									}

								// If Exists
									echo $widget_areas;

							echo '</aside>';

						$sidebar_left_container = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_widget_area_sidebar_left_container', $sidebar_left_container );

					}

						/**
						 * Print Template of Standard Widget Area Sidebar Left
						 * 
						 * @see $this->shapeshifter_get_sidebar_left()
						**/
						function shapeshifter_sidebar_left() {
							echo $this->shapeshifter_get_sidebar_left();
						}

						/**
						 * Get Template of Standard Widget Area Sidebar Left
						 * 
						 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
						 * 
						 * @return string
						**/
						function shapeshifter_get_sidebar_left() {

							$animate_class = '';
							$animation_type = '';
							if( $this->theme_mods['sidebar_left_area_animation_enter'] !== 'none' ) {
								$animate_class = ' shapeshifter-hidden enter-animated';
								$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['sidebar_left_area_animation_enter'] ) . '"';
							}

							return apply_filters( 'shapeshifter_filters_widget_area_sidebar_left', $this->shapeshifter_get_standard_widget_area_by_hook( 
								'sidebar_left',
								'sidebar-left',
								'<div class="widget-area-sidebar-left widget-area-sidebar-left-standard shapeshifter-widget-area-wrapper' . esc_attr( $animate_class ) . '"' . $animation_type . '><ul class="widget-area-sidebar-left-ul widget-area-sidebar-left-ul-standard">',
								'</ul></div>'
							) );

						}

						/**
						 * Print Template of Standard Widget Area Sidebar Left Fixed
						 * 
						 * @see $this->shapeshifter_get_sidebar_left_fixed()
						**/
						function shapeshifter_sidebar_left_fixed() {
							echo $this->shapeshifter_get_sidebar_left_fixed();
						}

						/**
						 * Get Template of Standard Widget Area Sidebar Left Fixed
						 * 
						 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
						 * 
						 * @return string
						**/
						function shapeshifter_get_sidebar_left_fixed() {

							$animate_class = '';
							$animation_type = '';
							if( $this->theme_mods['sidebar_left_fixed_area_animation_enter'] !== 'none' ) {
								$animate_class = ' shapeshifter-hidden enter-animated';
								$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['sidebar_left_fixed_area_animation_enter'] ) . '"';
							}

							return apply_filters( 'shapeshifter_filters_widget_area_sidebar_left_fixed', $this->shapeshifter_get_standard_widget_area_by_hook( 
								'sidebar_left_fixed',
								'sidebar-left-fixed',
								'<div class="widget-area-sidebar-left-fixed widget-area-sidebar-left-fixed-standard shapeshifter-widget-area-wrapper' . esc_attr( $animate_class ) . '"' . $animation_type . '><ul class="widget-area-sidebar-left-fixed-ul widget-area-sidebar-left-fixed-ul-standard">',
								'</ul></div>'
							) );

						}

					/**
					 * Print Template of Standard Widget Area Slidebar Right
					 * 
					 * @see $this->shapeshifter_get_slidebar_left()
					**/
					function shapeshifter_slidebar_right() {
						echo $this->shapeshifter_get_slidebar_right();
					}

					/**
					 * Get Template of Standard Widget Area Slidebar Right
					 * 
					 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
					 * 
					 * @return string
					**/
					function shapeshifter_get_slidebar_right() {

						$animate_class = '';
						$animation_type = '';
						if( $this->theme_mods['slidebar_right_area_animation_enter'] !== 'none' ) {
							$animate_class = ' shapeshifter-hidden enter-animated';
							$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['slidebar_right_area_animation_enter'] ) . '"';
						}

						return apply_filters( 'shapeshifter_filters_widget_area_slidebar_right', $this->shapeshifter_get_standard_widget_area_by_hook( 
							'slidebar_right',
							'slidebar-right',
							'<aside class="slidebar-right-container slidebar-right-container-slide-box"><div class="widget-area-slidebar-right widget-area-slidebar-right-slide-box shapeshifter-widget-area-wrapper' . $animate_class . '"' . $animation_type . '><ul class="widget-area-slidebar-right-ul widget-area-slidebar-right-ul-slide-box">',
							'</ul></div></aside><a class="slidebar-right-container-trigger fa fa-angle-double-left" href="javascript: void( 0 );"></a>'
						) );

					}

					/**
					 * Print Template of Standard Widget Area Sidebar Right Container
					 * 
					 * @param bool $is_check : Default false
					 * 
					 * @see $this->shapeshifter_get_standard_sidebar_right_container( $is_check )
					**/
					function shapeshifter_standard_sidebar_right_container( $is_check = false ) {
						echo $this->shapeshifter_get_standard_sidebar_right_container( $is_check );
					}

					/**
					 * Get Template of Standard Widget Area Sidebar Left Container
					 * 
					 * @param bool $is_check : Default false
					 * 
					 * @see $this->shapeshifter_sidebar_right()
					 * @see $this->shapeshifter_sidebar_right_fixed()
					 * 
					 * @return string
					**/
					function shapeshifter_get_standard_sidebar_right_container( $is_check = false ) {

						if ( SHAPESHIFTER_IS_MOBILE ) return false;

						$sidebar_right_container_total = '';

						ob_start();
						
							echo '<aside class="sidebar-right-container sidebar-right-container-standard">';

								// Get Widget Areas
									ob_start();
										$this->shapeshifter_sidebar_right();
										$this->shapeshifter_sidebar_right_fixed();
									$widget_areas = ob_get_clean();

								// Check
									if( empty( $widget_areas ) ) {

										$widget_area_wrapper = ob_get_clean();
										return false;

									}

								// If $is_check is true
									if( $is_check ) {

										$widget_area_wrapper = ob_get_clean();
										return true;

									}

								// If Exists
									echo $widget_areas;

							echo '</aside>';

						$sidebar_right_container = ob_get_clean();

						return apply_filters( 'shapeshifter_filters_widget_area_sidebar_right_container', $sidebar_right_container );

					}

						/**
						 * Print Template of Standard Widget Area Sidebar Right
						 * 
						 * @see $this->shapeshifter_get_sidebar_right()
						**/
						function shapeshifter_sidebar_right() {
							echo $this->shapeshifter_get_sidebar_right();
						}

						/**
						 * Get Template of Standard Widget Area Sidebar Right
						 * 
						 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
						 * 
						 * @return string
						**/
						function shapeshifter_get_sidebar_right() {

							$animate_class = '';
							$animation_type = '';
							if( $this->theme_mods['sidebar_right_area_animation_enter'] !== 'none' ) {
								$animate_class = ' shapeshifter-hidden enter-animated';
								$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['sidebar_right_area_animation_enter'] ) . '"';
							}

							return apply_filters( 'shapeshifter_filters_widget_area_sidebar_right', $this->shapeshifter_get_standard_widget_area_by_hook( 
								'sidebar_right',
								'sidebar-right',
								'<div class="widget-area-sidebar-right widget-area-sidebar-right-standard shapeshifter-widget-area-wrapper' . $animate_class . '"' . $animation_type . '>
									<ul class="widget-area-sidebar-right-ul widget-area-sidebar-right-ul-standard">',
									'</ul>
								</div>'
							) );

						}

						/**
						 * Print Template of Standard Widget Area Sidebar Right Fixed
						 * 
						 * @see $this->shapeshifter_get_sidebar_right_fixed()
						**/
						function shapeshifter_sidebar_right_fixed() {
							echo $this->shapeshifter_get_sidebar_right_fixed();
						}

						/**
						 * Get Template of Standard Widget Area Sidebar Right Fixed
						 * 
						 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
						 * 
						 * @return string
						**/
						function shapeshifter_get_sidebar_right_fixed() {

							$animate_class = '';
							$animation_type = '';
							if( $this->theme_mods['sidebar_right_fixed_area_animation_enter'] !== 'none' ) {
								$animate_class = ' shapeshifter-hidden enter-animated';
								$animation_type = ' data-animation-enter="' . esc_attr( $this->theme_mods['sidebar_right_fixed_area_animation_enter'] ) . '"';
							}

							return apply_filters( 'shapeshifter_filters_widget_area_sidebar_right_fixed', $this->shapeshifter_get_standard_widget_area_by_hook( 
								'sidebar_right_fixed',
								'sidebar-right-fixed',
								'<div class="widget-area-sidebar-right-fixed widget-area-sidebar-right-fixed-standard shapeshifter-widget-area-wrapper' . $animate_class . '"' . $animation_type . '><ul class="widget-area-sidebar-right-fixed-ul widget-area-sidebar-right-fixed-ul-standard">',
								'</ul></div>'
							) );

						}

					/**
					 * Print Template of Mobile Wdidget Area Right Side
					 * 
					 * @see $this->shapeshifter_get_widget_areas_mobile_menu()
					**/
					function shapeshifter_widget_areas_mobile_menu() {
						echo $this->shapeshifter_get_widget_areas_mobile_menu();
					}

					/**
					 * Get Template of Mobile Wdidget Area Right Side
					 * 
					 * @see $this->shapeshifter_get_standard_widget_area_by_hook( $id, $class, $wrapper_start, $wrapper_end )
					 * 
					 * @return string
					**/
					function shapeshifter_get_widget_areas_mobile_menu() {

						return apply_filters( 'shapeshifter_filters_widget_area_mobile_sidebar', $this->shapeshifter_get_standard_widget_area_by_hook( 
							'mobile_sidebar',
							'mobile-sidebar',
							'<div class="widget-area-mobile-sidebar shapeshifter-widget-area-wrapper"><ul class="widget-area-mobile-sidebar-ul">',
							'</ul></div>'
						) );

					}

		/**
		 * Print Template for footer.php
		 * 
		 * @see $this->shapeshifter_get_footer()
		**/
		function shapeshifter_footer() {
			echo $this->shapeshifter_get_footer();
		}

		/**
		 * Get Template for footer.php
		 * 
		 * @return string
		**/
		function shapeshifter_get_footer() {

			ob_start();

				get_template_part( 'templates/footer/body-footer' );

			$footer = ob_get_clean();

			return apply_filters( 'shapeshifter_filters_footer', $footer );

		}

			/**
			 * Print Template for Content Area End
			 * 
			 * @see $this->shapeshifter_get_content_area_end()
			**/
			function shapeshifter_content_area_end() { 
				echo $this->shapeshifter_get_content_area_end();
			}

			/**
			 * Get Template for Content Area End
			 * 
			 * @return string
			**/
			function shapeshifter_get_content_area_end() {

				ob_start();

					get_template_part( 'templates/body/content-area-end' );

				$content_area = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_content_area', $content_area );

			}

			/**
			 * Print Template for Footer Section
			 * 
			 * @see $this->shapeshifter_get_footer_section()
			**/
			function shapeshifter_footer_section() {
				echo $this->shapeshifter_get_footer_section();
			}

			/**
			 * Get Template for Footer Section
			 * 
			 * @return string
			**/
			function shapeshifter_get_footer_section() {

				ob_start();

					get_template_part( 'templates/footer/footer-section' );

				$footer_section = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_footer_section', $footer_section );

			}

				/**
				 * Print Template for Before Footer
				 * 
				 * @see $this->shapeshifter_get_before_footer()
				**/
				function shapeshifter_before_footer() {
					echo $this->shapeshifter_get_before_footer();
				}

				/**
				 * Get Template for Before Footer
				 * 
				 * @see shapeshifter_widget_areas_before_footer()
				 * 
				 * @return string
				**/
				function shapeshifter_get_before_footer() {

					ob_start();

						shapeshifter_widget_areas_before_footer();

					$before_footer = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_before_footer', $before_footer );

				}

				/**
				 * Print Template for Footer Last
				 * 
				 * @see $this->shapeshifter_get_footer_last()
				**/
				function shapeshifter_footer_last() {
					echo $this->shapeshifter_get_footer_last();
				}

				/**
				 * Get Template for Footer Last
				 * 
				 * @return string
				**/
				function shapeshifter_get_footer_last() {

					ob_start();

						get_template_part( 'templates/footer/footer-last' );

					$footer_last = ob_get_clean();

					return apply_filters( 'shapeshifter_filters_footer_last', $footer_last );

				}

				/**
				 * Print Template for License Display in Footer
				 * 
				 * @see $this->shapeshifter_get_footer_license_type()
				**/
				function shapeshifter_footer_license_type() {
					echo $this->shapeshifter_get_footer_license_type();
				}

				/**
				 * Get Template for License Display in Footer
				 * 
				 * @return string
				**/
				function shapeshifter_get_footer_license_type() {

					$type = $this->theme_mods[ 'footer_display_credit_type' ];
					$year = absint( $this->theme_mods[ 'footer_copyright_year' ] );

					if ( $type == 'none' ) {
						$type = null;
						$return = '';
					} elseif ( $type == 'all' ) {
						$type = null;
						$return = sprintf( __( 'Copyright &copy; <span id="copyright-year">%1$d</span> %2$s All Rights Reserved.', 'shapeshifter' ), $year, esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by-sa' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-SA %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by-nd' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-ND %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by-nc' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by-nc-sa' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC-SA %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc-by-nc-nd' ) {
						$type = null;
						$return = sprintf( __( 'CC-BY-NC-ND %s Some Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'cc0' ) {
						$type = null;
						$return = sprintf( __( 'CC0 %s No Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					} elseif ( $type == 'public' ) {
						$type = null;
						$return = sprintf( __( 'Public Domain %s No Rights Reserved.', 'shapeshifter' ), esc_html( SHAPESHIFTER_SITE_NAME ) );
					}

					return apply_filters( 'shapeshifter_filters_footer_license_type', $return, $type, $year );

				}

			/**
			 * Print Template for Mobile Menu Buttons Hooked in Action "wp_footer"
			 * 
			 * @see $this->shapeshifter_get_footer_menu_for_mobile()
			**/
			function shapeshifter_footer_menu_for_mobile() {
				echo $this->shapeshifter_get_footer_menu_for_mobile();
			}

			/**
			 * Get Template for Mobile Menu Buttons
			 * 
			 * @return string
			**/
			function shapeshifter_get_footer_menu_for_mobile() {

				ob_start();

					get_template_part( 'templates/mobile/mobile-footer-menu-buttons' );

				$footer_menu_for_mobile = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_footer_menu_for_mobile', $footer_menu_for_mobile );

			}

			/**
			 * Print Template for Mobile Sidebar
			 * 
			 * @see $this->shapeshifter_get_mobile_side_menu()
			**/
			function shapeshifter_mobile_side_menu() {
				echo $this->shapeshifter_get_mobile_side_menu();
			}

			/**
			 * Get Template for Mobile Sidebar
			 * 
			 * @return string
			**/
			function shapeshifter_get_mobile_side_menu() {
				
				/**
				 * @global int
				**/
				global $shapeshifter_content_width;

				ob_start();

					get_template_part( 'templates/mobile/side-menu' );

				$mobile_side_menu = ob_get_clean();

				return apply_filters( 'shapeshifter_filters_mobile_side_menu', $mobile_side_menu );

			}


} // End Closure

}


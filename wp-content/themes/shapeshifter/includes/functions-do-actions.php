<?php

/**
 * At the End of Constructor
**/
if ( ! function_exists( 'shapeshifter_at_the_end_of_globals_constructor' ) ) { function shapeshifter_at_the_end_of_globals_constructor() { do_action( 'shapeshifter_at_the_end_of_globals_constructor' ); } }

/**
 * Class Trigger For Extensional Plugin
**/
	// Globals
	if ( ! function_exists( 'shapeshifter_trigger_global_classes' ) ) { function shapeshifter_trigger_global_classes() { do_action( 'shapeshifter_trigger_global_classes' ); } }

		// Register Widget Areas
		if ( ! function_exists( 'shapeshifter_trigger_register_widget_areas' ) ) { function shapeshifter_trigger_register_widget_areas() { do_action( 'shapeshifter_trigger_register_widget_areas' ); } }

		// After Defining Class ShapeShifter_Theme_Mods
		if ( ! function_exists( 'shapeshifter_after_define_class_theme_mods' ) ) { function shapeshifter_after_define_class_theme_mods() { do_action( 'shapeshifter_after_define_class_theme_mods' ); } }

	// Frontend
	if ( ! function_exists( 'shapeshifter_trigger_frontend_classes' ) ) { function shapeshifter_trigger_frontend_classes() { do_action( 'shapeshifter_trigger_frontend_classes' ); } }

		// Frontend Class Constructor
		if ( ! function_exists( 'shapeshifter_trigger_frontend' ) ) { function shapeshifter_trigger_frontend() { do_action( 'shapeshifter_trigger_frontend' ); } }

	// Admin
	if ( ! function_exists( 'shapeshifter_trigger_admin_classes' ) ) { function shapeshifter_trigger_admin_classes() { do_action( 'shapeshifter_trigger_admin_classes' ); } }

		// Admin Class Constructor
		if ( ! function_exists( 'shapeshifter_trigger_admin' ) ) { function shapeshifter_trigger_admin() { do_action( 'shapeshifter_trigger_admin' ); } }

		// Admin Meta Boxes Class Constructor
		if ( ! function_exists( 'shapeshifter_trigger_admin_metaboxes' ) ) { function shapeshifter_trigger_admin_metaboxes() { do_action( 'shapeshifter_trigger_admin_metaboxes' ); } }

	// Theme Customizer
	if ( ! function_exists( 'shapeshifter_trigger_theme_customizer_classes' ) ) { function shapeshifter_trigger_theme_customizer_classes() { do_action( 'shapeshifter_trigger_theme_customizer_classes' ); } }

		// Theme Customizer Class Constructor
		if ( ! function_exists( 'shapeshifter_trigger_theme_customizer' ) ) { function shapeshifter_trigger_theme_customizer() { do_action( 'shapeshifter_trigger_theme_customizer' ); } }


/**
 * Public Before Template Starts
**/
	// Init Public
		// After Setup Post Meta Vars
		if ( ! function_exists( 'shapeshifter_frontend_after_setup_post_meta_vars' ) ) { function shapeshifter_frontend_after_setup_post_meta_vars() { do_action( 'shapeshifter_frontend_after_setup_post_meta_vars' ); } }

		// After Define Content Area Layout
		if ( ! function_exists( 'shapeshifter_frontend_after_define_content_area_layout' ) ) { function shapeshifter_frontend_after_define_content_area_layout() { do_action( 'shapeshifter_frontend_after_define_content_area_layout' ); } }

		// After Define Classes
		if ( ! function_exists( 'shapeshifter_frontend_after_define_classes' ) ) { function shapeshifter_frontend_after_define_classes() { do_action( 'shapeshifter_frontend_after_define_classes' ); } }

		// After Setup Nav Menu
		if ( ! function_exists( 'shapeshifter_frontend_after_setup_nav_menu' ) ) { function shapeshifter_frontend_after_setup_nav_menu() { do_action( 'shapeshifter_frontend_after_setup_nav_menu' ); } }

		// After Setup Post Meta Vars
		if( ! function_exists( 'shapeshifter_frontend_after_set_post_meta_vars_with_post_id' ) ) { function shapeshifter_frontend_after_set_post_meta_vars_with_post_id( $post_id ) { do_action( 'shapeshifter_frontend_after_set_post_meta_vars_with_post_id', $post_id ); } }

// header.php
if ( ! function_exists( 'shapeshifter_header' ) ) { function shapeshifter_header() { do_action( 'shapeshifter_header' ); } }

// footer.php
if ( ! function_exists( 'shapeshifter_footer' ) ) { function shapeshifter_footer() { do_action( 'shapeshifter_footer' ); } }

// public.php
if ( ! function_exists( 'shapeshifter_frontend' ) ) { function shapeshifter_frontend() { do_action( 'shapeshifter_frontend' ); } }

	// Head
	if ( ! function_exists( 'shapeshifter_head' ) ) { function shapeshifter_head() { do_action( 'shapeshifter_head' ); } }

	// Body
	if ( ! function_exists( 'shapeshifter_body' ) ) { function shapeshifter_body() { do_action( 'shapeshifter_body' ); } }

		// Header
		if ( ! function_exists( 'shapeshifter_starting_body' ) ) { function shapeshifter_starting_body() { do_action( 'shapeshifter_starting_body' ); } }
			// Body Header
			if ( ! function_exists( 'shapeshifter_body_header' ) ) { function shapeshifter_body_header() { do_action( 'shapeshifter_body_header' ); } }

				// Header Top
				if ( ! function_exists( 'shapeshifter_header_top' ) ) { function shapeshifter_header_top() { do_action( 'shapeshifter_header_top' ); } }

				// Header Logo
				if ( ! function_exists( 'shapeshifter_header_logo' ) ) { function shapeshifter_header_logo() { do_action( 'shapeshifter_header_logo' ); } }

				// After Header
				if ( ! function_exists( 'shapeshifter_after_header' ) ) { function shapeshifter_after_header() { do_action( 'shapeshifter_after_header' ); } }

				// After Nav Menu
				if ( ! function_exists( 'shapeshifter_before_content_area' ) ) { function shapeshifter_before_content_area() { do_action( 'shapeshifter_before_content_area' ); } }

		// Content Area
		if ( ! function_exists( 'shapeshifter_content_area' ) ) { function shapeshifter_content_area() { do_action( 'shapeshifter_content_area' ); } }

			// Start
			if ( ! function_exists( 'shapeshifter_content_area_start' ) ) { function shapeshifter_content_area_start() { do_action( 'shapeshifter_content_area_start' ); } }

			// End
			if ( ! function_exists( 'shapeshifter_content_area_end' ) ) { function shapeshifter_content_area_end() { do_action( 'shapeshifter_content_area_end' ); } }

			// Before Content
			if ( ! function_exists( 'shapeshifter_before_content' ) ) { function shapeshifter_before_content() { do_action( 'shapeshifter_before_content' ); } }

			// Main Content
			if ( ! function_exists( 'shapeshifter_main_content' ) ) { function shapeshifter_main_content() { do_action( 'shapeshifter_main_content' ); } }

				// Home
				if ( ! function_exists( 'shapeshifter_main_content_home' ) ) { function shapeshifter_main_content_home() { do_action( 'shapeshifter_main_content_home' ); } }

				// Front Page
				if ( ! function_exists( 'shapeshifter_main_content_front_page' ) ) { function shapeshifter_main_content_front_page() { do_action( 'shapeshifter_main_content_front_page' ); } }

				// Blog Page
				if ( ! function_exists( 'shapeshifter_main_content_blog_page' ) ) { function shapeshifter_main_content_blog_page() { do_action( 'shapeshifter_main_content_blog_page' ); } }

				// Singular Page
				if ( ! function_exists( 'shapeshifter_main_content_singular_page' ) ) { function shapeshifter_main_content_singular_page() { do_action( 'shapeshifter_main_content_singular_page' ); } }

					// Breadcrumbs
					if ( ! function_exists( 'shapeshifter_breadcrumb' ) ) { function shapeshifter_breadcrumb( $post ) { do_action( 'shapeshifter_breadcrumb', $post ); } }

					// Header
					if ( ! function_exists( 'shapeshifter_main_content_singular_page_header' ) ) { function shapeshifter_main_content_singular_page_header( $post ) { do_action( 'shapeshifter_main_content_singular_page_header', $post ); } }

					// Content
					if ( ! function_exists( 'shapeshifter_main_content_singular_page_content' ) ) { function shapeshifter_main_content_singular_page_content( $post ) { do_action( 'shapeshifter_main_content_singular_page_content', $post ); } }

					// Footer
					if ( ! function_exists( 'shapeshifter_main_content_singular_page_link_pages' ) ) { function shapeshifter_main_content_singular_page_link_pages( $post ) { do_action( 'shapeshifter_main_content_singular_page_link_pages', $post ); } }

					// Footer
					if ( ! function_exists( 'shapeshifter_main_content_singular_page_footer' ) ) { function shapeshifter_main_content_singular_page_footer( $post ) { do_action( 'shapeshifter_main_content_singular_page_footer', $post ); } }

						// Prev Next
						if ( ! function_exists( 'shapeshifter_main_content_singular_page_prev_next' ) ) { function shapeshifter_main_content_singular_page_prev_next( $post ) { do_action( 'shapeshifter_main_content_singular_page_prev_next', $post ); } }

				// Archive Page
				if ( ! function_exists( 'shapeshifter_main_content_archive_page' ) ) { function shapeshifter_main_content_archive_page() { do_action( 'shapeshifter_main_content_archive_page' ); } }

					// Archive Page Title
					if ( ! function_exists( 'shapeshifter_archive_page_title' ) ) { function shapeshifter_archive_page_title( $post ) { do_action( 'shapeshifter_archive_page_title', $post ); } }

					// Post List Item
					if ( ! function_exists( 'shapeshifter_post_list_item' ) ) { function shapeshifter_post_list_item( $post ) { do_action( 'shapeshifter_post_list_item', $post ); } }
						
						// Archive Read Later
						if ( ! function_exists( 'shapeshifter_archive_read_later' ) ) { function shapeshifter_archive_read_later( $permalink, $title ) { do_action( 'shapeshifter_archive_read_later', $permalink, $title ); } }
						// Exerpt
						if ( ! function_exists( 'shapeshifter_the_excerpt' ) ) { function shapeshifter_the_excerpt( $post_content, $excerpt_length = 200 ) { do_action( 'shapeshifter_the_excerpt', $post_content, $excerpt_length ); } }

					// Pagination
					if ( ! function_exists( 'shapeshifter_pagination' ) ) { function shapeshifter_pagination() { do_action( 'shapeshifter_pagination' ); } }

				// Woocommerce
				if ( ! function_exists( 'shapeshifter_main_content_woocommerce_page' ) ) { function shapeshifter_main_content_woocommerce_page() { do_action( 'shapeshifter_main_content_woocommerce_page' ); } }

					// Shop
					if ( ! function_exists( 'shapeshifter_wc_shop' ) ) { function shapeshifter_wc_shop() { do_action( 'shapeshifter_wc_shop' ); } }

					// Product Taxonomy
					if ( ! function_exists( 'shapeshifter_woocommerce_product_taxonomy' ) ) { function shapeshifter_woocommerce_product_taxonomy() { do_action( 'shapeshifter_woocommerce_product_taxonomy' ); } }

					// Single Product
					if ( ! function_exists( 'shapeshifter_woocommerce_single_product' ) ) { function shapeshifter_woocommerce_single_product() { do_action( 'shapeshifter_woocommerce_single_product' ); } }

					// Cart
					if ( ! function_exists( 'shapeshifter_woocommerce_cart' ) ) { function shapeshifter_woocommerce_cart() { do_action( 'shapeshifter_woocommerce_cart' ); } }

					// Checkout
					if ( ! function_exists( 'shapeshifter_woocommerce_checkout' ) ) { function shapeshifter_woocommerce_checkout() { do_action( 'shapeshifter_woocommerce_checkout' ); } }

					// Account
					if ( ! function_exists( 'shapeshifter_woocommerce_account_page' ) ) { function shapeshifter_woocommerce_account_page() { do_action( 'shapeshifter_woocommerce_account_page' ); } }

						// WC Header
						if ( ! function_exists( 'shapeshifter_wc_header' ) ) { function shapeshifter_wc_header() { do_action( 'shapeshifter_wc_header' ); } }

				// BBPress
				if ( ! function_exists( 'shapeshifter_main_content_bbpress_page' ) ) { function shapeshifter_main_content_bbpress_page() { do_action( 'shapeshifter_main_content_bbpress_page' ); } }

			// After Content
			if ( ! function_exists( 'shapeshifter_after_content' ) ) { function shapeshifter_after_content() { do_action( 'shapeshifter_after_content' ); } }

		// Footer
		if ( ! function_exists( 'shapeshifter_footer' ) ) { function shapeshifter_footer() { do_action( 'shapeshifter_footer' ); } }

			// Footer Section
			if ( ! function_exists( 'shapeshifter_footer_section' ) ) { function shapeshifter_footer_section() { do_action( 'shapeshifter_footer_section' ); } }

				// Before Footer
				if ( ! function_exists( 'shapeshifter_before_footer' ) ) { function shapeshifter_before_footer() { do_action( 'shapeshifter_before_footer' ); } }

				// Footer Last
				if ( ! function_exists( 'shapeshifter_footer_last' ) ) { function shapeshifter_footer_last() { do_action( 'shapeshifter_footer_last' ); } }

				// Footer Site Description
				if ( ! function_exists( 'shapeshifter_footer_site_description' ) ) { function shapeshifter_footer_site_description() { do_action( 'shapeshifter_footer_site_description' ); } }

				// Footer Liscense
				if ( ! function_exists( 'shapeshifter_footer_license_type' ) ) { function shapeshifter_footer_license_type() { do_action( 'shapeshifter_footer_license_type' ); } }

		// Nav Menus
			// Header Nav Menu
			if ( ! function_exists( 'shapeshifter_header_nav_menu' ) ) { function shapeshifter_header_nav_menu() { do_action( 'shapeshifter_header_nav_menu' ); } }

			// Nav Menu
			if ( ! function_exists( 'shapeshifter_nav_menu' ) ) { function shapeshifter_nav_menu() { do_action( 'shapeshifter_nav_menu' ); } }

			// Footer Navi Menu
			if ( ! function_exists( 'shapeshifter_footer_nav_menu' ) ) { function shapeshifter_footer_nav_menu() { do_action( 'shapeshifter_footer_nav_menu' ); } }

		// Widget Areas
		if ( ! function_exists( 'shapeshifter_widget_areas' ) ) { function shapeshifter_widget_areas() { do_action( 'shapeshifter_widget_areas' ); } }
			
			// Standard
				// Sidebar Left
				if ( ! function_exists( 'shapeshifter_widget_area_sidebar_left' ) ) { function shapeshifter_widget_area_sidebar_left() { do_action( 'shapeshifter_widget_area_sidebar_left' ); } }

				// Sidebar Left Fixed
				if ( ! function_exists( 'shapeshifter_widget_area_sidebar_left_fixed' ) ) { function shapeshifter_widget_area_sidebar_left_fixed() { do_action( 'shapeshifter_widget_area_sidebar_left_fixed' ); } }

				// Sidebar Right
				if ( ! function_exists( 'shapeshifter_widget_area_sidebar_right' ) ) { function shapeshifter_widget_area_sidebar_right() { do_action( 'shapeshifter_widget_area_sidebar_right' ); } }

				// Sidebar Right Fixed
				if ( ! function_exists( 'shapeshifter_widget_area_sidebar_right_fixed' ) ) { function shapeshifter_widget_area_sidebar_right_fixed() { do_action( 'shapeshifter_widget_area_sidebar_right_fixed' ); } }

				// Slidebar Left
				if ( ! function_exists( 'shapeshifter_widget_area_slidebar_left' ) ) { function shapeshifter_widget_area_slidebar_left() { do_action( 'shapeshifter_widget_area_slidebar_left' ); } }

				// Slidebar Right
				if ( ! function_exists( 'shapeshifter_widget_area_slidebar_right' ) ) { function shapeshifter_widget_area_slidebar_right() { do_action( 'shapeshifter_widget_area_slidebar_right' ); } }

				// Top Right
				if ( ! function_exists( 'shapeshifter_widget_area_top_right' ) ) { function shapeshifter_widget_area_top_right() { do_action( 'shapeshifter_widget_area_top_right' ); } }

			// Optional
			if ( ! function_exists( 'shapeshifter_post_meta_outputs_in_widget_area_hook' ) ) { function shapeshifter_post_meta_outputs_in_widget_area_hook( $widget_areas_args ) { do_action( 'shapeshifter_post_meta_outputs_in_widget_area_hook', $widget_areas_args ); } }
				
				// After Header
				if ( ! function_exists( 'shapeshifter_widget_areas_after_header' ) ) { function shapeshifter_widget_areas_after_header() { do_action( 'shapeshifter_widget_areas_after_header' ); } }

				// Before Content Area
				if ( ! function_exists( 'shapeshifter_widget_areas_before_content_area' ) ) { function shapeshifter_widget_areas_before_content_area() { do_action( 'shapeshifter_widget_areas_before_content_area' ); } }

				// Before Content
				if ( ! function_exists( 'shapeshifter_widget_areas_before_content' ) ) { function shapeshifter_widget_areas_before_content() { do_action( 'shapeshifter_widget_areas_before_content' ); } }

				// Beginning of Content
				if ( ! function_exists( 'shapeshifter_widget_areas_beginning_of_content' ) ) { function shapeshifter_widget_areas_beginning_of_content() { do_action( 'shapeshifter_widget_areas_beginning_of_content' ); } }

				// Before First H2 of Content
				if ( ! function_exists( 'shapeshifter_widget_areas_before_1st_h2_of_content' ) ) { function shapeshifter_widget_areas_before_1st_h2_of_content() { do_action( 'shapeshifter_widget_areas_before_1st_h2_of_content' ); } }

				// End of Content
				if ( ! function_exists( 'shapeshifter_widget_areas_end_of_content' ) ) { function shapeshifter_widget_areas_end_of_content() { do_action( 'shapeshifter_widget_areas_end_of_content' ); } }

				// After Content
				if ( ! function_exists( 'shapeshifter_widget_areas_after_content' ) ) { function shapeshifter_widget_areas_after_content() { do_action( 'shapeshifter_widget_areas_after_content' ); } }

				// After Content Area
				if ( ! function_exists( 'shapeshifter_widget_areas_after_content_area' ) ) { function shapeshifter_widget_areas_after_content_area() { do_action( 'shapeshifter_widget_areas_after_content_area' ); } }

				// Before Footer
				if ( ! function_exists( 'shapeshifter_widget_areas_before_footer' ) ) { function shapeshifter_widget_areas_before_footer() { do_action( 'shapeshifter_widget_areas_before_footer' ); } }

				// In Footer
				if ( ! function_exists( 'shapeshifter_widget_areas_in_footer' ) ) { function shapeshifter_widget_areas_in_footer() { do_action( 'shapeshifter_widget_areas_in_footer' ); } }

				// Mobile Menu
				if ( ! function_exists( 'shapeshifter_widget_areas_mobile_menu' ) ) { function shapeshifter_widget_areas_mobile_menu() { do_action( 'shapeshifter_widget_areas_mobile_menu' ); } }

		// Post Meta


		// Mobile Print
			// Mobile Footer Menu
			if ( ! function_exists( 'shapeshifter_footer_menu_for_mobile' ) ) { function shapeshifter_footer_menu_for_mobile() { do_action( 'shapeshifter_footer_menu_for_mobile' ); } }

			// Side Menu
			if ( ! function_exists( 'shapeshifter_mobile_side_menu' ) ) { function shapeshifter_mobile_side_menu() { do_action( 'shapeshifter_mobile_side_menu' ); } }

	// Others
		// General Element
		if ( ! function_exists( 'shapeshifter_generated_tag' ) ) { function shapeshifter_generated_tag( $element, $atts = array(), $text = '', $wrap = false ) { do_action( 'shapeshifter_generated_tag', $element, $atts, $text, $wrap ); } }
		// Default Thumbnail URL
		if ( ! function_exists( 'shapeshifter_the_default_thumbnail_url' ) ) { function shapeshifter_the_default_thumbnail_url( $post ) { do_action( 'shapeshifter_the_default_thumbnail_url', $post ); } }
		// Default Thumbnail DIV Tag
		if ( ! function_exists( 'shapeshifter_default_thumbnail_div_tag' ) ) { function shapeshifter_default_thumbnail_div_tag( $class = 'default-post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ) ) { do_action( 'shapeshifter_default_thumbnail_div_tag', $class, $size ); } }
		// Post Thumbnail DIV Tag
		if ( ! function_exists( 'shapeshifter_post_thumbnail_div_tag' ) ) { function shapeshifter_post_thumbnail_div_tag( $post_id, $div_class = 'post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ) ) { do_action( 'shapeshifter_post_thumbnail_div_tag', $post_id, $div_class, $size ); } }

// In order to filter Entire BODY
	// Start
	if ( ! function_exists( 'shapeshifter_body_wrapper_start' ) ) { function shapeshifter_body_wrapper_start() { do_action( 'shapeshifter_body_wrapper_start' ); } }

	// End
	if ( ! function_exists( 'shapeshifter_body_wrapper_end' ) ) { function shapeshifter_body_wrapper_end() { do_action( 'shapeshifter_body_wrapper_end' ); } }


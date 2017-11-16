<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'ShapeShifter_Theme_Mods' ) ) {
	class ShapeShifter_Theme_Mods {

		/**
		 * Get Theme Mods
		 * 
		 * @param string $theme_options_prefix
		 * 
		 * @return array $theme_mods : apply_filters( 'shapeshifter_filters_default_theme_mods', wp_parse_args( $theme_mods, $default_theme_mods ), $theme_options_prefix, $widget_areas, $animated_elements_in_content )
		 		string $theme_options_prefix
		 		array  $widget_areas
		 		array  $animated_elements_in_content
		**/
		public static function get_theme_mods( $theme_options_prefix = 'shapeshifter_options_' ) {

			$theme_mods = get_theme_mods();

			$content_area_background_color = esc_attr( 
				isset( $theme_mods[ 'content_area_background_color' ] ) 
					&&  $theme_mods[ 'content_area_background_color' ] != '' 
				? $theme_mods[ 'content_area_background_color' ]
				: 'rgba(255,255,255,0)'
			);

			$main_content_background_color = esc_attr( 
				isset( $theme_mods[ 'main_content_background_color' ] ) 
					&&  $theme_mods[ 'main_content_background_color' ] != '' 
				? $theme_mods[ 'main_content_background_color' ]
				: 'rgba(255,255,255,0)'
			);

			$default_theme_mods = array(

				# Wrapper
					'text_font_family' => '"Yu Gothic", "游ゴシック"',
				# Header
					# Font Family
						'header_site_name_font_family' => 'HG正楷書体-PRO',
						'header_site_description_font_family' => '"Yu Gothic", "游ゴシック"',
						'header_top_nav_menu_font_family' => '"Yu Gothic", "游ゴシック"',
					# Colors
						'header_background_color' => '#FFFFFF',
						'header_site_name_color' => '#000000',
						'header_site_description_color' => '#000000',
						'header_top_nav_menu_text_color' => '#000000',
				# Nav Menu
					# Nav Menu Display
						'nav_text_font_family' => '"Yu Gothic", "游ゴシック"',
						'is_nav_menu_fixed' => false,
						'nav_menu_size_toggle' => false,
						'nav_menu_size' => 140,
						'nav_menu_add_search_box' => false,
					# Nav Menu Colors
						'nav_font_color' => '#666666',
						'nav_background_gradient_on' => false,
						'nav_background_color' => 'rgba(255,255,255,0.9)',
						'nav_items_background_gradient_on' => false,
						'nav_items_background_color' => 'rgba(255,255,255,0.9)',
						'header_image_and_nav_border_color' => '#CCCCCC',
						'nav_items_selected_border_color' => '',
					# Nav Menu Images
						'nav_menu_background_image' => '',
						'nav_menu_items_background_image' => '',
				# Content Area
					# Design
						'is_one_column_main_content_max_width_on' => 0,
						'sidebar_left_max_width' => 300,
						'main_content_max_width' => 660,
						'sidebar_right_max_width' => 300,
						'is_content_border_on' => 0,
						'main_content_border_radius' => 0,
					# Colors
						'content_area_background_color' => 'rgba(255,255,255,0)',
						'content_outer_background_color' => 'rgba(255,255,255,0)',
						'main_content_background_color' => 'rgba(255,255,255,0)',
						# Sidebar Left Container
							'content_area_sidebar_left_container_background_color' => 'rgba(255,255,255,0)',
						# Sidebar Right Container
							'content_area_sidebar_right_container_background_color' => 'rgba(255,255,255,0)',
					# Area Background Image
						'content_area_background_image' => '',
						'content_area_background_image_size' => 'contain',
						'content_area_background_image_position_row' => 'center',
						'content_area_background_image_position_column' => 'center',
						'content_area_background_image_repeat' => 'no-repeat',
						'content_area_background_image_attachment' => 'scroll',
					# Content Background Image
						'main_content_background_image' => '',
						'main_content_background_image_size' => 'contain',
						'main_content_background_image_position_row' => 'center',
						'main_content_background_image_position_column' => 'center',
						'main_content_background_image_repeat' => 'no-repeat',
						'main_content_background_image_attachment' => 'scroll',
				# Archive Page
					# Design
						'archive_page_is_border_top_on' => 1,
						'archive_page_is_border_left_on' => 1,
						'archive_page_is_border_right_on' => 1,
						'archive_page_is_border_bottom_on' => 1,
						'archive_page_list_item_border_radius' => 0,
					# Read Later
						'archive_page_read_later_text' => '',
						'archive_page_read_later_type' => 'none',
						'archive_page_read_later_twitter' => false,
						'archive_page_read_later_facebook' => false,
						'archive_page_read_later_googleplus' => false,
						'archive_page_read_later_hatena' => false,
						'archive_page_read_later_pocket' => false,
						'archive_page_read_later_line' => false,
					# CSS Animations
						'archive_page_post_list_animation_hover_select' => 'none',
						'archive_page_post_list_animation_enter_select' => 'none',
						'archive_page_post_list_title_box_animation_select' => 'none',
					# Colors
						'archive_page_text_color' => '#000000',
						'archive_page_text_link_color' => '#337ab7',
						'archive_page_post_list_text_link_color' => '#337ab7',
					# Thumbnail
						'archive_page_post_thumbnail_width' => 80,
						'archive_page_post_thumbnail_height' => 80,
						'archive_page_post_thumbnail_radius' => 40,
					# Title
						'archive_page_post_list_title_font_family' => 'HG正楷書体-PRO',
						'archive_page_post_list_title_font_size' => 26,
						'archive_page_post_list_title_fontawesome_icon_select' => 'f064',
						'archive_page_post_list_title_fontawesome_icon_color' => '#ff7799',
						'archive_page_post_list_title_text_color' => '#666666',
						'archive_page_post_list_title_text_shadow' => '#999999',
						'archive_page_post_list_title_background_gradient_on' => false,
						'archive_page_post_list_title_background_color' => esc_attr( 
							isset( $theme_mods[ 'content_background_color' ] ) 
								&& $theme_mods[ 'content_background_color' ] != ''
							? $theme_mods[ 'content_background_color' ]
							: $main_content_background_color
						),
						'archive_page_post_list_title_border_bottom_color' => esc_attr( 
							isset( $theme_mods[ 'content_background_color' ] ) 
								&& $theme_mods[ 'content_background_color' ] != ''
							? $theme_mods[ 'content_background_color' ]
							: $main_content_background_color
						),
						'archive_page_post_list_title_border_left_color' => esc_attr( 
							isset( $theme_mods[ 'content_background_color' ] ) 
								&& $theme_mods[ 'content_background_color' ] != ''
							? $theme_mods[ 'content_background_color' ]
							: $main_content_background_color
						),
						'archive_page_post_list_title_border_right_color' => esc_attr( 
							isset( $theme_mods[ 'content_background_color' ] ) 
								&& $theme_mods[ 'content_background_color' ] != ''
							? $theme_mods[ 'content_background_color' ]
							: $main_content_background_color
						),
						'archive_page_post_list_title_background_image' => '',
				# Singular Page
					# Display
						'is_not_single_meta_visible' => false,
						'is_not_page_meta_visible' => false,
						'is_not_page_link_visible' => false,
					# Colors
						'singular_page_bloginfo_background_color' => 'rgba(255,255,255,0)',
						'singular_page_bloginfo_text_color' => '#666666',
						'singular_page_bloginfo_text_link_color' => '#337ab7',
						'singular_page_text_color' => '#666666',
						'singular_page_text_link_color' => '#337ab7',
				# Footer
					# Text
						'footer_font_family' => '"Yu Gothic", "游ゴシック"',
						'footer_font_size' => 14,
						'footer_align_select' => 'center',
						'footer_display_theme' => true,
						'footer_display_description' => true,
						'footer_copyright_year' => 2000,
						'footer_display_credit_type' => 'none',
					# Background Image
						'footer_background_image_select' => '',
						'footer_background_image_size' => 'contain',
						'footer_background_image_position_row' => 'center',
						'footer_background_image_position_column' => 'center',
						'footer_background_image_repeat' => 'no-repeat',
						'footer_background_image_attachment' => 'scroll',
					# Colors
						'footer_background_color' => '#000000',
						'footer_text_color' => '#FFFFFF',
				# Widget Areas
					# Top Right
						'is_widget_area_top_right_fixed' => true,
						'top_right_fixed_area_top' => 10,
						'top_right_fixed_area_side' => 10,
					# Slidebar Left
						'slidebar_left_background_color' => 'rgba(255,255,255,0.9)',
						'slidebar_left_background_image' => '',
					# Slidebar Right
						'slidebar_right_background_color' => 'rgba(255,255,255,0.9)',
						'slidebar_right_background_image' => '',
					# Mobile
						'mobile_sidebar_wrapper_background_color' => 'rgba(255,255,255,0.9)',
						'mobile_sidebar_wrapper_background_image' => '',
						'mobile_sidebar_wrapper_background_image_size' => 'cover',
						'mobile_sidebar_wrapper_background_image_position_row' => 'center',
						'mobile_sidebar_wrapper_background_image_position_column' => 'center',
						'mobile_sidebar_wrapper_background_image_repeat' => 'no-repeat',
						'mobile_sidebar_wrapper_background_image_attachment' => 'scroll',
				# Others
					# Images
						'default_thumbnail_image' => SHAPESHIFTER_ASSETS_DIR_URI . 'images/no-img.png',
						'web_clip_icon_image' => '',
						'favicon_image' => '',
					# Colors
						'text_color' => '#666666',
						'text_link_color' => '#337ab7',
					# Custom CSS
						'text_font_family' => esc_html( '"Yu Gothic", "游ゴシック"' ),
						'is_responsive' => false,
						'theme_skin' => 'none',

			);

			# Headlines
				$headings = array( 
					'h1' => array(
						'font_size' => 30,
						'font_family' => 'HG正楷書体-PRO',
						'fontawesome' => 'f02e',
						'icon_color' => '#ff4c4c',
					), 
					'h2' => array(
						'font_size' => 28,
						'font_family' => '"Yu Gothic", "游ゴシック"',
						'fontawesome' => 'f04b',
						'icon_color' => '#4489ff',
					), 
					'h3' => array(
						'font_size' => 26,
						'font_family' => '"Yu Gothic", "游ゴシック"',
						'fontawesome' => 'f1a5',
						'icon_color' => '#e86d6d',
					), 
					'h4' => array(
						'font_size' => 24,
						'font_family' => '"Yu Gothic", "游ゴシック"',
						'fontawesome' => 'f05a',
						'icon_color' => '#3d32ff',
					), 
					'h5' => array(
						'font_size' => 22,
						'font_family' => '"Yu Gothic", "游ゴシック"',
						'fontawesome' => 'f0d7',
						'icon_color' => '#43e060',
					), 
					'h6' => array(
						'font_size' => 20,
						'font_family' => '"Yu Gothic", "游ゴシック"',
						'fontawesome' => 'none',
						'icon_color' => '#ff4c4c',
					),
					'p' => array(
						'font_size' => 12,
						'font_family' => 'HG正楷書体-PRO',
						'fontawesome' => 'none',
						'icon_color' => '#ff4c4c',
					) 
				);
				foreach( $headings as $element => $data ) {
					$default_theme_mods[ 'singular_page_' . $element . '_font_family' ] = $data[ 'font_family' ];
					$default_theme_mods[ 'singular_page_' . $element . '_font_size' ] = absint( $data[ 'font_size' ] );
					if ( $element !== 'p' ) {
						$default_theme_mods[ 'singular_page_' . $element . '_fontawesome_icon_select' ] = 'none';
						$default_theme_mods[ 'singular_page_' . $element . '_fontawesome_icon_color' ] = $data[ 'icon_color' ];
					}
					$default_theme_mods[ 'singular_page_' . $element . '_text_color' ] = '#666666';
					$default_theme_mods[ 'singular_page_' . $element . '_text_shadow' ] = '';

					$default_theme_mods[ 'singular_page_' . $element . '_background_color' ] = ( 
						isset( $theme_mods[ 'content_background_color' ] ) && esc_attr( $theme_mods[ 'content_background_color' ] ) != ''
						? esc_attr( $theme_mods[ 'content_background_color' ] )
						: $default_theme_mods[ 'main_content_background_color' ]
					);
					$default_theme_mods[ 'singular_page_' . $element . '_background_gradient_on' ] = false;
					$default_theme_mods[ 'singular_page_' . $element . '_border_bottom_color' ] = ( 
						isset( $theme_mods[ 'content_background_color' ] ) && esc_attr( $theme_mods[ 'content_background_color' ] ) != ''
						? esc_attr( $theme_mods[ 'content_background_color' ] )
						: $default_theme_mods[ 'main_content_background_color' ]
					);
					$default_theme_mods[ 'singular_page_' . $element . '_border_left_color' ] = ( 
						isset( $theme_mods[ 'content_background_color' ] ) && esc_attr( $theme_mods[ 'content_background_color' ] ) != ''
						? esc_attr( $theme_mods[ 'content_background_color' ] )
						: $default_theme_mods[ 'main_content_background_color' ]
					);
					$default_theme_mods[ 'singular_page_' . $element . '_border_right_color' ] = ( 
						isset( $theme_mods[ 'content_background_color' ] ) && esc_attr( $theme_mods[ 'content_background_color' ] ) != ''
						? esc_attr( $theme_mods[ 'content_background_color' ] )
						: $default_theme_mods[ 'main_content_background_color' ]
					);
					$default_theme_mods[ 'singular_page_' . $element . '_background_image' ] = '';
				}
				unset( $content_area_background_color );

			# Standard Widget Areas
				$widget_areas = array( 'sidebar_left', 'sidebar_left_fixed', 'sidebar_right', 'sidebar_right_fixed', 'slidebar_left', 'slidebar_right', 'top_right', 'mobile_sidebar' );

				foreach( $widget_areas as $index => $widget_area ) {

					$default_theme_mods[ $widget_area . '_font_family' ] = '"Yu Gothic", "游ゴシック"';
					$default_theme_mods[ $widget_area . '_area_animation_enter' ] = 'none';
					$default_theme_mods[ $widget_area . '_outer_background_image' ] = '';
					$default_theme_mods[ $widget_area . '_outer_background_image_size' ] = 'cover';
					$default_theme_mods[ $widget_area . '_outer_background_image_position_row' ] = 'center';
					$default_theme_mods[ $widget_area . '_outer_background_image_position_column' ] = 'center';
					$default_theme_mods[ $widget_area . '_outer_background_image_repeat' ] = 'no-repeat';
					$default_theme_mods[ $widget_area . '_outer_background_image_attachment' ] = 'scroll';
					$default_theme_mods[ $widget_area . '_inner_background_image' ] = '';
					$default_theme_mods[ $widget_area . '_inner_background_image_size' ] = 'cover';
					$default_theme_mods[ $widget_area . '_inner_background_image_position_row' ] = 'center';
					$default_theme_mods[ $widget_area . '_inner_background_image_position_column' ] = 'center';
					$default_theme_mods[ $widget_area . '_inner_background_image_repeat' ] = 'no-repeat';
					$default_theme_mods[ $widget_area . '_inner_background_image_attachment' ] = 'scroll';
					$default_theme_mods[ $widget_area . '_widget_border' ] = false;
					$default_theme_mods[ $widget_area . '_widget_border_radius' ] = 0;
					$default_theme_mods[ $widget_area . '_widget_margin' ] = 0;
					$default_theme_mods[ $widget_area . '_widget_title_fontawesome_icon_select' ] = 'f150';
					$default_theme_mods[ $widget_area . '_widget_title_fontawesome_icon_color' ] = '#000000';
					$default_theme_mods[ $widget_area . '_widget_list_fontawesome_icon_select' ] = 'f101';
					$default_theme_mods[ $widget_area . '_widget_list_fontawesome_icon_color' ] = '#000000';
					$default_theme_mods[ $widget_area . '_background_color' ] = ( 
						in_array( $widget_area, array( 'slidebar_left', 'slidebar_right' ) ) 
						? 'rgba(255,255,255,0.9)' 
						: 'rgba(255,255,255,0)' 
					);
					$default_theme_mods[ $widget_area . '_title_color' ] = '#000000';
					$default_theme_mods[ $widget_area . '_text_color' ] = '#666666';
					$default_theme_mods[ $widget_area . '_link_text_color' ] = '#337ab7';

				}

			# CSS Animations by Animate.css
				$animated_elements_in_content = array( 'h1', 'postinfos', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div', 'img', 'table' );
				foreach( $animated_elements_in_content as $element ) {
					$default_theme_mods[ 'singular_page_' . $element . '_animation_hover_select' ] = 'none';
					$default_theme_mods[ 'singular_page_' . $element . '_animation_enter_select' ] = 'none';
				}

			return apply_filters( 'shapeshifter_filters_default_theme_mods', wp_parse_args( $theme_mods, $default_theme_mods ), $theme_options_prefix, $widget_areas, $animated_elements_in_content );

		}

		/**
		 * Get CSS Animate Class
		 * 
		 * @return array
		**/
		public static function get_animate_css_class_array() {

			return array(
				'none' => esc_html__( 'No Animations', 'shapeshifter' ),

				'general' => array(

					'none' => esc_html__( 'No Animations', 'shapeshifter' ),

					'bounce' => 'bounce',
					'flash' => 'flash',
					'pulse' => 'pulse',
					'rubberBand' => 'rubberBand',
					'shake' => 'shake',
					'swing' => 'swing',
					'tada' => 'tada',
					'wobble' => 'wobble',
					'jello' => 'jello',

					'flip' => 'flip',

				),

				// Hover
				'hover' => array(

					'none' => esc_html__( 'No Animations', 'shapeshifter' ),

					'bounce' => 'bounce',
					'flash' => 'flash',
					'pulse' => 'pulse',
					'rubberBand' => 'rubberBand',
					'shake' => 'shake',
					'swing' => 'swing',
					'tada' => 'tada',
					'wobble' => 'wobble',
					'jello' => 'jello',

					'flip' => 'flip',

				),


				// Enter
				'enter' => array(

					'none' => esc_html__( 'No Animations', 'shapeshifter' ),

					'bounceIn' => 'bounceIn',
					'bounceInDown' => 'bounceInDown',
					'bounceInLeft' => 'bounceInLeft',
					'bounceInRight' => 'bounceInRight',
					'bounceInUp' => 'bounceInUp',

					'fadeIn' => 'fadeIn',
					'fadeInDown' => 'fadeInDown',
					'fadeInDownBig' => 'fadeInDownBig',
					'fadeInLeft' => 'fadeInLeft',
					'fadeInLeftBig' => 'fadeInLeftBig',
					'fadeInRight' => 'fadeInRight',
					'fadeInRightBig' => 'fadeInRightBig',
					'fadeInUp' => 'fadeInUp',
					'fadeInUpBig' => 'fadeInUpBig',

					'flipInX' => 'flipInX',
					'flipInY' => 'flipInY',

					'lightSpeedIn' => 'lightSpeedIn',

					'rotateIn' => 'rotateIn',
					'rotateInDownLeft' => 'rotateInDownLeft',
					'rotateInDownRight' => 'rotateInDownRight',
					'rotateInUpLeft' => 'rotateInUpLeft',
					'rotateInUpRight' => 'rotateInUpRight',

					'rollIn' => 'rollIn',

					'zoomIn' => 'zoomIn',
					'zoomInDown' => 'zoomInDown',
					'zoomInLeft' => 'zoomInLeft',
					'zoomInRight' => 'zoomInRight',
					'zoomInUp' => 'zoomInUp',

					'slideInDown' => 'slideInDown',
					'slideInLeft' => 'slideInLeft',
					'slideInRight' => 'slideInRight',
					'slideInUp' => 'slideInUp',

				),

				// Exit
				'exit' => array(

					'none' => esc_html__( 'No Animations', 'shapeshifter' ),

					'bounceOut' => 'bounceOut',
					'bounceOutDown' => 'bounceOutDown',
					'bounceOutLeft' => 'bounceOutLeft',
					'bounceOutRight' => 'bounceOutRight',
					'bounceOutUp' => 'bounceOutUp',

					'fadeOut' => 'fadeOut',
					'fadeOutDown' => 'fadeOutDown',
					'fadeOutDownBig' => 'fadeOutDownBig',
					'fadeOutLeft' => 'fadeOutLeft',
					'fadeOutLeftBig' => 'fadeOutLeftBig',
					'fadeOutRight' => 'fadeOutRight',
					'fadeOutRightBig' => 'fadeOutRightBig',
					'fadeOutUp' => 'fadeOutUp',
					'fadeOutUpBig' => 'fadeOutUpBig',

					'flipOutX' => 'flipOutX',
					'flipOutY' => 'flipOutY',

					'lightSpeedOut' => 'lightSpeedOut',

					'rotateOut' => 'rotateOut',
					'rotateOutDownLeft' => 'rotateOutDownLeft',
					'rotateOutDownRight' => 'rotateOutDownRight',
					'rotateOutUpLeft' => 'rotateOutUpLeft',
					'rotateOutUpRight' => 'rotateOutUpRight',

					'hinge' => 'hinge',
					'rollOut' => 'rollOut',

					'zoomOut' => 'zoomOut',
					'zoomOutDown' => 'zoomOutDown',
					'zoomOutLeft' => 'zoomOutLeft',
					'zoomOutRight' => 'zoomOutRight',
					'zoomOutUp' => 'zoomOutUp',

					'slideOutDown' => 'slideOutDown',
					'slideOutLeft' => 'slideOutLeft',
					'slideOutRight' => 'slideOutRight',
					'slideOutUp' => 'slideOutUp',

				),

			);

		}

		/**
		 * Get Font Families for ShapeShifter Theme Mods in Array
		 * 
		 * @return array filtered
		**/
		public static function get_shapeshifter_font_families() {

			return apply_filters( 'shapeshifter_filter_font_families', array( 
				'none' => esc_html__( 'Default', 'shapeshifter' ),
				'sans-serif' => esc_html__( 'sans-serif', 'shapeshifter' ),
					'arial' => esc_html__( 'arial', 'shapeshifter' ),
					'"arial black"' => esc_html__( 'arial black', 'shapeshifter' ),
					'"arial narrow"' => esc_html__( 'arial narrow', 'shapeshifter' ),
					'"arial unicode ms"' => esc_html__( 'arial unicode ms', 'shapeshifter' ),
					'"Century Gothic"' => esc_html__( 'Century Gothic', 'shapeshifter' ),
					'"Franklin Gothic Medium"' => esc_html__( 'Franklin Gothic Medium', 'shapeshifter' ),
					'Gulim' => esc_html__( 'Gulim', 'shapeshifter' ),
					'Dotum' => esc_html__( 'Dotum', 'shapeshifter' ),
					'Haettenschweiler' => esc_html__( 'Haettenschweiler', 'shapeshifter' ),
					'Impact' => esc_html__( 'Impact', 'shapeshifter' ),
					'"Ludica Sans Unicode"' => esc_html__( 'Ludica Sans Unicode', 'shapeshifter' ),
					'"Microsoft Sans Serif"' => esc_html__( 'Microsoft Sans Serif', 'shapeshifter' ),
					'"MS Sans Serif"' => esc_html__( 'MS Sans Serif', 'shapeshifter' ),
					'"MV Boil"' => esc_html__( 'MV Boil', 'shapeshifter' ),
					'"New Gulim"' => esc_html__( 'New Gulim', 'shapeshifter' ),
					'Tahoma' => esc_html__( 'Tahoma', 'shapeshifter' ),
					'Trebuchet' => esc_html__( 'Trebuchet', 'shapeshifter' ),
					'Verdana' => esc_html__( 'Verdana', 'shapeshifter' ),
				'serif' => esc_html__( 'serif', 'shapeshifter' ),
					'Batang' => esc_html__( 'Batang', 'shapeshifter' ),
					'"Book Antiqua"' => esc_html__( 'Book Antiqua', 'shapeshifter' ),
					'Bookman Old Style' => esc_html__( 'Bookman Old Style', 'shapeshifter' ),
					'Century' => esc_html__( 'Century', 'shapeshifter' ),
					'"Estrangelo Edessa"' => esc_html__( 'Estrangelo Edessa', 'shapeshifter' ),
					'Garamond' => esc_html__( 'Garamond', 'shapeshifter' ),
					'Gautami' => esc_html__( 'Gautami', 'shapeshifter' ),
					'Georgia' => esc_html__( 'Georgia', 'shapeshifter' ),
					'Gungsuh' => esc_html__( 'Gungsuh', 'shapeshifter' ),
					'Latha' => esc_html__( 'Latha', 'shapeshifter' ),
					'Mangal' => esc_html__( 'Mangal', 'shapeshifter' ),
					'"MS Serif"' => esc_html__( 'MS Serif', 'shapeshifter' ),
					'PMingLiU' => esc_html__( 'PMingLiU', 'shapeshifter' ),
					'"Palatino Linotype"' => esc_html__( 'Palatino Linotype', 'shapeshifter' ),
					'Raavi' => esc_html__( 'Raavi', 'shapeshifter' ),
					'Roman' => esc_html__( 'Roman', 'shapeshifter' ),
					'Shruti' => esc_html__( 'Shruti', 'shapeshifter' ),
					'Sylfaen' => esc_html__( 'Sylfaen', 'shapeshifter' ),
					'"Times New Roman"' => esc_html__( 'Times New Roman', 'shapeshifter' ),
					'Tunga' => esc_html__( 'Tunga', 'shapeshifter' ),
				'monospace' => esc_html__( 'Monospace', 'shapeshifter' ),
					'BatangChe' => esc_html__( 'BatangChe', 'shapeshifter' ),
					'Courier' => esc_html__( 'Courier', 'shapeshifter' ),
					'"Courier New"' => esc_html__( 'Courier New', 'shapeshifter' ),
					'DotumChe' => esc_html__( 'DotumChe', 'shapeshifter' ),
					'GlimChe' => esc_html__( 'GlimChe', 'shapeshifter' ),
					'GungsuhChe' => esc_html__( 'GungsuhChe', 'shapeshifter' ),
					'HG行書体' => esc_html__( 'HG Gyoshotai', 'shapeshifter' ),
					'"Lucida Console"' => esc_html__( 'Lucida Console', 'shapeshifter' ),
					'MingLiU' => esc_html__( 'MingLiU', 'shapeshifter' ),
					'OCRB' => esc_html__( 'OCRB', 'shapeshifter' ),
					'SimHei' => esc_html__( 'SimHei', 'shapeshifter' ),
					'SimSun' => esc_html__( 'SimSun', 'shapeshifter' ),
					'"Small Fonts"' => esc_html__( 'Small Fonts', 'shapeshifter' ),
					'Terminal' => esc_html__( 'Terminal', 'shapeshifter' ),
				'fantasy' => esc_html__( 'Fantasy', 'shapeshifter' ),
					'alba' => esc_html__( 'alba', 'shapeshifter' ),
					'"alba matter"' => esc_html__( 'alba matter', 'shapeshifter' ),
					'"alba super"' => esc_html__( 'alba super', 'shapeshifter' ),
					'"baby kruffy"' => esc_html__( 'baby kruffy', 'shapeshifter' ),
					'Chick' => esc_html__( 'Chick', 'shapeshifter' ),
					'Croobie' => esc_html__( 'Croobie', 'shapeshifter' ),
					'Fat' => esc_html__( 'Fat', 'shapeshifter' ),
					'Freshbot' => esc_html__( 'Freshbot', 'shapeshifter' ),
					'Frosty' => esc_html__( 'Frosty', 'shapeshifter' ),
					'GlooGun' => esc_html__( 'GlooGun', 'shapeshifter' ),
					'Jokewood' => esc_html__( 'Jokewood', 'shapeshifter' ),
					'Modern' => esc_html__( 'Modern', 'shapeshifter' ),
					'"Monotype Corsiva"' => esc_html__( 'Monotype Corsiva', 'shapeshifter' ),
					'Poornut' => esc_html__( 'Poornut', 'shapeshifter' ),
					'"Pussycat Snickers"' => esc_html__( 'Pussycat Snickers', 'shapeshifter' ),
					'"Weltron Urban"' => esc_html__( 'Weltron Urban', 'shapeshifter' ),
				'cursive' => esc_html__( 'Cursive', 'shapeshifter' ),
					'"Comic Sans MS"' => esc_html__( 'Comic Sans MS', 'shapeshifter' ),
					'HGP行書体' => esc_html__( 'HGP Gyoshotai', 'shapeshifter' ),
					'HG正楷書体-PRO' => esc_html__( 'HG Seikaishotai-PRO', 'shapeshifter' ),
					'"Jenkins v2.0"' => esc_html__( 'Jenkins v2.0', 'shapeshifter' ),
					'Script' => esc_html__( 'Script', 'shapeshifter' ),
				# Japanese
					'"MS UI Gothic"' => esc_html__( 'MS UI Gothic', 'shapeshifter' ),
					'"MS PGothic", "ＭＳ Ｐゴシック"' => esc_html__( 'MS PGothic', 'shapeshifter' ),
					'"MS Gothic", "ＭＳ ゴシック"' => esc_html__( 'MS Gothic', 'shapeshifter' ),
					'"MS PMincho", "ＭＳ Ｐ明朝"' => esc_html__( 'MS PMincho', 'shapeshifter' ),
					'"MS Mincho", "ＭＳ 明朝"' => esc_html__( 'MS Mincho', 'shapeshifter' ),
					'"Meiryo", "メイリオ"' => esc_html__( 'Meiryo', 'shapeshifter' ),
					'"Meiryo UI"' => esc_html__( 'Meiryo UI', 'shapeshifter' ),
					'"Yu Gothic", "游ゴシック"' => esc_html__( 'Yu Gothic', 'shapeshifter' ),
					'"Yu Mincho", "游明朝"' => esc_html__( 'Yu Mincho', 'shapeshifter' ),
					'"Hiragino Kaku Gothic Pro", "ヒラギノ角ゴ Pro W3"' => esc_html__( 'Hiragino Kaku Gothic Pro', 'shapeshifter' ),
					'"HiraKakuProN-W3", "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3"' => esc_html__( '"HiraKakuProN-W3", "Hiragino Kaku Gothic ProN"', 'shapeshifter' ),
					'"HiraKakuPro-W6", "ヒラギノ角ゴ Pro W6"' => esc_html__( 'HiraKakuPro-W6', 'shapeshifter' ),
					'"HiraKakuProN-W6", "HiraKakuProN-W6", "ヒラギノ角ゴ ProN W6"' => esc_html__( '"HiraKakuProN-W6", "HiraKakuProN-W6"', 'shapeshifter' ),
					'"Hiragino Kaku Gothic Std", "ヒラギノ角ゴ Std W8"' => esc_html__( 'Hiragino Kaku Gothic Std', 'shapeshifter' ),
					'"Hiragino Kaku Gothic StdN", "ヒラギノ角ゴ StdN W8"' => esc_html__( 'Hiragino Kaku Gothic StdN', 'shapeshifter' ),
					'"Hiragino Maru Gothic Pro", "ヒラギノ丸ゴ Pro W4"' => esc_html__( 'Hiragino Maru Gothic Pro', 'shapeshifter' ),
					'"Hiragino Maru Gothic ProN", "ヒラギノ丸ゴ ProN W4"' => esc_html__( 'Hiragino Maru Gothic ProN', 'shapeshifter' ),
					'"Hiragino Mincho Pro", "ヒラギノ明朝 Pro W3"' => esc_html__( 'Hiragino Mincho Pro', 'shapeshifter' ),
					'"HiraMinProN-W3", "Hiragino Mincho ProN", "ヒラギノ明朝 ProN W3"' => esc_html__( '"HiraMinProN-W3", "Hiragino Mincho ProN"', 'shapeshifter' ),
					'"HiraMinPro-W6", "ヒラギノ明朝 Pro W6"' => esc_html__( 'HiraMinPro-W6', 'shapeshifter' ),
					'"HiraMinProN-W6", "HiraMinProN-W6", "ヒラギノ明朝 ProN W6"' => esc_html__( '"HiraMinProN-W6", "HiraMinProN-W6"', 'shapeshifter' ),
					'"YuGothic", "游ゴシック体"' => esc_html__( 'YuGothic', 'shapeshifter' ),
					'"YuMincho", "游明朝体"' => esc_html__( 'YuMincho', 'shapeshifter' ),
					'Osaka' => esc_html__( 'Osaka', 'shapeshifter' ),
					'"Osaka-Mono", "Osaka－等幅"' => esc_html__( 'Osaka-Mono', 'shapeshifter' ),
					'"Droid Sans"' => esc_html__( 'Droid Sans', 'shapeshifter' ),
					'Roboto' => esc_html__( 'Roboto', 'shapeshifter' )
			) );

		}

		/**
		 * Get Background Size for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_background_size() {

			return array(
				'auto' => esc_html( 'Auto', 'shapeshifter' ),
				'cover' => esc_html( 'Cover', 'shapeshifter' ),
				'contain' => esc_html( 'Contain', 'shapeshifter' ),
			);

		}

		/**
		 * Get Background Position Row for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_background_position_row() {

			return array(
				'center' => esc_html__( 'Center', 'shapeshifter' ),
				'top' => esc_html__( 'Top', 'shapeshifter' ),
				'bottom' => esc_html__( 'Bottom', 'shapeshifter' ),
			);

		}

		/**
		 * Get Background Position Column for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_background_position_column() {

			return array(
				'center' => esc_html__( 'Center', 'shapeshifter' ),
				'left' => esc_html__( 'Left', 'shapeshifter' ),
				'right' => esc_html__( 'Right', 'shapeshifter' ),
			);

		}

		/**
		 * Get Background Repeat for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_background_repeats() {

			return array(
				'no-repeat' => esc_html__( 'No Repeat', 'shapeshifter' ),
				'repeat' => esc_html__( 'Repeat', 'shapeshifter' ),
				'repeat-x' => esc_html__( 'Horizontal Repeat', 'shapeshifter' ),
				'repeat-y' => esc_html__( 'Vertical Repeat', 'shapeshifter' ),
			);

		}

		/**
		 * Get Background Image Attachment for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_background_attachments() {

			return array(
				'scroll' => esc_html__( 'Scroll', 'shapeshifter' ),
				'fixed' => esc_html__( 'Fixed', 'shapeshifter' ),
			);

		}

		# Footer Credit Type
		/**
		 * Get Footer Credit Types for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_credit_types() {

			return array(
				'none' => esc_html__( 'Not Display', 'shapeshifter' ),
				'all' => esc_html__( 'All Right Reserved', 'shapeshifter' ),
				'cc-by' => esc_html__( 'CC-BY', 'shapeshifter' ),
				'cc-by-sa' => esc_html__( 'CC-BY-SA', 'shapeshifter' ),
				'cc-by-nd' => esc_html__( 'CC-BY-ND', 'shapeshifter' ),
				'cc-by-nc' => esc_html__( 'CC-BY-NC', 'shapeshifter' ),
				'cc-by-nc-sa' => esc_html__( 'CC-BY-NC-SA', 'shapeshifter' ),
				'cc-by-nc-nd' => esc_html__( 'CC-BY-NC-ND', 'shapeshifter' ),
				'cc0' => esc_html__( 'CC0', 'shapeshifter' ),
				'public' => esc_html__( 'Public Domain', 'shapeshifter' ),
			);

		}

		/**
		 * Get Footer Aligns for ShapeShifter Theme Mods in Array
		 * 
		 * @return array
		**/
		public static function get_shapeshifter_theme_mods_choices_footer_aligns() {

			return array(
				'center' => esc_html__( 'Center', 'shapeshifter' ),
				'left' => esc_html__( 'Left', 'shapeshifter' ),
				'right' => esc_html__( 'Right', 'shapeshifter' ),
			);

		}

	}
}

// After Defining Class ShapeShifter_Theme_Mods
shapeshifter_after_define_class_theme_mods();


<?php
# Check if This is read by WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'ShapeShifter_Styles_Handler' ) ) {
	/**
	 * ShapeShifter Styles Handler
	 * 
	**/
	class ShapeShifter_Styles_Handler {

		#
		# Vars
		#
			// Styles
				/**
				 * Styles
				 * 
				 * @var $style
				**/
				public $styles = array();

			// Theme Mods
				/**
				 * Theme Mods
				 * 
				 * @var $theme_mods
				**/
				public $theme_mods = array();

			// Options
				/**
				 * Options
				 * 
				 * @var $options
				**/
				public $options = array();

			// Fonts
				/**
				 * Font Families
				 * 
				 * @var $font_families
				**/
				public $font_families;

				/**
				 * Font Face Style
				 * 
				 * @var $font_face_style
				**/
				public $font_face_style;

			// Screens
				/**
				 * Devices
				 * 
				 * @var $devices
				**/
				public $devices = array();

				/**Break Points
				 * 
				 * @var $break_points
				**/
				public $break_points = array();

			// Content Width

		/**
		 * Constructor
		**/
		function __construct() {

			// Setup Vars
			$this->setup_vars();

		}

		/**
		 * Setup Vars
		**/
		function setup_vars() {

			// Theme Mods 
				$this->theme_mods = ShapeShifter_Theme_Mods::get_theme_mods( SHAPESHIFTER_MAYBE_CHILD_THEME_OPTIONS );
				$this->sidebar_left_width = absint( $this->theme_mods[ 'sidebar_left_max_width' ] );
				$this->content_inner_width = absint( $this->theme_mods[ 'main_content_max_width' ] );
				$this->sidebar_right_width = absint( $this->theme_mods[ 'sidebar_right_max_width' ] );
				$this->content_width = $this->sidebar_left_width + $this->content_inner_width + $this->sidebar_right_width;

			// Screens
				$this->devices = array( 'pc', 'mobile' );
				$this->break_points = (
					shapeshifter_boolval( $this->theme_mods['is_responsive'] )
					? array( 
						'common', 
						320, 
						640, 
						1024
					)
					: array(
						'common'
					)
				);

			// Set Theme Mods
				//$this->set_styles();

		}

		/**
		 * Escape and Shorten the Style Code
		 * 
		 * @param string $style
		**/
		function escape_and_shorten( $style ) {

			$style = wp_strip_all_tags( $style, true );

			return $style;

		}

		/**
		 * Set Styles
		**/
		function set_styles() {

			$this->styles = array();

			foreach( $this->devices as $index => $device ) {

				$this->styles[ $device ] = array();

				$style = '';

				foreach( $this->break_points as $index => $break_point ) {

					//if ( $break_point !== 'common' ) continue;

					$this->styles[ $device ]['screen_' . $break_point ] = '';

					$this->styles[ $device ]['screen_' . $break_point ] .= '@media screen' . ( 
						$break_point !== 'common' 
						? ' and ( max-width: ' . $break_point . 'px )' 
						: '' 
					) . ' {' . PHP_EOL;

						$this->styles[ $device ]['screen_' . $break_point ] .= apply_filters(
							'shapeshifter_' . $device . '_' . $break_point . '_customized_style',
							call_user_func_array( 
								array( $this, 'get_' . $break_point . '_styles' ), 
								array( $device, $break_point ) 
							),
							$device,
							$break_point
						);

					$this->styles[ $device ]['screen_' . $break_point ] .= PHP_EOL . '}' . PHP_EOL;

					$style .= apply_filters( 'shapeshifter_filter_mods_styles_device_breakpoint', $this->styles[ $device ][ 'screen_' . $break_point ], $device, $break_point );

				}

				if( shapeshifter_boolval( $this->theme_mods['is_responsive'] ) ) {
					$style .= $this->get_common_responsive_styles();
				}

				$this->styles[ $device ]['total'] = $this->escape_and_shorten( apply_filters( 'shapeshifter_filter_mods_styles_device', $style, $device ) );

			}

		}

			/**
			 * Common Styles
			 * 
			 * @param string $device
			 * @param string $break_point
			 * 
			 * @param string
			**/
			function get_common_styles( $device = 'pc', $break_point = 'common' ) {

				# PC
					if ( $device === 'pc' ) {

						# Font Face
							$style = '';
						# Body
							$style .= $this->get_common_body_styles( $device, $break_point );
						# Header
							$style .= $this->get_common_header_styles( $device, $break_point );
						# Contents
							$style .= $this->get_common_contents_styles( $device, $break_point );
						# Footer
							$style .= $this->get_common_footer_styles( $device, $break_point );
						# Widget Areas
							$style .= $this->get_common_widget_areas_styles( $device, $break_point );
						# Others
							$style .= $this->get_common_others_styles( $device, $break_point );

						# Plugins
							# WooCommerce
								$style .= $this->get_common_wc_styles( $device, $break_point );
							# bbPress
								$style .= $this->get_common_bbpress_styles( $device, $break_point );
							# BuddyPress
								$style .= $this->get_common_buddypress_styles( $device, $break_point );

					}

				# Mobile
					if ( $device === 'mobile' ) {
						$style = $this->get_common_mobile_styles( $device, $break_point );
					}

				# Return
					return $style;

			}

				/**
				 * Body
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_body_styles( $device = 'pc', $break_point = 'common' ) {

					global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max, $shapeshifter_content_width;

					$style = ' /* Body */';

					$style .= '
						body {
							' . esc_attr(
								! SHAPESHIFTER_IS_MOBILE
								? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px;'
								: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px;'
							) . '
						}
						q:before {
							content: "' . _x( '\"', 'Before Q Tag', 'shapeshifter' ) . '";
						}
						q:after {
							content: "' . _x( '\"', 'After Q Tag', 'shapeshifter' ) . '";
						}

						.shapeshifter-outer-wrapper {
							' . $this->get_font_family_style( $this->theme_mods[ 'text_font_family' ] ) . '
							' . esc_attr(
								! SHAPESHIFTER_IS_MOBILE
								? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px;'
								: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px;'
							) . '
						}
					';

					return $style;

				}

				/**
				 * Header
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_header_styles( $device = 'pc', $break_point = 'common' ) {

					global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max, $shapeshifter_content_width;

					$style = '';

					$style .= '
						header.shapeshifter-header-nav-visible {
							' . $this->get_background_color_style( $this->theme_mods[ 'header_background_color' ] ) . '
							' . esc_attr(
								! SHAPESHIFTER_IS_MOBILE
								? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px'
								: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px'
							) . '
						}
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p{
							' . $this->get_font_family_style( $this->theme_mods[ 'header_site_name_font_family' ], true ) . '
						}
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:link,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:visited,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:link,
						header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:visited {
							' . $this->get_color_style( $this->theme_mods[ 'header_site_name_color' ] ) . '
						}
						header.shapeshifter-header-nav-visible #shapeshifter-header-description-p {
							' . $this->get_font_family_style( $this->theme_mods[ 'header_site_description_font_family' ], true ) . '
							' . $this->get_color_style( $this->theme_mods[ 'header_site_description_color' ] ) . '
						}

						.shapeshifter-header-inner-wrapper {
							' . esc_attr(
								! SHAPESHIFTER_IS_MOBILE
								? 'max-width: ' . absint( $shapeshifter_content_width ) . 'px'
								: ''
							) . '
						}
					';

					$style .= $this->get_common_top_nav_menu_styles( $device, $break_point );

					$style .= $this->get_common_logo_background_styles( $device, $break_point );
					$style .= $this->get_common_logo_styles( $device, $break_point );

					$style .= $this->get_nav_main_styles( $device, $break_point );


					return $style;

				}

					/**
					 * Top Nav Menu
					**/
					function get_common_top_nav_menu_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '';

						$style .= $this->get_common_top_nav_main_menu_styles( $device, $break_point );

						$style .= $this->get_common_top_nav_sub_menu_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Main Menu
						**/
						function get_common_top_nav_main_menu_styles( $device = 'pc', $break_point = 'common' ) {

							global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max;
					
							$style = '';

							$style .= '

								/* Wrapper
								-------------------------------------------------------------- */ 
								.shapeshifter-main-nav-wrapper-div {
									' . $this->get_number_style( 'max-width', $shapeshifter_content_width, '', 'px', 'absint' ) . '
								}
								/* Depth 0 */
									ul.shapeshifter-top-nav-menu {
										' . $this->get_number_style( 'max-width', $this->content_width, '', 'px', 'absint' ) . '
									}
									ul.shapeshifter-top-nav-menu > li.menu-item {
										' . $this->get_font_family_style( $this->theme_mods[ 'header_top_nav_menu_font_family' ], true ) . '
									}
									ul.shapeshifter-top-nav-menu li.menu-item > a,
									ul.shapeshifter-top-nav-menu li.menu-item > a:link,
									ul.shapeshifter-top-nav-menu li.menu-item > a:visited {
										' . $this->get_color_style( $this->theme_mods[ 'header_top_nav_menu_text_color' ] ) . '
									}
							';

							return $style;

						}

						/**
						 * Sub and after Sub
						**/
						function get_common_top_nav_sub_menu_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';

							$style .= '
								/* Depth 1 */
									ul.shapeshifter-top-nav-menu > li.menu-item > a + ul.sub-menu > li.menu-item {
										' . $this->get_background_color_style( $this->theme_mods[ 'header_background_color' ] ) . '
									}
							';

							return $style;

						}

					/**
					 * Logo Background
					**/
					function get_common_logo_background_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '
						';

						return $style;

					}

					/**
					 * Logo
					**/
					function get_common_logo_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '
						';

						return $style;

					}

					/**
					 * Nav Menu
					**/
					function get_nav_main_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '

							nav.shapeshifter-main-regular-nav {
								' . $this->get_font_family_style( $this->theme_mods[ 'nav_text_font_family' ] ) . '

								border-top:solid ' . $this->esc_color_value( $this->theme_mods[ 'header_image_and_nav_border_color' ] ) . ' 1px;
								border-bottom:solid ' . $this->esc_color_value( $this->theme_mods[ 'header_image_and_nav_border_color' ] ) . ' 1px;

								box-shadow: 0 2px 4px ' . $this->esc_color_value( $this->theme_mods[ 'header_image_and_nav_border_color' ] ) . ';

								' . ( 
									shapeshifter_boolval( $this->theme_mods[ 'nav_background_gradient_on' ] )
									? 'background:linear-gradient(' . ( 
										isset( $this->theme_mods[ 'main_content_background_color' ] )
										? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
										: ( 
											isset( $this->theme_mods[ 'content_area_background_color' ] )
											? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
											: '#FFFFFF'
										)
									) . ',
										' . $this->esc_color_value( $this->theme_mods[ 'nav_background_color' ] ) . ');
											background: -webkit-gradient(
												linear,
												left top,
												left bottom,
												from(' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . '),
												to(' . $this->esc_color_value( $this->theme_mods[ 'nav_background_color' ] ) . ')
											);
											background: -moz-linear-gradient(
												top,
											' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] ) 
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'nav_background_color' ] ) . '
											);'
									: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'nav_background_color' ] ) . ';'
								) . '

								' . $this->get_background_image_style( $this->theme_mods[ 'nav_menu_background_image' ] ) . '
							}
							nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-div > ul.shapeshifter-main-nav-menu {

							}
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item {
								' . ( 
									shapeshifter_boolval( $this->theme_mods[ 'nav_items_background_gradient_on' ] )
									? 'background:linear-gradient(
										' . ( 
											$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
											? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
											: ( 
												$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] ) 
												? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
												: '#FFFFFF'
											)
										) . ',
										' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
										);
										background: -webkit-gradient(
											linear,
											left top,
											left bottom,
											from(' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . '),
											to(' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ')
										);
										background: -moz-linear-gradient(
											top,
										' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
										) . ',
										' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
										);'
									: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ';'
								) . '
							}
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > #nav-menu-search-box {
								display:' . ( 
									shapeshifter_boolval( $this->theme_mods[ 'nav_menu_add_search_box' ] )
									? 'block' 
									: 'none' 
								) . ';
							}
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a:link,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a:visited {
								' . ( 
									$this->esc_color_value( $this->theme_mods[ 'nav_items_selected_border_color' ] ) != '' 
									? 'border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'nav_items_selected_border_color' ] ) . ' 2px;' 
									: '' 
								) . '
							}

							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item a,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item a:link,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item a:visited{
								' . $this->get_color_style( $this->theme_mods[ 'nav_font_color' ] ) . '
							}
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a:link,
							nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a:visited {
								' . ( 
									$this->esc_color_value( $this->theme_mods[ 'nav_items_selected_border_color' ] ) 
									? 'border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'nav_items_selected_border_color' ] ) . ' 1px;' 
									: '' 
								) . '
							}
						';

						$style .= $this->get_nav_sub_styles( $device, $break_point );

						$style .= $this->get_nav_after_sub_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Sub Menu
						**/
						function get_nav_sub_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '

								nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item {
									' . ( 
										shapeshifter_boolval( $this->theme_mods[ 'nav_items_background_gradient_on' ] )
										? 'background:linear-gradient(
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
											);
											background: -webkit-gradient(
												linear,
												left top,
												left bottom,
												from(' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . '),
												to(' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ')
											);
											background: -moz-linear-gradient(
												top,
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] ) 
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
											);'
										: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ';'
									) . '
								}
								nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item > a {
									' . ( 
										shapeshifter_boolval( $this->theme_mods[ 'nav_items_background_gradient_on' ] )
										? 'background:linear-gradient(
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
											);
											background: -webkit-gradient(
												linear,
												left top,
												left bottom,
												from(' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . '),
												to(' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ')
											);
											background: -moz-linear-gradient(
												top,
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . '
											);'
										: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'nav_items_background_color' ] ) . ';'
									) . '
								}
							';
							return $style;

						}

						/**
						 * After Sub Menu
						**/
						function get_nav_after_sub_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

				/**
				 * Contents
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_contents_styles( $device = 'pc', $break_point = 'common' ) {

					global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max, $shapeshifter_content_width;

					if ( ! isset( $shapeshifter_is_one_column_page_width_size_max ) )
						$shapeshifter_is_one_column_page_width_size_max = get_theme_mod( 'is_one_column_main_content_max_width_on', false );

					$style = '';

					$style .= '
						.content-area {
							/* Background */
								' . $this->get_background_color_style( $this->theme_mods[ 'content_area_background_color' ] ) . '
								' . $this->get_background_image_style( $this->theme_mods[ 'content_area_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'content_area_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'content_area_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'content_area_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'content_area_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'content_area_background_image_attachment' ] ) . '
						}

						.content-outer {
							' . $this->get_background_color_style( $this->theme_mods[ 'content_outer_background_color' ] ) . '
							max-width:' . esc_attr(
								//get_theme_mod( 'is_one_column_main_content_max_width_on', false )
								$shapeshifter_is_one_column_page_width_size_max
								? ( 
									absint( get_theme_mod( 'main_content_max_width', 660 ) ) === ( $shapeshifter_content_width - 210 )
									? '100%'
									: $shapeshifter_content_width . 'px'
								)
								: $shapeshifter_content_width . 'px'
							) . ';
						}

						.content-inner{
							/* Background */
								' . $this->get_background_color_style( $this->theme_mods[ 'main_content_background_color' ] ) . '
								' . $this->get_background_image_style( $this->theme_mods[ 'main_content_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'main_content_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'main_content_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'main_content_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'main_content_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'main_content_background_image_attachment' ] ) . '

							border-width:' . ( 
								shapeshifter_boolval( $this->theme_mods[ 'is_content_border_on' ] )
								? 1 
								: 0 
							) . 'px;

							border-radius:' . absint( $this->theme_mods[ 'main_content_border_radius' ] ) . 'px;

							max-width:' . esc_attr( 
								//get_theme_mod( 'is_one_column_main_content_max_width_on', false )
								$shapeshifter_is_one_column_page_width_size_max
								? ( 
									absint( get_theme_mod( 'main_content_max_width', 660 ) ) === ( $shapeshifter_content_width - 210 )
									? '100%'
									: $shapeshifter_content_inner_width . 'px'
								)
								: $shapeshifter_content_inner_width . 'px'
							) . ';
						}
					';

					$style .= $this->get_common_archive_page_styles( $device, $break_point );
					$style .= $this->get_common_content_page_styles( $device, $break_point );

					return $style;

				}

					/**
					 * Archive Page
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_archive_page_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '';

						$style .= $this->get_common_archive_title_styles( $device, $break_point );
						$style .= $this->get_common_archive_items_list_styles( $device, $break_point );
						$style .= $this->get_common_archive_items_list_title_styles( $device, $break_point );
						$style .= $this->get_common_archive_items_list_infos_styles( $device, $break_point );
						$style .= $this->get_common_archive_items_pager_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Title
						**/
						function get_common_archive_title_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
							';
							return $style;
						}

						/**
						 * List
						**/
						function get_common_archive_items_list_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
								.post-list-div {
									/* Border */
										border-radius:' . absint( $this->theme_mods[ 'archive_page_list_item_border_radius' ] ) . 'px;
										border-top-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_top_on' ] ) ? 1 : 0 ) . 'px;
										border-left-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_left_on' ] ) ? 1 : 0 ) . 'px;
										border-right-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_right_on' ] ) ? 1 : 0 ) . 'px;
										border-bottom-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_bottom_on' ] ) ? 1 : 0 ) . 'px;

									/* Background */
										' . $this->get_background_image_style( $this->theme_mods[ 'archive_page_post_list_title_background_image' ] ) . '
								}
							';
							return $style;
						}

						/**
						 * List Title
						**/
						function get_common_archive_items_list_title_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
								.post-list-title-div{
									' . $this->get_background_image_style( $this->theme_mods[ 'archive_page_post_list_title_background_image' ] ) . '
								}
								.post-list-title-div .post-list-title-div-h2 {
									' . $this->get_font_family_style( $this->theme_mods[ 'archive_page_post_list_title_font_family' ] ) . '

									' . ( 
										$this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_text_shadow' ] ) != '' 
										? 'text-shadow: 0 0 .5em ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_text_shadow' ] ) . ';'
										: ''
									) . '
									font-size:' . absint( $this->theme_mods[ 'archive_page_post_list_title_font_size' ] ) . 'px;

									' . ( 
										shapeshifter_boolval( $this->theme_mods[ 'archive_page_post_list_title_background_gradient_on' ] )
										? 'background:linear-gradient(
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . '
											);
											background: -webkit-gradient(
												linear,
												left top,
												left bottom,
												from(' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . '),
												to(' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . ')
											);
											background: -moz-linear-gradient(
												top,
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] ) 
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . '
											);'
										: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . ';'
									) . '
									border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_bottom_color' ] ) . ' 1px;
									border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_left_color' ] ) . ' 1px;
									border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_right_color' ] ) . ' 1px;
								}

								.post-list-title-div .post-list-title-div-h2:before{
									' . ( 
										$this->esc_fontawesome_icon_value( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_select' ] ) != 'none' 
										? 'content: "' . '\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_select' ] ) . '";'
										: '' 
									) . '
									' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_color' ] ) . '
								}

								.post-list-title-a,
								.post-list-title-a:link,
								.post-list-title-a:visited {
									' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_title_text_color' ] ) . '
								}
							';
							return $style;
						}

						/**
						 * List Infos
						**/
						function get_common_archive_items_list_infos_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
								/* Thumbnail */
									.bloginfo-thumbnail {
										width:' . ( ( 
											absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
											? absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
											: 80 
										) + 50 ) . 'px;
									}
									.post-list-bloginfo-div .post-list-thumbnail-a {
										border-radius:' . ( 
											absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
											? absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] ) 
											: 0 
										) . 'px;
									}
									.post-list-thumbnail,
									.post-list-def-thumbnail {
										width:' . ( 
											absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
											? absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
											: 80 
										) . 'px;
										height:' . ( 
											absint( $this->theme_mods[ 'archive_page_post_thumbnail_height' ] )
											? absint( $this->theme_mods[ 'archive_page_post_thumbnail_height' ] )
											: 80 
										) . 'px;
										border-radius:' . ( 
											absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
											? absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
											: 0 
										) . 'px;
									}
								/* Description */
									.bloginfo-description a,.bloginfo-description a:link,.bloginfo-description a:visited{
										' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_text_link_color' ] ) . '
									}
									.bloginfo-p-time,
									.post-list-read-later-p,
									.bloginfo-excerpt {
										' . $this->get_color_style( $this->theme_mods[ 'archive_page_text_color' ] ) . '
									}
									.bloginfo-excerpt a,
									.bloginfo-excerpt a:link,
									.bloginfo-excerpt a:visited{
										' . $this->get_color_style( $this->theme_mods[ 'archive_page_text_link_color' ] ) . '
									}
									.bloginfo-excerpt .read-more-for-post-list {
										border: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_text_link_color' ] ) . ' 1px;
									}
									.bloginfo-excerpt .read-more-for-post-list:hover {
										' . $this->get_background_color_style( $this->theme_mods[ 'archive_page_text_link_color' ] ) . '
									}

								/* Read Later */
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-twitter-icon-li,
									.post-list-read-later-sns > li.shapeshifter-post-list-twitter-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_twitter' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-facebook-icon-li,
									.post-list-read-later-sns > li.shapeshifter-post-list-facebook-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_facebook' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-googleplus-icon-li,
									.post-list-read-later-sns > li.shapeshifter-post-list-googleplus-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_googleplus' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-hatena-icon-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_hatena' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns > li.shapeshifter-post-list-hatena-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_hatena' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-pocket-icon-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_pocket' ] )
											? '' 
											: 'display: none;' 
										) . '
									}
									.post-list-read-later-sns > li.shapeshifter-post-list-pocket-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_pocket' ] )
											? '' 
											: 'display:none;' 
										) . '
									}
									.post-list-read-later-sns-icons > li.shapeshifter-post-list-line-icon-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_line' ] ) 
											? '' 
											: 'display:none;' 
										) . '
									}
									.post-list-read-later-sns > li.shapeshifter-post-list-line-button-li{
										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_line' ] )
											? '' 
											: 'display:none;' 
										) . '
									}

							';
							return $style;
						}

						/**
						 * List Pager
						**/
						function get_common_archive_items_pager_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
								.pagination{
									max-width: ' . absint( $this->content_inner_width ) . 'px;
								}
							';
							return $style;
						}

					/**
					 * Singular Page
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_content_page_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '
							.shapeshifter-content {
								' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
							}
						';

						$style .= $this->get_common_content_page_title_styles( $device, $break_point );
						$style .= $this->get_common_content_page_infos_styles( $device, $break_point );
						$style .= $this->get_common_content_text_styles( $device, $break_point );
						$style .= $this->get_common_content_items_styles( $device, $break_point );
						$style .= $this->get_common_content_page_links_styles( $device, $break_point );
						$style .= $this->get_common_content_comments_styles( $device, $break_point );
						$style .= $this->get_common_content_prev_next_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Title
						**/
						function get_common_content_page_title_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
								.shapeshifter-singular-title-wrapper {
									' . ( 
										shapeshifter_boolval( $this->theme_mods[ 'singular_page_h1_background_gradient_on' ] )
										? 'background:linear-gradient(
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . '
											);
											background: -webkit-gradient(
												linear,
												left top,
												left bottom,
												from(' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . '),
												to(' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . ')
											);
											background: -moz-linear-gradient(
												top,
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
												? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
												: ( 
													$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
													: '#FFFFFF'
												)
											) . ',
											' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . '
											);'
										: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . ';'
									) . '

									' . $this->get_background_image_style( $this->theme_mods[ 'singular_page_h1_background_image' ] ) . '
									border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_bottom_color' ] ) . ' 1px;
									border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_left_color' ] ) . ' 1px;
									border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_right_color' ] ) . ' 1px;

								}
								.shapeshifter-singular-title-wrapper h1.entry-title,
								.shapeshifter-singular-title-wrapper h2.entry-title {
									' . $this->get_font_family_style( $this->theme_mods[ 'singular_page_h1_font_family' ] ) . '
									font-size:' . absint( $this->theme_mods[ 'singular_page_h1_font_size' ] ) . 'px;

									' . ( 
										$this->esc_color_value( $this->theme_mods[ 'singular_page_h1_text_shadow' ] ) != '' 
										? 'text-shadow: 0 0 .5em ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_text_shadow' ] ) . ';'
										: ''
									) . '
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_h1_text_color' ] ) . '
								}
								.shapeshifter-singular-title-wrapper h1.entry-title:before,
								.shapeshifter-singular-title-wrapper h2.entry-title:before {
									' . ( 
										! in_array( 
											$this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_select' ] ), 
											array( '', 'none' )
										) 
										? 'content: "\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_select' ] ) . '";'
										: '' 
									) . '
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_color' ] ) . '
								}
							';
							return $style;
						}

						/**
						 * Infos
						**/
						function get_common_content_page_infos_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								.blogbox{
									' . $this->get_background_color_style( $this->theme_mods[ 'singular_page_bloginfo_background_color' ] ) . '
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_bloginfo_text_color' ] ) . '
								}
								.blogbox a,
								.blogbox a:link,
								.blogbox a:visited{
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_bloginfo_text_link_color' ] ) . '
								}

								.shapeshifter-singular-blogbox-post{
									display:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_not_single_meta_visible' ] ) ? 'none' : 'block' ) . ';
								}
								.shapeshifter-singular-blogbox-page{
									display:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_not_page_meta_visible' ] ) ? 'none' : 'block' ) . ';
								}
							';
							return $style;

						}

						/**
						 * Content Text
						**/
						function get_common_content_text_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								.shapeshifter-content p {
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
								}
								.shapeshifter-content a,
								.shapeshifter-content a:link,
								.shapeshifter-content a:visited,
								.shapeshifter-content a.bbp-topic-permalink,
								.shapeshifter-content a.bbp-topic-permalink:link,
								.shapeshifter-content a.bbp-topic-permalink:visited {
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_link_color' ] ) . '
								}
							';
							$headers = array( 'h2', 'h3', 'h4', 'h5', 'h6', 'p' );
							foreach( $headers as $index => $header ) {
								$style .= '
									.shapeshifter-content ' . $header . '{

										' . ( 
											$header !== 'p'
											? 'clear: both;'
											: ''
										) . '

										' . $this->get_font_family_style( $this->theme_mods[ 'singular_page_' . $header . '_font_family' ] ) . '
										font-size:' . absint( $this->theme_mods[ 'singular_page_' . $header . '_font_size' ] ) . 'px;

										' . $this->get_color_style( $this->theme_mods[ 'singular_page_' . $header . '_text_color' ] ) . '
										' . ( 
											$this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_text_shadow' ] ) != '' 
											? 'text-shadow: 0 0 .5em ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_text_shadow' ] ) . ';'
											: ''
										) . '
										' . $this->get_background_image_style( $this->theme_mods[ 'singular_page_' . $header . '_background_image' ] ) . '
									}
								';
								if ( $header !== 'p' ) {

									$style .= '
										.shapeshifter-content ' . $header . ' {

											' . ( 
												shapeshifter_boolval( $this->theme_mods[ 'singular_page_' . $header . '_background_gradient_on' ] )
												? 'background:linear-gradient(
													' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: 'rgba(255,255,255,0)'
													) . ',
													' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . '
													);

													background: -webkit-gradient(
														linear,
														left top,
														left bottom,
														from(' . ( 
															$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															: 'rgba(255,255,255,0)'
														) . '),
														to(' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . ')
													);
													background: -moz-linear-gradient(
														top,
													' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] ) 
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: 'rgba(255,255,255,0)'
													) . ',
													' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . '
													);'
												: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . ';'
											) . '
											border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_bottom_color' ] ) . ' 1px;
											border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_left_color' ] ) . ' 1px;
											border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_right_color' ] ) . ' 1px;

										}
										.shapeshifter-content ' . $header . ':before {
											' . ( 
												! in_array( 
													$this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_select' ] ), 
													array( '', 'none' )
												) 
												? 'content: "\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_select' ] ) . '";'
												: '' 
											) . '
											' . $this->get_color_style( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_color' ] ) . '
										}

									';

								}
							}

							return $style;
						}

						/**
						 * Content Items
						**/
						function get_common_content_items_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								/* Quotes
								-------------------------------------------------------------- */
									.shapeshifter-content blockquote:before{
										content: "' . esc_html__( 'Quotes:', 'shapeshifter' ) . '";
									}

								/* Columns
								-------------------------------------------------------------- */
									@media screen and ( max-width: ' . $this->content_inner_width . 'px ) {
										.shapeshifter-content .shapeshifter-flex-wrapper {
											display: -webkit-flex;
											display: flex;
										}
											.shapeshifter-flex-wrapper > .col-1 {
												-webkit-flex-grow: 1;
												flex-grow: 1;
											}
											.shapeshifter-flex-wrapper > .col-2 {
												-webkit-flex-grow: 2;
												flex-grow: 2;
											}
											.shapeshifter-flex-wrapper > .col-3 {
												-webkit-flex-grow: 3;
												flex-grow: 3;
											}
											.shapeshifter-flex-wrapper > .col-4 {
												-webkit-flex-grow: 4;
												flex-grow: 4;
											}
											.shapeshifter-flex-wrapper > .col-5 {
												-webkit-flex-grow: 5;
												flex-grow: 5;
											}
											.shapeshifter-flex-wrapper > .col-6 {
												-webkit-flex-grow: 6;
												flex-grow: 6;
											}
									}

								/* Shortcodes
								-------------------------------------------------------------- */
									
							';
							return $style;

						}

						/**
						 * Page Links
						**/
						function get_common_content_page_links_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
							';
							return $style;
						}

						/**
						 * Comments
						**/
						function get_common_content_comments_styles( $device = 'pc', $break_point = 'common' ) {
							$style = '
							';
							return $style;
						}

						/**
						 * Prev Next
						**/
						function get_common_content_prev_next_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								div.single-page-prev-next{
									display:' . ( 
										shapeshifter_boolval( $this->theme_mods[ 'is_not_page_link_visible' ] )
										? 'none' 
										: 'block' 
									) . ';
								}

								p.prev-post-link-p,
								p.next-post-link-p {
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
								}

								p.prev-post-title-p,
								p.next-post-title-p {
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_link_color' ] ) . '
								}
							';
							return $style;
						}

				/**
				 * Footer
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_footer_styles( $device = 'pc', $break_point = 'common' ) {

					global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max, $shapeshifter_content_width;

					$style = '';

					$style .= '
						#footer {
							' . (
								! SHAPESHIFTER_IS_MOBILE
								? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px;'
								: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px;'
							) . '
						}

						#footer-items {
							' . $this->get_background_color_style( $this->theme_mods[ 'footer_background_color' ] ) . '
							' . $this->get_background_image_style( $this->theme_mods[ 'footer_background_image_select' ] ) . '
							' . $this->get_background_size_style( $this->theme_mods[ 'footer_background_image_size' ] ) . '
							' . $this->get_background_position_y_style( $this->theme_mods[ 'footer_background_image_position_row' ] ) . '
							' . $this->get_background_position_x_style( $this->theme_mods[ 'footer_background_image_position_column' ] ) . '
							' . $this->get_background_repeat_style( $this->theme_mods[ 'footer_background_image_repeat' ] ) . '
							' . $this->get_background_attachment_style( $this->theme_mods[ 'footer_background_image_attachment' ] ) . '
						}

						#footer-items p.footer-p {
							' . $this->get_font_family_style( $this->theme_mods[ 'footer_font_family' ] ) . '
							font-size:' . absint( $this->theme_mods[ 'footer_font_size' ] ) . 'px;
							text-align:' . $this->esc_footer_align( $this->theme_mods[ 'footer_align_select' ] ) . ';
							' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '
						}
						#footer-license {
							' . ( 
								$this->esc_credit_type( $this->theme_mods[ 'footer_display_credit_type' ] ) === 'none' 
								? 'display: none;' 
								: '' 
							) . '
						}

						#footer-items p#footer-nav-menu{
							display:' . ( 
								shapeshifter_boolval( $this->theme_mods[ 'footer_display_description' ] )
								? 'block' 
								: 'none' 
							) . ';
						}

						#footer-items p#footer-description{
							display:' . ( 
								shapeshifter_boolval( $this->theme_mods[ 'footer_display_description' ] )
								? 'block' 
								: 'none' 
							) . ';
						}

						#footer-items p#footer-theme{
							display:' . ( 
								shapeshifter_boolval( $this->theme_mods[ 'footer_display_theme' ] )
								? 'block' 
								: 'none' 
							) . ';
						}

						#footer-items a,
						#footer-items a:link,
						#footer-items a:visited{
							' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '
						}
					';

					return $style;

				}

				/**
				 * Widget Areas
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_widget_areas_styles( $device = 'pc', $break_point = 'common' ) {

					$style = '';

					$style .= $this->get_common_sidebar_type_styles( $device, $break_point );
					$style .= $this->get_common_sidebars_styles( $device, $break_point );

					$style .= $this->get_common_optional_widget_areas_styles( $device, $break_point );
					$style .= $this->get_common_widget_items_styles( $device, $break_point );

					return $style;

				}

					/**
					 * Sidebar Type
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_sidebar_type_styles( $device = 'pc', $break_point = 'common' ) {

						$style = $this->get_common_sidebar_left_styles( $device, $break_point );
						$style .= $this->get_common_sidebar_right_styles( $device, $break_point );

						return $style;
					}

						/**
						 * Sidebar Left
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_sidebar_left_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								.sidebar-left-container {
									max-width: ' . intval( $this->theme_mods[ 'sidebar_left_max_width' ] ) . 'px;
									' . $this->get_background_color_style( $this->theme_mods[ 'content_area_sidebar_left_container_background_color' ] ) . '
								}
								.slidebar-left-container-slide-box {
									' . $this->get_background_color_style( $this->theme_mods[ 'slidebar_left_background_color' ] ) . '
									' . $this->get_background_image_style( $this->theme_mods[ 'slidebar_left_background_image' ] ) . '
								}
								.slidebar-left-container-slide-box:hover {
									' . $this->get_background_color_style( $this->theme_mods[ 'slidebar_left_background_color' ], '#FFFFFF' ) . '
								}
							';
							return $style;
						}

						/**
						 * Sidebar Right
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_sidebar_right_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
								.sidebar-right-container {
									max-width: ' . absint( $this->theme_mods[ 'sidebar_right_max_width' ] ) . 'px;
									' . $this->get_background_color_style( $this->theme_mods[ 'content_area_sidebar_right_container_background_color' ] ) . '
								}
								.slidebar-right-container {
									' . $this->get_background_color_style( $this->theme_mods[ 'slidebar_right_background_color' ] ) . '
									' . $this->get_background_image_style( $this->theme_mods[ 'slidebar_right_background_image' ] ) . '
								}
								.slidebar-right-container:hover {
									' . $this->get_background_color_style( $this->theme_mods[ 'slidebar_right_background_color' ], '#FFFFFF' ) . '
								}
							';

							return $style;

						}

					/**
					 * Sidebars
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_sidebars_styles( $device = 'pc', $break_point = 'common' ) {
						
						$default_widget_areas_args = array(
							'slidebar_left' => 'slidebar-left',
							'sidebar_left' => 'sidebar-left',
							'sidebar_left_fixed' => 'sidebar-left-fixed',
							'slidebar_right' => 'slidebar-right',
							'sidebar_right' => 'sidebar-right',
							'sidebar_right_fixed' => 'sidebar-right-fixed',
							'mobile_sidebar' => 'mobile-sidebar'
						);

						$style = '';

						foreach( $default_widget_areas_args as $name => $class_fix ) {
							
							$style .= '
								div.widget-area-' . $class_fix . '{

									max-width: ' . (
										in_array( $name, array( 'sidebar_left', 'sidebar_left_fixed', 'sidebar_right', 'sidebar_right_fixed' ) )
										? ( 
											in_array( $name, array(
												'sidebar_left', 'sidebar_left_fixed'
											) )
											? intval( $this->theme_mods[ 'sidebar_left_max_width' ] )
											: intval( $this->theme_mods[ 'sidebar_right_max_width' ] )
										)
										: 300
									) . 'px;
								}

								ul.widget-area-' . $class_fix . '-ul{
								}
								li.widget-area-' . $class_fix . '-li{
									' . $this->get_font_family_style( $this->theme_mods[ $name . '_font_family' ] ) . '
									border-width:' . ( 
										shapeshifter_boolval( $this->theme_mods[ $name . '_widget_border' ] )
										? 1 
										: 0 
									) . 'px;
									border-radius:' . absint( $this->theme_mods[ $name . '_widget_border_radius' ] ) . 'px;

									' . $this->get_background_color_style( $this->theme_mods[ $name . '_background_color' ] ) . '
									' . $this->get_background_image_style( $this->theme_mods[ $name . '_outer_background_image' ] ) . '
									' . $this->get_background_size_style( $this->theme_mods[ $name . '_outer_background_image_size' ] ) . '
									' . $this->get_background_position_y_style( $this->theme_mods[ $name . '_outer_background_image_position_row' ] ) . '
									' . $this->get_background_position_x_style( $this->theme_mods[ $name . '_outer_background_image_position_column' ] ) . '
									' . $this->get_background_repeat_style( $this->theme_mods[ $name . '_outer_background_image_repeat' ] ) . '
									' . $this->get_background_attachment_style( $this->theme_mods[ $name . '_outer_background_image_attachment' ] ) . '

								}

								p.widget-area-' . $class_fix . '-p,
								h5.widget-area-' . $class_fix . '-h5 {
									' . $this->get_color_style( $this->theme_mods[ $name . '_title_color' ] ) . '
								}
								p.widget-area-' . $class_fix . '-p:before,
								h5.widget-area-' . $class_fix . '-h5:before {
									font-family: FontAwesome;
									' . (
										$this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_select' ] ) != 'none'
										? 'content:"\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_select' ] ) . '";'
										: ''
									) . '
									' . $this->get_color_style( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_color' ] ) . '
									margin-right: 10px;
								}

								.widget-area-' . $class_fix . '-li-div{

									' . $this->get_color_style( $this->theme_mods[ $name . '_text_color' ] ) . '

									' . $this->get_background_image_style( $this->theme_mods[ $name . '_inner_background_image' ] ) . '
									' . $this->get_background_size_style( $this->theme_mods[ $name . '_inner_background_image_size' ] ) . '
									' . $this->get_background_position_y_style( $this->theme_mods[ $name . '_inner_background_image_position_row' ] ) . '
									' . $this->get_background_position_x_style( $this->theme_mods[ $name . '_inner_background_image_position_column' ] ) . '
									' . $this->get_background_repeat_style( $this->theme_mods[ $name . '_inner_background_image_repeat' ] ) . '
									' . $this->get_background_attachment_style( $this->theme_mods[ $name . '_inner_background_image_attachment' ] ) . '

								}

								.widget-area-' . $class_fix . '-li-div a, .widget-area-' . $class_fix . '-li-div a:link,.widget-area-' . $class_fix . '-li-div a:visited{
									' . $this->get_color_style( $this->theme_mods[ $name . '_link_text_color' ] ) . '
								}

								.widget-area-' . $class_fix . '-li-div .widget-entry-excerpt {
									' . $this->get_color_style( $this->theme_mods[ $name . '_text_color' ] ) . '
								}

								ul.widget-area-' . $class_fix . '-ul li.cat-item:before,
								ul.widget-area-' . $class_fix . '-ul li.archive-list-item:before,
								ul.widget-area-' . $class_fix . '-ul ul.menu li.menu-item:before,
								ul.widget-area-' . $class_fix . '-ul li.page_item:before,
								ul.widget-area-' . $class_fix . '-ul li.recentcomments:before {
									font-family:FontAwesome;
									' . (
										$this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_select' ] ) != 'none'
										? 'content:"\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_select' ] ) . '";'
										: ''
									) . '
									' . $this->get_color_style( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_color' ] ) . '
									margin-right: 10px;
								}

							';
						}

						return $style;

					}

					/**
					 * Optional Widget Areas
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_optional_widget_areas_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '';

						$style .= $this->get_common_widget_after_header_styles( $device, $break_point );
						$style .= $this->get_common_widget_before_content_area_styles( $device, $break_point );
						$style .= $this->get_common_widget_before_footer_styles( $device, $break_point );

						return $style;

					}

						/**
						 * After Header
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_widget_after_header_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';

							return $style;

						}

						/**
						 * Before Content Area
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_widget_before_content_area_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';

							return $style;

						}

						/**
						 * Before Footer
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_widget_before_footer_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';
							return $style;
						}

					/**
					 * Widget Items
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_widget_items_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '';

						return $style;

					}

				/**
				 * Others
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_others_styles( $device = 'pc', $break_point = 'common' ) {

					$style = '';

					# Left Menu
						$style .= '
							.shapeshifter-mobile-regular-nav{
								' . $this->get_font_family_style( $this->theme_mods[ 'nav_text_font_family' ] ) . '
							}
							div.shapeshifter-mobile-nav-wrapper-div{

								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';

								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '

							}
						';
					# Right Menu
						$style .= '
							.shapeshifter-mobile-side-menu-aside{
								
								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';

								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '

							}
						';
					# Bottom Nav Menu Buttons
						$style .= '';

					return $style;

				}

				# Plugins
					/**
					 * WooCommerce
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_wc_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '
						';

						# Shop
							$style .= $this->get_common_wc_shop_styles( $device, $break_point );

						# Product
							$style .= $this->get_common_wc_product_styles( $device, $break_point );

						# Cart
							$style .= $this->get_common_wc_cart_styles( $device, $break_point );

						# Checkout
							$style .= $this->get_common_wc_checkout_styles( $device, $break_point );

						# My Account
							$style .= $this->get_common_wc_my_account_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Shop
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_wc_shop_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';
							return $style;

						}

						/**
						 * Product
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_wc_product_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';
							return $style;

						}

						/**
						 * Cart
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_wc_cart_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';
							return $style;

						}

						/**
						 * Checkout
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_wc_checkout_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';
							return $style;

						}

						/**
						 * My Account
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_wc_my_account_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '';

							# Nav Menu
								$style .= '';

							# Contents
								$style .= '';

									# Dashboard
										$style .= ''; 

									# Orders
										$style .= ''; 

									# Downnloads
										$style .= ''; 

									# Addresses
										$style .= '';

									# Account Info
										$style .= ''; 

							# Forms
								$style .= '';

							return $style;

						}

					/**
					 * BuddyPress
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_buddypress_styles( $device = 'pc', $break_point = 'common' ) {

						$style = '
						';

						# Activity
							$style .= $this->get_common_bp_activity_styles( $device, $break_point );

						# Profile
							$style .= $this->get_common_bp_profile_styles( $device, $break_point );

						# Notification
							$style .= $this->get_common_bp_notification_styles( $device, $break_point );

						# Forum
							$style .= $this->get_common_bp_forum_styles( $device, $break_point );

						# Settings
							$style .= $this->get_common_bp_settings_styles( $device, $break_point );

						return $style;

					}

						/**
						 * Activity
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_bp_activity_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

						/**
						 * Profile
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_bp_profile_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

						/**
						 * Notification
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_bp_notification_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

						/**
						 * Forum
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_bp_forum_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

						/**
						 * Settings
						 * 
						 * @param string $device
						 * @param string $break_point
						 * 
						 * @param string
						**/
						function get_common_bp_settings_styles( $device = 'pc', $break_point = 'common' ) {

							$style = '
							';

							return $style;

						}

					/**
					 * bbPress
					 * 
					 * @param string $device
					 * @param string $break_point
					 * 
					 * @param string
					**/
					function get_common_bbpress_styles( $device = 'pc', $break_point = 'common' ) {
						$style = '
						';
						return $style;
					}

				/**
				 * Mobile
				 * 
				 * @param string $device
				 * @param string $break_point
				 * 
				 * @param string
				**/
				function get_common_mobile_styles( $device = 'mobile', $break_point = 'common' ) {

					global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max, $shapeshifter_content_width;

					$style = '
					';
					# Body
						$style .= '
							body {
								' . esc_attr(
									! SHAPESHIFTER_IS_MOBILE
									? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px;'
									: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px;'
								) . '
							}
						';

					# Outer Wrapper
						$style .= '
							.shapeshifter-outer-wrapper{
								' . $this->get_font_family_style( $this->theme_mods[ 'text_font_family' ], true ) . '
							}
						';

					# Mobile Header
						$style .= '
							header.shapeshifter-header-nav-visible {
								' . $this->get_background_color_style( $this->theme_mods[ 'header_background_color' ] ) . '
								' . esc_attr(
									! SHAPESHIFTER_IS_MOBILE
									? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px'
									: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px'
								) . '
							}
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p{
								' . $this->get_font_family_style( $this->theme_mods[ 'header_site_name_font_family' ], true ) . '
							}
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:link,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:visited,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:link,
							header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:visited {
								' . $this->get_color_style( $this->theme_mods[ 'header_site_name_color' ] ) . '
							}
							header.shapeshifter-header-nav-visible #shapeshifter-header-description-p {
								' . $this->get_font_family_style( $this->theme_mods[ 'header_site_description_font_family' ], true ) . '
								' . $this->get_color_style( $this->theme_mods[ 'header_site_description_color' ] ) . '
							}
							.shapeshifter-header-inner-wrapper {
								' . esc_attr(
									! SHAPESHIFTER_IS_MOBILE
									? 'max-width: ' . absint( $shapeshifter_content_width ) . 'px'
									: ''
								) . '
							}
						';

						# Header Navi
							$style .= '
								header.shapeshifter-header-nav-visible {
									' . $this->get_background_color_style( $this->theme_mods[ 'header_background_color' ] ) . '
								}
								header.shapeshifter-header-nav-visible #header-site-name-h1 > a,
								header.shapeshifter-header-nav-visible #header-site-name-h1 > a:link,
								header.shapeshifter-header-nav-visible #header-site-name-h1 > a:visited,
								header.shapeshifter-header-nav-visible #header-site-name-p > a,
								header.shapeshifter-header-nav-visible #header-site-name-p > a:link,
								header.shapeshifter-header-nav-visible #header-site-name-p > a:visited {
									' . $this->get_color_style( $this->theme_mods[ 'header_site_name_color' ] ) . '
								}
								header.shapeshifter-header-nav-visible #header-description-p {
									' . $this->get_color_style( $this->theme_mods[ 'header_site_description_color' ] ) . '
								}
							';

						# After Header
						# Before Content Area
							$style .= '
							';

					# Content Area
						$style .= '
							.content-area {';

								# Background
									$style .= '
										' . $this->get_background_color_style( $this->theme_mods[ 'content_area_background_color' ] ) . '
										' . $this->get_background_image_style( $this->theme_mods[ 'content_area_background_image' ] ) . '
										' . $this->get_background_size_style( $this->theme_mods[ 'content_area_background_image_size' ] ) . '
										' . $this->get_background_position_y_style( $this->theme_mods[ 'content_area_background_image_position_row' ] ) . '
										' . $this->get_background_position_x_style( $this->theme_mods[ 'content_area_background_image_position_column' ] ) . '
										' . $this->get_background_repeat_style( $this->theme_mods[ 'content_area_background_image_repeat' ] ) . '
										' . $this->get_background_attachment_style( $this->theme_mods[ 'content_area_background_image_attachment' ] ) . '

							}

							.content-outer {

								' . $this->get_background_color_style( $this->theme_mods[ 'content_outer_background_color' ] ) . '
								max-width:' . esc_attr(
									//get_theme_mod( 'is_one_column_main_content_max_width_on', false )
									$shapeshifter_is_one_column_page_width_size_max
									? ( 
										absint( get_theme_mod( 'main_content_max_width', 660 ) ) === ( $shapeshifter_content_width - 210 )
										? '100%'
										: $shapeshifter_content_width . 'px'
									)
									: $shapeshifter_content_width . 'px'
								) . ';

							}

							.content-inner {

								' . $this->get_background_color_style( $this->theme_mods[ 'main_content_background_color' ] ) . '
								' . $this->get_background_image_style( $this->theme_mods[ 'main_content_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'main_content_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'main_content_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'main_content_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'main_content_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'main_content_background_image_attachment' ] ) . '

								border-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_content_border_on' ] ) ? 1 : 0 ) . 'px;

								border-radius:' . absint( $this->theme_mods[ 'main_content_border_radius' ] ) . 'px;

								max-width:' . esc_attr( 
									//get_theme_mod( 'is_one_column_main_content_max_width_on', false )
									$shapeshifter_is_one_column_page_width_size_max
									? ( 
										absint( get_theme_mod( 'main_content_max_width', 660 ) ) === ( $shapeshifter_content_width - 210 )
										? '100%'
										: $shapeshifter_content_inner_width . 'px'
									)
									: $shapeshifter_content_inner_width . 'px'
								) . ';

							}
						';

						# Archive
							$style .= '
								.post-list-div {
									border-radius:' . absint( $this->theme_mods[ 'archive_page_list_item_border_radius' ] ) . 'px;
									border-top-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_top_on' ] ) ? 1 : 0 ) . 'px;
									border-left-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_left_on' ] ) ? 1 : 0 ) . 'px;
									border-right-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_right_on' ] ) ? 1 : 0 ) . 'px;
									border-bottom-width:' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_is_border_bottom_on' ] ) ? 1 : 0 ) . 'px;

									' . $this->get_background_image_style( $this->theme_mods[ 'archive_page_post_list_title_background_image' ] ) . '
								}
							';

							# Title
								$style .= '
									.post-list-title-div {
										' . $this->get_background_image_style( $this->theme_mods[ 'archive_page_post_list_title_background_image' ] ) . '
									}
									.post-list-title-div .post-list-title-div-h2{
										' . $this->get_font_family_style( $this->theme_mods[ 'archive_page_post_list_title_font_family' ] ) . '

										font-size:' . ( absint( $this->theme_mods[ 'archive_page_post_list_title_font_size' ] ) - 4 ) . 'px;

										' . ( 
											shapeshifter_boolval( $this->theme_mods[ 'archive_page_post_list_title_background_gradient_on' ] )
											? 'background: -webkit-gradient(
													linear,
													left top,
													left bottom,
													from(' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: ( 
															$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															: '#FFFFFF'
														)
													) . '),
													to(' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . ')
												);
												background: -moz-linear-gradient(
													top,
												' . ( 
													$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
													: ( 
														$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
														: '#FFFFFF'
													)
												) . ',
												' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . '
												);'
											: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_background_color' ] ) . ';'
										) . '
										border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_bottom_color' ] ) . ' 1px;
										border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_left_color' ] ) . ' 1px;
										border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_post_list_title_border_right_color' ] ) . ' 1px;
									}
									.post-list-title-div .post-list-title-div-h2:before{
										font-family:FontAwesome;
										' . ( 
											$this->esc_fontawesome_icon_value( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_select' ] ) != 'none' 
											? 'content:"\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_select' ] ) . '";'
											: '' 
										) . '
										' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_title_fontawesome_icon_color' ] ) . '
									}
									.post-list-title-div-h2 a,
									.post-list-title-div-h2 a:link,
									.post-list-title-div-h2 a:visited{
										' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_text_link_color' ] ) . '
									}
								';

							# Infos
								$style .= '
									/* Thumbnail */
										.post-list-thumbnail-a {
											border-radius:' . ( 
												absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
												? absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
												: 0 
											) . 'px;
										}
										.post-list-thumbnail, .post-list-def-thumbnail{
											width:' . ( 
												absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
												? absint( $this->theme_mods[ 'archive_page_post_thumbnail_width' ] )
												: 80 
											) . 'px;
											height:' . ( 
												absint( $this->theme_mods[ 'archive_page_post_thumbnail_height' ] )
												? absint( $this->theme_mods[ 'archive_page_post_thumbnail_height' ] )
												: 80 
											) . 'px;
											border-radius:' . ( 
												absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
												? absint( $this->theme_mods[ 'archive_page_post_thumbnail_radius' ] )
												: 0 
											) . 'px;
										}

									/* Description */
										.bloginfo-description a,
										.bloginfo-description a:link,
										.bloginfo-description a:visited{
											' . $this->get_color_style( $this->theme_mods[ 'archive_page_post_list_text_link_color' ] ) . '
										}

										.bloginfo-p-time,
										.post-list-read-later-p,
										.bloginfo-excerpt {
											' . $this->get_color_style( $this->theme_mods[ 'archive_page_text_color' ] ) . '
										}
										.bloginfo-excerpt a,
										.bloginfo-excerpt a:link,
										.bloginfo-excerpt a:visited {
											' . $this->get_color_style( $this->theme_mods[ 'archive_page_text_link_color' ] ) . '
										}
										.bloginfo-excerpt .read-more-for-post-list {
											border: solid ' . $this->esc_color_value( $this->theme_mods[ 'archive_page_text_link_color' ] ) . ' 1px;
										}
										.bloginfo-excerpt .read-more-for-post-list:hover {
											' . $this->get_background_color_style( $this->theme_mods[ 'archive_page_text_link_color' ] ) . '
										}

									/* Read Later */
										.post-list-read-later-sns-icons > li.post-list-twitter-icon-li,
										.post-list-read-later-sns > li.post-list-twitter-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_twitter' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns-icons > li.post-list-facebook-icon-li,
										.post-list-read-later-sns > li.post-list-facebook-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_facebook' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns-icons > li.post-list-googleplus-icon-li,
										.post-list-read-later-sns > li.post-list-googleplus-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_googleplus' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns-icons > li.post-list-hatena-icon-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_hatena' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns > li.post-list-hatena-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_hatena' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns-icons > li.post-list-pocket-icon-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_pocket' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns > li.post-list-pocket-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_pocket' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns-icons > li.post-list-line-icon-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_line' ] ) ? '' : 'display:none;' ) . '
										}
										.post-list-read-later-sns > li.post-list-line-button-li{
											' . ( shapeshifter_boolval( $this->theme_mods[ 'archive_page_read_later_line' ] ) ? '' : 'display:none;' ) . '
										}

								';

							# Pagination
								$style .= '
								';

						# Singular
							$style .= '
								.shapeshifter-content {
									' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
								}
							';

							# Title
								$style .= '
									.shapeshifter-singular-title-wrapper {
										' . $this->get_background_image_style( $this->theme_mods[ 'singular_page_h1_background_image' ] ) . '

										/* Background Decoration */
											' . ( 
												shapeshifter_boolval( $this->theme_mods[ 'singular_page_h1_background_gradient_on' ] )
												? 'background: -webkit-gradient(
														linear,
														left top,
														left bottom,
														from(' . ( 
															$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															: ( 
																$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
																? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
																: '#FFFFFF'
															)
														) . '),
														to(' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . ')
													);
													background: -moz-linear-gradient(
														top,
													' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: ( 
															$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															: '#FFFFFF'
														)
													) . ',
													' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . '
													);'
												: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_background_color' ] ) . ';'
											) . '
										border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_bottom_color' ] ) . ' 1px;
										border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_left_color' ] ) . ' 1px;
										border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_border_right_color' ] ) . ' 1px;
									}
									.shapeshifter-singular-title-wrapper h1.entry-title,
									.shapeshifter-singular-title-wrapper h2.entry-title{
										' . $this->get_font_family_style( $this->theme_mods[ 'singular_page_h1_font_family' ] ) . '
										font-size:' . ( absint( $this->theme_mods[ 'singular_page_h1_font_size' ] ) - 4 ) . 'px;
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_h1_text_color' ] ) . '
										' . ( 
											$this->esc_color_value( $this->theme_mods[ 'singular_page_h1_text_shadow' ] ) != '' 
											? 'text-shadow: 0 0 .5em ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_h1_text_shadow' ] ) . ';'
											: ''
										) . '
									}
									.shapeshifter-singular-title-wrapper h1.entry-title:before,
									.shapeshifter-singular-title-wrapper h2.entry-title:before {
										font-family: FontAwesome;
										' . ( 
											! in_array( 
												$this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_select' ] ), 
												array( '', 'none' )
											) 
											? 'content: "\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_select' ] ) . '";'
											: '' 
										) . '
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_h1_fontawesome_icon_color' ] ) . '
									}
								';

							# Infos
								$style .= '
									.blogbox{
										' . $this->get_background_color_style( $this->theme_mods[ 'singular_page_bloginfo_background_color' ] ) . '
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_bloginfo_text_color' ] ) . '
									}
									.blogbox a,
									.blogbox a:link,
									.blogbox a:visited{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_bloginfo_text_link_color' ] ) . '
									}

									.singular-blogbox-post{
										display:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_not_single_meta_visible' ] ) ? 'none' : 'block' ) . ';
									}
									.singular-blogbox-page{
										display:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_not_page_meta_visible' ] ) ? 'none' : 'block' ) . ';
									}
								';

							# Texts
								$style .= '
									.shapeshifter-content > p {
										line-height: 1.5;
										padding: 10px;
										text-decoration: none;
									}
									.shapeshifter-content p {
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
									}
									.shapeshifter-content a,
									.shapeshifter-content a:link,
									.shapeshifter-content a:visited{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_link_color' ] ) . '
									}
								';
								$headers = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
								foreach( $headers as $index => $header ) {
									$style .= '
										.shapeshifter-content ' . $header . ' {
											' . $this->get_font_family_style( $this->theme_mods[ 'singular_page_' . $header . '_font_family' ] ) . '
											font-size:' . absint( $this->theme_mods[ 'singular_page_' . $header . '_font_size' ] ) . 'px;

											' . $this->get_color_style( $this->theme_mods[ 'singular_page_' . $header . '_text_color' ] ) . '
											' . ( 
												$this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_text_shadow' ] ) != '' 
												? 'text-shadow: 0 0 .5em ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_text_shadow' ] ) . ';'
												: ''
											) . '

											' . $this->get_background_image_style( $this->theme_mods[ 'singular_page_' . $header . '_background_image' ] ) . '

											' . ( 
												shapeshifter_boolval( $this->theme_mods[ 'singular_page_' . $header . '_background_gradient_on' ] )
												? 'background:linear-gradient(
													' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: ( 
															$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															: '#FFFFFF'
														)
													) . ',
													' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . '
													);
													background: -webkit-gradient(
														linear,
														left top,
														left bottom,
														from(' . ( 
															$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
															: ( 
																$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
																? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
																: '#FFFFFF'
															)
														) . '),
														to(' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . ')
													);
													background: -moz-linear-gradient(
														top,
													' . ( 
														$this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														? $this->esc_color_value( $this->theme_mods[ 'main_content_background_color' ] )
														: ( 
															$this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															? $this->esc_color_value( $this->theme_mods[ 'content_area_background_color' ] )
															: '#FFFFFF'
														)
													) . ',
													' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . '
													);'
												: 'background-color:' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_background_color' ] ) . ';'
											) . '
											border-bottom: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_bottom_color' ] ) . ' 1px;
											border-left: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_left_color' ] ) . ' 1px;
											border-right: solid ' . $this->esc_color_value( $this->theme_mods[ 'singular_page_' . $header . '_border_right_color' ] ) . ' 1px;
										}
									';
									if ( $header !== 'p' ) {

										$style .= '
											.shapeshifter-content ' . $header . ':before {
												font-family: FontAwesome;
												' . ( 
													! in_array( 
														$this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_select' ] ), 
														array( '', 'none' )
													) 
													? 'content: "\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_select' ] ) . '";'
													: '' 
												) . '
												' . $this->get_color_style( $this->theme_mods[ 'singular_page_' . $header . '_fontawesome_icon_color' ] ) . '
											}

										';

									}
								}

							# Item
								$style .= '
									/* Images 
									-------------------------------------------------------------- */

									/* Lists
									-------------------------------------------------------------- */

									/* Tables 
									-------------------------------------------------------------- */

									/* Quotes
									-------------------------------------------------------------- */
										.shapeshifter-content blockquote:before{
											content: "' . esc_html__( 'Cite:', 'shapeshifter' ) . '";
										}

									/* Columns
									-------------------------------------------------------------- */

										@media screen and ( max-width: ' . $this->content_inner_width . 'px ) {
											.shapeshifter-content .shapeshifter-flex-wrapper {
												display: -webkit-flex;
												display: flex;
											}
												.shapeshifter-flex-wrapper > .col-1 {
													-webkit-flex-grow: 1;
													flex-grow: 1;
												}
												.shapeshifter-flex-wrapper > .col-2 {
													-webkit-flex-grow: 2;
													flex-grow: 2;
												}
												.shapeshifter-flex-wrapper > .col-3 {
													-webkit-flex-grow: 3;
													flex-grow: 3;
												}
												.shapeshifter-flex-wrapper > .col-4 {
													-webkit-flex-grow: 4;
													flex-grow: 4;
												}
												.shapeshifter-flex-wrapper > .col-5 {
													-webkit-flex-grow: 5;
													flex-grow: 5;
												}
												.shapeshifter-flex-wrapper > .col-6 {
													-webkit-flex-grow: 6;
													flex-grow: 6;
												}
										}

									/* Shortcodes
									-------------------------------------------------------------- */
										
								';

							# Page Links
								$style .= '
								';

							# Comments
								$style .= '
								';

							# Prev Next
								$style .= '
									div.single-page-prev-next{
										display:' . ( shapeshifter_boolval( $this->theme_mods[ 'is_not_page_link_visible' ] ) ? 'none' : 'block' ) . ';
									}

									p.prev-post-link-p{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
									}

									p.prev-post-title-p{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_link_color' ] ) . '
									}

									p.next-post-link-p{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_color' ] ) . '
									}

									p.next-post-title-p{
										' . $this->get_color_style( $this->theme_mods[ 'singular_page_text_link_color' ] ) . '
									}
								';

					# Footer
						$style .= '
							#footer {
								' . (
									! SHAPESHIFTER_IS_MOBILE
									? 'min-width: ' . absint( $shapeshifter_content_width ) . 'px;'
									: 'max-width: ' . absint( $shapeshifter_content_width ) . 'px;'
								) . '
							}

							#footer-items {

								' . $this->get_background_color_style( $this->theme_mods[ 'footer_background_color' ] ) . '
								' . $this->get_background_image_style( $this->theme_mods[ 'footer_background_image_select' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'footer_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'footer_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'footer_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'footer_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'footer_background_image_attachment' ] ) . '

							}
							#footer-items p.footer-p{
								font-size:' . ( absint( $this->theme_mods[ 'footer_font_size' ] ) - 4 ) . 'px;
								text-align:' . $this->esc_footer_align( $this->theme_mods[ 'footer_align_select' ] ) . ';
								' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '
							}

							#footer-license {
								' . ( 
									$this->esc_credit_type( $this->theme_mods[ 'footer_display_credit_type' ] ) === 'none' 
									? 'display: none;' 
									: '' 
								) . '
							}

							#footer-items p#footer-description{
								display:' . ( shapeshifter_boolval( $this->theme_mods[ 'footer_display_description' ] ) ? 'block' : 'none' ) . ';
							}

							#footer-items p#footer-theme{
								display:' . ( shapeshifter_boolval( $this->theme_mods[ 'footer_display_theme' ] ) ? 'block' : 'none' ) . ';
							}

							#footer-items a,
							#footer-items a:link,
							#footer-items a:visited{
								' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '
							}
						';

						# Footer Nav
							$style .= '
							';

					# Standard Widget Areas
						$default_widget_areas_args = array(
							'sidebar_right' => 'sidebar-right',
							'sidebar_right_fixed' => 'sidebar-right-fixed',
							'mobile_sidebar' => 'mobile-sidebar'
						);
						foreach( $default_widget_areas_args as $name => $class_fix ) {
							$style .= '
								ul.widget-area-' . $class_fix . '-ul{
								}
								li.widget-area-' . $class_fix . '-li{
									' . $this->get_font_family_style( $this->theme_mods[ $name . '_font_family' ] ) . '
									border-width:' . ( 
										shapeshifter_boolval( $this->theme_mods[ $name . '_widget_border' ] )
										? 1 
										: 0 
									) . 'px;
									border-radius:' . absint( $this->theme_mods[ $name . '_widget_border_radius' ] ) . 'px;

									' . $this->get_background_color_style( $this->theme_mods[ $name . '_background_color' ] ) . '
									' . $this->get_background_image_style( $this->theme_mods[ $name . '_outer_background_image' ] ) . '
									' . $this->get_background_size_style( $this->theme_mods[ $name . '_outer_background_image_size' ] ) . '
									' . $this->get_background_position_y_style( $this->theme_mods[ $name . '_outer_background_image_position_row' ] ) . '
									' . $this->get_background_position_x_style( $this->theme_mods[ $name . '_outer_background_image_position_column' ] ) . '
									' . $this->get_background_repeat_style( $this->theme_mods[ $name . '_outer_background_image_repeat' ] ) . '
									' . $this->get_background_attachment_style( $this->theme_mods[ $name . '_outer_background_image_attachment' ] ) . '

								}

								p.widget-area-' . $class_fix . '-p,
								h5.widget-area-' . $class_fix . '-h5 {
									' . $this->get_color_style( $this->theme_mods[ $name . '_title_color' ] ) . '
								}
								p.widget-area-' . $class_fix . '-p:before,
								h5.widget-area-' . $class_fix . '-h5:before {
									font-family: FontAwesome;
									' . (
										$this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_select' ] ) != 'none'
										? 'content:"\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_select' ] ) . '";'
										: ''
									) . '
									' . $this->get_color_style( $this->theme_mods[ $name . '_widget_title_fontawesome_icon_color' ] ) . '
									margin-right: 10px;
								}

								.widget-area-' . $class_fix . '-li-div{

									' . $this->get_color_style( $this->theme_mods[ $name . '_text_color' ] ) . '

									' . $this->get_background_image_style( $this->theme_mods[ $name . '_inner_background_image' ] ) . '
									' . $this->get_background_size_style( $this->theme_mods[ $name . '_inner_background_image_size' ] ) . '
									' . $this->get_background_position_y_style( $this->theme_mods[ $name . '_inner_background_image_position_row' ] ) . '
									' . $this->get_background_position_x_style( $this->theme_mods[ $name . '_inner_background_image_position_column' ] ) . '
									' . $this->get_background_repeat_style( $this->theme_mods[ $name . '_inner_background_image_repeat' ] ) . '
									' . $this->get_background_attachment_style( $this->theme_mods[ $name . '_inner_background_image_attachment' ] ) . '

								}

								.widget-area-' . $class_fix . '-li-div a, .widget-area-' . $class_fix . '-li-div a:link,.widget-area-' . $class_fix . '-li-div a:visited{
									' . $this->get_color_style( $this->theme_mods[ $name . '_link_text_color' ] ) . '
								}

								.widget-area-' . $class_fix . '-li-div .widget-entry-excerpt {
									' . $this->get_color_style( $this->theme_mods[ $name . '_text_color' ] ) . '
								}

								ul.widget-area-' . $class_fix . '-ul li.cat-item:before,
								ul.widget-area-' . $class_fix . '-ul li.archive-list-item:before,
								ul.widget-area-' . $class_fix . '-ul ul.menu li.menu-item:before,
								ul.widget-area-' . $class_fix . '-ul li.page_item:before,
								ul.widget-area-' . $class_fix . '-ul li.recentcomments:before {
									font-family:FontAwesome;
									' . (
										$this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_select' ] ) != 'none'
										? 'content:"\\' . $this->esc_fontawesome_icon_value( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_select' ] ) . '";'
										: ''
									) . '
									' . $this->get_color_style( $this->theme_mods[ $name . '_widget_list_fontawesome_icon_color' ] ) . '
									margin-right: 10px;
								}

							';

						}

					# Widget Items
						$style .= '
						';

					# Left Menu
						$style .= '
							.shapeshifter-mobile-regular-nav{
								' . $this->get_font_family_style( $this->theme_mods[ 'nav_text_font_family' ] ) . '
							}
							div.shapeshifter-mobile-nav-wrapper-div{

								/*' . $this->get_background_color_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ], 'rgba(255,255,255,0.9)' ) . '*/
								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';

								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '
								
							}
						';
					# Right Menu
						$style .= '
							.shapeshifter-mobile-side-menu-aside{

								/*' . $this->get_background_color_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ], 'rgba(255,255,255,0.9)' ) . '*/
								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';
								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '

							}
						';
					# Bottom Nav Menu Buttons
						$style .= '
						';

					return $style;

				}

		/**
		 * 320
		 * 
		 * @param string $device
		 * @param string $break_point
		 * 
		 * @param string
		**/
		function get_320_styles( $device, $break_point ) {

			$style = ' /* 320px screen */';

			$style .= $this->get_320_body_styles( $device, $break_point );

			$style .= $this->get_320_header_styles( $device, $break_point );

			$style .= $this->get_320_nav_menu_styles( $device, $break_point );

			$style .= $this->get_320_contents_styles( $device, $break_point );

			$style .= $this->get_320_footer_styles( $device, $break_point );

			$style .= $this->get_320_widget_areas_styles( $device, $break_point );

			$style .= $this->get_320_others_styles( $device, $break_point );

			return $style;

		}

			function get_320_body_styles( $device, $break_point ) {

				$style = '';

				$style .= '/* Wrapper */
					.shapeshifter-outer-wrapper {
						' . $this->get_font_family_style( $this->theme_mods[ 'text_font_family' ] ) . '
					}
				';

				return $style;

			}

			function get_320_header_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_320_nav_menu_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_320_contents_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_320_footer_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_320_widget_areas_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_320_others_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

		/**
		 * 640
		 * 
		 * @param string $device
		 * @param string $break_point
		 * 
		 * @param string
		**/
		function get_640_styles( $device, $break_point ) {

			$style = ' /* 640px screen */';

			$style .= $this->get_640_body_styles( $device, $break_point );

			$style .= $this->get_640_header_styles( $device, $break_point );

			$style .= $this->get_640_nav_menu_styles( $device, $break_point );

			$style .= $this->get_640_contents_styles( $device, $break_point );

			$style .= $this->get_640_footer_styles( $device, $break_point );

			$style .= $this->get_640_widget_areas_styles( $device, $break_point );

			$style .= $this->get_640_others_styles( $device, $break_point );

			return $style;

		}

			function get_640_body_styles( $device, $break_point ) {

				$style = '';

				$style .= '
					.shapeshifter-outer-wrapper {
						' . $this->get_font_family_style( $this->theme_mods[ 'text_font_family' ] ) . '
					}
				';

				return $style;

			}

			function get_640_header_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_640_nav_menu_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_640_contents_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_640_footer_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_640_widget_areas_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

			function get_640_others_styles( $device, $break_point ) {

				$style = '';

				$style .= '';

				return $style;

			}

		/**
		 * 1024
		 * 
		 * @param string $device
		 * @param string $break_point
		 * 
		 * @param string
		**/
		function get_1024_styles( $device = 'pc', $break_point = 1024 ) {

			$style = '';

			# PC
				if ( $device === 'pc' ) {

					$style .= ' /* 1024px screen */';

					$style .= $this->get_1024_body_styles( $device, $break_point );

					$style .= $this->get_1024_header_styles( $device, $break_point );

					$style .= $this->get_1024_nav_menu_styles( $device, $break_point );

					$style .= $this->get_1024_contents_styles( $device, $break_point );

					$style .= $this->get_1024_footer_styles( $device, $break_point );

					$style .= $this->get_1024_widget_areas_styles( $device, $break_point );

					$style .= $this->get_1024_others_styles( $device, $break_point );

				}

			# Mobile
				if ( $device === 'mobile' ) {

					//$style = $this->get_1024_mobile_styles( $device, $break_point );

				}

			return $style;

		}

			# Body
			function get_1024_body_styles( $device, $break_point ) {

				$style = '';

				$style .= '
					.shapeshifter-outer-wrapper {
						' . $this->get_font_family_style( $this->theme_mods[ 'text_font_family' ] ) . '
					}
				';

				return $style;

			}

			# Header
			function get_1024_header_styles( $device, $break_point ) {

				$style = '
				';

				return $style;

			}

			# Nav Menu
			function get_1024_nav_menu_styles( $device, $break_point ) {

				$style = '';

				return $style;

			}

			# Contents
			function get_1024_contents_styles( $device, $break_point ) {

				$style = '';

				return $style;

			}

			# Footer
			function get_1024_footer_styles( $device, $break_point ) {

				$style = '';

				$style .= '
				';

				$style .= '
					#footer-items {

						' . $this->get_background_color_style( $this->theme_mods[ 'footer_background_color' ] ) . '
						' . $this->get_background_image_style( $this->theme_mods[ 'footer_background_image_select' ] ) . '
						' . $this->get_background_size_style( $this->theme_mods[ 'footer_background_image_size' ] ) . '
						' . $this->get_background_position_y_style( $this->theme_mods[ 'footer_background_image_position_row' ] ) . '
						' . $this->get_background_position_x_style( $this->theme_mods[ 'footer_background_image_position_column' ] ) . '
						' . $this->get_background_repeat_style( $this->theme_mods[ 'footer_background_image_repeat' ] ) . '
						' . $this->get_background_attachment_style( $this->theme_mods[ 'footer_background_image_attachment' ] ) . '

					}

					#footer-items p.footer-p{
						font-size:' . ( absint( $this->theme_mods[ 'footer_font_size' ] ) - 4 ) . 'px;
						text-align:' . $this->esc_footer_align( $this->theme_mods[ 'footer_align_select' ] ) . ';
						
						' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '

					}

					#footer-license {
						' . (
							$this->esc_credit_type( $this->theme_mods[ 'footer_display_credit_type' ] ) === 'none' 
							? 'display: none;' 
							: ''
						) . '
					}

					#footer-items p#footer-description{
						display:' . ( shapeshifter_boolval( $this->theme_mods[ 'footer_display_description' ] ) ? 'block' : 'none' ) . ';
					}

					#footer-items p#footer-theme{
						display:' . ( shapeshifter_boolval( $this->theme_mods[ 'footer_display_theme' ] ) ? 'block' : 'none' ) . ';
					}

					#footer-items a,
					#footer-items a:link,
					#footer-items a:visited{
						' . $this->get_color_style( $this->theme_mods[ 'footer_text_color' ] ) . '
					}
				';

				return $style;

			}

			# Widget Areas
			function get_1024_widget_areas_styles( $device, $break_point ) {

				$style = '';

				return $style;

			}

			# Others
			function get_1024_others_styles( $device, $break_point ) {

				$style = '';

				$style .= '
				';

					# Left Menu
						$style .= '
							nav.shapeshifter-main-regular-nav{
								' . $this->get_font_family_style( $this->theme_mods[ 'nav_text_font_family' ] ) . '
							}
							nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-wrapper-div{

								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';

								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '
								
							}

						';
					# Right Menu
						$style .= '
							.shapeshifter-mobile-side-menu-aside{

								background-color: ' . ( 
									$this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] ) != 'rgba(255,255,255,0)'
									? $this->esc_color_value( $this->theme_mods[ 'mobile_sidebar_wrapper_background_color' ] )
									: 'rgba(255,255,255,0.9)'
								) . ';
								' . $this->get_background_image_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image' ] ) . '
								' . $this->get_background_size_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_size' ] ) . '
								' . $this->get_background_position_y_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_row' ] ) . '
								' . $this->get_background_position_x_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_position_column' ] ) . '
								' . $this->get_background_repeat_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_repeat' ] ) . '
								' . $this->get_background_attachment_style( $this->theme_mods[ 'mobile_sidebar_wrapper_background_image_attachment' ] ) . '

							}
						';
					# Bottom Nav Menu Buttons
						$style .= '
						';

				return $style;

			}

		/**
		 * Responsive
		**/
		function get_common_responsive_styles() {

			$style = '
				@media screen and ( max-width: ' . intval( $this->content_width ) . 'px ) {

					/* Body
					-------------------------------------------------------------- */ 
						body.shapeshifter-body-pc.shapeshifter-is-responsive {
							font-size: 12px;

							width: 100%;
							min-width: initial !important;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive .shapeshifter-outer-wrapper {
							width: 100%;
							min-width: initial !important;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive .shapeshifter-inner-wrapper {
							overflow:auto;
							overflow-scrolling:touch;
						}

					/* Header
					-------------------------------------------------------------- */ 
						body.shapeshifter-body-pc.shapeshifter-is-responsive .shapeshifter-header {
							
							width: 100%;
							min-width: initial !important;

						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive #top-menu-nav {
							display: none;
						}

					/* Nav Menu
					-------------------------------------------------------------- */ 
						body.shapeshifter-body-pc.shapeshifter-is-responsive body.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-mobile-regular-nav {

							display: block;

							' . $this->get_font_family_style( $this->theme_mods[ 'nav_text_font_family' ] ) . '

							width: initial;
							z-index: initial;

							overflow: auto;
							
							border-top: initial;
							border-bottom: initial;

							box-shadow: initial;

							background: initial;
							background-color: initial;
							background-image: initial;

							background-size: initial;
							background-repeat: initial;

						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-wrapper-div,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-wrapper-div {
							margin: initial;
							background-color: rgba(255,255,255,0.9);
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive body.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-div{
												
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive div.shapeshifter-main-nav-div > ul.shapeshifter-main-nav-menu{
							margin: initial;
							width: initial;
							display: block;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item{
							text-align: initial;
							float: initial;
							padding: initial;
							margin: initial;

							background: initial;
							background-color: initial;
							background-image: initial;
							display: block;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > #nav-menu-search-box{
							display: none;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item > a {
							padding: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:link,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:visited {
							opacity: initial;
							border-bottom: initial;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item a:link,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item a:visited{
							color: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item:hover > a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item:hover > a:link,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item:hover > a:visited {
							opacity: initial;
							border-bottom: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.page_item{
							margin: initial;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu {

							display: block;
							height: initial;

							transition: initial;

							min-width: initial;
							margin: initial;
							margin-left: initial;
							position: initial;
							z-index: initial;

						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > ul.sub-menu,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > a:focus + ul.sub-menu {
							overflow: initial;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item {
							text-align: initial;
							height: initial;

							transition: initial;

							padding: initial;
							display: block;
							position: initial;

							border: initial;
							float: initial;
							background: initial;
							background-color: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item > a {
							overflow: initial;
							text-align: initial;
							font-size: initial;

							transition: initial;

							padding: initial;
							display: initial;
							position: initial;

							border: initial;
							float: initial;

							background: initial;
							background-color: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > ul.sub-menu > li.menu-item,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > a:focus + ul.sub-menu > li.menu-item {
							overflow: initial;
							height: initial;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > ul.sub-menu > li.menu-item > a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > a:focus + ul.sub-menu > li.menu-item > a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item > a:focus {
							overflow: initial;
							font-size: initial;
							padding: initial;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > ul.sub-menu > li.menu-item > a{
						}






						body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.sub-menu > li.menu-item > ul.sub-menu{
							display: block;
							position: initial;
						}

					/* Contents
					-------------------------------------------------------------- */ 
						body.shapeshifter-body-pc.shapeshifter-is-responsive .content-inner {
							float: initial;
							margin: auto;
						}

					/* Footer
					-------------------------------------------------------------- */ 
						body.shapeshifter-body-pc.shapeshifter-is-responsive #footer {

							width: 100%;
							min-width: initial !important;

						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive .before-footer-div{
							padding:10px;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive #widget-area-in-footer-wrapper {
							color: #000;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive #widget-area-in-footer-wrapper a,
						body.shapeshifter-body-pc.shapeshifter-is-responsive #widget-area-in-footer-wrapper a:link,
						body.shapeshifter-body-pc.shapeshifter-is-responsive #widget-area-in-footer-wrapper a:visited {
							color: #000;					
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive #widget-area-in-footer-wrapper div {
							overflow: auto;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive #footer-items {
							width:100%;
							bottom:50px;
							position:relative;
							
							margin-top:50px;
							padding:10px;
						}

						body.shapeshifter-body-pc.shapeshifter-is-responsive #footer-items #footer-nav-menu {
							text-align: center;
						}
							body.shapeshifter-body-pc.shapeshifter-is-responsive #footer-nav-menu .shapeshifter-footer-nav-div {

							}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .shapeshifter-footer-nav-div ul.shapeshifter-footer-nav-menu {
									display: block;
									margin: 0;
									padding: 5px;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive ul.shapeshifter-footer-nav-menu > li.menu-item {
									line-height: 2;
									font-size: 80%;
									margin: 0;
								}

						body.shapeshifter-body-pc.shapeshifter-is-responsive #footer-items p.footer-p {
							margin:0;
							padding:5px;
						}

					/* Widget Areas
					-------------------------------------------------------------- */ 
						

						body.shapeshifter-body-pc.shapeshifter-is-responsive .sidebar-left-container {
							display: none;
						}
						body.shapeshifter-body-pc.shapeshifter-is-responsive .sidebar-right-container {
							display: none;
						}
							/* Left Menu
							-------------------------------------------------------------- */ 
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-wrapper-div{
									width: 300px;
									height:100%;
									position: fixed;
									top: 0px;
									left: -300px;
									overflow-y: scroll;
									overflow-scrolling:touch;
							
									padding: 0 20px;

									box-shadow:0 0 1px;

									z-index: 1000;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav p.shapeshifter-mobile-nav-top-button-text{

									display: block;

									text-align: center;
									width: 120px;

									position: relative;
									top: 50px;
									left: 140px;

								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav a#back-to-content{

									display: block;

									height: 30px;
									width: 120px;
									border-radius: 15px;
									position: relative;
									background-color: #FFFFFF;

									font-size: 12px
									top: 7px;
									padding: 8px 12px;

									box-shadow: 0 0 5px #000000;

									z-index: 1001;

								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav p.shapeshifter-mobile-nav-top-title{
									display: block;
									font-size: 20px;
									position: relative;
									left: 0px;
									top: 50px;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav div.shapeshifter-main-nav-div{
									position: relative;
									top: 50px;
									margin-bottom: 70px;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu li a,
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu li:hover a {

									font-size: 12px !important;
									text-decoration: none !important;
									color: #000 !important;
									border-bottom: none !important;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item > a,
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item:hover > a {
									font-size: 14px !important;
									border-bottom: solid #000000 1px !important;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu{
									margin:auto;
									width:100%;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu li.menu-item{
									margin:0;
									padding:0;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > #nav-menu-search-box{
									display:none;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav li.menu-item a{
									line-height:2;
									border-bottom:solid #000 1px;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.menu > li.menu-item > ul.sub-menu {
									display:block;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.menu > li.menu-item:hover > ul.sub-menu {
									display:block;
								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.menu > li.menu-item > ul.sub-menu > li.menu-item {
									display:block;

								}

								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.menu > li.menu-item > ul.sub-menu > li.menu-item > a{
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive nav.shapeshifter-main-regular-nav ul.sub-menu > li.menu-item > ul.sub-menu{
								}

							/* Right Menu
							-------------------------------------------------------------- */ 
								body.shapeshifter-body-pc.shapeshifter-is-responsive .shapeshifter-mobile-side-menu-aside{

									display: block;

									width: 300px;
									height: 100%;

									position: fixed;
									top: 0px;
									right: -300px;
									overflow-y: scroll;
									overflow-scrolling:touch;

									padding: 30px 20px 50px 20px;

									box-shadow:0 0 1px;

									z-index: 1000;

								}
												
							/* Bottom Nav Menu Buttons
							-------------------------------------------------------------- */ 
								body.shapeshifter-body-pc.shapeshifter-is-responsive .fixed-menu-buttons-for-mobile{
									display: flex;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .fixed-menu-buttons-for-mobile .menu-button-for-mobile-a {
									display: inline-block;
									width: 33.33333%;
									height: 55px;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .mobile-menu-button-icon-box{
									margin:auto;
									text-align:center;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .mobile-menu-button-text-box{
									margin:auto;
									text-align:center;
									height: 10px;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .menu-button-for-mobile-a .menu-icon{
									font-size: 30px;
								}
								body.shapeshifter-body-pc.shapeshifter-is-responsive .menu-button-for-mobile-a .menu-text{
									font-size: 10px;
									position: relative;
								}

				}
			';
			return $style;

		}


		#
		# Style Code
		#
			/**
			 * Get Number Style
			 * 
			 * @param string $property        : Style Property Name
			 * @param string $value           : Property Value
			 * @param string $unit            : Unit
			 * @param string $filter_callable : Callable Name
			 * 
			 * @param string
			**/
			function get_number_style( $property, $value, $default = '', $unit = 'px', $filter_callable = 'intval' ) {

				# Check if Property is String
					if( ! is_string( $property ) ) {
						return '';
					}

				# Check the Default
					if( is_int( $default ) )
						unset( $default );

				# Check if Value is set. If no, Use Default value
				# Default is also not set return empty string
					if( ! isset( $value ) || ! is_int( $value ) ) {
						if( isset( $default ) )
							$value = $default;
						else 
							return '';
					}

				# Set the Return String CSS Code
					$return = $property . ': ' . $filter_callable( $value ) . $unit . ';';

				# End
					return $return;

			}

		#
		# Color
		#
			/**
			 * Get Color Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_color_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'color: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'color: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

		# Font Family
			/**
			 * Get Font Family Style
			 * 
			 * @param string $value
			 * @param string $check_if_none
			 * 
			 * @param string
			**/
			function get_font_family_style( $value, $check_if_none = false ) {

				$return = '';

				$font_families = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_font_families() );

				if( $check_if_none ) {
					if( ! empty( $value ) 
						&& is_string( $value ) 
						&& $value !== 'none' 
						&& in_array( $value, $font_families )
					) {
						$return = 'font-family: ' . $value . ';';
					}
				} else {
					if( ! empty( $value ) 
						&& is_string( $value ) 
						&& in_array( $value, $font_families )
					) {
						$return = 'font-family: ' . $value . ';';
					}
				}

				return $return;

			}

		#
		# Background
		#
			/**
			 * Get Background Color Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_color_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-color: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-color: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

			/**
			 * Get Background Image Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_image_style( $value, $default = '' ) {

				$return = '';
				$image_url = esc_url_raw( $value );

				if( ! empty( $value ) ) {
					$return = 'background-image: url(' . esc_url( $value ) . ');';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-image: url(' . esc_url( $default ) . ');';
					}
				}

				return $return;

			}

			/**
			 * Get Background Size Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_size_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-size: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-size: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

			/**
			 * Get Background Position Y Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_position_y_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-position-y: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-position-y: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

			/**
			 * Get Background Position X Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_position_x_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-position-x: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-position-x: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

			/**
			 * Get Background Repeat Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_repeat_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-repeat: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-repeat: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

			/**
			 * Get Background Attachment Style
			 * 
			 * @param string $value
			 * @param string $default
			 * 
			 * @param string
			**/
			function get_background_attachment_style( $value, $default = '' ) {

				$return = '';

				if( ! empty( $value ) ) {
					$return = 'background-attachment: ' . esc_html( $value ) . ';';
				} else {
					if( ! empty( $default ) ) {
						$return = 'background-attachment: ' . esc_html( $default ) . ';';
					}
				}

				return $return;

			}

		#
		# Header Image
		#
			/**
			 * Get Logo Position Style
			 * 
			 * @param string
			**/
			function get_theme_mods_logo_position() {

				if ( $this->theme_mods[ 'header_image_position' ] == 'left' ) {
					return 'margin:auto;margin-left:0;';
				} elseif ( $this->theme_mods[ 'header_image_position' ] == 'center' ) {
					return 'margin:auto;';
				} elseif ( $this->theme_mods[ 'header_image_position' ] == 'right' ) {
					return 'margin:auto;margin-right:0;';
				}
			
			}

			/**
			 * Get Logo Title Description Position Style
			 * 
			 * @param string
			**/
			function get_theme_mods_logo_title_description_position() {

				if ( $this->theme_mods[ 'header_image_title_description_position' ] == 'left-top' ) {
					return 'position:absolute;top:0;left:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'left-bottom' ) {
					return 'position:absolute;left:0;bottom:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'right-top' ) {
					return 'position:absolute;top:0;right:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'right-bottom' ) {
					return 'position:absolute;right:0;bottom:0;';
				} else {
				}

			}

			/**
			 * Get Logo Title Description Position Style for Mobile
			 * 
			 * @param string
			**/
			function get_theme_mods_logo_title_description_position_for_mobile() {

				if ( $this->theme_mods[ 'header_image_title_description_position' ] == 'left-top' ) {
					return 'position:relative;top:0;left:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'left-bottom' ) {
					return 'position:relative;left:0;bottom:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'right-top' ) {
					return 'position:relative;top:0;right:0;';
				} elseif ( $this->theme_mods[ 'header_image_title_description_position' ] == 'right-bottom' ) {
					return 'position:relative;right:0;bottom:0;';
				} else {
				}

			}

		#
		# Escape Values
		#
			/**
			 * Validate Font Awesome Icon Value
			 * 
			 * @param string $value : FontAwesome Icon Content Value
			 *
			 * @return string $return
			**/
			public function esc_fontawesome_icon_value( $value ) {

				$return = '';

				if ( preg_match( '/^f[0-9a-zA-Z]{3}/i', $value ) ) {
					$return = $value;
				}

				return $return;

			}

			/**
			 * Escape Color Value
			 * 
			 * @param  string $value : Color Value
			 *
			 * @return string $value
			**/
			public function esc_color_value( $value ) {

				# Is RGB
					$is_rgb = strpos( $value, 'rgb' ) !== false;

				# Default Value
					$return = '';

				# If is RGB
					if( $is_rgb ) {

						preg_match( '/rgba?\((\s*?([0-9]){1,3}\,?){3}(0|1)\.?[0-9]*?\)/i', $value, $matched );
						if( isset( $matched[0] ) )
							$return = $matched[0];

					}

				# If is HEX 
					elseif( strpos( $value, '#' ) !== false ) {

						$return = sanitize_hex_color( $value );

					}

				# If is no HEX 
					else {

						$value = sanitize_hex_color_no_hash( $value );
						if ( '' === $value ) {
							$return = sanitize_hex_color( '#' . $value );
						}

					}

				# End
					return $return;

			}

			/**
			 * Escape Credit Type
			 * 
			 * @param string $input
			 *
			 * @return $return
			**/
			public function esc_credit_type( $input ) {

				$return = '';

				$credit_types = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_credit_types() );

				if( in_array( $input, $credit_types ) ) {

					$return = $input;

				}

				return $return;

			}

			/**
			 * Escape Credit Type
			 * 
			 * @param string $input
			 *
			 * @return $return
			**/
			public function esc_footer_align( $input ) {

				$return = '';

				$footer_align = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_footer_aligns() );

				if( in_array( $input, $footer_align ) ) {

					$return = $input;

				}

				return $return;

			}

	}
}

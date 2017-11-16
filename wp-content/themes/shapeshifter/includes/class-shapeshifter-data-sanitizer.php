<?php
if( ! class_exists( 'ShapeShifter_Data_Sanitizer' ) ) {
	class ShapeShifter_Data_Sanitizer {

		/**
		 * Theme Mods
		 * 
		 * @var $theme_mods
		**/
		public static $theme_mods = array(
			'color' => ''
		);

		/**
		 * Check if is set. Return value if true. Otherwise, return false.
		 * 
		 * @param string  $string
		 *
		 * @return string $string
		**/
		public static function validate_description_string( $string ) {

			$string = wp_kses( $string, array(
				'a'      => array(
					'href'  => array(),
					'class' => array()
				),
				'strong' => array(),
				'em'     => array(),
				'b'      => array()
			) );

			return $string;

		}

		/**
		 * Check if is set. return value if true. Otherwise, return false.
		 * 
		 * @param  mixed   $value
		 * 
		 * @return bool $return
		**/
		public static function validate_checked_value( $value ) {

			if( isset( $value ) ) {
				return false;
			} else {
				return $value;
			}

		}

		/**
		 * Sanitize Color Value
		 * 
		 * @param  string $value : Color Value
		 *
		 * @return string $value
		**/
		public static function sanitize_color_value( $value ) {

			# Is RGB
				$is_rgb = strpos( $value, 'rgb' ) !== false;

			# Default Value
				$return = '';

			# If is RGB
				if( $is_rgb ) {

					preg_match( '/rgba?\((\s*?([0-9]){1,3}\,?){3}(0|1)\.?[0-9]*?\)/i', $value, $matched );
					if( isset( $matched[0] ) )
						$return = sanitize_text_field( $matched[0] );

				}

			# If is HEX 
				elseif( strpos( $value, '#' ) !== false ) {

					$return = sanitize_hex_color( $value );

				}

			# If is no HEX 
				else {

					$return = sanitize_hex_color_no_hash( $value );

				}

			# End
				return $return;

		}

		/**
		 * Sanitize Checkbox Value
		 * 
		 * @param  bool|int|? $input
		 *
		 * @return bool $value
		**/
		public static function sanitize_checkbox( $input ) {
			if ( $input == true ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Sanitize Int Value
		 * 
		 * @param mixed $input
		 *
		 * @return int $value
		**/
		public static function sanitize_int( $input ) {
			return intval( $input );
		}

		/**
		 * Sanitize Font Family
		 * 
		 * @param string $input : Font Family
		 *
		 * @return string $return
		**/
		public static function sanitize_font_families( $input ) {

			$return = '';

			$font_families = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_font_families() );

			if( in_array( $input, $font_families ) ) {

				$return = $input;

			}

			return $return;

		}

		/**
		 * Sanitize Background Image Size
		 * 
		 * @param string $input
		 *
		 * @return string $return
		**/
		public static function sanitize_background_image_size( $input ) {

			$return = '';

			$background_image_sizes = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_size() );

			if( in_array( $input, $background_image_sizes ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Background Position Row
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_background_position_row( $input ) {

			$return = '';

			$background_position_row = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_position_row() );

			if( in_array( $input, $background_position_row ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Background Position Column
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_background_position_column( $input ) {

			$return = '';

			$background_position_column = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_position_column() );

			if( in_array( $input, $background_position_column ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Background Repeat
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_background_repeat( $input ) {

			$return = '';

			$background_repeats = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_repeats() );

			if( in_array( $input, $background_repeats ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Background Attachment
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_background_attachment( $input ) {

			$return = '';

			$background_attachment = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_background_attachments() );

			if( in_array( $input, $background_attachment ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize CSS Animations Hover
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_css_animation_hover( $input ) {

			$return = '';

			$css_class_array = ShapeShifter_Theme_Mods::get_animate_css_class_array();
			$css_animations = array_flip( $css_class_array['hover'] );

			if( in_array( $input, $css_animations ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize CSS Animations Enter
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_css_animation_enter( $input ) {

			$return = '';

			$css_class_array = ShapeShifter_Theme_Mods::get_animate_css_class_array();
			$css_animations = array_flip( $css_class_array['enter'] );

			if( in_array( $input, $css_animations ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Credit Type
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_credit_type( $input ) {

			$return = '';

			$credit_types = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_credit_types() );

			if( in_array( $input, $credit_types ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

		/**
		 * Sanitize Credit Type
		 * 
		 * @param string $input
		 *
		 * @return $return
		**/
		public static function sanitize_footer_align( $input ) {

			$return = '';

			$footer_align = array_flip( ShapeShifter_Theme_Mods::get_shapeshifter_theme_mods_choices_footer_aligns() );

			if( in_array( $input, $footer_align ) ) {

				$return = sanitize_text_field( $input );

			}

			return $return;

		}

	}
}

<?php
/**
 * Frontend Methods
**/
class ShapeShifter_Frontend_Methods extends ShapeShifter_Frontend_HTML_Parts {

	#
	# General Tags
	#
		/**
		 * Print General Element Tag
		 * 
		 * @static
		 * 
		 * @param string $element
		 * @param string $atts
		 * @param string $text
		 * @param string $wrap
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts, $text, $wrap )
		**/
		public static function shapeshifter_generated_tag( $element, $atts = array(), $text = '', $wrap = false ) {
			echo ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts, $text, $wrap );
		}

		/**
		 * Get General Element Tag
		 * 
		 * @static
		 * 
		 * @param string $element
		 * @param string $atts
		 * @param string $text
		 * @param string $wrap
		 * 
		 * @return string
		**/
		public static function shapeshifter_get_generated_tag( $element, $atts = array(), $text = '', $wrap = false ) {
			$return = '<' . $element;
			foreach( $atts as $key => $val ) { $return .= ' ' . esc_attr( $key ) . '="' . esc_attr( $val ) . '"'; }
			if ( $wrap ) {
				$return .= '>' . esc_html( $text ) . '</' . $element . '>';
			} else {
				if ( $text != '' ) { $return .= ' data-' . SHAPESHIFTER_THEME_PREFIX . 'text="' . esc_attr( $text ) . '"'; }
				$return .= '/>';
			}
			return $return;
		}

	#
	# Images
	#
		/**
		 * Print Default Post Thumbnail URL
		 * 
		 * @static
		 * 
		 * @param WP_Post $post
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts, $text, $wrap )
		**/
		public static function shapeshifter_the_default_thumbnail_url( $post ) {
			echo esc_url( ShapeShifter_Frontend_Methods::shapeshifter_get_the_default_thumbnail_url( $post ) );
		}

		/**
		 * Get Default Post Thumbnail URL
		 * 
		 * @static
		 * 
		 * @param WP_Post $post
		 * 
		 * @return string $url
		**/
		public static function shapeshifter_get_the_default_thumbnail_url( $post ) {

			$cat = get_the_category( $post->ID );

			if ( isset( $cat[ 0 ] ) ) {
				$default_cat_thumbnail = get_term_meta( $cat[ 0 ]->term_id, 'shapeshifter_term_default_thumbnail', true );
			} else {
				$default_cat_thumbnail = '';
			}

			$default_cat_thumbnail = esc_url( apply_filters( 'shapeshifter_defualt_thumbnail_url_before_set_theme_mod_value', $default_cat_thumbnail, $post ) );

			return esc_url( 
				$default_cat_thumbnail != ''
				? $default_cat_thumbnail
				: get_theme_mod( 'default_thumbnail_image', SHAPESHIFTER_ASSETS_DIR_URI . 'images/no-img.png' )
			);

		}

		/**
		 * Print Default Post Thumbnail in Div Tag
		 * 
		 * @static
		 * 
		 * @param string $class
		 * @param array $size
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_default_thumbnail_div_tag( $class, $size )
		**/
		public static function shapeshifter_default_thumbnail_div_tag( $class = 'default-post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ) ) {
			echo ShapeShifter_Frontend_Methods::shapeshifter_get_default_thumbnail_div_tag( $class, $size );
		}

		/**
		 * Get Default Post Thumbnail in Div Tag
		 * 
		 * @static
		 * 
		 * @param string $class                  : Default "default-post-thumbnail"
		 * @param array  $size                   : Default
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * @param string $optional_def_image_url : Default ""
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts = array(), $text = '', $wrap = false )
		 * 
		 * @return string
		**/
		public static function shapeshifter_get_default_thumbnail_div_tag( $class = 'default-post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ), $optional_def_image_url = '' ) {

			// カスタマイザーでデフォルトを設定している場合
			$default_thumbnail_url = esc_url( 
				$optional_def_image_url 
				? $optional_def_image_url 
				: get_theme_mod( 'default_thumbnail_image', '' )
				//: get_theme_mod( 'default_thumbnail_image', SHAPESHIFTER_ASSETS_DIR_URI . 'images/no-img.png' )
			);

			$atts = array(
				'class' => esc_attr( $class ? $class . ' default-thumbnail' : 'default-thumbnail' ),
				'style' => esc_attr( 'width: ' . $size[ 'width' ] . '; height: ' . $size[ 'height' ] . '; background-image: url(' . $default_thumbnail_url . '); background-size: ' . $size[ 'width' ] . ' ' . $size[ 'height' ] . '; background-position: center center; background-repeat: no-repeat;' )
			);
			$return = ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( 'div', $atts, '', true );

			return apply_filters( 'shapeshifter_filter_default_thumbnail_div_tag', $return, $class, $size, $optional_def_image_url );

		}

		/**
		 * Print Default Thumbnail IMG Tag
		 * 
		 * @static
		 * 
		 * @param string $class
		 * @param array $size
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_default_thumbnail_img_tag( $class, $size, $alt )
		**/
		public static function shapeshifter_default_thumbnail_img_tag( $class = 'default-post-thumbnail', $size = array( 'width' => 80, 'height' => 80 ), $alt = '' ) {
			echo ShapeShifter_Frontend_Methods::shapeshifter_get_default_thumbnail_img_tag( $class, $size, $alt );
		}

		/**
		 * Get Default Thumbnail IMG Tag
		 * 
		 * @static
		 * 
		 * @param string $class
		 * @param array $size
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts = array(), $text = '', $wrap = false )
		 * 
		 * @return string
		**/
		public static function shapeshifter_get_default_thumbnail_img_tag( $class = 'default-post-thumbnail', $size = array( 'width' => 80, 'height' => 80 ), $alt = '', $optional_def_image_url = '' ) {

			$default_thumbnail_url = esc_url( 
				$optional_def_image_url 
				? $optional_def_image_url 
				: get_theme_mod( 'default_thumbnail_image', SHAPESHIFTER_ASSETS_DIR_URI . 'images/no-img.png' )
			);

			$atts = array(
				'class' => esc_attr( $class ? $class . ' default-thumbnail' : 'default-thumbnail' ),
				'src' => esc_url( $default_thumbnail_url ),
				'width' => absint( $size[ 'width' ] ),
				'height' => absint( $size[ 'height' ] ),
				'alt' => esc_attr( $alt )
			);
			$return = ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( 'img', $atts, '', true );

			return apply_filters( 'shapeshifter_filter_default_thumbnail_img_tag', $return, $class, $size, $alt, $optional_def_image_url );

		}

		/**
		 * Print Image in Div
		 * 
		 * @static
		 * 
		 * @param int $post_id
		 * @param string $class
		 * @param array $size
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_post_thumbnail_div_tag( $post_id, $class, $size )
		**/
		public static function shapeshifter_post_thumbnail_div_tag( $post_id, $div_class = 'post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ) ) {
			echo ShapeShifter_Frontend_Methods::shapeshifter_get_post_thumbnail_div_tag( $post_id, $div_class, $size );
		}

		/**
		 * Get Default Thumbnail IMG Tag
		 * 
		 * @static
		 * 
		 * @param int $post_id
		 * @param string $class
		 * @param array $size
		 * 		'width' => "{$int}px",
		 * 		'height' => "{$int}px",
		 * 
		 * @see ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( $element, $atts = array(), $text = '', $wrap = false )
		 * 
		 * @return string
		**/
		public static function shapeshifter_get_post_thumbnail_div_tag( $post_id, $div_class = 'post-thumbnail', $size = array( 'width' => '80px', 'height' => '80px' ) ) {

			$post_thumbnail_url = esc_url( get_the_post_thumbnail( $post_id ) );

			if ( ! $post_thumbnail_url )
				return;

			$atts = array(
				'class' => esc_attr( $div_class ),
				'style' => 'background-image: url(' . $post_thumbnail_url . '); background-size: ' . esc_attr( $size[ 'width' ] ) . ' ' . esc_attr( $size[ 'height' ] ) . '; background-position: center center; background-repeat: no-repeat;'
			);
			$return = ShapeShifter_Frontend_Methods::shapeshifter_get_generated_tag( 'div', $atts );

			return apply_filters( 'shapeshifter_filter_post_thumbnail_div_tag', $return, $post_id, $div_class, $size );

		}

	#
	# Strings
	#
		/**
		 * Get Modified Time
		 * 
		 * @static
		 * 
		 * @param string $format
		 * 
		 * @return string
		**/
		public static function get_mtime( $format ) {

			// Modified Time
			$mtime = get_the_modified_time( 'Ymd' ); 

			// Publish Time
			$ptime = get_the_time( 'Ymd' );

			// Not Modified ( Publish > Modified )
			if ( $ptime > $mtime ) { 
				return date_i18n( $format );
			}
			// Not Modified ( Publish = Modified )
			elseif ( $ptime === $mtime ) { 
				return date_i18n( $format );
			}
			// Modified ( Publish < Modified )
			else { 
				return get_the_modified_time( $format );
			}
		}

		/**
		 * Get Post Format Name
		 * 
		 * @static
		 * 
		 * @param WP_Post $post
		 * 
		 * @return string
		**/
		public static function get_post_format_name( $post ) {
			$current_post_id = intval( get_post()->ID );
			$format = get_post_format( $current_post_id );
			return $format;
		}

}

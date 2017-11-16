<?php

if( ! class_exists( 'ShapeShifter_Frontend_HTML_Parts' ) ) {

/**
 * Frontend HTML Parts
 * 
**/
class ShapeShifter_Frontend_HTML_Parts {

	/**
	 * Edit Shortcut for Theme Customizer
	 * 
	 * @param string $setting_id
	 * @param string $label
	 * 
	 * @return string
	**/
	public static function editor_shortcut_for_theme_customizer( $setting_id, $label = '' ) {

		echo self::get_edit_shortcut_for_theme_customizer( $setting_id, $label );

	}

	/**
	 * Edit Shortcut for Theme Customizer
	 * 
	 * @param string $setting_id
	 * @param string $label
	 * 
	 * @return string
	**/
	public static function get_edit_shortcut_for_theme_customizer( $setting_id, $label = '' ) {

		if( empty( $label ) )
			$label = esc_html__( 'Click to edit this.', 'shapeshifter' );

		$return = '';

		$return .= '<span class="customize-partial-edit-shortcut customize-partial-edit-shortcut-blogname shapeshifter-shortcut-to-related-setting">';
				$return .= '<button aria-label="' . esc_attr( $label ) . '" title="' . esc_attr( $label ) . '" class="customize-partial-edit-shortcut-button" data-setting-id="' . esc_attr( $setting_id ) . '">';
					$return .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">';
						$return .= '<path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path>';
					$return .= '</svg>';
				$return .= '</button>';
		$return .= '</span>';

		return apply_filters( 'shapeshifter_filter_edit_shortcut_icon_for_theme_customizer', $return, $setting_id, $label );

	}

} // End Closure

}

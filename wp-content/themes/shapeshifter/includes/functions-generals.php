<?php
if ( ! function_exists( 'shapeshifter_boolval' ) ) {
	/**
	 * Check if the Var in Boolean
	 * 
	 * @param mixed $val
	**/
	function shapeshifter_boolval( $val ) {
		return ( bool ) intval( $val );
	}
}

if( ! function_exists( 'shapeshifter_print_edit_shortcut_for_theme_customizer' ) ) {
	/**
	 * Edit Shortcut for Theme Customizer
	 * 
	 * @param string $setting_id
	 * @param string $label
	 * 
	 * @return string
	**/
	function shapeshifter_print_edit_shortcut_for_theme_customizer( $setting_id, $label = '' ) {

		if( SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW ) {

			ShapeShifter_Frontend::editor_shortcut_for_theme_customizer( $setting_id, $label );

		}

	}
}

/**
 * Return EOF String
**/
if ( ! function_exists( 'shapeshifter_get_string_eof' ) ) { function shapeshifter_get_string_eof( $string ) {
$return = <<< EOF
{$string}
EOF;
return $return;
} }


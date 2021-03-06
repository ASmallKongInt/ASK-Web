<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class MedZone_Lite_Notify_System
 */
class MedZone_Lite_Notify_System extends Epsilon_Notify_System {
	/**
	 * Check installed data
	 */
	public static function check_installed_data() {
		$imported = get_theme_mod( 'medzone_lite_content_imported', false );

		return $imported;
	}

	/**
	 * Verify the status of a plugin
	 *
	 * @param string      $get         Return title/description/etc.
	 * @param string      $slug        Plugin slug.
	 * @param string      $plugin_name Plugin name.
	 * @param bool|string $special     Callback to verify a certain plugin
	 *
	 * @return mixed
	 */
	public static function plugin_verifier( $slug = '', $get = '', $plugin_name = '', $special = false ) {
		if ( false !== $special ) {
			$arr = self::$special();
		} else {
			$arr = array(
				'installed' => Epsilon_Notify_System::check_plugin_is_installed( $slug ),
				'active'    => Epsilon_Notify_System::check_plugin_is_active( $slug ),
			);

			if ( empty( $get ) ) {
				$arr = array_filter( $arr );

				return 2 === count( $arr );
			}
		}

		// Translators: %s is the plugin name.
		$arr['title'] = sprintf( __( 'Install: %s', 'medzone-lite' ), $plugin_name );
		// Translators: %s is the plugin name.
		$arr['description'] = sprintf( __( 'Please install %s in order to create the demo content.', 'medzone-lite' ), $plugin_name );

		if ( $arr['installed'] ) {
			// Translators: %s is the plugin name
			$arr['title'] = sprintf( __( 'Activate: %s', 'medzone-lite' ), $plugin_name );
			// Translators: %s is the plugin name
			$arr['description'] = sprintf( __( 'Please activate %s in order to create the demo content.', 'medzone-lite' ), $plugin_name );
		}

		return $arr[ $get ];
	}

	/**
	 * Verify that contact form 7 is installed
	 *
	 * @return mixed
	 */
	public static function verify_cf7() {
		$arr = array(
			'installed' => false,
			'active'    => false,
		);

		if ( file_exists( ABSPATH . 'wp-content/plugins/contact-form-7' ) ) {
			$arr['installed'] = true;
			$arr['active']    = defined( 'WPCF7_VERSION' );
		}

		return $arr;
	}
}

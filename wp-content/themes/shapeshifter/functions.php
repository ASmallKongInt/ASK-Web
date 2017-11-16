<?php
# Check if This is read by WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

# Trigger
# Options
if ( ! isset( $GLOBALS[ 'shapeshifter_options' ] ) ) 
	$GLOBALS[ 'shapeshifter_options' ] = array();

# Define Class
if ( ! class_exists( 'ShapeShifter' ) ) 
	require_once( 'includes/class-shapeshifter.php' );

if ( class_exists( 'ShapeShifter' ) && ! isset( $GLOBALS[ 'shapeshifter' ] ) )
	$GLOBALS[ 'shapeshifter' ] = new ShapeShifter( $GLOBALS[ 'shapeshifter_options' ] );

# Version Check
/**
 * Check that we can use PHP 5.4 and fail if not
 * 
 * @param string $old_name
 * @param object $old_theme
 */
function shapeshifter_version_check( $old_name, $old_theme ) {
	
	if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
		
		function shapeshifer_version_check_notices() {
			echo '<div class="update-nag">';
			printf( __( 'This theme requires PHP version 5.4.0. You are currently using %s.', 'shapeshifter' ), PHP_VERSION );
			echo '</div>';
		}
		add_action( 'admin_notices', 'shapeshifer_version_check_notices' );
		
		switch_theme( $old_theme->stylesheet );

	}

}
add_action( 'after_switch_theme', 'shapeshifter_version_check', 10, 2 );

# TGM Plugin Activation
	if ( ! function_exists( 'shapeshifter_recommends_plugins' ) && is_admin() ) { 

		require_once( SHAPESHIFTER_THIRD_DIR . 'TGM-Plugin-Activation/class-tgm-plugin-activation.php' );
		add_action( 'tgmpa_register', 'shapeshifter_recommends_plugins' );
		function shapeshifter_recommends_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(

				// This is an example of how to include a plugin bundled with a theme.
				array(
					'name'      => 'WP Theme ShapeShifter Extensions', // The plugin name.
					'slug'      => 'wp-theme-shapeshifter-extensions', // The plugin slug (typically the folder name).
					'required'  => false,
				),

			);

			/*
			 * Array of configuration settings. Amend each line as needed.
			 *
			 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
			 * strings available, please help us make TGMPA even better by giving us access to these translations or by
			 * sending in a pull-request with .po file(s) with the translations.
			 *
			 * Only uncomment the strings in the config array if you want to customize the strings.
			 */
			$config = array(
				'id'           => 'shapeshifter_extensions',                 // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.

				'strings'      => array(
					'page_title'                      => esc_html__( 'Install Required Plugins', 'shapeshifter' ),
					'menu_title'                      => esc_html__( 'Install Plugins', 'shapeshifter' ),
					'installing'                      => esc_html__( 'Installing Plugin: %s', 'shapeshifter' ), // %s = plugin name.
					'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'shapeshifter' ),
					'notice_can_install_required'     => _n_noop(
						'This theme requires the following plugin: %1$s.',
						'This theme requires the following plugins: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop(
						'This theme recommends the following plugin: %1$s.',
						'This theme recommends the following plugins: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop(
						'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop(
						'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
						'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_ask_to_update_maybe'      => _n_noop(
						'There is an update available for: %1$s.',
						'There are updates available for the following plugins: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop(
						'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop(
						'The following required plugin is currently inactive: %1$s.',
						'The following required plugins are currently inactive: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop(
						'The following recommended plugin is currently inactive: %1$s.',
						'The following recommended plugins are currently inactive: %1$s.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop(
						'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
						'shapeshifter'
					), // %1$s = plugin name(s).
					'install_link'                    => _n_noop(
						'Begin installing plugin',
						'Begin installing plugins',
						'shapeshifter'
					),
					'update_link' 					  => _n_noop(
						'Begin updating plugin',
						'Begin updating plugins',
						'shapeshifter'
					),
					'activate_link'                   => _n_noop(
						'Begin activating plugin',
						'Begin activating plugins',
						'shapeshifter'
					),
					'return'                          => esc_html__( 'Return to Required Plugins Installer', 'shapeshifter' ),
					'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'shapeshifter' ),
					'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'shapeshifter' ),
					'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'shapeshifter' ),  // %1$s = plugin name(s).
					'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'shapeshifter' ),  // %1$s = plugin name(s).
					'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'shapeshifter' ), // %s = dashboard link.
					'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'shapeshifter' ),

					'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				),
			);

			tgmpa( $plugins, $config );

		}

	}

?>
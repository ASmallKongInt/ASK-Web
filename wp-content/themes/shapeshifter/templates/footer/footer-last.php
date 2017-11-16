<?php
# Action Hook "shapeshifter_footer_last"
# Filter Hook "shapeshifter_filters_footer_last"

global $shapeshifter_content_width;

echo '<footer id="footer" class="footer-' . absint( $shapeshifter_content_width ) . esc_attr( 
	SHAPESHIFTER_IS_MOBILE 
	? '-for-mobile' 
	: '' 
) . '">' . PHP_EOL;

	ob_start();
		shapeshifter_widget_areas_in_footer();
	$in_footer = ob_get_clean();
	if( ! empty( $in_footer ) ) {
		echo '<div class="widget-area-in-footer-wrapper">' . PHP_EOL;
			echo $in_footer;
		echo '</div>' . PHP_EOL;
	}
	unset( $in_footer );

	echo '<div id="footer-items">' . PHP_EOL;

		if ( $GLOBALS[ 'shapeshifter_footer_nav_menu' ] != '' ) {
			echo '<div id="footer-nav-menu" class="footer-p">';
				echo $GLOBALS[ 'shapeshifter_footer_nav_menu' ];
			echo '</div>' . PHP_EOL;
		}


		echo '<p id="footer-description" class="footer-p">';

			// For Description
			shapeshifter_print_edit_shortcut_for_theme_customizer( 'footer_display_description' );

			echo '<span id="footer-description-text">';
				echo esc_html( SHAPESHIFTER_SITE_DESCRIPTION );
			echo '</span>';

		echo '</p>' . PHP_EOL;



		echo '<p id="footer-license" class="footer-p">';
			// For License Display
			shapeshifter_print_edit_shortcut_for_theme_customizer( 'footer_display_credit_type' );

			echo '<span id="footer-license-text">';
				shapeshifter_footer_license_type();
			echo '</span>';

		echo '</p>' . PHP_EOL;

		echo '<p id="footer-theme" class="footer-p" itemscope itemtype="https://schema.org/CreativeWork">';

			// For Theme Display
			shapeshifter_print_edit_shortcut_for_theme_customizer( 'footer_display_theme' );

			esc_html_e( 'Theme', 'shapeshifter' );
			echo ' <a class="footer-a" target="_blank" href="http://wp-works.net" itemprop="url"><span itemprop="name">' . esc_html( SHAPESHIFTER_THEME_NAME ) . '</span></a>';
		echo '</p>' . PHP_EOL;

	echo '</div>';

echo '</footer>' . PHP_EOL;

echo '<div class="clearfix"></div>' . PHP_EOL;


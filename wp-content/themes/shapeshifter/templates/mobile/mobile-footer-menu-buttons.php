<?php
# Action Hook "shapeshifter_footer_menu_for_mobile"
# Filter Hook "shapeshifter_filters_footer_menu_for_mobile"

echo '<div class="fixed-menu-buttons-for-mobile">' . PHP_EOL;
	echo '<a id="slide-menu" class="menu-button-for-mobile-a" href="javascript:void(0);">' . PHP_EOL;
		echo '<div class="mobile-menu-button-icon-box"><span class="fa fa-list menu-icon"></span></div>' . PHP_EOL;
		echo '<div class="mobile-menu-button-text-box"><span class="menu-text">' . esc_html_x( 'Menu', 'Mobile Button', 'shapeshifter' ) . '</span></div>' . PHP_EOL;
	echo '</a>' . PHP_EOL;
	echo '<a id="widget-area-only-for-mobile" class="menu-button-for-mobile-a" href="' . esc_url( SHAPESHIFTER_SITE_URL ) . '">' . PHP_EOL;
		echo '<div class="mobile-menu-button-icon-box"><span class="fa fa-home menu-icon"></span></div>' . PHP_EOL;
		echo '<div class="mobile-menu-button-text-box"><span class="menu-text">' . esc_html_x( 'Home', 'Mobile Button', 'shapeshifter' ) . '</span></div>' . PHP_EOL;
	echo '</a>' . PHP_EOL;
	echo '<a id="bottom-menu-scroll-to-top" class="menu-button-for-mobile-a scroll-to-top" href="javascript:void(0);">' . PHP_EOL;
		echo '<div class="mobile-menu-button-icon-box"><span class="fa fa-arrow-up menu-icon"></span></div>' . PHP_EOL;
		echo '<div class="mobile-menu-button-text-box"><span class="menu-text">' . esc_html_x( 'Top', 'Mobile Button', 'shapeshifter' ) . '</span></div>' . PHP_EOL;
	echo '</a>' . PHP_EOL;
	if( SHAPESHIFTER_IS_MOBILE ) {
		echo '<a id="mobile-side-menu" class="menu-button-for-mobile-a" href="javascript:void(0);">' . PHP_EOL;
			echo '<div class="mobile-menu-button-icon-box"><span class="fa fa-object-group menu-icon"></span></div>' . PHP_EOL;
			echo '<div class="mobile-menu-button-text-box"><span class="menu-text">' . esc_html_x( 'Widgets', 'Mobile Button', 'shapeshifter' ) . '</span></div>' . PHP_EOL;
		echo '</a>' . PHP_EOL;
	}
echo '</div>' . PHP_EOL;

<?php
# Action Hook "shapeshifter_nav_menu"
# Filter Hook "shapeshifter_filters_header_nav"

global $shapeshifter_content_width, $shapeshifter_theme_mods;

	$nav_menu_args = array( 
		'theme_location' => 'navbar',
		//'depth' => 2,
		'echo' => false, 
		'fallback_cb' => false,
		'walker' => $GLOBALS[ 'shapeshifter_walker_nav_menu_instance_navbar' ]
	);

	$nav_is_mobile = shapeshifter_boolval( wp_nav_menu( $nav_menu_args ) === false );

	if ( ! SHAPESHIFTER_IS_MOBILE ) {

		if ( ! $nav_is_mobile ) {

			$nav_menu_args = array( 
				'container_class' => 'shapeshifter-main-nav-div',
				'menu_class' => 'shapeshifter-main-nav-menu',
				'theme_location' => 'navbar',
				'depth' => 3,
				'echo' => false, 
				'fallback_cb' => false,
				'walker' => $GLOBALS[ 'shapeshifter_walker_nav_menu_instance_navbar' ]
			);

			$nav_menu_output = substr_replace( 
				wp_nav_menu( $nav_menu_args ),
				'<li id="nav-menu-search-box" class="menu-item">' . get_search_form( false ) . '</li>',
				-11,
				0
			);

		} else {

			$nav_menu_args = array( 
				'container_class' => 'shapeshifter-mobile-nav-div',
				'menu_class' => 'shapeshifter-mobile-nav-menu',
				'theme_location' => 'top_nav',
				//'depth' => 2,
				'echo' => false, 
				'fallback_cb' => false,
				'walker' => $GLOBALS[ 'shapeshifter_walker_nav_menu_instance_mobile_nav_menu' ]
			);

			$nav_menu_output = substr_replace( 
				wp_nav_menu( $nav_menu_args ),
				'<li id="nav-menu-search-box" class="menu-item">' . get_search_form( false ) . '</li>',
				-11,
				0
			);

		}

	} else {

		$nav_is_mobile = true;

		$nav_menu_args = array( 
			'container_class' => 'shapeshifter-mobile-nav-div',
			'menu_class' => 'shapeshifter-mobile-nav-menu',
			'theme_location' => 'top_nav',
			//'depth' => 2,
			'echo' => false, 
			'fallback_cb' => false,
			'walker' => $GLOBALS[ 'shapeshifter_walker_nav_menu_instance_mobile_nav_menu' ]
		);

		$nav_menu_output = substr_replace( 
			wp_nav_menu( $nav_menu_args ),
			'<li id="nav-menu-search-box" class="menu-item">' . get_search_form( false ) . '</li>',
			-11,
			0
		);

	}
	unset( $nav_menu_args );

$either_primary_or_second = ( 
	$nav_is_mobile 
	? esc_html__( 'Primary Navigation', 'shapeshifter' ) 
	: esc_html( 
		$GLOBALS[ 'shapeshifter_top_nav_menu' ] != '' 
		? __( 'Secondary Navigation', 'shapeshifter' ) 
		: __( 'Primary Navigation', 'shapeshifter' ) 
	)
);
$either_main_or_mobile = ( 
	$nav_is_mobile 
	? 'mobile' 
	: 'main' 
);
echo '<nav
	aria-label="' . esc_attr( $either_primary_or_second ) . '"
	class="shapeshifter-' . esc_attr( $either_main_or_mobile ) . '-nav shapeshifter-' . esc_attr( $either_main_or_mobile ) . '-regular-nav"
>';
	echo '<div
		id="shapeshifter-' . esc_attr( $either_main_or_mobile ) . '-nav-wrapper-div"
		class="shapeshifter-' . esc_attr( $either_main_or_mobile ) . '-nav-wrapper-div"
	>';
		$shapeshifter_theme_mods[ 'is_nav_menu_fixed' ] = null;

		echo '<p class="shapeshifter-mobile-nav-top-title">' . esc_html__( 'Nav Menu', 'shapeshifter' ) . '</p>';

		echo $nav_menu_output;
		unset( $nav_menu_output );

	echo '</div>';
echo '</nav>';

if ( ! $nav_is_mobile ) {
	echo '<div id="div-after-main-nav"></div>';
}
unset( $nav_is_mobile );

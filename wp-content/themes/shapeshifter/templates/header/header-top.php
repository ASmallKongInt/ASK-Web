<?php
# Action Hook "shapeshifter_header_top"
# Filter Hook "shapeshifter_filters_header_top"

global $shapeshifter_content_width, $shapeshifter_content_inner_width;

# Nav Menu
	echo '<header class="shapeshifter-header shapeshifter-header-nav-visible ' . esc_attr( 
		! SHAPESHIFTER_IS_MOBILE 
		? 'shapeshifter-min-width-' . absint( $shapeshifter_content_width ) 
		: 'shapeshifter-max-width-' . absint( $shapeshifter_content_width ) 
	) . '">' . PHP_EOL;

		echo '<div id="shapeshifter-header-inner-wrapper"' . esc_attr( 
			! SHAPESHIFTER_IS_MOBILE 
			? ' class="shapeshifter-max-width-' . absint( $shapeshifter_content_width ) . '"' 
			: '' 
		) . '>';

			# Title Description
				echo '<div id="shapeshifter-header-title-wrapper">';

					if( SHAPESHIFTER_IS_CUSTOMIZE_PREVIEW ) {
						ShapeShifter_Frontend::editor_shortcut_for_theme_customizer( 'blogname' );
					}

					echo '<' . ( 
						( 
							( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE )
							|| ( SHAPESHIFTER_IS_FRONT_PAGE )
						)
						? 'h1' 
						: 'p' 
					) . ' id="shapeshifter-header-site-name-' . esc_attr( 
						( 
							( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE )
							|| ( SHAPESHIFTER_IS_FRONT_PAGE )
						)
						? 'h1' 
						: 'p' 
					) . '" class="shapeshifter-header-site-name"><a href="' . esc_url( SHAPESHIFTER_SITE_URL ) . '">' . esc_html( SHAPESHIFTER_SITE_NAME ) . '</a></' . ( 
						( 
							( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE )
							|| ( SHAPESHIFTER_IS_FRONT_PAGE )
						)
						? 'h1' 
						: 'p' 
					) . '>' . PHP_EOL; 
					echo '<p id="shapeshifter-header-description-p" class="shapeshifter-header-description">' . esc_html( SHAPESHIFTER_SITE_DESCRIPTION ) . '</p>' . PHP_EOL;
				echo '</div>';

			# Header Nav Menu
				if ( $GLOBALS[ 'shapeshifter_top_nav_menu' ] != '' 
					&& ! SHAPESHIFTER_IS_MOBILE 
				) {
					echo '<nav aria-label="' . esc_attr__( 'Primary Navigation', 'shapeshifter' ) . '" id="top-menu-nav">';
						echo $GLOBALS[ 'shapeshifter_top_nav_menu' ];
					echo '</nav>';
				}

		echo '</div>';

	echo '</header>' . PHP_EOL;

	if( shapeshifter_boolval( $GLOBALS['shapeshifter_theme_mods']['is_nav_menu_fixed'] ) )
		echo '<div class="space-after-header-for-fixed"></div>';


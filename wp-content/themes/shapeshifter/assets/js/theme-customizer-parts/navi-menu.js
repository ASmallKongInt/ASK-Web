( function( $ ) {

	console.log( 'navi-menu.js' );

	/* Description Font Family */
	wp.customize( 'nav_text_font_family', function( value ) {
		value.bind( function( newval ) {
			window.shapeshifterThemeMods.nav_text_font_family = newval;
			$( '#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav { font-family: ' + newval + '; } ' );
		});
	});

	/* Nav Menu Scroll Fix */
	wp.customize( 'is_nav_menu_fixed', function( value ) {
		value.bind( function( newval ) {
			window.shapeshifterThemeMods.is_nav_menu_fixed = newval;
			if( newval ) {
				$( '.shapeshifter-main-regular-nav' ).addClass( 'shapeshifter-nav-menu-fixed' );
			} else {
				$( '.shapeshifter-main-regular-nav' ).removeClass( 'shapeshifter-nav-menu-fixed' );
				$( '.shapeshifter-main-regular-nav' ).css({ 'position': 'initial' });
			}
		});
	});

	/* Item Sizes */
	wp.customize( 'nav_menu_width', function( value ) {
		value.bind( function( newval ) {
			window.shapeshifterThemeMods.nav_menu_width = newval;
			//$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav-menu { max-width: ' + newval + 'px; } ' );
			$( '.shapeshifter-main-nav-menu' ).css( 'max-width', newval + 'px' );
		});
	});
	
	/* Add Search Box */
	wp.customize( 'nav_menu_add_search_box', function( value ) {
		value.bind( function( newval ) {
			window.shapeshifterThemeMods.nav_menu_add_search_box = newval;
			if( newval ) {
				$( '#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > #nav-menu-search-box { display: block; } ' );
				//$( '#nav-menu-search-box' ).css( 'display', 'block' );
			} else {
				$( '#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > #nav-menu-search-box { display: none; } ' );
				//$( '#nav-menu-search-box' ).css( 'display', 'none' );
			}
		});
	});

	/* Colors */
		/* navimenu text color */
		wp.customize( 'nav_font_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.nav_font_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav-menu .menu-item a { color: ' + newval + '; } ' );
				//$( '.shapeshifter-main-nav-menu .menu-item a' ).css( 'color', newval );
			});
		});

		/* Background Gradient On */
		wp.customize( 'nav_background_gradient_on', function( value ){
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.nav_background_gradient_on = newval;

				if( newval ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav { background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + window.shapeshifterThemeMods.nav_background_color + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.nav_background_color + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.nav_background_color + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav { background:none; background-color:' + window.shapeshifterThemeMods.nav_background_color + '; }' );

				}

			});
		});

		/* Background Color */
		wp.customize( 'nav_background_color', function( value ) {
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.nav_background_color = newval;

				if( window.shapeshifterThemeMods.nav_background_gradient_on ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav { background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + newval + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav { background:none; background-color:' + newval + '; }' );

				}
			});
		});

		/* Item Background Gradient On */
		wp.customize( 'nav_items_background_gradient_on', function( value ){
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.nav_items_background_gradient_on = newval;
				//changeThemeModsVar( 'nav_items_background_gradient_on', newval );
				console.log( window.shapeshifterThemeMods );

				if( newval ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item{ background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + window.shapeshifterThemeMods.nav_items_background_color + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.nav_items_background_color + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.nav_items_background_color + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item{ background:none; background-color:' + window.shapeshifterThemeMods.nav_items_background_color + '; }' );

				}

			});
		});

		/* Item Background Color */
		wp.customize( 'nav_items_background_color', function( value ) {
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.nav_items_background_color = newval;
				//changeThemeModsVar( 'nav_items_background_color', newval );
				console.log( window.shapeshifterThemeMods );
				if( window.shapeshifterThemeMods.nav_items_background_gradient_on ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item{ background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + newval + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav ul.shapeshifter-main-nav-menu > li.menu-item{ background:none; background-color:' + newval + '; }' );

				}

			});
		});
		
		/* navimenu border color */
		wp.customize( 'header_image_and_nav_border_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_and_nav_border_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav { border-top-color: ' + newval + '; } ' );
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav { border-bottom-color: ' + newval + '; } ' );
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav { box-shadow: 0 2px 4px ' + newval + '; } ' );
				//$( '.shapeshifter-main-nav' ).css( 'border-top-color', newval );
				//$( '.shapeshifter-main-nav' ).css( 'border-bottom-color', newval );
				//$( '.shapeshifter-main-nav' ).css( 'box-shadow', '0 2px 4px ' + newval );
			});
		});
		/* navimenu border color */
		wp.customize( 'nav_items_selected_border_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.nav_items_selected_border_color = newval;
				if( newval )
					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav li.menu-item:hover > a, nav.shapeshifter-main-regular-nav li.menu-item:hover > a:link, nav.shapeshifter-main-regular-nav li.menu-item:hover > a:visited { border-bottom: solid ' + newval + ' 1px; } .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a, .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:link, .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:visited { border-bottom: solid ' + newval + ' 2px; }' );
				else
					$( 'style#shapeshifter-theme-customize-preview' ).append( 'nav.shapeshifter-main-regular-nav li.menu-item:hover > a, nav.shapeshifter-main-regular-nav li.menu-item:hover > a:link, nav.shapeshifter-main-regular-nav li.menu-item:hover > a:visited { border-bottom: none; } .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a, .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:link, .shapeshifter-main-regular-nav .shapeshifter-main-nav-menu > li.menu-item:hover > a:visited { border-bottom: none; }' );
			});
		});
		
	
	/* Background Image */
	wp.customize( 'nav_menu_background_image', function( value ) {
		value.bind( function( newval ){
			window.shapeshifterThemeMods.header_image_and_nav_border_color = newval;
			if ( newval == "" ){
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav { background-image: none; } ' );
				/*$( '.shapeshifter-main-nav' ).css( {
					'background-image': 'none',
				} );*/
			} else {
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav { background-image: url( ' + newval + ' ); background-repeat: repeat; } ' );
				/*$( '.shapeshifter-main-nav' ).css( {
					'background-image': 'url( ' + newval + ' )',
					'background-repeat': 'repeat'
				} );*/
			}
		} );
	} );
	
	/* Background Image for each Navimenu Items */
	wp.customize( 'nav_menu_items_background_image', function( value ) {
		value.bind( function( newval ) {
			window.shapeshifterThemeMods.nav_menu_items_background_image = newval;
			if ( newval == "" ) {
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav-div > .menu-item a { background-image: none; } ' );
				/*$( '.shapeshifter-main-nav-div > .menu-item a' ).css( {
					'background-image': 'none',
				} );*/
			} else {
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-main-nav-div > .menu-item a { background-image: url( ' + newval + ' ); background-size: contain; background-repeat: no-repeat; } ' );
				/*$( '.shapeshifter-main-nav-div > .menu-item a' ).css( {
					'background-image': 'url( ' + newval + ' )',
					'background-size': 'contain',
					'background-repeat': 'no-repeat'
				} );*/
			}
		} );
	} );
	
}) ( jQuery );
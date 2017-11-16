/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Top header color
	wp.customize( 'suparnova_options[top_header_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'dark' === to ) {
				$('.site-top-header').addClass('dark-colors');
			} else {
				$('.site-top-header').removeClass('dark-colors');
			}
		} );
	} );
	wp.customize( 'suparnova_options[top_header_sub_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'dark' === to ) {
				$('.site-top-header').addClass('dark-hover');
			} else {
				$('.site-top-header').removeClass('dark-hover');
			}
		} );
	} );

	// Top header texts
	wp.customize( 'suparnova_options[top_header_left_txt]', function( value ) {
		value.bind( function( to ) {
			$('.site-top-header .menu-left p').text(to);
		} );
	} );
	wp.customize( 'suparnova_options[top_header_right_txt]', function( value ) {
		value.bind( function( to ) {
			$('.site-top-header .menu-right p').text(to);
		} );
	} );

	// Main menu color
	wp.customize( 'suparnova_options[menu_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'dark' === to ) {
				$('.main-navigation').addClass('dark-colors');
			} else {
				$('.main-navigation').removeClass('dark-colors');
			}
		} );
	} );
	wp.customize( 'suparnova_options[menu_sub_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'dark' === to ) {
				$('.desktop-menu').addClass('dark-hover');
			} else {
				$('.desktop-menu').removeClass('dark-hover');
			}
		} );
	} );

	// Main menu alignment
	wp.customize( 'suparnova_options[menu_alignment]', function( value ) {
		value.bind( function( to ) {
			if( 'center' === to ) {
				$('.main-navigation').removeClass('align-right').addClass('align-center');
			} else if( 'right' === to ) {
				$('.main-navigation').removeClass('align-center').addClass('align-right');
			} else {
				$('.main-navigation').removeClass('align-right align-center');
			}
		} );
	} );
	
	// Logo alignment
	wp.customize( 'suparnova_options[logo_alignment]', function( value ) {
		value.bind( function( to ) {
			if( 'center' === to ) {
				$('.site-branding').removeClass('align-right').addClass('align-center');
			} else if( 'right' === to ) {
				$('.site-branding').removeClass('align-center').addClass('align-right');
			} else {
				$('.site-branding').removeClass('align-right align-center');
			}
		} );
	} );
	
	// Logo area height
	wp.customize( 'suparnova_options[logo_area_height]', function( value ) {
		value.bind( function( to ) {
			$('.site-branding .container').height(to);
		} );
	} );
	
	// Footer Copyright text
	wp.customize( 'suparnova_options[copyright]', function( value ) {
		value.bind( function( to ) {
			$('.site-footer .site-info').html(to);
		} );
	} );
	
} )( jQuery );
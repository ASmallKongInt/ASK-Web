( function( $ ) {
	
	console.log( 'footer.js' );

	/* Font */
		/* Family */
		wp.customize( 'footer_font_family', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_font_family = newval;
				if( newval !== "0" ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p.footer-p { font-family: ' + newval + '; } ' );
					//$( '#footer p' ).css( 'font-family', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p.footer-p { font-family: none; } ' );
					//$( '#footer p' ).css( 'font-family', 'none' );
				}
			});
		});
		/* Size */
		wp.customize( 'footer_font_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_font_size = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p.footer-p { font-size: ' + newval + 'px; } ' );
				//$( '#footer p' ).css( 'font-size', newval + 'px' );
			});
		});
	
	/* Align */
		wp.customize( 'footer_align_select', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_align_select = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p.footer-p { text-align: ' + newval + '; } ' );
				//$( '#footer p' ).css( 'text-align', newval );
			});
		});
	
	/* Display */
		/* Description */
		wp.customize( 'footer_display_description', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_display_description = newval;
				if( newval ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p#footer-description { display: block; } ' );
					//$( '#footer-description' ).css('display', 'block');
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items p#footer-description { display: none; } ' );
					//$( '#footer-description' ).css('display', 'none');
				}
			});
		});
		
		/* Theme */
		wp.customize( 'footer_display_theme', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_display_theme = newval;
				if( newval ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items #footer-theme { display: block; } ' );
					//$( '#footer-theme' ).css('display', 'block');
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-outer-wrapper #footer #footer-items #footer-theme { display: none; } ' );
					//$( '#footer-theme' ).css('display', 'none');
				}
			});
		});
		
		/* Copyright Year */
		wp.customize( 'footer_copyright_year', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_copyright_year = newval;
				$( '#copyright-year' ).text( newval );
			});
		});
		
		/* License */
		wp.customize( 'footer_display_credit_type', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_display_credit_type = newval;
				var siteName = window.shapeshifterThemeMods.blogname;
				if( newval == 'none' ) {
					$( '#footer #footer-license' ).css({ 'display': 'none' });
				} else if( newval == 'all' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.allRightsReserved.replace( '%1$d', window.shapeshifterThemeMods.footer_copyright_year ).replace( '%2$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccBy.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by-sa' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccBySa.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by-nd' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccByNd.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by-nc' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccByNc.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by-nc-sa' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccByNcSa.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc-by-nc-nd' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.ccByNcNd.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'cc0' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.cc0.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				} else if( newval == 'public' ) {
					$( '#footer #footer-license-text' ).html( shapeshifterJSTranslatedObject.public.replace( '%1$s', siteName ) );
					$( '#footer #footer-license' ).css({ 'display': 'block' });
				}
			});
		});
	
	/* Background Image */
		/* Select */
		wp.customize( 'footer_background_image_select', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_select = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-image: url(' + newval + '); } ' );
				//$( '#footer-items' ).css('background-image', 'url(' + newval + ')' );
			});
		});
		
		/* Size */
		wp.customize( 'footer_background_image_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_size = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-size: ' + newval + '; } ' );
				//$( '#footer-items' ).css( 'background-size', newval );
			});
		});
		
		/* Position */
		wp.customize( 'footer_background_image_position_row', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_position_row = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-position-y: ' + newval + '; } ' );
				//$( '#footer-items' ).css( 'background-position-y', newval );
			});
		});
		wp.customize( 'footer_background_image_position_column', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_position_column = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-position-x: ' + newval + '; } ' );
				//$( '#footer-items' ).css( 'background-position-x', newval );
			});
		});
		
		/* Repeat */
		wp.customize( 'footer_background_image_repeat', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-repeat: ' + newval + '; } ' );
				//$( '#footer-items' ).css( 'background-repeat', newval );
			});
		});

		/* Attachment */
		wp.customize( 'footer_background_image_attachment', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-attachment: ' + newval + '; } ' );
				//$( '#footer-items' ).css( 'background-attachment', newval );
			});
		});

	/* Colors */
		/* footer background color */
		wp.customize( 'footer_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_background_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items { background-color: ' + newval + '; } ' );
				//$( '#footer-items' ).css('background-color', newval);
			});
		});
		
		/* footer text color */
		wp.customize( 'footer_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.footer_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '#footer-items p.footer-p, #footer-items a, #footer-items a:link, #footer-items a:visited { color: ' + newval + '; } ' );
				//$( '.footer-p, .footer-a' ).css('color', newval);
			});
		});

}) ( jQuery );
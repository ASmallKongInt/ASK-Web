( function( $ ) {
	
	console.log( 'body.js' );

	/* WP */
		/* Site Title */
		wp.customize( 'blogname', function( value ) {
			value.bind( function( newval ){
				window.shapeshifterThemeMods.blogname = newval;
				$( '.shapeshifter-header-site-name > a' ).text( newval );
				$( '.shapeshifter-footer-site-name' ).text( newval );
			});
		});

		/* Site Description */
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( newval ){
				window.shapeshifterThemeMods.blogdescription = newval;
				$( '.shapeshifter-header-description' ).text( newval );
				$( '#footer-description-span' ).text( newval );
			});
		});

	/* Custom CSS */
		/* Text Font Family */
		wp.customize( 'text_font_family', function( value ) {
			value.bind( function( newval ){
				window.shapeshifterThemeMods.text_font_family = newval;
					if( newval !== "none" ) {
					$( '#shapeshifter-theme-customize-preview' ).append( 'body { font-family: ' + newval + '; } ' );
					//$( 'body' ).css( 'font-family', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( 'body { font-family: none; } ' );
					//$( 'body' ).css( 'font-family', 'none' );
				}
			});
		});

	/* Common Background */
		/* Background Color */
			wp.customize( 'body_background_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.body_background_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( 'body { background-color: ' + newval + '; } ' );
				});
			});

		/* Text Color */
			wp.customize( 'text_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.text_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( 'h1, h2, h3, h4, h5, h6, p { color: ' + newval + '; } ' );
				});
			});

		/* Text Link Color */
			wp.customize( 'text_link_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.text_link_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( 'a { color: ' + newval + '; } ' );
				});
			});

}) ( jQuery );
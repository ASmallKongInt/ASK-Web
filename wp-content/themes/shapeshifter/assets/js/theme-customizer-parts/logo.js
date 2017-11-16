(function($){

	console.log( 'logo.js' );
	
	/* Logo Image */
		/* Select */
		wp.customize( 'header_image_url', function(value){
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_url = newval;
				console.log( window.shapeshifterThemeMods );
				if ( newval == "" ){
					
					$( '#logo-image-wrapper-div' ).css({
						'background-image': 'none',
					});
					
				} else {
									
					$( '#logo-image-wrapper-div' ).css({
						'background-image': 'url( ' + newval + ' )',
						'background-size': 'contain',
						'background-repeat': 'no-repeat'
					});
	
				}
			});
		});
		
		/* Size */
			/* max size of logo width */
			wp.customize( 'header_image_size_width', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_size_width = newval;
					$( '#logo-image-wrapper-div' ).css( 'max-width', newval + 'px' );
					console.log( window.shapeshifterThemeMods );
				});
			});
			
			/* max size of logo height */
			wp.customize( 'header_image_size_height', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_size_height = newval;
					$( '#logo-image-wrapper-div' ).css('height', newval + 'px' );
					console.log( window.shapeshifterThemeMods );
				});
			});
		
		/* Position */
		wp.customize( 'header_image_position', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_position = newval;
				if( newval == 'left' ) {
					$( '#logo-image-wrapper-div' ).css({
						'margin': 'auto',
						'margin-left': 0
					});
				} else if( newval == 'center' ) {
					$( '#logo-image-wrapper-div' ).css({
						'margin': 'auto',
					});
				} else if( newval == 'right' ) {
					$( '#logo-image-wrapper-div' ).css({
						'margin': 'auto',
						'margin-right': 0
					});
				}
				console.log( window.shapeshifterThemeMods );
			});
		});
	
		/* margin of logo image */
		wp.customize( 'header_image_margin_top', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_margin_top = newval;
				$( '#logo-image-top-space' ).css( 'height', newval + 'px' );
				console.log( window.shapeshifterThemeMods );
			});
		});
		wp.customize( 'header_image_margin_side', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_margin_side = newval;
				$( '#logo-image-inner-wrapper' ).css('margin-left', newval + 'px' );
				$( '#logo-image-inner-wrapper' ).css('margin-right', newval + 'px' );
				console.log( window.shapeshifterThemeMods );
			});
		});
		wp.customize( 'header_image_margin_bottom', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_margin_bottom = newval;
				$( '#logo-image-bottom-space' ).css( 'height', newval + 'px' );
				console.log( window.shapeshifterThemeMods );
			});
		});

	/* Logo Background Image */
		/* Select */
		wp.customize('header_image_background_image', function(value){
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image = newval;
				if ( newval == "" ){
					
					$( '#logo-image-wrapper' ).css({
						'background-image': 'none',
					});
					
				} else {
									
					$( '#logo-image-wrapper' ).css({
						'background-image': 'url( ' + newval + ' )',
					});
	
				}
				console.log( window.shapeshifterThemeMods );
			});
		});
		
		/* Size */
		wp.customize( 'header_image_background_image_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image_size = newval;
				$( '#logo-image-wrapper' ).css( 'background-size', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		
		/* Position */
		wp.customize( 'header_image_background_image_position_row', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image_position_row = newval;
				$( '#logo-image-wrapper' ).css('background-position-y', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		wp.customize( 'header_image_background_image_position_column', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image_position_column = newval;
				$( '#logo-image-wrapper' ).css('background-position-x', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		
		/* Repeat */
		wp.customize( 'header_image_background_image_repeat', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image_repeat = newval;
				$( '#logo-image-wrapper' ).css('background-repeat', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		
		/* Attachment */
		wp.customize( 'header_image_background_image_attachment', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_image_repeat = newval;
				$( '#logo-image-wrapper' ).css('background-attachment', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		
	/* Title and Description */
		/* Display */
			/* Title */
			wp.customize( 'header_image_title_display_toggle', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_title_display_toggle = newval;
						if(newval){
						$( '#logo-title-span' ).css( 'display', 'block' );
					}else{
						$( '#logo-title-span' ).css( 'display', 'none' );
					}
					console.log( window.shapeshifterThemeMods );
				});
			});
			
			/* Description */
			wp.customize( 'header_image_description_display_toggle', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_description_display_toggle = newval;
					if( newval ) {
						$( '#logo-description-span' ).css( 'display', 'block' );
					 }else {
						$( '#logo-description-span' ).css( 'display', 'none' );
					}
					console.log( window.shapeshifterThemeMods );
				});
			});
		
		/* position of logo title description */
		wp.customize( 'header_image_title_description_position', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_title_description_position = newval;
				if( newval == 'left-top' ) {
					$( '#logo-title-description-p' ).css({
						'position': 'absolute',
						'top': 0,
						'left': 0,
						'right': 'initial',
						'bottom': 'initial',
					});
				} else if( newval == 'left-bottom' ) {
					$( '#logo-title-description-p' ).css({
						'position': 'absolute',
						'top': 'initial',
						'left': 0,
						'right': 'initial',
						'bottom': 0
					});
				} else if( newval == 'right-top' ) {
					$( '#logo-title-description-p' ).css({
						'position': 'absolute',
						'top': 0,
						'left': 'initial',
						'right': 0,
						'bottom': 'initial'
					});
				} else if( newval == 'right-bottom' ) {
					$( '#logo-title-description-p' ).css({
						'position': 'absolute',
						'top': 'initial',
						'left': 'initial',
						'right': 0,
						'bottom': 0
					});
				}
				console.log( window.shapeshifterThemeMods );
			});
		});

		/* Font */
			/* Title Font Size */
			wp.customize( 'header_image_title_font_size', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_title_font_size = newval;
					$( '#logo-title-span' ).css( 'font-size', newval + 'px' );
					console.log( window.shapeshifterThemeMods );
				});
			});

			/* Description Font Size */
			wp.customize( 'header_image_description_font_size', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_description_font_size = newval;
					$( '#logo-description-span' ).css( 'font-size', newval + 'px' );
					console.log( window.shapeshifterThemeMods );
				});
			});

			/* Title Font Family */
			wp.customize( 'header_image_title_font_family', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_title_font_family = newval;
					if( newval !== "0" ) {
						$( '#logo-title-span' ).css( 'font-family', newval );
					} else {
						$( '#logo-title-span' ).css( 'font-family', 'none' );
					}
					console.log( window.shapeshifterThemeMods );
				});
			});

			/* Description Font Family */
			wp.customize( 'header_image_description_font_family', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_description_font_family = newval;
					if( newval !== "0" ) {
						$( '#logo-description-span' ).css( 'font-family', newval );
					} else {
						$( '#logo-description-span' ).css( 'font-family', 'none' );
					}
					console.log( window.shapeshifterThemeMods );
				});
			});

		/* Margin */
			/* Title Description Margin */
			wp.customize( 'header_image_title_description_padding', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.header_image_title_description_padding = newval;
					$( '#logo-title-description-p' ).css( 'padding', newval + 'px' );
					console.log( window.shapeshifterThemeMods );
				});
			});

	/* Color */
		/* colors of logo background */
		wp.customize( 'header_image_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_background_color = newval;
				if( newval ) {
					$( '#logo-image-wrapper' ).css( 'background-color', newval );
				} else {
					$( '#logo-image-wrapper' ).css( 'background-color', 'none' );
				}
				console.log( window.shapeshifterThemeMods );
			});
		});
	
		/* colors of logo title description */
		wp.customize( 'header_image_title_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_title_color = newval;
				$( '#logo-title-span' ).css( 'color', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
		
		wp.customize( 'header_image_description_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_image_description_color = newval;
				$( '#logo-description-span' ).css( 'color', newval );
				console.log( window.shapeshifterThemeMods );
			});
		});
	
}) ( jQuery );
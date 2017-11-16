( function( $ ) {

	console.log( 'content-area.js' );

	/* Design */
		var wpCustomizeContentColumns = function( columnId ) {

			wp.customize( '' + columnId + '_max_width', function( value ){
				value.bind( function( newval ) {
					console.log( columnId );
					window.shapeshifterThemeMods[ '' + columnId + '_max_width' ] = parseInt( newval );
					
					if( $( '.sidebar-left-container' ).exists() && $( '.sidebar-right-container' ).exists() ) {
						newvalContentInner = parseInt( window.shapeshifterThemeMods.main_content_max_width );
						newvalContentOuter = parseInt( window.shapeshifterThemeMods.main_content_max_width ) + parseInt( window.shapeshifterThemeMods.sidebar_left_max_width ) + parseInt( window.shapeshifterThemeMods.sidebar_right_max_width );
						$( '.content-inner' ).css({
							'max-width': newvalContentInner + 'px',
						});
						$( '#shapeshifter-header-inner-wrapper,.shapeshifter-top-nav-menu,.shapeshifter-main-nav-menu,.content-outer' ).css({
							'max-width': newvalContentOuter + 'px',
						});
						$( '.shapeshifter-outer-wrapper,.shapeshifter-header,#footer' ).css({
							'min-width': newvalContentOuter + 'px',
						});
						$( '.sidebar-left-container,.widget-area-sidebar-left,.widget-area-sidebar-left-fixed' ).css({
							'max-width': window.shapeshifterThemeMods.sidebar_left_max_width + 'px',
						});
						$( '.sidebar-right-container,.widget-area-sidebar-right,.widget-area-sidebar-right-fixed' ).css({
							'max-width': window.shapeshifterThemeMods.sidebar_right_max_width + 'px',
						});
					} else if( $( '.sidebar-left-container' ).exists() ) {
						newvalContentInner = parseInt( window.shapeshifterThemeMods.main_content_max_width );
						newvalContentOuter = parseInt( window.shapeshifterThemeMods.main_content_max_width ) + parseInt( window.shapeshifterThemeMods.sidebar_left_max_width );
						$( '.content-inner' ).css({
							'max-width': newvalContentInner + 'px',
						});
						$( '#shapeshifter-header-inner-wrapper,.shapeshifter-top-nav-menu,.shapeshifter-main-nav-menu,.content-outer' ).css({
							'max-width': newvalContentOuter + 'px',
						});
						$( '.shapeshifter-outer-wrapper,.shapeshifter-header,#footer' ).css({
							'min-width': newvalContentOuter + 'px',
						});
						$( '.sidebar-left-container,.widget-area-sidebar-left,.widget-area-sidebar-left-fixed' ).css({
							'max-width': window.shapeshifterThemeMods.sidebar_left_max_width + 'px',
						});
					} else if( $( '.sidebar-right-container' ).exists() ) {
						newvalContentInner = parseInt( window.shapeshifterThemeMods.main_content_max_width );
						newvalContentOuter = parseInt( window.shapeshifterThemeMods.main_content_max_width ) + parseInt( window.shapeshifterThemeMods.sidebar_right_max_width );
						$( '.content-inner' ).css({
							'max-width': newvalContentInner + 'px',
						});
						$( '#shapeshifter-header-inner-wrapper,.shapeshifter-top-nav-menu,.shapeshifter-main-nav-menu,.content-outer' ).css({
							'max-width': newvalContentOuter + 'px',
						});
						$( '.shapeshifter-outer-wrapper,.shapeshifter-header,#footer' ).css({
							'min-width': newvalContentOuter + 'px',
						});
						$( '.sidebar-right-container,.widget-area-sidebar-right,.widget-area-sidebar-right-fixed' ).css({
							'max-width': window.shapeshifterThemeMods.sidebar_right_max_width + 'px',
						});
					} else {
						newvalContentInner = parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210;
						newvalContentOuter = parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210;
						$( '.content-inner' ).css({
							'max-width': newvalContentInner + 'px',
						});
						$( '#shapeshifter-header-inner-wrapper,.shapeshifter-top-nav-menu,.shapeshifter-main-nav-menu,.content-outer' ).css({
							'max-width': newvalContentOuter + 'px',
						});
						$( '.shapeshifter-outer-wrapper,.shapeshifter-header,#footer' ).css({
							'min-width': newvalContentOuter + 'px',
						});
					}
				});
			});

		};

		/* Main Content Width */
			var columnsArgs = [ 'sidebar_left', 'main_content', 'sidebar_right' ];
			for( var index in columnsArgs ) {
				var columnId = columnsArgs[ index ];
				console.log( columnId );
				wpCustomizeContentColumns( columnId );
			}

		/* Is Max Width? */
			wp.customize( 'is_one_column_main_content_max_width_on', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.is_one_column_main_content_max_width_on = newval;
					if( newval ) {
						if( $( '.sidebar-left-container' ).exists() && $( '.sidebar-right-container' ).exists() ) {
						} else if( $( '.sidebar-left-container' ).exists() ) {
						} else if( $( '.sidebar-right-container' ).exists() ) {
						} else {
							$( '#shapeshifter-theme-customize-preview' ).append( '.content-outer { max-width: ' + newval + '; } ' );
							$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { max-width: ' + newval + '; } ' );
							//$( '.content-outer' ).css( 'max-width', '100%' );
							//$( '.content-inner' ).css( 'max-width', '100%' );
						}
					} else {
						if( $( '.sidebar-left-container' ).exists() && $( '.sidebar-right-container' ).exists() ) {
						} else if( $( '.sidebar-left-container' ).exists() ) {
						} else if( $( '.sidebar-right-container' ).exists() ) {
						} else {
							$( '#shapeshifter-theme-customize-preview' ).append( '.content-outer { max-width: ' + ( parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210 ) + 'px; } ' );
							$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { max-width: ' + ( parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210 ) + 'px; } ' );
							//$( '.content-outer' ).css( 'max-width', ( parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210 ) + 'px' );
							//$( '.content-inner' ).css( 'max-width', ( parseInt( window.shapeshifterThemeMods.main_content_max_width ) + 210 ) + 'px' );
						}
					}
				});
			});

		/* Main Content Border */
			wp.customize( 'is_content_border_on', function( value ){
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.is_content_border_on = newval;
					if( newval != '' ){
						$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { border: solid #CCCCCC 1px; } ' );
						/*$( '.content-inner' ).css({
							'border': 'solid #CCCCCC 1px',
						});*/
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { border: solid #CCCCCC 0px; } ' );
						/*$( '.content-inner' ).css({
							'border': 'solid #CCCCCC 0px',
						});*/
					}
				});
			});

		/* Border Radius */
			wp.customize( 'main_content_border_radius', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.main_content_border_radius = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { border-radius: ' + newval + 'px; } ' );
					//$( '.content-inner' ).css( 'border-radius', newval + 'px' );
				});
			});

	/* Colors */
		/* content area background color */
		wp.customize( 'content_area_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_color = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-color: ' + newval + '; } ' );
					//$( '.content-area' ).css( 'background-color', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-color: transparent; } ' );
					//$( '.content-area' ).css( 'background-color', 'transparent' );
				}
			});
		});
		/* content outer background color */
		wp.customize( 'content_outer_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_outer_background_color = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-outer { background-color: ' + newval + '; } ' );
					//$( '.content-outer' ).css( 'background-color', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-outer { background-color: transparent; } ' );
					//$( '.content-outer' ).css( 'background-color', 'transparent' );
				}
			});
		});
		/* content background color */
		wp.customize( 'main_content_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_color = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-color: ' + newval + '; } ' );
					//$( '.content-inner' ).css( 'background-color', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-color: transparent; } ' );
					//$( '.content-inner' ).css( 'background-color', 'transparent' );
				}
			});
		});
		/* sidebar left container background color */
		wp.customize( 'content_area_sidebar_left_container_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_sidebar_left_container_background_color = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.sidebar-left-container { background-color: ' + newval + '; } ' );
					//$( '.sidebar-left-container' ).css( 'background-color', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.sidebar-left-container { background-color: transparent; } ' );
					//$( '.sidebar-left-container' ).css( 'background-color', 'transparent' );
				}
			});
		});
		/* sidebar right container background color */
		wp.customize( 'content_area_sidebar_right_container_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_sidebar_right_container_background_color = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.sidebar-right-container { background-color: ' + newval + '; } ' );
					//$( '.sidebar-right-container' ).css( 'background-color', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.sidebar-right-container { background-color: transparent; } ' );
					//$( '.sidebar-right-container' ).css( 'background-color', 'transparent' );
				}
			});
		});

	/* Content Area Background Image */
		/* Select Image */
		wp.customize( 'content_area_background_image', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-image: url(' + newval + '); } ' );
				//$( '.content-area' ).css( 'background-image', 'url(' + newval + ')' );
			});
		});
		
		/* Size */
		wp.customize( 'content_area_background_image_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image_size = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-size: ' + newval + '; } ' );
				//$( '.content-area' ).css( 'background-size', newval );
			});
		});
		
		/* Position */
		wp.customize( 'content_area_background_image_position_row', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image_position_row = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-position-y: ' + newval + '; } ' );
				//$( '.content-area' ).css( 'background-position-y', newval );
			});
		});
		wp.customize( 'content_area_background_image_position_column', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image_position_column = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-position-x: ' + newval + '; } ' );
				//$( '.content-area' ).css( 'background-position-x', newval );
			});
		});
		
		/* Repeat */
		wp.customize( 'content_area_background_image_repeat', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-repeat: ' + newval + '; } ' );
				//$( '.content-area' ).css( 'background-repeat', newval );
			});
		});

		/* Attachment */
		wp.customize( 'content_area_background_image_attachment', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.content_area_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-area { background-attachment: ' + newval + '; } ' );
				//$( '.content-area' ).css( 'background-attachment', newval );
			});
		});
	
	/* Background Image */
		/* Select Image */
		wp.customize( 'main_content_background_image', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-image: url(' + newval + '); } ' );
				//$( '.content-inner' ).css( 'background-image', 'url(' + newval + ')' );
			});
		});
		
		/* Size */
		wp.customize( 'main_content_background_image_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image_size = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-size: ' + newval + '; } ' );
				//$( '.content-inner' ).css( 'background-size', newval );
			});
		});
		
		/* Position */
		wp.customize( 'main_content_background_image_position_row', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image_position_row = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-position-y: ' + newval + '; } ' );
				//$( '.content-inner' ).css( 'background-position-y', newval );
			});
		});
		wp.customize( 'main_content_background_image_position_column', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image_position_column = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-position-x: ' + newval + '; } ' );
				//$( '.content-inner' ).css( 'background-position-x', newval );
			});
		});
		
		/* Repeat */
		wp.customize( 'main_content_background_image_repeat', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-repeat: ' + newval + '; } ' );
				//$( '.content-inner' ).css( 'background-repeat', newval );
			});
		});

		/* Attachment */
		wp.customize( 'main_content_background_image_attachment', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.main_content_background_image_repeat = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.content-inner { background-attachment: ' + newval + '; } ' );
				//$( '.content-inner' ).css( 'background-attachment', newval );
			});
		});

}) ( jQuery );
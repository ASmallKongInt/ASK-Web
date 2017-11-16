( function( $ ) {
	
	console.log( 'standard-widget-areas.js' );

	/* 左右スライドバー */
		// 左背景色
			wp.customize( 'slidebar_left_background_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.sidebar_left_slide_box_background_color = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-left-container-slide-box { background-color: ' + newval + '; } ' );
						//$( '.slidebar-left-container-slide-box' ).css( 'background-color', newval );
					}
					else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-left-container-slide-box { background-color: initial; } ' );
						//$( '.slidebar-left-container-slide-box' ).css( 'background-color', 'initial' );
					}
				});
			});
		// 左背景イメージ
			wp.customize( 'slidebar_left_background_image', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.sidebar_left_slide_box_background_image = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-left-container-slide-box { background-image: url(' + newval + '); } ' );
						//$( '.slidebar-left-container-slide-box' ).css( 'background-image', 'url(' + newval + ')' );
					}
					else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-left-container-slide-box { background-image: none; } ' );
						//$( '.slidebar-left-container-slide-box' ).css( 'background-image', 'none' );
					}
				});
			});
		// 右背景色
			wp.customize( 'slidebar_right_background_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.sidebar_right_slide_box_background_color = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-right-container-slide-box { background-color: ' + newval + '; } ' );
						//$( '.slidebar-right-container-slide-box' ).css( 'background-color', newval );
					}
					else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-right-container-slide-box { background-color: initial; } ' );
						//$( '.slidebar-right-container-slide-box' ).css( 'background-color', 'initial' );
					}
				});
			});
		// 右背景イメージ
			wp.customize( 'slidebar_right_background_image', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.sidebar_right_slide_box_background_image = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-right-container-slide-box { background-image: url(' + newval + '); } ' );
						//$( '.slidebar-right-container-slide-box' ).css( 'background-image', 'url(' + newval + ')' );
					}
					else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.slidebar-right-container-slide-box { background-image: none; } ' );
						//$( '.slidebar-right-container-slide-box' ).css( 'background-image', 'none' );
					}
				});
			});

	/*var widgetAreasData = { 
		sidebar_left : {
			"class" : "sidebar-left"
		},
		sidebar_left_fix : {
			"class" : "sidebar-left-fixed"
		}, 
		sidebar_right : {
			"class" : "sidebar-right"
		}, 
		sidebar_right_fix : {
			"class" : "sidebar-right-fixed"
		}
	};*/

	var defaultWidgetAreas = [
		{
			"index" : "slidebar_left",
			"id" : "slidebar_left",
			"selectorsKey": "slidebar-left"
		},
		{
			"index" : "sidebar_left",
			"id" : "sidebar_left",
			"selectorsKey": "sidebar-left"
		},
		{
			"index" : "sidebar_left_fixed",
			"id" : "sidebar_left_fixed",
			"selectorsKey": "sidebar-left-fixed"
		},
		{
			"index" : "slidebar_right",
			"id" : "slidebar_right",
			"selectorsKey": "slidebar-right"
		},
		{
			"index" : "sidebar_right",
			"id" : "sidebar_right",
			"selectorsKey": "sidebar-right"
		},
		{
			"index" : "sidebar_right_fixed",
			"id" : "sidebar_right_fixed",
			"selectorsKey": "sidebar-right-fixed"
		},

	];
	var defaultWidgetAreasData = [];
	defaultWidgetAreas.forEach( function( data, index ) {
		defaultWidgetAreasData.push({
			"index": data.index,
			"id": data.id,
			//"name": window.shapeshifterJSTranslatedObject.mobileSidebar,
			"selectors": {
				/* Wrapper Background */
					/*
					"wrapperBackgroundColor": "",
					"wrapperBackgroundImage": "",
					"wrapperBackgroundImageSize": "",
					"wrapperBackgroundImagePositionRow": "",
					"wrapperBackgroundImagePositionColumn": "",
					"wrapperBackgroundImageRepeat": "",
					*/
				/* Font Family */
					"fontFamily": ".widget-area-" + data.selectorsKey + "-li",
				/* CSS Animation */
					"animationEnter": ".widget-area-" + data.selectorsKey,
				/* Item Outer Background */
					"outerBackgroundColor": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImage": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImageSize": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImagePositionRow": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImagePositionColumn": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImageRepeat": ".widget-area-" + data.selectorsKey + "-li",
					"outerBackgroundImageAttachment": ".widget-area-" + data.selectorsKey + "-li",
				/* Item Inner Background */
					"innerBackgroundColor": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImage": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImageSize": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImagePositionRow": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImagePositionColumn": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImageRepeat": ".widget-area-" + data.selectorsKey + "-li-div",
					"innerBackgroundImageAttachment": ".widget-area-" + data.selectorsKey + "-li-div",
				/* item Design */
					"widgetBorder" : ".widget-area-" + data.selectorsKey + "-li",
					"widgetBorderRadius" : ".widget-area-" + data.selectorsKey + "-li",
					"widgetMargin": ".widget-area-" + data.selectorsKey + "-li-div",
				/* Item Icons */
					"widgetTitleFontAwesomeIconSelect": ".widget-area-" + data.selectorsKey + "-li .widget-area-" + data.selectorsKey + "-p:before",
					"widgetTitleFontAwesomeIconColor": ".widget-area-" + data.selectorsKey + "-li .widget-area-" + data.selectorsKey + "-p:before",
					"widgetListFontAwesomeIconSelect": ".widget-area-" + data.selectorsKey + "-li .li.archive-list-item:before, .widget-area-" + data.selectorsKey + "-li li.cat-item:before, .widget-area-" + data.selectorsKey + "-li li.menu-item:before",
					"widgetListFontAwesomeIconColor": ".widget-area-" + data.selectorsKey + "-li .li.archive-list-item:before, .widget-area-" + data.selectorsKey + "-li li.cat-item:before, .widget-area-" + data.selectorsKey + "-li li.menu-item:before",
				/* Item Colors */
					"widgetBackgroundColor": ".widget-area-" + data.selectorsKey + "-li",
					"widgetTitleColor": ".widget-area-" + data.selectorsKey + "-li .widget-area-" + data.selectorsKey + "-p",
					"widgetTextColor": {
						"itemWrapper": ".widget-area-" + data.selectorsKey + "-li-div",
						"itemExcerpt": ".widget-area-" + data.selectorsKey + "-li-div .widget-entry-excerpt",
					} ,
					"widgetLinkTextColor": ".widget-area-" + data.selectorsKey + "-li a, .widget-area-" + data.selectorsKey + "-li a:link, .widget-area-" + data.selectorsKey + "-li a:visited",
			}
		});
	});

	defaultWidgetAreasData.forEach( function( data, index ) {

		/* Font Family */
			wp.customize( data.id + '_font_family', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_font_family' ] = newval;
					if( newval !== "default" ) {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.fontFamily + ' { font-family: ' + newval + '; } ' );
						//$( data.selectors.fontFamily ).css( 'font-family', newval );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.fontFamily + ' { font-family: none; } ' );
						//$( data.selectors.fontFamily ).css( 'font-family', 'none' );
					}
				});
			});

		/* CSS Animation */
			wp.customize( data.id + '_area_animation_enter', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_area_animation_enter' ] = newval;
					if( newval == "none" ) {
						$( data.selectors.animationEnter ).removeClass( 'shapeshifter-hidden enter-animated' );
						$( data.selectors.animationEnter ).data( 'animation-enter', '' );
					} else {
						$( data.selectors.animationEnter ).addClass( 'shapeshifter-hidden enter-animated' );
						$( data.selectors.animationEnter ).data( 'animation-enter', newval );
					}
				});
			});

		/* Outer Background Image */
			/* Select */
			wp.customize( data.id + '_outer_background_image', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImage + ' { background-image: url(' + newval + '); } ' );
					//$( data.selectors.outerBackgroundImage ).css( 'background-image', 'url(' + newval + ')' );
				});
			});
			
			/* Size */
			wp.customize( data.id + '_outer_background_image_size', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image_size' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImageSize + ' { background-size: ' + newval + '; } ' );
					//$( data.selectors.outerBackgroundImageSize ).css( 'background-size', newval );
				});
			});
			
			/* Position */
			wp.customize( data.id + '_outer_background_image_position_row', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image_position_row' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImagePositionRow + ' { background-position-y: ' + newval + '; } ' );
					//$( data.selectors.outerBackgroundImagePositionRow ).css( 'background-position-y', newval );
				});
			});
			wp.customize( data.id + '_outer_background_image_position_column', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image_position_column' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImagePositionColumn + ' { background-position-x: ' + newval + '; } ' );
					//$( data.selectors.outerBackgroundImagePositionColumn ).css( 'background-position-x', newval );
				});
			});
			
			/* Repeat */
			wp.customize( data.id + '_outer_background_image_repeat', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image_repeat' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImageRepeat + ' { background-repeat: ' + newval + '; } ' );
					//$( data.selectors.outerBackgroundImageRepeat ).css( 'background-repeat', newval );
				});
			});

			/* Attachment */
			wp.customize( data.id + '_outer_background_image_attachment', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_outer_background_image_attachment' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.outerBackgroundImageAttachment + ' { background-attachment: ' + newval + '; } ' );
					//$( data.selectors.outerBackgroundImageAttachment ).css( 'background-attachment', newval );
				});
			});

		/* Inner Background Image */
			/* Select */
			wp.customize( data.id + '_inner_background_image', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImage + ' { background-image: url(' + newval + '); } ' );
					//$( data.selectors.innerBackgroundImage ).css( 'background-image', 'url(' + newval + ')' );
				});
			});
			
			/* Size */
			wp.customize( data.id + '_inner_background_image_size', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image_size' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImageSize + ' { background-size: ' + newval + '; } ' );
					//$( data.selectors.innerBackgroundImageSize ).css( 'background-size', newval );
				});
			});
			
			/* Position */
			wp.customize( data.id + '_inner_background_image_position_row', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image_position_row' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImagePositionRow + ' { background-position-y: ' + newval + '; } ' );
					//$( data.selectors.innerBackgroundImagePositionRow ).css( 'background-position-y', newval );
				});
			});
			wp.customize( data.id + '_inner_background_image_position_column', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image_position_column' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImagePositionColumn + ' { background-position-x: ' + newval + '; } ' );
					//$( data.selectors.innerBackgroundImagePositionColumn ).css( 'background-position-x', newval );
				});
			});
			
			/* Repeat */
			wp.customize( data.id + '_inner_background_image_repeat', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image_repeat' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImageRepeat + ' { background-repeat: ' + newval + '; } ' );
					//$( data.selectors.innerBackgroundImageRepeat ).css( 'background-repeat', newval );
				});
			});

			/* Attchment */
			wp.customize( data.id + '_inner_background_image_attachment', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_inner_background_image_attachment' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.innerBackgroundImageAttachment + ' { background-attachment: ' + newval + '; } ' );
					//$( data.selectors.innerBackgroundImageAttachment ).css( 'background-attachment', newval );
				});
			});

		/* Colors */
			/* widget areas background-color */
			wp.customize( data.id + '_background_color', function(value){
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_background_color' ] = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetBackgroundColor + ' { background-color: ' + newval + '; } ' );
						//$( data.selectors.widgetBackgroundColor ).css({ 'background-color': newval });
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetBackgroundColor + ' { background-color: transparent; } ' );
						//$( data.selectors.widgetBackgroundColor ).css({ 'background-color': 'transparent' });
					}
				});
			});

			/* title */
			wp.customize( data.id + '_title_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_title_color' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetTitleColor + ' { color: ' + newval + '; } ' );
					//$( data.selectors.widgetTitleColor ).css( 'color', newval );
				});
			});

			/* text */
			wp.customize( data.id + '_text_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_text_color' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetTextColor.itemWrapper + ' { color: ' + newval + '; } ' );
					//$( data.selectors.widgetTextColor.itemWrapper ).css( 'color', newval );
					if( $( data.selectors.widgetTextColor.itemExcerpt ).exists() ) {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetTextColor.itemExcerpt + ' { color: ' + newval + '; } ' );
						//$( data.selectors.widgetTextColor.itemExcerpt ).css( 'color', newval );
					}
				});
			});
			
			/* link text */
			wp.customize( data.id + '_link_text_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_link_text_color' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetLinkTextColor + ' { color: ' + newval + '; } ' );
					//$( data.selectors.widgetLinkTextColor ).css( 'color', newval );
				});
			});

		/* Borders */
			/* Display */
			wp.customize( data.id + '_widget_border', function(value){
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_widget_border' ] = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetBorder + ' { box-shadow: 0 0 5px; border-radius: 10px; } ' );
						/*$( data.selectors.widgetBorder ).css({
							'box-shadow': '0 0 5px',
							'border-radius': '10px'
						});*/
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetBorder + ' { box-shadow: none; border-radius: none; } ' );
						/*$( data.selectors.widgetBorder ).css({
							'box-shadow': 'none',
							'border-radius': 'none'
						});*/
					}
				});
			});
			
			/* Radius */
			wp.customize( data.id + '_widget_border_radius', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_widget_border_radius' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetBorderRadius + ' { border-radius: ' + newval + 'px; } ' );
					/*$( data.selectors.widgetBorderRadius ).css({
						'border-radius': newval + 'px'
					});*/
				});
			});

			/* Margin */
			wp.customize( data.id + '_widget_margin', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods[ data.id + '_widget_margin' ] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( data.selectors.widgetMargin + ' { margin: ' + newval + 'px; } ' );
					/*$( data.selectors.widgetMargin ).css({
						'margin': newval + 'px'
					});*/
				});
			});

	});

}) ( jQuery );
( function( $ ) {
	
	console.log( 'archive-page.js' );

	/* Design */
		/* List Item Border */
			wp.customize( 'archive_page_is_border_top_on', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_is_border_top_on = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-top-width: 1px; } ' );
						//$( '.post-list-div' ).css( 'border-top-width', '1px' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-top-width: 0px; } ' );
						//$( '.post-list-div' ).css( 'border-top-width', '0px' );
					}
				});
			});
			wp.customize( 'archive_page_is_border_left_on', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_is_border_left_on = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-left-width: 1px; } ' );
						//$( '.post-list-div' ).css( 'border-left-width', '1px' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-left-width: 0px; } ' );
						//$( '.post-list-div' ).css( 'border-left-width', '0px' );
					}
				});
			});
			wp.customize( 'archive_page_is_border_right_on', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_is_border_right_on = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-right-width: 1px; } ' );
						//$( '.post-list-div' ).css( 'border-right-width', '1px' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-right-width: 0px; } ' );
						//$( '.post-list-div' ).css( 'border-right-width', '0px' );
					}
				});
			});
			wp.customize( 'archive_page_is_border_bottom_on', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_is_border_bottom_on = newval;
					if( newval ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-bottom-width: 1px; } ' );
						//$( '.post-list-div' ).css( 'border-bottom-width', '1px' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-bottom-width: 0px; } ' );
						//$( '.post-list-div' ).css( 'border-bottom-width', '0px' );
					}
				});
			});

		/* Border Radius */
			wp.customize( 'archive_page_list_item_border_radius', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_list_item_border_radius = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-div { border-radius: ' + newval + 'px; } ' );
					//$( '.post-list-div' ).css( 'border-radius', newval + 'px' );
				});
			});

	/* Color */
		/* content text link color */
		wp.customize( 'archive_page_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.bloginfo-p-time, .hatena-read-later-p, .bloginfo-excerpt { color: ' + newval + '; } ' );
				//$( '.bloginfo-p-time, .hatena-read-later-p, .bloginfo-excerpt' ).css( 'color', newval );
			});
		});

		/* content text link color */
		wp.customize( 'archive_page_text_link_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_text_link_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.bloginfo-excerpt a { color: ' + newval + '; } ' );
				//$( '.bloginfo-excerpt a' ).css( 'color', newval );
			});
		});

		/* post list text link color */
		wp.customize( 'archive_page_post_list_text_link_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_text_link_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.bloginfo a { color: ' + newval + '; } ' );
				//$( '.bloginfo a' ).css( 'color', newval );
			});
		});

	/* Post Thumbnail */
		/* Width */
		wp.customize( 'archive_page_post_thumbnail_width', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_thumbnail_width = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-thumbnail, .post-list-def-thumbnail { width: ' + newval + 'px; } ' );
				$( '#shapeshifter-theme-customize-preview' ).append( '.bloginfo-thumbnail { width: ' + ( parseInt( newval ) + 50 ) + 'px; } ' );
				/*$( '.post-list-thumbnail, .post-list-def-thumbnail' ).css({
					'width': newval + 'px', 
				});
				$( '.bloginfo-thumbnail' ).css({
					'width': ( parseInt( newval ) + 50 ) + 'px', 
				});*/
			});
		});
		/* Height */
		wp.customize( 'archive_page_post_thumbnail_height', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_thumbnail_height = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-thumbnail, .post-list-def-thumbnail { height: ' + newval + 'px; } ' );
				/*$( '.post-list-thumbnail, .post-list-def-thumbnail' ).css({
					'height': newval + 'px', 
				});*/
			});
		});
		/* Radius */
		wp.customize( 'archive_page_post_thumbnail_radius', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_thumbnail_radius = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-bloginfo-div .post-list-thumbnail-a, .post-list-thumbnail, .post-list-def-thumbnail { border-radius: ' + newval + 'px; } ' );
				/*$( '.post-list-bloginfo-div .post-list-thumbnail-a, .post-list-thumbnail, .post-list-def-thumbnail' ).css({
					'border-radius': newval + 'px' 
				});*/
			});
		});

	/* Post List Title */
		/* Animation */
			/* List Item */
				/* Hover */
				wp.customize( 'archive_page_post_list_animation_hover_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.archive_page_post_list_animation_select = newval;
						if( newval == 'none' ) {
							$( '.post-list-div' ).removeClass( 'hover-animated' );
							$( '.post-list-div' ).attr( 'data-animation-hover', '' );
						} else {
							$( '.post-list-div' ).addClass( 'hover-animated' );
							$( '.post-list-div' ).attr( 'data-animation-hover', newval );
						}
					});
				});
				/* Enter */
				wp.customize( 'archive_page_post_list_animation_enter_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.archive_page_post_list_animation_select = newval;
						if( newval == 'none' ) {
							$( '.post-list-div' ).removeClass( 'shapeshifter-hidden enter-animated' );
							$( '.post-list-div' ).attr( 'data-animation-enter', '' );
						} else {
							$( '.post-list-div' ).addClass( 'shapeshifter-hidden enter-animated' );
							$( '.post-list-div' ).attr( 'data-animation-enter', newval );
						}
					});
				});

			/* Title Box */
			wp.customize( 'archive_page_post_list_title_box_animation_select', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_post_list_title_box_animation_select = newval;
					if( newval == 'none' ) {
						$( '.post-list-title-div-h2' ).removeClass( 'hover-animated' );
						$( '.post-list-title-div-h2' ).attr( 'data-animation-hover', '' );
					} else {
						$( '.post-list-title-div-h2' ).addClass( 'hover-animated' );
						$( '.post-list-title-div-h2' ).attr( 'data-animation-hover', newval );
					}
				});
			});

		/* Font Family */
		wp.customize( 'archive_page_post_list_title_font_family', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_title_font_family = newval;
				if( newval !== "0" ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div .post-list-title-div-h2 { font-family: ' + newval + '; } ' );
					//$( '.post-list-title-div-h2' ).css( 'font-family', newval );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div .post-list-title-div-h2 { font-family: none; } ' );
					//$( '.post-list-title-div-h2' ).css( 'font-family', 'none' );
				}
			});
		});
		
		/* Font Size */
		wp.customize( 'archive_page_post_list_title_font_size', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_title_font_size = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div .post-list-title-div-h2 { font-size: ' + newval + 'px; } ' );
				//$( '.post-list-title-div-h2' ).css({ 'font-size' : newval + 'px' });
			});
		});

		/* Background Image */
		wp.customize( 'archive_page_post_list_title_background_image', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_title_background_image = newval;
				if ( newval == "" ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div { background-image: none; } ' );
					/*$( '.post-list-title-div' ).css({
						'background-image': 'none',
					});*/
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div { background-image: url( ' + newval + ' ); background-size: contain; background-repeat: no-repeat; } ' );
					/*$( '.post-list-title-div' ).css( {
						'background-image': 'url( ' + newval + ' )',
						'background-size': 'contain',
						'background-repeat': 'no-repeat'
					});*/
				}
			});
		});
		/* Title Text Color */
		wp.customize( 'archive_page_post_list_title_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_title_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-a, .post-list-title-a:link, .post-list-title-a:visited { color: ' + newval + '; } ' );
				//$( '.post-list-title-a' ).css({ 'color' : newval });
			});
		});

		/* Title Text Shadow Color */
		wp.customize( 'archive_page_post_list_title_text_shadow', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.archive_page_post_list_title_text_shadow = newval;
				if( newval != '' ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div .post-list-title-div-h2 { text-shadow: 0 0 .5em ' + newval + '; } ' );
					//$( '.post-list-title-div .post-list-title-div-h2' ).css({ 'text-shadow' : '0 0 .5em ' + newval });
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div .post-list-title-div-h2 { text-shadow: ""; } ' );
					//$( '.post-list-title-div .post-list-title-div-h2' ).css({ 'text-shadow' : '' });
				}
			});
		});

		/* Background Gradient On */
		wp.customize( 'archive_page_post_list_title_background_gradient_on', function( value ){
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.archive_page_post_list_title_background_gradient_on = newval;
				if( newval ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title{ background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + window.shapeshifterThemeMods.archive_page_post_list_title_background_color + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.archive_page_post_list_title_background_color + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods.archive_page_post_list_title_background_color + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title{ background:none; background-color:' + window.shapeshifterThemeMods.archive_page_post_list_title_background_color + '; }' );

				}

			});
		});

		/* Background Color */
		wp.customize( 'archive_page_post_list_title_background_color', function( value ) {
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.archive_page_post_list_title_background_color = newval;

				if( window.shapeshifterThemeMods.archive_page_post_list_title_background_gradient_on ) {

					$( 'style#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title{ background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + newval + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); }' );

				} else {

					$( 'style#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title{ background:none; background-color:' + newval + '; }' );

				}

			});
		});

		/* Border Color */
			wp.customize( 'archive_page_post_list_title_border_bottom_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_post_list_title_border_bottom_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title { border-bottom-color: ' + newval + '; } ' );
					//$( '.post-list-title-div-h2.entry-title' ).css({ 'border-bottom-color' : newval });
				});
			});
			wp.customize( 'archive_page_post_list_title_border_left_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_post_list_title_border_left_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title { border-left-color: ' + newval + '; } ' );
					//$( '.post-list-title-div-h2.entry-title' ).css({ 'border-left-color' : newval });
				});
			});
			wp.customize( 'archive_page_post_list_title_border_right_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods.archive_page_post_list_title_border_right_color = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.post-list-title-div-h2.entry-title { border-right-color: ' + newval + '; } ' );
					//$( '.post-list-title-div-h2.entry-title' ).css({ 'border-right-color' : newval });
				});
			});

}) ( jQuery ); 
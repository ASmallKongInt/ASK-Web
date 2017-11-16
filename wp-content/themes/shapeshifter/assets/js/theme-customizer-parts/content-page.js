( function( $ ) {

	console.log( 'content-page.js' );


	/* Display */
		/* Blogbox Visibility for Single */
		wp.customize( 'is_not_single_meta_visible', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.is_not_single_meta_visible = newval;
				if( newval ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-singular-blogbox-post { display: none; } ' );
					//$( '.shapeshifter-singular-blogbox-post' ).css( 'display', 'none' );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-singular-blogbox-post { display: block; } ' );
					//$( '.shapeshifter-singular-blogbox-post' ).css( 'display', 'block' );
				}
			});
		});
	
		/* Blogbox Visibility for Page */
		wp.customize( 'is_not_page_meta_visible', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.is_not_page_meta_visible = newval;
				if( newval ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-singular-blogbox-page { display: none; } ' );
					//$( '.shapeshifter-singular-blogbox-page' ).css( 'display', 'none' );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-singular-blogbox-page { display: block; } ' );
					//$( '.shapeshifter-singular-blogbox-page' ).css( 'display', 'block' );
				}
			});
		});

		/* Pagination Visibility for Single */
		wp.customize( 'is_not_page_link_visible', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.is_not_page_link_visible = newval;
				if( newval ) {
					$( '#shapeshifter-theme-customize-preview' ).append( '#single-page-prev-next { display: none; } ' );
					//$( '#single-page-prev-next' ).css( 'display', 'none' );
				} else {
					$( '#shapeshifter-theme-customize-preview' ).append( '#single-page-prev-next { display: block; } ' );
					//$( '#single-page-prev-next' ).css( 'display', 'block' );
				}
			});
		});

	/* Animations */
		/* Text */
			/* Title */
				wp.customize( 'singular_page_h1_animation_hover_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.singular_page_h1_animation_hover_select = newval;
						if( newval == 'none' ) {
							$( 'h1.entry-title, h2.entry-title' ).removeClass( 'hover-animated' );
							$( 'h1.entry-title, h2.entry-title' ).attr( 'data-animation-hover', '' );
						} else {
							$( 'h1.entry-title, h2.entry-title' ).addClass( 'hover-animated' );
							$( 'h1.entry-title, h2.entry-title' ).attr( 'data-animation-hover', newval );
						}
					});
				});
				wp.customize( 'singular_page_h1_animation_enter_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.singular_page_h1_animation_enter_select = newval;
						if( newval == 'none' ) {
							$( 'h1.entry-title, h2.entry-title' ).removeClass( 'shapeshifter-hidden enter-animated' );
							$( 'h1.entry-title, h2.entry-title' ).attr( 'data-animation-enter', '' );
						} else {
							$( 'h1.entry-title, h2.entry-title' ).addClass( 'shapeshifter-hidden enter-animated' );
							$( 'h1.entry-title, h2.entry-title' ).attr( 'data-animation-enter', newval );
						}
					});
				});
			
			/* Inside of shapeshifter-content */
				function shapeshifterModsLivePreviewCSSAnimations( element ) {

					wp.customize( 'singular_page_' + element + '_animation_hover_select', function( value ) {
						value.bind( function( newval ) {
							window.shapeshifterThemeMods[ 'singular_page_' + element + '_animation_hover_select' ] = newval;
							if( newval == 'none' ) {
								$( '.shapeshifter-content ' + element ).removeClass( 'hover-animated' );
								$( '.shapeshifter-content ' + element ).attr( 'data-animation-hover', '' );
							} else {
								$( '.shapeshifter-content ' + element ).addClass( 'hover-animated' );
								$( '.shapeshifter-content ' + element ).attr( 'data-animation-hover', newval );
							}
						});
					});
					wp.customize( 'singular_page_' + element + '_animation_enter_select', function( value ) {
						value.bind( function( newval ) {
							window.shapeshifterThemeMods[ 'singular_page_' + element + '_animation_enter_select' ] = newval;
							if( newval == 'none' ) {
								$( '.shapeshifter-content ' + element ).removeClass( 'shapeshifter-hidden enter-animated' );
								$( '.shapeshifter-content ' + element ).attr( 'data-animation-enter', '' );
							} else {
								$( '.shapeshifter-content ' + element ).addClass( 'shapeshifter-hidden enter-animated' );
								$( '.shapeshifter-content ' + element ).attr( 'data-animation-enter', newval );
							}
						});
					});

				}
				var contentAnimatedElements = [ 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div', 'img', 'table' ];
				contentAnimatedElements.forEach( function( element, index ) {

					shapeshifterModsLivePreviewCSSAnimations( element );

				});

			/* Post Infos */
				wp.customize( 'singular_page_postinfos_animation_hover_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.singular_page_postinfos_animation_hover_select = newval;
						if( newval == 'none' ) {
							$( '.singular-header .blogbox' ).removeClass( 'hover-animated' );
							$( '.singular-header .blogbox' ).attr( 'data-animation-hover', '' );
						} else {
							$( '.singular-header .blogbox' ).addClass( 'hover-animated' );
							$( '.singular-header .blogbox' ).attr( 'data-animation-hover', newval );
						}
					});
				});
				wp.customize( 'singular_page_postinfos_animation_enter_select', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods.singular_page_postinfos_animation_enter_select = newval;
						if( newval == 'none' ) {
							$( '.singular-header .blogbox' ).removeClass( 'shapeshifter-hidden enter-animated' );
							$( '.singular-header .blogbox' ).attr( 'data-animation-enter', '' );
						} else {
							$( '.singular-header .blogbox' ).addClass( 'shapeshifter-hidden enter-animated' );
							$( '.singular-header .blogbox' ).attr( 'data-animation-enter', newval );
						}
					});
				});

	/* Color */
		/* content bloginfo background color */
		wp.customize( 'singular_page_bloginfo_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.singular_page_bloginfo_background_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.blogbox { background-color: ' + newval + '; } ' );
				//$( '.blogbox' ).css( 'background-color', newval );
			});
		});

		/* content bloginfo background color */
		wp.customize( 'singular_page_bloginfo_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.singular_page_bloginfo_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.blogbox { color: ' + newval + '; } ' );
				//$( '.blogbox' ).css( 'color', newval );
			});
		});

		/* content bloginfo background color */
		wp.customize( 'singular_page_bloginfo_text_link_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.singular_page_bloginfo_text_link_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.blogbox a { color: ' + newval + '; } ' );
				//$( '.blogbox a' ).css( 'color', newval );
			});
		});

		/* content text color */
		wp.customize( 'singular_page_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.singular_page_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content { color: ' + newval + '; } ' );
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content p, .prev-post-link-p, .next-post-link-p { color: ' + newval + '; } ' );
				//$( '.shapeshifter-content' ).css( 'color', newval );
				//$( '.shapeshifter-content p, .prev-post-link-p, .next-post-link-p' ).css( 'color', newval );
			});
		});
		
		/* content text link color */
		wp.customize( 'singular_page_text_link_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.singular_page_text_link_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content a, .prev-post-title-p, .next-post-title-p { color: ' + newval + '; } ' );
				//$( '.shapeshifter-content a, .prev-post-title-p, .next-post-title-p' ).css( 'color', newval );
			});
		});

	/* Headlines */
		function shapeshifterModsLivePreviewHeadings( element ) {

			/* Font Family */
			wp.customize( 'singular_page_' + element + '_font_family', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_font_family'] = newval;
					if( newval !== "default" ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { font-family: ' + newval + '; } ' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { font-family: none; } ' );
					}
				});
			});
			/* Font Size */
			wp.customize( 'singular_page_' + element + '_font_size', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_font_size'] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { font-size: ' + newval + 'px; } ' );
				});
			});
			/* Background Image */
			wp.customize( 'singular_page_' + element + '_background_image', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_background_image'] = newval;
					if ( newval == "" ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { background-image: ' + newval + 'px; } ' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { background-image: url( ' + newval + ' ); background-size: contain; background-repeat: no-repeat; } ' );
					}
				});
			});
			/* Title Text Color */
			wp.customize( 'singular_page_' + element + '_text_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_text_color'] = newval;
					$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { color: ' + newval + '; } ' );
				});
			});

			/* Title Text Shadow Color */
			wp.customize( 'singular_page_' + element + '_text_shadow', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_text_shadow'] = newval;
					if( newval != '' ) {
						$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { text-shadow: 0 0 .5em ' + newval + '; } ' );
					} else {
						$( '#shapeshifter-theme-customize-preview' ).append( '.entry-content ' + element + ' { text-shadow: ""; } ' );
					}
				});
			});

			/* Background Gradient On */
			wp.customize( 'singular_page_' + element + '_background_gradient_on', function( value ){
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_background_gradient_on'] = newval;
					if( newval ) {
						$( 'style#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + window.shapeshifterThemeMods['singular_page_' + element + '_background_color'] + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods['singular_page_' + element + '_background_color'] + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + window.shapeshifterThemeMods['singular_page_' + element + '_background_color'] + '); }' );
					} else {
						$( 'style#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { background:none; background-color:' + window.shapeshifterThemeMods['singular_page_' + element + '_background_color'] + '; }' );
					}
				});
			});

			/* Background Color */
			wp.customize( 'singular_page_' + element + '_background_color', function( value ) {
				value.bind( function( newval ) {
					window.shapeshifterThemeMods['singular_page_' + element + '_background_color'] = newval;
					if( window.shapeshifterThemeMods['singular_page_' + element + '_background_gradient_on'] ) {
						$( 'style#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { background-color:none; background:-webkit-gradient( linear, top, bottom, from(' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? Fwindow.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + '), to(' + newval + ')); background: -moz-linear-gradient( top, ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); background: linear-gradient( ' + ( window.shapeshifterThemeMods.main_content_background_color ? window.shapeshifterThemeMods.main_content_background_color : ( window.shapeshifterThemeMods.content_area_background_color ? window.shapeshifterThemeMods.content_area_background_color : '#FFFFFF' ) ) + ', ' + newval + '); }' );
					} else {
						$( 'style#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { background:none; background-color:' + newval + '; }' );
					}
				});
			});

			/* Border Bottom Color */
				wp.customize( 'singular_page_' + element + '_border_bottom_color', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods['singular_page_' + element + '_border_bottom_color'] = newval;
						$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { border-bottom-color: ' + newval + '; } ' );
					});
				});
				wp.customize( 'singular_page_' + element + '_border_left_color', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods['singular_page_' + element + '_border_left_color'] = newval;
						$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { border-left-color: ' + newval + '; } ' );
					});
				});
				wp.customize( 'singular_page_' + element + '_border_right_color', function( value ) {
					value.bind( function( newval ) {
						window.shapeshifterThemeMods['singular_page_' + element + '_border_right_color'] = newval;
						$( '#shapeshifter-theme-customize-preview' ).append( '.shapeshifter-content ' + element + ' { border-right-color: ' + newval + '; } ' );
					});
				});

		}
		var elements = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' ];
		elements.forEach( function( data, index ) {
			shapeshifterModsLivePreviewHeadings( data );
		});

}) ( jQuery );
( function( $ ) {

	// Window
		// Inner Height
			var shapeshifterWindowHeight = $( window ).innerHeight();
		// Width
			var shapeshifterWindowWidth = $( window ).width();
		// Scroll Top
			var shapeshifterWindowTop = $( window ).scrollTop();
		// Bottom
			var shapeshifterWindowBottom = shapeshifterWindowTop + shapeshifterWindowHeight;

$( document ).ready( function() {

	// Fixing Nav Menu on Top
		// Nav Menu Data
			if( $( '.shapeshifter-body-pc' ).exists() && $( '.shapeshifter-nav-menu-fixed' ).exists() ) {

				var isSubMainNavExists = $( '.shapeshifter-main-regular-nav' ).exists();

				// Header Height
					var shapeshifterHeaderHeight = $( '.shapeshifter-header-nav-visible' ).outerHeight();
					var shapeshifterNavMenuHeight = 0
					if( isSubMainNavExists ) {

						// Submenu
							// Height
								var shapeshifterNavMenuHeight = $( '.shapeshifter-main-regular-nav' ).outerHeight();
							// Offset Top
								var shapeshifterNavMenuTop = $( '.shapeshifter-main-regular-nav' ).offset().top;

					}


				// Distance to Submenu Offset Top
					var distanceToSubmenuOffsetTop = ( shapeshifterHeaderHeight + shapeshifterNavMenuHeight );

				// Function
					var shapeshifterNavMenuFixer = function( navMenuSelector, navMenuTop, fixedPositionTop ) {

						var shapeshifterWindowTop = $( window ).scrollTop(); // ウィンドウの位置

						if( navMenuTop < shapeshifterWindowTop ) {

							$( navMenuSelector ).css({
								'position': 'fixed',
								'top': fixedPositionTop,
								'overflow': 'visible'
							});

							// Header
								if( navMenuSelector = '.shapeshifter-header-nav-visible' ) {

									$( '.space-after-header-for-fixed' ).css({
										'height': shapeshifterHeaderHeight + 'px'
									});

								}
							// Submenu
								else if( navMenuSelector = '.shapeshifter-main-regular-nav' ) {

									$( '#div-after-main-nav' ).css({
										'height': shapeshifterNavMenuTop + 'px'
									});

								}

						} else {

							$( navMenuSelector ).css({
								'position': 'static',
								'overflow': 'auto'
							});

							// Header
								if( navMenuSelector = '.shapeshifter-header-nav-visible' ) {

									$( '.space-after-header-for-fixed' ).css({
										'height': '0px'
									});

								}
							// Submenu
								else if( navMenuSelector = '.shapeshifter-main-regular-nav' ) {

									$( '#div-after-main-nav' ).css({
										'height': '0px'
									});

								}

						}

					};

					$( window ).on( 'load', function() { 

						shapeshifterNavMenuFixer( '.shapeshifter-header-nav-visible', 0, 0 ); 

						shapeshifterNavMenuFixer( '.shapeshifter-main-regular-nav', shapeshifterNavMenuTop, shapeshifterHeaderHeight ); 

					});

					$( window ).on( 'scroll', function() { 

						shapeshifterNavMenuFixer( '.shapeshifter-header-nav-visible', 0, 0 ); 

						shapeshifterNavMenuFixer( '.shapeshifter-main-regular-nav', shapeshifterNavMenuTop, shapeshifterHeaderHeight ); 

					});

			}

	// Content Height
		if( $( '.shapeshifter-body-pc' ).exists() ) {

			function shapeshifterContentInnerAdjust() {

				$( '.content-outer' ).css({
					'overflow': 'auto'
				});

				$( '.sidebar-left-container, .content-inner, .sidebar-right-container' ).css({
					'height': '100%'
				});

				$( '.sidebar-left-container, .content-inner, .sidebar-right-container' ).css({
					'height': $( '.content-outer' ).height() + 'px'
				});

				$( '.content-outer' ).css({
					'height': $( '.content-inner' ).height() + 'px',
					'overflow': 'visible'
				});

			}

			//shapeshifterContentInnerAdjust();
				$( window ).scroll( function() {
					//shapeshifterContentInnerAdjust();
				});
				$( '.content-area, .content-outer' ).scroll( function() {
					//shapeshifterContentInnerAdjust();
				});

		}

	// Fixing Sidebar
		function shapeshifterFixPositionSetter( targetItem, targetWrapper, comparedPart ) {
			
			/*
			 * 「targetItem」と「comparedPart」を比較して固定します。
			 * 「targetWrapper」は「targetItem」を囲っているタグのセレクターを想定しています。
			 * 「mobileWidth」は、モバイルに切り替わるウィンドウの横幅のwidthのpx値
			 */	
			var scrollAdjust = function(){

				// Window Info
					// Height
						var shapeshifterWindowHeight = $( window ).innerHeight();
					// Top
						var shapeshifterWindowTop = $( window ).scrollTop();
					// Bottom
						var shapeshifterWindowBottom = shapeshifterWindowTop + shapeshifterWindowHeight;
					// Left
						var windowLeft = $( window ).scrollLeft();
				
				// Compared Part
					// Height
						var comparedHeight = $( comparedPart ).outerHeight();
					// Top
						var comparedOffsetTop = $( comparedPart ).offset().top;
					// Bottom
						var comparedOffsetBottom = comparedOffsetTop + comparedHeight;
					// Scroll Bottom
						var comparedScrollBottom = shapeshifterWindowTop + comparedHeight;

				// Target Wrapper
					// Height
						var wrapperHeight = 0;
						var selector = targetWrapper + ' > *';
						$( selector ).each( function( index ) {
							wrapperHeight = wrapperHeight + $( this ).outerHeight();
						});
					// Top
						var wrapperOffsetTop = $( targetWrapper ).offset().top;
					// Bottom
						var wrapperOffsetBottom = wrapperOffsetTop + wrapperHeight;
					// Left
						var wrapperOffsetLeft = $( targetWrapper ).offset().left;

				// Target Item
					// Height
						var targetHeight = $( targetItem ).outerHeight();
					// Top
						var targetOffsetTop = wrapperOffsetBottom - targetHeight;
					// Scroll Bottom
						var targetScrollBottom = shapeshifterWindowTop + targetHeight;

				// Condition: Comparing Height
					if( comparedHeight <= wrapperHeight ) { return; }

				// Init Target Wrapper Height
					$( targetWrapper ).css({ 'height': ( comparedHeight ? comparedHeight : wrapperHeight ) + 'px' });

				if ( comparedOffsetBottom > wrapperOffsetBottom ) { // ターゲットラッパーが比較対象の高さより小さい時（ターゲット固定）

					if ( targetOffsetTop > wrapperOffsetTop - targetHeight && shapeshifterWindowTop > targetOffsetTop ) { // スクロール位置がターゲットの位置を超えた時

						// 固定を継続
						
						$( targetItem ).css({
							'position': 'fixed',
							'top': ( $( '.shapeshifter-main-nav' ).exists() ? 50 : 0 ) + 'px',
							'left': ( wrapperOffsetLeft - windowLeft ) + 'px', 
							'bottom': 'initial'
						});

						if ( targetScrollBottom > comparedOffsetBottom ) { // スクロール時のターゲットの底の位置が比較対象の底の位置を超える場合

							// 1. ターゲットの固定を解除
							// 2. 底の位置を揃える position: absolute, bottom: 0
							
							$( targetItem ).css({
								'position': 'absolute',
								'top': 'initial',
								'left': 'initial', 
								'bottom': 0
							});

						} else { // スクロール時のターゲットの底の位置が比較対象の底の位置を超えない場合

						}

					} else { // スクロール位置が比較対象位置に満たない時

						// 比較対象の固定を解除（static）
						
						$( targetItem ).css({
							'position': 'relative',
							'top': ( $( '.shapeshifter-main-nav' ).exists() ? 50 : 0 ) + 'px',
							'left': 'initial', 
							'bottom':'initial'
						});

					}
				}
			};
			
			$( window ).on( 'load', function() {
				scrollAdjust();
			});
			$( window ).on( 'scroll', function () {
				scrollAdjust();
			});
		}

			if( $( '.sidebar-left-container-standard' ).exists() ) {

				if( $( '.widget-area-sidebar-left-fixed' ).exists() ) { 

					shapeshifterFixPositionSetter( '.widget-area-sidebar-left-fixed', '.sidebar-left-container', '.content-inner' );

				}

			}

			if( $( '.sidebar-right-container-standard' ).exists() ) {

				if( $( '.widget-area-sidebar-right-fixed' ).exists() ) { 

					shapeshifterFixPositionSetter( '.widget-area-sidebar-right-fixed', '.sidebar-right-container', '.content-inner' ); 
				}

			}

	// Slidebar
		var shapeshifterBodyBecomeHidden = function() {
			$( 'body' ).css({
				'overflow': 'hidden'
			});
		};
		var shapeshifterBodyBecomeAuto = function() {
			$( 'body' ).css({
				'overflow': 'auto'
			});
		};
		$( '.slidebar-left-container-trigger' ).on( 'click', function( e ) {
			if( $( '.slidebar-left-container' ).hasClass( 'slidebar-left-container-show' ) ) {
				$( '.slidebar-left-container' ).removeClass( 'slidebar-left-container-show' );
				$( '.slidebar-left-container-trigger' ).removeClass( 'fa-angle-double-left slidebar-left-container-trigger-showing' );
				$( '.slidebar-left-container-trigger' ).addClass( 'fa-angle-double-right' );
				if( ! $( '.slidebar-right-container' ).hasClass( 'slidebar-right-container-show' ) ) {
					shapeshifterBodyBecomeAuto();
				}
			} else {
				$( '.slidebar-left-container' ).addClass( 'slidebar-left-container-show' );
				$( '.slidebar-left-container-trigger' ).removeClass( 'fa-angle-double-right' );
				$( '.slidebar-left-container-trigger' ).addClass( 'fa-angle-double-left slidebar-left-container-trigger-showing' );
				shapeshifterBodyBecomeHidden();
			}
		});
		$( '.slidebar-right-container-trigger' ).on( 'click', function( e ) {
			if( $( '.slidebar-right-container' ).hasClass( 'slidebar-right-container-show' ) ) {
				$( '.slidebar-right-container' ).removeClass( 'slidebar-right-container-show' );
				$( '.slidebar-right-container-trigger' ).removeClass( 'fa-angle-double-right slidebar-right-container-trigger-showing' );
				$( '.slidebar-right-container-trigger' ).addClass( 'fa-angle-double-left' );
				if( ! $( '.slidebar-left-container' ).hasClass( 'slidebar-left-container-show' ) ) {
					shapeshifterBodyBecomeAuto();
				}
			} else {
				$( '.slidebar-right-container' ).addClass( 'slidebar-right-container-show' );
				$( '.slidebar-right-container-trigger' ).removeClass( 'fa-angle-double-left' );
				$( '.slidebar-right-container-trigger' ).addClass( 'fa-angle-double-right slidebar-right-container-trigger-showing' );
				shapeshifterBodyBecomeHidden();
			}
		});

	// Mobile Menu
		var shapeshifterIsMobile = $( '.shapeshifter-mobile-nav' ).exists();
		if( shapeshifterIsMobile ) {

			shapeshifterNavMenuWrapperSelector = '.shapeshifter-mobile-nav-wrapper-div';
			shapeshifterNavMenuInnerSelector = '.shapeshifter-mobile-nav-div';

		} else {

			shapeshifterNavMenuWrapperSelector = '.shapeshifter-main-nav-wrapper-div';
			shapeshifterNavMenuInnerSelector = '.shapeshifter-main-nav-div';

		}

		if( $( shapeshifterNavMenuInnerSelector ).exists() ) {

			$( ".shapeshifter-mobile-nav-div" ).css({
				"height" : shapeshifterWindowHeight - 120 + "px"
			});

			// Mobile Main Menu ( Left )
				$( "#back-to-content" ).on( "click", function( e ) {

					e.preventDefault();
					$( shapeshifterNavMenuWrapperSelector ).animate({ "left" : -300 + "px" });
					if( $( ".shapeshifter-mobile-side-menu-aside" ).offset().left > ( $( window ).width() - 300 ) ) {
						
						shapeshifterBodyBecomeAuto();

					} else {

						shapeshifterBodyBecomeHidden();

					}

				});
				$( "#slide-menu" ).on( "click", function( e ) {

					e.preventDefault();

					if( $( shapeshifterNavMenuWrapperSelector ).css("left") == "-300px" ) {
						
						$( shapeshifterNavMenuWrapperSelector ).animate({ "left" : 0 + "px" });

						shapeshifterBodyBecomeHidden();

					} else if( $( shapeshifterNavMenuWrapperSelector ).css("left") == "0px" ) {
						
						$( shapeshifterNavMenuWrapperSelector ).animate({ "left" : -300 + "px" });
						
						if( $( '.shapeshifter-body-mobile' ).exists() ) {
							if( $( ".shapeshifter-mobile-side-menu-aside" ).offset().left > ( $( window ).width() - 300 ) ) {
								shapeshifterBodyBecomeAuto();
							} else {
								shapeshifterBodyBecomeHidden();
							}
						} else {
							shapeshifterBodyBecomeAuto();
						}

					}

				});

				if( ! shapeshifterIsMobile && $( '.shapeshifter-is-responsive' ).exists() ) {
					$( window ).resize( function() {
						if( $( window ).width() <= 1024 ) {
							$( shapeshifterNavMenuWrapperSelector ).animate({ "left" : -300 + "px" })
							shapeshifterBodyBecomeAuto();
						} else {
							$( shapeshifterNavMenuWrapperSelector ).animate({ "left" : 0 + "px" })
							shapeshifterBodyBecomeAuto();
						}
					});
				} 

			// Scroll to Top
				$( "#bottom-menu-scroll-to-top" ).on( "click", function( e ) {

					e.preventDefault();
					var speed = 1000;
					$( "body" ).animate({ scrollTop: 0 }, speed, "swing" );
					return false;

				});

			// Mobile Side Menu
				$( "#mobile-side-menu" ).click( function( e ) {

					e.preventDefault();

					if( $( ".shapeshifter-mobile-side-menu-aside" ).css("right") == "-300px" ) {
						
						$( ".shapeshifter-mobile-side-menu-aside" ).animate({ "right" : 0 });
						
						shapeshifterBodyBecomeHidden();

					} else if( $( ".shapeshifter-mobile-side-menu-aside" ).css("right") == "0px" ) {
						
						$( ".shapeshifter-mobile-side-menu-aside" ).animate({ "right" : -300 + "px" });
						
						if( $( shapeshifterNavMenuWrapperSelector ).offset().left < 0 ) {

							shapeshifterBodyBecomeAuto();
							
						} else if( $( shapeshifterNavMenuWrapperSelector ).offset().left >= 0 ) {
							
							shapeshifterBodyBecomeHidden();

						}
					}
				});

		}

	// Gallary
		if( $( '.entry-content .gallery' ).exists() ) {
			$( '.entry-content .gallery' ).each( function( index ) {

				var $this = $( this );

				var $imageAs = $this.find( '.shapeshifter-attachment > a' );
				var $imgs = $imageAs.find( '> img' );
				$imageAs.each( function( index ) {

					var $imgA = $( $imageAs[ index ] );
					$imgA.attr( 'href', $imgA.find( '> img' ).attr( 'src' ).replace( /(\-\d+x\d+)\./gi, '\.' ) );

				});

				$this.magnificPopup({
					delegate: '.shapeshifter-attachment a',
					type: 'image',
					closeOnContentClick: false,
					closeBtnInside: false,
					mainClass: 'mfp-with-zoom mfp-img-mobile',
					image: {
						verticalFit: true,
						titleSrc: function( item ) {
							return '<a class="image-source-link" href="' + item.el.attr( 'src' ) + '" target="_blank">' + shapeshifterOptionPage.imageSource + '</a>';
						}
					},
					gallery: {
						enabled: true
					},
					zoom: {
						enabled: true,
						duration: 300, // don't foget to change the duration also in CSS
						opener: function( element ) {
							return element.find( 'img' );
						}
					}
					
				});

			});

		}

	// Popup Image in Contents
		if( $( '.shapeshifter-attachment' ).exists() ) {
			$( '.shapeshifter-attachment' ).each( function( index ) {

				var $this = $( this );
				if( $this.closest( '.gallery-item' ).exists() ) {

				} else {

					$this.magnificPopup({
						delegate: 'a',
						type: 'image',
						closeOnContentClick: false,
						closeBtnInside: false,
						mainClass: 'mfp-with-zoom mfp-img-mobile',
						image: {
							verticalFit: true,
							titleSrc: function( item ) {
								return '<a class="image-source-link" href="' + item.el.attr( 'href' ) + '" target="_blank">' + shapeshifterOptionPage.imageSource + '</a>';
							}
						},
						gallery: {
							enabled: false
						},
						zoom: {
							enabled: true,
							duration: 300, // don't foget to change the duration also in CSS
							opener: function( element ) {
								return element.find( 'img' );
							}
						}
						
					});

				}

			} );

			$( '.gallery-item' ).magnificPopup({
				delegate: 'a',
				type: 'image',
				closeOnContentClick: false,
				closeBtnInside: false,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				image: {
					verticalFit: true,
					titleSrc: function( item ) {
						return '<a class="image-source-link" href="' + item.el.attr( 'href' ) + '" target="_blank">' + shapeshifterOptionPage.imageSource + '</a>';
					}
				},
				gallery: {
					enabled: true
				},
				zoom: {
					enabled: true,
					duration: 300, // don't foget to change the duration also in CSS
					opener: function( element ) {
						return element.find( 'img' );
					}
				}
				
			});
		}


}); }) ( jQuery );
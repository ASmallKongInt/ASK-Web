jQuery.fn.extend({
	exists: function() { 
		return Boolean( this.length > 0 ); 
	},
	animateCss: function( animationName ) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
	animateCssEnter: function( animationName ) {
		jQuery( this ).removeClass( 'shapeshifter-hidden' );
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
	animateCssExit: function( animationName ) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'shapeshifter-hidden animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
});
( function( $ ) {
	// CSSアニメーション
		// Handle Hover Animations
			var handleAnimationHover = function() {

				var $hoverAnimatedClass = $( '.hover-animated' );
				$hoverAnimatedClass.each( function( index ) {
					$( this ).hover( 
						function() {
							animationHover = $( this ).attr( 'data-animation-hover' );
							$( this ).animateCss( animationHover );
						}
					);
					//$( this ).addClass( animationHover );
				});

			};

		// For Enter
			var handleAnimationEnter = function( selector, scrollTop, scrollBottom ) {

				//console.log( scrollTop + ' & ' + scrollBottom );

				$( selector ).each( function( index ) {

					var item = $( selector )[ index ];
					$this = $( item ); //$( selector )[ index ] = 
					
					animationEnter = $this.data( 'animation-enter' );
					if( typeof animationEnter === 'undefined' ) {
						animationEnter = 'fadeIn';
					}

					var itemOffsetTop = $this.offset().top;
					var itemOffsetBottom = $this.outerHeight() + itemOffsetTop;

					if( itemOffsetBottom < scrollTop || scrollBottom < itemOffsetTop ) { // ウィンドウの外

						/*if( ! $this.hasClass( 'shapeshifter-hidden' ) ) {

							animationExit = $this.data( 'animation-exit' );
							if( typeof animationExit !== 'undefined' ) {
								$this.animateCssExit( animationExit );
							}

						}*/

					} else /*if( itemOffsetTop <= scrollBottom && scrollTop <= itemOffsetBottom ) */{ // 要素がウィンドウ内にある

						if( $this.hasClass( 'shapeshifter-hidden' ) ) {
							$this.animateCssEnter( animationEnter );
						}
						
					}

					item = $this = animationEnter = itemOffsetTop = itemOffsetBottom = null;

				} );

				scrollTop = scrollBottom = null;

			};
		// Scroll
			var handleAnimateClass = function() {

				var scrollTop = $( window ).scrollTop();
				var scrollBottom = scrollTop + $( window ).innerHeight();

				handleAnimationEnter( '.enter-animated', scrollTop, scrollBottom );

			};

		// ロード
		if( $( '.shapeshifter-body-pc' ).exists() ) {
			//$( 'html' ).addClass( 'shapeshifter-hidden' );
			$( document ).ready( function() {

				if( $( '.shapeshifter-content' ).exists() ) {
					if( shapeshifterCSSAnimations[ 'div' ][ 'hover' ] !== 'none' ) {

						$( '.shapeshifter-content div div' ).removeClass( 'hover-animated' );
						$( '.shapeshifter-content div div' ).attr( 'data-animation-hover', '' );

					}
					if( shapeshifterCSSAnimations[ 'div' ][ 'enter' ] !== 'none' ) {

						$( '.shapeshifter-content div div' ).removeClass( 'shapeshifter-hidden enter-animated' );
						$( '.shapeshifter-content div div' ).attr( 'data-animation-enter', '' );

					}
				}
				
				//$( 'html' ).removeClass( 'shapeshifter-hidden' );
				
				$( window ).on( 'load', function() {
					handleAnimateClass();
				});
				// スクロール
				$( window ).on( 'scroll', function() {
					handleAnimateClass();
				});
				// Hover
					handleAnimationHover()
			});
		}

}) ( jQuery );
(function($){

	console.log( 'others.js' );

	/* Default Image Settings */
		/* Default Thumbnail For Post List Without thumbnail */
		wp.customize( 'default_thumbnail_image', function( value ) {
			value.bind( function( newval ) {

				window.shapeshifterThemeMods.default_thumbnail_image = newval;
				var siteURL = $( '.shapeshifter-header-site-name a' ).attr( 'href' );
				var defImageURL = siteURL + '/wp-content/themes/shapeshifter/assets/images/no-img.png';

				if( newval == "" ) {
					$( '.default-thumbnail' ).attr( 'src', defImageURL );
					$( '#shapeshifter-theme-customize-preview' ).append( '.widget-entry-def-thumbnail-img { background-image: url(' + defImageURL + '); } ' );
					$( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy' ).attr( 'data-original', defImageURL );
					$( '#shapeshifter-theme-customize-preview' ).append( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy { background-image: url(' + defImageURL + '); } ' );
					/*$( '.default-thumbnail' ).attr( 'src', defImageURL );
					$( '.widget-entry-def-thumbnail-img' ).css( 'background-image', 'url(' + defImageURL + ')' );
					$( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy' ).attr( 'data-original', defImageURL );
					$( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy' ).css( 'background-image', 'url(' + defImageURL + ')' );*/
				} else {
					$( '.default-thumbnail' ).attr( 'src', newval );
					$( '#shapeshifter-theme-customize-preview' ).append( '.widget-entry-def-thumbnail-img, .default-thumbnail { background-image: url(' + newval + '); } ' );
					//$( '.widget-entry-def-thumbnail-img, .default-thumbnail' ).css( 'background-image', 'url(' + newval + ')' );
					$( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy' ).attr( 'data-original', newval );
					$( '#shapeshifter-theme-customize-preview' ).append( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy { background-image: url(' + newval + '); } ' );
					//$( '.widget-entry-def-thumbnail-img, .default-thumbnail-lazy' ).css( 'background-image', 'url(' + newval + ')' );
				}
			});
		});
	
}) ( jQuery );
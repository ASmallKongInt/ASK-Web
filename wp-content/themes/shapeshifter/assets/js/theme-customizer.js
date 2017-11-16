( function( $ ) {

	var require = function( script ) {
		$.ajax({
			url: script,
			dataType: "script",
			//async: false,
			success: function () {
			},
			error: function () {
				//require.call( this, script );
				throw new Error( "Could not load script " + script + ". Now reloading..." );
			}
		});
	};

	window.shapeshifterThemeMods = shapeshifterThemeMods;

	// check if the selected item already exists
	jQuery.fn.exists = function() { return Boolean( this.length > 0 ); }
	
	$( 'body' ).append( '<style id="shapeshifter-theme-customize-preview"></style>' );

// Body
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/body.js' );
// Header
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/header.js' );
// Nav Menu
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/navi-menu.js' );
// Main Content
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/content-area.js' );
// Archive Page
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/archive-page.js' );
// Content Page
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/content-page.js' );
// Footer
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/footer.js' );
// Standard Widget Areas
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/standard-widget-areas.js' );
// Optional Widget Areas
	//require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/optional-widget-areas.js' );
// Others
	require( window.shapeshifterJSTranslatedObject.themeAssetsJSDirectoryURI + 'theme-customizer-parts/others.js' );

// Shortcut
	$( '.shapeshifter-shortcut-to-related-setting > button' ).on( 'click', function( e ) {
		var $this = $( this );
		var settingId = $this.attr( 'data-setting-id' );
		wp.customize.preview.send( 'focus-control-for-setting', settingId );
	});

} ) ( jQuery );
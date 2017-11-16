( function( $ ) {

	console.log( 'header.js' );

	/* Background Color */
		wp.customize( 'header_background_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_background_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'header.shapeshifter-header-nav-visible, ul.shapeshifter-top-nav-menu > li.menu-item > a, ul.shapeshifter-top-nav-menu ul.sub-menu > li.menu-item, ul.shapeshifter-top-nav-menu ul.sub-menu > li.menu-item { background-color: ' + newval + '; } ' );
			});
		});

	/* Site Name Font Family */
		wp.customize( 'header_site_name_font_family', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_site_name_font_family = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1, header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p { font-family: ' + newval + '; } ' );
			});
		});

	/* Site Name Color */
		wp.customize( 'header_site_name_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_site_name_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:link, header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:link, header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a:visited, header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a:visited { color: ' + newval + '; } ' );
				//$( 'header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-h1 > a, header.shapeshifter-header-nav-visible #shapeshifter-header-site-name-p > a { color: ' + newval + '; } ' );
			});
		});

	/* Site Description Font Family */
		wp.customize( 'header_site_description_font_family', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_site_description_font_family = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'header.shapeshifter-header-nav-visible #shapeshifter-header-description-p > a { font-family: ' + newval + '; } ' );
				//$( 'header.shapeshifter-header-nav-visible #shapeshifter-header-description-p { font-family: ' + newval + '; } ' );
			});
		});
		
	/* Site Description Color */
		wp.customize( 'header_site_description_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_site_description_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'header.shapeshifter-header-nav-visible #shapeshifter-header-description-p { color: ' + newval + '; } ' );
				//$( 'header.shapeshifter-header-nav-visible #shapeshifter-header-description-p { color: ' + newval + '; } ' );
			});
		});

	/* Top Nav Menu Font Family */
		wp.customize( 'header_top_nav_menu_font_family', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_top_nav_menu_font_family = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'ul.shapeshifter-top-nav-menu > li.menu-item { font-family: ' + newval + '; } ' );
				//$( 'ul.shapeshifter-top-nav-menu > li.menu-item { font-family: ' + newval + '; } ' );
			});
		});
		
	/* Top Nav Menu Text Color */
		wp.customize( 'header_top_nav_menu_text_color', function( value ) {
			value.bind( function( newval ) {
				window.shapeshifterThemeMods.header_top_nav_menu_text_color = newval;
				$( '#shapeshifter-theme-customize-preview' ).append( 'ul.shapeshifter-top-nav-menu > li.menu-item > a, ul.shapeshifter-top-nav-menu > li.menu-item > a:link, ul.shapeshifter-top-nav-menu > li.menu-item > a:visited { color: ' + newval + '; } ' );
				//$( 'ul.shapeshifter-top-nav-menu > li.menu-item > a, ul.shapeshifter-top-nav-menu > li.menu-item > a:link, ul.shapeshifter-top-nav-menu > li.menu-item > a:visited { color: ' + newval + '; } ' );
			});
		});

}) ( jQuery ); 
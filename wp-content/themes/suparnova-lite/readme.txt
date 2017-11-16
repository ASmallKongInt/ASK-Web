=== Suparnova Lite ===
Contributors: sohan5005, themestones
Tags: left-sidebar, right-sidebar, one-column, two-columns, three-columns, grid-layout, flexible-header, custom-header, custom-menu, custom-logo, featured-images, footer-widgets, sticky-post, theme-options, threaded-comments, translation-ready, blog, news
Requires at least: 3.8
Tested up to: 4.8.2
Stable tag: 1.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Suparnova Lite is a Multi-Purpose Blog & Magazine theme. Fully responsive & corss browser compatible. Comes with 2 different page templates & numerous header variations.

== Description ==

Suparnova Lite is a Multi-Purpose Blog & Magazine theme. It comes with some handy customization options that you can try to make your blog unique. It also comes with 4 build in color skins, Footer widgets, optional left sidebar, optional header, multiple logo / banner layout combination, header and footer banner area for ads, menu icons, customizable header & footer, social media options and much more!

== Frequently Asked Questions ==

= How to customize the header? =
	
The header is divided into 3 different areas. Top header, Logo area & Primary menu area. Each area can be controlled through customizer.

A new menu "Header" is added when the theme is active, from there you can control each of the areas seperately.

** Logo must be changed from Customize > Site identity option.

** For banner ads, go to Header > Logo area and paste your banner code into "Banner Code" field

= How sidebars work on this theme? =

The theme comes with 2 sidebars. Both of them are optional. Means, you can adjust between a 1/2/3 column layout for your blog/magazine. Any layout is fully responsive and work on any screen size or device.

Add widgets to "Sidebar 1 (Primary)" to show the sidebar on the right side.
Add widgets to "Sidebar 2" to show the sidebar on the left side.

= How to customize footer? =

Footer is fully customizable. A new menu "Footer" is added when the theme is active, from there you can control if you want to show social media links on footer and/or widgets. You can change the copyright text on footer from the same option.

The footer widget area is divided into 4 columns which is eventually making it easy to organize widgets and mobile friendly too. When editing widgets, you see Footer Widgets 1 - 4 beside Sidebars. Those are the area that you have to put your widgets.

= Additional options =

A new menu "Blog Options" is added when the theme is active. There are some miscellaneous options that you may need to control. You have options to show "Human Readable Time" like "4 Hours ago" instead of "1:25 PM" or enable schema.org markup (Aka. Rich snippet) on all over your blog for better SEO support.

** schema.org markup is not required to enable if you are using third party SEO plugin that does this.

= Page Templates =

2 Additional page templates are available beside of default home page. Check them out :)

== Resources  ==
Suparnova is created by the theme generator at http://components.underscores.me/, (C) 2015-2016 Automattic, Inc.
Components is distributed under the terms of the GNU GPL v2 or later.

Normalizing styles have been helped along thanks to the fine work of
Nicolas Gallagher and Jonathan Neal http://necolas.github.com/normalize.css/

Bootstrap - http://getbootstrap.com/ - @mdo and @fat, MIT
FontAwesome - http://fontawesome.io/ - Dave Gandy, MIT
Swiper Slider - http://idangero.us/swiper/ - nolimits4web, MIT

Any image files shipped with this theme including "screenshot.png" are created by author and released under CC0

Stock photos used in screenshot:
https://pixabay.com/en/plane-passengers-airplane-flight-691084/ - Free-photos, CC0
https://pixabay.com/en/horseback-riding-lake-water-man-691692/ - Free-photos, CC0
https://pixabay.com/en/houses-building-mountain-highland-2602217/ - StockSnap, CC0
https://pixabay.com/en/people-man-woman-video-camera-2604076/ - StockSnap, CC0

== Copyright ==
Suparnova Lite WordPress Theme, Copyright 2017 Sohan Zaman
Suparnova Lite is distributed under the terms of the GNU GPL

== Changelog ==

= 1.0 =
> Initial upload

= 1.0.1 =
> Added missing screenshot

= 1.0.2 =
> Fixed text domain issue

= 1.0.3 =
> Removed unneccesary debugging function
> Added uncompressed version of css & js files
> Added prefix on variables in global scope

= 1.0.4 =
> Readme file update

= 1.0.5 =
> add_filter( 'jetpack_development_mode', '__return_true' ); Removed.
> 'search-form' support removed form 'html5' theme support.
> No more admin script, removed the feature.
> Fixed all the license and readme file issues. Included links of each images used in the screenshot. album-art.jpg, pre-dark.jpg and pre-white.jpg is made by me. So I don't have any link for them =) it's mentioned on the readme file.
> No more wp_reset_query()
> Removed all extra user fields
> Users can't create menu will see Home instead of Add menu.
> No more hard coded or dynamic date formats. All left empty so that WordPress can decide default date format. Only datetime attribute for <time></time> tag has a hard coded date format for it's purpose.
> suparnova_lite_post_navigation() removed. Using native post navigation function.
> suparnova_lite_get_fontawesome_array() the total functionality removed.
> suparnova_lite_get_id_by_guid() removed.
> style-wpcom.css, wpcom.php removed.
> widgets.php L102, L102 sanitation fixed.
> Suparnova_Lite_Categories1, Suparnova_Lite_Categories2, Suparnova_Lite_Categories3 classes removed.

= 1.0.6 =

> custom_password_form() is now prefixed as suparnova_lite_custom_password_form()

= 1.0.7 =

> widget_title filter fixed with correct arguments
> widgets.php L102 - Use sanitize_text_field() to sanitize simple text field.
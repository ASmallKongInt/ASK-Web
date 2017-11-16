=== ShapeShifter ===
Contributors: nora0123456789
Requires PHP: 5.4
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, custom-colors, custom-menu, featured-images, theme-options, translation-ready, blog
Requires at least: 4.6
Tested up to: 4.7
Stable Tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Customizable Design Theme. 


== Description ==

Simple Customizable Design Theme. 


== Changelog ==

= 1.1.16 =
* Remove const "SHAPESHIFTER_IS_LAZYLOAD_ON" and HTML for that condition, then applied filters so that plugin can modify HTML.

= 1.1.15 =
* Fixed the Style Code.

= 1.1.14 =
* Removed "wp_reset_query()", "wp_reset_postdata()" "wp_title()".
* Replaced the title for archive into "the_archive_title()".
* Replaced search forms into "get_search_form()".
* Fixed a function inside "shapeshifter_version_check()".

= 1.1.13 =
* Removed the Inline Styles.
* Replaced get_the_date() into date_i18n().
* Removed non-used filter Method for thumbnail.

= 1.1.12 =
* Move to Post Meta Settings for FontAwesome Icons.
* Replaced sanitize_text_field() into other methods from class-shapeshifter-styles-handler.php.
* Replaced comment_author_link() into get_comment_author_link() from functions-comments-pings.php.

= 1.1.11 =
* Removed animate-config.json.

= 1.1.10 =
* Added PHP Version check
* Remove Closing Tags.
* "shapeshifter_header()" changed into "get_header".
* "shapeshifter_footer()" changed into "get_footer".
* Removed animated.css-related files in folder assets.
* Arranged Template HTMLs. Some parts replaced into function.

= 1.1.9 =
* Sanitize Fixed "SHAPESHIFTER_SITE_URL", "apply_filters( 'shapeshifter_filters_class_post_list_maybe_ajax', 'post-list' )", "get_the_excerpt()" and others.
* Fixed "empty( function() )" and "function()['$key']" for PHP older versions.
* Changed "echo esc_html__()" into "esc_html_e()".
* Changed "$format" into "esc_html_x( $format, $context, 'shapeshifter' )".
* Modified "readme.txt"

= 1.1.8 =
* Fixed the Prev Next post title.
* Add Comment Texts style.

= 1.1.7 =
* Fixed the child menu style margin.
* Fixed Content Table style.

= 1.1.6 =
* Fixed a Widget Area Output Method.
* Added Comments for Classes, Methods, functions.
* Added Theme Support "customize-selective-refresh-widgets".
* Added some custom edit shortcut for related settings in theme customizer.

= 1.1.5 =
* Fixed the Home Page ( Not Static ).

= 1.1.4 =
* Add Live Preview to Default Theme Customizer Site Title and Description.

= 1.1.3 =
* Fixed Untranslated Text.

= 1.1.2 =
* Add Template Files.
* Add the Gallery Styles.
* Fix the Const Definition

= 1.1.1 =
* Fixed the style for WooCommerce.

= 1.1.0 =
* Made Text translatable.
* Add Sanitizations.
* Add Actions to make plugin code independant ( No more Class Extendings ).
* Fixed Mobile Responsive Sidebar Condition.


== Upgrade Notice ==

= 1.1.16 =
* Remove Lazyload setting.

= 1.1.15 =
* Fixed collapsed style.

= 1.1.14 =
* Fixed for Theme Review Check.

= 1.1.13 =
* Fixed for Theme Review Check.

= 1.1.12 =
* Fixed for Theme Review Check.

= 1.1.11 =
* Fixed for Theme Review Check.

= 1.1.10 =
* Fixed for Theme Review Check.

= 1.1.9 =
* Fixed for Theme Review Check.


== Copyright ==

ShapeShifter WordPress Theme, Copyright (c) 2017 Nora
ShapeShifter is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.


ShapeShifter Theme bundles the following third-party resources:

Alpha Color Picker, by Braad Martin
License: licensed under the GPL
Source: http://braadmartin.com

Normalize.css, Copyright © Nicolas Gallagher
License: Licensed under MIT
Source: http://necolas.github.io/normalize.css/

Animate.css, Copyright (c) 2016 Daniel Eden
License: Licensed under the MIT license
Source: http://daneden.me/animate

Bootstrap3, Copyright 2011-2015 Twitter, Inc.
License: Licensed under MIT
Source: http://getbootstrap.com/

Font Awesome, Created by Dave Gandy
License: http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
Source: http://fontawesome.io

Magnific Popup, Copyright (c) 2014-2015 Dmitry Semenov
License: The MIT License (MIT)
Source: http://dimsemenov.com

Mobile Detect, Serban Ghita <serbanghita@gmail.com>, Nick Ilyin <nick.ilyin@gmail.com>
License: MIT License( https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt )
Source: http://mobiledetect.net
* Modified - Deleting Silencer(@) for Function

TGM Plugin Activation, Copyright (c) 2011, Thomas Griffin
License: GPL-2.0+
Source: http://tgmpluginactivation.com/

Image used in screenshot.png: No Screen URLs, licensed under Creative Commons Zero(http://creativecommons.org/publicdomain/zero/1.0/)

Image used in images/no-img.png:  A photo by tookapic ( https://pixabay.com/ja/%E3%82%B3%E3%83%BC%E3%83%92%E3%83%BC-%E3%82%AB%E3%83%95%E3%82%A7%E3%83%A9%E3%83%86-%E3%82%A8%E3%82%B9%E3%83%97%E3%83%AC%E3%83%83%E3%82%BD-%E3%82%AB%E3%83%97%E3%83%81%E3%83%BC%E3%83%8E-%E3%82%AB%E3%83%83%E3%83%97-%E3%82%AB%E3%83%95%E3%82%A7-932103/ ), licensed under Creative Commons Zero( https://creativecommons.org/publicdomain/zero/1.0/deed.ja )
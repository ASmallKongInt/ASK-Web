<!-- ================================================== -->
<!-- =============== START STARTER JS ================ -->
<!-- ================================================== -->

jQuery(document).ready(function(){
	
	"use strict";

	// FitVides Option
	jQuery("html").fitVids({ customSelector: "iframe"});

	// LightBox Options
	jQuery(".attachment").find('a > img:not(.attachment-thumbnail)').parent().attr('rel','gallery').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	jQuery(".single-article-entry-content .single-content-text a img").parent().attr('rel','gallery-single').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	jQuery(".lightbox").attr('rel','gallery').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});
	
	// "single-post-content" is the class of blog-single content container
	jQuery(".single-post-content").find('a > img').parent().attr('rel','gallery').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	jQuery('.menu-trigger').on('click', function(){

		jQuery(this).toggleClass('opened');

		jQuery('body').toggleClass('menu-opened');

	});

	jQuery('.close-menu').on('click', function(){

		jQuery('.menu-trigger').removeClass('opened');

		jQuery('body').removeClass('menu-opened');

	});

	if ( jQuery('.light-logo').length > 0 ) {

		jQuery('.main-logo').addClass('inverse-logo');

	}

	var headerAffix = {

		init: function (){

			var actualScroll = jQuery(window).scrollTop(),
				menuouterH = jQuery('.main-header').outerHeight();

			jQuery('.main-header').css('top',-menuouterH);

			if ( actualScroll > menuouterH ) {

				jQuery('.main-header').addClass('affix');
				jQuery('body').addClass('menu-is-affix');

			} else {

				jQuery('.main-header').removeClass('affix');
				jQuery('body').removeClass('menu-is-affix');
				jQuery('.main-header').removeClass('show-it');
				jQuery('.main-header').removeClass('hide-it');

			}

		}

	};

	headerAffix.init();

	jQuery(window).scroll(function(){

		headerAffix.init();

	});

	var lastScrollTop = 0;
	jQuery(window).scroll(function(event){
		var st = jQuery(this).scrollTop(),
			initialH = jQuery('.main-header').outerHeight();
		if ( st > initialH ) {
			if (st > lastScrollTop){
				jQuery('.main-header').addClass('hide-it');
				jQuery('.main-header').removeClass('show-it');
			} else {
				jQuery('.main-header').addClass('show-it');
				jQuery('.main-header').removeClass('hide-it');
			}
			lastScrollTop = st;
		}
	});

	jQuery.fn.firstWord = function() {
		var text = this.text().trim().split(" ");
		var first = text.shift();
		this.html((text.length > 0 ? "<span class='firstWord'>"+ first + "</span> " : first) + text.join(" "));
		if ( text != '' ) {} else {
			this.html("<span class='firstWord'>"+ first + "</span> ");
		}
	};

	jQuery(".widget-title").each(function(){

		jQuery(this).firstWord();

	});

	jQuery('.popular_posts_and_category_tabs').each(function(){

		jQuery(this).find('.tabs a').on('click',function(e){

			e.preventDefault();

			var href = jQuery(this).attr('href');

			jQuery(this).parent().find('a').removeClass('active');

			jQuery(this).addClass('active');

			jQuery(this).parent().parent().find('.panel').removeClass('active');

			jQuery(this).parent().parent().find(href).addClass('active');

		});

	});

	jQuery('a#load-more-posts-button').on('click',function(e){

		e.preventDefault();

		var link = jQuery(this).attr('href');

		/** Ajax Call */
		jQuery.get( link, function( data ) {

			//jQuery(data).find("nav.portfolio > ul > li").appendTo(".portfolio > ul.isotope");
			var elements = jQuery(data).find(".main-blog-listing article");

			var newhref = jQuery(data).find(".load-more-posts-container a").attr('href');

			var container = jQuery('.main-blog-listing');

			container.append(elements);

			if(newhref !== undefined) {
				jQuery('.load-more-posts-container a').attr('href', newhref);
			} else {
				jQuery('.load-more-posts-container').fadeOut(300);
			}

		});

	});

	if ( jQuery('body.single-post .article-featured-image img').length > 0 ) {} else {

		var shareImg = jQuery('body.single-post .single-article-entry-content img:first-child').attr('src');

		jQuery('head').append('<meta property="og:image" content="' + shareImg + '"/>');

	}

	if ( jQuery('.main-blog-article-style.format-video').length > 0 ) {

		jQuery('.main-blog-article-style.format-video').each(function(){

			var jQuerythis = jQuery(this),
				vidFor = jQuerythis.find('iframe'),
				vidUrl = vidFor.attr('data-urlVid');

			function youtube_parser(url){
				var regExp = /^.*((\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
				var match = url.match(regExp);
				return (match&&match[7].length==11)? match[7] : false;
			}

			function vimeo_parser(url){
				// look for a string with 'vimeo', then whatever, then a 
				// forward slash and a group of digits.
				var match = /vimeo.*\/(\d+)/i.exec( url );

				// if the match isn't null (i.e. it matched)
				if ( match ) {
					// the grouped/matched digits from the regex
					return match[1];
				}
			}

			if ( jQuerythis.find('iframe.youtube-video').length > 0 ) {

				vidFor.parent().parent().css({

					'background-image' : 'url(http://img.youtube.com/vi/' + youtube_parser(vidUrl) + '/maxresdefault.jpg)'

				});

			} else if ( jQuerythis.find('iframe.vimeo-video').length > 0 ) {

				var url = "http://vimeo.com/api/v2/video/" + vimeo_parser(vidUrl) + ".json";
				
				jQuery.getJSON( url, {format: "json"}).done(function( data ) {

					vidFor.parent().parent().css({

						'background-image' : 'url(' + data[0].thumbnail_large + ')'

					});

				});

			};

		});

	} else if ( jQuery('.single-article.format-video').length > 0 ) {

		jQuery('.single-article.format-video').each(function(){

			var jQuerythis = jQuery(this),
				vidFor = jQuerythis.find('.featured-video-container iframe'),
				vidUrl = vidFor.attr('data-urlVid');

			function youtube_parser(url){
				var regExp = /^.*((\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
				var match = url.match(regExp);
				return (match&&match[7].length==11)? match[7] : false;
			}

			function vimeo_parser(url){
				// look for a string with 'vimeo', then whatever, then a 
				// forward slash and a group of digits.
				var match = /vimeo.*\/(\d+)/i.exec( url );

				// if the match isn't null (i.e. it matched)
				if ( match ) {
					// the grouped/matched digits from the regex
					return match[1];
				}
			}

			if ( jQuerythis.find('.featured-video-container iframe.youtube-video').length > 0 ) {

				vidFor.parent().parent().css({

					'background-image' : 'url(http://img.youtube.com/vi/' + youtube_parser(vidUrl) + '/maxresdefault.jpg)'

				});

			} else if ( jQuerythis.find('.featured-video-container iframe.vimeo-video').length > 0 ) {

				var url = "http://vimeo.com/api/v2/video/" + vimeo_parser(vidUrl) + ".json";
				
				jQuery.getJSON( url, {format: "json"}).done(function( data ) {

					vidFor.parent().parent().css({

						'background-image' : 'url(' + data[0].thumbnail_large + ')'

					});

				});

			};

			jQuerythis.find('.featured-video-container .cover-all').on('click',function(){

				jQuery(this).parent().addClass('active');

				if ( jQuerythis.find('.featured-video-container iframe.youtube-video').length > 0 ) {

					vidFor.attr('src','https://www.youtube.com/embed/' + youtube_parser(vidUrl) + '?autoplay=1' );

				} else if ( jQuerythis.find('.featured-video-container iframe.vimeo-video').length > 0 ) {

					vidFor.attr('src','//player.vimeo.com/video/' + vimeo_parser(vidUrl) + '?autoplay=1' );

				};

			});

		});

	}

});

<!-- ================================================== -->
<!-- =============== END STARTER JS ================ -->
<!-- ================================================== -->
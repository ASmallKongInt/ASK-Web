jQuery(function($) {
	'use strict';

	var $window = $(window),
		$body = $('body'),
		$navBar = $('.navbar'),
		clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

	function searchForm() {
		$(".header-search button.header-search__click ").on("click", function() {
			$(".header-search__wrapper").fadeToggle(),
				$(".header-search__wrapper input.search-field").focus();
		});


	}

	//sticky Header
	function stickyHeader() {
		$(window).scroll(function() {
			if ($("div").hasClass("header-content")) {

				if ($(window).scrollTop() > 0) {
					$(".site-header").css("margin-top", $(".header-content").height());
					$(".site-header").addClass("sticky-header");

					if ($("body").hasClass("admin-bar")) {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", $window.width() < 783 ? "46px" : "32px");
					} else {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", "0");
					}
				} else {
					$(".site-header").removeClass("sticky-header");
					$(".site-header").css("margin-top", "0");
					$(".header-content").css("position", "relative");
					$(".header-content").css("top", "0");
				}

				if ($(window).width() < 601 && $("body").hasClass("admin-bar")) {
					if ($(window).scrollTop() > 46) {
						$(".header-content").css("position", "fixed");
						$(".header-content").css("top", "0");
					} else {
						$(".site-header").css("margin-top", "0");
						$(".header-content").css("position", "relative");
						$(".header-content").css("top", "0");
					}
				}

			}
		})
	}

	//Slider Gallery
	function slickGallery() {

		$('.grid-gallery').slick({
			focusOnSelect: true,
			swipeToSlide: true,
			adaptiveHeight: true,
			'nextArrow': '<i class="fa fa-angle-right slick-next"></i>',
			'prevArrow': '<i class="fa fa-angle-left slick-prev"></i>'
		});
		$('.grid-gallery').slick('slickGoTo', 1);

		$('.featured-posts .featured-post__content').slick({
			dots: false,
			infinite: true,
			speed: 600,
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 4000,
			centerMode: false,
			variableWidth: false,
			rtl: $body.hasClass( 'rtl' ) ? true : false,
			nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
			prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>',
			responsive: [{
				breakpoint: 960,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		}); // slick
	}

	function toggleMobileMenu() {
		var $body = $('body'),
			mobileClass = 'mobile-menu-open',
			clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
			transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

		// Click to show mobile menu.
		$('.menu-toggle').on(clickEvent, function(event) {
			event.preventDefault();
			event.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			if ($body.hasClass(mobileClass)) {
				return;
			}
			$body.addClass(mobileClass);
		});

		// When mobile menu is open, click on page content will close it.
		$('.site')
			.on(clickEvent, function(event) {
				if (!$body.hasClass(mobileClass)) {
					return;
				}
				event.preventDefault();
				$body.removeClass(mobileClass).addClass('animating');
			})
			.on(transitionEnd, function() {
				$body.removeClass('animating');
			});
	}

	/**
	 * Add toggle dropdown icon for mobile menu.
	 * @param $container
	 */
	function initMobileNavigation($container) {
		// Add dropdown toggle that displays child menu items.
		var $dropdownToggle = $('<span class="dropdown-toggle fa fa-angle-down"></span>');

		$container.find('.menu-item-has-children > a').after($dropdownToggle);

		// Toggle buttons and sub menu items with active children menu items.
		$container.find('.current-menu-ancestor > .sub-menu').show();
		$container.find('.current-menu-ancestor > .dropdown-toggle').addClass('toggled-on');
		$container.on(clickEvent, '.dropdown-toggle', function(e) {
			e.preventDefault();
			$(this).toggleClass('toggled-on');
			$(this).next('ul').toggle();
		});
	}

	/**
	 * Scroll to top
	 */
	function scrollToTop() {
		var $window = $(window),
			$button = $('.scroll-to-top');
		$window.scroll(function() {
			$button[$window.scrollTop() > 100 ? 'removeClass' : 'addClass']('hidden');
		});
		$button.on('click', function(e) {
			e.preventDefault();
			$('body, html').animate({
				scrollTop: 0
			}, 500);
		});
	}

	function hideMobileMenuOnDesktops() {
		$window.on( 'resize', function () {
			if ( $window.width() > 992 ) {
				$body.removeClass('mobile-menu-open');
			}
		} )
	}

	/**
	 * Sticky Sidebar
	 */
	function stickySidebar() {

		var offset = 0;

		$('.add_sticky_sidebar').theiaStickySidebar({
			additionalMarginTop: offset
		});

	}

	stickyHeader();
	scrollToTop();
	searchForm();
	slickGallery();
	toggleMobileMenu();
	initMobileNavigation($('.mobile-menu'));
	hideMobileMenuOnDesktops();
	stickySidebar();
});

(function($) {
	
	// Select fields
	function initSelect() {
		$('select').wrap('<div class="suparnova-lite-select-field"></div>').after('<i class="fa fa-chevron-down"></i>');
	}
	
	// Swiper Sliders
	function initSwipers() {
		window.suparnova_lite_swipers = {};
		suparnova_lite_swipers.featured = {};
		
		$('.featured-post-carousel .swiper-container, .suparnova-lite-featured-slider .swiper-container').each(function(i) {
		
			suparnova_lite_swipers.featured[i] = new Swiper ( $(this).get(0), {
				autoplay: 3750,
				speed: 700,
				simulateTouch: false,
				autoplayDisableOnInteraction: false,
				prevButton: 'a.slide-prev',
				nextButton: 'a.slide-next',
				spaceBetween: 0,
				grabCursor: false,
				loop: true
			});
			
			$(this).mouseenter(function() {
				suparnova_lite_swipers.featured[i].stopAutoplay();
			}).mouseleave(function() {
				suparnova_lite_swipers.featured[i].startAutoplay();
			});
			
		});
	}
	
	$(document).ready(function() {
		initSelect();
		initSwipers();
	});
	
})(jQuery);
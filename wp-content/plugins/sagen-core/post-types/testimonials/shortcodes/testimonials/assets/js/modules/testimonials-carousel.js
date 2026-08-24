(function($) {
	'use strict';

	var testimonialsVertical = {};
	qodef.modules.qodefInitTestimonialsVertical = qodefInitTestimonialsVertical;

	testimonialsVertical.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTestimonialsVertical();
	}

	/**
	 * Initializes testimonials vertical logic
	 */

	function qodefInitTestimonialsVertical() {
		var holders = $('.qodef-testimonials-holder');

		if(holders.length) {
			holders.each(function(){
				var holder = $(this),
					swiperInstance = holder.find('.swiper-container'),
					singleItem = holder.find('.qodef-testimonial-content'),
					dataHolder = holder.find('.qodef-testimonials'),
					loop = true,
					delay = 5000,
					speed = 600,
					// navigation = false,
					pagination = false;

				var maxHeight = 0;

				singleItem.each(function() {
					var thisHeight = $(this).outerHeight();
					if (thisHeight > maxHeight) {
						maxHeight = thisHeight;
					}
				});

				swiperInstance.css("height", maxHeight);
				$('.qodef-testimonial-content').css("height", maxHeight);
				holders.css("opacity", "1");

				if( typeof(dataHolder.data('enable-loop')) !== 'undefined' && dataHolder.data('enable-loop') !== false ){
					if(dataHolder.data('enable-loop') === 'no'){
						loop = false;
					}
				}

				if( typeof(dataHolder.data('slider-speed')) !== 'undefined' && dataHolder.data('slider-speed') !== false){
					delay = dataHolder.data('slider-speed');
				}

				if( typeof(dataHolder.data('enable-autoplay')) !== 'undefined' && dataHolder.data('enable-autoplay') !== false){
					if(dataHolder.data('enable-autoplay') === 'no'){
						delay = 1000000;
					}
				}

				if( typeof(dataHolder.data('slider-speed-animation')) !== 'undefined' && dataHolder.data('slider-speed-animation') !== false){
					speed = dataHolder.data('slider-speed-animation');
				}

				// if( dataHolder.data('enable-navigation') === 'yes'){
				// 	navigation = {
				// 		nextEl: holder.find('.swiper-button-next'),
				// 		prevEl: holder.find('.swiper-button-prev'),
				// 	};
				// }
				if( dataHolder.data('enable-pagination') === 'yes'){
					pagination = {
						el: holder.find('.qodef-testimonials-pag'),
						type: 'bullets',
						clickable: true,
						renderBullet: function (index, className) {
							return '<a class="' + className + '">' + '0' + (index + 1) + '</a>';
						},
					};
				}

				var swiperSlider = new Swiper (swiperInstance, {
					loop: loop,
					autoplay: {
						delay: delay,
					},
					direction: 'vertical',
					slidesPerView: 'auto',
					freeMode: false,
					speed: speed,
					pagination: pagination,
					// navigation: navigation,
					init: false
				});

				swiperSlider.on('slideChange', function() {
				});

				swiperSlider.on('transitionEnd', function() {
				});


				swiperSlider.on('init', function() {
					qodef.modules.common.qodefInitParallax();
				});

				holder.waitForImages(function() {
					swiperSlider.init();
				});

				$(window).on('resize', function() {
				});

			});
		}
	}

})(jQuery);
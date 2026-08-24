(function ($) {
	'use strict';
	
	var rating = {};
	qodef.modules.rating = rating;

    rating.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCommentRating();
	}
	
	function qodefInitCommentRating() {
		var ratingHolder = $('.qodef-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

		ratingHolder.each(function() {
		    var thisHolder = $(this),
                ratingInput = thisHolder.find('.qodef-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.qodef-star-rating');

                addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.change(function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
	}
	
})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	qodef.modules.accordions = accordions;
	
	accordions.qodefInitAccordions = qodefInitAccordions;
	
	
	accordions.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.qodef-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function ($) {
	'use strict';
	
	var anchorMenu = {};
	qodef.modules.anchorMenu = anchorMenu;
	
	anchorMenu.qodefAnchorMenu = qodefAnchorMenu;
	
	
	anchorMenu.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefAnchorMenu();
	}
	
	/*
	 *  Anchor Menu relocation
	 */
	function qodefAnchorMenu() {
		var anchorMenu = $('.qodef-anchor-menu');
		
		if (anchorMenu.length && qodef.windowWidth > 1024) {
			anchorMenu.remove();
			$('.qodef-content-inner').append(anchorMenu.addClass('qodef-init'));
			
			//scroll active item logic
			var anchorSections = $('div[data-qodef-anchor]'),
				anchorMenuItems = anchorMenu.find('.qodef-anchor');
			
			if (anchorSections.length && anchorMenuItems.length) {
				anchorMenuItems.first().addClass('qodef-active');
				
				$(window).scroll(function () {
					anchorSections.each(function (i) {
						var anchorSection = $(this),
							anchorSectionTop = anchorSection.offset().top,
							anchorSectionHeight = anchorSection.outerHeight(),
							offset = qodef.windowHeight / 5,
							currentItemIndex = 0;
						
						if ( qodef.scroll === 0 ) {
							anchorMenuItems.removeClass('qodef-active').first().addClass('qodef-active');
						} else if (anchorSectionTop <= qodef.scroll + offset && anchorSectionTop + anchorSectionHeight >= qodef.scroll + offset) {
							if (currentItemIndex !== i) {
								currentItemIndex = i;
								anchorMenuItems.removeClass('qodef-active').eq(i).addClass('qodef-active');
							}
						} else if (qodef.scroll + qodef.windowHeight == qodef.document.height()) {
							anchorMenuItems.removeClass('qodef-active').last().addClass('qodef-active');
						}
					});
				});
			}
		}
	}
	
})(jQuery);




(function($) {
	'use strict';
	
	var animationHolder = {};
	qodef.modules.animationHolder = animationHolder;
	
	animationHolder.qodefInitAnimationHolder = qodefInitAnimationHolder;
	
	
	animationHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){
		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	qodef.modules.button = button;
	
	button.qodefButton = qodefButton;
	
	
	button.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function ($) {
	'use strict';

	var cardsGallery           = {};
	qodef.modules.cardsGallery = cardsGallery;

	cardsGallery.qodefOnWindowLoad = qodefOnWindowLoad;

	$( window ).on(
		'load',
		function(){
			qodefOnWindowLoad();
		}
	);

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitCardsGallery();
	}

	/*
	 **	Init cards gallery shortcode
	 */
	function qodefInitCardsGallery() {
		var holder = $( '.qodef-cards-gallery' );

		if (holder.length) {
			holder.each(
				function () {
					var thisHolder = $( this ),
					cards          = thisHolder.find( '.qodef-cg-card' );

					cards.each(
						function () {
							var card = $( this );

							card.on(
								'click',
								function () {
									if ( ! cards.last().is( card )) {
										card.addClass( 'qodef-out qodef-animating' ).siblings().addClass( 'qodef-animating-siblings' );
										card.detach();
										card.insertAfter( cards.last() );

										setTimeout(
											function () {
												card.removeClass( 'qodef-out' );
											},
											200
										);

										setTimeout(
											function () {
												card.removeClass( 'qodef-animating' ).siblings().removeClass( 'qodef-animating-siblings' );
											},
											1200
										);

										cards = thisHolder.find( '.qodef-cg-card' );

										return false;
									}
								}
							);
						}
					);

					console.log( qodef.htmlEl.hasClass( 'touch' ) );
					if (thisHolder.hasClass( 'qodef-bundle-animation' ) && ! qodef.htmlEl.hasClass( 'touch' )) {
						thisHolder.appear(
							function () {
								thisHolder.addClass( 'qodef-appeared' );
								thisHolder.find( 'img' ).one(
									'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd',
									function () {
										$( this ).addClass( 'qodef-animation-done' );
									}
								);
							},
							{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount}
						);
					}
				}
			);
		}
	}

})( jQuery );

(function($) {
	'use strict';

	var countdown           = {};
	qodef.modules.countdown = countdown;

	countdown.qodefInitCountdown = qodefInitCountdown;

	countdown.qodefOnDocumentReady = qodefOnDocumentReady;

	$( document ).ready( qodefOnDocumentReady );

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCountdown();
	}

	/**
	 * Countdown Shortcode
	 */
	function qodefInitCountdown() {
		var countdowns   = $( '.qodef-countdown' ),
			date         = new Date(),
			currentMonth = date.getMonth(),
			currentYear  = date.getFullYear(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;

		if (countdowns.length) {
			countdowns.each(
				function(){
					//Find countdown elements by id-s
					var countdownId = $( this ).attr( 'id' ),
					countdown       = $( '#' + countdownId ),
					digitFontSize,
					labelFontSize;

					//Get data for countdown
					year          = countdown.data( 'year' );
					month         = countdown.data( 'month' );
					day           = countdown.data( 'day' );
					hour          = countdown.data( 'hour' );
					minute        = countdown.data( 'minute' );
					timezone      = countdown.data( 'timezone' );
					monthLabel    = countdown.data( 'month-label' );
					dayLabel      = countdown.data( 'day-label' );
					hourLabel     = countdown.data( 'hour-label' );
					minuteLabel   = countdown.data( 'minute-label' );
					secondLabel   = countdown.data( 'second-label' );
					digitFontSize = countdown.data( 'digit-size' );
					labelFontSize = countdown.data( 'label-size' );

					if ( currentMonth !== month || currentYear !== year) {
						month = month - 1;
					}

					//Initialize countdown
					countdown.countdown(
						{
							until: new Date( year, month, day, hour, minute, 44 ),
							labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
							format: 'ODHMS',
							timezone: timezone,
							padZeroes: true,
							onTick: setCountdownStyle
						}
					);

					function setCountdownStyle() {
						countdown.find( '.countdown-amount' ).css(
							{
								'font-size' : digitFontSize + 'px',
								'line-height' : digitFontSize + 'px'
							}
						);
						countdown.find( '.countdown-period' ).css(
							{
								'font-size' : labelFontSize + 'px'
							}
						);
					}
				}
			);
		}
	}

})( jQuery );

(function($) {
	'use strict';
	
	var counter = {};
	qodef.modules.counter = counter;
	
	counter.qodefInitCounter = qodefInitCounter;
	
	
	counter.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function qodefInitCounter() {
		var counterHolder = $('.qodef-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.qodef-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('qodef-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	qodef.modules.customFont = customFont;
	
	customFont.qodefCustomFontResize = qodefCustomFontResize;
	customFont.qodefCustomFontTypeOut = qodefCustomFontTypeOut;
	
	
	customFont.qodefOnDocumentReady = qodefOnDocumentReady;
	customFont.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).on('load', function(){
		qodefOnWindowLoad
	});
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function qodefCustomFontResize() {
		var holder = $('.qodef-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function qodefCustomFontTypeOut() {
		var qodefTyped = $('.qodef-cf-typed');
		
		if (qodefTyped.length) {
			qodefTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.qodef-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.qodef-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.qodef-cf-typed-1').text(),
					string_2 = thisTyped.find('.qodef-cf-typed-2').text(),
					string_3 = thisTyped.find('.qodef-cf-typed-3').text(),
					string_4 = thisTyped.find('.qodef-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	qodef.modules.elementsHolder = elementsHolder;

	elementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;


	elementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.qodef-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						mac = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1441-1700') !== 'undefined' && thisItem.data('1441-1700') !== false) {
						largeLaptop = thisItem.data('1441-1700');
					}
					if (typeof thisItem.data('1367-1440') !== 'undefined' && thisItem.data('1367-1440') !== false) {
						mac = thisItem.data('1367-1440');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || mac.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1441px) and (max-width: 1700px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(mac.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1440px) {.qodef-eh-item-content."+itemClass+" { padding: "+mac+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof qodef.modules.common.qodefOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.qodef-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function($) {
	'use strict';

	var googleMap           = {};
	qodef.modules.googleMap = googleMap;

	googleMap.qodefShowGoogleMap = qodefShowGoogleMap;

	googleMap.qodefOnDocumentReady = qodefOnDocumentReady;

	$( document ).ready( qodefOnDocumentReady );

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMap();
	}

	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $( '.qodef-google-map' );

		if (googleMap.length) {
			googleMap.each(
				function(){
					var element = $( this );

					var snazzyMapStyle = false;
					var snazzyMapCode  = '';
					if (typeof element.data( 'snazzy-map-style' ) !== 'undefined' && element.data( 'snazzy-map-style' ) === 'yes') {
						snazzyMapStyle      = true;
						var snazzyMapHolder = element.parent().find( '.qodef-snazzy-map' ),
						snazzyMapCodes      = snazzyMapHolder.val();

						if ( snazzyMapHolder.length && snazzyMapCodes.length ) {
							snazzyMapCode = JSON.parse( snazzyMapCodes.replace( /`{`/g, '[' ).replace( /`}`/g, ']' ).replace( /``/g, '"' ).replace( /`/g, '' ) );
						}
					}

					var customMapStyle;
					if (typeof element.data( 'custom-map-style' ) !== 'undefined') {
						customMapStyle = element.data( 'custom-map-style' );
					}

					var colorOverlay;
					if (typeof element.data( 'color-overlay' ) !== 'undefined' && element.data( 'color-overlay' ) !== false) {
						colorOverlay = element.data( 'color-overlay' );
					}

					var saturation;
					if (typeof element.data( 'saturation' ) !== 'undefined' && element.data( 'saturation' ) !== false) {
						saturation = element.data( 'saturation' );
					}

					var lightness;
					if (typeof element.data( 'lightness' ) !== 'undefined' && element.data( 'lightness' ) !== false) {
						lightness = element.data( 'lightness' );
					}

					var zoom;
					if (typeof element.data( 'zoom' ) !== 'undefined' && element.data( 'zoom' ) !== false) {
						zoom = element.data( 'zoom' );
					}

					var pin;
					if (typeof element.data( 'pin' ) !== 'undefined' && element.data( 'pin' ) !== false) {
						pin = element.data( 'pin' );
					}

					var mapHeight;
					if (typeof element.data( 'height' ) !== 'undefined' && element.data( 'height' ) !== false) {
						mapHeight = element.data( 'height' );
					}

					var uniqueId;
					if (typeof element.data( 'unique-id' ) !== 'undefined' && element.data( 'unique-id' ) !== false) {
						uniqueId = element.data( 'unique-id' );
					}

					var scrollWheel;
					if (typeof element.data( 'scroll-wheel' ) !== 'undefined') {
						scrollWheel = element.data( 'scroll-wheel' );
					}
					var addresses;
					if (typeof element.data( 'addresses' ) !== 'undefined' && element.data( 'addresses' ) !== false) {
						addresses = element.data( 'addresses' );
					}

					var map      = "map_" + uniqueId;
					var geocoder = "geocoder_" + uniqueId;
					var holderId = "qodef-map-" + uniqueId;

					qodefInitializeGoogleMap( snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses );
				}
			);
		}
	}

	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

		if (typeof google !== 'object') {
			return;
		}

		var mapStyles = [];
		if (snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
			}
			];
		}

		var googleMapStyleId;

		if (snazzyMapStyle || customMapStyle === 'yes') {
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}

		wheel = wheel === 'yes';

		var qoogleMapType = new google.maps.StyledMapType( mapStyles, {name: "Google Map"} );

		geocoder   = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng( -34.397, 150.644 );

		if ( ! isNaN( height )) {
			height = height + 'px';
		}

		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};

		map = new google.maps.Map( document.getElementById( holderId ), myOptions );
		map.mapTypes.set( 'qodef-style', qoogleMapType );

		var index;

		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress( data[index], pin, map, geocoder );
		}

		var holderElement          = document.getElementById( holderId );
		holderElement.style.height = height;
	}

	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}

		var contentString = '<div id="content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<div id="bodyContent">' +
			'<p>' + data + '</p>' +
			'</div>' +
			'</div>';

		var infowindow = new google.maps.InfoWindow(
			{
				content: contentString
			}
		);

		geocoder.geocode(
			{ 'address': data},
			function(results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
					map.setCenter( results[0].geometry.location );
					var marker = new google.maps.Marker(
						{
							map: map,
							position: results[0].geometry.location,
							icon:  pin,
							title: data.store_title
						}
					);
					google.maps.event.addListener(
						marker,
						'click',
						function() {
							infowindow.open( map,marker );
						}
					);
					window.addEventListener(
						'resize',
						function () {
							map.setCenter( results[0].geometry.location );
						}
					);
				}
			}
		);
	}

})( jQuery );

(function($) {
	'use strict';
	
	var icon = {};
	qodef.modules.icon = icon;
	
	icon.qodefIcon = qodefIcon;
	
	
	icon.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIcon = function() {
		var icons = $('.qodef-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('qodef-icon-animation')) {
				icon.appear(function() {
					icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.qodef-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	qodef.modules.iconListItem = iconListItem;
	
	iconListItem.qodefInitIconList = qodefInitIconList;
	
	
	iconListItem.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	qodef.modules.pieChart = pieChart;
	
	pieChart.qodefInitPieChart = qodefInitPieChart;
	
	
	pieChart.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function qodefInitPieChart() {
		var pieChartHolder = $('.qodef-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.qodef-pc-percentage'),
					barColor = '#222222',
					trackColor = '#ffffff',
					lineWidth = 1,
					size = 196;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: false,
						scaleColor: false,
						lineCap: 'square',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.qodef-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	qodef.modules.process = process;
	
	process.qodefInitProcess = qodefInitProcess;
	
	
	process.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProcess();
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function qodefInitProcess() {
		var holder = $('.qodef-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('qodef-process-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	qodef.modules.progressBar = progressBar;
	
	progressBar.qodefInitProgressBars = qodefInitProgressBars;
	
	
	progressBar.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars() {
		var progressBar = $('.qodef-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					progressBar = thisBar.find('.qodef-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					qodefInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('qodef-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var stackedImages = {};
	qodef.modules.stackedImages = stackedImages;

	stackedImages.qodefInitItemShowcase = qodefInitStackedImages;


	stackedImages.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitStackedImages();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function qodefInitStackedImages() {
		var stackedImages = $('.qodef-stacked-images-holder');

		if (stackedImages.length) {
			stackedImages.each(function(){
				var thisStackedImages = $(this),
					itemImage = thisStackedImages.find('.qodef-si-images');

				//logic
				thisStackedImages.animate({opacity:1},200);

				setTimeout(function(){
					thisStackedImages.appear(function(){
						itemImage.addClass('qodef-appeared');
					},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
				},100);
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	qodef.modules.tabs = tabs;
	
	tabs.qodefInitTabs = qodefInitTabs;
	
	
	tabs.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.qodef-tabs a.qodef-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';
    
    var textMarquee = {};
    qodef.modules.textMarquee = textMarquee;
    
    textMarquee.qodefTextMarquee = qodefTextMarquee;
    
    textMarquee.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefTextMarquee().init();
        qodefMarqueeTextResize();
    }

    /*
     ** Custom Font resizing
     */
    function qodefMarqueeTextResize() {
        var marqueeText = $('.qodef-text-marquee');

        if (marqueeText.length) {
            marqueeText.each(function () {
                var thisMarqueeText = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (qodef.windowWidth < 1480) {
                    coef1 = 0.8;
                }

                if (qodef.windowWidth < 1200) {
                    coef1 = 0.7;
                }

                if (qodef.windowWidth < 768) {
                    coef1 = 0.55;
                    coef2 = 0.65;
                }

                if (qodef.windowWidth < 600) {
                    coef1 = 0.45;
                    coef2 = 0.55;
                }

                if (qodef.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                fontSize = parseInt(thisMarqueeText.css('font-size'));

                if (fontSize > 200) {
                    fontSize = Math.round(fontSize * coef1);
                } else if (fontSize > 60) {
                    fontSize = Math.round(fontSize * coef2);
                }

                thisMarqueeText.css('font-size', fontSize + 'px');

                lineHeight = parseInt(thisMarqueeText.css('line-height'));

                if (lineHeight > 70 && qodef.windowWidth < 1440) {
                    lineHeight = '1.2em';
                } else if (lineHeight > 35 && qodef.windowWidth < 768) {
                    lineHeight = '1.2em';
                } else {
                    lineHeight += 'px';
                }

                thisMarqueeText.css('line-height', lineHeight);

            });
        }
    }

    /**
     * Init Text Marquee effect
     */
    function qodefTextMarquee() {
        var marquees = $('.qodef-text-marquee');

        var Marquee = function (marquee) {
            this.holder = marquee;
            this.els = this.holder.find('.qodef-marquee-element');
            this.delta = .05;
        }

        var inRange = function (el) {
            if (qodef.scroll + qodef.windowHeight >= el.offset().top &&
                qodef.scroll < el.offset().top + el.height()) {
                return true;
            }

            return false;
        }

        var loop = function (marquee) {
            if (!inRange(marquee.holder)) {
                requestAnimationFrame(function () {
                    loop(marquee);
                });
                return false;
            } else {
                marquee.els.each(function (i) {
                    var el = $(this);
                    el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
                    el.data('x', (el.data('x') - marquee.delta).toFixed(2));
                    el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
                })
                requestAnimationFrame(function () {
                    loop(marquee);
                });
            }
        }

        var init = function (marquee) {
            marquee.els.each(function (i) {
                $(this).data('x', 0);
            });

            requestAnimationFrame(function () {
                loop(marquee);
            });
        }

        return {
            init: function () {
                marquees.length &&
                marquees.each(function () {
                    var marquee = new Marquee($(this));

                    init(marquee);
                });
            }
        }
    }
})(jQuery);
(function ($) {
    'use strict';

    var titleHeroSection = {};
    qodef.modules.titleHeroSection = titleHeroSection;

    titleHeroSection.qodefTitleHeroSection = qodefTitleHeroSection;
    titleHeroSection.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefTitleHeroSection();
    }

    /**
     * Init Title Hero Section Shortcode
     */
    function qodefTitleHeroSection() {
        var titleHeroSection = $('.qodef-title-hero-section-holder');

        if (titleHeroSection.length) {
            var svgDelay = 0;
            
            if(qodef.windowWidth < 1025) {
                titleHeroSection.find('.qodef-title-hero-section-brush-svg:lt(2)').remove();
            }

            titleHeroSection.addClass('qodef-title-hero-section-loaded');
    
            $(window).on('load', function(){
                titleHeroSection.find('.qodef-title-hero-section-brush-svg').each(function() {
                    var svgEl = $(this),
                        svgElScaleX = 1;
    
                    setTimeout(function() {
                        function animateSVG() {
                            svgEl.addClass('svg-animate');
                            svgEl.css('transform', 'rotate('+ (Math.floor(Math.random() * 361) + 1) +'deg) scaleX('+ svgElScaleX +')');
                            svgElScaleX*= -1;
                            if(qodef.windowWidth < 1025) {
                                if (svgEl.index() == 1) {
                                    svgEl.css('margin-left', Math.floor(Math.random() * 60) + 'vw');
                                    svgEl.css('margin-top', (Math.floor(Math.random() * (62 - 59 + 1)) + 59) + 'vh');
                                }
                                if (svgEl.index() == 2) {
                                    svgEl.css('margin-left', Math.floor(Math.random() * 60) + 'vw');
                                    svgEl.css('margin-top', Math.floor(Math.random() * 5) + 'vh');
                                }
                            } else {
                                if (svgEl.index() == 1) {
                                    svgEl.css('margin-left', Math.floor(Math.random() * 7) + 'vw');
                                    svgEl.css('margin-top', Math.floor(Math.random() * 5) + 'vh');
                                }
                                if (svgEl.index() == 2) {
                                    svgEl.css('margin-left', (Math.floor(Math.random() * (75 - 60 + 1)) + 60) + 'vw');
                                    svgEl.css('margin-top', Math.floor(Math.random() * 55) + 'vh');
                                }
                                if (svgEl.index() == 3) {
                                    svgEl.css('margin-left', Math.floor(Math.random() * 7) + 'vw');
                                    svgEl.css('margin-top', (Math.floor(Math.random() * (60 - 50 + 1)) + 50) + 'vh');
                                }
                                if (svgEl.index() == 4) {
                                    svgEl.css('margin-left', (Math.floor(Math.random() * (50 - 30 + 1)) + 30) + 'vw');
                                    svgEl.css('margin-top', Math.floor(Math.random() * 5) + 'vh');
                                }
                            }
                            
                            
                        setTimeout(function() {
                            svgEl.removeClass('svg-animate');
                            }, svgDelay/2.5);
                        }
        
                        animateSVG();
        
                        setInterval(function() {
                            animateSVG();
                        }, svgDelay);
        
                    }, svgDelay);
    
                  svgDelay+= 2000;
                })
			});
        }
    }
})(jQuery);

(function ($) {
    'use strict';

    var verticalCarousel = {};
    qodef.modules.verticalCarousel = verticalCarousel;

    verticalCarousel.qodefVerticalCarousel = qodefVerticalCarousel;
    verticalCarousel.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefVerticalCarousel();
    }

    /**
     * Init vertical carousel shortcode
     */
    function qodefVerticalCarousel() {
        var carousels = $('.qodef-vertical-carousel');

        if (carousels.length) {
            carousels.each(function () {
                var carouselHolder = $(this),
                    imagesSlider = $(this).find('.qodef-vc-images-slider'),
                    contentHolder = $(this).find('.qodef-vc-content'),
                    content = contentHolder.find('.qodef-vc-item-content');

                var initialSliderSetup = function(slider) {
                    imagesSlider.css('visibility', 'visible');
                    imagesSlider.find('.qodef-vc-images-slider-item:last-child').addClass('qodef-prev');
                    imagesSlider.find('.qodef-vc-images-slider-item:first-child').addClass('qodef-active');
                    contentHolder.find('.qodef-vc-item-content:first-child').addClass('qodef-active');
                }

                var updateContentIndex = function(activeIndex) {
                    contentHolder
                        .find('.qodef-vc-item-content')
                        .removeClass('qodef-active')
                        .filter(function() { 
                            return $(this).data("index") == activeIndex; 
                        }).addClass('qodef-active');
                }
                
                //prep for transition
                var toggleClasses = function(slider) {
                    slider
                        .find('.qodef-vc-images-slider-item')
                        .removeClass('qodef-prev')
                        .filter('.qodef-active')
                        .addClass('qodef-prev');
                }
    
                //transition
                var changeActiveItems = function(slider, items, activeIndex) {
                    items
                        .removeClass('qodef-active')
                        .filter(function() { 
                            return $(this).data("index") == activeIndex; 
                        }).addClass('qodef-active');

                    updateContentIndex(activeIndex);

                    items
                        .filter('.qodef-vc-images-slider-item.qodef-active')
                        .one(qodef.animationEnd, function() {
                            slider.data('animating') && slider.data('animating', false);
                            !slider.data('autoplay') && autoplaySlides(slider);
                        });
                }
    
                //autoplay
                var autoplaySlides = function(slider) {
                    var slides = slider.find('.qodef-vc-images-slider-item'),
                        interval = 5000;
    
                    slider.data('autoplay', setInterval(function(){
                        var currentItem = slides.filter('.qodef-active').data('index'),
                            activeIndex = currentItem < slides.length ? currentItem + 1 : 1;
                            
                        slider.data('animating', true);
                        toggleClasses(slider);
                        changeActiveItems(slider, slider.find('.qodef-vc-images-slider-item'), activeIndex);
                    }, interval));
                }
    
                //navigate slides
                var navigateSlides = function(slider) {
                    var currentPagIndex = 1;
    
                    var changeSlideTo = function(slides, itemIndex) {
                        var activeIndex = itemIndex;
                        slider.data('animating', true);
    
                        clearInterval(slider.data('autoplay'));
                        slider.data('autoplay', false);
                        toggleClasses(slider);
                        changeActiveItems(slider, slider.find('.qodef-vc-images-slider-item'), activeIndex);
                    }
                    
                    // Content Item Click
                    content.on('click', function(e){
                        e.preventDefault();
                        
                        var thisContent = $(this),
                            itemIndex = thisContent.data('index');

                        if (itemIndex !== currentPagIndex && !slider.data('animating')) {
                            currentPagIndex = itemIndex;
                            changeSlideTo(slider, itemIndex);
                            content.removeClass('qodef-active');
                            thisContent.addClass('qodef-active');
                        }
                    });              
                }
    
                //initialize
                imagesSlider.data('autoplay');
                contentHolder.find('.qodef-vc-item-content').first().addClass('qodef-active');

				imagesSlider.appear(function() {
                    imagesSlider.waitForImages(function(){
                        initialSliderSetup(imagesSlider);
                        autoplaySlides(imagesSlider);
                        navigateSlides(imagesSlider);
                    });
				}, {accX: 0, accY: 0});                
            });
        }
    }
})(jQuery);

(function($) {
    'use strict';

    var propertyList = {};
    qodef.modules.propertyList = propertyList;

    propertyList.qodefOnDocumentReady = qodefOnDocumentReady;
    propertyList.qodefOnWindowLoad = qodefOnWindowLoad;
    propertyList.qodefOnWindowResize = qodefOnWindowResize;
    propertyList.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
	$(window).on('load',qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {

    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitPropertyMasonry();
        qodefInitPropertyFilter();
        qodefInitPropertyListAnimation();
	    qodefInitPropertyPagination().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {
        qodefInitPropertyMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    qodefInitPropertyPagination().scroll();
    }

    /**
     * Initializes property list article animation
     */
    function qodefInitPropertyListAnimation(){
        var portList = $('.qodef-property-list-holder.qodef-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.qodef-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('qodef-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('qodef-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes property list
     */
    function qodefInitPropertyMasonry(){
        var portList = $('.qodef-property-list-holder.qodef-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.qodef-pl-inner'),
                    size = thisPortList.find('.qodef-pl-grid-sizer').width();
                
                qodefResizePropertyItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.qodef-pl-grid-gutter',
                        columnWidth: '.qodef-pl-grid-sizer'
                    }
                });
                
                setTimeout(function () {
	                qodef.modules.common.qodefInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Property Items
     */
    function qodefResizePropertyItems(size,container){
        if(container.hasClass('qodef-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.qodef-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.qodef-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-pl-masonry-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes property masonry filter
     */
    function qodefInitPropertyFilter(){
        var filterHolder = $('.qodef-property-list-holder .qodef-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.qodef-property-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.qodef-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('qodef-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.qodef-pl-filter:first').addClass('qodef-pl-current');
	            
	            if(thisPortListHolder.hasClass('qodef-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.qodef-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.qodef-pl-filter').removeClass('qodef-pl-current');
                    thisFilter.addClass('qodef-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                qodefInitLoadMoreItemsPropertyFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.qodef-pl-inner').isotope({ filter: filterValue });
	                    qodef.modules.common.qodefInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if property masonry filter item is empty
     */
    function qodefInitLoadMoreItemsPropertyFilter($propertyList, $filterValue, $filterClassName) {
        var thisPortList = $propertyList,
            thisPortListInner = thisPortList.find('.qodef-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'sagen_core_property_ajax_load_more'),
            loadingItem = thisPortList.find('.qodef-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
                                qodefResizePropertyItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    qodefInitPropertyListAnimation();
	                                qodef.modules.common.qodefInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                            qodefInitLoadMoreItemsPropertyFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes property pagination functions
	 */
	function qodefInitPropertyPagination(){
		var portList = $('.qodef-property-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.qodef-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.qodef-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisPortList.hasClass('qodef-pl-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.qodef-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
				thisPortList.addClass('qodef-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.qodef-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('qodef-pl-pag-standard')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisPortList.addClass('qodef-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'sagen_core_property_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('qodef-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							qodefInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
								    if(pagedLink === 1) {
                                        qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter') && pagedLink != 1) {
									qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('qodef-pl-infinite-scroll-started')) {
							thisPortList.removeClass('qodef-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.qodef-pl-load-more-holder').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.qodef-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-pl-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            qodefResizePropertyItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPropertyListAnimation();
				qodef.modules.common.qodefInitParallax();
			}, 600);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			qodefInitPropertyListAnimation();
			qodef.modules.common.qodefInitParallax();
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            qodefResizePropertyItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPropertyListAnimation();
				qodef.modules.common.qodefInitParallax();
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisPortListInner.append(responseHtml);
			qodefInitPropertyListAnimation();
			qodef.modules.common.qodefInitParallax();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

})(jQuery);
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
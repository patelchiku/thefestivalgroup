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

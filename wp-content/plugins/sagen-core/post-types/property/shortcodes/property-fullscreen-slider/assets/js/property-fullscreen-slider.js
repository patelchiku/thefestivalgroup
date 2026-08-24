(function($) {
    'use strict';

    var propertyFullScreenSlider = {};
    qodef.modules.propertyFullScreenSlider = propertyFullScreenSlider;

    propertyFullScreenSlider.qodefOnDocumentReady = qodefOnDocumentReady;
    propertyFullScreenSlider.qodefOnWindowLoad = qodefOnWindowLoad;
    propertyFullScreenSlider.qodefOnWindowResize = qodefOnWindowResize;
    propertyFullScreenSlider.qodefOnWindowScroll = qodefOnWindowScroll;

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
        qodefPropertyFullScreenSlider();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {
        
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    
    }

    var qodefPropertyFullScreenSlider = function() {
        var FullScreenSliders = $('.qodef-pl-fullscreen-slider');
        FullScreenSliders.each(function () {

            var slider = $(this).find('.qodef-outer-space');
            var slideItemsNumber = slider.children().length;
            var dataHolder = $(this);

            var header = $('.qodef-page-header');
            if(header.length){
                var newHeight = qodef.windowHeight - header.height();
                $(this).parent().height(newHeight);
            }

            var loop = true,
                autoplay = false,
                sliderSpeed = 5000,
                numberOfItems = 3,
                margin= 0,
                pagination= false,
                navigation = false;

            if( dataHolder.data('enable-autoplay') === 'yes' ){
                autoplay = true;
            }

            if( dataHolder.data('enable-navigation') === 'yes' ){
                navigation = true;
            }

            if (typeof dataHolder.data('number-of-columns') !== 'undefined' && dataHolder.data('number-of-columns') !== false) {
                numberOfItems = dataHolder.data('number-of-columns');
            }

            if (dataHolder.data('enable-loop') === 'no') {
                loop = false;
            }

            if (typeof dataHolder.data('slider-speed') !== 'undefined' && dataHolder.data('slider-speed') !== false) {
                sliderSpeed = dataHolder.data('slider-speed');
            }

            if (slideItemsNumber <= 1) {
                loop       = false;
                autoplay   = false;
                navigation = false;
                pagination = false;
            }

            var responsiveNumberOfItems1 = 1,
                responsiveNumberOfItems2 = 2,
                responsiveNumberOfItems3 = 3,
                responsiveNumberOfItems4 = numberOfItems;

            if (numberOfItems < 3) {
                responsiveNumberOfItems2 = numberOfItems;
                responsiveNumberOfItems3 = numberOfItems;
            }

            if (numberOfItems > 4) {
                responsiveNumberOfItems4 = 4;
            }

            slider.owlCarousel({
                items: numberOfItems,
                loop: loop,
                autoplay: autoplay,
                autoplayHoverPause: false,
                autoplayTimeout: sliderSpeed,
                smartSpeed: 500,
                margin: margin,
                autoWidth: false,
                animateIn: false,
                animateOut: false,
                dots: false,
                nav: navigation,
                navText: [$('.qodef-pfs-custom-nav-prev'),$('.qodef-pfs-custom-nav-next')],
                responsive: {
                    0: {
                        items: responsiveNumberOfItems1,
                        stagePadding: 0,
                        center: false,
                        autoWidth: false
                    },
                    681: {
                        items: responsiveNumberOfItems2,
                    },
                    769: {
                        items: responsiveNumberOfItems3,
                    },
                    1025: {
                        items: responsiveNumberOfItems4
                    },
                    1281: {
                        items: numberOfItems
                    }
                },
                onInitialize: function () {
                    slider.css('visibility', 'visible');
                    // qodefInitParallax();
                },
                onDrag: function (e) {
                    if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout')) {
                        var sliderIsMoving = e.isTrigger > 0;

                        if (sliderIsMoving) {
                            slider.addClass('qodef-slider-is-moving');
                        }
                    }
                },
                onDragged: function () {
                    if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout') && slider.hasClass('qodef-slider-is-moving')) {

                        setTimeout(function () {
                            slider.removeClass('qodef-slider-is-moving');
                        }, 500);
                    }
                }
            });

            slider.on('mousewheel', '.owl-stage', function (e) {
                if (e.deltaY>0) {
                    slider.trigger('next.owl');
                } else {
                    slider.trigger('prev.owl');
                }
                e.preventDefault();
            });
        })
    };
    

})(jQuery);
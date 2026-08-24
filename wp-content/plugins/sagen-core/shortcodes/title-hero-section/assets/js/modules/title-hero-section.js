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

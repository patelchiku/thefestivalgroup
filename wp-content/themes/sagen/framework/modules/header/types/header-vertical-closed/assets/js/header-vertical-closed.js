(function($) {
    "use strict";

    var headerVerticalClosed = {};
    qodef.modules.headerVerticalClosed = headerVerticalClosed;
	
	headerVerticalClosed.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefVerticalClosedMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalClosedMenu = function() {
	    var verticalMenuObject = $('.qodef-header-vertical-closed .qodef-vertical-menu-area');

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.qodef-vertical-area-bottom-logo'),
                verticalMenuOpener = verticalMenuObject.find('.qodef-vertical-area-opener'),
                verticalMenuOverlay = $('.qodef-vertical-menu-area-overlay'),
                scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                $('body').removeClass('qodef-vertical-menu-opened');
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                $('body').addClass('qodef-vertical-menu-opened');
                verticalMenuObject.addClass('active');

                verticalMenuOverlay.one('click', function() {
                    closeVerticalArea();
                });

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initHiddenVerticalArea();
                }
            }
        };
    };

})(jQuery);
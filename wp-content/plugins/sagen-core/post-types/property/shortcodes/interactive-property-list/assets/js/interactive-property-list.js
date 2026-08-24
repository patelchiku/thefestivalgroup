(function($) {
    'use strict';

    var interactivePropertyList = {};
    qodef.modules.interactivePropertyList = interactivePropertyList;

    interactivePropertyList.qodefOnDocumentReady = qodefOnDocumentReady;
    interactivePropertyList.qodefOnWindowLoad = qodefOnWindowLoad;
    interactivePropertyList.qodefOnWindowResize = qodefOnWindowResize;
    interactivePropertyList.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load',qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefPropertyFilter();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
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

    function qodefPropertyFilter() {
        var filterOpener = $('a.qodef-property-filter-opener');

        if (filterOpener.length > 0) {

            var filterClose = $('.qodef-property-filter-close'),
                filterHolder = $('.qodef-property-filter-holder-inner'),
                linkHolder = filterHolder.find('.qodef-ips-content-table-cell');

            //Init scroll on items holder
            filterHolder.height(qodef.windowHeight);
            filterHolder.perfectScrollbar({
                wheelPropagation: false,
                minScrollbarLength: 20,
                suppressScrollX: true
            });

            var menuLinkHeight,
                scrollLink,
                wheelAnim,
                goingToScrollTop = filterHolder.scrollTop(),
                items = filterHolder.find('.qodef-ips-item-content');

            //Calculate height of menu items
            menuLinkHeight = Math.floor(filterHolder.innerHeight() * 0.1);
            items.each(function(){
                $(this).css("height", menuLinkHeight);
            });
            scrollLink = menuLinkHeight;


            //Init font resize function based on position of item
            var menu_scrollMenu = function (event) {
                var screenCenter = filterHolder.innerHeight() * 0.5;
                for (var i = 0; i < items.length; i++) {
                    var $link = $(items[i]);
                    var $text = $link.find("a");
                    var linkCenterPosition = $link.offset().top + $link.innerHeight() * 0.5;
                    var dif = Math.abs(linkCenterPosition - screenCenter);
                    var currentFontSize = filterHolder.innerWidth() * 0.026;
                    // var newFontSize = currentFontSize - dif * 0.1;
                    // if (newFontSize < 50)
                    //     newFontSize = 40;
                    TweenMax.to($text, 0, {
                        "font-size": currentFontSize + "px"
                    });
                }
            };

            menu_scrollMenu();

            //Init recalculation on mouse wheel scroll
            var menu_softScrollWheel = function(event, delta, deltaX, deltaY) {
                event.preventDefault();
                event.stopPropagation();
                if (deltaY < 0) {
                    if(filterHolder.scrollTop() + filterHolder.outerHeight() < linkHolder.outerHeight() ) {
                        goingToScrollTop += scrollLink;
                        wheelAnim = TweenMax.to(filterHolder, 0.5, {
                            scrollTop: goingToScrollTop,
                            ease: Power1.easeOut,
                            onUpdate: function () {
                                wheelAnim.pause();
                                menu_scrollMenu();
                                wheelAnim.resume();
                            }
                        });
                    }
                } else if (deltaY > 0) {
                    if (filterHolder.scrollTop() > 0) {
                        goingToScrollTop -= scrollLink;
                        wheelAnim = TweenMax.to(filterHolder, 0.5, {
                            scrollTop: goingToScrollTop,
                            ease: Power1.easeOut,
                            onUpdate: function () {
                                wheelAnim.pause();
                                menu_scrollMenu();
                                wheelAnim.resume();
                            }
                        });
                    }
                }
                return false;
            };

            filterHolder.mousewheel(menu_softScrollWheel);

            filterOpener.on('click', function (e) {
                e.preventDefault();

                if (filterHolder.hasClass('qodef-animate')) {
                    qodef.body.removeClass('qodef-fullscreen-filter-opened qodef-filter-fade-out');
                    qodef.body.removeClass('qodef-filter-fade-in');
                    filterHolder.removeClass('qodef-animate');
                    qodef.modules.common.qodefEnableScroll();

                } else {
                    qodef.body.addClass('qodef-fullscreen-filter-opened qodef-filter-fade-in');
                    qodef.body.removeClass('qodef-filter-fade-out');
                    filterHolder.addClass('qodef-animate');
                    qodef.modules.common.qodefDisableScroll();
                }

                filterClose.on('click', function (e) {
                    e.preventDefault();
                    qodef.body.removeClass('qodef-fullscreen-filter-opened qodef-filter-fade-in');
                    qodef.body.addClass('qodef-filter-fade-out');
                    filterHolder.removeClass('qodef-animate');

                    setTimeout(function () {
                        filterHolder.find('.qodef-filter-field').val('');
                        filterHolder.find('.qodef-filter-field').blur();
                    }, 300);

                    qodef.modules.common.qodefEnableScroll();
                });

                //Close on escape
                $(document).keyup(function (e) {
                    if (e.keyCode === 27) { //KeyCode for ESC button is 27
                        qodef.body.removeClass('qodef-fullscreen-filter-opened qodef-filter-fade-in');
                        qodef.body.addClass('qodef-filter-fade-out');
                        filterHolder.removeClass('qodef-animate');
                    }
                });
            });
        }

    }

})(jQuery);
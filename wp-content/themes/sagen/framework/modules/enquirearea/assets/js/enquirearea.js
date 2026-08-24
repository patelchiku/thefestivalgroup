(function($) {
    "use strict";

    var enquirearea = {};
    qodef.modules.enquirearea = enquirearea;

    enquirearea.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefEnquireArea();
    }
	
	/**
	 * Show/hide enquire area
	 */
    function qodefEnquireArea() {
		var wrapper = $('.qodef-wrapper'),
			enquireMenu = $('.qodef-enquire-menu'),
			enquireMenuButtonOpen = $('a.qodef-enquire-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (qodef.body.hasClass('qodef-enquire-menu-slide-from-right')) {
			$('.qodef-cover').remove();
			cssClass = 'qodef-right-enquire-menu-opened';
			wrapper.prepend('<div class="qodef-cover"/>');
			slideFromRight = true;
		} else if (qodef.body.hasClass('qodef-enquire-menu-slide-with-content')) {
			cssClass = 'qodef-enquire-menu-open';
			slideWithContent = true;
		} else if (qodef.body.hasClass('qodef-enquire-area-uncovered-from-content')) {
			cssClass = 'qodef-right-enquire-menu-opened';
			slideUncovered = true;
		}
		
		$('a.qodef-enquire-menu-button-opener, a.qodef-close-enquire-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!enquireMenuButtonOpen.hasClass('opened')) {
		        enquireMenuButtonOpen.addClass('opened');
		        qodef.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.qodef-wrapper .qodef-cover').on('click', function () {
				        qodef.body.removeClass('qodef-right-enquire-menu-opened');
				        enquireMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        enquireMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(qodef.scroll - currentScroll) > 400) {
				        qodef.body.removeClass(cssClass);
				        enquireMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideEnquireMenu = setTimeout(function () {
						        enquireMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideEnquireMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            enquireMenuButtonOpen.removeClass('opened');
	            qodef.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideEnquireMenu = setTimeout(function () {
			            enquireMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideEnquireMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        enquireMenuButtonOpen.removeClass('opened');
			        qodef.body.removeClass('qodef-enquire-menu-open');
		        });
	        }
        });

        if(enquireMenu.length){
            qodef.modules.common.qodefInitPerfectScrollbar().init(enquireMenu);
        }
    }

})(jQuery);

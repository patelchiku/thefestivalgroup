(function($) {
    "use strict";

    var headerDivided = {};
    qodef.modules.headerDivided = headerDivided;
	
	headerDivided.qodefOnDocumentReady = qodefOnDocumentReady;
	headerDivided.qodefOnWindowResize = qodefOnWindowResize;

    $(document).ready(qodefOnDocumentReady);
    $(window).resize(qodefOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitDividedHeaderMenu();
    }

    /**
     * Init Divided Header Menu
     */
    function qodefInitDividedHeaderMenu(){
        if(qodef.body.hasClass('qodef-header-divided')){
	        //get left side menu width
	        var menuArea = $('.qodef-menu-area, .qodef-sticky-header'),
		        menuAreaWidth = menuArea.width(),
		        menuAreaSidePadding = parseInt(menuArea.find('.qodef-vertical-align-containers').css('paddingLeft'), 10),
		        menuAreaItem = $('.qodef-main-menu > ul > li > a'),
		        menuItemPadding = 0,
		        logoArea = menuArea.find('.qodef-logo-wrapper .qodef-normal-logo'),
		        logoAreaWidth = 0;
	
	        menuArea.waitForImages(function() {
	        	
		        if(menuArea.find('.qodef-grid').length) {
			        menuAreaWidth = menuArea.find('.qodef-grid').outerWidth();
		        }
		
		        if(menuAreaItem.length) {
			        menuItemPadding = parseInt(menuAreaItem.css('paddingLeft'), 10);
		        }
		
		        if(logoArea.length) {
			        logoAreaWidth = logoArea.width() / 2;
		        }
		
		        var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth - menuAreaSidePadding);
		
		        menuArea.find('.qodef-position-left').width(menuAreaLeftRightSideWidth);
		        menuArea.find('.qodef-position-right').width(menuAreaLeftRightSideWidth);
		
		        menuArea.css('opacity',1);
		
		        if (typeof qodef.modules.header.qodefSetDropDownMenuPosition === "function") {
			        qodef.modules.header.qodefSetDropDownMenuPosition();
		        }
		        if (typeof qodef.modules.header.qodefSetDropDownWideMenuPosition === "function") {
			        qodef.modules.header.qodefSetDropDownWideMenuPosition();
		        }
	        });
        }
    }

})(jQuery);
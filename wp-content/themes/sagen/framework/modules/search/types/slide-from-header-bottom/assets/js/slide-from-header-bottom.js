(function($) {
	"use strict";
	
	var searchSlideFromHB = {};
	qodef.modules.searchSlideFromHB = searchSlideFromHB;
	
	searchSlideFromHB.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function qodefOnDocumentReady() {
		qodefSearchSlideFromHB();
	}
	
	/**
	 * Init Search Types
	 */
	function qodefSearchSlideFromHB() {
		if ( qodef.body.hasClass( 'qodef-slide-from-header-bottom' ) ) {
			var searchOpener = $('a.qodef-search-opener');
			
			if (searchOpener.length) {
				searchOpener.each(function(){
					//Check for type of search
					$(this).on('click', function (e) {
						e.preventDefault();
						
						var thisSearchOpener = $(this),
							searchIconPosition = parseInt(qodef.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());
						
						if (qodef.body.hasClass('qodef-boxed') && qodef.windowWidth > 1024) {
							searchIconPosition -= parseInt((qodef.windowWidth - $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth()) / 2);
						}
						
						var searchFormHeaderHolder = $('.qodef-page-header'),
							searchFormTopOffset = '100%',
							searchFormTopHeaderHolder = $('.qodef-top-bar'),
							searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.qodef-fixed-wrapper.fixed'),
							searchFormMobileHeaderHolder = $('.qodef-mobile-header'),
							searchForm = searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder'),
							searchFormIsInTopHeader = !!thisSearchOpener.parents('.qodef-top-bar').length,
							searchFormIsInFixedHeader = !!thisSearchOpener.parents('.qodef-fixed-wrapper.fixed').length,
							searchFormIsInStickyHeader = !!thisSearchOpener.parents('.qodef-sticky-header').length,
							searchFormIsInMobileHeader = !!thisSearchOpener.parents('.qodef-mobile-header').length;
						
						searchForm.removeClass('qodef-is-active');

						//close on click
						$('.qodef-search-close').on('click', function (e) {
							searchForm.stop(true).fadeOut(0);
							qodef.body.removeClass('qodef-search-opened');
						});
						
						//Find search form position in header and height
						if (searchFormIsInTopHeader) {
							searchForm = searchFormTopHeaderHolder.find('.qodef-slide-from-header-bottom-holder');
							searchForm.addClass('qodef-is-active');
							
						} else if (searchFormIsInFixedHeader) {
							searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
							searchForm.addClass('qodef-is-active');
							
						} else if (searchFormIsInStickyHeader) {
							searchFormTopOffset = qodefGlobalVars.vars.qodefStickyHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
							searchForm.addClass('qodef-is-active');
							
						} else if (searchFormIsInMobileHeader) {
							if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
								searchFormTopOffset = searchFormMobileHeaderHolder.children('.qodef-mobile-header-inner').outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
							}
							
							searchForm = searchFormMobileHeaderHolder.find('.qodef-slide-from-header-bottom-holder');
							searchForm.addClass('qodef-is-active');
							
						} else {
							searchForm.addClass('qodef-is-active');
						}

						qodef.body.toggleClass('qodef-search-opened');

						if (searchForm.hasClass('qodef-is-active')) {
							searchForm.css({
								'right': 0,
								'top': searchFormTopOffset
							}).stop(true).slideToggle(300, 'easeOutBack');
						}
						
						//Close on escape
						$(document).keyup(function (e) {
							if (e.keyCode === 27) { //KeyCode for ESC button is 27
								searchForm.stop(true).fadeOut(0);
							}
							qodef.body.removeClass('qodef-search-opened');
						});
						
						$(window).scroll(function () {
							searchForm.stop(true).fadeOut(0);
							qodef.body.removeClass('qodef-search-opened');
						});
					});
				});
			}
		}
	}
	
})(jQuery);
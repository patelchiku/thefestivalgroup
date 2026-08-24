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




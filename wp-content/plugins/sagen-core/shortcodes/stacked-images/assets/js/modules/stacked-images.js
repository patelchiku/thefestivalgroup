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
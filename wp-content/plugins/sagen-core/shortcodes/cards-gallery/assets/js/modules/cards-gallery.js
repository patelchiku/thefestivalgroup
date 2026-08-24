(function ($) {
	'use strict';

	var cardsGallery           = {};
	qodef.modules.cardsGallery = cardsGallery;

	cardsGallery.qodefOnWindowLoad = qodefOnWindowLoad;

	$( window ).on(
		'load',
		function(){
			qodefOnWindowLoad();
		}
	);

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitCardsGallery();
	}

	/*
	 **	Init cards gallery shortcode
	 */
	function qodefInitCardsGallery() {
		var holder = $( '.qodef-cards-gallery' );

		if (holder.length) {
			holder.each(
				function () {
					var thisHolder = $( this ),
					cards          = thisHolder.find( '.qodef-cg-card' );

					cards.each(
						function () {
							var card = $( this );

							card.on(
								'click',
								function () {
									if ( ! cards.last().is( card )) {
										card.addClass( 'qodef-out qodef-animating' ).siblings().addClass( 'qodef-animating-siblings' );
										card.detach();
										card.insertAfter( cards.last() );

										setTimeout(
											function () {
												card.removeClass( 'qodef-out' );
											},
											200
										);

										setTimeout(
											function () {
												card.removeClass( 'qodef-animating' ).siblings().removeClass( 'qodef-animating-siblings' );
											},
											1200
										);

										cards = thisHolder.find( '.qodef-cg-card' );

										return false;
									}
								}
							);
						}
					);

					if (thisHolder.hasClass( 'qodef-bundle-animation' ) && ! qodef.htmlEl.hasClass( 'touch' )) {
						thisHolder.appear(
							function () {
								thisHolder.addClass( 'qodef-appeared' );
								thisHolder.find( 'img' ).one(
									'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd',
									function () {
										$( this ).addClass( 'qodef-animation-done' );
									}
								);
							},
							{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount}
						);
					}
				}
			);
		}
	}

})( jQuery );

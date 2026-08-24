(function ($) {
    "use strict";

    var dashboard = {};

    $(document).ready(qodefOnDocumentReady);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefDashboardInitDatePicker();
        qodefDashboardUploadImages();
        qodefDashboardInitGeocomplete();
        qodefDashboardRemoveMedia();
        qodefDashboardSelect2();
        qodefInitColorpicker();
        qodefInitIconSelectChange();
 	    qodefDashboardRepeater.rowRepeater.init();
 	    qodefDashboardRepeater.rowInnerRepeater.init();
	    qodefDashboardInitSortable();
    }

	function qodefDashboardInitDatePicker() {
		var holder = $(".qodef-dashboard-input.datepicker");
		if (holder.length) {
			holder.datepicker({ dateFormat: "yy-mm-dd"});
		}
	}

	function qodefInitColorpicker() {
		var holder = $('.qodef-dashboard-color-field');
		if (holder.length) {
			holder.wpColorPicker();
		}
	}

    function qodefInitIconSelectChange() {
        $(document).on('change', 'select.icon-dependence', function (e) {
            var valueSelected = this.value.replace(/ /g, ''),
            	parentSection = $(this).parents('.qodef-dashboard-icon-holder');

            parentSection.find('.qodef-icon-collection-holder').fadeOut();
            parentSection.find('.qodef-icon-collection-holder[data-icon-collection="' + valueSelected + '"]').fadeIn();
        });
    }

	var qodefDashboardRepeater = function() {
		var repeaterHolder = $('.qodef-dashboard-repeater-wrapper'),
			numberOfRows;

		var rowRepeater = function() {
			var addNewRow = function(holder) {
				var $addButton = holder.find('.qodef-dashboard-repeater-add a');
				var templateName = holder.find('.qodef-dashboard-repeater-wrapper-inner').data('template');
				var $repeaterContent = holder.find('.qodef-dashboard-repeater-wrapper-inner');
				var repeaterTemplate = wp.template('qodef-dashboard-repeater-template-' + templateName);

				$addButton.on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					var $row = $(repeaterTemplate({
						rowIndex: getLastRowIndex(holder) || 0
					}));

					$repeaterContent.append($row);
					var new_holder = $row.find('.qodef-dashboard-repeater-inner-wrapper');
					qodefDashboardRepeater.rowInnerRepeater.addNewRowInner(new_holder);
					qodefDashboardRepeater.rowInnerRepeater.removeRowInner(new_holder);
					qodefDashboardInitSortable();
					qodefDashboardInitDatePicker();
					qodefDashboardUploadImages();
					qodefDashboardRemoveMedia();
					qodefDashboardSelect2();
					qodefInitColorpicker();
					qodefInitIconSelectChange();
					numberOfRows += 1;
				});
			};

			var removeRow = function(holder) {
				var repeaterContent = holder.find('.qodef-dashboard-repeater-wrapper-inner');
				
				repeaterContent.on('click', '.qodef-clone-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!window.confirm('Are you sure you want to remove this section?')) {
						return;
					}

					var $rowParent = $(this).parents('.qodef-dashboard-repeater-fields-holder');
					$rowParent.remove();

					decrementNumberOfRows();
				});
			};

			var getLastRowIndex = function(holder) {
				var $repeaterContent = holder.find('.qodef-dashboard-repeater-wrapper-inner');
				var fieldsCount = $repeaterContent.find('.qodef-dashboard-repeater-fields-holder').length;

				return fieldsCount;
			};

			var decrementNumberOfRows = function() {
				if(numberOfRows <= 0) {
					return;
				}

				numberOfRows -= 1;
			};
			
			var setNumberOfRows = function(holder) {
				numberOfRows =  holder.find('.qodef-dashboard-repeater-fields-holder').length;
			};
			
			var getNumberOfRows = function() {
				return numberOfRows;
			};

			return {
				init: function() {
					var repeaterHolder = $('.qodef-dashboard-repeater-wrapper');

					repeaterHolder.each(function(){
						setNumberOfRows($(this));
						addNewRow($(this));
						removeRow($(this));
					});
				},
				numberOfRows: getNumberOfRows
			}
		}();

		var rowInnerRepeater = function() {
			var repeaterInnerHolder = $('.qodef-dashboard-repeater-inner-wrapper');
			
			var addNewRowInner = function(holder) {
				//var repeaterInnerContent = holder.find('.qodef-dashboard-repeater-inner-wrapper-inner');
				var templateInnerName = holder.find('.qodef-dashboard-repeater-inner-wrapper-inner').data('template');
				var rowInnerTemplate = wp.template('qodef-dashboard-repeater-inner-template-' + templateInnerName);
				
				holder.on('click', '.qodef-inner-clone', function(e) {
					e.preventDefault();
					e.stopPropagation();

					var $clickedButton = $(this);
					var $parentRow = $clickedButton.parents('.qodef-dashboard-repeater-fields-holder').first();

					var parentIndex = $parentRow.data('index');

					var $rowInnerContent = $clickedButton.parent().prev();

					var lastRowInnerIndex = $parentRow.find('.qodef-dashboard-repeater-inner-fields-holder').length;

					var $repeaterInnerRow = $(rowInnerTemplate({
						rowIndex: parentIndex,
						rowInnerIndex: lastRowInnerIndex
					}));

					$rowInnerContent.append($repeaterInnerRow);
					qodefTinyMCE($repeaterInnerRow, lastRowInnerIndex);
				});
			};

			var removeRowInner = function(holder) {
				var repeaterInnerContent = holder.find('.qodef-dashboard-repeater-inner-wrapper-inner');
				repeaterInnerContent.on('click', '.qodef-clone-inner-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!confirm('Are you sure you want to remove section?')) {
						return;
					}

					var $removeButton = $(this);
					var $parent = $removeButton.parents('.qodef-dashboard-repeater-inner-fields-holder');

					$parent.remove();
				});
			};

			return {
				init: function() {
					var repeaterInnerHolder = $('.qodef-dashboard-repeater-inner-wrapper');
					repeaterInnerHolder.each(function(){
						addNewRowInner($(this));
						removeRowInner($(this));
					});

				},
				addNewRowInner:addNewRowInner,
				removeRowInner:removeRowInner
			}
		}();

		return {
			rowRepeater: rowRepeater,
			rowInnerRepeater: rowInnerRepeater
		}
	}();

	function qodefDashboardInitSortable() {
		var holder = $('.qodef-dashboard-repeater-wrapper-inner.sortable');
		if (holder.length) {
			holder.sortable();
		}
		var holder = $('.qodef-dashboard-repeater-inner-wrapper-inner.sortable');
		if (holder.length) {
			holder.sortable();
		}
	}
	
	function qodefDashboardInitGeocomplete() {
		var geo_inputs = $(".qodef-dashboard-address-field");
		
		if (geo_inputs.length && !qodef.body.hasClass('qodef-empty-google-api')) {
			geo_inputs.each(function () {
				var geo_input = $(this),
					reset = geo_input.find(".qodef-reset-marker"),
					inputField = geo_input.find('input'),
					mapField = geo_input.find('.map_canvas'),
					countryLimit = geo_input.data('country'),
					latFieldName = geo_input.data('lat-field'),
					latField = $("input[name=" + latFieldName + "]"),
					longFieldName = geo_input.data('long-field'),
					longField = $("input[name=" + longFieldName + "]"),
					initialAddress = inputField.val(),
					initialLat = latField.val(),
					initialLong = longField.val();
				
				latField.attr('data-geo', 'lat');
				longField.attr('data-geo', 'lng');
				
				if (typeof inputField.geocomplete === 'function') {
					inputField.geocomplete({
						map: mapField,
						details: ".qodef-dashboard-address-elements",
						detailsAttribute: "data-geo",
						types: ["geocode", "establishment"],
						country: countryLimit,
						markerOptions: {
							draggable: true
						}
					}).bind('geocode:result', function (event, result) {
						reset.show();
					});
					
					inputField.on('geocode:dragged', function (event, latLng) {
						latField.val(latLng.lat());
						longField.val(latLng.lng());
						reset.show();
						var map = inputField.geocomplete("map");
						map.panTo(latLng);
						var geocoder = new google.maps.Geocoder();
						
						geocoder.geocode({'latLng': latLng}, function (results, status) {
							if (status === google.maps.GeocoderStatus.OK && typeof results[0] === 'object') {
								inputField.val(results[0].formatted_address);
							}
						});
					});
					
					inputField.on('focus', function () {
						var map = inputField.geocomplete("map");
						google.maps.event.trigger(map, 'resize')
					});
					
					reset.on("click", function () {
						inputField.geocomplete("resetMarker");
						inputField.val(initialAddress);
						latField.val(initialLat);
						longField.val(initialLong);
						reset.hide();
						return false;
					});
					
					$(window).on("load", function () {
						inputField.trigger("geocode");
					});
				}
			});
		}
	}
	
	function qodefDashboardUploadImages() {
		var galleries = $('.qodef-dashboard-gallery-uploader');
		
		if (galleries.length) {
			galleries.each(function () {
				var thisGallery = $(this),
					inputButton = thisGallery.find('.qodef-dashboard-gallery-upload-hidden'),
					uploadButton = thisGallery.find('.qodef-dashboard-gallery-upload'),
					thisGalleryImageHolder = thisGallery.parents('.qodef-dashboard-gallery-holder').find('.qodef-dashboard-gallery-images-holder');
				
				if (!uploadButton.hasClass('qodef-binded')) {
					inputButton.on('change', function (e) {
						thisGalleryImageHolder.empty();
						
						for (var i = 0, file; file = e.target.files[i]; i++) {
							var reader = new FileReader();
							
							// Closure to capture the file information.
							reader.onload = (function (theFile) {
								return function (e) {
									if ($.inArray(theFile.type, ["image/gif", "image/jpeg", "image/png"]) > -1) {
										thisGalleryImageHolder.append('<li class="qodef-dashboard-gallery-image"><img src="' + e.target.result + '" title="' + escape(theFile.name) + '"/></li>');
									} else {
										thisGalleryImageHolder.append('<li class="qodef-dashboard-gallery-image"><span class="qodef-dashboard-input-text">' + escape(theFile.name) + '</span></li>');
									}
								};
							})(file);
							
							// Read in the image file as a data URL.
							reader.readAsDataURL(file);
						}
					});
					
					uploadButton.addClass('qodef-binded').on('click', function (e) {
						e.preventDefault();
						
						inputButton.trigger('click');
					});
				}
			});
		}
	}
	
	function qodefDashboardRemoveMedia() {
		var removeMediaBttns = $('.qodef-dashboard-remove-image');
		
		if (removeMediaBttns.length) {
			removeMediaBttns.each(function () {
				var thisRemoveMedia = $(this),
					removeImagesHolder = thisRemoveMedia.parents('.qodef-dashboard-gallery-holder').find('.qodef-dashboard-gallery-images-holder'),
					inputHiddenValue = thisRemoveMedia.siblings('.qodef-dashboard-media-hidden');
				
				if (!thisRemoveMedia.hasClass('qodef-binded')) {
					thisRemoveMedia.addClass('qodef-binded').on('click', function (e) {
						e.preventDefault();
						
						inputHiddenValue.val('');
						
						removeImagesHolder.empty();
					});
				}
			});
		}
	}
	
	function qodefDashboardSelect2() {
		var select2 = $('select.qodef-select2');
		
		if (select2.length) {
			select2.each(function () {
				var holder = $(this);
				if (holder.length) {
					holder.select2({
					allowClear: true
				});
				}
			});
		}
	}

})(jQuery);
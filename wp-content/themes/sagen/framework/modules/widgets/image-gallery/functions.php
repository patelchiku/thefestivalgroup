<?php

if ( ! function_exists( 'sagen_select_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function sagen_select_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_image_gallery_widget' );
}
<?php

if ( ! function_exists( 'sagen_select_register_enquirearea_opener_widget' ) ) {
	/**
	 * Function that register enquirearea opener widget
	 */
	function sagen_select_register_enquirearea_opener_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassEnquireAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_enquirearea_opener_widget' );
}
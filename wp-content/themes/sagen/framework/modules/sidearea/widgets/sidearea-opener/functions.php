<?php

if ( ! function_exists( 'sagen_select_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function sagen_select_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_sidearea_opener_widget' );
}
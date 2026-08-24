<?php

if ( ! function_exists( 'sagen_select_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function sagen_select_register_search_opener_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_search_opener_widget' );
}
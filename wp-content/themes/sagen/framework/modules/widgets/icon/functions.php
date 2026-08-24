<?php

if ( ! function_exists( 'sagen_select_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function sagen_select_register_icon_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_icon_widget' );
}
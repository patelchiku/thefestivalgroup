<?php

if ( ! function_exists( 'sagen_select_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function sagen_select_register_button_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_button_widget' );
}
<?php

if ( ! function_exists( 'sagen_select_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function sagen_select_register_custom_font_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_custom_font_widget' );
}
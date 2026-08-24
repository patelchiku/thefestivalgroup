<?php

if ( ! function_exists( 'sagen_select_register_social_text_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function sagen_select_register_social_text_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassClassTextGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_social_text_widget' );
}
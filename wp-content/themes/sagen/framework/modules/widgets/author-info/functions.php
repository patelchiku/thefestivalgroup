<?php

if ( ! function_exists( 'sagen_select_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function sagen_select_register_author_info_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_author_info_widget' );
}
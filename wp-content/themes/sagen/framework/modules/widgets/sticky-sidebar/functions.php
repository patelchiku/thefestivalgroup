<?php

if ( ! function_exists( 'sagen_select_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function sagen_select_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_sticky_sidebar_widget' );
}
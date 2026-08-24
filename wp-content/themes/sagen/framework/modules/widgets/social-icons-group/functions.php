<?php

if ( ! function_exists( 'sagen_select_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function sagen_select_register_social_icons_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_social_icons_widget' );
}
<?php

if ( ! function_exists( 'sagen_select_disable_behaviors_for_header_vertical_closed' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function sagen_select_disable_behaviors_for_header_vertical_closed( $allow_behavior ) {
		return false;
	}
	
	if ( sagen_select_check_is_header_type_enabled( 'header-vertical-closed', sagen_select_get_page_id() ) ) {
		add_filter( 'sagen_select_filter_allow_sticky_header_behavior', 'sagen_select_disable_behaviors_for_header_vertical_closed' );
		add_filter( 'sagen_select_filter_allow_content_boxed_layout', 'sagen_select_disable_behaviors_for_header_vertical_closed' );
	}
}
<?php

if ( ! function_exists( 'sagen_select_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function sagen_select_register_separator_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassSeparatorWidget';

		return $widgets;
	}

	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_separator_widget' );
}

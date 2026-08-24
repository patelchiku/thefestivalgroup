<?php

if ( sagen_select_is_plugin_installed( 'contact-form-7' ) ) {
	include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_cf7_widget' );
}

if ( ! function_exists( 'sagen_select_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function sagen_select_register_cf7_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassContactForm7Widget';
		
		return $widgets;
	}
}
<?php

if ( ! function_exists( 'sagen_core_enqueue_scripts_for_interactive_property_list_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function sagen_core_enqueue_scripts_for_interactive_property_list_shortcodes() {
		wp_enqueue_script( 'tweenMax', SAGEN_CORE_CPT_URL_PATH . '/property/shortcodes/interactive-property-list/assets/js/plugins/TweenMax.min.js', array( 'jquery' ), false, true );
	}

	add_action( 'sagen_select_enqueue_third_party_scripts', 'sagen_core_enqueue_scripts_for_interactive_property_list_shortcodes' );
}

if ( ! function_exists( 'sagen_core_add_interactive_property_list_shortcode' ) ) {
	function sagen_core_add_interactive_property_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'SagenCore\CPT\Shortcodes\Property\InteractivePropertyList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcode', 'sagen_core_add_interactive_property_list_shortcode' );
}

if ( ! function_exists( 'sagen_core_set_interactive_property_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for property slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function sagen_core_set_interactive_property_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-interactive-property-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcodes_custom_icon_class', 'sagen_core_set_interactive_property_list_icon_class_name_for_vc_shortcodes' );
}
<?php

if ( ! function_exists( 'sagen_core_add_numbered_section_shortcodes' ) ) {
	function sagen_core_add_numbered_section_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'SagenCore\CPT\Shortcodes\NumberedSection\NumberedSection'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcode', 'sagen_core_add_numbered_section_shortcodes' );
}

if ( ! function_exists( 'sagen_core_set_numbered_section_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for section title shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function sagen_core_set_numbered_section_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-numbered-section';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcodes_custom_icon_class', 'sagen_core_set_numbered_section_icon_class_name_for_vc_shortcodes' );
}
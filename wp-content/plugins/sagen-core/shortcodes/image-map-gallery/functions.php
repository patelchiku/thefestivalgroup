<?php

if ( ! function_exists( 'sagen_core_add_image_map_gallery_scripts' ) ) {
    function sagen_core_add_image_map_gallery_scripts() {

        wp_enqueue_script( 'sagen-core-imp-script', SAGEN_CORE_SHORTCODES_URL_PATH . '/image-map-gallery/assets/exclude_js/image-map-gallery.js', array( 'jquery' ), false, true );

    }

    add_action( 'wp_footer', 'sagen_core_add_image_map_gallery_scripts', 15 );
}

if ( ! function_exists( 'sagen_core_add_image_map_gallery_shortcodes' ) ) {
	function sagen_core_add_image_map_gallery_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'SagenCore\CPT\Shortcodes\ImageMapGallery\ImageMapGallery'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcode', 'sagen_core_add_image_map_gallery_shortcodes' );
}

if ( ! function_exists( 'sagen_core_set_image_map_gallery_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image gallery shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function sagen_core_set_image_map_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-map-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'sagen_core_filter_add_vc_shortcodes_custom_icon_class', 'sagen_core_set_image_map_gallery_icon_class_name_for_vc_shortcodes' );
}
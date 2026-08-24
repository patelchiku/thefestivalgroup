<?php

if ( ! function_exists( 'sagen_select_get_content_bottom_area' ) ) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function sagen_select_get_content_bottom_area() {
		$parameters = array();
		
		//Current page id
		$id = sagen_select_get_page_id();
		
		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = sagen_select_get_meta_field_intersect( 'enable_content_bottom_area', $id );
		
		if ( $parameters['content_bottom_area'] === 'yes' ) {
			
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = sagen_select_get_meta_field_intersect( 'content_bottom_sidebar_custom_display', $id );
			//Content bottom area in grid
			$parameters['grid_class'] = ( sagen_select_get_meta_field_intersect( 'content_bottom_in_grid', $id ) ) === 'yes' ? 'qodef-grid' : 'qodef-full-width';
			// Custom classes
			$parameters['predefined_class'] = ( sagen_select_get_meta_field_intersect( 'content_bottom_predefined', $id ) ) === 'yes' ? 'qodef-content-bottom-predefined' : '';
			$parameters['dark_text_class'] = ( sagen_select_get_meta_field_intersect( 'content_bottom_dark_text', $id ) ) === 'yes' ? 'qodef-content-bottom-dark-text' : 'qodef-content-bottom-white-text';

			$parameters['content_bottom_style'] = array();
			
			//Content bottom area background color
			$background_color = sagen_select_get_meta_field_intersect( 'content_bottom_background_color', $id );
			if ( $background_color !== '' ) {
				$parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
			}
			
			if ( is_active_sidebar( $parameters['content_bottom_area_sidebar'] ) ) {
				sagen_select_get_module_template_part( 'templates/content-bottom-area', 'content-bottom', '', $parameters );
			}
		}
	}
	
	add_action( 'sagen_select_action_before_footer_content', 'sagen_select_get_content_bottom_area' );
}
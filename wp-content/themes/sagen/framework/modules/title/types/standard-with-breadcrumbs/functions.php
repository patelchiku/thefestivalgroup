<?php

if ( ! function_exists( 'sagen_select_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function sagen_select_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'sagen' );
		
		return $type;
	}
	
	add_filter( 'sagen_select_filter_title_type_global_option', 'sagen_select_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'sagen_select_filter_title_type_meta_boxes', 'sagen_select_set_title_standard_with_breadcrumbs_type_for_options' );
}
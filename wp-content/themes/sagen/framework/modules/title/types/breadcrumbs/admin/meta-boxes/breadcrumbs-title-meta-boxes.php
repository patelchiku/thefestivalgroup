<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_breadcrumbs_title_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_breadcrumbs_title_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_breadcrumbs_title_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function sagen_select_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
	    $hide_dep_options = sagen_select_get_hide_dep_for_breadcrumbs_title_meta_boxes();
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'sagen' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'sagen' ),
				'parent'      => $show_title_area_meta_container,
                'dependency'  => array(
                    'hide' => array(
                        'qodef_title_area_type_meta' => $hide_dep_options
                    )
                )
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_title_area_meta_boxes', 'sagen_select_breadcrumbs_title_type_options_meta_boxes' );
}
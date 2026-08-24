<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_header_standard_meta_map' ) ) {
	function sagen_select_header_standard_meta_map( $parent ) {
		$hide_dep_options = sagen_select_get_hide_dep_for_header_standard_meta_boxes();
		
		sagen_select_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'sagen' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'sagen' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'sagen' ),
					'left'   => esc_html__( 'Left', 'sagen' ),
					'right'  => esc_html__( 'Right', 'sagen' ),
					'center' => esc_html__( 'Center', 'sagen' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_header_area_meta_boxes_map', 'sagen_select_header_standard_meta_map' );
}
<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_header_standard_options' ) ) {
	function sagen_select_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_header_standard_map' ) ) {
	function sagen_select_header_standard_map( $parent ) {
		$hide_dep_options = sagen_select_get_hide_dep_for_header_standard_options();
		
		sagen_select_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'sagen' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'sagen' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'sagen' ),
					'left'   => esc_html__( 'Left', 'sagen' ),
					'center' => esc_html__( 'Center', 'sagen' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_header_menu_area_options_map', 'sagen_select_header_standard_map' );
}
<?php

if ( ! function_exists( 'sagen_select_mobile_menu_meta_box_map' ) ) {
	function sagen_select_mobile_menu_meta_box_map($header_meta_box) {

		sagen_select_add_admin_section_title(
			array(
				'parent' => $header_meta_box,
				'name'   => 'header_mobile',
				'title'  => esc_html__( 'Mobile Header in Grid', 'sagen' )
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_mobile_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Mobile Header in Grid', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'sagen' ),
				'parent'        => $header_meta_box,
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);

		$mobile_header_without_grid_container = sagen_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_in_grid_meta' => 'no'
					)
				)
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_mobile_header_without_grid_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Header Padding', 'sagen' ),
				'description' => esc_html__( 'Set padding for Mobile Header', 'sagen' ),
				'parent'      => $mobile_header_without_grid_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);


	}
	
	add_action( 'sagen_select_action_header_mobile_menu_meta_boxes_map', 'sagen_select_mobile_menu_meta_box_map', 10 );
}
<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_header_vertical_area_meta_options_map' ) ) {
	function sagen_select_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = sagen_select_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = sagen_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		sagen_select_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'sagen' )
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'sagen' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'sagen' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'sagen' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'sagen' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'sagen' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'sagen' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'sagen' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'sagen' ),
				'description'   => esc_html__( 'Set border on vertical area', 'sagen' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = sagen_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'qodef_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'sagen' ),
				'description' => esc_html__( 'Choose color of border', 'sagen' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'sagen' ),
				'description'   => esc_html__( 'Set content in vertical center', 'sagen' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_header_area_meta_boxes_map', 'sagen_select_header_vertical_area_meta_options_map' );
}
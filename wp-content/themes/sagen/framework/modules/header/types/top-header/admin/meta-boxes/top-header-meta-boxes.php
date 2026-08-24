<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_header_top_area_meta_options_map' ) ) {
	function sagen_select_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = sagen_select_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = sagen_select_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		sagen_select_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'sagen' )
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'sagen' ),
				'parent'        => $top_header_container,
				'options'       => sagen_select_get_yes_no_select_array(),
			)
		);
		
		$top_bar_container = sagen_select_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'dependency' => array(
					'show' => array(
						'qodef_top_bar_meta' => 'yes'
					)
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'sagen' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'sagen' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'   => 'qodef_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'sagen' ),
				'parent' => $top_bar_container
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'sagen' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'sagen' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'sagen' ),
				'description'   => esc_html__( 'Set border on top bar', 'sagen' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
		$top_bar_border_container = sagen_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'show' => array(
						'qodef_top_bar_border_meta' => 'yes'
					)
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'sagen' ),
				'description' => esc_html__( 'Choose color for top bar border', 'sagen' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_header_area_meta_boxes_map', 'sagen_select_header_top_area_meta_options_map' );
}
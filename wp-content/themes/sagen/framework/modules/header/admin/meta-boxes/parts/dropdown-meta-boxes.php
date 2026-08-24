<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_dropdown_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_dropdown_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_dropdown_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_dropdown_meta_options_map' ) ) {
	function sagen_select_dropdown_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= sagen_select_get_hide_dep_for_dropdown_meta_boxes();

		$dropdown_container = sagen_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'dropdown_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		sagen_select_add_admin_section_title(
			array(
				'parent' => $dropdown_container,
				'name'   => 'dropdown_styles',
				'title'  => esc_html__( 'Dropdown Styles', 'sagen' )
			)
		);


		sagen_select_create_meta_box_field(
			array(
				'parent'        => $dropdown_container,
				'type'          => 'text',
				'name'          => 'qodef_dropdown_top_position_meta',
				'label'         => esc_html__( 'Dropdown Position', 'sagen' ),
				'description'   => esc_html__( 'Enter value in percentage of entire header height', 'sagen' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

        sagen_select_create_meta_box_field(
            array(
                'name'          => 'qodef_wide_dropdown_menu_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Wide Dropdown Menu In Grid', 'sagen' ),
                'description'   => esc_html__( 'Set wide dropdown menu to be in grid', 'sagen' ),
                'parent'        => $dropdown_container,
                'default_value' => '',
                'options'       => sagen_select_get_yes_no_select_array()
            )
        );

        $wide_dropdown_menu_in_grid_container = sagen_select_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'wide_dropdown_menu_in_grid_container',
                'parent'          => $dropdown_container,
                'dependency' => array(
                    'show' => array(
                        'qodef_wide_dropdown_menu_in_grid_meta'  => 'no'
                    )
                )
            )
        );

        sagen_select_create_meta_box_field(
            array(
                'name'        => 'qodef_wide_dropdown_menu_content_in_grid_meta',
                'type'          => 'select',
                'label'       => esc_html__( 'Wide Dropdown Menu Content In Grid', 'sagen' ),
                'description' => esc_html__( 'Set wide dropdown menu content to be in grid', 'sagen' ),
                'parent'      => $wide_dropdown_menu_in_grid_container,
                'default_value' => '',
                'options'       => sagen_select_get_yes_no_select_array()
            )
        );
			
	
		
		do_action( 'sagen_select_dropdown_additional_meta_boxes_map', $dropdown_container );
	}
	
	add_action( 'sagen_select_action_dropdown_meta_boxes_map', 'sagen_select_dropdown_meta_options_map', 10, 1 );
}
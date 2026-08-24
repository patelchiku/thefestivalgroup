<?php

if ( ! function_exists( 'sagen_select_get_title_types_meta_boxes' ) ) {
	function sagen_select_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'sagen_select_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'sagen' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'sagen_select_map_title_meta' ) ) {
	function sagen_select_map_title_meta() {
		$title_type_meta_boxes = sagen_select_get_title_types_meta_boxes();
		
		$title_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => apply_filters( 'sagen_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'sagen' ),
				'name'  => 'title_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sagen' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'sagen' ),
				'parent'        => $title_meta_box,
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = sagen_select_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'qodef_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'qodef_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'sagen' ),
						'description'   => esc_html__( 'Choose title type', 'sagen' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'sagen' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'sagen' ),
						'options'       => sagen_select_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'sagen' ),
						'description' => esc_html__( 'Set a height for Title Area', 'sagen' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_mobile_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height on Mobile', 'sagen' ),
						'description' => esc_html__( 'Set a height for Title Area on Mobile', 'sagen' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'sagen' ),
						'description' => esc_html__( 'Choose a background color for title area', 'sagen' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'sagen' ),
						'description' => esc_html__( 'Choose an Image for title area', 'sagen' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'sagen' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'sagen' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'sagen' ),
							'hide'                => esc_html__( 'Hide Image', 'sagen' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'sagen' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'sagen' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'sagen' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'sagen' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'sagen' )
						)
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'sagen' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'sagen' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'sagen' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'sagen' ),
							'window-top'    => esc_html__( 'From Window Top', 'sagen' )
						)
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'sagen' ),
						'options'       => sagen_select_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'sagen' ),
						'description' => esc_html__( 'Choose a color for title text', 'sagen' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'sagen' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'sagen' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'sagen' ),
						'options'       => sagen_select_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'sagen' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'sagen' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'sagen_select_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_title_meta', 60 );
}
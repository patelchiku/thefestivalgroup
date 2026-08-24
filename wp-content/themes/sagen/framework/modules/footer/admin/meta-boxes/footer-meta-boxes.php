<?php

if ( ! function_exists( 'sagen_select_map_footer_meta' ) ) {
	function sagen_select_map_footer_meta() {
		
		$footer_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => apply_filters( 'sagen_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'sagen' ),
				'name'  => 'footer_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'sagen' ),
				'options'       => sagen_select_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = sagen_select_add_admin_container(
			array(
				'name'       => 'qodef_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			sagen_select_create_meta_box_field(
				array(
					'name'          => 'qodef_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'sagen' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'sagen' ),
					'options'       => sagen_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			sagen_select_create_meta_box_field(
				array(
					'name'          => 'qodef_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'sagen' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'sagen' ),
					'options'       => sagen_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			sagen_select_create_meta_box_field(
				array(
					'name'          => 'qodef_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'sagen' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'sagen' ),
					'options'       => sagen_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = sagen_select_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'sagen' ),
					'description' => esc_html__( 'Define style for footer top area', 'sagen' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'qodef_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = sagen_select_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'sagen' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'sagen' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'sagen' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			sagen_select_create_meta_box_field(
				array(
					'name'          => 'qodef_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'sagen' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'sagen' ),
					'options'       => sagen_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = sagen_select_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'sagen' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'sagen' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'qodef_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = sagen_select_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'sagen' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'sagen' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'sagen' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_footer_meta', 70 );
}
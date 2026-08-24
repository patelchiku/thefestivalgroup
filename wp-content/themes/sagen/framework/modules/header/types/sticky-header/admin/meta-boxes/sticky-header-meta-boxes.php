<?php

if ( ! function_exists( 'sagen_select_sticky_header_meta_boxes_options_map' ) ) {
	function sagen_select_sticky_header_meta_boxes_options_map( $header_meta_box ) {

		$sticky_amount_container = sagen_select_add_admin_container(
			array(
				'parent'     => $header_meta_box,
				'name'       => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'qodef_header_behaviour_meta' => array( '', 'no-behavior', 'fixed-on-scroll', 'sticky-header-on-scroll-up' ),
					),
				),
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_sticky_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Sticky Header in Grid', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will put sticky header in grid', 'sagen' ),
				'parent'        => $header_meta_box,
				'options'       => sagen_select_get_yes_no_select_array(),
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'sagen' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'sagen' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px',
				),
			)
		);

		$sagen_custom_sidebars = sagen_select_get_custom_sidebars();
		if ( (is_array($sagen_custom_sidebars) ? count($sagen_custom_sidebars) : 0) > 0 ) {
			sagen_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'sagen' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'sagen' ),
					'parent'      => $header_meta_box,
					'options'     => $sagen_custom_sidebars,
					'dependency'  => array(
						'show' => array(
							'qodef_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ),
						),
					),
				)
			);
		}
	}

	add_action( 'sagen_select_action_additional_header_area_meta_boxes_map', 'sagen_select_sticky_header_meta_boxes_options_map', 8 );
}

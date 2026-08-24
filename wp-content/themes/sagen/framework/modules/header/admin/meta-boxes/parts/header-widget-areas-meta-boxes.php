<?php

if ( ! function_exists( 'sagen_select_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function sagen_select_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'sagen_select_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'sagen_select_header_widget_areas_meta_options_map' ) ) {
	function sagen_select_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets         = sagen_select_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_two = sagen_select_get_hide_dep_for_header_widget_area_two_meta_boxes();

		$header_widget_areas_container = sagen_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_widgets,
					),
				),
				'args'       => array(
					'enable_panels_for_default_value' => true,
				),
			)
		);

		sagen_select_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'sagen' ),
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'sagen' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = sagen_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'qodef_disable_header_widget_areas_meta' => 'yes',
					),
				),
			)
		);

		$sagen_custom_sidebars = sagen_select_get_custom_sidebars();
		if ( (is_array($sagen_custom_sidebars) ? count($sagen_custom_sidebars) : 0) > 0 ) {
			sagen_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'sagen' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'sagen' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $sagen_custom_sidebars,
				)
			);
		}

		if ( (is_array($sagen_custom_sidebars) ? count($sagen_custom_sidebars) : 0) > 0 ) {
			sagen_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_header_widget_area_two_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'sagen' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'sagen' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $sagen_custom_sidebars,
					'dependency'  => array(
						'hide' => array(
							'qodef_header_type_meta' => $hide_dep_widget_area_two,
						),
					),
				)
			);
		}

		do_action( 'sagen_select_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}

	add_action( 'sagen_select_action_header_widget_areas_meta_boxes_map', 'sagen_select_header_widget_areas_meta_options_map', 10, 1 );
}

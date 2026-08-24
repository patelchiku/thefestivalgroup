<?php

if ( ! function_exists( 'sagen_select_map_sidebar_meta' ) ) {
	function sagen_select_map_sidebar_meta() {
		$qodef_sidebar_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => apply_filters( 'sagen_select_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'sagen' ),
				'name'  => 'sidebar_meta',
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'sagen' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'sagen' ),
				'parent'      => $qodef_sidebar_meta_box,
				'options'     => sagen_select_get_custom_sidebars_options( true ),
			)
		);

		$qodef_custom_sidebars = sagen_select_get_custom_sidebars();
		if ( (is_array($qodef_custom_sidebars) ? count($qodef_custom_sidebars) : 0) > 0 ) {
			sagen_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'sagen' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'sagen' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true,
					),
				)
			);
		}
	}

	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_sidebar_meta', 31 );
}

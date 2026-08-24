<?php

if ( ! function_exists( 'sagen_select_sidebar_options_map' ) ) {
	function sagen_select_sidebar_options_map() {

		sagen_select_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'sagen' ),
				'icon'  => 'fa fa-indent',
			)
		);

		$sidebar_panel = sagen_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'sagen' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page',
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'sagen' ),
				'description'   => esc_html__( 'Choose a sidebar layout for pages', 'sagen' ),
				'parent'        => $sidebar_panel,
				'default_value' => 'no-sidebar',
				'options'       => sagen_select_get_custom_sidebars_options(),
			)
		);

		$sagen_custom_sidebars = sagen_select_get_custom_sidebars();
		if ( (is_array($sagen_custom_sidebars) ? count($sagen_custom_sidebars) : 0) > 0 ) {
			sagen_select_add_admin_field(
				array(
					'name'        => 'custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'sagen' ),
					'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'sagen' ),
					'parent'      => $sidebar_panel,
					'options'     => $sagen_custom_sidebars,
					'args'        => array(
						'select2' => true,
					),
				)
			);
		}
	}

	add_action( 'sagen_select_action_options_map', 'sagen_select_sidebar_options_map', sagen_select_set_options_map_position( 'sidebar' ) );
}

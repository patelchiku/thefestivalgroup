<?php

if ( ! function_exists( 'sagen_select_content_bottom_options_map' ) ) {
	function sagen_select_content_bottom_options_map() {
		
		$panel_content_bottom = sagen_select_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'sagen' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'sagen' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = sagen_select_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$sagen_custom_sidebars = sagen_select_get_custom_sidebars();
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'sagen' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'sagen' ),
				'options'       => $sagen_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Display in Grid', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'sagen' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);

		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_predefined',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display Predefined Layout', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will only display two widgets - 70%/30%', 'sagen' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);

		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_dark_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Display Dark Text', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will only display the text in dark color', 'sagen' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'sagen' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'sagen' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}

	add_action( 'sagen_select_action_additional_page_options_map', 'sagen_select_content_bottom_options_map' );
}
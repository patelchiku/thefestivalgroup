<?php

if ( ! function_exists( 'sagen_select_logo_options_map' ) ) {
	function sagen_select_logo_options_map() {
		
		sagen_select_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'sagen' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = sagen_select_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'sagen' )
			)
		);
		
		$hide_logo_container = sagen_select_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'logo_image_vertical_closed',
				'type'          => 'image',
				'default_value' => SAGEN_SELECT_ASSETS_ROOT . "/img/logo-vertical-closed.png",
				'label'         => esc_html__( 'Logo Image - Vertical Closed', 'sagen' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'sagen_select_action_options_map', 'sagen_select_logo_options_map', sagen_select_set_options_map_position( 'logo' ) );
}
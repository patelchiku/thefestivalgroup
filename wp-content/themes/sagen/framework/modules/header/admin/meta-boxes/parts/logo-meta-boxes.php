<?php

if ( ! function_exists( 'sagen_select_logo_meta_box_map' ) ) {
	function sagen_select_logo_meta_box_map() {
		
		$logo_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => apply_filters( 'sagen_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'sagen' ),
				'name'  => 'logo_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_vertical_closed_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Vertical Closed', 'sagen' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'sagen' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_logo_meta_box_map', 47 );
}
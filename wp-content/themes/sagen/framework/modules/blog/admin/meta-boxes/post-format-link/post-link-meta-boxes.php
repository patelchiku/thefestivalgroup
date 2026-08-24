<?php

if ( ! function_exists( 'sagen_select_map_post_link_meta' ) ) {
	function sagen_select_map_post_link_meta() {
		$link_post_format_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'sagen' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'sagen' ),
				'description' => esc_html__( 'Enter link', 'sagen' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_post_link_meta', 24 );
}
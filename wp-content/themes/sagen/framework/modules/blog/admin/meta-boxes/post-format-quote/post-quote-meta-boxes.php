<?php

if ( ! function_exists( 'sagen_select_map_post_quote_meta' ) ) {
	function sagen_select_map_post_quote_meta() {
		$quote_post_format_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'sagen' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'sagen' ),
				'description' => esc_html__( 'Enter Quote text', 'sagen' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'sagen' ),
				'description' => esc_html__( 'Enter Quote author', 'sagen' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_position__meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author Position', 'sagen' ),
				'description' => esc_html__( 'Enter Quote author position', 'sagen' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_post_quote_meta', 25 );
}
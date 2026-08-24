<?php

if ( ! function_exists( 'sagen_core_map_testimonials_meta' ) ) {
	function sagen_core_map_testimonials_meta() {
		$testimonial_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'sagen-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'sagen-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'sagen-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'sagen-core' ),
				'description' => esc_html__( 'Enter author name', 'sagen-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'sagen-core' ),
				'description' => esc_html__( 'Enter author job position', 'sagen-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_core_map_testimonials_meta', 95 );
}
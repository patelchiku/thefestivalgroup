<?php

if ( ! function_exists( 'sagen_core_reviews_map' ) ) {
	function sagen_core_reviews_map() {
		
		$reviews_panel = sagen_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'sagen-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'sagen-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'sagen-core' ),
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'sagen-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'sagen-core' ),
			)
		);
	}
	
	add_action( 'sagen_select_action_additional_page_options_map', 'sagen_core_reviews_map', 75 ); //one after elements
}
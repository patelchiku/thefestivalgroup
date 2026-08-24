<?php

if ( ! function_exists( 'sagen_select_map_post_audio_meta' ) ) {
	function sagen_select_map_post_audio_meta() {
		$audio_post_format_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'sagen' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'sagen' ),
				'description'   => esc_html__( 'Choose audio type', 'sagen' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'sagen' ),
					'self'            => esc_html__( 'Self Hosted', 'sagen' )
				)
			)
		);
		
		$qodef_audio_embedded_container = sagen_select_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'qodef_audio_embedded_container'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'sagen' ),
				'description' => esc_html__( 'Enter audio URL', 'sagen' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'sagen' ),
				'description' => esc_html__( 'Enter audio link', 'sagen' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_post_audio_meta', 23 );
}
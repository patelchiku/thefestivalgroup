<?php

/*** Post Settings ***/

if ( ! function_exists( 'sagen_select_map_post_meta' ) ) {
	function sagen_select_map_post_meta() {

		$post_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'sagen' ),
				'name'  => 'post-meta',
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'sagen' ),
				'parent'        => $post_meta_box,
				'options'       => sagen_select_get_yes_no_select_array(),
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_hide_blog_text_parts_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Hide Text Parts on Masonry', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will hide all text parts on your blog masonry list page', 'sagen' ),
				'parent'        => $post_meta_box,
				'options'       => sagen_select_get_yes_no_select_array(),
			)
		);

		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'sagen' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'sagen' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => sagen_select_get_custom_sidebars_options( true ),
			)
		);

		$sagen_custom_sidebars = sagen_select_get_custom_sidebars();
		if ( (is_array($sagen_custom_sidebars) ? count($sagen_custom_sidebars) : 0) > 0 ) {
			sagen_select_create_meta_box_field(
				array(
					'name'        => 'qodef_blog_single_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'sagen' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'sagen' ),
					'parent'      => $post_meta_box,
					'options'     => sagen_select_get_custom_sidebars(),
					'args'        => array(
						'select2' => true,
					),
				)
			);
		}

		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'sagen' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'sagen' ),
				'parent'      => $post_meta_box,
			)
		);

		do_action( 'sagen_select_action_blog_post_meta', $post_meta_box );
	}

	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_post_meta', 20 );
}

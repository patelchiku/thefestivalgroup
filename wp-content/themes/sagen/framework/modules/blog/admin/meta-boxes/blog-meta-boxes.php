<?php

foreach ( glob( SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'sagen_select_map_blog_meta' ) ) {
	function sagen_select_map_blog_meta() {
		$qodef_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$qodef_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'sagen' ),
				'name'  => 'blog_meta'
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'sagen' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'sagen' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'sagen' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'sagen' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'sagen' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'sagen' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'sagen' ),
					'in-grid'    => esc_html__( 'In Grid', 'sagen' ),
					'full-width' => esc_html__( 'Full Width', 'sagen' )
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'sagen' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'sagen' ),
				'parent'      => $blog_meta_box,
				'options'     => sagen_select_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'sagen' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'sagen' ),
				'options'     => sagen_select_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'sagen' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'sagen' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'sagen' ),
					'fixed'    => esc_html__( 'Fixed', 'sagen' ),
					'original' => esc_html__( 'Original', 'sagen' )
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'sagen' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'sagen' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'sagen' ),
					'standard'        => esc_html__( 'Standard', 'sagen' ),
					'load-more'       => esc_html__( 'Load More', 'sagen' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'sagen' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'sagen' )
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'sagen' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'sagen' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_blog_meta', 30 );
}
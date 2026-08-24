<?php

if ( ! function_exists( 'sagen_core_map_property_meta' ) ) {
	function sagen_core_map_property_meta() {
		global $sagen_select_Framework;
		
		$mkd_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$mkd_pages[ $page->ID ] = $page->post_title;
		}
		
		//Property Additional Sidebar Items
		
		$mkdAdditionalSidebarItems = sagen_select_create_meta_box(
			array(
				'scope' => array( 'property-item' ),
				'title' => esc_html__( 'Property Features', 'sagen-core' ),
				'name'  => 'property_properties'
			)
		);
        
        sagen_select_add_repeater_field(
            array(
                'name'        => 'qodef_property_feature_repeater',
                'label'       => esc_html__('Property Features', 'sagen-core'),
                'fields' => array(
                    array(
                        'name'        => 'qodef_property_feature_image',
                        'type'        => 'image',
                        'label'       => esc_html__('Feature Image', 'sagen-core'),
                    ),
                    array(
                        'name'        => 'qodef_property_feature_title',
                        'type'        => 'text',
                        'label'       => esc_html__('Title', 'sagen-core'),
                    ),
                    array(
                        'name'        => 'qodef_property_feature_description',
                        'type'        => 'text',
                        'label'       => esc_html__('Description', 'sagen-core'),
                    )

                ),
                'parent'      => $mkdAdditionalSidebarItems,
                'description' => ''
            )
        );
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_core_map_property_meta', 40 );
}
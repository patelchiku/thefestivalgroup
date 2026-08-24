<?php

if ( ! function_exists( 'sagen_select_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function sagen_select_woocommerce_options_map() {
		
		sagen_select_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'sagen' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = sagen_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'sagen' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'sagen' ),
				'options'     => sagen_select_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'sagen' ),
				'default_value' => 'qodef-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'sagen' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'sagen' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'sagen' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'sagen' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'sagen' ),
				'default_value' => 'normal',
				'options'       => sagen_select_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'sagen' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'sagen' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'sagen' ),
				),
				'parent'        => $panel_product_list,
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'sagen' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'sagen' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'sagen' ),
				'default_value' => 'h5',
				'options'       => sagen_select_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'sagen' ),
				'parent'        => $panel_product_list
			)
		);

		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_shop_rating',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Rating on Shop Page', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show show stars on Shop Page', 'sagen' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = sagen_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'sagen' ),
				'parent'        => $panel_single_product,
				'options'       => sagen_select_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_single_product_title_tag',
				'default_value' => 'h3',
				'label'         => esc_html__( 'Single Product Title Tag', 'sagen' ),
				'options'       => sagen_select_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'sagen' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'sagen' ),
					'3' => esc_html__( 'Three', 'sagen' ),
					'2' => esc_html__( 'Two', 'sagen' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'on-left-side',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'sagen' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'sagen' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'sagen' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'sagen' ),
				'parent'        => $panel_single_product,
				'options'       => sagen_select_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'sagen' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'sagen' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'sagen' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'sagen' ),
				'default_value' => 'qodef-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'sagen' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'sagen' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'sagen' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('sagen_select_woocommerce_additional_options_map');
	}
	
	add_action( 'sagen_select_action_options_map', 'sagen_select_woocommerce_options_map', sagen_select_set_options_map_position( 'woocommerce' ) );
}
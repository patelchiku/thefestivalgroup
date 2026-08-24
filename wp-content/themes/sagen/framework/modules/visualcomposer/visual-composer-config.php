<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = SAGEN_SELECT_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'sagen_select_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function sagen_select_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}

	add_action( 'vc_after_init', 'sagen_select_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'sagen_select_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function sagen_select_vc_row_map() {

		/******* VC Row shortcode - begin *******/

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'sagen' ),
				'value'      => array(
					esc_html__( 'Full Width', 'sagen' ) => 'full-width',
					esc_html__( 'In Grid', 'sagen' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'sagen' ),
				'description' => esc_html__( 'For example "home"', 'sagen' ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'sagen' ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'sagen' ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'sagen' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'sagen' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'sagen' ),
				'value'       => array(
					esc_html__( 'Never', 'sagen' )        => '',
					esc_html__( 'Below 1280px', 'sagen' ) => '1280',
					esc_html__( 'Below 1024px', 'sagen' ) => '1024',
					esc_html__( 'Below 768px', 'sagen' )  => '768',
					esc_html__( 'Below 680px', 'sagen' )  => '680',
					esc_html__( 'Below 480px', 'sagen' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'sagen' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'sagen' ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'sagen' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'sagen' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'sagen' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'sagen' ),
				'value'      => array(
					esc_html__( 'Default', 'sagen' ) => '',
					esc_html__( 'Left', 'sagen' )    => 'left',
					esc_html__( 'Center', 'sagen' )  => 'center',
					esc_html__( 'Right', 'sagen' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_corner',
				'heading'    => esc_html__( 'Background Corner Position', 'sagen' ),
				'value'      => array(
					esc_html__( 'None', 'sagen' )      => '',
					esc_html__( 'Top Left', 'sagen' )      => 'top-left',
					esc_html__( 'Top Right', 'sagen' )   => 'top-right',
					esc_html__( 'Bottom Left', 'sagen' )   => 'bottom-left',
					esc_html__( 'Bottom Right', 'sagen' )   => 'bottom-right'
				),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_1',
				'heading'    => esc_html__( 'Background Text', 'sagen' ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size',
				'heading'    => esc_html__( 'Background Text Size', 'sagen' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size_1440',
				'heading'    => esc_html__( 'Background Text Size 1280px-1440px', 'sagen' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size_1280',
				'heading'    => esc_html__( 'Background Text Size 1024px-1280px', 'sagen' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'row_background_text_color',
				'heading'    => esc_html__( 'Background Text Color', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'sagen' ),
				'value'      => array(
					esc_html__( 'Default', 'sagen' ) => '',
					esc_html__( 'Left', 'sagen' )    => 'left',
					esc_html__( 'Center', 'sagen' )  => 'center',
					esc_html__( 'Right', 'sagen' )   => 'right'
				),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_vertical_align',
				'heading'    => esc_html__( 'Background Vertical Align', 'sagen' ),
				'value'      => array(
					esc_html__( 'Top', 'sagen' )      => 'top',
					esc_html__( 'Middle', 'sagen' )   => 'middle',
					esc_html__( 'Bottom', 'sagen' )   => 'bottom'
				),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_top',
				'heading'    => esc_html__( 'Background Text Top Padding', 'sagen' ),
				'description' => esc_html__( 'Set the value of top padding in px or %', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_left',
				'heading'    => esc_html__( 'Background Text Left Padding', 'sagen' ),
				'description' => esc_html__( 'Set the value of left padding in px or %', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_right',
				'heading'    => esc_html__( 'Background Text Right Padding', 'sagen' ),
				'description' => esc_html__( 'Set the value of right padding in px or %', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_bottom',
				'heading'    => esc_html__( 'Background Text Bottom Padding', 'sagen' ),
				'description' => esc_html__( 'Set the value of top margin in px or %', 'sagen' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_animation',
				'heading'    => esc_html__( 'Animate Background Text', 'sagen' ),
				'value'      => array_flip( sagen_select_get_yes_no_select_array(false, false) ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'description'    => esc_html__( 'Animate background text when row appears in viewport', 'sagen' ),
				'group'      => esc_html__( 'Background Text', 'sagen' )
			)
		);

		do_action( 'sagen_select_action_additional_vc_row_params' );

		/******* VC Row shortcode - end *******/

		/******* VC Row Inner shortcode - begin *******/

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'sagen' ),
				'value'      => array(
					esc_html__( 'Full Width', 'sagen' ) => 'full-width',
					esc_html__( 'In Grid', 'sagen' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'sagen' ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'sagen' ),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'sagen' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'sagen' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'sagen' ),
				'value'       => array(
					esc_html__( 'Never', 'sagen' )        => '',
					esc_html__( 'Below 1280px', 'sagen' ) => '1280',
					esc_html__( 'Below 1024px', 'sagen' ) => '1024',
					esc_html__( 'Below 768px', 'sagen' )  => '768',
					esc_html__( 'Below 680px', 'sagen' )  => '680',
					esc_html__( 'Below 480px', 'sagen' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'sagen' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'sagen' ),
				'value'      => array(
					esc_html__( 'Default', 'sagen' ) => '',
					esc_html__( 'Left', 'sagen' )    => 'left',
					esc_html__( 'Center', 'sagen' )  => 'center',
					esc_html__( 'Right', 'sagen' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'sagen' )
			)
		);

		/******* VC Row Inner shortcode - end *******/

		/******* VC Revolution Slider shortcode - begin *******/

		if ( sagen_select_is_plugin_installed( 'revolution-slider' ) ) {

			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'sagen' ),
					'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'sagen' )
				)
			);

			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'sagen' ),
					'value'       => array(
						esc_html__( 'Tiny', 'sagen' )   => 'tiny',
						esc_html__( 'Small', 'sagen' )  => 'small',
						esc_html__( 'Normal', 'sagen' ) => 'normal',
						esc_html__( 'Large', 'sagen' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'sagen' )
				)
			);

			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'sagen' ),
					'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'sagen' )
				)
			);

			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'sagen' ),
					'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'sagen' )
				)
			);
		}

		/******* VC Revolution Slider shortcode - end *******/
	}

	add_action( 'vc_after_init', 'sagen_select_vc_row_map' );
}
<?php

if ( ! function_exists( 'sagen_select_error_404_options_map' ) ) {
	function sagen_select_error_404_options_map() {
		
		sagen_select_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'sagen' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);
		
		$panel_404_header = sagen_select_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'sagen' ),
				'description' => esc_html__( 'Choose a background color for header area', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'sagen' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'sagen' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'sagen' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'sagen' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'sagen' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'sagen' ),
					'light-header' => esc_html__( 'Light', 'sagen' ),
					'dark-header'  => esc_html__( 'Dark', 'sagen' )
				)
			)
		);
		
		$panel_404_options = sagen_select_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'sagen' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'sagen' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'sagen' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'sagen' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'sagen' )
			)
		);
		
		$first_level_group = sagen_select_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'sagen' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'sagen' )
			)
		);
		
		$first_level_row1 = sagen_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'sagen' ),
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_row2 = sagen_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'sagen' ),
				'options'       => sagen_select_get_font_style_array()
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'sagen' ),
				'options'       => sagen_select_get_font_weight_array()
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'sagen' ),
				'options'       => sagen_select_get_text_transform_array()
			)
		);

        $first_level_group_responsive = sagen_select_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'first_level_group_responsive',
                'title'       => esc_html__( 'Title Style Responsive', 'sagen' ),
                'description' => esc_html__( 'Define responsive styles for 404 page title (under 680px)', 'sagen' )
            )
        );

        $first_level_row3 = sagen_select_add_admin_row(
            array(
                'parent' => $first_level_group_responsive,
                'name'   => 'first_level_row3'
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'sagen' ),
				'description'   => esc_html__( 'Enter text for 404 page.', 'sagen' )
			)
		);
		
		$third_level_group = sagen_select_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => '$third_level_group',
				'title'       => esc_html__( 'Text Style', 'sagen' ),
				'description' => esc_html__( 'Define styles for 404 page text', 'sagen' )
			)
		);
		
		$third_level_row1 = sagen_select_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row1'
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_text_color',
				'label'  => esc_html__( 'Text Color', 'sagen' ),
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$third_level_row2 = sagen_select_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row2',
				'next'   => true
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'sagen' ),
				'options'       => sagen_select_get_font_style_array()
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'sagen' ),
				'options'       => sagen_select_get_font_weight_array()
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'sagen' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'sagen' ),
				'options'       => sagen_select_get_text_transform_array()
			)
		);

        $third_level_group_responsive = sagen_select_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'third_level_group_responsive',
                'title'       => esc_html__( 'Text Style Responsive', 'sagen' ),
                'description' => esc_html__( 'Define responsive styles for 404 page text (under 680px)', 'sagen' )
            )
        );

        $third_level_row3 = sagen_select_add_admin_row(
            array(
                'parent' => $third_level_group_responsive,
                'name'   => 'third_level_row3'
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'sagen' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		sagen_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'text',
				'name'        => '404_back_to_home',
				'label'       => esc_html__( 'Back to Home Button Label', 'sagen' ),
				'description' => esc_html__( 'Enter label for "Back to home" button', 'sagen' )
			)
		);
		
		sagen_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'select',
				'name'          => '404_button_style',
				'default_value' => '',
				'label'         => esc_html__( 'Button Skin', 'sagen' ),
				'description'   => esc_html__( 'Choose a style to make Back to Home button in that predefined style', 'sagen' ),
				'options'       => array(
					''            => esc_html__( 'Default', 'sagen' ),
					'light-style' => esc_html__( 'Light', 'sagen' )
				)
			)
		);
	}
	
	add_action( 'sagen_select_action_options_map', 'sagen_select_error_404_options_map', sagen_select_set_options_map_position( '404' ) );
}
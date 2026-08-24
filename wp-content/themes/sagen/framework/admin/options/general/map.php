<?php

if ( ! function_exists( 'sagen_select_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function sagen_select_general_options_map() {

		sagen_select_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'sagen' ),
				'icon'  => 'fa fa-institution',
			)
		);

		$panel_design_style = sagen_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'sagen' ),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'enable_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Google Fonts', 'sagen' ),
				'parent'        => $panel_design_style,
			)
		);
		$google_fonts_container = sagen_select_add_admin_container(
			array(
				'parent'     => $panel_design_style,
				'name'       => 'google_fonts_container',
				'dependency' => array(
					'hide' => array(
						'enable_google_fonts' => 'no',
					),
				),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'sagen' ),
				'parent'        => $google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'sagen' ),
				'parent'        => $google_fonts_container,
			)
		);

		$additional_google_fonts_container = sagen_select_add_admin_container(
			array(
				'parent'     => $google_fonts_container,
				'name'       => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts' => 'yes',
					),
				),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sagen' ),
				'parent'        => $additional_google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sagen' ),
				'parent'        => $additional_google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sagen' ),
				'parent'        => $additional_google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sagen' ),
				'parent'        => $additional_google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sagen' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sagen' ),
				'parent'        => $additional_google_fonts_container,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'sagen' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'sagen' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'sagen' ),
					'100i' => esc_html__( '100 Thin Italic', 'sagen' ),
					'200'  => esc_html__( '200 Extra-Light', 'sagen' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'sagen' ),
					'300'  => esc_html__( '300 Light', 'sagen' ),
					'300i' => esc_html__( '300 Light Italic', 'sagen' ),
					'400'  => esc_html__( '400 Regular', 'sagen' ),
					'400i' => esc_html__( '400 Regular Italic', 'sagen' ),
					'500'  => esc_html__( '500 Medium', 'sagen' ),
					'500i' => esc_html__( '500 Medium Italic', 'sagen' ),
					'600'  => esc_html__( '600 Semi-Bold', 'sagen' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'sagen' ),
					'700'  => esc_html__( '700 Bold', 'sagen' ),
					'700i' => esc_html__( '700 Bold Italic', 'sagen' ),
					'800'  => esc_html__( '800 Extra-Bold', 'sagen' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'sagen' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'sagen' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'sagen' ),
				),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'sagen' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'sagen' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'sagen' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'sagen' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'sagen' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'sagen' ),
					'greek'        => esc_html__( 'Greek', 'sagen' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'sagen' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'sagen' ),
				),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'sagen' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'sagen' ),
				'parent'      => $panel_design_style,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'sagen' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'sagen' ),
				'parent'      => $panel_design_style,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'sagen' ),
				'description' => esc_html__( 'Choose the background image for page content', 'sagen' ),
				'parent'      => $panel_design_style,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'sagen' ),
				'parent'        => $panel_design_style,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'sagen' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'sagen' ),
				'parent'      => $panel_design_style,
			)
		);

		/***************** Passepartout Layout - begin **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'sagen' ),
				'parent'        => $panel_design_style,
			)
		);

			$boxed_container = sagen_select_add_admin_container(
				array(
					'parent'     => $panel_design_style,
					'name'       => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed' => 'yes',
						),
					),
				)
			);

				sagen_select_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'sagen' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'sagen' ),
						'parent'      => $boxed_container,
					)
				);

				sagen_select_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'sagen' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'sagen' ),
						'parent'      => $boxed_container,
					)
				);

				sagen_select_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'sagen' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'sagen' ),
						'parent'      => $boxed_container,
					)
				);

				sagen_select_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'sagen' ),
						'description'   => esc_html__( 'Choose background image attachment', 'sagen' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'sagen' ),
							'fixed'  => esc_html__( 'Fixed', 'sagen' ),
							'scroll' => esc_html__( 'Scroll', 'sagen' ),
						),
					)
				);

		/***************** Boxed Layout - end **********************/

		/***************** Passepartout Layout - begin **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'sagen' ),
				'parent'        => $panel_design_style,
			)
		);

			$paspartu_container = sagen_select_add_admin_container(
				array(
					'parent'     => $panel_design_style,
					'name'       => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu' => 'yes',
						),
					),
				)
			);

				sagen_select_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'sagen' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'sagen' ),
						'parent'      => $paspartu_container,
					)
				);

				sagen_select_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'sagen' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'sagen' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %',
						),
					)
				);

				sagen_select_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'sagen' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'sagen' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %',
						),
					)
				);

				sagen_select_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'sagen' ),
					)
				);

				sagen_select_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'sagen' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'sagen' ),
					)
				);

		/***************** Passepartout Layout - end **********************/

		/***************** Content Layout - begin **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'sagen' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'sagen' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'qodef-grid-1300' => esc_html__( '1300px - default', 'sagen' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'sagen' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'sagen' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'sagen' ),
					'qodef-grid-800'  => esc_html__( '800px', 'sagen' ),
				),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'preload_pattern_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Preload Pattern Image', 'sagen' ),
				'description' => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'sagen' ),
				'parent'      => $panel_design_style,
			)
		);

		/***************** Content Layout - end **********************/

		$panel_settings = sagen_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'sagen' ),
			)
		);

		/***************** Smooth Scroll Layout - begin **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'sagen' ),
				'parent'        => $panel_settings,
			)
		);

		/***************** Smooth Scroll Layout - end **********************/

		/***************** Smooth Page Transitions Layout - begin **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'sagen' ),
				'parent'        => $panel_settings,
			)
		);

			$page_transitions_container = sagen_select_add_admin_container(
				array(
					'parent'     => $panel_settings,
					'name'       => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions' => 'yes',
						),
					),
				)
			);

				sagen_select_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'sagen' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'sagen' ),
						'parent'        => $page_transitions_container,
					)
				);

				$page_transition_preloader_container = sagen_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container,
						'name'       => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes',
							),
						),
					)
				);

					sagen_select_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'sagen' ),
							'parent' => $page_transition_preloader_container,
						)
					);

					$group_pt_spinner_animation = sagen_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'sagen' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'sagen' ),
							'parent'      => $page_transition_preloader_container,
						)
					);

					$row_pt_spinner_animation = sagen_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation,
						)
					);

					sagen_select_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'sagen' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'sagen' ),
								'pulse'                 => esc_html__( 'Pulse', 'sagen' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'sagen' ),
								'cube'                  => esc_html__( 'Cube', 'sagen' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'sagen' ),
								'stripes'               => esc_html__( 'Stripes', 'sagen' ),
								'wave'                  => esc_html__( 'Wave', 'sagen' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'sagen' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'sagen' ),
								'atom'                  => esc_html__( 'Atom', 'sagen' ),
								'clock'                 => esc_html__( 'Clock', 'sagen' ),
								'mitosis'               => esc_html__( 'Mitosis', 'sagen' ),
								'lines'                 => esc_html__( 'Lines', 'sagen' ),
								'fussion'               => esc_html__( 'Fussion', 'sagen' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'sagen' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'sagen' ),
							),
						)
					);

					sagen_select_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'sagen' ),
							'parent'        => $row_pt_spinner_animation,
						)
					);

					sagen_select_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'sagen' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'sagen' ),
							'parent'        => $page_transitions_container,
						)
					);

		/***************** Smooth Page Transitions Layout - end **********************/

		sagen_select_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'sagen' ),
				'parent'        => $panel_settings,
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'sagen' ),
				'parent'        => $panel_settings,
			)
		);

		$panel_custom_code = sagen_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'sagen' ),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'sagen' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'sagen' ),
				'parent'      => $panel_custom_code,
			)
		);

		$panel_google_api = sagen_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'sagen' ),
			)
		);

		sagen_select_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'sagen' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'sagen' ),
				'parent'      => $panel_google_api,
			)
		);
	}

	add_action( 'sagen_select_action_options_map', 'sagen_select_general_options_map', sagen_select_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'sagen_select_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function sagen_select_page_general_style( $style ) {
		$current_style = '';
		$page_id       = sagen_select_get_page_id();
		$class_prefix  = sagen_select_get_unique_page_class( $page_id );

		$boxed_background_style = array();

		$boxed_page_background_color = sagen_select_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}

		$boxed_page_background_image = sagen_select_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}

		$boxed_page_background_pattern_image = sagen_select_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}

		$boxed_page_background_attachment = sagen_select_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		$boxed_background_selector = $class_prefix . '.qodef-boxed .qodef-wrapper';

		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= sagen_select_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}

		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';

		$paspartu_header_selector        = array(
			'.qodef-paspartu-enabled .qodef-page-header .qodef-fixed-wrapper.fixed',
			'.qodef-paspartu-enabled .qodef-sticky-header',
			'.qodef-paspartu-enabled .qodef-mobile-header.mobile-header-appear .qodef-mobile-header-inner',
		);
		$paspartu_header_appear_selector = array(
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-page-header .qodef-fixed-wrapper.fixed',
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-sticky-header.header-appear',
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-mobile-header.mobile-header-appear .qodef-mobile-header-inner',
		);

		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();

		$paspartu_color = sagen_select_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}

		$paspartu_width = sagen_select_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( sagen_select_string_ends_with( $paspartu_width, '%' ) || sagen_select_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;

				$paspartu_clean_width      = sagen_select_string_ends_with( $paspartu_width, '%' ) ? sagen_select_filter_suffix( $paspartu_width, '%' ) : sagen_select_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = sagen_select_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';

				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';

				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}

		$paspartu_selector = $class_prefix . '.qodef-paspartu-enabled .qodef-wrapper';

		if ( ! empty( $paspartu_style ) ) {
			$current_style .= sagen_select_dynamic_css( $paspartu_selector, $paspartu_style );
		}

		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= sagen_select_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= sagen_select_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}

		$paspartu_responsive_width = sagen_select_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( sagen_select_string_ends_with( $paspartu_responsive_width, '%' ) || sagen_select_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;

				$paspartu_clean_width      = sagen_select_string_ends_with( $paspartu_responsive_width, '%' ) ? sagen_select_filter_suffix( $paspartu_responsive_width, '%' ) : sagen_select_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = sagen_select_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';

				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';

				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}

		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . sagen_select_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}

		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . sagen_select_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . sagen_select_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'sagen_select_filter_add_page_custom_style', 'sagen_select_page_general_style' );
}

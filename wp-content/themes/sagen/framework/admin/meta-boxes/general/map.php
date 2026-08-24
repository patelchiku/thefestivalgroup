<?php

if ( ! function_exists( 'sagen_select_map_general_meta' ) ) {
	function sagen_select_map_general_meta() {
		
		$general_meta_box = sagen_select_create_meta_box(
			array(
				'scope' => apply_filters( 'sagen_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'sagen' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'sagen' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'sagen' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'sagen' ),
				'parent'        => $general_meta_box
			)
		);
		
		$qodef_content_padding_group = sagen_select_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'sagen' ),
				'description' => esc_html__( 'Define styles for Content area', 'sagen' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = sagen_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'parent' => $qodef_content_padding_group
				)
			);
			
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'sagen' ),
						'parent'      => $qodef_content_padding_row
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'sagen' ),
						'parent'        => $qodef_content_padding_row
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'sagen' ),
						'options'       => sagen_select_get_yes_no_select_array(),
						'parent'        => $qodef_content_padding_row
					)
				);
		
			$qodef_content_padding_row_1 = sagen_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row_1',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'sagen' ),
						'parent' => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'sagen' ),
						'parent'  => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'sagen' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'sagen' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'sagen' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'sagen' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'sagen' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'sagen' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'sagen' ),
					'qodef-grid-800'  => esc_html__( '800px', 'sagen' )
				)
			)
		);
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'sagen' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'sagen' ),
				'options'     => sagen_select_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'sagen' ),
				'parent'  => $general_meta_box,
				'options' => sagen_select_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = sagen_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'sagen' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'sagen' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'sagen' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'sagen' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'sagen' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'sagen' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'sagen' ),
						'description'   => esc_html__( 'Choose background image attachment', 'sagen' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'sagen' ),
							'fixed'  => esc_html__( 'Fixed', 'sagen' ),
							'scroll' => esc_html__( 'Scroll', 'sagen' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'sagen' ),
				'parent'        => $general_meta_box,
				'options'       => sagen_select_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = sagen_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'sagen' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'sagen' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'sagen' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'sagen' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'sagen' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'sagen' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				sagen_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'sagen' ),
						'options'       => sagen_select_get_yes_no_select_array(),
					)
				);
		
				sagen_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'sagen' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'sagen' ),
						'options'       => sagen_select_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'sagen' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'sagen' ),
				'parent'        => $general_meta_box,
				'options'       => sagen_select_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = sagen_select_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				sagen_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'sagen' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'sagen' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => sagen_select_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = sagen_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'qodef_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					sagen_select_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'sagen' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = sagen_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'sagen' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'sagen' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = sagen_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					sagen_select_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'sagen' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'sagen' ),
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
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'sagen' )
							)
						)
					);
					
					sagen_select_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'sagen' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					sagen_select_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'sagen' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'sagen' ),
							'options'     => sagen_select_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		sagen_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'sagen' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'sagen' ),
				'parent'      => $general_meta_box,
				'options'     => sagen_select_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'sagen_select_action_meta_boxes_map', 'sagen_select_map_general_meta', 10 );
}

if ( ! function_exists( 'sagen_select_container_background_style' ) ) {
	/**
	 * Function that return container style
	 *
	 * @param $style
	 *
	 * @return string
	 */
	function sagen_select_container_background_style( $style ) {
		$page_id      = sagen_select_get_page_id();
		$class_prefix = sagen_select_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .qodef-content'
		);
		
		$container_class        = array();
		$current_style = '';
		$page_background_color  = get_post_meta( $page_id, 'qodef_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'qodef_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'qodef_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}

		if(! empty( $container_class )) {
			$current_style = sagen_select_dynamic_css( $container_selector, $container_class );
		}

		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'sagen_select_filter_add_page_custom_style', 'sagen_select_container_background_style' );
}
<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassButtonWidget extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_button_widget',
				esc_html__( 'Sagen Button Widget', 'sagen' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'sagen' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'sagen' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'sagen' ),
						'outline' => esc_html__( 'Outline', 'sagen' ),
						'simple'  => esc_html__( 'Simple', 'sagen' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'sagen' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'sagen' ),
						'medium' => esc_html__( 'Medium', 'sagen' ),
						'large'  => esc_html__( 'Large', 'sagen' ),
						'huge'   => esc_html__( 'Huge', 'sagen' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'sagen' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'sagen' ),
					'default' => esc_html__( 'Button Text', 'sagen' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'sagen' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'sagen' ),
					'options' => sagen_select_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'sagen' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'sagen' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'sagen' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'sagen' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'sagen' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'sagen' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'sagen' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'sagen' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'sagen' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'sagen' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'sagen' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'sagen' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$params = '';
			
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );
			
			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}
			
			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
			
			echo '<div class="widget qodef-button-widget">';
			echo do_shortcode( "[qodef_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}
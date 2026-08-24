<?php
namespace SagenCore\CPT\Shortcodes\StackedImages;

use SagenCore\Lib;

class StackedImages implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_stacked_images';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Stacked Images', 'sagen-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'     => 'icon-wpb-stacked-images extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sagen-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_image',
							'heading'    => esc_html__( 'Image', 'sagen-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_stack_image',
							'heading'    => esc_html__( 'Stack Image', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'stack_image_position',
							'heading'     => esc_html__( 'Stack Image Position', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Left Offset', 'sagen-core' )  => 'left',
								esc_html__( 'Right Offset', 'sagen-core' ) => 'right'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'item_stack_image', 'not_empty' => true )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'enable_image_shadow'  => 'no',
			'item_image'           => '',
			'item_stack_image'     => '',
			'stack_image_position' => 'left'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );

		
		$html = sagen_core_get_shortcode_module_template_part( 'templates/stacked-images', 'stacked-images', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ($params['enable_image_shadow'] === 'yes') ? 'qodef-si-has-shadow' : '';
		$holderClasses[] = ! empty( $params['stack_image_position'] ) ? 'qodef-si-position-' . $params['stack_image_position'] : 'qodef-si-position-' . $args['stack_image_position'];
		
		return implode( ' ', $holderClasses );
	}
}
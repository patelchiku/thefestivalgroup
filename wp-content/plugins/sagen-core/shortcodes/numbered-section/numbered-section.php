<?php
namespace SagenCore\CPT\Shortcodes\NumberedSection;

use SagenCore\Lib;

class NumberedSection implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_numbered_section';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Numbered Section', 'sagen-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'                      => 'icon-wpb-numbered-section extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sagen-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sagen-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'back_title',
							'heading'     => esc_html__( 'Back Title', 'sagen-core' ),
							'admin_label' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'back_title_color',
							'heading'    => esc_html__( 'Back Title Color', 'sagen-core' ),
							'dependency' => array( 'element' => 'back_title', 'not_empty' => true ),
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'back_title_custom_font_size',
                            'heading'    => esc_html__( 'Back Title Custom Font Size (px)', 'sagen-core' ),
                            'dependency' => array( 'element' => 'back_title', 'not_empty' => true ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'back_title_top_pos',
                            'heading'    => esc_html__( 'Back Title Top Position (px)', 'sagen-core' ),
                            'dependency' => array( 'element' => 'back_title', 'not_empty' => true ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'back_title_left_pos',
                            'heading'    => esc_html__( 'Back Title Left Position (px)', 'sagen-core' ),
                            'dependency' => array( 'element' => 'back_title', 'not_empty' => true ),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_separator',
                            'heading'     => esc_html__( 'Enable Separator', 'sagen-core' ),
                            'value'       => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
                            'save_always' => true
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'sagen-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_title_tag( true, array('p' => 'p') ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title_custom_font_size',
                            'heading'    => esc_html__( 'Title Custom Font Size (px)', 'sagen-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                        ),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'sagen-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'sagen-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'sagen-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                  => '',
			'title'                         => '',
			'back_title'                    => '',
            'back_title_color'              => '',
            'back_title_custom_font_size'   => '',
            'back_title_top_pos'            => '',
            'back_title_left_pos'           => '',
            'enable_separator'              => 'yes',
			'title_tag'                     => 'h4',
            'title_custom_font_size'        => '',
			'title_color'                   => '',
			'text'                          => '',
			'text_color'                    => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['back_title_styles'] = $this->getBackTitleStyles( $params );
		$params['text_styles']       = $this->getTextStyles( $params );
		
		$html = sagen_core_get_shortcode_module_template_part( 'templates/numbered-section', 'numbered-section', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['back_title'] ) ? 'qodef-ns-back-title-exist' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

        if ( ! empty( $params['title_custom_font_size'] ) ) {
            $styles[] = 'font-size: ' . sagen_select_filter_px( $params['title_custom_font_size'] ) . 'px';
        }
		
		return implode( ';', $styles );
	}

	private function getBackTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['back_title_color'] ) ) {
			$styles[] = 'color: ' . $params['back_title_color'];
		}

        if ( ! empty( $params['back_title_custom_font_size'] ) ) {
            $styles[] = 'font-size: ' . sagen_select_filter_px( $params['back_title_custom_font_size'] ) . 'px';
        }

        if ( ! empty( $params['back_title_top_pos'] ) ) {
            $styles[] = 'top: ' . sagen_select_filter_px( $params['back_title_top_pos'] ) . 'px';
        }

        if ( ! empty( $params['back_title_left_pos'] ) ) {
            $styles[] = 'left: ' . sagen_select_filter_px( $params['back_title_left_pos'] ) . 'px';
        }

		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}
}
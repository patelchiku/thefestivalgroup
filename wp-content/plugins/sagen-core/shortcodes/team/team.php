<?php
namespace SagenCore\CPT\Shortcodes\Team;

use SagenCore\lib;

class Team implements lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'qodef_team';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		$team_social_text_array = array();
		
		for ( $x = 1; $x <= 3; $x ++ ) {

			$team_social_text_array[] = array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Social Text ', 'sagen-core' ) . $x,
				'param_name' => 'team_social_' . $x,
				'save_always' => true
			);

			
			$team_social_text_array[] = array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Social Text ', 'sagen-core' ) . $x . esc_html__( ' Link', 'sagen-core' ),
				'param_name' => 'team_social_' . $x . '_link',
				'save_always' => true
			);
			
			$team_social_text_array[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Social Text ', 'sagen-core' ) . $x . esc_html__( ' Target', 'sagen-core' ),
				'param_name' => 'team_social_' . $x . '_target',
				'value'      => array(
					esc_html__( 'Same Window', 'sagen-core' ) => '_self',
					esc_html__( 'New Window', 'sagen-core' )  => '_blank'
				),
				'save_always' => true
			);
		}
		
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Team', 'sagen-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'                      => 'icon-wpb-team extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'team_image',
								'heading'    => esc_html__( 'Image', 'sagen-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_name',
								'heading'    => esc_html__( 'Name', 'sagen-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'team_name_tag',
								'heading'     => esc_html__( 'Name Tag', 'sagen-core' ),
								'value'       => array_flip( sagen_select_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'team_name', 'not_empty' => true )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_name_color',
								'heading'    => esc_html__( 'Name Color', 'sagen-core' ),
								'dependency' => array( 'element' => 'team_name', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_position',
								'heading'    => esc_html__( 'Position', 'sagen-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_position_color',
								'heading'    => esc_html__( 'Position Color', 'sagen-core' ),
								'dependency' => array( 'element' => 'team_position', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_text',
								'heading'    => esc_html__( 'Text', 'sagen-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_text_color',
								'heading'    => esc_html__( 'Text Color', 'sagen-core' ),
								'dependency' => array( 'element' => 'team_text', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_link',
								'heading'    => esc_html__( 'Link', 'sagen-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'team_target',
								'heading'    => esc_html__( 'Target', 'sagen-core' ),
								'value'      => array_flip( sagen_select_get_link_target_array() ),
								'dependency' => array( 'element' => 'team_link', 'not_empty' => true )
							),
						),
						$team_social_text_array
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {

		$args = array(
			'type'                  => 'info-below-image',
			'team_image'            => '',
			'team_name'             => '',
			'team_name_tag'         => 'h5',
			'team_name_color'       => '',
			'team_position'         => '',
			'team_position_color'   => '',
			'team_text'             => '',
			'team_text_color'       => '',
			'team_link'             => '',
			'team_target'           => '',
		);
		
		$team_social_text_form_fields = array();
		
		for ( $x = 1; $x <= 3; $x ++ ) {

			$team_social_text_form_fields[ 'team_social_' . $x ] = '';
			$team_social_text_form_fields[ 'team_social_' . $x . '_link' ]   = '';
			$team_social_text_form_fields[ 'team_social_' . $x . '_target' ] = '';
		}
		
		$args = array_merge( $args, $team_social_text_form_fields );
		
		$params = shortcode_atts( $args, $atts );
		
		$params['type']                 = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['team_name_tag']        = ! empty( $params['team_name_tag'] ) ? $params['team_name_tag'] : $args['team_name_tag'];
		$params['team_social_text']     = $this->getTeamSocialText( $params );
		$params['team_name_styles']     = $this->getTeamNameStyles( $params );
		$params['team_position_styles'] = $this->getTeamPositionStyles( $params );
		$params['team_text_styles']     = $this->getTeamTextStyles( $params );
		
		//Get HTML from template based on type of team
		$html = sagen_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-team-' . $params['type'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTeamSocialText( $params ) {
		extract( $params );

		$social_texts = array();

		for ( $i = 1; $i <= 3; $i ++ ) {

			$team_social_text   = ${'team_social_' . $i};
			$team_social_link   = ${'team_social_' . $i . '_link'};
			$team_social_target = ${'team_social_' . $i . '_target'};

			if ( $team_social_text !== '' ) {

				$team_text_params                                  = array();
				$team_text_params['name']                          = ( $team_social_text !== '' ) ? $team_social_text : '';
				$team_text_params['link']                          = ( $team_social_link !== '' ) ? $team_social_link : '';
				$team_text_params['target']                        = ( $team_social_target !== '' ) ? $team_social_target : '';

				$social_texts[] = $team_text_params;
			}
		}

		
		return $social_texts;
	}
	
	private function getTeamNameStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_name_color'] ) ) {
			$styles[] = 'color: ' . $params['team_name_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTeamPositionStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_position_color'] ) ) {
			$styles[] = 'color: ' . $params['team_position_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTeamTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_text_color'] ) ) {
			$styles[] = 'color: ' . $params['team_text_color'];
		}
		
		return implode( ';', $styles );
	}
}
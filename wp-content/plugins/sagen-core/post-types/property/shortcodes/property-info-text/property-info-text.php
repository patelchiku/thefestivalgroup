<?php

namespace SagenCore\CPT\Shortcodes\Property;

use SagenCore\Lib;

class PropertyInfoText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_property_info_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Property selected projects filter
		add_filter( 'vc_autocomplete_qodef_property_info_text_selected_project_callback', array( &$this, 'propertyIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects render
		add_filter( 'vc_autocomplete_qodef_property_info_text_selected_project_render', array( &$this, 'propertyIdAutocompleteRender', ), 10, 1 ); // Render exact property. Must return an array (label,value)

	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Sagen Property Info Text', 'sagen-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'     => 'icon-wpb-property-info-text extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_project',
							'heading'     => esc_html__( 'Show Project with Listed ID', 'sagen-core' ),
							'settings'    => array(
								'multiple'      => false,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'If you don\'t specify the id of the property, the shortcode will automatically get the id of the current page ', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_text_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'heading'    => esc_html__( 'Skin', 'sagen-core' ),
                            'value'      => array(
                              esc_html__('Dark', 'sagen-core')    => 'qodef-dark-skin',
                              esc_html__('Light', 'sagen-core')    => 'qodef-light-skin'
                            ),
                            'group'      => esc_html__( 'Content Layout', 'sagen-core' )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image_proportions'        => 'full',
			'selected_project'        => '',
			'title_tag'                => 'div',
			'title_text_transform'     => '',
            'skin'                     => 'qodef-dark-skin'
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );

		$additional_params['query_results'] = $query_results;
		
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['title_styles']         =$this->getTitleStyles($params);
		
		$params['this_object'] = $this;
		
		$html = sagen_core_get_cpt_shortcode_module_template_part( 'property', 'property-info-text', 'property-info-text', '', $params, $additional_params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'property-item',
			'posts_per_page' => 1,
		);

		
		$project_id = null;
		if ( ! empty( $params['selected_project'] ) ) {
			$project_id             = $params['selected_project'];
			$query_array['p'] = $project_id;
		}
		else{
            $query_array['p'] = get_the_ID();
        }

        $query_array['paged'] = 1;

		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();

        $classes[] = $params['skin'];
		
		return implode( ' ', $classes );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	/**
	 * Filter propertys by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function propertyIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$property_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'property-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $property_id > 0 ? $property_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'sagen-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'sagen-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find property by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function propertyIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get property
			$property = get_post( (int) $query );
			if ( ! is_wp_error( $property ) ) {
				
				$property_id    = $property->ID;
				$property_title = $property->post_title;
				
				$property_title_display = '';
				if ( ! empty( $property_title ) ) {
					$property_title_display = ' - ' . esc_html__( 'Title', 'sagen-core' ) . ': ' . $property_title;
				}
				
				$property_id_display = esc_html__( 'Id', 'sagen-core' ) . ': ' . $property_id;
				
				$data          = array();
				$data['value'] = $property_id;
				$data['label'] = $property_id_display . $property_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}

}
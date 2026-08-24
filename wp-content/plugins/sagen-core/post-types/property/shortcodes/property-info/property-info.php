<?php

namespace SagenCore\CPT\Shortcodes\Property;

use SagenCore\Lib;

class PropertyInfo implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_property_info';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Property category filter
		add_filter( 'vc_autocomplete_qodef_property_info_category_callback', array( &$this, 'propertyCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Property category render
		add_filter( 'vc_autocomplete_qodef_property_info_category_render', array( &$this, 'propertyCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Property selected projects filter
		add_filter( 'vc_autocomplete_qodef_property_info_selected_projects_callback', array( &$this, 'propertyIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects render
		add_filter( 'vc_autocomplete_qodef_property_info_selected_projects_render', array( &$this, 'propertyIdAutocompleteRender', ), 10, 1 ); // Render exact property. Must return an array (label,value)

	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Sagen Property Info', 'sagen-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'     => 'icon-wpb-property-info extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Original', 'sagen-core' )  => 'full',
								esc_html__( 'Square', 'sagen-core' )    => 'square',
								esc_html__( 'Landscape', 'sagen-core' ) => 'landscape',
								esc_html__( 'Portrait', 'sagen-core' )  => 'portrait',
								esc_html__( 'Medium', 'sagen-core' )    => 'medium',
								esc_html__( 'Large', 'sagen-core' )     => 'large',
								esc_html__( 'Huge', 'sagen-core' )     => 'huge'
							),
							'description' => esc_html__( 'Set image proportions for your property list.', 'sagen-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Propertys Per Page', 'sagen-core' ),
							'description' => esc_html__( 'Set number of items for your property list. Enter -1 to show all.', 'sagen-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Property List', 'sagen-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'sagen-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Project with Listed ID', 'sagen-core' ),
							'settings'    => array(
								'multiple'      => false,
								'sortable'      => true,
								'unique_values' => true
							),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_title',
							'heading'    => esc_html__( 'Enable Title', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_image',
							'heading'    => esc_html__( 'Enable Featured Image', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'disable_counter',
							'heading'    => esc_html__( 'Disable Title Counter', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
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
							'param_name' => 'enable_category',
							'heading'    => esc_html__( 'Enable Category', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_excerpt',
							'heading'    => esc_html__( 'Enable Excerpt', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'sagen-core' ),
							'description' => esc_html__( 'Number of characters', 'sagen-core' ),
							'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Content Layout', 'sagen-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image_proportions'        => 'full',
			'category'                 => '',
			'selected_projects'        => '',
			'number_of_items'          => '-1',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'enable_title'             => 'yes',
			'enable_image'             => 'yes',
			'disable_counter'          => '',
			'title_tag'                => 'h1',
			'title_text_transform'     => '',
			'enable_category'          => 'yes',
			'enable_excerpt'           => 'no',
			'excerpt_length'           => '100'
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
		
		$additional_params['holder_data']          = $this->getHolderData( $params, $additional_params );
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
		
		$params['this_object'] = $this;
		
		$html = sagen_core_get_cpt_shortcode_module_template_part( 'property', 'property-info', 'property-info', '', $params, $additional_params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'property-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if ( ! empty( $params['category'] ) ) {
			$query_array['property-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}

        $query_array['paged'] = 1;

		return $query_array;
	}
	
	public function getHolderData( $params, $additional_params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_results           = $additional_params['query_results'];
		$params['max_num_pages'] = $query_results->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next_page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( $value );
			}
		}
		
		return $dataString;
	}
	
	public function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		$holderClasses[] = $params['disable_counter'] === 'yes' ? 'qodef-disable-counter' : '';

		return implode( ' ', $holderClasses );
	}
	
	public function getHolderInnerClasses( $params ) {
		$classes = array();

		return implode( ' ', $classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'sagen_select_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'sagen_select_image_portrait';
					break;
				case 'square':
					$thumb_size = 'sagen_select_image_square';
					break;
                case 'huge':
					$thumb_size = 'sagen_select_image_huge';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}

	/**
	 * Filter property categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function propertyCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS property_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'property-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['property_category_title'] ) > 0 ) ? esc_html__( 'Category', 'sagen-core' ) . ': ' . $value['property_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find property category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function propertyCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get property category
			$property_category = get_term_by( 'slug', $query, 'property-category' );
			if ( is_object( $property_category ) ) {

				$property_category_slug  = $property_category->slug;
				$property_category_title = $property_category->name;

				$property_category_title_display = '';
				if ( ! empty( $property_category_title ) ) {
					$property_category_title_display = esc_html__( 'Category', 'sagen-core' ) . ': ' . $property_category_title;
				}

				$data          = array();
				$data['value'] = $property_category_slug;
				$data['label'] = $property_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
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
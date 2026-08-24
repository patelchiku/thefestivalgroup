<?php

namespace SagenCore\CPT\Shortcodes\Property;

use SagenCore\Lib;

class PropertySlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_property_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Property category filter
		add_filter( 'vc_autocomplete_qodef_property_slider_category_callback', array( &$this, 'propertyCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property category render
		add_filter( 'vc_autocomplete_qodef_property_slider_category_render', array( &$this, 'propertyCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects filter
		add_filter( 'vc_autocomplete_qodef_property_slider_selected_projects_callback', array( &$this, 'propertyIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects render
		add_filter( 'vc_autocomplete_qodef_property_slider_selected_projects_render', array( &$this, 'propertyIdAutocompleteRender', ), 10, 1 ); // Render exact property. Must return an array (label,value)
		
		//Property tag filter
		add_filter( 'vc_autocomplete_qodef_property_slider_tag_callback', array( &$this, 'propertyTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property tag render
		add_filter( 'vc_autocomplete_qodef_property_slider_tag_render', array( &$this, 'propertyTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Sagen Property Slider', 'sagen-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'     => 'icon-wpb-property-slider extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Propertys Items', 'sagen-core' ),
							'admin_label' => true,
							'description' => esc_html__( 'Set number of items for your property slider. Enter -1 to show all', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Open property single page on click', 'sagen-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'sagen-core' ) => 'gallery',
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Default', 'sagen-core' ) => '',
								esc_html__( 'One', 'sagen-core' )     => '1',
								esc_html__( 'Two', 'sagen-core' )     => '2',
								esc_html__( 'Three', 'sagen-core' )   => '3',
								esc_html__( 'Four', 'sagen-core' )    => '4',
								esc_html__( 'Five', 'sagen-core' )    => '5'
							),
							'description' => esc_html__( 'Number of propertys that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'sagen-core' ),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_space_between_items_array() ),
							'save_always' => true
						),
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
								esc_html__( 'Large', 'sagen-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your property slider.', 'sagen-core' ),
							'save_always' => true
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
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'sagen-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'sagen-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Property List', 'sagen-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'sagen-core' )
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
							'type'        => 'dropdown',
							'param_name'  => 'item_style',
							'heading'     => esc_html__( 'Item Style', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Standard - Shader', 'sagen-core' )                 => 'standard-shader',
								esc_html__( 'Standard - Switch Featured Images', 'sagen-core' ) => 'standard-switch-images',
								esc_html__( 'Gallery - Overlay', 'sagen-core' )                 => 'gallery-overlay',
								esc_html__( 'Gallery - Overlay Inverted', 'sagen-core' )        => 'gallery-overlay-inverted',
                                esc_html__( 'Gallery - Info Overlay', 'sagen-core' )            => 'gallery-info-overlay',
                                esc_html__( 'Gallery - Slide From Image Bottom', 'sagen-core' ) => 'gallery-slide-from-image-bottom'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Content Layout', 'sagen-core' )
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
                            'param_name' => 'enable_separator',
                            'heading'    => esc_html__( 'Enable Separator', 'sagen-core' ),
                            'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
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
							'param_name' => 'enable_count_images',
							'heading'    => esc_html__( 'Enable Number of Images', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'dependency' => array( 'element' => 'item_type', 'value' => array( 'gallery' ) ),
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
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' ),
							'dependency'  => array( 'element' => 'item_type', 'value' => array( '' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'sagen-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'sagen-core' ),
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'sagen-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'sagen-core' ),
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'navigation_skin',
							'heading'    => esc_html__( 'Navigation Skin', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Default', 'sagen-core' ) => '',
								esc_html__( 'Light', 'sagen-core' )   => 'light',
								esc_html__( 'Dark', 'sagen-core' )    => 'dark'
							),
							'dependency' => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'pagination_skin',
							'heading'    => esc_html__( 'Pagination Skin', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Default', 'sagen-core' ) => '',
								esc_html__( 'Light', 'sagen-core' )   => 'light',
								esc_html__( 'Dark', 'sagen-core' )    => 'dark'
							),
							'dependency' => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'pagination_position',
							'heading'     => esc_html__( 'Pagination Position', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Below Slider', 'sagen-core' ) => 'below-slider',
								esc_html__( 'On Slider', 'sagen-core' )    => 'on-slider'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Slider Settings', 'sagen-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_items'        => '9',
			'item_type'              => '',
			'number_of_columns'      => '4',
			'space_between_items'    => 'normal',
			'image_proportions'      => 'full',
			'category'               => '',
			'selected_projects'      => '',
			'tag'                    => '',
			'orderby'                => 'date',
			'order'                  => 'ASC',
			'item_style'             => 'standard-shader',
			'enable_title'           => 'yes',
			'title_tag'              => 'h4',
			'title_text_transform'   => '',
            'enable_separator'       => '',
			'enable_category'        => 'yes',
			'enable_count_images'    => 'yes',
			'enable_excerpt'         => 'no',
			'excerpt_length'         => '20',
			'enable_loop'            => 'no',
			'enable_autoplay'        => 'yes',
			'slider_speed'           => '5000',
			'slider_speed_animation' => '600',
			'enable_navigation'      => 'yes',
			'navigation_skin'        => '',
			'enable_pagination'      => 'yes',
			'pagination_skin'        => '',
			'pagination_position'    => 'below-slider'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['type']                = 'gallery';
		$params['property_slider_on'] = 'yes';
		
		$html = '<div class="qodef-property-slider-holder">';
			$html .= sagen_select_execute_shortcode( 'qodef_property_list', $params );
		$html .= '</div>';
		
		return $html;
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
	
	/**
	 * Filter property tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function propertyTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS property_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'property-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['property_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'sagen-core' ) . ': ' . $value['property_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find property tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function propertyTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get property category
			$property_tag = get_term_by( 'slug', $query, 'property-tag' );
			if ( is_object( $property_tag ) ) {
				
				$property_tag_slug  = $property_tag->slug;
				$property_tag_title = $property_tag->name;
				
				$property_tag_title_display = '';
				if ( ! empty( $property_tag_title ) ) {
					$property_tag_title_display = esc_html__( 'Tag', 'sagen-core' ) . ': ' . $property_tag_title;
				}
				
				$data          = array();
				$data['value'] = $property_tag_slug;
				$data['label'] = $property_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}
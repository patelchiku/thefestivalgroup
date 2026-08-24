<?php

namespace SagenCore\CPT\Shortcodes\Property;

use SagenCore\Lib;

class PropertyList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_property_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Property category filter
		add_filter( 'vc_autocomplete_qodef_property_list_category_callback', array( &$this, 'propertyCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property category render
		add_filter( 'vc_autocomplete_qodef_property_list_category_render', array( &$this, 'propertyCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects filter
		add_filter( 'vc_autocomplete_qodef_property_list_selected_projects_callback', array( &$this, 'propertyIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property selected projects render
		add_filter( 'vc_autocomplete_qodef_property_list_selected_projects_render', array( &$this, 'propertyIdAutocompleteRender', ), 10, 1 ); // Render exact property. Must return an array (label,value)
		
		//Property tag filter
		add_filter( 'vc_autocomplete_qodef_property_list_tag_callback', array( &$this, 'propertyTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Property tag render
		add_filter( 'vc_autocomplete_qodef_property_list_tag_render', array( &$this, 'propertyTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Sagen Property List', 'sagen-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'     => 'icon-wpb-property extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Property List Template', 'sagen-core' ),
							'value'       => array(
								esc_html__( 'Gallery', 'sagen-core' ) => 'gallery',
								esc_html__( 'Masonry', 'sagen-core' ) => 'masonry'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Open property single page on click', 'sagen-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'sagen-core' ) => 'gallery'
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
							'description' => esc_html__( 'Default value is Three', 'sagen-core' ),
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
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Propertys Per Page', 'sagen-core' ),
							'description' => esc_html__( 'Set number of items for your property list. Enter -1 to show all.', 'sagen-core' ),
							'value'       => '-1'
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
							'description' => esc_html__( 'Set image proportions for your property list.', 'sagen-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry property list. This option will apply image proportions you set in Property Single page - dimensions for masonry option.', 'sagen-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
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
							'type'       => 'dropdown',
							'param_name' => 'item_style',
							'heading'    => esc_html__( 'Item Style', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Gallery - Standard', 'sagen-core' )                 => 'standard-shader',
								esc_html__( 'Gallery - Slide From Image Bottom', 'sagen-core' )  => 'gallery-slide-from-image-bottom'
							),
							'group'      => esc_html__( 'Content Layout', 'sagen-core' )
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
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'pagination_type',
							'heading'    => esc_html__( 'Pagination Type', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'None', 'sagen-core' )            => 'no-pagination',
								esc_html__( 'Standard', 'sagen-core' )        => 'standard',
								esc_html__( 'Load More', 'sagen-core' )       => 'load-more',
								esc_html__( 'Infinite Scroll', 'sagen-core' ) => 'infinite-scroll'
							),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'load_more_top_margin',
							'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'sagen-core' ),
							'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter',
							'heading'    => esc_html__( 'Enable Category Filter', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_order_by',
							'heading'    => esc_html__( 'Filter Order By', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Name', 'sagen-core' )  => 'name',
								esc_html__( 'Count', 'sagen-core' ) => 'count',
								esc_html__( 'Id', 'sagen-core' )    => 'id',
								esc_html__( 'Slug', 'sagen-core' )  => 'slug'
							),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_text_transform',
							'heading'    => esc_html__( 'Filter Text Transform', 'sagen-core' ),
							'value'      => array_flip( sagen_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'filter_bottom_margin',
							'heading'    => esc_html__( 'Filter Bottom Margin (px or %)', 'sagen-core' ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'sagen-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_article_animation',
							'heading'     => esc_html__( 'Enable Article Animation', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option you will enable appears animation for your property list items', 'sagen-core' ),
							'group'       => esc_html__( 'Additional Features', 'sagen-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'                     => 'gallery',
			'item_type'                => '',
			'number_of_columns'        => '3',
			'space_between_items'      => 'normal',
			'number_of_items'          => '-1',
			'image_proportions'        => 'full',
			'enable_fixed_proportions' => 'no',
			'enable_image_shadow'      => 'no',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'item_style'               => 'standard-shader',
			'enable_title'             => 'yes',
			'title_tag'                => 'h6',
			'title_text_transform'     => '',
			'enable_category'          => 'yes',
			'enable_excerpt'           => 'no',
			'excerpt_length'           => '20',
			'pagination_type'          => 'no-pagination',
			'load_more_top_margin'     => '',
			'filter'                   => 'no',
			'filter_order_by'          => 'name',
			'filter_text_transform'    => '',
			'filter_bottom_margin'     => '',
			'enable_article_animation' => 'no',
			'property_slider_on'      => 'no',
			'enable_loop'              => 'yes',
			'enable_autoplay'          => 'yes',
			'slider_speed'             => '5000',
			'slider_speed_animation'   => '600',
			'enable_navigation'        => 'yes',
			'navigation_skin'          => '',
			'enable_pagination'        => 'yes',
			'pagination_skin'          => '',
			'pagination_position'      => ''
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
		
		$html = sagen_core_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'property-holder', $params['type'], $params, $additional_params );
		
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
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['property-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
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
		$classes = array();
		
		$classes[] = ! empty( $params['type'] ) ? 'qodef-pl-' . $params['type'] : 'qodef-pl-' . $args['type'];
		$classes[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
		
		$number_of_columns = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'qodef-pl-one-column';
				break;
			case '2':
				$classes[] = 'qodef-pl-two-columns';
				break;
			case '3':
				$classes[] = 'qodef-pl-three-columns';
				break;
			case '4':
				$classes[] = 'qodef-pl-four-columns';
				break;
			case '5':
				$classes[] = 'qodef-pl-five-columns';
				break;
			default:
				$classes[] = 'qodef-pl-three-columns';
				break;
		endswitch;
		
		$classes[] = ! empty( $params['item_style'] ) ? 'qodef-pl-' . $params['item_style'] : '';
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'qodef-pl-images-fixed' : '';
		$classes[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-pl-has-shadow' : '';
		$classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' ? 'qodef-pl-no-content' : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'qodef-pl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['filter'] === 'yes' ? 'qodef-pl-has-filter' : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'qodef-pl-has-animation' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'qodef-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'qodef-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'qodef-pag-' . $params['pagination_position'] : '';
		
		return implode( ' ', $classes );
	}
	
	public function getHolderInnerClasses( $params ) {
		$classes = array();
		
		$classes[] = $params['property_slider_on'] === 'yes' ? 'qodef-owl-slider qodef-pl-is-slider' : '';
		
		return implode( ' ', $classes );
	}
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		$item_style = $params['item_style'];
		
		if ( get_post_meta( get_the_ID(), "qodef_property_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'qodef-pl-has-switch-image';
		} elseif ( get_post_meta( get_the_ID(), "qodef_property_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'qodef-pl-no-switch-image';
		}
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'qodef_property_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'qodef-pl-masonry-' . esc_attr( $masonry_size ) : '';
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
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
		
		if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
			$fixed_image_size = get_post_meta( get_the_ID(), 'qodef_property_masonry_fixed_dimensions_meta', true );
			
			switch ( $fixed_image_size ) {
				case 'default' :
					$thumb_size = 'sagen_select_image_square';
					break;
				case 'large-width':
					$thumb_size = 'sagen_select_image_landscape';
					break;
				case 'large-height':
					$thumb_size = 'sagen_select_image_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'sagen_select_image_huge';
					break;
				default :
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
	
	public function getSwitchFeaturedImage() {
		$featured_image_meta = get_post_meta( get_the_ID(), 'qodef_property_featured_image_meta', true );
		
		$featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';
		
		return $featured_image;
	}
	
	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( sagen_select_string_ends_with( $margin, '%' ) || sagen_select_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . sagen_select_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterCategories( $params ) {
		$cat_id = 0;
		
		if ( ! empty( $params['category'] ) ) {
			$top_category = get_term_by( 'slug', $params['category'], 'property-category' );
			
			if ( isset( $top_category->term_id ) ) {
				$cat_id = $top_category->term_id;
			}
		}
		
		$order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';
		
		$args = array(
			'taxonomy' => 'property-category',
			'child_of' => $cat_id,
			'orderby'  => $params['filter_order_by'],
			'order'    => $order
		);
		
		$filter_categories = get_terms( $args );
		
		return $filter_categories;
	}
	
	public function getFilterHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_bottom_margin'] ) ) {
			$margin = $params['filter_bottom_margin'];
			
			if ( sagen_select_string_ends_with( $margin, '%' ) || sagen_select_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin;
			} else {
				$styles[] = 'margin-bottom: ' . sagen_select_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['filter_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getItemLink() {
		$property_link_meta = get_post_meta( get_the_ID(), 'property_external_link', true );
		$property_link      = ! empty( $property_link_meta ) ? $property_link_meta : get_permalink( get_the_ID() );
		
		return apply_filters( 'sagen_select_property_external_link', $property_link );
	}
	
	public function getItemLinkTarget() {
		$property_link_meta   = get_post_meta( get_the_ID(), 'property_external_link', true );
		$property_link_target = ! empty( $property_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'sagen_select_property_external_link_target', $property_link_target );
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
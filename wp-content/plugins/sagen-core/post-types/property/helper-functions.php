<?php

if ( ! function_exists( 'sagen_core_property_meta_box_functions' ) ) {
	function sagen_core_property_meta_box_functions( $post_types ) {
		$post_types[] = 'property-item';

		return $post_types;
	}

	add_filter( 'sagen_select_filter_meta_box_post_types_save', 'sagen_core_property_meta_box_functions' );
	add_filter( 'sagen_select_filter_meta_box_post_types_remove', 'sagen_core_property_meta_box_functions' );
}

if ( ! function_exists( 'sagen_core_property_scope_meta_box_functions' ) ) {
	function sagen_core_property_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'property-item';

		return $post_types;
	}

	add_filter( 'sagen_select_filter_set_scope_for_meta_boxes', 'sagen_core_property_scope_meta_box_functions' );
}

if ( ! function_exists( 'sagen_core_property_add_social_share_option' ) ) {
	function sagen_core_property_add_social_share_option( $container ) {
		sagen_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_property-item',
				'default_value' => 'no',
				'label'         => esc_html__( 'Property Item', 'sagen-core' ),
				'description'   => esc_html__( 'Show Social Share for Property Items', 'sagen-core' ),
				'parent'        => $container,
			)
		);
	}

	add_action( 'sagen_select_post_types_social_share', 'sagen_core_property_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'sagen_core_register_property_cpt' ) ) {
	function sagen_core_register_property_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'SagenCore\CPT\Property\PropertyRegister',
		);

		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );

		return $cpt_class_name;
	}

	add_filter( 'sagen_core_filter_register_custom_post_types', 'sagen_core_register_property_cpt' );
}

if ( ! function_exists( 'sagen_core_get_archive_property_list' ) ) {
	function sagen_core_get_archive_property_list( $qodef_taxonomy_slug = '', $qodef_taxonomy_name = '' ) {

		$number_of_items        = 12;
		$number_of_items_option = sagen_select_options()->getOptionValue( 'property_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}

		$number_of_columns        = 4;
		$number_of_columns_option = sagen_select_options()->getOptionValue( 'property_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}

		$space_between_items        = 'normal';
		$space_between_items_option = sagen_select_options()->getOptionValue( 'property_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}

		$image_size        = 'landscape';
		$image_size_option = sagen_select_options()->getOptionValue( 'property_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}

		$item_layout        = 'standard-shader';
		$item_layout_option = sagen_select_options()->getOptionValue( 'property_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}

		$category = $qodef_taxonomy_name === 'property-category' && ! empty( $qodef_taxonomy_slug ) ? $qodef_taxonomy_slug : '';
		$tag      = $qodef_taxonomy_name === 'property-tag' && ! empty( $qodef_taxonomy_slug ) ? $qodef_taxonomy_slug : '';

		$params = array(
			'type'                => 'gallery',
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'category'            => $category,
			'tag'                 => $tag,
			'item_layout'         => $item_layout,
			'pagination_type'     => 'load-more',
		);

		$html = sagen_select_execute_shortcode( 'qodef_property_list', $params );

		echo sagen_select_get_module_part( $html );
	}
}

// Load property shortcodes
if ( ! function_exists( 'sagen_core_include_property_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function sagen_core_include_property_shortcodes_files() {
		foreach ( glob( SAGEN_CORE_CPT_PATH . '/property/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}

	add_action( 'sagen_core_action_include_shortcodes_file', 'sagen_core_include_property_shortcodes_files' );
}

if ( ! function_exists( 'sagen_core_set_property_single_info_follow_body_class' ) ) {
	/**
	 * Function that adds follow property info class to body if sticky sidebar is enabled on property single layouts
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with follow property info class body class added
	 */
	function sagen_core_set_property_single_info_follow_body_class( $classes ) {
		if ( is_singular( 'property-item' ) && sagen_select_options()->getOptionValue( 'property_single_sticky_sidebar' ) == 'yes' ) {
			$classes[] = 'qodef-follow-property-info';
		}

		return $classes;
	}

	add_filter( 'body_class', 'sagen_core_set_property_single_info_follow_body_class' );
}

if ( ! function_exists( 'sagen_core_single_property_title_display' ) ) {
	/**
	 * Function that checks option for single property title and overrides it with filter
	 */
	function sagen_core_single_property_title_display( $show_title_area ) {
		if ( is_singular( 'property-item' ) ) {
			//Override displaying title based on property option
			$show_title_area_meta = sagen_select_get_meta_field_intersect( 'show_title_area_property_single' );

			if ( ! empty( $show_title_area_meta ) ) {
				$show_title_area = $show_title_area_meta == 'yes' ? true : false;
			}
		}

		return $show_title_area;
	}

	add_filter( 'sagen_select_show_title_area', 'sagen_core_single_property_title_display' );
}

if ( ! function_exists( 'sagen_core_set_breadcrumbs_output_for_property' ) ) {
	function sagen_core_set_breadcrumbs_output_for_property( $childContent, $delimiter, $before, $after ) {

		if ( is_tax( 'property-category' ) ) {
			$property_category = wp_get_post_terms( get_the_ID(), 'property-category' );
			$property_category = $property_category[0];
			$childContent      = '';

			if ( ! empty( $property_category ) ) {
				if ( isset( $property_category->parent ) && $property_category->parent != 0 ) {
					$childContent .= get_category_parents( $property_category->parent, true, ' ' . $delimiter );
				}
				$childContent .= $before . $property_category->name . $after;
			}
		} elseif ( is_tax( 'property-tag' ) ) {
			$property_tag = wp_get_post_terms( get_the_ID(), 'property-tag' );
			$property_tag = $property_tag[0];

			if ( ! empty( $property_tag ) ) {
				$childContent = $before . $property_tag->name . $after;
			}
		} elseif ( is_singular( 'property-item' ) ) {
			$property_categories = wp_get_post_terms( sagen_select_get_page_id(), 'property-category' );
			$childContent        = '';

			if ( ! empty( $property_categories ) && is_array( $property_categories ) && count( $property_categories ) ) {
				foreach ( $property_categories as $cat ) {
					$childContent .= '<a itemprop="url" href="' . get_term_link( $cat->term_id ) . '">' . $cat->name . '</a>' . $delimiter;
				}
			}

			$childContent .= $before . get_the_title() . $after;

		}

		return $childContent;
	}

	add_filter( 'sagen_select_breadcrumbs_title_child_output', 'sagen_core_set_breadcrumbs_output_for_property', 10, 4 );
}

if ( ! function_exists( 'sagen_core_set_single_property_comments_enabled' ) ) {
	function sagen_core_set_single_property_comments_enabled( $comments ) {
		if ( is_singular( 'property-item' ) && sagen_select_options()->getOptionValue( 'property_single_comments' ) == 'yes' ) {
			$comments = true;
		}

		return $comments;
	}

	add_filter( 'sagen_select_post_type_comments', 'sagen_core_set_single_property_comments_enabled', 10, 1 );
}

if ( ! function_exists( 'sagen_core_get_single_property' ) ) {
	function sagen_core_get_single_property() {
		$property_template = sagen_select_get_meta_field_intersect( 'property_single_item_layout', sagen_select_get_page_id() );

		$params = array(
			'holder_classes' => 'qodef-ps-' . $property_template . '-layout',
			'item_layout'    => $property_template,
		);

		sagen_core_get_cpt_single_module_template_part( 'templates/single/holder', 'property', $property_template, $params );
	}
}

if ( ! function_exists( 'sagen_core_set_single_property_style' ) ) {
	/**
	 * Function that return padding for content
	 */
	function sagen_core_set_single_property_style( $style ) {
		$page_id      = sagen_select_get_page_id();
		$class_prefix = sagen_select_get_unique_page_class( $page_id );

		$current_styles = '';
		$current_style  = array();

		$current_selector = array(
			$class_prefix . ' .qodef-property-single-holder .qodef-ps-info-holder',
		);

		$info_padding_top = get_post_meta( $page_id, 'property_info_top_padding', true );

		if ( ! empty( $info_padding_top ) ) {
			$current_style['padding-top'] = sagen_select_filter_px( $info_padding_top ) . 'px';

			$current_styles .= sagen_select_dynamic_css( $current_selector, $current_style );
		}

		$current_style = $current_styles . $style;

		return $current_style;
	}

	add_filter( 'sagen_select_add_page_custom_style', 'sagen_core_set_single_property_style' );
}

if ( ! function_exists( 'sagen_core_add_property_attachment_custom_field' ) ) {
	function sagen_core_add_property_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'property_single_masonry_image_size', true );

			$form_fields['property_single_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'sagen-core' ),
				'helps' => esc_html__( 'Choose image size for property single item - Masonry layout', 'sagen-core' ),
			);

			$form_fields['property_single_masonry_image_size']['html']  = "<select name='attachments[{$post->ID}][property_single_masonry_image_size]'>";
			$form_fields['property_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-default-masonry-item', false ) . ' value="qodef-default-masonry-item">' . esc_html__( 'Default Size', 'sagen-core' ) . '</option>';
			$form_fields['property_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-large-masonry-item', false ) . ' value="qodef-large-masonry-item">' . esc_html__( 'Large Size', 'sagen-core' ) . '</option>';
			$form_fields['property_single_masonry_image_size']['html'] .= '</select>';
		}

		return $form_fields;
	}

	add_filter( 'attachment_fields_to_edit', 'sagen_core_add_property_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'sagen_core_save_image_property_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function sagen_core_save_image_property_attachment_fields( $post, $attachment ) {

		if ( isset( $attachment['property_single_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'property_single_masonry_image_size', $attachment['property_single_masonry_image_size'] );
		}

		return $post;
	}

	add_filter( 'attachment_fields_to_save', 'sagen_core_save_image_property_attachment_fields', 10, 2 );
}

if ( ! function_exists( 'sagen_core_get_property_single_media' ) ) {
	function sagen_core_get_property_single_media() {
		$image_ids      = get_post_meta( get_the_ID(), 'qodef-property-image-gallery', true );
		$videos         = get_post_meta( get_the_ID(), 'mkd_property_images', true );
		$property_media = array();

		if ( $image_ids !== '' ) {
			$image_ids = explode( ',', $image_ids );

			foreach ( $image_ids as $image_id ) {
				$media                   = array();
				$media['title']          = get_the_title( $image_id );
				$media['type']           = 'image';
				$media['description']    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$media['image_src']      = wp_get_attachment_image_src( $image_id, 'full' );
				$media['holder_classes'] = '';

				$image_size = get_post_meta( $image_id, 'property_single_masonry_image_size', true );

				switch ( $image_size ) {
					case 'qodef-default-masonry-item':
						$media['holder_classes'] = 'qodef-ps-masonry-normal-item';
						break;
					case 'qodef-large-masonry-item':
						$media['holder_classes'] = 'qodef-ps-masonry-large-item';
						break;
				}

				$property_media[] = $media;
			}
		}

		if ( is_array( $videos ) && count( $videos ) ) {
			usort( $videos, 'sagen_core_compare_property_videos' );
			foreach ( $videos as $video ) {
				$media = array();

				if ( ! empty( $video['propertyvideotype'] ) ) {
					$media['title']       = $video['propertytitle'];
					$media['type']        = $video['propertyvideotype'];
					$media['description'] = 'video';
					$media['video_url']   = sagen_core_get_property_video_url( $video );

					if ( $video['propertyvideotype'] == 'self' ) {
						$media['video_cover'] = ! empty( $video['propertyvideoimage'] ) ? $video['propertyvideoimage'] : '';
					}

					if ( $video['propertyvideotype'] !== 'self' ) {
						$media['video_id'] = $video['propertyvideoid'];
					}
				} elseif ( ! empty( $video['propertyimgtype'] ) ) {
					$media['title']     = $video['propertytitle'];
					$media['type']      = $video['propertyimgtype'];
					$media['image_src'] = $video['propertyimg'];
				}

				$property_media[] = $media;
			}
		}

		return $property_media;
	}
}

if ( ! function_exists( 'sagen_core_get_property_video_url' ) ) {
	function sagen_core_get_property_video_url( $video ) {
		switch ( $video['propertyvideotype'] ) {
			case 'youtube':
				return 'https://www.youtube.com/embed/' . $video['propertyvideoid'] . '?wmode=transparent';
				break;
			case 'vimeo';
				return 'https://player.vimeo.com/video/' . $video['propertyvideoid'] . '?title=0&amp;byline=0&amp;portrait=0';
				break;
			case 'self':
				$return_array = array();

				if ( ! empty( $video['propertyvideomp4'] ) ) {
					$return_array['mp4'] = $video['propertyvideomp4'];
				}

				return $return_array;

				break;
		}
	}
}

if ( ! function_exists( 'sagen_core_get_property_single_media_html' ) ) {
	function sagen_core_get_property_single_media_html( $media ) {
		$params = array();

		if ( $media['type'] == 'image' ) {
			$params['lightbox'] = sagen_select_options()->getOptionValue( 'property_single_lightbox_images' ) == 'yes';

			$media['image_url'] = is_array( $media['image_src'] ) ? $media['image_src'][0] : $media['image_src'];
			if ( empty( $media['description'] ) ) {
				$media['description'] = $media['title'];
			}
		}

		if ( in_array( $media['type'], array( 'youtube', 'vimeo' ) ) ) {
			$params['lightbox'] = sagen_select_options()->getOptionValue( 'property_single_lightbox_videos' ) == 'yes';

			if ( $params['lightbox'] ) {
				switch ( $media['type'] ) {
					case 'vimeo':
						$url      = 'https://vimeo.com/api/v2/video/' . $media['video_id'] . '.php';
						$request  = wp_remote_get( $url );
						$response = unserialize( wp_remote_retrieve_body( $request ) );

						$params['video_title']    = $response[0]['title'];
						$params['lightbox_thumb'] = $response[0]['thumbnail_large'];
						break;
					case 'youtube':
						$params['video_title'] = $media['title'];

						$params['lightbox_thumb'] = 'https://img.youtube.com/vi/' . trim( $media['video_id'] ) . '/sddefault.jpg';
						break;
				}
			}
		}

		$params['media'] = $media;

		sagen_core_get_cpt_single_module_template_part( 'templates/single/media/' . $media['type'], 'property', '', $params );
	}
}

if ( ! function_exists( 'sagen_core_compare_property_videos' ) ) {
	/**
	 * Function that compares two property image for sorting
	 *
	 * @param $a int first image
	 * @param $b int second image
	 *
	 * @return int result of comparison
	 */
	function sagen_core_compare_property_videos( $a, $b ) {
		if ( isset( $a['propertyimgordernumber'] ) && isset( $b['propertyimgordernumber'] ) ) {
			if ( $a['propertyimgordernumber'] == $b['propertyimgordernumber'] ) {
				return 0;
			}

			return ( $a['propertyimgordernumber'] < $b['propertyimgordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'sagen_core_compare_property_options' ) ) {
	/**
	 * Function that compares two property options for sorting
	 *
	 * @param $a int first option
	 * @param $b int second option
	 *
	 * @return int result of comparison
	 */
	function sagen_core_compare_property_options( $a, $b ) {
		if ( isset( $a['optionlabelordernumber'] ) && isset( $b['optionlabelordernumber'] ) ) {
			if ( $a['optionlabelordernumber'] == $b['optionlabelordernumber'] ) {
				return 0;
			}

			return ( $a['optionlabelordernumber'] < $b['optionlabelordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'sagen_core_get_property_single_related_posts' ) ) {
	/**
	 * Function for returning property single related posts
	 *
	 * @param $post_id
	 *
	 * @return WP_Query
	 */
	function sagen_core_get_property_single_related_posts( $post_id ) {
		//Get tags
		$tags = wp_get_object_terms( $post_id, 'property-tag' );

		//Get categories
		$categories = wp_get_object_terms( $post_id, 'property-category' );

		$tag_ids = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}

		$category_ids = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}

		$hasRelatedByTag = false;

		if ( $tag_ids ) {
			$related_by_tag = sagen_core_get_property_single_related_posts_by_param( $post_id, $tag_ids, 'property-tag' );

			if ( ! empty( $related_by_tag->posts ) ) {
				$hasRelatedByTag = true;

				return $related_by_tag;
			}
		}

		if ( $categories && ! $hasRelatedByTag ) {
			$related_by_category = sagen_core_get_property_single_related_posts_by_param( $post_id, $category_ids, 'property-category' );

			if ( ! empty( $related_by_category->posts ) ) {
				return $related_by_category;
			}
		}
	}
}

if ( ! function_exists( 'sagen_core_get_property_single_related_posts_by_param' ) ) {
	/**
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $taxonomy
	 *
	 * @return WP_Query
	 */
	function sagen_core_get_property_single_related_posts_by_param( $post_id, $term_ids, $taxonomy ) {
		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => '4',
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			),
		);

		$related_by_taxonomy = new WP_Query( $args );

		return $related_by_taxonomy;
	}
}

if ( ! function_exists( 'sagen_core_add_property_to_search_types' ) ) {
	function sagen_core_add_property_to_search_types( $post_types ) {

		$post_types['property-item'] = 'Property';

		return $post_types;
	}

	add_filter( 'sagen_select_search_post_type_widget_params_post_type', 'sagen_core_add_property_to_search_types' );
}

/**
 * Loads more function for property.
 */
if ( ! function_exists( 'sagen_core_property_ajax_load_more' ) ) {
	function sagen_core_property_ajax_load_more() {
		$shortcode_params = array();

		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );

					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}

		$port_list = new \SagenCore\CPT\Shortcodes\Property\PropertyList();

		$query_array                     = $port_list->getQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $port_list;

		$html = '';
		if ( $query_results->have_posts() ) :
			while ( $query_results->have_posts() ) :
				$query_results->the_post();
				$html .= sagen_core_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'property-item', $shortcode_params['item_style'], $shortcode_params );
			endwhile;
		else :
			$html .= sagen_core_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/posts-not-found', '', $shortcode_params );
		endif;

		wp_reset_postdata();

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_sagen_core_property_ajax_load_more', 'sagen_core_property_ajax_load_more' );
add_action( 'wp_ajax_sagen_core_property_ajax_load_more', 'sagen_core_property_ajax_load_more' );

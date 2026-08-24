<?php
namespace SagenCore\CPT\Shortcodes\ImageMapGallery;

use SagenCore\Lib;

class ImageMapGallery implements Lib\ShortcodeInterface {
	private $base;
	private $list;
	private $imp_instance;

	public function __construct() {
		$this->base         = 'qodef_image_map_gallery';
		$this->imp_instance = $this->getIMPInstance();
		$this->list         = $this->getIMPList();

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function getIMPInstance() {
		if ( class_exists( 'ImageMapPro_v6' ) ) {
			global $instance;
			if ( isset( $instance ) && is_a( $instance, 'ImageMapPro_v6' ) ) {
				$imp_instance = $instance;
			} else {
				$imp_instance = new \ImageMapPro_v6();
			}
			return $imp_instance;
		}

		return false;
	}

	public function getIMPList() {
		$imp_formatted = array();
		if ( $this->imp_instance ) {
			$imp_items = $this->imp_instance->storage->load_projects_as_objects();

			foreach ( $imp_items as $id => $item ) {
				$imp_formatted[ $id ] = $item->name;
			}
		}
		return $imp_formatted;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image Map Gallery', 'sagen-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
					'icon'                      => 'icon-wpb-image-map-gallery extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sagen-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sagen-core' ),
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'sagen-core' ),
							'description' => esc_html__( 'Select images from media library', 'sagen-core' ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'sagen-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'sagen-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'sagen-core' ),
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'sagen-core' ),
							'description' => esc_html__( 'Select image from media library', 'sagen-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link_360',
							'heading'    => esc_html__( 'Video Link 360', 'sagen-core' ),
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image_360',
							'heading'     => esc_html__( 'Video Image 360', 'sagen-core' ),
							'description' => esc_html__( 'Select image from media library', 'sagen-core' ),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_map',
							'value'       => array_flip( $this->list ),
							'heading'     => esc_html__( 'Image Map Name', 'sagen-core' ),
							'description' => esc_html__( 'Enter the name of the image map you have created.', 'sagen-core' ),
						),
					),
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'type'                    => 'carousel',
			'images'                  => '',
			'image_size'              => '',
			'video_link'              => '',
			'video_image'             => '',
			'video_link_360'          => '',
			'video_image_360'         => '',
			'number_of_visible_items' => '1',
			'slider_loop'             => 'no',
			'slider_autoplay'         => 'no',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_padding'          => 'no',
			'slider_navigation'       => 'no',
			'slider_pagination'       => 'yes',
			'image_map'               => '',
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['inner_classes']  = $this->getInnerClasses( $params, $args );
		$params['slider_data']    = $this->getSliderData( $params );
		if ( '' !== $params['image_map'] ) {
			$params['image_map_name']      = $this->getIMPName( $params['image_map'] );
			$params['image_map_shortcode'] = $this->getIMPShortcode( $params['image_map'] );
		}
		$params['images']     = $this->getGalleryImages( $params );
		$params['image_size'] = $this->getImageSize( $params );

		$html = sagen_core_get_shortcode_module_template_part( 'templates/image-map-gallery', 'image-map-gallery', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holder_classes = array();

		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holder_classes );
	}

	private function getInnerClasses( $params, $args ) {
		$holder_classes = array();

		return implode( ' ', $holder_classes );
	}

	private function getSliderData( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']        = '1';
		$slider_data['data-enable-loop']            = 'no';
		$slider_data['data-enable-autoplay']        = 'no';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = 'no';
		$slider_data['data-enable-pagination']      = 'yes';

		return $slider_data;
	}

	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;

		if ( '' !== $params['images'] ) {
			$image_ids = explode( ',', $params['images'] );
		}

		$counter      = 0;
		$image_shapes = $this->getIMPShapes( $params['image_map'] );

		foreach ( $image_ids as $id ) {

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

			if ( ! empty( $image_shapes[ $counter ] ) ) {
				$image['image_shape'] = $image_shapes[ $counter ];
				++$counter;
			} else {
				$image['image_shape'] = 'empty';
			}

			$images[ $i ] = $image;
			$i ++;
		}

		return $images;
	}

	private function getImageSize( $params ) {
		$image_size = trim( $params['image_size'] );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ), true ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1],
			);
		} else {
			return 'thumbnail';
		}
	}

	private function getIMPName( $imp_id ) {
		$name = '';

		if ( $this->imp_instance ) {
			$imp_instance = $this->imp_instance;
			$imp_storage  = $imp_instance->storage;
			$imp_items    = $imp_storage ? $imp_storage->load_projects_as_objects() : array();
			$imp_item     = ! empty( $imp_items ) && isset( $imp_items[ $imp_id ] ) ? $imp_items[ $imp_id ] : array();
			$name         = ! empty( $imp_item ) ? $imp_item->name : '';
		}

		return $name;
	}

	private function getIMPShortcode( $imp_id ) {
		$shortcode = '';

		if ( $this->imp_instance ) {
			$imp_instance = $this->imp_instance;
			$imp_storage  = $imp_instance->storage;
			$imp_items    = $imp_storage ? $imp_storage->load_projects_as_objects() : array();
			$imp_item     = ! empty( $imp_items ) && isset( $imp_items[ $imp_id ] ) ? $imp_items[ $imp_id ] : array();
			$shortcode    = ! empty( $imp_item ) ? $imp_item->shortcode : '';
			$shortcode    = ! empty( $shortcode ) ? '[' . $shortcode . ']' : '';
		}

		return $shortcode;
	}

	private function getIMPShapes( $imp_id ) {
		$spots_value = array();

		if ( $this->imp_instance ) {
			$imp_instance = $this->imp_instance;
			$imp_storage  = $imp_instance->storage;
			$imp_items    = $imp_storage ? $imp_storage->load_projects_as_objects() : array();
			$imp_item     = ! empty( $imp_items ) && isset( $imp_items[ $imp_id ] ) ? $imp_items[ $imp_id ] : array();

			//Get selected image map fragments
			$spots = $imp_item ? $imp_item->json : '';

			if ( ! empty( $spots ) ) {
				//Reformat fragments
				$spots = str_replace( "\n", '<br>', $spots ); // Replace new line characters with <br>
				$spots = str_replace( "\\n", '<br>', $spots ); // Replace new line characters with <br>
				$spots = str_replace( '\\"', '"', $spots ); // Replace \" with "
				$spots = str_replace( '\\"', '"', $spots ); // Replace \" with "
				$spots = str_replace( "\\'", "'", $spots ); // Replace \' with '
			}

			//Decode formatted fragments
			$spots_decoded = json_decode( $spots );

			//Get fragment ids
			$artboards   = $spots_decoded ? $spots_decoded->artboards : null;
			$spots_array = $artboards ? $artboards[ $imp_id ]->children : array();
			if ( count( (array) $spots_array ) > 1 ) {
				foreach ( $spots_array as $spot ) {
					$spots_value[] = $spot->title;
				}
			}
		}

		return $spots_value;
	}

}

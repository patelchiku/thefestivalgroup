<?php
namespace SagenCore\CPT\Shortcodes\VerticalCarousel;

use SagenCore\Lib;

class VerticalCarousel implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'qodef_vertical_carousel';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */
    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Interactive Swipe Slider', 'sagen-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
                    'icon'                      => 'icon-wpb-vertical-carousel extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
	                        'type'       => 'textfield',
	                        'param_name' => 'main_title',
	                        'heading'    => esc_html__('Title', 'sagen-core')
                        ),
                        array(
	                        'type'       => 'dropdown',
	                        'param_name' => 'main_title_tag',
	                        'heading'    => esc_html__( 'Title tag', 'sagen-core' ),
	                        'value'      => array_flip( sagen_select_get_title_tag( true ) )
                        ),
                        array(
	                        'type'       => 'textfield',
	                        'param_name' => 'main_subtitle',
	                        'heading'    => esc_html__('Subtitle', 'sagen-core')
                        ),
                        array(
	                        'type'       => 'textfield',
	                        'param_name' => 'bottom_title',
	                        'heading'    => esc_html__('Bottom Title', 'sagen-core')
                        ),
                        array(
                            'type'       => 'param_group',
                            'heading'    => esc_html__('Items', 'sagen-core'),
                            'param_name' => 'items',
                            'value'      => '',
                            'params'     => array(
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__('Image', 'sagen-core'),
                                    'description' => esc_html__('Select image from media library', 'sagen-core')
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'title',
                                    'heading'     => esc_html__('Title', 'sagen-core'),
                                    'admin_label' => true
                                )
                            )
                        ),
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'main_title'         => '',
	        'main_title_tag'     => 'h2',
	        'main_subtitle'      => '',
	        'bottom_title'       => '',
	        'items'              => '',
        );

        $params = shortcode_atts($args, $atts);
        $params['content'] = $content;
        $params['items'] = json_decode(urldecode($params['items']), true);

        $html = sagen_core_get_shortcode_module_template_part('templates/vertical-carousel-template', 'vertical-carousel', '', $params);

        return $html;
    }
}
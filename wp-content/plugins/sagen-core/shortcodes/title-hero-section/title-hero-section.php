<?php
namespace SagenCore\CPT\Shortcodes\TitleHeroSection;

use SagenCore\Lib;

class TitleHeroSection implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'qodef_title_hero_section';

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
                    'name'                      => esc_html__('Title Hero Section', 'sagen-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
                    'icon'                      => 'icon-wpb-title-hero-section extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
	                        'type'       => 'textfield',
	                        'param_name' => 'main_title',
	                        'heading'    => esc_html__('Title', 'sagen-core')
                        ),
                        array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_bottom_underline',
							'heading'     => esc_html__( 'Enable Bottom Underline', 'sagen-core' ),
							'value'       => array_flip( sagen_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true
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
	        'main_title'               => '',
	        'enable_bottom_underline'  => 'yes'
        );

        $params = shortcode_atts($args, $atts);
        $params['content'] = $content;

        $html = sagen_core_get_shortcode_module_template_part('templates/title-hero-section-template', 'title-hero-section', '', $params);

        return $html;
    }
}
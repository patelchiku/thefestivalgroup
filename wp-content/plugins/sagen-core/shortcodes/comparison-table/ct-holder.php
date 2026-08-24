<?php

namespace SagenCore\CPT\Shortcodes\ComparisonTable;

use SagenCore\Lib;

class ComparisonTableHolder implements Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonTablesHolder constructor.
     */
    public function __construct() {
        $this->base = 'qodef_comparison_table_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Comparison Table', 'sagen-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'qodef_comparison_item'),
            'content_element'         => true,
            'category'                => 'by SAGEN',
            'icon'                    => 'icon-wpb-cmp-table extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Title', 'sagen-core'),
                    'param_name'  => 'title',
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'exploded_textarea',
                    'heading'     => esc_html__('Features', 'sagen-core'),
                    'param_name'  => 'features',
                    'value'       => '',
                    'save_always' => true,
                    'description' => esc_html__('Enter features. Separate each features with new line (enter).', 'sagen-core')
                ),
            ),
            'js_view'                 => 'VcColumnView'
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'features'     => '',
            'title'        => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['features'] = $this->getFeaturesArray($params);
        $params['content'] = $content;
        $params['holder_classes'] = $this->getHolderClasses($params);

        return sagen_core_get_shortcode_module_template_part('templates/ct-holder-template', 'comparison-table', '', $params);
    }

    private function getFeaturesArray($params) {
        $features = array();

        if (!empty($params['features'])) {
            $features = explode(',', $params['features']);
        }

        return $features;
    }

    private function getHolderClasses($params) {
        $classes = array('qodef-comparision-table-holder');

        return $classes;
    }
}
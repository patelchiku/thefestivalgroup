<?php

namespace SagenCore\CPT\Shortcodes\ComparisonTable;

use SagenCore\Lib;

class ComparisonItem implements Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonTable constructor.
     */
    public function __construct() {
        $this->base = 'qodef_comparison_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Comparison Item', 'sagen-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-cmp-item extended-custom-icon',
            'category'                  => 'by SAGEN',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'qodef_comparison_table_holder'),
            'params'                    => array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Title', 'sagen-core'),
					'param_name'  => 'title',
					'value'       => esc_html__('Basic Plan', 'sagen-core'),
					'description' => ''
				),
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Content', 'sagen-core'),
					'param_name'  => 'content',
					'value'       => '<li>' . esc_html__('content content content', 'sagen-core') . '</li><li>' . esc_html__('content content content', 'sagen-core') . '</li><li>' . esc_html__('content content content', 'sagen-core') . '</li>',
					'description' => '',
					'admin_label' => false
				),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'title'            => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['content'] = $content;
        $params['table_classes'] = $this->getTableClasses($params);

        return sagen_core_get_shortcode_module_template_part('templates/ct-item-template', 'comparison-table', '', $params);
    }

    private function getTableClasses($params) {
        $classes = array('qodef-comparision-item-holder', 'qodef-ct-table');

        return $classes;
    }
}
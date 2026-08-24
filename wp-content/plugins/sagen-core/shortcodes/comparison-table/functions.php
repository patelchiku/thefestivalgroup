<?php

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Qodef_Comparison_Table_Holder extends WPBakeryShortCodesContainer
    {
    }
}

if (!function_exists('sagen_core_add_comparison_table_shortcodes')) {
    function sagen_core_add_comparison_table_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'SagenCore\CPT\Shortcodes\ComparisonTable\ComparisonTableHolder',
            'SagenCore\CPT\Shortcodes\ComparisonTable\ComparisonItem'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('sagen_core_filter_add_vc_shortcode', 'sagen_core_add_comparison_table_shortcodes');
}

if (!function_exists('sagen_core_set_comparison_table_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for animation holder shortcode to set our icon for Visual Composer shortcodes panel
     */
    function sagen_core_set_comparison_table_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-cmp-table';
        $shortcodes_icon_class_array[] = '.icon-wpb-cmp-item';

        return $shortcodes_icon_class_array;
    }

    add_filter('sagen_core_filter_add_vc_shortcodes_custom_icon_class', 'sagen_core_set_comparison_table_icon_class_name_for_vc_shortcodes');
}
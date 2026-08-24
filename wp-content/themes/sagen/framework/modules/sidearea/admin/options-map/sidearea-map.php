<?php

if ( ! function_exists( 'sagen_select_sidearea_options_map' ) ) {
	function sagen_select_sidearea_options_map() {

        sagen_select_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'sagen'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = sagen_select_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'sagen'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'sagen'),
                'description'   => esc_html__('Active Type', 'sagen'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'sagen')
                ),
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'sagen'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'sagen'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = sagen_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'sagen'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'sagen'),
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'sagen'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'sagen'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'predefined',
                'label'         => esc_html__('Select Side Area Icon Source', 'sagen'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'sagen'),
                'options'       => sagen_select_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = sagen_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'sagen'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'sagen'),
                'options'       => sagen_select_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = sagen_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'sagen'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'sagen'),
            )
        );

        $side_area_icon_style_group = sagen_select_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'sagen'),
                'description' => esc_html__('Define styles for Side Area icon', 'sagen')
            )
        );

        $side_area_icon_style_row1 = sagen_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'sagen')
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'sagen')
            )
        );

        $side_area_icon_style_row2 = sagen_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'sagen'),
                'description' => esc_html__('Choose a background color for Side Area', 'sagen')
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'sagen'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'sagen'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        sagen_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'sagen'),
                'description'   => esc_html__('Choose text alignment for side area', 'sagen'),
                'options'       => array(
                    ''       => esc_html__('Default', 'sagen'),
                    'left'   => esc_html__('Left', 'sagen'),
                    'center' => esc_html__('Center', 'sagen'),
                    'right'  => esc_html__('Right', 'sagen')
                )
            )
        );
    }

    add_action('sagen_select_action_options_map', 'sagen_select_sidearea_options_map', sagen_select_set_options_map_position( 'sidearea' ) );
}
<div class="qodef-container">
    <div class="qodef-container-inner clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="qodef-property-single-holder <?php echo esc_attr($holder_classes); ?>">
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {
                    do_action('sagen_select_property_page_before_content');
                
                    sagen_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'property', '', $params);
                
                    do_action('sagen_select_property_page_after_content');
                
                    sagen_core_get_cpt_single_module_template_part('templates/single/parts/navigation', 'property', $item_layout);
                
                    sagen_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'property');
                } ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>
<?php $categories = wp_get_post_terms($selected_project, 'property-category'); ?>

<div class="qodef-property-info-text-holder <?php echo esc_attr($holder_classes); ?>">
    <?php
    if($query_results->have_posts()):
        while ( $query_results->have_posts() ) : $query_results->the_post();
            ?>
            <div class="qodef-property-info-text-item">
                <div class="qodef-pit-main-content">
                    <div class="qodef-pit-category-holder">
                        <?php echo sagen_select_execute_shortcode('qodef_svg_separator', array()); ?>
                            <?php foreach ($categories as $cat) { ?>
                                <a itemprop="url" class="qodef-pit-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                            <?php } ?>
                        <?php echo sagen_select_execute_shortcode('qodef_svg_separator', array()); ?>
                    </div>
                    <div class="qodef-pit-title-holder">
                        <<?php echo sagen_select_escape_title_tag($title_tag); ?> itemprop="name" class="qodef-pit-title entry-title" <?php sagen_select_inline_style($title_styles); ?>>
                            <?php echo esc_attr(get_the_title()); ?>
                        </<?php echo sagen_select_escape_title_tag($title_tag); ?>>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    else:
        echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/posts-not-found');
    endif;
    wp_reset_postdata();
    ?>
</div>

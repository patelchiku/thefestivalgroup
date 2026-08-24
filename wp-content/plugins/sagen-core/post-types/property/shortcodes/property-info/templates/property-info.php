<div class="qodef-property-info-holder  <?php echo esc_attr( $holder_classes ); ?>">
    <?php
        if($query_results->have_posts()):
            while ( $query_results->have_posts() ) : $query_results->the_post();
    ?>
                <div class="qodef-property-info-item">
                    <div class="qodef-pi-main-content">
                        <div class="qodef-pi-text">
                            <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/title', '', $params); ?>

							<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/separator', '', $params); ?>

                            <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/excerpt', '', $params); ?>

							<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/feature-items', '', $params); ?>

							<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/read-more', '', $params); ?>
                        </div>
                            <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-info', 'parts/image', '', $params); ?>
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

<div class="qodef-pli-image-holder" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>')">
    <div class="qodef-pli-text-holder">
        <div class="qodef-pli-text-wrapper">
            <div class="qodef-pli-text">
                <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/category', $item_style, $params); ?>

                <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/title', $item_style, $params); ?>

                <?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/excerpt', $item_style, $params); ?>

            </div>

        </div>
    </div>
</div>


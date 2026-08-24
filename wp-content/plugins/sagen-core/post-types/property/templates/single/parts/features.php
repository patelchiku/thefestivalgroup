<?php

$features_array = array();
$images   = get_post_meta(get_the_ID(), 'qodef_property_feature_image', true);
$titles   = get_post_meta(get_the_ID(), 'qodef_property_feature_title', true);
$excerpts = get_post_meta(get_the_ID(), 'qodef_property_feature_description', true);


$i = 0;

if($titles){
    foreach($titles as $title){


        if(isset($images[$i])){
            $features_array[$i]['image'] = sagen_select_get_attachment_id_from_url($images[$i]);
        }

        if(isset($titles[$i])){
            $features_array[$i]['title'] = $title;
        }

        if(isset($excerpts[$i])){
            $features_array[$i]['excerpt']	= $excerpts[$i];
        }

        $i++;
    }
}
?>

<div class="qodef-ps-feature-holder qodef-grid-row">
    <?php foreach($features_array as $feature): ?>
        <div class="qodef-ps-feature-item qodef-grid-col-3">
            <div class="qodef-psfi-image">
                <?php echo wp_get_attachment_image($feature['image']); ?>
            </div>
            <div class="qodef-psfi-content">
                <h3 class="qodef-psfi-title">
                    <?php echo esc_html($feature['title']) ?>
                </h3>
                <div class="qodef-psfi-excerpt">
                    <?php echo esc_html($feature['excerpt']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


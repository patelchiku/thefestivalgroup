<?php
$i = 1;
?>

<div <?php sagen_select_class_attribute($ips_classes); ?>>
    <div class="qodef-ips-holder">
        <?php if($query_results->have_posts()) { ?>
            <div class="qodef-ips-content-holder">
                <div class="qodef-ips-content-table">
                    <div class="qodef-ips-content-table-cell">
                    <?php while ( $query_results->have_posts() ) : $query_results->the_post(); ?>
                            <div class="qodef-ips-item-content item-<?php echo esc_attr($i++); ?>">
                                <a class="qodef-ips-item-link" itemprop="url" target="<?php echo esc_attr($target); ?>" href="<?php echo get_the_permalink(); ?>" <?php echo sagen_select_get_inline_style($text_style); ?>>
                                    <?php echo get_the_title();?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
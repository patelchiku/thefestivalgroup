<div class="qodef-comment-form-rating">
    <label><?php echo esc_html($label); ?><span class="required">*</span></label>
    <span class="qodef-comment-rating-box">
        <?php for ( $i = 1; $i <= SAGEN_CORE_REVIEWS_MAX_RATING; $i ++ ) { ?>
            <span class="qodef-star-rating" data-value="<?php echo esc_attr( $i ); ?>"></span>
        <?php } ?>
        <input type="hidden" name="<?php echo esc_attr($key); ?>" class="qodef-rating" value="3">
    </span>
</div>
<div class="qodef-top-reviews-carousel-item">
	<h4 class="qodef-top-reviews-item-title">
		<a href="<?php echo esc_url( $post_link ); ?>"><?php echo esc_html( $post_title ); ?></a>
	</h4>
	<div class="qodef-tour-reviews-criteria-holder">
		<div class="qodef-tour-reviews-criteria-holder-inner">
			<?php if ( isset( $review_value ) ) { ?>
				<span class="qodef-tour-reviews-rating-holder">
                    <?php for ( $i = 0; $i < SAGEN_CORE_REVIEWS_MAX_RATING; $i ++ ) : ?>
	                    <?php
	                    $is_empty_star = $i >= $review_value;
	                    $star_class    = $is_empty_star ? 'icon_star_alt' : 'icon_star';
	                    ?>
	                    <span class="qodef-tour-reviews-star-holder">
                            <span class="qodef-tour-reviews-star <?php echo esc_attr( $star_class ); ?>"></span>
                        </span>
                    <?php endfor; ?>
                </span>
			<?php } ?>
		</div>
	</div>
	<div class="qodef-top-reviews-item-content">
		<?php echo esc_html( $comment_text ); ?>
	</div>
	<div class="qodef-top-reviews-item-author-info">
        <span class="qodef-top-reviews-item-author-avatar">
            <?php echo get_avatar( $auhtor_email, 54 ); ?>
        </span>
		<h5 class="qodef-top-reviews-item-author-name">
			<?php echo get_comment_author_link( $comment_id ); ?>
		</h5>
	</div>
</div>
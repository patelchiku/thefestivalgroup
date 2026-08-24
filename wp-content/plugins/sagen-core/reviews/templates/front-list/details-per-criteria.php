<?php if ( is_array( $post_ratings ) && count( $post_ratings ) ) { ?>
	<?php $average_rating_total = sagen_core_get_total_average_rating( $post_ratings ); ?>
	<div class="qodef-reviews-list-info qodef-reviews-per-criteria">
		<div class="qodef-item-reviews-display-wrapper clearfix">
			<?php if ( ! empty( $title ) ) { ?>
				<h3 class="qodef-item-review-title"><?php echo esc_html( $title ); ?></h3>
			<?php } ?>
			
			<?php if ( ! empty( $subtitle ) ) { ?>
				<p class="qodef-item-review-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php } ?>
			
			<div class="qodef-grid-row">
				<div class="qodef-grid-col-3">
					<div class="qodef-item-reviews-average-wrapper">
						<div class="qodef-item-reviews-average-rating">
							<?php echo esc_html( sagen_core_reviews_format_rating_output( $average_rating_total ) ); ?>
						</div>
						<div class="qodef-item-reviews-verbal-description">
							<span class="qodef-item-reviews-rating-icon">
								<?php echo sagen_core_reviews_get_icon_for_rating( $average_rating_total ); ?>
							</span>
							<span class="qodef-item-reviews-rating-description">
								<?php echo esc_html( sagen_core_reviews_get_description_for_rating( $average_rating_total ) ); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="qodef-grid-col-9">
					<div class="qodef-rating-percentage-wrapper">
						<?php
						foreach ( $post_ratings as $rating ) {
							$percentage = sagen_core_post_average_rating_per_criteria( $rating );
							echo do_shortcode( '[qodef_progress_bar percent="' . esc_attr( $percentage ) . '" title="' . esc_attr( $rating['label'] ) . '"]' );
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

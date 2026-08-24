<div class="qodef-top-reviews-carousel-holder">
	<?php if ( is_array( $reviews ) && count( $reviews ) ) : ?>
		<div class="qodef-top-reviews-carousel-inner">
			<?php if ( ! empty( $title ) ) { ?>
				<h3 class="qodef-top-reviews-carousel-title"><?php echo esc_html( $title ); ?></h3>
			<?php } ?>
			
			<div class="qodef-top-reviews-carousel qodef-owl-slider">
				<?php
				foreach ( $reviews as $review ) {
					$params['comment'] = $review;
					$item_params       = $this_shortcode->generateItemParams( $params );
					echo sagen_core_get_module_shortcode_template_part( 'reviews', 'top-reviews-carousel', 'top-reviews-carousel-item', '', $item_params );
				}
				?>
			</div>
		</div>
	<?php endif; ?>
</div>

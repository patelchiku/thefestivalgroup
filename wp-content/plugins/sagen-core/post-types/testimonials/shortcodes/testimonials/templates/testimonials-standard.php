<div class="qodef-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-testimonials" <?php echo sagen_select_get_inline_attrs( $data_attr ) ?>>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php if ( $query_results->have_posts() ):
					while ( $query_results->have_posts() ) : $query_results->the_post();
						$text     = get_post_meta( get_the_ID(), 'qodef_testimonial_text', true );
						$author   = get_post_meta( get_the_ID(), 'qodef_testimonial_author', true );
						$position = get_post_meta( get_the_ID(), 'qodef_testimonial_author_position', true );
						$company  = get_post_meta( get_the_ID(), 'qodef_testimonial_company', true );

						$current_id = get_the_ID();
						?>

						<div class="qodef-testimonial-content swiper-slide" id="qodef-testimonials-<?php echo esc_attr( $current_id ) ?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="qodef-testimonial-image">
									<?php echo get_the_post_thumbnail( get_the_ID(), array( 153, 153 ) ); ?>
								</div>
							<?php } ?>
							<div class="qodef-testimonial-text-holder">
								<?php if ( ! empty( $text ) ) { ?>
									<p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
								<?php } ?>
								<?php if ( ! empty( $author ) ) { ?>
									<p class="qodef-testimonials-author-name"><?php echo esc_html( $author ); ?></p>
									<?php if ( ! empty( $position ) ) { ?>
										<p class="qodef-testimonials-author-job"><?php echo esc_html( $position ); ?></p>
									<?php } ?>
								<?php } ?>
							</div>
						</div>

					<?php
					endwhile;
				else:
					echo esc_html__( 'Sorry, no posts matched your criteria.', 'vibra-core' );
				endif;

				wp_reset_postdata();
				?>
			</div>
		</div>
		<span class="swiper-pagination qodef-testimonials-pag"></span>
	</div>
</div>
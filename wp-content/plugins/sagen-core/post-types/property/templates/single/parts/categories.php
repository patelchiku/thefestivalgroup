<?php if ( sagen_select_options()->getOptionValue( 'property_single_enable_categories' ) === 'yes' ) : ?>
	<?php
	$categories = wp_get_post_terms( get_the_ID(), 'property-category' );
	if ( is_array( $categories ) && count( $categories ) ) :
		?>
		<div class="qodef-ps-info-item qodef-ps-categories">
			<h4 class="qodef-ps-info-title"><?php esc_html_e( 'Category:', 'sagen-core' ); ?></h4>
			<?php foreach ( $categories as $cat ) { ?>
				<a itemprop="url" class="qodef-ps-info-category" href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
			<?php } ?>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php
$custom_fields = get_post_meta( get_the_ID(), 'mkd_propertys', true );

if ( is_array( $custom_fields ) && count( $custom_fields ) ) :
	usort( $custom_fields, 'sagen_core_compare_property_options' );
	foreach ( $custom_fields as $custom_field ) : ?>
		<div class="qodef-ps-info-item qodef-ps-custom-field">
			<?php if ( ! empty( $custom_field['optionLabel'] ) ) : ?>
				<h4 class="qodef-ps-info-title"><?php echo esc_html( $custom_field['optionLabel'] . ':' ); ?></h4>
			<?php endif; ?>
			<p>
				<?php
				if ( ! empty( $custom_field['optionUrl'] ) ) :
					?>
					<a itemprop="url" href="<?php echo esc_url( $custom_field['optionUrl'] ); ?>"><?php endif; ?>
					<?php echo esc_html( $custom_field['optionValue'] ); ?>
				<?php
				if ( ! empty( $custom_field['optionUrl'] ) ) :
					?>
					</a><?php endif; ?>
			</p>
		</div>
	<?php endforeach; ?>
<?php endif; ?>

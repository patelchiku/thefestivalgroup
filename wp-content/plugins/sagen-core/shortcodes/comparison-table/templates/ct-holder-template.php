<?php if ( is_array( $features ) && count( $features ) ) : ?>
	<div <?php sagen_select_class_attribute( $holder_classes ); ?>>

		<span class="qodef-ct-swipe">
			<i class="qodef-icon-ion-icon ion-ios-arrow-back"></i>
			<i class="qodef-icon-ion-icon ion-ios-arrow-back"></i>
			<i class="qodef-icon-ion-icon ion-ios-arrow-back"></i>
			<?php esc_html_e( 'SWIPE', 'sagen' ); ?>
			<i class="qodef-icon-ion-icon ion-ios-arrow-forward"></i>
			<i class="qodef-icon-ion-icon ion-ios-arrow-forward"></i>
			<i class="qodef-icon-ion-icon ion-ios-arrow-forward"></i>
		</span>

		<div class="qodef-ct-features-holder qodef-ct-table">

			<div class="qodef-ct-features-title-holder qodef-ct-table-head-holder">
				<div class="qodef-ct-table-head-holder-inner">
					<h6 class="qodef-ct-features-title"><?php echo wp_kses_post( preg_replace( '#^<\/p>|<p>$#', '', $title ) ); ?></h6>
				</div>
			</div>

			<div class="qodef-ct-features-list-holder qodef-ct-table-content">
				<ul class="qodef-ct-features-list">
					<?php foreach ( $features as $feature ) : ?>
						<li class="qodef-ct-features-item"><h6><?php echo esc_html( $feature ); ?></h6></li>
					<?php endforeach; ?>
				</ul>
			</div>

		</div>
		<?php echo do_shortcode( $content ); ?>
	</div>
<?php endif; ?>

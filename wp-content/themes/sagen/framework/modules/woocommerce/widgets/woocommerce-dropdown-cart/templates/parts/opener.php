<a itemprop="url" <?php sagen_select_class_attribute( sagen_select_get_dropdown_cart_icon_class() ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-sc-opener-icon">
		<?php echo sagen_select_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?>
		<span class="qodef-sc-opener-count"><?php echo WC()->cart->cart_contents_count; ?></span>
	</span>
</a>
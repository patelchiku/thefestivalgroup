<?php sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/opener', 'woocommerce' ); ?>
<div class="qodef-sc-dropdown">
	<div class="qodef-sc-dropdown-inner">
		<?php if ( ! WC()->cart->is_empty() ) {
			sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/loop', 'woocommerce' );
			
			sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/order-details', 'woocommerce' );
			
			sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/button', 'woocommerce' );
		} else {
			sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/posts-not-found', 'woocommerce' );
		} ?>
	</div>
</div>
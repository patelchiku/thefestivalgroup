<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassWoocommerceDropdownCart extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_woocommerce_dropdown_cart',
				esc_html__('Sagen Woocommerce Dropdown Cart', 'sagen'),
				array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'sagen'),)
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'        => 'textfield',
					'name'        => 'woocommerce_dropdown_cart_margin',
					'title'       => esc_html__('Icon Margin', 'sagen'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'sagen')
				)
			);
		}
		
		public function widget( $args, $instance ) {
		// Prevent widgets from loading on WooCommerce cart page
		if ( !class_exists( 'WooCommerce' ) || ( function_exists( 'is_cart' ) && is_cart() ) ) {
			return;
		}
			$icon_styles = array();
			
			if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
				$icon_styles[] = 'margin: ' . $instance['woocommerce_dropdown_cart_margin'];
			}
			?>
			<div class="qodef-shopping-cart-holder" <?php sagen_select_inline_style( $icon_styles ) ?>>
				<div class="qodef-shopping-cart-inner">
					<?php sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'sagen_select_woocommerce_header_add_to_cart_fragment' ) ) {
	function sagen_select_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="qodef-shopping-cart-inner">
			<?php sagen_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
		</div>
		
		<?php
		$fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();
		
		return $fragments;
	}
	
	add_filter( 'woocommerce_add_to_cart_fragments', 'sagen_select_woocommerce_header_add_to_cart_fragment' );
}
?>
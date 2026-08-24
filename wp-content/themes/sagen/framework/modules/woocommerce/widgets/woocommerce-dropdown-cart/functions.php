<?php

if ( ! function_exists( 'sagen_select_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function sagen_select_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'sagen_select_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function sagen_select_get_dropdown_cart_icon_class() {
		$classes = array(
			'qodef-header-cart'
		);
		
		$classes[] = sagen_select_get_icon_sources_class( 'dropdown_cart', 'qodef-header-cart' );
		
		return implode( ' ', $classes );
	}
}
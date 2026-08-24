<?php

if ( ! function_exists( 'sagen_select_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function sagen_select_dropdown_cart_icon_styles() {
		$icon_color       = sagen_select_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = sagen_select_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_dropdown_cart_icon_styles' );
}
<?php

if ( ! function_exists( 'sagen_select_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function sagen_select_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = sagen_select_options()->getOptionValue( 'footer_top_background_color' );
		$border_color     = sagen_select_options()->getOptionValue( 'footer_top_border_color' );
		$border_width     = sagen_select_options()->getOptionValue( 'footer_top_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = sagen_select_filter_px( $border_width ) . 'px';
		}
		
		echo sagen_select_dynamic_css( '.qodef-page-footer .qodef-footer-top-holder', $item_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_footer_top_general_styles' );
}

if ( ! function_exists( 'sagen_select_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function sagen_select_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = sagen_select_options()->getOptionValue( 'footer_bottom_background_color' );
		$border_color     = sagen_select_options()->getOptionValue( 'footer_bottom_border_color' );
		$border_width     = sagen_select_options()->getOptionValue( 'footer_bottom_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = sagen_select_filter_px( $border_width ) . 'px';
		}
		
		echo sagen_select_dynamic_css( '.qodef-page-footer .qodef-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_footer_bottom_general_styles' );
}
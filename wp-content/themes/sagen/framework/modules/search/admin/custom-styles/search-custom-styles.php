<?php

if ( ! function_exists( 'sagen_select_search_opener_icon_size' ) ) {
	function sagen_select_search_opener_icon_size() {
		$icon_size = sagen_select_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo sagen_select_dynamic_css( '.qodef-search-opener', array(
				'font-size' => sagen_select_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_search_opener_icon_size' );
}

if ( ! function_exists( 'sagen_select_search_opener_icon_colors' ) ) {
	function sagen_select_search_opener_icon_colors() {
		$icon_color       = sagen_select_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = sagen_select_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_search_opener_icon_colors' );
}

if ( ! function_exists( 'sagen_select_search_opener_text_styles' ) ) {
	function sagen_select_search_opener_text_styles() {
		$item_styles = sagen_select_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.qodef-search-icon-text'
		);
		
		echo sagen_select_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = sagen_select_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_search_opener_text_styles' );
}
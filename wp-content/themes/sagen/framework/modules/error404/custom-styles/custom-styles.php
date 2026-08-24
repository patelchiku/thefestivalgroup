<?php

if ( ! function_exists( 'sagen_select_404_header_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 header area
	 */
	function sagen_select_404_header_general_styles() {
		$background_color        = sagen_select_options()->getOptionValue( '404_menu_area_background_color_header' );
		$background_transparency = sagen_select_options()->getOptionValue( '404_menu_area_background_transparency_header' );
		
		$header_styles = array();
		$menu_selector = array(
			'.error404 .qodef-page-header .qodef-menu-area'
		);
		
		if ( ! empty( $background_color ) ) {
			$header_styles['background-color']        = $background_color;
			$header_styles['background-transparency'] = 1;
			
			if ( $background_transparency !== '' ) {
				$header_styles['background-transparency'] = $background_transparency;
			}
			
			echo sagen_select_dynamic_css( $menu_selector, array( 'background-color' => sagen_select_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$header_styles['background-color']        = '#fff';
			$header_styles['background-transparency'] = $background_transparency;
			
			echo sagen_select_dynamic_css( $menu_selector, array( 'background-color' => sagen_select_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		$border_color = sagen_select_options()->getOptionValue( '404_menu_area_border_color_header' );
		
		$menu_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$menu_styles['border-color'] = $border_color;
		}
		
		echo sagen_select_dynamic_css( $menu_selector, $menu_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_404_header_general_styles' );
}

if ( ! function_exists( 'sagen_select_404_page_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 page
	 */
	function sagen_select_404_page_general_styles() {
		$background_color         = sagen_select_options()->getOptionValue( '404_page_background_color' );
		$background_image         = sagen_select_options()->getOptionValue( '404_page_background_image' );
		$pattern_background_image = sagen_select_options()->getOptionValue( '404_page_background_pattern_image' );
		
		$item_styles = array();
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $background_image ) ) {
			$item_styles['background-image']    = 'url(' . $background_image . ')';
			$item_styles['background-position'] = 'center 0';
			$item_styles['background-size']     = 'cover';
			$item_styles['background-repeat']   = 'no-repeat';
		}
		
		if ( ! empty( $pattern_background_image ) ) {
			$item_styles['background-image']    = 'url(' . $pattern_background_image . ')';
			$item_styles['background-position'] = '0 0';
			$item_styles['background-repeat']   = 'repeat';
		}
		
		$item_selector = array(
			'.error404 .qodef-content'
		);
		
		echo sagen_select_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_404_page_general_styles' );
}

if ( ! function_exists( 'sagen_select_404_title_styles' ) ) {
	/**
	 * Generates styles for 404 page title
	 */
	function sagen_select_404_title_styles() {
		$item_styles = sagen_select_get_typography_styles( '404_title' );
		
		$item_selector = array(
			'.error404 .qodef-page-not-found .qodef-404-title'
		);
		
		echo sagen_select_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_404_title_styles' );
}

if ( ! function_exists( 'sagen_select_404_title_styles_responsive' ) ) {
    function sagen_select_404_title_styles_responsive() {
        $selector = array(
            '.error404 .qodef-page-not-found .qodef-404-title'
        );

        $styles = sagen_select_get_responsive_typography_styles( '404_title_responsive' );

        if ( ! empty( $styles ) ) {
            echo sagen_select_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'sagen_select_action_style_dynamic_responsive_680', 'sagen_select_404_title_styles_responsive' );
}

if ( ! function_exists( 'sagen_select_404_text_styles' ) ) {
	/**
	 * Generates styles for 404 page text
	 */
	function sagen_select_404_text_styles() {
		$item_styles = sagen_select_get_typography_styles( '404_text' );
		
		$item_selector = array(
			'.error404 .qodef-page-not-found .qodef-404-text'
		);
		
		echo sagen_select_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_404_text_styles' );
}

if ( ! function_exists( 'sagen_select_404_text_styles_responsive' ) ) {
    function sagen_select_404_text_styles_responsive() {
        $selector = array(
            '.error404 .qodef-page-not-found .qodef-404-text'
        );

        $styles = sagen_select_get_responsive_typography_styles( '404_text_responsive' );

        if ( ! empty( $styles ) ) {
            echo sagen_select_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'sagen_select_action_style_dynamic_responsive_680', 'sagen_select_404_text_styles_responsive' );
}
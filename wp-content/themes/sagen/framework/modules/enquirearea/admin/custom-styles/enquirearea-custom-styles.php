<?php

if ( ! function_exists( 'sagen_select_enquire_area_slide_from_right_type_style' ) ) {
	function sagen_select_enquire_area_slide_from_right_type_style() {
		
		if ( sagen_select_options()->getOptionValue( 'enquire_area_type' ) == 'enquire-menu-slide-from-right' ) {
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_width' ) !== '' ) {
				echo sagen_select_dynamic_css( '.qodef-enquire-menu-slide-from-right .qodef-enquire-menu', array(
					'right' => '-' . sagen_select_options()->getOptionValue( 'enquire_area_width' ),
					'width' => sagen_select_options()->getOptionValue( 'enquire_area_width' )
				) );
			}
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_content_overlay_color' ) !== '' ) {
				
				echo sagen_select_dynamic_css( '.qodef-enquire-menu-slide-from-right .qodef-wrapper .qodef-cover', array(
					'background-color' => sagen_select_options()->getOptionValue( 'enquire_area_content_overlay_color' )
				) );
			}
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_content_overlay_opacity' ) !== '' ) {
				
				echo sagen_select_dynamic_css( '.qodef-enquire-menu-slide-from-right.qodef-right-enquire-menu-opened .qodef-wrapper .qodef-cover', array(
					'opacity' => sagen_select_options()->getOptionValue( 'enquire_area_content_overlay_opacity' )
				) );
			}
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_enquire_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'sagen_select_enquire_area_slide_with_content_type_style' ) ) {
	function sagen_select_enquire_area_slide_with_content_type_style() {
		
		if ( sagen_select_options()->getOptionValue( 'enquire_area_type' ) == 'enquire-menu-slide-with-content' ) {
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_width' ) !== '' ) {
				echo sagen_select_dynamic_css( '.qodef-enquire-menu-slide-with-content .qodef-enquire-menu', array(
					'right' => '-' . sagen_select_options()->getOptionValue( 'enquire_area_width' ),
					'width' => sagen_select_options()->getOptionValue( 'enquire_area_width' )
				) );
				
				$enquire_menu_open_classes = array(
					'.qodef-enquire-menu-slide-with-content.qodef-enquire-menu-open .qodef-wrapper',
					'.qodef-enquire-menu-slide-with-content.qodef-enquire-menu-open footer.uncover',
					'.qodef-enquire-menu-slide-with-content.qodef-enquire-menu-open .qodef-sticky-header',
					'.qodef-enquire-menu-slide-with-content.qodef-enquire-menu-open .qodef-fixed-wrapper',
					'.qodef-enquire-menu-slide-with-content.qodef-enquire-menu-open .qodef-mobile-header-inner',
				);
				
				echo sagen_select_dynamic_css( $enquire_menu_open_classes, array(
					'left' => '-' . sagen_select_options()->getOptionValue( 'enquire_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_enquire_area_slide_with_content_type_style' );
}

if ( ! function_exists( 'sagen_select_enquire_area_uncovered_from_content_type_style' ) ) {
	function sagen_select_enquire_area_uncovered_from_content_type_style() {
		
		if ( sagen_select_options()->getOptionValue( 'enquire_area_type' ) == 'enquire-area-uncovered-from-content' ) {
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_width' ) !== '' ) {
				echo sagen_select_dynamic_css( '.qodef-enquire-area-uncovered-from-content .qodef-enquire-menu', array(
					'width' => sagen_select_options()->getOptionValue( 'enquire_area_width' )
				) );
				
				$enquire_menu_open_classes = array(
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened .qodef-wrapper',
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened footer.uncover',
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened .qodef-sticky-header',
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened .qodef-fixed-wrapper.fixed',
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened .qodef-mobile-header-inner',
					'.qodef-enquire-area-uncovered-from-content.qodef-right-enquire-menu-opened .mobile-header-appear .qodef-mobile-header-inner',
				);
				
				echo sagen_select_dynamic_css( $enquire_menu_open_classes, array(
					'left' => '-' . sagen_select_options()->getOptionValue( 'enquire_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_enquire_area_uncovered_from_content_type_style' );
}

if ( ! function_exists( 'sagen_select_enquire_area_icon_color_styles' ) ) {
	function sagen_select_enquire_area_icon_color_styles() {
		$icon_color             = sagen_select_options()->getOptionValue( 'enquire_area_icon_color' );
		$icon_hover_color       = sagen_select_options()->getOptionValue( 'enquire_area_icon_hover_color' );
		$close_icon_color       = sagen_select_options()->getOptionValue( 'enquire_area_close_icon_color' );
		$close_icon_hover_color = sagen_select_options()->getOptionValue( 'enquire_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.qodef-enquire-menu-button-opener:hover',
			'.qodef-enquire-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-enquire-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo sagen_select_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-enquire-menu a.qodef-close-enquire-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo sagen_select_dynamic_css( '.qodef-enquire-menu a.qodef-close-enquire-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_enquire_area_icon_color_styles' );
}

if ( ! function_exists( 'sagen_select_enquire_area_styles' ) ) {
	function sagen_select_enquire_area_styles() {
		$enquire_area_styles = array();
		$background_color = sagen_select_options()->getOptionValue( 'enquire_area_background_color' );
		$padding          = sagen_select_options()->getOptionValue( 'enquire_area_padding' );
		$text_alignment   = sagen_select_options()->getOptionValue( 'enquire_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$enquire_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$enquire_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$enquire_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $enquire_area_styles ) ) {
			echo sagen_select_dynamic_css( '.qodef-enquire-menu', $enquire_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo sagen_select_dynamic_css( '.qodef-enquire-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'sagen_select_action_style_dynamic', 'sagen_select_enquire_area_styles' );
}
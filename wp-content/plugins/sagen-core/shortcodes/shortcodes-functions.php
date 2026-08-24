<?php

if ( ! function_exists( 'sagen_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function sagen_core_include_shortcodes_file() {
		if ( sagen_core_theme_installed() ) {
			foreach ( glob( SAGEN_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode ) {
				if ( sagen_select_is_customizer_item_enabled( $shortcode, 'sagen_performance_disable_shortcode_' ) ) {
					include_once $shortcode;
				}
			}
		}
		
		do_action( 'sagen_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'sagen_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'sagen_core_load_shortcodes' ) ) {
	function sagen_core_load_shortcodes() {
		include_once SAGEN_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		SagenCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'sagen_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after sagen_core_include_shortcodes_file hook
}

if ( ! function_exists( 'sagen_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function sagen_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'sagen-core-vc-shortcodes', SAGEN_CORE_ASSETS_URL_PATH . '/css/admin/sagen-vc-shortcodes.css' );
	}
	
	add_action( 'sagen_select_action_admin_scripts_init', 'sagen_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'sagen_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function sagen_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'sagen_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'sagen_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

        if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'sagen-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'sagen_select_action_admin_scripts_init', 'sagen_core_add_admin_shortcodes_custom_styles' );
}
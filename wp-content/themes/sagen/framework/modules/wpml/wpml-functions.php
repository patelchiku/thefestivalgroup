<?php

if ( ! function_exists( 'sagen_select_disable_wpml_css' ) ) {
	function sagen_select_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'sagen_select_disable_wpml_css' );
}
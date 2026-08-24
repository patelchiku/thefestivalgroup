<?php

if ( ! function_exists( 'sagen_core_include_reviews_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function sagen_core_include_reviews_shortcodes_files() {
		foreach ( glob( SAGEN_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'sagen_core_action_include_shortcodes_file', 'sagen_core_include_reviews_shortcodes_files' );
}
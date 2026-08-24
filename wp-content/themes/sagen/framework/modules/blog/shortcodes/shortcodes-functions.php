<?php

if ( ! function_exists( 'sagen_select_include_blog_shortcodes' ) ) {
	function sagen_select_include_blog_shortcodes() {
		foreach ( glob( SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( sagen_select_is_plugin_installed( 'core' ) ) {
		add_action( 'sagen_core_action_include_shortcodes_file', 'sagen_select_include_blog_shortcodes' );
	}
}

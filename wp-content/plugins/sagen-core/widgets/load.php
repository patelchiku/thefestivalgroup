<?php

if ( ! function_exists( 'sagen_core_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function sagen_core_load_widget_class() {
		include_once 'widget-class.php';
	}
	
	add_action( 'sagen_select_action_before_options_map', 'sagen_core_load_widget_class' );
}

if ( ! function_exists( 'sagen_core_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to sagen_select_action_after_options_map action
	 */
	function sagen_core_load_widgets() {
		
		if ( sagen_core_theme_installed() ) {
			include_once 'recent-posts/recent-posts.php';

			foreach ( glob( SAGEN_SELECT_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}
		
		include_once 'widget-loader.php';
	}
	
	add_action( 'sagen_select_action_before_options_map', 'sagen_core_load_widgets' );
}
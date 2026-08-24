<?php

if ( ! function_exists( 'sagen_select_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to sagen_select_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function sagen_select_load_modules() {
		foreach ( glob( SAGEN_SELECT_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'sagen_select_action_before_options_map', 'sagen_select_load_modules' );
}
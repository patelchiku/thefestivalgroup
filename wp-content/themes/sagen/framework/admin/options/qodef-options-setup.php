<?php

if ( ! function_exists( 'sagen_select_admin_map_init' ) ) {
	function sagen_select_admin_map_init() {
		do_action( 'sagen_select_action_before_options_map' );
		
		foreach ( glob( SAGEN_SELECT_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'sagen_select_action_options_map' );
		
		do_action( 'sagen_select_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'sagen_select_admin_map_init', 1 );
}
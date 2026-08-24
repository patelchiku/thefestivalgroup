<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'sagen_select_child_theme_enqueue_scripts' ) ) {
	function sagen_select_child_theme_enqueue_scripts() {
		$parent_style = 'sagen-select-default-style';
		
		wp_enqueue_style( 'sagen-select-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'sagen_select_child_theme_enqueue_scripts' );
}
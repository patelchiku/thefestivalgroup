<?php

if ( ! function_exists( 'sagen_select_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function sagen_select_register_blog_list_widget( $widgets ) {
		$widgets[] = 'SagenSelectClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'sagen_core_filter_register_widgets', 'sagen_select_register_blog_list_widget' );
}
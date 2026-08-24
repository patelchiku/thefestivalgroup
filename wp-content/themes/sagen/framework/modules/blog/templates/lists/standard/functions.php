<?php

if ( ! function_exists( 'sagen_select_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function sagen_select_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'sagen' );
		
		return $templates;
	}
	
	add_filter( 'sagen_select_filter_register_blog_templates', 'sagen_select_register_blog_standard_template_file' );
}

if ( ! function_exists( 'sagen_select_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function sagen_select_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'sagen' );
		
		return $options;
	}
	
	add_filter( 'sagen_select_filter_blog_list_type_global_option', 'sagen_select_set_blog_standard_type_global_option' );
}
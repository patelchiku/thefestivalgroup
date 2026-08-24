<?php

if ( ! function_exists( 'sagen_select_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function sagen_select_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'sagen' );
		
		return $templates;
	}
	
	add_filter( 'sagen_select_filter_register_blog_templates', 'sagen_select_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'sagen_select_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function sagen_select_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'sagen' );
		
		return $options;
	}
	
	add_filter( 'sagen_select_filter_blog_list_type_global_option', 'sagen_select_set_blog_masonry_type_global_option' );
}
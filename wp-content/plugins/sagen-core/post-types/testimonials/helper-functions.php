<?php

if ( ! function_exists( 'sagen_core_testimonials_meta_box_functions' ) ) {
	function sagen_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'sagen_select_filter_meta_box_post_types_save', 'sagen_core_testimonials_meta_box_functions' );
	add_filter( 'sagen_select_filter_meta_box_post_types_remove', 'sagen_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'sagen_core_register_testimonials_cpt' ) ) {
	function sagen_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'SagenCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'sagen_core_filter_register_custom_post_types', 'sagen_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'sagen_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function sagen_core_include_testimonials_shortcodes_files() {
		foreach ( glob( SAGEN_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'sagen_core_action_include_shortcodes_file', 'sagen_core_include_testimonials_shortcodes_files' );
}
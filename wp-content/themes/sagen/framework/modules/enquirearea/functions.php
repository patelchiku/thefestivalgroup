<?php

if ( ! function_exists( 'sagen_select_register_enquire_area_sidebar' ) ) {
	/**
	 * Register enquire area sidebar
	 */
	function sagen_select_register_enquire_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'enquirearea',
				'name'          => esc_html__( 'Enquire Area', 'sagen' ),
				'description'   => esc_html__( 'Enquire Area', 'sagen' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-enquirearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'sagen_select_register_enquire_area_sidebar' );
}

if ( ! function_exists( 'sagen_select_enquire_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function sagen_select_enquire_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'qodef_enquire_area_opener' ) ) {
			
			if ( sagen_select_options()->getOptionValue( 'enquire_area_type' ) ) {
				$classes[] = 'qodef-' . sagen_select_options()->getOptionValue( 'enquire_area_type' );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'sagen_select_enquire_menu_body_class' );
}

if ( ! function_exists( 'sagen_select_get_enquire_area' ) ) {
	/**
	 * Loads enquire area HTML
	 */
	function sagen_select_get_enquire_area() {
		
		if ( is_active_widget( false, false, 'qodef_enquire_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => sagen_select_get_enquire_area_close_icon_class()
			);
			
			sagen_select_get_module_template_part( 'templates/enquirearea', 'enquirearea', '', $parameters );
		}
	}
	
	add_action( 'sagen_select_action_before_closing_body_tag', 'sagen_select_get_enquire_area', 10 );
}

if ( ! function_exists( 'sagen_select_get_enquire_area_close_class' ) ) {
	/**
	 * Loads enquire area close icon class
	 */
	function sagen_select_get_enquire_area_close_icon_class() {
		$classes = array(
			'qodef-close-enquire-menu'
		);
		
		$classes[] = sagen_select_get_icon_sources_class( 'enquire_area', 'qodef-close-enquire-menu' );
		
		return $classes;
	}
}
<?php

if ( ! function_exists( 'sagen_core_register_widgets' ) ) {
	function sagen_core_register_widgets() {
		$widgets = apply_filters( 'sagen_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'sagen_core_register_widgets' );
}
<?php

if ( ! function_exists( 'sagen_select_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function sagen_select_get_subscribe_popup() {
		
		if ( sagen_select_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( sagen_select_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || sagen_select_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			sagen_select_load_subscribe_popup_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'sagen_select_action_before_page_header', 'sagen_select_get_subscribe_popup' );
}

if ( ! function_exists( 'sagen_select_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function sagen_select_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = sagen_select_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = sagen_select_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = sagen_select_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = sagen_select_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = sagen_select_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = sagen_select_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = sagen_select_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'qodef-prevent-enable' : 'qodef-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'qodef-prevent-' . $parameters['prevent_behavior'] : 'qodef-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'qodef-sp-has-image' : '';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		sagen_select_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}
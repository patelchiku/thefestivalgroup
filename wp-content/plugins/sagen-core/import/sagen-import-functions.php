<?php

if ( ! function_exists( 'sagen_core_import_object' ) ) {
	function sagen_core_import_object() {
		$sagen_core_import_object = new SagenCoreImport();
	}
	
	add_action( 'init', 'sagen_core_import_object' );
}

if ( ! function_exists( 'sagen_core_data_import' ) ) {
	function sagen_core_data_import() {
		$importObject = SagenCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "sagen/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_sagen_core_action_import_content', 'sagen_core_data_import' );
}

if ( ! function_exists( 'sagen_core_widgets_import' ) ) {
	function sagen_core_widgets_import() {
		$importObject = SagenCoreImport::getInstance();
		
		$folder = "sagen/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_sagen_core_action_import_widgets', 'sagen_core_widgets_import' );
}

if ( ! function_exists( 'sagen_core_options_import' ) ) {
	function sagen_core_options_import() {
		$importObject = SagenCoreImport::getInstance();
		
		$folder = "sagen/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_sagen_core_action_import_options', 'sagen_core_options_import' );
}

if ( ! function_exists( 'sagen_core_other_import' ) ) {
	function sagen_core_other_import() {
		$importObject = SagenCoreImport::getInstance();
		
		$folder = "sagen/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );
		
		$importObject->qodef_update_meta_fields_after_import( $folder );
		$importObject->qodef_update_options_after_import( $folder );
		
		if ( sagen_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
				global $sagen_select_global_options;
		
		$sagen_select_global_options = get_option( 'qodef_options_sagen' );
		
		do_action( 'sagen_select_action_after_import_completed' );

		die();
	}
	
	add_action( 'wp_ajax_sagen_core_action_import_other_elements', 'sagen_core_other_import' );
}
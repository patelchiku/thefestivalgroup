<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * sagen_select_action_header_meta hook
	 *
	 * @see sagen_select_header_meta() - hooked with 10
	 * @see sagen_select_user_scalable_meta - hooked with 10
	 * @see sagen_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'sagen_select_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
    <div class="qodef-wrapper">
        <div class="qodef-wrapper-inner">
            <?php
            /**
             * sagen_select_action_after_wrapper_inner hook
             *
             * @see sagen_select_get_header() - hooked with 10
             * @see sagen_select_get_mobile_header() - hooked with 20
             * @see sagen_select_back_to_top_button() - hooked with 30
             * @see sagen_select_get_header_minimal_full_screen_menu() - hooked with 40
             * @see sagen_select_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'sagen_select_action_after_wrapper_inner' ); ?>
	        
            <div class="qodef-content" <?php sagen_select_content_elem_style_attr(); ?>>
                <div class="qodef-content-inner">
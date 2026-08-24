<?php

if ( ! function_exists( 'sagen_select_like' ) ) {
	/**
	 * Returns SagenSelectClassLike instance
	 *
	 * @return SagenSelectClassLike
	 */
	function sagen_select_like() {
		return SagenSelectClassLike::get_instance();
	}
}

function sagen_select_get_like() {
	
	echo wp_kses( sagen_select_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}
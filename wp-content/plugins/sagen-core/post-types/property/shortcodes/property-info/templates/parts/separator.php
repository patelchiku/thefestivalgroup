<?php
	$sep_params = array(
		'position'  => 'left',
		'width'     => '40',
		'thickness' => '1',
	);

	$paramssep = '';

	if ( is_array( $sep_params ) && count( $sep_params ) && ( $enable_title === 'yes' ) ) {
		foreach ( $sep_params as $key => $value ) {
			$paramssep .= " $key='$value' ";
		}
	}

	echo do_shortcode( "[qodef_separator $paramssep]" );


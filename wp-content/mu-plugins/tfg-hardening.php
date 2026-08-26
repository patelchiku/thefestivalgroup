<?php
/**
 * TFG security hardening (must-use, always active).
 */

// Security headers at the app layer, in case the webserver config doesn't apply them (e.g. local nginx dev).
add_action( 'send_headers', function () {
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
	header_remove( 'X-Powered-By' );
} );

// Stop leaking exact WP version.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

add_filter( 'style_loader_src', 'tfg_remove_ver_query_arg', 9999 );
add_filter( 'script_loader_src', 'tfg_remove_ver_query_arg', 9999 );
function tfg_remove_ver_query_arg( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

// Disable pingback abuse (amplification / SSRF vector) while leaving XML-RPC itself
// enabled since Jetpack relies on it. Removes only the pingback methods.
add_filter( 'xmlrpc_methods', function ( $methods ) {
	unset( $methods['pingback.ping'] );
	unset( $methods['pingback.extensions.getPingbacks'] );
	return $methods;
} );
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );
remove_action( 'wp_head', 'rsd_link' );

// Block user enumeration via ?author=N.
add_action( 'template_redirect', function () {
	if ( is_admin() ) {
		return;
	}
	if ( isset( $_GET['author'] ) && preg_match( '/^\d+$/', $_GET['author'] ) ) {
		wp_die( 'Forbidden', 403 );
	}
} );

// Block XML-RPC multicall/system.listMethods probing while keeping the endpoint usable for Jetpack.
add_filter( 'xmlrpc_methods', function ( $methods ) {
	unset( $methods['system.multicall'] );
	return $methods;
} );

/**
 * CF7 bot-submission hardening: honeypot field + minimum-fill-time check.
 * No API keys, no visible UI, no per-form editing - applies to every CF7
 * form on the site automatically via wpcf7_form_elements, so it covers
 * Contact Us, Get Redevelopment Offer, and any form added later.
 *
 * Deliberately not using the bundled UACF7 "Spam Protection" addon: it
 * shows a visible CAPTCHA to every visitor (friction we don't want) and
 * its code calls a third-party IP-lookup API over plain HTTP and
 * unserialize()s the response - an unnecessary and unsafe dependency for
 * what a free honeypot achieves with none of that.
 */
add_filter( 'wpcf7_form_elements', function ( $html ) {
	$html .= '<p class="tfg-hp" aria-hidden="true" style="position:absolute!important;left:-9999px!important;top:-9999px!important;width:1px;height:1px;overflow:hidden;margin:0;padding:0;">'
		. '<label>Leave this field empty<input type="text" name="tfg_hp_website" tabindex="-1" autocomplete="off"></label>'
		. '</p>'
		. '<input type="hidden" name="tfg_hp_ts" value="' . time() . '">';
	return $html;
} );

add_filter( 'wpcf7_spam', function ( $spam ) {
	if ( $spam ) {
		return $spam;
	}
	// Honeypot field: real visitors never see or fill it.
	if ( ! empty( $_POST['tfg_hp_website'] ) ) {
		return true;
	}
	// Minimum-fill-time: reject submissions faster than a human can fill the form.
	if ( isset( $_POST['tfg_hp_ts'] ) && ( time() - (int) $_POST['tfg_hp_ts'] ) < 3 ) {
		return true;
	}
	return $spam;
} );

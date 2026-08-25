<?php
/**
 * Fix: mobile/vertical nav "current page" text color (#9abcc9, near-white) is
 * illegible against this site's white menu background. Theme default assumes
 * a dark header background, which this site doesn't use. Covers both the
 * mobile-header nav (.qodef-mobile-nav) and the desktop vertical-closed
 * header's fullscreen overlay menu (.qodef-vertical-menu) - both use the same
 * washed-out current-item color and both render on this site's light bg.
 */
add_action( 'wp_head', function () {
	?>
	<style id="tfg-mobile-nav-contrast-fix">
		.qodef-mobile-header .qodef-mobile-nav ul li.current-menu-item > a,
		.qodef-mobile-header .qodef-mobile-nav ul li.current_page_item > a,
		.qodef-mobile-header .qodef-mobile-nav ul li.qodef-active-item > a,
		.qodef-mobile-header .qodef-mobile-nav ul li.current-menu-item > h6,
		.qodef-mobile-header .qodef-mobile-nav ul li.current_page_item > h6,
		.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li.qodef-active-item > a,
		.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li.qodef-active-item > h6,
		.qodef-vertical-menu ul li.current-menu-item > a,
		.qodef-vertical-menu ul li.current_page_item > a,
		.qodef-vertical-menu ul li.qodef-active-item > a,
		.qodef-vertical-menu ul li.current-menu-item > h6,
		.qodef-vertical-menu ul li.current_page_item > h6,
		.qodef-vertical-menu ul li.qodef-active-item > h6 {
			color: #1a1a1a !important;
		}
	</style>
	<?php
}, 100 );

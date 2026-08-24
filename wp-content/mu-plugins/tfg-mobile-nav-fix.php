<?php
/**
 * Fix: mobile nav "current page" text color (#9abcc9, near-white) is illegible
 * against this site's white mobile-menu background. Theme default assumes a
 * dark mobile header background, which this site doesn't use.
 * Scoped to mobile nav only - desktop vertical nav is unaffected.
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
		.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li.qodef-active-item > h6 {
			color: #1a1a1a !important;
		}
	</style>
	<?php
}, 100 );

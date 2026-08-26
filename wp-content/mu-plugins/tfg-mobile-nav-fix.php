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
		.qodef-vertical-menu ul li.qodef-active-item > h6,
		.qodef-vertical-menu ul li.current-menu-item > a .item_text,
		.qodef-vertical-menu ul li.current_page_item > a .item_text,
		.qodef-vertical-menu ul li.qodef-active-item > a .item_text {
			color: #1a1a1a !important;
		}
		/* Not a background box - the "grey out on hover" is this same
		   washed-out color bug hitting EVERY vertical-menu link on hover
		   (not just the current-page one above): the theme's own hover
		   rule sets color to rgb(237,247,250), which is nearly invisible
		   on this light menu, and the letters blur into a pale smudge
		   that reads as a grey box. Theme's hover selector is prefixed
		   with the body classes (.qodef-dark-header.qodef-header-vertical-closed),
		   which makes it more specific than a plain ".qodef-vertical-menu ...:hover"
		   override - so this rule copies that same prefix to win instead
		   of just adding !important (both are !important, so higher
		   specificity decides, not source order). Menu should stay plain
		   black on hover, click, everywhere. */
		.qodef-dark-header.qodef-header-vertical-closed .qodef-vertical-menu ul li a:hover,
		.qodef-dark-header.qodef-header-vertical-closed .qodef-vertical-menu ul li a:hover .item_text,
		.qodef-mobile-header .qodef-mobile-nav ul li a:hover,
		.qodef-mobile-header .qodef-mobile-nav ul li a:hover h6 {
			color: #1a1a1a !important;
		}
		/* The theme also slides .item_text left by 20px on hover (a "text
		   shift" animation) - remove that entirely, no motion on hover,
		   text just stays put. These "left"/"transition" values have no
		   !important in the theme's CSS, so plain !important here is
		   enough to win regardless of selector specificity. */
		.qodef-vertical-menu .item_outer,
		.qodef-vertical-menu .item_text {
			left: 0 !important;
			transition: none !important;
		}
		/* Mobile nav links also flash a grey/blue highlight box on tap -
		   that's the browser's default mobile tap-highlight overlay, not
		   a theme style. Remove it too so tap gives no visual noise. */
		.qodef-mobile-header .qodef-mobile-nav ul li a,
		.qodef-mobile-header .qodef-mobile-nav ul li h6,
		.qodef-vertical-menu ul li a,
		.qodef-vertical-menu ul li h6 {
			-webkit-tap-highlight-color: transparent;
			background-color: transparent !important;
		}
		/* No underline on hover either - plain text only, no visual change
		   at all beyond the color safety fix above. */
		.qodef-mobile-header .qodef-mobile-nav ul li a:hover,
		.qodef-vertical-menu ul li a:hover {
			text-decoration: none !important;
		}
		/* Same issue: MetaSlider caption "Know More"/"Book Now" links are
		   white text with a transparent background (theme assumes the
		   caption sits directly over a dark photo). Here the caption sits
		   in a plain white box (.caption-wrap), so the white text is
		   invisible on both desktop and mobile. */
		.caption-wrap .knowmore,
		.caption-wrap .booknow {
			color: #1a1a1a !important;
		}
		/* Same caption links also had zero padding/margin, so "Book Now" and
		   "Know More" ran together with no gap ("Book NowKnow More") and were
		   too small to tap reliably. Give each its own padded touch target
		   and space between them. */
		.caption-wrap .knowmore,
		.caption-wrap .booknow {
			display: inline-block !important;
			padding: 8px 14px !important;
			margin: 6px 8px 6px 0 !important;
			border: 1px solid #1a1a1a !important;
		}
		/* Footer column headings (CONTACT / USEFUL LINKS / PROJECTS) are
		   custom_html widgets with no explicit color, so they inherit the
		   theme's dark default (#222) - invisible against this footer's
		   black background. */
		footer .textwidget.custom-html-widget h6 {
			color: #ffffff !important;
		}
		/* Selected/highlighted text is rendered white (theme default assumes
		   a dark background) against a near-white selection highlight
		   (#edf7fa), so selected text is effectively invisible site-wide -
		   e.g. typing into the Contact Us "Message" textarea and selecting
		   text shows nothing. */
		::selection {
			color: #1a1a1a !important;
			background: #b3d4fc !important;
		}
		/* Contact Us page (page-id-1165) banner heading "CONTACT US" is
		   plain black text sitting directly over a photo background with
		   no overlay, so its low-contrast/hard to read. */
		.page-id-1165 h1.qodef-custom-font-holder {
			color: #ffffff !important;
		}
		/* Every CF7 form's Submit button (.wpcf7-submit.qodef-btn-outline,
		   used site-wide - Contact Us, Get Redevelopment Offer, and any
		   other form built with this theme) only gets a text/border color
		   change from the theme's own :hover rule, and has no :active or
		   :focus state at all - so hovering/clicking gives little to no
		   visual feedback, button stays a near-invisible outline. Give it
		   a clear solid-black state on hover, click, and keyboard focus.
		   Selector needs the extra .qodef-btn class (not just
		   .qodef-btn-outline) to match the specificity of the theme's own
		   ":not(.qodef-btn-custom-hover-bg):hover" rule - otherwise that
		   rule's higher specificity wins over ours despite !important and
		   despite ours loading later. */
		.wpcf7-submit.qodef-btn.qodef-btn-outline:hover,
		.wpcf7-submit.qodef-btn.qodef-btn-outline:active,
		.wpcf7-submit.qodef-btn.qodef-btn-outline:focus {
			background-color: #000000 !important;
			color: #ffffff !important;
			border-color: #000000 !important;
		}
		/* Property/project card "Know More" / "Book Now" buttons (.knowmore,
		   .booknow, plain outline links outside the MetaSlider caption
		   context) have no hover state at all - clicking/hovering gives
		   zero visual feedback. Give them the standard outline-button
		   hover: invert to a solid black fill. */
		a.knowmore:hover,
		a.booknow:hover {
			background-color: #000000 !important;
			color: #ffffff !important;
			border-color: #000000 !important;
		}
	</style>
	<?php
}, 100 );

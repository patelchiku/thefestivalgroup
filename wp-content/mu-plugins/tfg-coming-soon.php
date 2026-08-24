<?php
/**
 * TFG coming-soon holding page for logged-out visitors.
 * Logged-in users (admins) still see the real site normally.
 * Remove this file to restore the live site instantly.
 */

add_action( 'template_redirect', function () {
	if ( is_user_logged_in() ) {
		return;
	}
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return;
	}
	if ( wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}

	$logo = home_url( '/wp-content/uploads/2024/12/FESTIVAL-LOGO-black2.png' );
	header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
	header( 'Retry-After: 3600' );
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>The Festival Group — Coming Soon</title>
<style>
	* { box-sizing: border-box; }
	html, body {
		margin: 0; padding: 0; height: 100%;
		background: #0b0b0b; color: #f5f5f5;
		font-family: 'Helvetica Neue', Arial, sans-serif;
	}
	.wrap {
		min-height: 100vh;
		display: flex; flex-direction: column;
		align-items: center; justify-content: center;
		text-align: center; padding: 40px 20px;
	}
	img { max-width: 180px; margin-bottom: 40px; filter: invert(1); }
	h1 {
		font-weight: 400; letter-spacing: 3px; text-transform: uppercase;
		font-size: 28px; margin: 0 0 16px;
	}
	p { color: #aaa; font-size: 16px; max-width: 480px; line-height: 1.6; margin: 0 0 30px; }
	.contact { font-size: 14px; color: #888; }
	.contact a { color: #f5f5f5; text-decoration: none; border-bottom: 1px solid #555; }
</style>
</head>
<body>
	<div class="wrap">
		<img src="<?php echo esc_url( $logo ); ?>" alt="The Festival Group">
		<h1>Something New Is Coming</h1>
		<p>We're putting the finishing touches on our website. Please check back soon.</p>
		<div class="contact">
			<a href="tel:+919157677777">+91 9157677777</a> &nbsp;|&nbsp;
			<a href="mailto:info@thefestivalgroup.in">info@thefestivalgroup.in</a>
		</div>
	</div>
</body>
</html>
	<?php
	exit;
} );

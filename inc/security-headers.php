<?php
/**
 * Security headers for front-end requests.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'send_headers',
	function () {
		if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}
		header( 'Strict-Transport-Security: max-age=15552000; includeSubDomains', true );
		header( 'X-Content-Type-Options: nosniff', true );
		header( 'X-Frame-Options: SAMEORIGIN', true );
		header( 'Referrer-Policy: strict-origin-when-cross-origin', true );
		header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()', true );
	},
	1
);

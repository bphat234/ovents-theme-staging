<?php
/**
 * Legacy URL redirects (non-Wix).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'template_redirect',
	function () {
		if ( is_admin() ) {
			return;
		}
		$uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		$path = wp_parse_url( $uri, PHP_URL_PATH );
		if ( ! is_string( $path ) ) {
			return;
		}
		$path = strtolower( untrailingslashit( $path ) );
		if ( '' === $path ) {
			$path = '/';
		}

		$map = array(
			'/wedding-coordination'          => '/weddings/',
			'/wedding-planning'              => '/weddings/',
			'/private-parties'               => '/parties/',
			'/weddings/wedding-coordination' => '/weddings/',
			'/journal'                       => '/blog/',
		);

		if ( isset( $map[ $path ] ) ) {
			wp_safe_redirect( home_url( $map[ $path ] ), 301 );
			exit;
		}
	},
	2
);
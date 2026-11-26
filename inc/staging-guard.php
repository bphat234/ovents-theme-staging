<?php
/**
 * Staging / non-production indexing guard.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WordPress is configured for the production domain (apex or www).
 */
function ovents_is_launch_live() {
	$home = untrailingslashit( (string) home_url( '/' ) );
	return in_array( $home, array( 'https://www.ovents.co.uk', 'https://ovents.co.uk' ), true );
}

/**
 * Whether crawlers must be blocked (meta, header, robots.txt).
 */
function ovents_should_block_crawlers() {
	if ( function_exists( 'ovents_is_local_env' ) && ovents_is_local_env() ) {
		return true;
	}
	if ( function_exists( 'ovents_is_staging_env' ) && ovents_is_staging_env() ) {
		return true;
	}
	if ( ovents_is_launch_live() ) {
		return false;
	}
	if ( function_exists( 'ovents_is_production_env' ) && ovents_is_production_env() ) {
		return false;
	}
	return true;
}

add_action(
	'template_redirect',
	function () {
		if ( ovents_should_block_crawlers() ) {
			header( 'X-Robots-Tag: noindex, nofollow', true );
		}
	},
	0
);

add_filter(
	'robots_txt',
	function ( $output, $public ) {
		if ( ! ovents_should_block_crawlers() ) {
			return $output;
		}
		return "User-agent: *\nDisallow: /\n";
	},
	999,
	2
);
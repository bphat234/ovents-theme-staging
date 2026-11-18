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
 * Live site when WordPress home URL is https://www.ovents.co.uk (trailing slash normalised).
 */
function ovents_is_launch_live() {
	$home = untrailingslashit( (string) home_url( '/' ) );
	return 'https://www.ovents.co.uk' === $home;
}

/**
 * Whether crawlers must be blocked (meta, header, robots.txt).
 */
function ovents_should_block_crawlers() {
	return ! ovents_is_launch_live();
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
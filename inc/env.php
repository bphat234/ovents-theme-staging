<?php
/**
 * Environment detection (local, staging, production).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Current HTTP host (lowercase).
 */
function ovents_request_host() {
	return isset( $_SERVER['HTTP_HOST'] ) ? strtolower( (string) wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
}

/**
 * Local Docker development.
 */
function ovents_is_local_env() {
	if ( defined( 'OVENTS_LOCAL' ) && OVENTS_LOCAL ) {
		return true;
	}
	$host = ovents_request_host();
	return in_array( $host, array( 'localhost:8091', '127.0.0.1:8091', 'localhost:8090', '127.0.0.1:8090' ), true );
}

/**
 * Staging on brandnoddev.com.
 */
function ovents_is_staging_env() {
	if ( defined( 'OVENTS_STAGING' ) && OVENTS_STAGING ) {
		return true;
	}
	$host = ovents_request_host();
	return false !== strpos( $host, 'brandnoddev.com' );
}

/**
 * Live production domain (HTTP host).
 */
function ovents_is_production_env() {
	$host = ovents_request_host();
	return in_array( $host, array( 'www.ovents.co.uk', 'ovents.co.uk' ), true );
}

/**
 * Whether search engines should be discouraged (Settings > Reading).
 */
function ovents_should_discourage_indexing() {
	if ( function_exists( 'ovents_should_block_crawlers' ) ) {
		return ovents_should_block_crawlers();
	}
	return ! ovents_is_production_env();
}
<?php
/**
 * Portfolio event SEO (Rank Math meta per ovents_portfolio slug).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<string, array{title: string, description: string, focus_keyword: string}>
 */
function ovents_portfolio_seo_config() {
	return array(
		'erica-samuel'       => array(
			'title'         => 'Erica & Samuel Wedding | London Wedding Planning | Ovents',
			'description'   => "Erica and Samuel's wedding, planned by Ovents.",
			'focus_keyword' => 'London wedding planning',
		),
		'funmi-yemi'         => array(
			'title'         => 'Funmi & Yemi Wedding | Luxury Wedding London | Ovents',
			'description'   => "Funmi and Yemi's wedding, planned by Ovents.",
			'focus_keyword' => 'luxury wedding London',
		),
		'the-planners-table' => array(
			'title'         => "The Planner's Table | Corporate Event Planning London | Ovents",
			'description'   => "The Planner's Table, a lunch and learn for event professionals organised by Ovents in April 2026.",
			'focus_keyword' => 'corporate event planning London',
		),
		'gloria-daniel'      => array(
			'title'         => 'Gloria & Daniel Wedding | Wedding Coordination London | Ovents',
			'description'   => "Gloria and Daniel's wedding, planned by Ovents.",
			'focus_keyword' => 'wedding coordination London',
		),
	);
}

/**
 * SEO row for a portfolio event (curated map or publish fallback).
 *
 * @param WP_Post $post Portfolio post.
 * @return array{title: string, description: string, focus_keyword: string}|null
 */
function ovents_portfolio_seo_row_for_post( WP_Post $post ) {
	$map = ovents_portfolio_seo_config();
	if ( isset( $map[ $post->post_name ] ) ) {
		return $map[ $post->post_name ];
	}
	if ( 'publish' !== $post->post_status ) {
		return null;
	}
	if ( function_exists( 'ovents_portfolio_get_meta' ) ) {
		$meta = ovents_portfolio_get_meta( $post );
		$type = strtolower( (string) ( $meta['type_label'] ?? '' ) );
		if ( false !== strpos( $type, 'wedding' ) ) {
			$keyword = 'London wedding planning';
		} elseif ( false !== strpos( $type, 'corporate' ) ) {
			$keyword = 'corporate event planning London';
		} else {
			$keyword = 'luxury event portfolio London';
		}
		$display = get_the_title( $post );
		return array(
			'title'         => $display . ' | ' . ucwords( $keyword ) . ' | Ovents',
			'description'   => $meta['meta_desc'] ?: wp_strip_all_tags( ovents_portfolio_visible_intro( $meta ) ),
			'focus_keyword' => $keyword,
		);
	}
	$keyword = 'luxury event portfolio London';
	$display = get_the_title( $post );
	return array(
		'title'         => $display . ' | Luxury Event Portfolio London | Ovents',
		'description'   => sprintf(
			/* translators: %s: event title */
			__( '%s — planned by Ovents, luxury event planners in London.', 'ovents' ),
			$display
		),
		'focus_keyword' => $keyword,
	);
}
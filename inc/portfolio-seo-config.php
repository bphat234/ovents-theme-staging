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
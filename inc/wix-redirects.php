<?php
/**
 * Wix → WordPress 301 redirect map (version-controlled).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<string, string> Path without trailing slash => path with trailing slash (relative).
 */
function ovents_wix_redirect_map() {
	return array(
		'/blog/categories/weddings'  => '/category/weddings/',
		'/blog/categories/corporate'   => '/category/corporate/',
		'/blog/categories/parties'     => '/category/parties/',
		'/wedding-planner-uk'          => '/weddings/',
		'/corporate'                   => '/corporate-events/',
		'/services-1-2'                => '/corporate-events/',
		'/services-1'                  => '/weddings/',
		'/terms-and-conditions'        => '/terms-of-use/',
		'/post/why-on-the-day-coordination-matters' => '/parties/',
		'/post/elevating-events-through-luxury-management-premium-event-management-insights' => '/',
		'/post/essential-corporate-event-planning-checklist-for-seamless-launches-and-conferences' => '/corporate-events/',
		'/post/streamlining-corporate-event-planning-in-london-with-professional-event-coordination-london' => '/corporate-events/',
		'/post/luxury-event-management-tailored-to-london' => '/',
		'/post/planning-corporate-events-with-impact-in-london-corporate-events-london-tips' => '/corporate-events/',
		'/plan-product-launch-event-london' => '/plan-product-launch-conference-london/',
		'/post/crafting-flawless-luxury-events-in-the-uk-exclusive-event-planning-uk' => '/',
		'/post/crafting-memorable-luxury-events-in-the-uk-luxury-event-strategies-uk' => '/',
		'/post/crafting-memorable-corporate-events-in-london-corporate-event-planning-tips' => '/corporate-events/',
		'/post/corporate-event-planning-made-simple-in-london-tailored-event-planning-tips' => '/corporate-events/',
		'/post/five-essential-tips-for-planning-unforgettable-private-parties' => '/parties/',
		'/post/crafting-unforgettable-corporate-events-in-london-expert-event-planning-strategies' => '/corporate-events/',
		'/post/creating-bespoke-wedding-services-uk-crafting-unforgettable-celebrations' => '/weddings/',
		'/post/top-reasons-to-choose-expert-wedding-planning-services-in-the-uk' => '/weddings/',
		'/post/essential-tips-for-choosing-the-right-wedding-planner-in-london' => '/weddings/',
		'/post/mastering-corporate-event-planning-in-london-a-corporate-event-coordination-guide' => '/corporate-events/',
		'/post/why-hiring-an-event-planner-in-london-and-the-southeast-is-essential-for-elevating-your-event' => '/',
		'/post/creating-unforgettable-luxury-events-in-london-mastering-luxury-event-planning-london' => '/',
	);
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

		$map = ovents_wix_redirect_map();
		if ( isset( $map[ $path ] ) ) {
			wp_safe_redirect( home_url( $map[ $path ] ), 301 );
			exit;
		}
	},
	1
);
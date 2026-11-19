<?php
/**
 * Per-page SEO titles and descriptions.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SEO config keyed by page slug (front page uses "home").
 *
 * @return array<string, array{title: string, description: string, h1?: string}>
 */
function ovents_seo_config() {
	return array(
		'home'             => array(
			'title'       => 'Event Planner London & Across the UK | Ovents',
			'description' => 'London-based event planners offering wedding planning, corporate event management and private celebrations across the UK. Enquire with Ovents today.',
			'h1'          => 'Luxury weddings and corporate events, planned from London across the UK',
		),
		'weddings'         => array(
			'title'       => 'Luxury Wedding Planner London & UK | Ovents',
			'description' => 'Wedding planning and on-the-day coordination in London and across the UK. Enquire about personalised wedding support from Ovents.',
			'h1'          => 'Wedding planning and coordination',
		),
		'corporate-events' => array(
			'title'       => 'Corporate Event Planners London & UK | Ovents',
			'description' => 'Corporate event planners in London for conferences, launches, gala dinners and Christmas parties. Full planning or on-the-day coordination across the UK.',
			'h1'          => 'Corporate event planners in London, working across the UK',
		),
		'parties'          => array(
			'title'       => 'Private Party Planner London & UK | Ovents',
			'description' => 'Private party planning for birthdays, anniversaries and special celebrations across London and the UK. Plan your occasion with Ovents.',
			'h1'          => 'Private party planning',
		),
		'about'            => array(
			'title'       => 'About Ovents | London-Based Event Planners',
			'description' => 'Get to know Ovents, a London-based wedding and event planning company providing personalised planning and coordination across the UK.',
			'h1'          => 'Meet the planners behind Ovents',
		),
		'contact'          => array(
			'title'       => 'Contact Ovents | Wedding & Event Enquiries',
			'description' => 'Planning a wedding, corporate event or private celebration? Contact Ovents to discuss your event and request a consultation.',
			'h1'          => "Let's Plan Your Event",
		),
		'faq'              => array(
			'title'       => 'Event Planning FAQs | Ovents',
			'description' => 'Find answers to common questions about wedding planning, event coordination, corporate events and private celebrations with Ovents.',
			'h1'          => 'Frequently Asked Questions',
		),
		'portfolio'        => array(
			'title'       => 'Portfolio | Luxury Weddings, Parties and Events | Ovents',
			'description' => 'Selected weddings, private celebrations and events planned by Ovents, the London luxury event planner working across the UK.',
			'h1'          => 'Selected celebrations',
		),
		'blog'             => array(
			'title'       => 'The Ovents Journal | Ovents',
			'description' => 'Planning tips and notes on weddings, corporate events and private celebrations from the Ovents team.',
			'h1'          => 'The Ovents Journal',
		),
		'privacy-policy'   => array(
			'title'       => 'Privacy Policy | Ovents',
			'description' => 'UK GDPR privacy policy for Ovents LTD: what we collect, lawful bases, cookies, retention and your rights.',
			'h1'          => 'Privacy policy',
		),
		'terms-of-use'     => array(
			'title'       => 'Terms of Use | Ovents',
			'description' => 'Website terms of use for Ovents LTD, including acceptable use, liability and governing law.',
			'h1'          => 'Terms of use',
		),
	);
}

/**
 * Current request SEO slug.
 */
function ovents_seo_slug() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_singular( 'page' ) ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			return $post->post_name;
		}
	}
	if ( is_home() && ! is_front_page() ) {
		return 'blog';
	}
	return '';
}

/**
 * SEO row for current request.
 *
 * @return array{title: string, description: string, h1?: string}|null
 */
function ovents_seo_for_request() {
	if ( function_exists( 'ovents_portfolio_get_meta' ) && is_post_type_archive( OVENTS_PORTFOLIO_CPT ) ) {
		$row = ovents_seo_config()['portfolio'] ?? null;
		return $row ? array(
			'title'       => $row['title'],
			'description' => $row['description'],
		) : null;
	}
	if ( function_exists( 'ovents_portfolio_get_meta' ) && is_singular( OVENTS_PORTFOLIO_CPT ) ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$meta = ovents_portfolio_get_meta( $post );
			$type = $meta['type_label'] ?: __( 'Event', 'ovents' );
			$desc = $meta['meta_desc'] ?: wp_strip_all_tags( ovents_portfolio_visible_intro( $meta ) );
			return array(
				'title'       => get_the_title( $post ) . ' | ' . $type . ' | Ovents',
				'description' => $desc,
			);
		}
	}
	$slug = ovents_seo_slug();
	if ( '' === $slug ) {
		return null;
	}
	$config = ovents_seo_config();
	return isset( $config[ $slug ] ) ? $config[ $slug ] : null;
}

/**
 * Production site URL for canonicals (launch domain).
 */
function ovents_canonical_base() {
	if ( ovents_is_local_env() ) {
		return untrailingslashit( home_url() );
	}
	$host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( (string) wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	if ( false !== strpos( $host, 'brandnoddev.com' ) ) {
		return untrailingslashit( home_url() );
	}
	return 'https://www.ovents.co.uk';
}

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
			'title'       => 'Luxury Event Planner London & the UK | Ovents',
			'description' => 'Luxury event planning and coordination in London and across the UK. Weddings, parties and corporate events, planned so you can be present.',
			'h1'          => 'Luxury wedding and event planners in London',
		),
		'weddings'         => array(
			'title'       => 'Luxury Wedding Planner London & UK | Ovents',
			'description' => 'A luxury wedding planner in London, working across the UK. Full planning or on-the-day coordination, shaped around you.',
			'h1'          => 'Luxury wedding planners in London',
		),
		'corporate-events' => array(
			'title'       => 'Corporate Event Planner London & UK | Ovents',
			'description' => 'Discreet, polished corporate events in London and across the UK, planned for clients, colleagues and partners.',
			'h1'          => 'Corporate event planners in London',
		),
		'parties'          => array(
			'title'       => 'Private Party Planner London & UK | Ovents',
			'description' => 'A party planner in London, working across the UK. Birthdays, anniversaries and private celebrations, planned so you can enjoy them.',
			'h1'          => 'Private party planners in London',
		),
		'about'            => array(
			'title'       => 'About Ovents | Luxury Event Planners in London',
			'description' => 'Meet Titilope Fagbore and the Ovents team, luxury wedding and event planners in London, working across the UK.',
			'h1'          => 'Luxury event planners in London',
		),
		'contact'          => array(
			'title'       => 'Contact Ovents | Luxury Event Planner London',
			'description' => 'Planning a wedding, corporate event or private celebration? Get in touch with Ovents, a luxury event planner in London.',
			'h1'          => 'Let’s plan your event',
		),
		'faq'              => array(
			'title'       => 'Event Planning FAQs | Ovents',
			'description' => 'Answers to common questions about wedding, corporate and party planning with Ovents, a London event planner working across the UK.',
			'h1'          => 'Event planning FAQs',
		),
		'portfolio'        => array(
			'title'       => 'Portfolio | Luxury Weddings, Parties and Events | Ovents',
			'description' => 'Selected weddings, private celebrations and events planned by Ovents, the London luxury event planner working across the UK.',
			'h1'          => 'Selected celebrations',
		),
		'blog'             => array(
			'title'       => 'London Wedding & Event Planning Journal | Ovents',
			'description' => 'Practical wedding, corporate event and private party planning guides from Ovents, luxury event planners in London serving clients across the UK.',
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
	if ( is_category() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$raw_desc = term_description( $term );
			if ( is_string( $raw_desc ) && '' !== trim( wp_strip_all_tags( $raw_desc ) ) ) {
				$description = wp_strip_all_tags( $raw_desc );
			} else {
				$description = sprintf(
					/* translators: %s: category name */
					__( 'Journal articles about %s from Ovents, luxury event planners in London serving clients across the United Kingdom.', 'ovents' ),
					$term->name
				);
			}
			return array(
				'title'       => $term->name . ' | Event Planning Journal | Ovents',
				'description' => $description,
			);
		}
	}
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
	return $config[ $slug ] ?? null;
}

/**
 * Production site URL for canonicals (launch domain).
 */
function ovents_canonical_base() {
	if ( function_exists( 'ovents_is_local_env' ) && ovents_is_local_env() ) {
		return untrailingslashit( home_url() );
	}
	$host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( (string) wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	if ( false !== strpos( $host, 'brandnoddev.com' ) ) {
		return untrailingslashit( home_url() );
	}
	return 'https://www.ovents.co.uk';
}
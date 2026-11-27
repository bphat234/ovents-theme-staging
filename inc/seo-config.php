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
 * @return array<string, array{title: string, description: string, h1?: string, focus_keyword?: string}>
 */
function ovents_seo_config() {
	return array(
		'home'             => array(
			'title'          => 'Luxury Event Planner London & the UK | Ovents',
			'description'    => 'Luxury event planning and coordination in London and across the UK. Weddings, parties and corporate events, planned so you can be present.',
			'h1'             => 'Luxury wedding and event planners in London',
			'focus_keyword'  => 'luxury event planner London',
		),
		'weddings'         => array(
			'title'          => 'Luxury Wedding Planner London & UK | Ovents',
			'description'    => 'A luxury wedding planner in London, working across the UK. Full planning or on-the-day coordination, shaped around you.',
			'h1'             => 'Luxury wedding planners in London',
			'focus_keyword'  => 'luxury wedding planner London',
		),
		'corporate-events' => array(
			'title'          => 'Corporate Event Planner London & UK | Ovents',
			'description'    => 'Discreet, polished corporate events in London and across the UK, planned for clients, colleagues and partners.',
			'h1'             => 'Corporate event planners in London',
			'focus_keyword'  => 'corporate event planner London',
		),
		'parties'          => array(
			'title'          => 'Private Party Planner London & UK | Ovents',
			'description'    => 'A party planner in London, working across the UK. Birthdays, anniversaries and private celebrations, planned so you can enjoy them.',
			'h1'             => 'Private party planners in London',
			'focus_keyword'  => 'private party planner London',
		),
		'about'            => array(
			'title'          => 'About Ovents | London Event Planners',
			'description'    => 'Meet Titilope Fagbore and the Ovents team, luxury wedding and event planners in London, working across the UK.',
			'h1'             => 'Luxury event planners in London',
			'focus_keyword'  => 'London event planners',
		),
		'contact'          => array(
			'title'          => 'Contact Ovents | Event Planner London Contact',
			'description'    => 'Planning a wedding, corporate event or private celebration? Get in touch with Ovents, a luxury event planner in London.',
			'h1'             => 'Let’s plan your event',
			'focus_keyword'  => 'event planner London contact',
		),
		'faq'              => array(
			'title'          => 'Event Planning FAQs London | Ovents',
			'description'    => 'Answers to common questions about wedding, corporate and party planning with Ovents, a London event planner working across the UK.',
			'h1'             => 'Event planning FAQs',
			'focus_keyword'  => 'event planning FAQs London',
		),
		'portfolio'        => array(
			'title'          => 'Luxury Event Portfolio London | Ovents',
			'description'    => 'Selected weddings, private celebrations and events planned by Ovents, the London luxury event planner working across the UK.',
			'h1'             => 'Selected celebrations',
			'focus_keyword'  => 'luxury event portfolio London',
		),
		'blog'             => array(
			'title'          => 'Event Planning Journal London | Ovents',
			'description'    => 'Practical wedding, corporate event and private party planning guides from Ovents, luxury event planners in London serving clients across the UK.',
			'h1'             => 'The Ovents Journal',
			'focus_keyword'  => 'event planning journal London',
		),
		'privacy-policy'   => array(
			'title'          => 'Privacy Policy Ovents | Ovents',
			'description'    => 'UK GDPR privacy policy for Ovents LTD: what we collect, lawful bases, cookies, retention and your rights.',
			'h1'             => 'Privacy policy',
			'focus_keyword'  => 'privacy policy Ovents',
		),
		'terms-of-use'     => array(
			'title'          => 'Terms of Use Ovents | Ovents',
			'description'    => 'Website terms of use for Ovents LTD, including acceptable use, liability and governing law.',
			'h1'             => 'Terms of use',
			'focus_keyword'  => 'terms of use Ovents',
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
function ovents_seo_title_contains_focus_keyword( $title, $keyword ) {
	$title   = strtolower( preg_replace( '/\s+/u', ' ', trim( (string) $title ) ) );
	$keyword = strtolower( preg_replace( '/\s+/u', ' ', trim( (string) $keyword ) ) );
	if ( '' === $keyword ) {
		return true;
	}
	return false !== strpos( $title, $keyword );
}

/**
 * Ensure SEO title contains focus_keyword when both are set.
 *
 * @param array<string, mixed> $row title, description, focus_keyword, etc.
 * @return array<string, mixed>
 */
function ovents_rank_math_normalize_seo_row( array $row ) {
	if ( empty( $row['focus_keyword'] ) || empty( $row['title'] ) ) {
		return $row;
	}
	if ( ! ovents_seo_title_contains_focus_keyword( $row['title'], $row['focus_keyword'] ) ) {
		$row['title'] = $row['focus_keyword'] . ' | ' . $row['title'];
	}
	return $row;
}

function ovents_seo_for_request() {
	if ( is_singular( 'post' ) && function_exists( 'ovents_journal_seo_row_for_post' ) ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$row = ovents_journal_seo_row_for_post( $post );
			if ( is_array( $row ) && ! empty( $row['title'] ) ) {
				return $row;
			}
		}
	}
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
			if ( function_exists( 'ovents_portfolio_seo_config' ) ) {
				$map = ovents_portfolio_seo_config();
				if ( isset( $map[ $post->post_name ] ) ) {
					return $map[ $post->post_name ];
				}
			}
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
	if ( function_exists( 'ovents_is_launch_live' ) && ovents_is_launch_live() ) {
		return 'https://ovents.co.uk';
	}
	if ( function_exists( 'ovents_is_production_env' ) && ovents_is_production_env() ) {
		return 'https://ovents.co.uk';
	}
	return untrailingslashit( home_url() );
}

/**
 * Site root URL for JSON-LD (@id, provider URLs) — matches apex canonical on production.
 */
function ovents_schema_site_url() {
	return untrailingslashit( ovents_canonical_base() );
}
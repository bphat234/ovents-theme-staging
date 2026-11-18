<?php
/**
 * Corporate events page helpers (brief §4–9).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Contact URL with corporate query args.
 *
 * @param string $package full|lite-planning|day.
 */
function ovents_corporate_contact_url( $package = '' ) {
	$args = array( 'type' => 'corporate' );
	if ( '' !== $package ) {
		$args['package'] = sanitize_key( $package );
	}
	return add_query_arg( $args, home_url( '/contact/' ) );
}

/**
 * Permalink for the first matching published post slug.
 *
 * @param string|array<int, string> $slugs Post name(s).
 */
function ovents_published_post_url( $slugs ) {
	foreach ( (array) $slugs as $slug ) {
		$slug = sanitize_title( $slug );
		if ( '' === $slug ) {
			continue;
		}
		$posts = get_posts(
			array(
				'name'           => $slug,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'no_found_rows'  => true,
			)
		);
		if ( ! empty( $posts ) ) {
			return get_permalink( $posts[0] );
		}
	}
	return '';
}

/**
 * Visible "From £…" price for a corporate tier, or empty when not configured.
 *
 * @param string $tier full|lite-planning|day.
 */
function ovents_corporate_from_price( $tier ) {
	$map = array(
		'full'          => defined( 'OVENTS_CORP_PRICE_FULL' ) ? OVENTS_CORP_PRICE_FULL : '',
		'lite-planning' => defined( 'OVENTS_CORP_PRICE_LITE' ) ? OVENTS_CORP_PRICE_LITE : '',
		'day'           => defined( 'OVENTS_CORP_PRICE_DAY' ) ? OVENTS_CORP_PRICE_DAY : '',
	);
	$tier = sanitize_key( $tier );
	if ( ! isset( $map[ $tier ] ) || '' === $map[ $tier ] ) {
		return '';
	}
	return (string) $map[ $tier ];
}

/**
 * Full Service JSON-LD for the corporate page (brief §9).
 */
function ovents_echo_corporate_service_schema() {
	$base = untrailingslashit( ovents_canonical_base() );
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'@id'         => $base . '/corporate-events/#service',
		'name'        => 'Corporate event planning',
		'serviceType' => 'Corporate event planning and management',
		'url'         => $base . '/corporate-events/',
		'description' => 'Corporate event planning in London and across the UK for conferences, product launches, gala dinners, awards dinners, Christmas parties and client receptions.',
		'provider'    => array(
			'@type'     => 'Organization',
			'@id'       => $base . '/#organization',
			'name'      => 'Ovents LTD',
			'url'       => $base . '/',
			'telephone' => '+44 7447 462409',
			'email'     => 'info@ovents.co.uk',
		),
		'areaServed'  => array(
			array( '@type' => 'City', 'name' => 'London' ),
			array( '@type' => 'Country', 'name' => 'United Kingdom' ),
		),
		'hasOfferCatalog' => array(
			'@type'           => 'OfferCatalog',
			'name'            => 'Corporate event packages',
			'itemListElement' => array(
				array(
					'@type'      => 'Offer',
					'itemOffered' => array( '@type' => 'Service', 'name' => 'Full package' ),
				),
				array(
					'@type'      => 'Offer',
					'itemOffered' => array( '@type' => 'Service', 'name' => 'Lite planning package' ),
				),
				array(
					'@type'      => 'Offer',
					'itemOffered' => array( '@type' => 'Service', 'name' => 'Day coordination package' ),
				),
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

add_action(
	'wp_head',
	static function () {
		if ( ! is_page( 'corporate-events' ) ) {
			return;
		}
		ovents_echo_corporate_service_schema();
	},
	25
);
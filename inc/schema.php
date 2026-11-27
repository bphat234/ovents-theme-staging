<?php
/**
 * JSON-LD structured data.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output a Service schema block for a page slug.
 *
 * @param string $name        Service name.
 * @param string $description Service description.
 */
function ovents_echo_service_schema( $name, $description ) {
	$service = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => $name,
		'provider'    => array(
			'@type' => 'EventPlanner',
			'name'  => 'Ovents',
		),
		'areaServed'  => array(
			array( '@type' => 'City', 'name' => 'London' ),
			array( '@type' => 'Country', 'name' => 'United Kingdom' ),
		),
		'description' => $description,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $service, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

add_action(
	'wp_head',
	function () {
		$data = array(
			'@context'     => 'https://schema.org',
			'@type'        => array( 'EventPlanner', 'LocalBusiness' ),
			'name'         => 'Ovents',
			'legalName'    => 'Ovents LTD',
			'url'          => ovents_is_launch_live() ? 'https://www.ovents.co.uk/' : home_url( '/' ),
			'telephone'    => '+44 7447 462409',
			'email'        => 'info@ovents.co.uk',
			'description'  => 'Luxury wedding, corporate and private party planning and coordination from London across the United Kingdom.',
			'image'        => ovents_default_og_image_url(),
			'address'      => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => 'London',
				'addressCountry'  => 'GB',
			),
			'openingHours' => 'Mo-Fr 09:00-17:00',
			'areaServed'   => array(
				array( '@type' => 'City', 'name' => 'London' ),
				array( '@type' => 'Country', 'name' => 'United Kingdom' ),
			),
			'sameAs'       => array( 'https://www.instagram.com/ovents_ltd/' ),
			'identifier'   => array(
				'@type'         => 'PropertyValue',
				'propertyID'    => 'UK Company Registration',
				'value'         => '11531903',
			),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

		if ( is_page( 'weddings' ) ) {
			ovents_echo_service_schema(
				'Wedding planning and coordination',
				'Full wedding planning and on-the-day coordination services in London and across the United Kingdom.'
			);
		}
		// Corporate Service JSON-LD: inc/corporate-page.php (always, including with AIOSEO).
		if ( is_page( 'parties' ) ) {
			ovents_echo_service_schema(
				'Private party planning',
				'Private party planning and coordination for birthdays, anniversaries and milestone celebrations.'
			);
		}

		if ( is_page( 'faq' ) ) {
			require_once get_template_directory() . '/inc/faq-schema-data.php';
			$entities = array();
			foreach ( ovents_faq_schema_items() as $item ) {
				$entities[] = array(
					'@type'          => 'Question',
					'name'           => $item['question'],
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => $item['answer'],
					),
				);
			}
			$faq = array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $entities,
			);
			echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
		}

		if ( is_singular( 'post' ) && function_exists( 'ovents_extract_post_faq_items' ) ) {
			$post_faq = ovents_extract_post_faq_items( get_queried_object() );
			if ( ! empty( $post_faq ) ) {
				$entities = array();
				foreach ( $post_faq as $item ) {
					$entities[] = array(
						'@type'          => 'Question',
						'name'           => $item['question'],
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => $item['answer'],
						),
					);
				}
				$faq = array(
					'@context'   => 'https://schema.org',
					'@type'      => 'FAQPage',
					'mainEntity' => $entities,
				);
				echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
			}
		}
	},
	20
);

/**
 * About page graph: AboutPage + Person + founder link on Organization (no full Organization node).
 */
function ovents_echo_about_founder_schema() {
	if ( ! is_page( 'about' ) ) {
		return;
	}

	$home      = untrailingslashit( home_url() );
	$about_url = trailingslashit( home_url( '/about' ) );
	$portrait  = get_template_directory_uri() . '/assets/img/founder-portrait-800.jpg';

	$graph = array(
		array(
			'@type'      => 'AboutPage',
			'@id'        => $home . '/about/#aboutpage',
			'url'        => $about_url,
			'about'      => array( '@id' => $home . '/#organization' ),
			'mainEntity' => array( '@id' => $home . '/about/#founder' ),
		),
		array(
			'@type'     => 'Person',
			'@id'       => $home . '/about/#founder',
			'name'      => 'Titilope Fagbore',
			'jobTitle'  => 'Founder',
			'worksFor'  => array( '@id' => $home . '/#organization' ),
			'image'     => $portrait,
			'url'       => $about_url,
		),
		array(
			'@id'     => $home . '/#organization',
			'founder' => array( '@id' => $home . '/about/#founder' ),
		),
	);

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

add_action( 'wp_head', 'ovents_echo_about_founder_schema', 21 );

/**
 * JSON-LD for a single portfolio event (CreativeWork + ImageGallery).
 */
function ovents_echo_portfolio_event_schema() {
	if ( ! is_singular( OVENTS_PORTFOLIO_CPT ) ) {
		return;
	}
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post || ! function_exists( 'ovents_portfolio_get_meta' ) ) {
		return;
	}
	$meta  = ovents_portfolio_get_meta( $post );
	$slug  = $meta['event_slug'] ?: $post->post_name;
	$intro = ovents_portfolio_visible_intro( $meta );
	$url   = get_permalink( $post );
	$cover = get_theme_file_uri( 'assets/img/portfolio/' . $slug . '/' . $meta['cover_stem'] . '-1200.jpg' );

	$images = array( $cover );
	if ( ! empty( $meta['gallery'] ) && is_array( $meta['gallery'] ) ) {
		foreach ( $meta['gallery'] as $item ) {
			if ( empty( $item['stem'] ) ) {
				continue;
			}
			$images[] = get_theme_file_uri( 'assets/img/portfolio/' . $slug . '/' . $item['stem'] . '-1600.jpg' );
		}
	}

	$node = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'CreativeWork',
		'name'        => get_the_title( $post ),
		'url'         => $url,
		'image'       => $cover,
		'description' => $intro,
		'associatedMedia' => array(
			'@type'      => 'ImageGallery',
			'name'       => get_the_title( $post ),
			'image'      => $images,
		),
		'isPartOf'    => array(
			'@id' => untrailingslashit( home_url() ) . '/#organization',
		),
	);

	if ( trim( $meta['photographer'] ) ) {
		$node['creator'] = array(
			'@type' => 'Organization',
			'name'  => $meta['photographer'],
		);
	}

	if ( 'the-planners-table' === $post->post_name && ! empty( $meta['schema_date'] ) ) {
		$node['startDate'] = $meta['schema_date'];
		$node['organizer'] = array(
			'@id' => untrailingslashit( home_url() ) . '/#organization',
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $node, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

add_action( 'wp_head', 'ovents_echo_portfolio_event_schema', 22 );
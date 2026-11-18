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
		'areaServed'  => 'United Kingdom',
		'description' => $description,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $service, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

add_action(
	'wp_head',
	function () {
		if ( ovents_aioseo_active() ) {
			return;
		}
		$data = array(
			'@context'     => 'https://schema.org',
			'@type'        => array( 'EventPlanner', 'LocalBusiness' ),
			'name'         => 'Ovents',
			'legalName'    => 'Ovents LTD',
			'url'          => ovents_is_launch_live() ? 'https://www.ovents.co.uk/' : home_url( '/' ),
			'telephone'    => '+447447462409',
			'email'        => 'info@ovents.co.uk',
			'description'  => 'Luxury wedding, corporate and private party planning from London across the United Kingdom.',
			'image'        => ovents_default_og_image_url(),
			'address'      => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => 'London',
				'addressCountry'  => 'GB',
			),
			'openingHours' => 'Mo-Fr 09:00-17:00',
			'areaServed'   => array(
				array( '@type' => 'Country', 'name' => 'United Kingdom' ),
			),
			'sameAs'       => array( 'https://www.instagram.com/ovents_ltd/' ),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

		if ( is_page( 'weddings' ) ) {
			ovents_echo_service_schema(
				'Wedding planning and coordination',
				'Wedding planning and on-the-day coordination in London and across the UK.'
			);
		}
		// Corporate Service JSON-LD: inc/corporate-page.php (always, including with AIOSEO).
		if ( is_page( 'parties' ) ) {
			ovents_echo_service_schema(
				'Private party planning',
				'Private party planning for birthdays, anniversaries and milestone celebrations.'
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
	},
	20
);
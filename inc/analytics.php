<?php
/**
 * GA4 + Consent Mode v2 (measurement ID via filter or wp-config).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * GA4 measurement ID — set in wp-config: define( 'OVENTS_GA4_ID', 'G-XXXXXXXX' );
 */
function ovents_ga4_measurement_id() {
	if ( defined( 'OVENTS_GA4_ID' ) && OVENTS_GA4_ID ) {
		return (string) OVENTS_GA4_ID;
	}
	return (string) apply_filters( 'ovents_ga4_measurement_id', '' );
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_script(
			'ovents-consent',
			get_theme_file_uri( 'assets/js/consent.js' ),
			array( 'jquery' ),
			OVENTS_VERSION,
			true
		);
		wp_localize_script(
			'ovents-consent',
			'oventsAnalytics',
			array(
				'measurementId' => ovents_ga4_measurement_id(),
			)
		);
	},
	5
);

/**
 * Push generate_lead after successful enquiry redirect.
 */
add_action(
	'wp_footer',
	function () {
		if ( ! is_page( 'contact' ) || ! isset( $_GET['enquiry'] ) || 'thanks' !== $_GET['enquiry'] ) {
			return;
		}
		if ( ! ovents_ga4_measurement_id() ) {
			return;
		}
		?>
		<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({ event: 'generate_lead', lead_type: 'enquiry_form' });
		</script>
		<?php
	},
	20
);
<?php
/**
 * Global footer CTA.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether to render the footer CTA band.
 */
function ovents_show_footer_cta() {
	if ( is_page( 'contact' ) ) {
		return false;
	}

	/**
	 * Filter footer CTA visibility.
	 *
	 * @param bool $show Default true except on contact.
	 */
	return (bool) apply_filters( 'ovents_show_footer_cta', true );
}

/**
 * Footer CTA copy and actions for the current request.
 *
 * @return array<string, mixed>
 */
function ovents_footer_cta_config() {
	$config = array(
		'eyebrow'        => 'Based in London · UK-wide',
		'title'          => __( 'Let’s plan something exceptional', 'ovents' ),
		'text'           => __( 'Tell us about your event, your ideas and what matters most.', 'ovents' ),
		'primary_url'    => home_url( '/contact/' ),
		'primary_label'  => __( 'Book a free consultation', 'ovents' ),
		'heading_id'     => 'footer-cta-heading',
		'variant'        => 'default',
		'show_corporate' => false,
	);

	if ( is_page( 'corporate-events' ) ) {
		$config = array_merge(
			$config,
			array(
				'title'          => __( 'Book a free discovery call', 'ovents' ),
				'text'           => __( 'Tell us what you\'re planning – the date, the guests and what success looks like. We\'ll reply within one to two business days to arrange your free discovery call, then send a tailored proposal and quote, with no obligation.', 'ovents' ),
				'primary_url'    => ovents_corporate_contact_url(),
				'primary_label'  => __( 'Book a free discovery call', 'ovents' ),
				'heading_id'     => 'corp-closing-heading',
				'variant'        => 'corporate',
				'show_corporate' => true,
			)
		);
	}

	return apply_filters( 'ovents_footer_cta_config', $config );
}

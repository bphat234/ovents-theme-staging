<?php
/**
 * Hero header chrome (Wix-style transparent bar over image heroes).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages that use the transparent fixed header over a full-width hero image.
 */
function ovents_use_hero_chrome() {
	if ( is_front_page() ) {
		return true;
	}
	if ( is_home() && ! is_front_page() ) {
		return true;
	}
	if ( is_category() ) {
		return true;
	}
	if ( is_singular( 'post' ) ) {
		return true;
	}
	if ( is_page( array( 'weddings', 'corporate-events', 'parties', 'about', 'contact', 'faq', 'blog', 'portfolio', 'privacy-policy', 'terms-of-use' ) ) ) {
		return true;
	}
	if ( defined( 'OVENTS_PORTFOLIO_CPT' ) && ( is_post_type_archive( OVENTS_PORTFOLIO_CPT ) || is_singular( OVENTS_PORTFOLIO_CPT ) ) ) {
		return true;
	}
	return false;
}

/**
 * @param array $args Template-part args for inner-hero.
 */
function ovents_get_inner_hero_args( $args = array() ) {
	$home = untrailingslashit( home_url() );
	$defaults = array(
		'eyebrow'    => '',
		'title'      => ovents_page_h1(),
		'lead'       => '',
		'image'      => 'intro.jpg',
		'image_name' => '',
		'image_url'  => '',
		'show_ctas'  => true,
		'show_secondary' => false,
		'contact'    => $home . '/contact/',
		'primary_label' => 'Book a free consultation',
		'secondary_label' => '',
		'secondary_url' => '',
	);

	if ( ( is_home() && ! is_front_page() ) || is_page( 'blog' ) ) {
		$defaults = array_merge(
			$defaults,
			array(
				'eyebrow'    => '',
				'title'      => 'The Ovents Journal',
				'image'      => 'intro.jpg',
				'image_name' => 'intro',
				'lead'       => 'Practical guidance from our planners on weddings, parties, corporate occasions and the details that make celebrations feel effortless.',
				'show_ctas'  => false,
			)
		);
	}

	if ( is_singular( 'post' ) ) {
		$cats    = get_the_category();
		$thumb    = get_the_post_thumbnail_url( get_queried_object_id(), 'full' );
		$defaults = array_merge(
			$defaults,
			array(
				'eyebrow'    => '',
				'title'      => get_the_title(),
				'lead'       => wp_trim_words( get_the_excerpt(), 24 ),
				'image'      => 'intro.jpg',
				'image_name' => $thumb ? '' : 'intro',
				'image_url'  => $thumb ? $thumb : '',
				'show_ctas'  => false,
			)
		);
	}

	if ( is_category() ) {
		$term = get_queried_object();
		$defaults = array_merge(
			$defaults,
			array(
				'eyebrow'    => '',
				'title'      => $term instanceof WP_Term ? $term->name : 'Journal',
				'image'      => 'intro.jpg',
				'image_name' => 'intro',
				'lead'       => 'Articles in this category.',
				'show_ctas'  => false,
			)
		);
	}

	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		$map  = array(
			'about'     => array(
				'eyebrow'         => '',
				'image'           => 'hero-outdoor-tablescape-1200.jpg',
				'lead'            => 'Behind every calm, beautiful day is careful planning you never have to see.',
				'show_secondary'  => true,
				'secondary_label' => 'View our work',
				'secondary_url'   => $home . '/portfolio/',
			),
			'weddings'  => array(
				'eyebrow'         => '',
				'image'           => 'weddings-hero.jpg',
				'lead'            => 'A wedding that feels effortless, planned with care, here in London and across the UK.',
				'show_secondary'  => true,
				'secondary_label' => 'Wedding FAQs',
				'secondary_url'   => $home . '/faq/#faq-weddings',
			),
			'corporate-events' => array(
				'eyebrow'         => '',
				'image'           => 'corporate-hero.jpg',
				'lead'            => 'Discreet, polished events that reflect your brand, whether your guests are clients, colleagues or partners.',
				'contact'         => $home . '/contact/?type=corporate',
				'primary_label'   => 'Book a discovery call',
				'show_secondary'  => true,
				'secondary_label' => 'Chat on WhatsApp',
				'secondary_url'   => ovents_whatsapp_corporate_url(),
				'cta_note'        => "We’ll reply within one to two business days.",
			),
			'parties'   => array(
				'eyebrow'         => '',
				'image'           => 'parties-hero.jpg',
				'lead'            => 'Celebrations for the people you love, planned so you can be in the room, not managing it.',
				'show_secondary'  => true,
				'secondary_label' => 'Party FAQs',
				'secondary_url'   => $home . '/faq/#faq-parties',
			),
			'contact'   => array(
				'eyebrow'     => '',
				'show_ctas'   => false,
				'image'       => 'contact-hero.jpg',
				'lead'        => 'Tell us what you’re planning. We’ll take it from there.',
			),
			'blog'      => array(
				'eyebrow'    => '',
				'image'      => 'intro.jpg',
				'image_name' => 'intro',
				'lead'       => 'Practical guidance from our planners on weddings, parties, corporate occasions and the details that make celebrations feel effortless.',
				'show_ctas'  => false,
			),
			'faq'       => array(
				'eyebrow'    => '',
				'show_ctas'  => false,
				'image'      => 'faq-hero.jpg',
				'image_name' => 'faq-hero',
				'lead'       => 'Answers from a London event planner, working across the UK.',
			),
			'portfolio' => array(
				'eyebrow'   => '',
				'image'     => 'service-weddings.jpg',
				'lead'      => 'A selection of weddings, celebrations and our own industry events.',
				'show_ctas' => false,
			),
			'privacy-policy' => array(
				'eyebrow'    => '',
				'image'      => 'faq-hero.jpg',
				'image_name' => 'faq-hero',
				'lead'       => 'How we collect, use and protect your personal information when you enquire or book with us.',
				'show_ctas'  => false,
			),
			'terms-of-use' => array(
				'eyebrow'    => '',
				'image'      => 'faq-hero.jpg',
				'image_name' => 'faq-hero',
				'lead'      => 'Terms for using this site and submitting event planning enquiries.',
				'show_ctas' => false,
			),
		);
		if ( isset( $map[ $slug ] ) ) {
			$defaults = array_merge( $defaults, $map[ $slug ] );
			if ( function_exists( 'ovents_inner_hero_manifest_name' ) ) {
				$manifest_name = ovents_inner_hero_manifest_name( $slug );
				if ( '' !== $manifest_name ) {
					$defaults['image_name'] = $manifest_name;
				}
			}
		}
	}

	return wp_parse_args( $args, $defaults );
}

add_filter(
	'body_class',
	function ( $classes ) {
		if ( ovents_use_hero_chrome() && ! is_front_page() ) {
			$classes[] = 'has-inner-hero-header';
		}
		return $classes;
	}
);

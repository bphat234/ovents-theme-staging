<?php
/**
 * Case study custom post type (portfolio).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	function () {
		register_post_type(
			'ovents_case',
			array(
				'labels'       => array(
					'name'          => __( 'Case studies', 'ovents' ),
					'singular_name' => __( 'Case study', 'ovents' ),
				),
				'public'       => true,
				'show_in_rest' => true,
				'has_archive'  => false,
				'rewrite'      => array( 'slug' => 'case-study' ),
				'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'menu_icon'    => 'dashicons-portfolio',
			)
		);
	}
);

/**
 * Published case study count (permission to publish).
 */
function ovents_case_study_published_count() {
	$q = new WP_Query(
		array(
			'post_type'      => 'ovents_case',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	return (int) $q->found_posts;
}

add_action(
	'after_switch_theme',
	'ovents_seed_case_study_placeholders'
);
add_action( 'init', 'ovents_seed_case_study_placeholders', 99 );

/**
 * One draft placeholder per event type.
 */
function ovents_seed_case_study_placeholders() {
	if ( get_option( 'ovents_case_studies_seeded' ) ) {
		return;
	}
	$items = array(
		array(
			'title'   => '[CASE STUDY] London wedding',
			'slug'    => 'placeholder-wedding-case-study',
			'excerpt' => 'Event type: Wedding · Location: [VENUE/COUNTY] · [REAL EVENT PHOTO]',
			'content' => "<p>[REAL EVENT PHOTO]</p><p><strong>Brief:</strong> [CLIENT BRIEF]</p><p><strong>What we did:</strong> [SERVICES DELIVERED]</p><blockquote>[REAL CLIENT QUOTE]</blockquote><p><em>Permission to publish: [YES/NO]</em></p>",
		),
		array(
			'title'   => '[CASE STUDY] Corporate launch',
			'slug'    => 'placeholder-corporate-case-study',
			'excerpt' => 'Event type: Corporate · Location: [VENUE/COUNTY] · [REAL EVENT PHOTO]',
			'content' => "<p>[REAL EVENT PHOTO]</p><p><strong>Brief:</strong> [CLIENT BRIEF]</p><p><strong>What we did:</strong> [SERVICES DELIVERED]</p><blockquote>[REAL CLIENT QUOTE]</blockquote>",
		),
	);
	foreach ( $items as $item ) {
		if ( get_page_by_path( $item['slug'], OBJECT, 'ovents_case' ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $item['title'],
				'post_name'    => $item['slug'],
				'post_status'  => 'draft',
				'post_type'    => 'ovents_case',
				'post_excerpt' => $item['excerpt'],
				'post_content' => $item['content'],
			)
		);
	}
	update_option( 'ovents_case_studies_seeded', 1 );
}
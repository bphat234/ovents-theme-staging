<?php
/**
 * Journal post SEO (Rank Math title, description, focus keyword).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<string, array{title: string, description: string, focus_keyword: string}>
 */
function ovents_journal_seo_config() {
	return array(
		'wedding-planner-cost-uk'                                      => array(
			'title'         => 'Wedding Planner Cost UK | Ovents Journal',
			'description'   => 'What wedding planners cost in the UK, how packages differ, and what to budget for planning and coordination with Ovents.',
			'focus_keyword' => 'wedding planner cost UK',
		),
		'full-planning-vs-partial-planning-vs-on-the-day-coordination' => array(
			'title'         => 'Full Planning vs On-the-Day Coordination | Ovents Journal',
			'description'   => 'Compare full wedding planning, partial planning and on-the-day coordination so you can choose the right level of support.',
			'focus_keyword' => 'on-the-day coordination',
		),
		'how-to-choose-a-wedding-planner-london'                       => array(
			'title'         => 'How to Choose a Wedding Planner London | Ovents',
			'description'   => 'Practical steps for choosing a wedding planner in London: questions to ask, red flags, and how we work at Ovents.',
			'focus_keyword' => 'wedding planner London',
		),
		'corporate-event-planning-checklist'                           => array(
			'title'         => 'Corporate Event Planning Checklist London | Ovents',
			'description'   => 'A practical corporate event planning checklist for launches, conferences and client events in London and across the UK.',
			'focus_keyword' => 'corporate event planning London',
		),
		'plan-product-launch-conference-london'                        => array(
			'title'         => 'Plan a Product Launch Conference London | Ovents',
			'description'   => 'How to plan a product launch or conference in London: timelines, suppliers and guest experience.',
			'focus_keyword' => 'product launch conference London',
		),
		'milestone-birthday-party-ideas'                               => array(
			'title'         => 'Milestone Birthday Party Ideas London | Ovents',
			'description'   => 'Ideas and planning tips for milestone birthday parties in London, from venues to guest flow.',
			'focus_keyword' => 'milestone birthday party ideas',
		),
		'wedding-party-entertainment-ideas'                            => array(
			'title'         => 'Wedding Party Entertainment Ideas UK | Ovents',
			'description'   => 'Wedding party entertainment ideas that suit your guest list, venue and tone—without overwhelming the day.',
			'focus_keyword' => 'wedding party entertainment ideas',
		),
	);
}

/**
 * SEO row for a journal post (curated map or publish fallback).
 *
 * @param WP_Post $post Post object.
 * @return array{title: string, description: string, focus_keyword: string}|null
 */
function ovents_journal_seo_row_for_post( WP_Post $post ) {
	$map = ovents_journal_seo_config();
	if ( isset( $map[ $post->post_name ] ) ) {
		return $map[ $post->post_name ];
	}
	if ( 'publish' !== $post->post_status ) {
		return null;
	}
	$keyword = strtolower( preg_replace( '/\s+/u', ' ', str_replace( '-', ' ', $post->post_name ) ) );
	$phrase  = ucwords( $keyword );
	$desc    = has_excerpt( $post )
		? wp_strip_all_tags( get_the_excerpt( $post ) )
		: sprintf(
			/* translators: %s: post title phrase */
			__( 'Event planning insights: %s from Ovents, luxury event planners in London.', 'ovents' ),
			$phrase
		);
	return array(
		'title'           => $phrase . ' | Ovents Journal',
		'description'     => $desc,
		'focus_keyword'   => $keyword,
	);
}
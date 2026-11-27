<?php
/**
 * FAQ copy for FAQPage JSON-LD (mirrors faq-content.php).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<int, array{question: string, answer: string}>
 */
function ovents_faq_schema_items() {
	return array(
		array(
			'question' => 'Where is Ovents based?',
			'answer'   => 'Ovents is based in London, United Kingdom. We plan and coordinate events across the UK, from city venues to countryside estates.',
		),
		array(
			'question' => 'Which areas do you cover?',
			'answer'   => 'We work UK-wide, including London, Essex, Hertfordshire, Surrey, Kent, Sussex and further afield in England, Scotland, Wales and Northern Ireland.',
		),
		array(
			'question' => 'What types of events do you plan?',
			'answer'   => 'Weddings, corporate events and private parties, including birthdays, anniversaries, launches and milestone celebrations.',
		),
		array(
			'question' => 'Do you plan weddings outside London?',
			'answer'   => 'Yes. We plan and coordinate weddings nationwide across the UK.',
		),
		array(
			'question' => 'What is the difference between wedding planning and coordination?',
			'answer'   => 'Planning covers research, suppliers and decisions before the day. Coordination focuses on delivering the plan on the day, managing suppliers and the schedule. We offer both.',
		),
		array(
			'question' => 'What types of corporate events do you manage?',
			'answer'   => 'Launches, conferences, awards dinners, client receptions, team celebrations and brand activations.',
		),
		array(
			'question' => 'Can you plan parties in private homes?',
			'answer'   => 'Yes. We adapt logistics to your space, including private homes, restaurants, rooftops and marquee venues.',
		),
		array(
			'question' => 'How do consultations work?',
			'answer'   => 'We begin with a complimentary consultation to understand your vision, budget and timeline. From there we outline a bespoke proposal and clear next steps.',
		),
		array(
			'question' => 'What does a wedding planner cost?',
			'answer'   => 'Every proposal is itemised after a free consultation. Costs depend on your date, location, guest numbers and the level of planning or coordination you need.',
		),
	);
}

/**
 * Extract FAQ Q&A pairs from single post content (looks for <details><summary> blocks).
 *
 * @param WP_Post|null $post Post object.
 * @return array<int, array{question: string, answer: string}>
 */
function ovents_extract_post_faq_items( $post ) {
	if ( ! $post instanceof WP_Post || empty( $post->post_content ) ) {
		return array();
	}

	$content = apply_filters( 'the_content', $post->post_content );
	if ( ! is_string( $content ) || '' === trim( $content ) ) {
		return array();
	}

	$items = array();
	libxml_use_internal_errors( true );
	$dom = new DOMDocument();
	$dom->loadHTML( '<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	libxml_clear_errors();

	$details_list = $dom->getElementsByTagName( 'details' );
	if ( $details_list->length === 0 ) {
		return array();
	}

	foreach ( $details_list as $details ) {
		$summary_nodes = $details->getElementsByTagName( 'summary' );
		if ( $summary_nodes->length === 0 ) {
			continue;
		}
		$summary = $summary_nodes->item( 0 );
		$question = trim( $summary->textContent );
		if ( '' === $question ) {
			continue;
		}

		$answer_parts = array();
		foreach ( $details->childNodes as $child ) {
			if ( $child->nodeName === 'summary' ) {
				continue;
			}
			$text = trim( $child->textContent );
			if ( '' !== $text ) {
				$answer_parts[] = $text;
			}
		}
		$answer = implode( ' ', $answer_parts );
		if ( '' === $answer ) {
			continue;
		}

		$items[] = array(
			'question' => $question,
			'answer'   => $answer,
		);
	}

	return $items;
}
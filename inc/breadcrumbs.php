<?php
/**
 * Breadcrumb navigation.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Breadcrumb trail items for current page.
 *
 * @return array<int, array{label: string, url?: string}>
 */
function ovents_breadcrumb_trail() {
	$items = array(
		array(
			'label' => 'Home',
			'url'   => home_url( '/' ),
		),
	);

	if ( is_front_page() ) {
		return $items;
	}

	if ( is_home() && ! is_front_page() ) {
		$items[] = array( 'label' => 'The Ovents Journal' );
	}

	if ( is_category() ) {
		$items[] = array(
			'label' => 'The Ovents Journal',
			'url'   => home_url( '/blog/' ),
		);
		$items[] = array( 'label' => single_cat_title( '', false ) );
	}

	if ( is_singular( 'post' ) ) {
		$items[] = array(
			'label' => 'The Ovents Journal',
			'url'   => home_url( '/blog/' ),
		);
		$items[] = array( 'label' => get_the_title() );
	}

	if ( is_singular( 'page' ) ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$service_labels = array( 'weddings' => 'Weddings', 'corporate-events' => 'Corporate', 'parties' => 'Parties' );
			$items[] = array( 'label' => $service_labels[ $post->post_name ] ?? $post->post_title );
		}
	}

	return $items;
}

/**
 * Output breadcrumb HTML.
 */
function ovents_render_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$trail = ovents_breadcrumb_trail();
	if ( count( $trail ) < 2 ) {
		return;
	}
	echo '<nav class="breadcrumbs breadcrumbs--inner wrap" aria-label="Breadcrumb">';
	echo '<ol class="breadcrumbs__list">';
	foreach ( $trail as $i => $crumb ) {
		$is_last = $i === count( $trail ) - 1;
		echo '<li class="breadcrumbs__item">';
		if ( ! $is_last && ! empty( $crumb['url'] ) ) {
			echo '<a href="' . esc_url( $crumb['url'] ) . '">' . esc_html( $crumb['label'] ) . '</a>';
		} else {
			echo '<span aria-current="page">' . esc_html( $crumb['label'] ) . '</span>';
		}
		echo '</li>';
	}
	echo '</ol></nav>';
}

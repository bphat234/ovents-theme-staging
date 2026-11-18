<?php
/**
 * Navigation helpers.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback menu when none assigned.
 */
function ovents_fallback_menu() {
	$items = array(
		'about'            => 'About',
		'weddings'         => 'Services',
		'contact'          => 'Contact',
	);
	echo '<ul class="menu-primary">';
	foreach ( $items as $slug => $label ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( home_url( '/' . $slug . '/' ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Inline header menu fallback (desktop).
 */
function ovents_fallback_menu_inline() {
	$items = array(
		'about'            => 'About',
		'weddings'         => 'Weddings',
		'corporate-events' => 'Corporate',
		'parties'          => 'Parties',
		'contact'          => 'Contact',
	);
	echo '<ul class="menu-primary menu-primary--inline">';
	foreach ( $items as $slug => $label ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( home_url( '/' . $slug . '/' ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

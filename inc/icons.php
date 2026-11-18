<?php
/**
 * Lucide outline icons (inline SVG).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output a Lucide icon.
 *
 * @param string $name  Icon name (phone, mail, menu, x, instagram, message-circle).
 * @param array  $attrs Optional width, height, class.
 */
function ovents_icon( $name, $attrs = array() ) {
	$width  = isset( $attrs['width'] ) ? (int) $attrs['width'] : 20;
	$height = isset( $attrs['height'] ) ? (int) $attrs['height'] : 20;
	$class  = 'lucide lucide-' . sanitize_html_class( $name );
	if ( ! empty( $attrs['class'] ) ) {
		$class .= ' ' . sanitize_html_class( $attrs['class'] );
	}

	$paths = array(
		'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'           => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'menu'           => '<line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>',
		'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
		'instagram'      => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
		'message-circle' => '<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>',
		'chevron-down'   => '<path d="m6 9 6 6 6-6"/>',
		'chevron-left'   => '<path d="m15 18-6-6 6-6"/>',
		'chevron-right'  => '<path d="m9 18 6-6-6-6"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" width="%1$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="%3$s" aria-hidden="true">%4$s</svg>',
		$width,
		$height,
		esc_attr( $class ),
		$paths[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup.
	);
}

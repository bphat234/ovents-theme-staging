<?php
/**
 * Inner page layout helpers.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme image URL.
 *
 * @param string $file Path under assets/img/.
 */
function ovents_img_uri( $file ) {
	return get_theme_file_uri( 'assets/img/' . ltrim( $file, '/' ) );
}

/**
 * Breadcrumbs directly under an inner hero.
 */
function ovents_inner_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	echo '<div class="inner-breadcrumbs">';
	ovents_render_breadcrumbs();
	echo '</div>';
}


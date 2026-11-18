<?php
/**
 * Theme media URLs (hero video, etc.).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Homepage service column backgrounds (Wix static.wixstatic.com assets).
 *
 * @return array<string, string> Filename under assets/img/.
 */
function ovents_home_service_images() {
	return array(
		'weddings'  => 'card-service-weddings',
		'corporate' => 'card-service-corporate',
		'parties'   => 'card-service-parties',
	);
}

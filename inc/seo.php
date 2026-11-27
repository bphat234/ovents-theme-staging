<?php
/**
 * Theme SEO output (AIOSEO and Rank Math aware).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/seo-config.php';

/**
 * Whether Rank Math should own meta output.
 */
function ovents_rank_math_active() {
	return defined( 'RANK_MATH_VERSION' ) || function_exists( 'rank_math' );
}

/**
 * Whether All in One SEO is active.
 */
function ovents_aioseo_active() {
	return defined( 'AIOSEO_VERSION' ) || class_exists( 'AIOSEO\\Plugin\\AIOSEO' );
}

/**
 * SEO plugin owns front-end meta tags.
 */
function ovents_seo_plugin_active() {
	return ovents_rank_math_active() || ovents_aioseo_active();
}

add_filter(
	'document_title_parts',
	function ( $parts ) {
		$row = ovents_seo_for_request();
		if ( ! $row ) {
			return $parts;
		}
		$parts['title'] = preg_replace( '/\s*\|\s*Ovents\s*$/', '', $row['title'] );
		$parts['site']  = 'Ovents';
		return $parts;
	},
	20
);

add_filter(
	'pre_get_document_title',
	function ( $title ) {
		if ( ovents_seo_plugin_active() ) {
			return $title;
		}
		$row = ovents_seo_for_request();
		return $row ? $row['title'] : $title;
	},
	20
);

if ( ovents_rank_math_active() ) {
	add_filter(
		'rank_math/frontend/title',
		function ( $title ) {
			$row = ovents_seo_for_request();
			return $row ? $row['title'] : $title;
		},
		20
	);
	add_filter(
		'rank_math/frontend/description',
		function ( $description ) {
			$row = ovents_seo_for_request();
			return $row ? $row['description'] : $description;
		},
		20
	);
	add_filter(
		'rank_math/json_ld',
		function ( $data ) {
			if ( isset( $data['breadcrumb'] ) ) {
				unset( $data['breadcrumb'] );
			}
			return $data;
		},
		99
	);
	add_filter(
		'rank_math/opengraph/facebook/image',
		function ( $image ) {
			if ( empty( $image ) ) {
				return ovents_seo_social_image();
			}
			return $image;
		},
		20
	);
	add_filter(
		'rank_math/opengraph/twitter/image',
		function ( $image ) {
			if ( empty( $image ) ) {
				return ovents_seo_social_image();
			}
			return $image;
		},
		20
	);
}

if ( ovents_aioseo_active() ) {
	add_filter( 'aioseo_schema_breadcrumb', '__return_false' );
	add_filter(
		'aioseo_title',
		function ( $title ) {
			$row = ovents_seo_for_request();
			return $row ? $row['title'] : $title;
		},
		20
	);
	add_filter(
		'aioseo_description',
		function ( $description ) {
			$row = ovents_seo_for_request();
			return $row ? $row['description'] : $description;
		},
		20
	);
}

add_action(
	'wp_head',
	function () {
		if ( ovents_seo_plugin_active() ) {
			return;
		}
		$row = ovents_seo_for_request();
		if ( ! $row ) {
			return;
		}
		echo '<meta name="description" content="' . esc_attr( $row['description'] ) . '">' . "\n";
	},
	2
);

add_action(
	'wp_head',
	function () {
		if ( ovents_seo_plugin_active() ) {
			return;
		}
		$base = untrailingslashit( ovents_canonical_base() );
		if ( is_front_page() ) {
			$canonical = $base . '/';
		} elseif ( is_home() && ! is_front_page() ) {
			$canonical = $base . '/blog/';
		} elseif ( is_singular() ) {
			$path      = wp_parse_url( get_permalink(), PHP_URL_PATH );
			$canonical = $base . ( $path ? user_trailingslashit( $path ) : '/' );
		} else {
			return;
		}
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
	},
	3
);

/**
 * Default Open Graph image (1200×630 recommended: assets/img/og-default.jpg).
 */
function ovents_default_og_image_url() {
	if ( function_exists( 'ovents_manifest_image_jpeg_url' ) ) {
		$url = ovents_manifest_image_jpeg_url( 'hero-erica-samuel-pavilion' );
		if ( $url ) {
			return $url;
		}
	}
	$og = get_theme_file_path( 'assets/img/og-default.jpg' );
	if ( file_exists( $og ) ) {
		return get_theme_file_uri( 'assets/img/og-default.jpg' );
	}
	return get_theme_file_uri( 'assets/img/hero-erica-samuel-pavilion-1200.jpg' );
}

/**
 * Per-page Open Graph image for the current request.
 */
function ovents_seo_social_image() {
	if ( is_front_page() && function_exists( 'ovents_manifest_image_jpeg_url' ) ) {
		$url = ovents_manifest_image_jpeg_url( 'hero-erica-samuel-pavilion' );
		if ( $url ) {
			return $url;
		}
	}
	$map = array(
		'weddings'         => 'hero-erica-samuel-bridge',
		'corporate-events' => 'hero-planners-table-lunch-learn',
		'parties'          => 'hero-balloon-celebration',
		'about'            => 'hero-outdoor-tablescape',
		'contact'          => 'hero-erica-samuel-vineyard',
		'portfolio'        => 'hero-erica-samuel-sweetheart-table',
	);
	$slug = ovents_seo_slug();
	if ( function_exists( 'ovents_manifest_image_jpeg_url' ) && isset( $map[ $slug ] ) ) {
		$url = ovents_manifest_image_jpeg_url( $map[ $slug ] );
		if ( $url ) {
			return $url;
		}
	}
	return ovents_default_og_image_url();
}

add_action(
	'wp_head',
	function () {
		if ( ovents_seo_plugin_active() ) {
			return;
		}
		$row = ovents_seo_for_request();
		if ( ! $row ) {
			return;
		}
		$url   = is_front_page() ? ovents_canonical_base() . '/' : get_permalink();
		$image = ovents_seo_social_image();
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $row['title'] ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $row['description'] ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		echo '<meta property="og:image:width" content="1200">' . "\n";
		echo '<meta property="og:image:height" content="630">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	},
	4
);


/**
 * H1 from SEO config when template uses it.
 */
function ovents_page_h1() {
	$row = ovents_seo_for_request();
	if ( $row && ! empty( $row['h1'] ) ) {
		return $row['h1'];
	}
	return get_the_title();
}
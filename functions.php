<?php
/**
 * Ovents theme functions.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OVENTS_VERSION', '2.9.86' );

require_once get_template_directory() . '/inc/env.php';
require_once get_template_directory() . '/inc/staging-guard.php';
require_once get_template_directory() . '/inc/security-headers.php';
require_once get_template_directory() . '/inc/icons.php';
require_once get_template_directory() . '/inc/whatsapp.php';
require_once get_template_directory() . '/inc/instagram.php';
require_once get_template_directory() . '/inc/hero-header.php';
require_once get_template_directory() . '/inc/footer-cta.php';
require_once get_template_directory() . '/inc/media.php';
require_once get_template_directory() . '/inc/theme-images.php';
require_once get_template_directory() . '/inc/inner-layout.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/nav.php';
require_once get_template_directory() . '/inc/contact-form.php';
require_once get_template_directory() . '/inc/portfolio.php';
require_once get_template_directory() . '/inc/schema.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/rank-math-seo.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/wix-redirects.php';
require_once get_template_directory() . '/inc/redirects.php';
require_once get_template_directory() . '/inc/case-studies.php';
require_once get_template_directory() . '/inc/analytics.php';
require_once get_template_directory() . '/inc/google-testimonials.php';
require_once get_template_directory() . '/inc/corporate-page.php';

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'ovents' ),
				'footer'  => __( 'Footer Menu', 'ovents' ),
			)
		);
	}
);

add_action(
	'wp_head',
	function () {
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	},
	1
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'ovents-fonts',
			'https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap',
			array(),
			null
		);
		wp_enqueue_style(
			'ovents-style',
			get_stylesheet_uri(),
			array( 'ovents-fonts' ),
			OVENTS_VERSION
		);
		wp_enqueue_script(
			'ovents-main',
			get_theme_file_uri( 'assets/js/main.js' ),
			array(),
			OVENTS_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		if ( is_singular( OVENTS_PORTFOLIO_CPT ) ) {
			wp_enqueue_script(
				'ovents-portfolio',
				get_theme_file_uri( 'assets/js/portfolio.js' ),
				array(),
				OVENTS_VERSION,
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);
		}
	}
);

add_action(
	'wp_head',
	function () {
		if ( is_front_page() && function_exists( 'ovents_home_hero_webp_preload_urls' ) ) {
			$hero_preloads = ovents_home_hero_webp_preload_urls();
			if ( ! empty( $hero_preloads['mobile'] ) ) {
				echo '<link rel="preload" as="image" type="image/webp" fetchpriority="high" href="' . esc_url( $hero_preloads['mobile'] ) . '" media="(max-width: 767px)">' . "\n";
			}
			if ( ! empty( $hero_preloads['desktop'] ) ) {
				echo '<link rel="preload" as="image" type="image/webp" fetchpriority="high" href="' . esc_url( $hero_preloads['desktop'] ) . '" media="(min-width: 768px)">' . "\n";
			}
		}
		if ( ! has_site_icon() ) {
			$favicon = get_theme_file_path( 'favicon.ico' );
			if ( file_exists( $favicon ) ) {
				echo '<link rel="icon" href="' . esc_url( get_theme_file_uri( 'favicon.ico' ) ) . '" sizes="any">' . "\n";
			}
			$apple_icon = get_theme_file_path( 'apple-touch-icon.png' );
			if ( file_exists( $apple_icon ) ) {
				echo '<link rel="apple-touch-icon" href="' . esc_url( get_theme_file_uri( 'apple-touch-icon.png' ) ) . '">' . "\n";
			}
			if ( ! file_exists( $favicon ) && ! file_exists( $apple_icon ) ) {
				echo '<link rel="icon" href="' . esc_url( get_theme_file_uri( 'assets/img/logo.png' ) ) . '" sizes="192x192">' . "\n";
			}
		}
		if ( ovents_should_block_crawlers() ) {
			echo '<meta name="robots" content="noindex, nofollow">' . "\n";
		}
	},
	1
);

add_filter(
	'pre_option_blog_public',
	static function ( $pre ) {
		if ( function_exists( 'ovents_should_block_crawlers' ) && ovents_should_block_crawlers() ) {
			return '0';
		}
		return $pre;
	}
);

add_action(
	'template_redirect',
	function () {
		if ( is_author() ) {
			wp_safe_redirect( home_url( '/blog/' ), 301 );
			exit;
		}
	},
	1
);

add_action(
	'do_faviconico',
	function () {
		$favicon = get_theme_file_path( 'favicon.ico' );
		if ( file_exists( $favicon ) && is_readable( $favicon ) ) {
			header( 'Content-Type: image/x-icon' );
			header( 'Content-Length: ' . filesize( $favicon ) );
			header( 'Cache-Control: public, max-age=31536000, immutable' );
			readfile( $favicon );
			exit;
		}
	}
);

add_filter(
	'rest_authentication_errors',
	function ( $result ) {
		if ( ! empty( $result ) ) {
			return $result;
		}
		global $wp;
		$route = $wp->query_vars['rest_route'] ?? '';
		if ( preg_match( '#^/wp/v2/users(?:/\d+)?$#', $route ) ) {
			if ( ! is_user_logged_in() ) {
				return new WP_Error(
					'rest_forbidden',
					__( 'User enumeration is disabled for unauthenticated requests.', 'ovents' ),
					array( 'status' => 401 )
				);
			}
		}
		return $result;
	},
	20
);

add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );


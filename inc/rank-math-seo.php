<?php
/**
 * Rank Math integration: redirects, sitemap, focus keywords, JSON-LD helpers.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/journal-seo-config.php';
require_once get_template_directory() . '/inc/portfolio-seo-config.php';

/**
 * Whether a schema @type value includes a given type.
 *
 * @param mixed  $type @type string or list from Rank Math.
 * @param string $seek Type to match.
 */
function ovents_schema_type_includes( $type, $seek ) {
	if ( is_array( $type ) ) {
		return in_array( $seek, $type, true );
	}
	return $seek === $type;
}

/**
 * Remove BreadcrumbList, Article on static views, and orphan author Person stubs from Rank Math @graph.
 *
 * @param array<string, mixed> $data Rank Math JSON-LD.
 * @return array<string, mixed>
 */
function ovents_rank_math_is_static_marketing_view() {
	if ( is_front_page() || is_page() ) {
		return true;
	}
	if ( is_home() && ! is_front_page() ) {
		return true;
	}
	if ( defined( 'OVENTS_PORTFOLIO_CPT' ) && is_post_type_archive( OVENTS_PORTFOLIO_CPT ) ) {
		return true;
	}
	return false;
}

function ovents_rank_math_prune_json_ld( $data ) {
	if ( ! is_array( $data ) ) {
		return $data;
	}
	unset( $data['breadcrumb'], $data['BreadcrumbList'] );

	$strip_article = ovents_rank_math_is_static_marketing_view();
	$strip_author  = $strip_article || is_post_type_archive();

	if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
		$data['@graph'] = array_values(
			array_filter(
				$data['@graph'],
				static function ( $piece ) use ( $strip_article, $strip_author ) {
					if ( ! is_array( $piece ) ) {
						return true;
					}
					$type = $piece['@type'] ?? '';
					if ( ovents_schema_type_includes( $type, 'BreadcrumbList' ) ) {
						return false;
					}
					if ( $strip_article && ovents_schema_type_includes( $type, 'Article' ) ) {
						return false;
					}
					if ( $strip_author && ovents_schema_type_includes( $type, 'Person' ) ) {
						$url = isset( $piece['url'] ) ? (string) $piece['url'] : '';
						if ( false !== strpos( $url, '/author/' ) ) {
							return false;
						}
					}
					return true;
				}
			)
		);
	}

	return $data;
}

/**
 * OG type website on static marketing views (home + core pages + blog index + portfolio archive).
 */
function ovents_rank_math_opengraph_type( $type ) {
	if ( is_front_page() ) {
		return 'website';
	}
	if ( is_home() && ! is_front_page() ) {
		return 'website';
	}
	if ( function_exists( 'ovents_seo_slug' ) ) {
		$slug = ovents_seo_slug();
		$website_slugs = array(
			'weddings',
			'corporate-events',
			'parties',
			'faq',
			'about',
			'contact',
			'portfolio',
			'blog',
		);
		if ( in_array( $slug, $website_slugs, true ) ) {
			return 'website';
		}
	}
	if ( defined( 'OVENTS_PORTFOLIO_CPT' ) && is_post_type_archive( OVENTS_PORTFOLIO_CPT ) ) {
		return 'website';
	}
	return $type;
}

/**
 * 301 www host to apex (production only).
 */
function ovents_redirect_www_to_apex() {
	if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		return;
	}
	if ( ! function_exists( 'ovents_is_production_env' ) || ! ovents_is_production_env() ) {
		return;
	}
	$host = function_exists( 'ovents_request_host' ) ? ovents_request_host() : '';
	if ( 'www.ovents.co.uk' !== $host ) {
		return;
	}
	$uri    = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$target = 'https://ovents.co.uk' . $uri;
	wp_safe_redirect( $target, 301 );
	exit;
}

/**
 * Author archives are unused — send to the journal.
 */
function ovents_redirect_author_archives() {
	if ( is_admin() || ! is_author() ) {
		return;
	}
	wp_safe_redirect( home_url( '/blog/' ), 301 );
	exit;
}

/**
 * Page ID for an SEO config slug (home uses front page).
 *
 * @param string $slug Config key.
 */
function ovents_seo_config_page_id( $slug ) {
	if ( 'home' === $slug ) {
		$id = (int) get_option( 'page_on_front' );
		return $id > 0 ? $id : 0;
	}
	$page = get_page_by_path( $slug );
	return $page instanceof WP_Post ? (int) $page->ID : 0;
}

/**
 * Write Rank Math SEO meta from a config row (theme source of truth).
 *
 * @param int                  $post_id Post ID.
 * @param array<string, mixed> $row     title, description, focus_keyword (optional empty to clear).
 */
function ovents_rank_math_apply_seo_row( $post_id, $row ) {
	$post_id = (int) $post_id;
	if ( $post_id <= 0 || ! is_array( $row ) ) {
		return;
	}
	if ( ! empty( $row['title'] ) ) {
		update_post_meta( $post_id, 'rank_math_title', $row['title'] );
	}
	if ( ! empty( $row['description'] ) ) {
		update_post_meta( $post_id, 'rank_math_description', $row['description'] );
	}
	if ( ! empty( $row['focus_keyword'] ) ) {
		update_post_meta( $post_id, 'rank_math_focus_keyword', $row['focus_keyword'] );
	} elseif ( array_key_exists( 'focus_keyword', $row ) && '' === $row['focus_keyword'] ) {
		delete_post_meta( $post_id, 'rank_math_focus_keyword' );
	} elseif ( ! array_key_exists( 'focus_keyword', $row ) ) {
		delete_post_meta( $post_id, 'rank_math_focus_keyword' );
	}
}

function ovents_rank_math_turn_off_page_article_schema( $page_id ) {
	$page_id = (int) $page_id;
	if ( $page_id <= 0 ) {
		return;
	}
	update_post_meta( $page_id, 'rank_math_rich_snippet', 'off' );
	delete_post_meta( $page_id, 'rank_math_schema_Article' );
}

function ovents_sync_rank_math_page_meta() {
	if ( ! function_exists( 'ovents_rank_math_active' ) || ! ovents_rank_math_active() ) {
		return;
	}
	$flag = 'ovents_rank_math_sync_' . OVENTS_VERSION;
	if ( get_option( $flag, false ) ) {
		return;
	}

	foreach ( ovents_seo_config() as $slug => $row ) {
		$page_id = ovents_seo_config_page_id( $slug );
		if ( $page_id <= 0 ) {
			continue;
		}
		ovents_rank_math_turn_off_page_article_schema( $page_id );
		ovents_rank_math_apply_seo_row( $page_id, $row );
	}

	foreach ( ovents_journal_seo_config() as $slug => $row ) {
		$posts = get_posts(
			array(
				'name'           => $slug,
				'post_type'      => 'post',
				'post_status'    => array( 'publish', 'draft', 'future', 'private' ),
				'posts_per_page' => 1,
			)
		);
		if ( empty( $posts ) || ! $posts[0] instanceof WP_Post ) {
			continue;
		}
		ovents_rank_math_apply_seo_row( (int) $posts[0]->ID, $row );
	}

	if ( defined( 'OVENTS_PORTFOLIO_CPT' ) ) {
		foreach ( ovents_portfolio_seo_config() as $slug => $row ) {
			$posts = get_posts(
				array(
					'name'           => $slug,
					'post_type'      => OVENTS_PORTFOLIO_CPT,
					'post_status'    => 'publish',
					'posts_per_page' => 1,
					'fields'         => 'ids',
				)
			);
			if ( empty( $posts ) ) {
				continue;
			}
			ovents_rank_math_apply_seo_row( (int) $posts[0], $row );
		}
	}

	update_option( $flag, 1 );
}

add_action( 'template_redirect', 'ovents_redirect_www_to_apex', 0 );
add_action( 'template_redirect', 'ovents_redirect_author_archives', 1 );
add_action( 'init', 'ovents_sync_rank_math_page_meta', 25 );

add_action(
	'wp',
	static function () {
		if ( ! function_exists( 'ovents_rank_math_active' ) || ! ovents_rank_math_active() ) {
			return;
		}
		add_filter( 'rank_math/json_ld', 'ovents_rank_math_prune_json_ld', 999 );
	},
	5
);

if ( function_exists( 'ovents_rank_math_active' ) && ovents_rank_math_active() ) {
	add_filter( 'rank_math/sitemap/enable_authors', '__return_false' );
	add_filter( 'rank_math/opengraph/type', 'ovents_rank_math_opengraph_type', 20 );
	add_filter(
		'rank_math/snippet/rich_snippet_article',
		static function ( $include ) {
			if ( is_front_page() || is_page() || ( is_home() && ! is_front_page() ) ) {
				return false;
			}
			return $include;
		},
		10,
		1
	);
	add_filter(
		'rank_math/settings/snippet/type',
		static function ( $type, $post_type ) {
			if ( 'page' === $post_type ) {
				return 'none';
			}
			return $type;
		},
		10,
		2
	);
}
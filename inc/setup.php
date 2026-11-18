<?php
/**
 * Theme activation and content seeding.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OVENTS_CONTENT_VERSION', '1.7.0' );

add_action( 'after_switch_theme', 'ovents_on_activate' );
add_action( 'init', 'ovents_maybe_reseed', 20 );
add_action( 'init', 'ovents_ensure_reading_settings', 5 );

function ovents_on_activate() {
	ovents_seed_pages();
	ovents_seed_posts();
	ovents_seed_menu();
	ovents_bootstrap_options();
	update_option( 'ovents_content_version', OVENTS_CONTENT_VERSION );
	flush_rewrite_rules();
}

function ovents_maybe_reseed() {
	if ( get_option( 'ovents_content_version' ) === OVENTS_CONTENT_VERSION ) {
		return;
	}
	ovents_seed_pages();
	ovents_seed_posts();
	ovents_seed_menu();
	update_option( 'ovents_content_version', OVENTS_CONTENT_VERSION );
	flush_rewrite_rules();
}

/**
 * Keep static front page assigned so the homepage template always renders.
 */
function ovents_ensure_reading_settings() {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return;
	}
	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		return;
	}
	if ( 'page' !== get_option( 'show_on_front' ) || (int) get_option( 'page_on_front' ) !== (int) $home->ID ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $home->ID );
	}
	$blog = get_page_by_path( 'blog' );
	if ( $blog && (int) get_option( 'page_for_posts' ) !== (int) $blog->ID ) {
		update_option( 'page_for_posts', (int) $blog->ID );
	}
}

function ovents_bootstrap_options() {
	require_once get_template_directory() . '/inc/env.php';
	update_option( 'blog_public', ovents_should_discourage_indexing() ? '0' : '1' );
	update_option( 'blogdescription', 'Wedding and event planning across the UK.' );
	if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
}

/**
 * Page template assignments by slug.
 *
 * @return array<string, string>
 */
function ovents_page_templates() {
	return array(
		'weddings'         => 'page-weddings.php',
		'corporate-events' => 'page-corporate-events.php',
		'parties'          => 'page-parties.php',
	);
}

function ovents_migrate_legacy_slugs() {
	$legacy = get_page_by_path( 'private-parties' );
	if ( $legacy && get_page_by_path( 'parties' ) ) {
		wp_trash_post( (int) $legacy->ID );
	}
}

/**
 * Ensure a published portfolio page uses the portfolio template.
 */
function ovents_ensure_portfolio_page() {
	$page = get_page_by_path( 'portfolio' );
	if ( $page && 'trash' === $page->post_status ) {
		wp_untrash_post( (int) $page->ID );
		$page = get_post( (int) $page->ID );
	}
	if ( ! $page ) {
		$id = wp_insert_post(
			array(
				'post_title'  => 'Portfolio',
				'post_name'   => 'portfolio',
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( (int) $id, '_wp_page_template', 'page-portfolio.php' );
		}
		return;
	}
	update_post_meta( (int) $page->ID, '_wp_page_template', 'page-portfolio.php' );
}

function ovents_seed_pages() {
	$file = get_template_directory() . '/inc/page-content.json';
	if ( ! file_exists( $file ) ) {
		return;
	}
	$data = json_decode( file_get_contents( $file ), true );
	if ( ! is_array( $data ) ) {
		return;
	}

	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		$home_id = wp_insert_post(
			array(
				'post_title'   => 'Home',
				'post_name'    => 'home',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
	} else {
		$home_id = $home->ID;
	}

	foreach ( $data as $slug => $page ) {
		$content = isset( $page['content'] ) ? $page['content'] : '';
		$existing = get_page_by_path( $slug );
		$payload  = array(
			'post_title'   => $page['title'],
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_name'    => $slug,
		);
		if ( $existing ) {
			$payload['ID'] = $existing->ID;
			wp_update_post( $payload );
		} else {
			wp_insert_post( $payload );
		}
	}

	ovents_migrate_legacy_slugs();
	ovents_ensure_portfolio_page();

	$templates = ovents_page_templates();
	foreach ( $templates as $slug => $template ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			update_post_meta( (int) $page->ID, '_wp_page_template', $template );
		}
	}

	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $home_id );
	}

	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello ) {
		wp_delete_post( (int) $hello->ID, true );
	}

	$blog = get_page_by_path( 'blog' );
	if ( $blog ) {
		update_option( 'page_for_posts', (int) $blog->ID );
	}
}

/**
 * Publish the journal from the Wix blog export.
 * Runs when the content version changes, and updates posts that already exist.
 */
function ovents_seed_posts() {
	$file = get_template_directory() . '/inc/journal-posts.json';
	if ( ! file_exists( $file ) ) {
		return;
	}
	$items = json_decode( file_get_contents( $file ), true );
	if ( ! is_array( $items ) ) {
		return;
	}

	$keep = array();
	foreach ( $items as $item ) {
		$slug = isset( $item['slug'] ) ? sanitize_title( $item['slug'] ) : '';
		if ( '' === $slug || empty( $item['title'] ) ) {
			continue;
		}
		$keep[] = $slug;

		$cat_ids = array();
		$names   = array();
		if ( ! empty( $item['categories'] ) && is_array( $item['categories'] ) ) {
			$names = $item['categories'];
		} elseif ( ! empty( $item['category'] ) ) {
			$names = array( $item['category'] );
		}
		foreach ( $names as $name ) {
			$name = trim( (string) $name );
			if ( '' === $name ) {
				continue;
			}
			$term = term_exists( $name, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $name, 'category' );
			}
			if ( ! is_wp_error( $term ) ) {
				$cat_ids[] = (int) ( is_array( $term ) ? $term['term_id'] : $term );
			}
		}

		$stamp = ! empty( $item['date'] ) ? gmdate( 'Y-m-d H:i:s', strtotime( $item['date'] ) ) : current_time( 'mysql', true );
		$status  = 'draft';
		$content = isset( $item['content'] ) ? $item['content'] : '';
		$excerpt = isset( $item['excerpt'] ) ? (string) $item['excerpt'] : '';
		$excerpt = preg_replace( '/\s*From Ovents[^.]*\.?\s*/i', '', $excerpt );
		$data    = array(
			'post_title'    => $item['title'],
			'post_name'     => $slug,
			'post_status'   => $status,
			'post_type'     => 'post',
			'post_excerpt'  => $excerpt,
			'post_content'  => $content,
			'post_date'     => $stamp,
			'post_date_gmt' => $stamp,
		);
		$existing = get_page_by_path( $slug, OBJECT, 'post' );
		if ( $existing ) {
			$data['ID'] = (int) $existing->ID;
		}
		$post_id = wp_insert_post( $data );
		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}
		if ( $cat_ids ) {
			wp_set_post_categories( (int) $post_id, $cat_ids, false );
		}
		if ( ! empty( $item['image'] ) ) {
			ovents_attach_journal_image( (int) $post_id, $item['image'], $item['title'] );
		}
	}

	$retire = array(
		'when-to-book-a-wedding-planner',
		'wedding-planner-or-coordinator',
		'planning-a-corporate-event-in-london',
	);
	foreach ( $retire as $slug ) {
		if ( in_array( $slug, $keep, true ) ) {
			continue;
		}
		$old = get_page_by_path( $slug, OBJECT, 'post' );
		if ( $old ) {
			wp_trash_post( (int) $old->ID );
		}
	}

	update_option( 'posts_per_page', 9 );
}

/**
 * Sideload a theme journal image as the post thumbnail.
 *
 * @param int    $post_id Post ID.
 * @param string $file    Filename inside assets/img/journal.
 * @param string $title   Alt text.
 */
function ovents_attach_journal_image( $post_id, $file, $title ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return;
	}
	$path = get_template_directory() . '/assets/img/journal/' . basename( $file );
	if ( ! file_exists( $path ) ) {
		return;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$tmp = wp_tempnam( basename( $path ) );
	if ( ! $tmp || ! copy( $path, $tmp ) ) {
		return;
	}
	$attachment_id = media_handle_sideload(
		array(
			'name'     => basename( $path ),
			'tmp_name' => $tmp,
		),
		$post_id,
		$title
	);
	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		return;
	}
	set_post_thumbnail( $post_id, (int) $attachment_id );
	update_post_meta( (int) $attachment_id, '_wp_attachment_image_alt', $title );
}

function ovents_seed_menu() {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( ! empty( $locations['primary'] ) ) {
		wp_delete_nav_menu( (int) $locations['primary'] );
	}
	foreach ( wp_get_nav_menus() as $existing_menu ) {
		if ( 'primary' === $existing_menu->slug || 'Primary' === $existing_menu->name ) {
			wp_delete_nav_menu( (int) $existing_menu->term_id );
		}
	}

	$menu_id = wp_create_nav_menu( 'Primary' );
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	$slugs = array(
		'about'            => 'About',
		'weddings'         => 'Weddings',
		'corporate-events' => 'Corporate',
		'parties'          => 'Parties',
		'contact'          => 'Contact',
	);

	$order = 1;
	foreach ( $slugs as $slug => $label ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			continue;
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => $label,
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => $order++,
			)
		);
	}

	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

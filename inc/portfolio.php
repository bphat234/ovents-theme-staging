<?php
/**
 * Editorial portfolio (CPT, theme images, seed data).
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OVENTS_PORTFOLIO_CPT', 'ovents_portfolio' );

add_action(
	'init',
	function () {
		register_post_type(
			OVENTS_PORTFOLIO_CPT,
			array(
				'labels'       => array(
					'name'          => __( 'Portfolio', 'ovents' ),
					'singular_name' => __( 'Portfolio event', 'ovents' ),
					'add_new_item'  => __( 'Add portfolio event', 'ovents' ),
					'edit_item'     => __( 'Edit portfolio event', 'ovents' ),
				),
				'public'       => true,
				'show_in_rest' => true,
				'has_archive'  => true,
				'rewrite'      => array(
					'slug'       => 'portfolio',
					'with_front' => false,
				),
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
				'menu_icon'    => 'dashicons-format-gallery',
			)
		);
	}
);

/**
 * Default seed definitions (theme images under assets/img/portfolio/<slug>/).
 *
 * @return array<int, array<string, mixed>>
 */
function ovents_portfolio_seed_items() {
	return array(
		array(
			'slug'          => 'erica-samuel',
			'title'         => 'Erica & Samuel',
			'event_type'    => 'wedding',
			'type_label'    => 'Wedding',
			'intro'         => '',
			'venue'         => '',
			'event_date'    => '',
			'guest_count'   => '',
			'services'      => '',
			'quote'         => '',
			'quote_attr'    => '',
			'photographer'  => 'V. Opoku Photography',
			'cover_stem'    => 'cover-erica-samuel-couple',
			'cover_pos'     => 'center 20%',
			'home_featured' => true,
			'home_order'    => 1,
			'meta_desc'     => "Erica and Samuel's wedding, planned by Ovents.",
			'gallery'       => array(
				array( 'stem' => 'gallery-erica-samuel-pavilion', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => 'Erica and Samuel standing in a white Gothic pavilion, looking out over trees and a lake.' ),
				array( 'stem' => 'gallery-erica-samuel-gothic-ruin', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'Erica and Samuel standing together in the arched doorway of a brick Gothic ruin.' ),
				array( 'stem' => 'gallery-erica-samuel-vineyard', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'Erica walking down a vineyard path in a white wedding dress, holding her skirt.' ),
				array( 'stem' => 'gallery-erica-samuel-bridge', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => 'Erica and Samuel walking along a white wooden bridge over a pond, surrounded by trees.' ),
				array( 'stem' => 'gallery-erica-samuel-arches', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'Erica and Samuel holding hands, forehead to forehead, in front of brick Gothic arches.' ),
				array( 'stem' => 'gallery-erica-samuel-first-dance', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'Erica and Samuel dancing together in a room lit with hanging white flowers, fairy lights and a purple wash, guests watching from their tables.' ),
				array( 'stem' => 'gallery-erica-samuel-sweetheart-table', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => 'Erica and Samuel standing behind a rounded white sweetheart table, under a white drape and blossom trees, in purple lighting.' ),
			),
		),
		array(
			'slug'          => 'funmi-yemi',
			'title'         => 'Funmi & Yemi',
			'event_type'    => 'wedding',
			'type_label'    => 'Wedding',
			'intro'         => '',
			'venue'         => '',
			'event_date'    => '',
			'guest_count'   => '',
			'services'      => '',
			'quote'         => '',
			'quote_attr'    => '',
			'photographer'  => '',
			'cover_stem'    => 'cover-funmi-yemi-doorway',
			'cover_pos'     => 'center 40%',
			'home_featured' => true,
			'home_order'    => 2,
			'meta_desc'     => "Funmi and Yemi's wedding, planned by Ovents.",
			'gallery'       => array(
				array( 'stem' => 'gallery-funmi-yemi-shoes-and-papers', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => 'Ivory shoes with jewelled buckles, a wooden bowl and printed wedding newspapers arranged on a pale wooden table.' ),
				array( 'stem' => 'gallery-funmi-yemi-getting-ready', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'A group of women in white satin shirts and robes gathered together in a pale room, getting ready.' ),
				array( 'stem' => 'gallery-funmi-yemi-wedding-newspaper', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => 'A hand holding a printed newspaper-style programme headed The Wedding Post, with the words Fumilola and Opeyemi are getting married.' ),
				array( 'stem' => 'gallery-funmi-yemi-bridal-party-newspapers', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => 'Women in white robes sitting together, each holding up a printed wedding newspaper.' ),
			),
		),
		array(
			'slug'          => 'the-planners-table',
			'title'         => "The Planner's Table",
			'event_type'    => 'industry',
			'type_label'    => 'Industry event',
			'intro'         => "In April 2026 Ovents organised The Planner's Table, a lunch and learn for event professionals, wedding planners, coordinators and creatives. The day included welcome drinks, a curated brunch, a goodie bag, honest conversations and practical sessions.",
			'venue'         => '',
			'event_date'    => 'April 2026',
			'guest_count'   => '',
			'services'      => 'Organised by Ovents',
			'quote'         => '',
			'quote_attr'    => '',
			'photographer'  => 'Sure Moments HQ',
			'cover_stem'    => 'cover-planners-table-sign',
			'cover_pos'     => 'center 40%',
			'home_featured' => true,
			'home_order'    => 3,
			'meta_desc'     => "The Planner's Table, a lunch and learn for event professionals organised by Ovents in April 2026.",
			'schema_date'   => '2026-04-25',
			'gallery'       => array(
				array( 'stem' => 'gallery-planners-table-lunch', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => "Guests seated around a long table of flowers and bags, with Planner's Table signs on screens at either end of the room." ),
				array( 'stem' => 'gallery-planners-table-sign', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => "A gold easel holding a printed sign: Vendors' Brunch, The Planner's Table, a lunch and learn experience, 25th April 2026." ),
				array( 'stem' => 'gallery-planners-table-guest-profile', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => "A woman in a black-and-white houndstooth jacket, photographed in profile, seated at The Planner's Table." ),
				array( 'stem' => 'gallery-planners-table-group', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => "A group of attendees standing together, some holding The Planner's Table sign, at the lunch and learn organised by Ovents." ),
				array( 'stem' => 'gallery-planners-table-speaker-cream', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => "A woman in a cream shirt dress gesturing as she speaks at The Planner's Table." ),
				array( 'stem' => 'gallery-planners-table-speaker-check', 'layout' => 'portrait', 'w' => 1280, 'h' => 1600, 'alt' => "A woman in a black-and-white houndstooth jacket speaking at a table, with flowers and The Planner's Table sign behind her." ),
				array( 'stem' => 'gallery-planners-table-conversation', 'layout' => 'landscape', 'w' => 1600, 'h' => 1067, 'alt' => "Guests talking across a table set with white flowers, candles and gold-edged bags at The Planner's Table." ),
			),
		),
	);
}

/**
 * @param string $text Intro text.
 */
function ovents_portfolio_intro_is_placeholder( $text ) {
	$text = trim( (string) $text );
	if ( '' === $text ) {
		return true;
	}
	return (bool) preg_match( '/^\[.*\]$/s', $text );
}

/**
 * @param WP_Post|int $post Post.
 * @return array<string, mixed>
 */
function ovents_portfolio_get_meta( $post ) {
	$post = get_post( $post );
	if ( ! $post || OVENTS_PORTFOLIO_CPT !== $post->post_type ) {
		return array();
	}
	$gallery_raw = (string) get_post_meta( $post->ID, '_ovents_gallery', true );
	$gallery     = $gallery_raw ? json_decode( $gallery_raw, true ) : array();
	if ( ! is_array( $gallery ) ) {
		$gallery = array();
	}
	return array(
		'event_slug'   => (string) get_post_meta( $post->ID, '_ovents_event_slug', true ),
		'event_type'   => (string) get_post_meta( $post->ID, '_ovents_event_type', true ),
		'type_label'   => (string) get_post_meta( $post->ID, '_ovents_type_label', true ),
		'intro'        => (string) get_post_meta( $post->ID, '_ovents_intro', true ),
		'venue'        => (string) get_post_meta( $post->ID, '_ovents_venue', true ),
		'event_date'   => (string) get_post_meta( $post->ID, '_ovents_event_date', true ),
		'guest_count'  => (string) get_post_meta( $post->ID, '_ovents_guest_count', true ),
		'services'     => (string) get_post_meta( $post->ID, '_ovents_services', true ),
		'quote'        => (string) get_post_meta( $post->ID, '_ovents_quote', true ),
		'quote_attr'   => (string) get_post_meta( $post->ID, '_ovents_quote_attr', true ),
		'photographer' => (string) get_post_meta( $post->ID, '_ovents_photographer', true ),
		'cover_stem'   => (string) get_post_meta( $post->ID, '_ovents_cover_stem', true ),
		'cover_pos'    => (string) get_post_meta( $post->ID, '_ovents_cover_pos', true ),
		'gallery'      => $gallery,
		'home_featured' => (bool) get_post_meta( $post->ID, '_ovents_home_featured', true ),
		'home_order'   => (int) get_post_meta( $post->ID, '_ovents_home_order', true ),
		'meta_desc'    => (string) get_post_meta( $post->ID, '_ovents_meta_desc', true ),
		'schema_date'  => (string) get_post_meta( $post->ID, '_ovents_schema_date', true ),
	);
}

/**
 * @param array<string, mixed> $meta From ovents_portfolio_get_meta().
 * @return string
 */
function ovents_portfolio_visible_intro( $meta ) {
	$intro = isset( $meta['intro'] ) ? trim( (string) $meta['intro'] ) : '';
	if ( ovents_portfolio_intro_is_placeholder( $intro ) ) {
		return '';
	}
	return $intro;
}

/**
 * @param array<string, mixed> $meta Meta.
 * @return array<int, array{label: string, value: string}>
 */
function ovents_portfolio_facts( $meta ) {
	$facts = array();
	$pairs = array(
		'Venue'    => 'venue',
		'Date'     => 'event_date',
		'Guests'   => 'guest_count',
		'Services' => 'services',
	);
	foreach ( $pairs as $label => $key ) {
		$val = isset( $meta[ $key ] ) ? trim( (string) $meta[ $key ] ) : '';
		if ( '' !== $val ) {
			$facts[] = array(
				'label' => $label,
				'value' => $val,
			);
		}
	}
	return $facts;
}

/**
 * @param string               $event_slug Folder under assets/img/portfolio/.
 * @param string               $stem       File stem without size suffix.
 * @param array<string, mixed> $args       sizes, class, loading, fetchpriority, width, height, object_position, alt.
 */
function ovents_portfolio_render_image( $event_slug, $stem, $args = array() ) {
	$defaults = array(
		'widths'          => array( 800, 1200 ),
		'sizes'           => '(max-width: 720px) 92vw, 30vw',
		'class'           => '',
		'img_class'       => '',
		'loading'         => 'lazy',
		'fetchpriority'   => '',
		'decoding'        => 'async',
		'width'           => 1200,
		'height'          => 1500,
		'object_position' => 'center center',
		'alt'             => '',
	);
	$args     = wp_parse_args( $args, $defaults );
	$base     = get_theme_file_uri( 'assets/img/portfolio/' . $event_slug . '/' );
	$dir      = get_theme_file_path( 'assets/img/portfolio/' . $event_slug . '/' );

	$webp_set = array();
	$jpg_src  = '';
	$img_w    = (int) $args['width'];
	$img_h    = (int) $args['height'];

	foreach ( (array) $args['widths'] as $w ) {
		$w       = (int) $w;
		$webp    = $dir . $stem . '-' . $w . '.webp';
		$jpg     = $dir . $stem . '-' . $w . '.jpg';
		if ( is_readable( $webp ) ) {
			$webp_set[] = esc_url( $base . $stem . '-' . $w . '.webp' ) . ' ' . $w . 'w';
		}
		if ( is_readable( $jpg ) && '' === $jpg_src ) {
			$jpg_src = $base . $stem . '-' . $w . '.jpg';
		}
	}
	if ( '' === $jpg_src && ! empty( $webp_set ) ) {
		$jpg_src = strtok( $webp_set[0], ' ' );
	}
	if ( '' === $jpg_src ) {
		return;
	}

	$style = 'object-fit:cover;object-position:' . esc_attr( (string) $args['object_position'] ) . ';';
	if ( $args['img_class'] ) {
		$style = '';
	}

	printf( '<picture%s>', $args['class'] ? ' class="' . esc_attr( (string) $args['class'] ) . '"' : '' );
	if ( $webp_set ) {
		printf(
			'<source type="image/webp" srcset="%s" sizes="%s">',
			esc_attr( implode( ', ', $webp_set ) ),
			esc_attr( (string) $args['sizes'] )
		);
	}
	printf(
		'<img class="%s" src="%s" alt="%s" width="%d" height="%d" loading="%s" decoding="%s"%s%s>',
		esc_attr( (string) $args['img_class'] ),
		esc_url( $jpg_src ),
		esc_attr( (string) $args['alt'] ),
		$img_w,
		$img_h,
		esc_attr( (string) $args['loading'] ),
		esc_attr( (string) $args['decoding'] ),
		$args['fetchpriority'] ? ' fetchpriority="' . esc_attr( (string) $args['fetchpriority'] ) . '"' : '',
		$style ? ' style="' . $style . '"' : ''
	);
	echo '</picture>';
}

/**
 * Featured posts for the home row (max 3).
 *
 * @return WP_Post[]
 */
function ovents_portfolio_home_featured_posts() {
	$q = new WP_Query(
		array(
			'post_type'      => OVENTS_PORTFOLIO_CPT,
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'meta_key'       => '_ovents_home_order',
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'   => '_ovents_home_featured',
					'value' => '1',
				),
			),
		)
	);
	return $q->posts;
}

/**
 * Archive query with optional type filter (?type=wedding|party|industry).
 */
function ovents_portfolio_archive_query() {
	$type = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$args = array(
		'post_type'      => OVENTS_PORTFOLIO_CPT,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => '_ovents_home_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
	);
	if ( in_array( $type, array( 'wedding', 'party', 'industry' ), true ) ) {
		$args['meta_query'] = array(
			array(
				'key'   => '_ovents_event_type',
				'value' => $type,
			),
		);
	}
	return new WP_Query( $args );
}

/**
 * Adjacent portfolio post by menu order meta.
 *
 * @param WP_Post $post   Current.
 * @param string  $which  previous|next.
 * @return WP_Post|null
 */
function ovents_portfolio_adjacent( $post, $which ) {
	$current_order = (int) get_post_meta( $post->ID, '_ovents_home_order', true );
	$compare       = 'previous' === $which ? '<' : '>';
	$order_dir     = 'previous' === $which ? 'DESC' : 'ASC';
	$q             = new WP_Query(
		array(
			'post_type'      => OVENTS_PORTFOLIO_CPT,
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_ovents_home_order',
			'orderby'        => 'meta_value_num',
			'order'          => $order_dir,
			'meta_query'     => array(
				array(
					'key'     => '_ovents_home_order',
					'value'   => $current_order,
					'compare' => $compare,
					'type'    => 'NUMERIC',
				),
			),
		)
	);
	return $q->posts ? $q->posts[0] : null;
}

/**
 * Remove conflicting portfolio page so CPT archive can own /portfolio/.
 */
function ovents_portfolio_remove_conflicting_page() {
	$page = get_page_by_path( 'portfolio' );
	if ( $page instanceof WP_Post && 'trash' !== $page->post_status ) {
		wp_trash_post( (int) $page->ID );
	}
}

/**
 * Seed or refresh portfolio events from theme definitions.
 */
function ovents_seed_portfolio_events() {
	if ( get_option( 'ovents_portfolio_seeded_v2' ) ) {
		return;
	}
	foreach ( ovents_portfolio_seed_items() as $item ) {
		$existing = get_page_by_path( $item['slug'], OBJECT, OVENTS_PORTFOLIO_CPT );
		$postarr  = array(
			'post_title'  => $item['title'],
			'post_name'   => $item['slug'],
			'post_status' => 'publish',
			'post_type'   => OVENTS_PORTFOLIO_CPT,
			'post_content' => '',
		);
		if ( $existing instanceof WP_Post ) {
			$postarr['ID'] = $existing->ID;
			wp_update_post( $postarr );
			$post_id = $existing->ID;
		} else {
			$post_id = (int) wp_insert_post( $postarr, true );
		}
		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}
		update_post_meta( $post_id, '_ovents_event_slug', $item['slug'] );
		update_post_meta( $post_id, '_ovents_event_type', $item['event_type'] );
		update_post_meta( $post_id, '_ovents_type_label', $item['type_label'] );
		update_post_meta( $post_id, '_ovents_intro', $item['intro'] );
		update_post_meta( $post_id, '_ovents_venue', $item['venue'] );
		update_post_meta( $post_id, '_ovents_event_date', $item['event_date'] );
		update_post_meta( $post_id, '_ovents_guest_count', $item['guest_count'] );
		update_post_meta( $post_id, '_ovents_services', $item['services'] );
		update_post_meta( $post_id, '_ovents_quote', $item['quote'] );
		update_post_meta( $post_id, '_ovents_quote_attr', $item['quote_attr'] );
		update_post_meta( $post_id, '_ovents_photographer', $item['photographer'] );
		update_post_meta( $post_id, '_ovents_cover_stem', $item['cover_stem'] );
		update_post_meta( $post_id, '_ovents_cover_pos', $item['cover_pos'] );
		update_post_meta( $post_id, '_ovents_gallery', wp_json_encode( $item['gallery'] ) );
		update_post_meta( $post_id, '_ovents_home_featured', $item['home_featured'] ? '1' : '0' );
		update_post_meta( $post_id, '_ovents_home_order', (int) $item['home_order'] );
		update_post_meta( $post_id, '_ovents_meta_desc', $item['meta_desc'] );
		if ( ! empty( $item['schema_date'] ) ) {
			update_post_meta( $post_id, '_ovents_schema_date', $item['schema_date'] );
		}
	}
	ovents_portfolio_remove_conflicting_page();
	update_option( 'ovents_portfolio_seeded_v2', 1 );
	flush_rewrite_rules();
}

add_action( 'init', 'ovents_seed_portfolio_events', 100 );

add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_post_type_archive( OVENTS_PORTFOLIO_CPT ) ) {
			$classes[] = 'ovents-portfolio-archive';
		}
		if ( is_singular( OVENTS_PORTFOLIO_CPT ) ) {
			$classes[] = 'ovents-portfolio-single';
		}
		return $classes;
	}
);

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box(
			'ovents_portfolio_details',
			__( 'Event details', 'ovents' ),
			'ovents_portfolio_meta_box_render',
			OVENTS_PORTFOLIO_CPT,
			'normal',
			'high'
		);
	}
);

/**
 * @param WP_Post $post Post.
 */
function ovents_portfolio_meta_box_render( $post ) {
	wp_nonce_field( 'ovents_portfolio_save', 'ovents_portfolio_nonce' );
	$fields = ovents_portfolio_get_meta( $post );
	$keys   = array( 'event_slug', 'event_type', 'type_label', 'intro', 'venue', 'event_date', 'guest_count', 'services', 'quote', 'quote_attr', 'photographer', 'cover_stem', 'cover_pos', 'meta_desc', 'schema_date' );
	echo '<p><label>Event slug (image folder) <input style="width:100%" name="ovents_event_slug" value="' . esc_attr( $fields['event_slug'] ) . '"></label></p>';
	echo '<p><label>Type <select name="ovents_event_type"><option value="wedding"' . selected( $fields['event_type'], 'wedding', false ) . '>Wedding</option><option value="party"' . selected( $fields['event_type'], 'party', false ) . '>Party</option><option value="industry"' . selected( $fields['event_type'], 'industry', false ) . '>Industry</option></select></label></p>';
	foreach ( $keys as $key ) {
		if ( in_array( $key, array( 'event_slug', 'event_type' ), true ) ) {
			continue;
		}
		$name = 'ovents_' . $key;
		if ( 'intro' === $key ) {
			echo '<p><label>' . esc_html( ucwords( str_replace( '_', ' ', $key ) ) ) . '<br><textarea style="width:100%" rows="4" name="' . esc_attr( $name ) . '">' . esc_textarea( $fields[ $key ] ) . '</textarea></label></p>';
		} else {
			echo '<p><label>' . esc_html( ucwords( str_replace( '_', ' ', $key ) ) ) . ' <input style="width:100%" name="' . esc_attr( $name ) . '" value="' . esc_attr( $fields[ $key ] ) . '"></label></p>';
		}
	}
	echo '<p><label><input type="checkbox" name="ovents_home_featured" value="1"' . checked( $fields['home_featured'], true, false ) . '> Home featured</label></p>';
	echo '<p><label>Home order <input type="number" name="ovents_home_order" value="' . esc_attr( (string) $fields['home_order'] ) . '"></label></p>';
	echo '<p><label>Gallery JSON<textarea style="width:100%;font-family:monospace" rows="8" name="ovents_gallery">' . esc_textarea( wp_json_encode( $fields['gallery'], JSON_PRETTY_PRINT ) ) . '</textarea></label></p>';
}

add_action(
	'save_post_' . OVENTS_PORTFOLIO_CPT,
	function ( $post_id ) {
		if ( ! isset( $_POST['ovents_portfolio_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ovents_portfolio_nonce'] ) ), 'ovents_portfolio_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		$map = array(
			'event_slug' => '_ovents_event_slug',
			'event_type' => '_ovents_event_type',
			'type_label' => '_ovents_type_label',
			'intro'      => '_ovents_intro',
			'venue'      => '_ovents_venue',
			'event_date' => '_ovents_event_date',
			'guest_count' => '_ovents_guest_count',
			'services'   => '_ovents_services',
			'quote'      => '_ovents_quote',
			'quote_attr' => '_ovents_quote_attr',
			'photographer' => '_ovents_photographer',
			'cover_stem' => '_ovents_cover_stem',
			'cover_pos'  => '_ovents_cover_pos',
			'meta_desc'  => '_ovents_meta_desc',
			'schema_date' => '_ovents_schema_date',
		);
		foreach ( $map as $field => $meta_key ) {
			if ( isset( $_POST[ 'ovents_' . $field ] ) ) {
				update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ 'ovents_' . $field ] ) ) );
			}
		}
		if ( isset( $_POST['ovents_intro'] ) ) {
			update_post_meta( $post_id, '_ovents_intro', sanitize_textarea_field( wp_unslash( $_POST['ovents_intro'] ) ) );
		}
		if ( isset( $_POST['ovents_gallery'] ) ) {
			$raw = wp_unslash( $_POST['ovents_gallery'] );
			$decoded = json_decode( $raw, true );
			update_post_meta( $post_id, '_ovents_gallery', is_array( $decoded ) ? wp_json_encode( $decoded ) : sanitize_textarea_field( $raw ) );
		}
		update_post_meta( $post_id, '_ovents_home_featured', isset( $_POST['ovents_home_featured'] ) ? '1' : '0' );
		if ( isset( $_POST['ovents_home_order'] ) ) {
			update_post_meta( $post_id, '_ovents_home_order', (int) $_POST['ovents_home_order'] );
		}
	}
);
<?php
/**
 * Instagram: Smash Balloon live feed with static @ovents_ltd fallback.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Feed ID in Instagram Feed → All Feeds (staging default: 1).
 *
 * @return int
 */
function ovents_instagram_feed_id() {
	if ( defined( 'OVENTS_INSTAGRAM_FEED_ID' ) ) {
		return (int) OVENTS_INSTAGRAM_FEED_ID;
	}
	$stored = (int) get_option( 'ovents_sbi_feed_id', 0 );
	if ( $stored > 0 ) {
		return $stored;
	}
	return (int) apply_filters( 'ovents_instagram_feed_id', 1 );
}

/**
 * Public Instagram profile URL.
 */
function ovents_instagram_profile_url() {
	return 'https://www.instagram.com/ovents_ltd/';
}

/**
 * Instagram handle for display (matches profile URL).
 */
function ovents_instagram_handle() {
	return '@ovents_ltd';
}

/**
 * Cached public posts; used when the Smash Balloon feed is empty or unavailable.
 *
 * @return array<int, array<string, mixed>>
 */
function ovents_instagram_posts() {
	$posts = json_decode( file_get_contents( get_theme_file_path( 'inc/instagram-posts.json' ) ), true );
	return is_array( $posts ) ? $posts : array();
}

/**
 * Global Smash Balloon options: GDPR, local image resizing, caching.
 *
 * @param array<string, mixed> $settings Plugin database settings.
 * @return array<string, mixed>
 */
function ovents_sbi_database_settings( $settings ) {
	if ( ! is_array( $settings ) ) {
		$settings = array();
	}
	$settings['gdpr']                            = 'yes';
	$settings['enqueue_css_in_shortcode']        = false;
	$settings['sb_instagram_disable_resize']     = false;
	$settings['image_format']                      = 'webp';
	$settings['sbi_caching_type']                  = 'background';
	$settings['sb_instagram_image_res']            = 'thumb';
	$settings['sb_instagram_disable_font']         = true;
	$settings['sb_instagram_disable_awesome']      = true;
	$settings['sb_instagram_show_btn']             = false;
	return $settings;
}
add_filter( 'option_sb_instagram_settings', 'ovents_sbi_database_settings' );

/**
 * Per-render feed settings (shortcode and builder feeds).
 *
 * @param array<string, mixed> $settings Feed settings.
 * @return array<string, mixed>
 */
function ovents_sbi_feed_settings( $settings ) {
	if ( ! is_array( $settings ) ) {
		return $settings;
	}
	$settings['num']         = 10;
	$settings['nummobile']   = 10;
	$settings['cols']        = 5;
	$settings['colstablet']  = 3;
	$settings['colsmobile']  = 2;
	$settings['imagepadding'] = '0';
	$settings['showheader']  = false;
	$settings['showbio']     = false;
	$settings['showbutton']  = false;
	$settings['showfollow']  = false;
	$settings['showcaption'] = false;
	$settings['showlikes']   = false;
	$settings['layout']      = 'grid';
	return $settings;
}
add_filter( 'sbi_feed_settings', 'ovents_sbi_feed_settings' );

add_filter(
	'sbi_img_loading_attr',
	static function () {
		return 'lazy';
	}
);

/**
 * Shortcode attributes for the home feed.
 *
 * @return string
 */
function ovents_instagram_feed_shortcode() {
	$atts = 'num=10 cols=5 colstablet=3 colsmobile=2 imagepadding=0 showheader=false showbio=false showbutton=false showfollow=false showcaption=false showlikes=false';
	if ( get_option( 'ovents_sbi_use_legacy_feed', false ) ) {
		return '[instagram-feed ' . $atts . ']';
	}
	$id = ovents_instagram_feed_id();
	if ( $id < 1 ) {
		return '[instagram-feed ' . $atts . ']';
	}
	return sprintf( '[instagram-feed feed=%1$d %2$s]', $id, $atts );
}

/**
 * Whether Smash Balloon output contains post items (not admin-only errors).
 *
 * @param string $html Feed HTML.
 */
function ovents_sbi_feed_has_items( $html ) {
	if ( '' === trim( $html ) ) {
		return false;
	}
	if ( false !== stripos( $html, 'sbi_mod_error' ) ) {
		return false;
	}
	return (bool) preg_match( '/class="[^"]*sbi_item/', $html );
}

/**
 * Request live feed HTML.
 */
function ovents_instagram_live_feed_html() {
	if ( ! shortcode_exists( 'instagram-feed' ) ) {
		return '';
	}
	return (string) do_shortcode( ovents_instagram_feed_shortcode() );
}

/**
 * Render linked Instagram photo grid (static fallback).
 *
 * @param array<string, mixed> $args {
 *     @type int    $visible       Tiles shown before "View all" (0 = all).
 *     @type bool   $show_actions  View all + Follow buttons.
 *     @type string $grid_class    Extra classes on grid wrapper.
 * }
 */
function ovents_render_instagram_grid_static( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'visible'      => 6,
			'show_actions' => true,
			'grid_class'   => 'instagram-grid instagram-grid--photos',
		)
	);

	$tiles   = ovents_instagram_posts();
	$profile = ovents_instagram_profile_url();
	$visible = max( 0, (int) $args['visible'] );
	$total   = count( $tiles );

	if ( 0 === $total ) {
		return;
	}

	$grid_class = trim( (string) $args['grid_class'] );
	?>
	<div class="<?php echo esc_attr( $grid_class ); ?>" data-insta-grid>
		<?php
		foreach ( $tiles as $index => $post ) {
			$i     = $index + 1;
			$class = 'insta-tile';
			if ( $visible > 0 && $i > $visible ) {
				$class .= ' insta-tile--more';
			}
			$manifest = isset( $post['manifest_name'] ) ? (string) $post['manifest_name'] : '';
			$style    = '';
			if ( $manifest && function_exists( 'ovents_theme_manifest_image' ) ) {
				$row = ovents_theme_manifest_image( $manifest );
				if ( $row && ! empty( $row['object_position'] ) ) {
					$style = ' style="object-position:' . esc_attr( (string) $row['object_position'] ) . ';"';
				}
			}
			$link_label = 'video' === $post['type']
				? __( 'View reel on Instagram', 'ovents' )
				: __( 'View post on Instagram', 'ovents' );
			printf(
				'<a class="%1$s" href="%2$s" rel="noopener noreferrer" target="_blank" aria-label="%5$s"><img src="%3$s" width="800" height="800" loading="lazy" decoding="async" sizes="(max-width: 720px) 45vw, 30vw" alt="%4$s"%6$s></a>',
				esc_attr( $class ),
				esc_url( $post['url'] ),
				esc_url( get_theme_file_uri( 'assets/img/' . $post['image'] ) ),
				esc_attr( $post['alt'] ),
				esc_attr( $link_label ),
				$style
			);
		}
		?>
	</div>
	<?php
	if ( $args['show_actions'] && $visible > 0 && $total > $visible ) {
		?>
		<div class="studio-actions">
			<button type="button" class="btn btn-outline-gold" data-insta-toggle aria-expanded="false"><?php esc_html_e( 'View all', 'ovents' ); ?></button>
			<a class="btn btn-primary" href="<?php echo esc_url( $profile ); ?>" rel="noopener noreferrer" target="_blank"><?php esc_html_e( 'Follow us on Instagram', 'ovents' ); ?></a>
		</div>
		<?php
	} elseif ( $args['show_actions'] ) {
		?>
		<div class="studio-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( $profile ); ?>" rel="noopener noreferrer" target="_blank"><?php esc_html_e( 'Follow us on Instagram', 'ovents' ); ?></a>
		</div>
		<?php
	}
}

/**
 * Live feed when available, otherwise static grid.
 *
 * @param array<string, mixed> $args Passed to static fallback.
 */
function ovents_render_instagram_grid( $args = array() ) {
	$profile = ovents_instagram_profile_url();
	$live    = ovents_instagram_live_feed_html();

	if ( ovents_sbi_feed_has_items( $live ) ) {
		?>
		<div class="instagram-grid instagram-grid--photos instagram-grid--sbi" data-insta-live>
			<?php echo $live; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Smash Balloon shortcode HTML. ?>
		</div>
		<div class="studio-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( $profile ); ?>" rel="noopener noreferrer" target="_blank"><?php esc_html_e( 'Follow us on Instagram', 'ovents' ); ?></a>
		</div>
		<?php
		return;
	}

	ovents_render_instagram_grid_static( $args );
}

/**
 * Dequeue Smash Balloon CSS on the front (theme styles the feed).
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		if ( ! shortcode_exists( 'instagram-feed' ) ) {
			return;
		}
		wp_dequeue_style( 'sbi_styles' );
		wp_deregister_style( 'sbi_styles' );
	},
	100
);
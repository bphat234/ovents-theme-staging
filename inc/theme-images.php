<?php
/**
 * Responsive theme photographs (WebP + JPEG) from inc/theme-images-manifest.json.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<string, array<string, mixed>>
 */
function ovents_theme_manifest_index() {
	static $index = null;
	if ( null !== $index ) {
		return $index;
	}
	$index  = array();
	$path   = get_template_directory() . '/inc/theme-images-manifest.json';
	$raw    = is_readable( $path ) ? file_get_contents( $path ) : '';
	$decode = $raw ? json_decode( $raw, true ) : null;
	if ( is_array( $decode ) ) {
		foreach ( $decode as $row ) {
			if ( ! empty( $row['name'] ) ) {
				$index[ (string) $row['name'] ] = $row;
			}
		}
	}
	return $index;
}

/**
 * @param string $name Manifest image name.
 * @return array<string, mixed>|null
 */
function ovents_theme_manifest_image( $name ) {
	$index = ovents_theme_manifest_index();
	return isset( $index[ $name ] ) ? $index[ $name ] : null;
}

/**
 * Output a <picture> for a manifest image.
 *
 * @param string               $name Manifest name.
 * @param array<string, mixed> $args img_class, class, loading, fetchpriority, sizes.
 */
function ovents_render_manifest_image( $name, $args = array() ) {
	$item = ovents_theme_manifest_image( $name );
	if ( ! $item || empty( $item['outputs'] ) || ! is_array( $item['outputs'] ) ) {
		return;
	}

	$defaults = array(
		'class'         => '',
		'img_class'     => '',
		'loading'       => 'lazy',
		'fetchpriority' => '',
		'sizes'         => '',
		'decoding'      => 'async',
	);
	$args     = wp_parse_args( $args, $defaults );

	$jpg_path    = '';
	$webp_800    = '';
	$webp_1200   = '';
	$webp_1600   = '';
	$webp_2400   = '';
	$width       = 800;
	$height      = 640;

	foreach ( $item['outputs'] as $out ) {
		if ( empty( $out['path'] ) ) {
			continue;
		}
		$path   = (string) $out['path'];
		$format = isset( $out['format'] ) ? (string) $out['format'] : '';
		$w      = isset( $out['width'] ) ? (int) $out['width'] : 0;

		if ( 'jpeg' === $format || 'jpg' === $format ) {
			$jpg_path = $path;
			$width    = (int) ( $out['width'] ?? $width );
			$height   = (int) ( $out['height'] ?? $height );
		}
		if ( 'webp' === $format ) {
			if ( 2400 === $w ) {
				$webp_2400 = $path;
			} elseif ( 1600 === $w ) {
				$webp_1600 = $path;
			} elseif ( 1200 === $w ) {
				$webp_1200 = $path;
			} elseif ( 800 === $w && '' === $webp_800 ) {
				$webp_800 = $path;
			}
		}
	}

	$base_uri = get_theme_file_uri( 'assets/img/' );
	$alt      = isset( $item['alt'] ) ? (string) $item['alt'] : '';
	$pos      = isset( $item['object_position'] ) ? (string) $item['object_position'] : 'center center';
	$category = isset( $item['category'] ) ? (string) $item['category'] : 'content';

	$sizes = (string) $args['sizes'];
	if ( '' === $sizes ) {
		if ( $webp_2400 || $webp_1200 ) {
			$sizes = '100vw';
		} elseif ( 'portfolio' === $category ) {
			$sizes = '(max-width: 720px) 92vw, 30vw';
		} elseif ( 'card' === $category ) {
			$sizes = '(max-width: 720px) 96vw, 30vw';
		} elseif ( 'studio' === $category ) {
			$sizes = '(max-width: 720px) 45vw, 30vw';
		} else {
			$sizes = '(max-width: 900px) 92vw, min(28rem, 42vw)';
		}
	}

	$webp_srcset = array();
	if ( $webp_800 ) {
		$webp_srcset[] = esc_url( $base_uri . $webp_800 ) . ' 800w';
	}
	if ( $webp_1600 ) {
		$webp_srcset[] = esc_url( $base_uri . $webp_1600 ) . ' 1600w';
	}
	if ( $webp_1200 ) {
		$webp_srcset[] = esc_url( $base_uri . $webp_1200 ) . ' 1200w';
	}
	if ( $webp_2400 ) {
		$webp_srcset[] = esc_url( $base_uri . $webp_2400 ) . ' 2400w';
	}

	$img_src = $jpg_path ? $base_uri . $jpg_path : ( $webp_800 ? $base_uri . $webp_800 : '' );
	if ( '' === $img_src ) {
		return;
	}

	$img_w = $width;
	$img_h = $height;
	if ( $jpg_path ) {
		foreach ( $item['outputs'] as $out ) {
			if ( isset( $out['path'] ) && $out['path'] === $jpg_path ) {
				$img_w = (int) ( $out['width'] ?? $img_w );
				$img_h = (int) ( $out['height'] ?? $img_h );
				break;
			}
		}
	}

	printf( '<picture%s>', $args['class'] ? ' class="' . esc_attr( (string) $args['class'] ) . '"' : '' );
	if ( $webp_srcset ) {
		printf(
			'<source type="image/webp" srcset="%s" sizes="%s">',
			esc_attr( implode( ', ', $webp_srcset ) ),
			esc_attr( $sizes )
		);
	}
	$img_attrs = array(
		'class'            => (string) $args['img_class'],
		'src'              => $img_src,
		'width'            => $img_w,
		'height'           => $img_h,
		'alt'              => $alt,
		'loading'          => (string) $args['loading'],
		'decoding'         => (string) $args['decoding'],
		'sizes'            => $sizes,
		'style'            => 'object-position:' . $pos . ';',
		'fetchpriority'    => (string) $args['fetchpriority'],
	);
	if ( $jpg_path ) {
		$img_attrs['srcset'] = $base_uri . $jpg_path . ' ' . $img_w . 'w';
	}
	echo '<img';
	foreach ( $img_attrs as $attr => $value ) {
		if ( '' === $value ) {
			continue;
		}
		if ( 'src' === $attr ) {
			printf( ' %s="%s"', esc_attr( $attr ), esc_url( $value ) );
		} elseif ( 'srcset' === $attr ) {
			printf( ' %s="%s"', esc_attr( $attr ), esc_attr( $value ) );
		} elseif ( 'width' === $attr || 'height' === $attr ) {
			printf( ' %s="%d"', esc_attr( $attr ), (int) $value );
		} else {
			printf( ' %s="%s"', esc_attr( $attr ), esc_attr( $value ) );
		}
	}
	echo '>';
	echo '</picture>';
}

/**
 * Homepage hero: desktop WebP/JPEG srcset + portrait mobile assets under 768px.
 */
function ovents_render_home_hero_picture() {
	$item = ovents_theme_manifest_image( 'hero-erica-samuel-pavilion' );
	if ( ! $item || empty( $item['outputs'] ) ) {
		return;
	}

	$base = get_theme_file_uri( 'assets/img/' );
	$alt  = isset( $item['alt'] ) ? (string) $item['alt'] : '';

	$desktop_webp_srcset = '';
	$desktop_jpg         = '';
	$desktop_w           = 1200;
	$desktop_h           = 675;
	$mobile_webp         = '';
	$mobile_jpg          = '';

	foreach ( $item['outputs'] as $out ) {
		$path   = isset( $out['path'] ) ? (string) $out['path'] : '';
		$format = isset( $out['format'] ) ? (string) $out['format'] : '';
		$role   = isset( $out['role'] ) ? (string) $out['role'] : 'desktop';
		$w      = (int) ( $out['width'] ?? 0 );
		if ( '' === $path ) {
			continue;
		}
		$url = $base . $path;
		if ( 'mobile' === $role ) {
			if ( 'webp' === $format ) {
				$mobile_webp = $url;
			} elseif ( 'jpeg' === $format || 'jpg' === $format ) {
				$mobile_jpg = $url;
			}
			continue;
		}
		if ( 'webp' === $format && ( 1200 === $w || 2400 === $w ) ) {
			$desktop_webp_srcset .= ( '' === $desktop_webp_srcset ? '' : ', ' ) . esc_url( $url ) . ' ' . $w . 'w';
		}
		if ( ( 'jpeg' === $format || 'jpg' === $format ) && 1200 === $w ) {
			$desktop_jpg = $url;
			$desktop_w   = (int) ( $out['width'] ?? $desktop_w );
			$desktop_h   = (int) ( $out['height'] ?? $desktop_h );
		}
	}

	if ( '' === $desktop_jpg && '' === $mobile_webp ) {
		return;
	}

	echo '<picture>';
	if ( $mobile_webp ) {
		printf(
			'<source type="image/webp" media="(max-width: 767px)" srcset="%s">',
			esc_url( $mobile_webp )
		);
	}
	if ( $mobile_jpg ) {
		printf(
			'<source type="image/jpeg" media="(max-width: 767px)" srcset="%s">',
			esc_url( $mobile_jpg )
		);
	}
	if ( $desktop_webp_srcset ) {
		printf(
			'<source type="image/webp" media="(min-width: 768px)" srcset="%s" sizes="100vw">',
			esc_attr( $desktop_webp_srcset )
		);
	}

	$fallback_src = $desktop_jpg ? $desktop_jpg : $mobile_jpg;
	echo '<img class="hero-bg" src="' . esc_url( $fallback_src ) . '" width="' . (int) $desktop_w . '" height="' . (int) $desktop_h . '" alt="' . esc_attr( $alt ) . '" loading="eager" decoding="async" fetchpriority="high" sizes="100vw"';
	if ( $desktop_jpg ) {
		echo ' srcset="' . esc_attr( esc_url( $desktop_jpg ) . ' ' . $desktop_w . 'w' ) . '"';
	}
	echo '>';
	echo '</picture>';
}

/**
 * JPEG URL for social / preload (1200 hero or 800 content).
 *
 * @param string $name Manifest name.
 */
/**
 * Hero/content WebP URL for preload (prefers 1200px, then 2400px).
 *
 * @param string $name Manifest name.
 */
function ovents_manifest_image_webp_preload_url( $name ) {
	$item = ovents_theme_manifest_image( $name );
	if ( ! $item || empty( $item['outputs'] ) ) {
		return '';
	}
	$pick = '';
	foreach ( $item['outputs'] as $out ) {
		if ( empty( $out['path'] ) || 'webp' !== ( $out['format'] ?? '' ) ) {
			continue;
		}
		if ( isset( $out['role'] ) && 'mobile' === (string) $out['role'] ) {
			continue;
		}
		$w = (int) ( $out['width'] ?? 0 );
		if ( 1200 === $w ) {
			return get_theme_file_uri( 'assets/img/' . $out['path'] );
		}
		if ( 2400 === $w && '' === $pick ) {
			$pick = (string) $out['path'];
		}
	}
	return $pick ? get_theme_file_uri( 'assets/img/' . $pick ) : '';
}

function ovents_manifest_image_jpeg_url( $name ) {
	$item = ovents_theme_manifest_image( $name );
	if ( ! $item || empty( $item['outputs'] ) ) {
		return '';
	}
	foreach ( $item['outputs'] as $out ) {
		$format = isset( $out['format'] ) ? (string) $out['format'] : '';
		$role   = isset( $out['role'] ) ? (string) $out['role'] : 'desktop';
		if ( 'mobile' === $role ) {
			continue;
		}
		if ( ( 'jpeg' === $format || 'jpg' === $format ) && ! empty( $out['path'] ) ) {
			return get_theme_file_uri( 'assets/img/' . $out['path'] );
		}
	}
	return '';
}

/**
 * Inner-hero manifest name by page slug.
 *
 * @param string $slug Page slug.
 */
function ovents_inner_hero_manifest_name( $slug ) {
	$map = array(
		'about'            => 'hero-outdoor-tablescape',
		'weddings'         => 'hero-erica-samuel-bridge',
		'corporate-events' => 'hero-planners-table-lunch-learn',
		'parties'          => 'hero-balloon-celebration',
		'contact'          => 'hero-erica-samuel-vineyard',
		'portfolio'        => 'hero-erica-samuel-sweetheart-table',
	);
	return isset( $map[ $slug ] ) ? $map[ $slug ] : '';
}
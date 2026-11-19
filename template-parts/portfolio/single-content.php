<?php
/**
 * Single portfolio event — hero, facts, gallery, CTA.
 *
 * @package Ovents
 */

$post = get_post();
$meta = ovents_portfolio_get_meta( $post );
$slug = $meta['event_slug'] ?: $post->post_name;
$home = untrailingslashit( home_url() );
$intro = ovents_portfolio_visible_intro( $meta );
$facts = ovents_portfolio_facts( $meta );
$gallery = isset( $meta['gallery'] ) && is_array( $meta['gallery'] ) ? $meta['gallery'] : array();
$type_label = $meta['type_label'] ?: ucfirst( $meta['event_type'] );
$lightbox_urls = array();
?>
<article class="portfolio-single">
	<div class="portfolio-single__hero">
		<?php
		ovents_portfolio_render_image(
			$slug,
			$meta['cover_stem'],
			array(
				'widths'          => array( 800, 1200 ),
				'sizes'           => '100vw',
				'img_class'       => 'portfolio-single__hero-img',
				'loading'         => 'eager',
				'fetchpriority'   => 'high',
				'width'           => 1200,
				'height'          => 1500,
				'object_position' => $meta['cover_pos'] ?: 'center center',
				'alt'             => get_the_title( $post ),
			)
		);
		?>
	</div>

	<header class="wrap portfolio-single__head">
		<p class="portfolio-single__type"><?php echo esc_html( $type_label ); ?></p>
		<h1 class="portfolio-single__title"><?php the_title(); ?></h1>
		<?php if ( $intro ) : ?>
			<p class="portfolio-single__intro"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>
		<?php if ( $facts ) : ?>
			<dl class="portfolio-single__facts">
				<?php foreach ( $facts as $fact ) : ?>
					<div class="portfolio-single__fact">
						<dt><?php echo esc_html( $fact['label'] ); ?></dt>
						<dd><?php echo esc_html( $fact['value'] ); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>
		<?php endif; ?>
		<?php
		$quote = trim( $meta['quote'] );
		if ( '' !== $quote && ! ovents_portfolio_intro_is_placeholder( $quote ) ) :
			?>
			<blockquote class="portfolio-single__quote">
				<p><?php echo esc_html( $quote ); ?></p>
				<?php if ( trim( $meta['quote_attr'] ) ) : ?>
					<cite><?php echo esc_html( $meta['quote_attr'] ); ?></cite>
				<?php endif; ?>
			</blockquote>
		<?php endif; ?>
	</header>

	<?php if ( $gallery ) : ?>
		<div class="portfolio-single__gallery" data-portfolio-gallery>
			<?php
			$portrait_buffer = array();
			$flush_pair      = static function () use ( &$portrait_buffer, $slug, &$lightbox_urls ) {
				if ( count( $portrait_buffer ) < 1 ) {
					return;
				}
				echo '<div class="portfolio-single__pair">';
				foreach ( $portrait_buffer as $item ) {
					$lightbox_urls[] = esc_url( get_theme_file_uri( 'assets/img/portfolio/' . $slug . '/' . $item['stem'] . '-1600.jpg' ) );
					$idx            = count( $lightbox_urls ) - 1;
					echo '<figure class="portfolio-single__figure portfolio-single__figure--portrait portfolio-reveal">';
					ovents_portfolio_render_image(
						$slug,
						$item['stem'],
						array(
							'widths'    => array( 800, 1600 ),
							'sizes'     => '(max-width: 720px) 100vw, 50vw',
							'img_class' => 'portfolio-single__img',
							'width'     => (int) $item['w'],
							'height'    => (int) $item['h'],
							'alt'       => $item['alt'],
							'class'     => 'portfolio-single__picture',
						)
					);
					printf(
						'<button type="button" class="portfolio-single__zoom" data-lightbox-index="%d" aria-label="%s"></button>',
						(int) $idx,
						esc_attr__( 'View larger', 'ovents' )
					);
					echo '</figure>';
				}
				echo '</div>';
				$portrait_buffer = array();
			};

			foreach ( $gallery as $item ) {
				$layout = isset( $item['layout'] ) ? (string) $item['layout'] : 'landscape';
				if ( 'portrait' === $layout ) {
					$portrait_buffer[] = $item;
					if ( count( $portrait_buffer ) >= 2 ) {
						$flush_pair();
					}
					continue;
				}
				$flush_pair();
				$lightbox_urls[] = esc_url( get_theme_file_uri( 'assets/img/portfolio/' . $slug . '/' . $item['stem'] . '-1600.jpg' ) );
				$idx             = count( $lightbox_urls ) - 1;
				echo '<figure class="portfolio-single__figure portfolio-single__figure--landscape portfolio-reveal">';
				ovents_portfolio_render_image(
					$slug,
					$item['stem'],
					array(
						'widths'    => array( 800, 1600 ),
						'sizes'     => '(max-width: 720px) 100vw, 1100px',
						'img_class' => 'portfolio-single__img',
						'width'     => (int) $item['w'],
						'height'    => (int) $item['h'],
						'alt'       => $item['alt'],
						'class'     => 'portfolio-single__picture',
					)
				);
				printf(
					'<button type="button" class="portfolio-single__zoom" data-lightbox-index="%d" aria-label="%s"></button>',
					(int) $idx,
					esc_attr__( 'View larger', 'ovents' )
				);
				echo '</figure>';
			}
			$flush_pair();
			?>
		</div>
		<script type="application/json" id="portfolio-lightbox-data"><?php echo wp_json_encode( array_values( $lightbox_urls ) ); ?></script>
	<?php endif; ?>

	<?php if ( trim( $meta['photographer'] ) ) : ?>
		<p class="wrap portfolio-single__credit"><?php echo esc_html( sprintf( __( 'Photographs: %s', 'ovents' ), $meta['photographer'] ) ); ?></p>
	<?php endif; ?>

	<footer class="wrap portfolio-single__foot">
		<p class="portfolio-single__enquiry">
			<a class="btn btn-primary" href="<?php echo esc_url( $home . '/contact/' ); ?>"><?php esc_html_e( 'Plan your event', 'ovents' ); ?></a>
		</p>
		<nav class="portfolio-single__nav" aria-label="<?php esc_attr_e( 'Other portfolio events', 'ovents' ); ?>">
			<?php
			$prev = ovents_portfolio_adjacent( $post, 'previous' );
			$next = ovents_portfolio_adjacent( $post, 'next' );
			if ( $prev ) :
				?>
				<a class="portfolio-single__nav-link portfolio-single__nav-link--prev" href="<?php echo esc_url( get_permalink( $prev ) ); ?>"><span aria-hidden="true">&larr;</span> <?php echo esc_html( get_the_title( $prev ) ); ?></a>
			<?php endif; ?>
			<?php if ( $next ) : ?>
				<a class="portfolio-single__nav-link portfolio-single__nav-link--next" href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo esc_html( get_the_title( $next ) ); ?> <span aria-hidden="true">&rarr;</span></a>
			<?php endif; ?>
		</nav>
	</footer>
</article>

<div class="portfolio-lightbox" id="portfolio-lightbox" hidden>
	<div class="portfolio-lightbox__backdrop" data-lightbox-close tabindex="-1"></div>
	<div class="portfolio-lightbox__stage" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Image viewer', 'ovents' ); ?>">
		<button type="button" class="portfolio-lightbox__close" data-lightbox-close aria-label="<?php esc_attr_e( 'Close', 'ovents' ); ?>">&times;</button>
		<button type="button" class="portfolio-lightbox__prev" data-lightbox-prev aria-label="<?php esc_attr_e( 'Previous image', 'ovents' ); ?>">&lsaquo;</button>
		<img class="portfolio-lightbox__img" src="" alt="">
		<button type="button" class="portfolio-lightbox__next" data-lightbox-next aria-label="<?php esc_attr_e( 'Next image', 'ovents' ); ?>">&rsaquo;</button>
	</div>
</div>
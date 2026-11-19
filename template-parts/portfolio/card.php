<?php
/**
 * Editorial portfolio card (4:5 cover, hover reveal).
 *
 * @package Ovents
 */

$post = $args['post'] ?? get_post();
if ( ! $post instanceof WP_Post ) {
	return;
}
$meta    = ovents_portfolio_get_meta( $post );
$slug    = $meta['event_slug'] ?: $post->post_name;
$stem    = $meta['cover_stem'];
$type    = $meta['type_label'] ?: ucfirst( $meta['event_type'] );
$compact = ! empty( $args['compact'] );
$sizes   = $compact
	? '(max-width: 720px) 92vw, (max-width: 1100px) 45vw, 22vw'
	: '(max-width: 720px) 92vw, 30vw';
$url     = get_permalink( $post );
?>
<article class="portfolio-lookbook-card<?php echo $compact ? ' portfolio-lookbook-card--archive' : ''; ?>">
	<a class="portfolio-lookbook-card__link" href="<?php echo esc_url( $url ); ?>">
		<figure class="portfolio-lookbook-card__media">
			<?php
			ovents_portfolio_render_image(
				$slug,
				$stem,
				array(
					'widths'          => array( 800, 1200 ),
					'sizes'           => $sizes,
					'img_class'       => 'portfolio-lookbook-card__img',
					'width'           => 1200,
					'height'          => 1500,
					'object_position' => $meta['cover_pos'] ?: 'center center',
					'alt'             => get_the_title( $post ),
				)
			);
			?>
			<figcaption class="portfolio-lookbook-card__overlay">
				<span class="portfolio-lookbook-card__type"><?php echo esc_html( $type ); ?></span>
				<span class="portfolio-lookbook-card__title"><?php echo esc_html( get_the_title( $post ) ); ?></span>
			</figcaption>
		</figure>
	</a>
</article>
<?php
/**
 * Cross-links between service pages (weddings, parties, corporate, portfolio, journal).
 *
 * @package Ovents
 *
 * @var array $args { exclude?: string slug to omit }
 */
$exclude = isset( $args['exclude'] ) ? sanitize_key( (string) $args['exclude'] ) : '';
$home    = untrailingslashit( home_url() );

$links = array(
	'weddings'         => array(
		'label' => __( 'Wedding planning', 'ovents' ),
		'url'   => $home . '/weddings/',
	),
	'corporate-events' => array(
		'label' => __( 'Corporate events', 'ovents' ),
		'url'   => $home . '/corporate-events/',
	),
	'parties'          => array(
		'label' => __( 'Private parties', 'ovents' ),
		'url'   => $home . '/parties/',
	),
	'portfolio'        => array(
		'label' => __( 'Portfolio', 'ovents' ),
		'url'   => $home . '/portfolio/',
	),
	'blog'             => array(
		'label' => __( 'Planning insights', 'ovents' ),
		'url'   => $home . '/blog/',
	),
);
?>
<nav class="service-related-links" aria-labelledby="service-related-heading">
	<div class="service-related-links__panel">
		<p id="service-related-heading" class="service-related-links__title label-gold"><?php esc_html_e( 'Explore further', 'ovents' ); ?></p>
		<p class="service-related-links__lead"><?php esc_html_e( 'More ways we help you celebrate and plan with confidence.', 'ovents' ); ?></p>
		<ul class="service-related-links__list">
			<?php
			foreach ( $links as $slug => $link ) {
				if ( $slug === $exclude ) {
					continue;
				}
				?>
				<li>
					<a class="service-related-links__pill" href="<?php echo esc_url( $link['url'] ); ?>">
						<span><?php echo esc_html( $link['label'] ); ?></span>
						<?php echo ovents_icon( 'chevron-right', array( 'width' => 16, 'height' => 16, 'class' => 'service-related-links__icon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
</nav>
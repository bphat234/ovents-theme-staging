<?php
/**
 * Inner page hero — Wix-style image, left-aligned title and CTAs.
 *
 * @package Ovents
 */
$config = ovents_get_inner_hero_args( isset( $args ) ? $args : array() );
$img    = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/img/' . ltrim( $file, '/' ) ) );
};
$eyebrow   = (string) $config['eyebrow'];
$title     = (string) $config['title'];
$lead      = (string) $config['lead'];
$image     = (string) $config['image'];
$image_url = (string) $config['image_url'];
$show_ctas = ! empty( $config['show_ctas'] );
$contact   = (string) $config['contact'];
?>
<section class="inner-hero" aria-labelledby="inner-hero-heading">
	<?php if ( ! empty( $config['image_name'] ) && function_exists( 'ovents_render_manifest_image' ) ) : ?>
		<?php
		ovents_render_manifest_image(
			(string) $config['image_name'],
			array(
				'img_class'     => 'inner-hero__bg',
				'loading'       => 'eager',
				'fetchpriority' => 'high',
				'sizes'         => '100vw',
			)
		);
		?>
	<?php else : ?>
	<img class="inner-hero__bg" src="<?php echo $image_url !== '' ? esc_url( $image_url ) : $img( $image ); ?>" width="1920" height="900" loading="eager" fetchpriority="high" alt="" role="presentation">
	<?php endif; ?>
	<div class="inner-hero__shade" aria-hidden="true"></div>
	<div class="inner-hero__overlay">
		<div class="wrap inner-hero__inner">
			<?php if ( $eyebrow !== '' ) : ?>
				<p class="hero-eyebrow hero-eyebrow--on-dark"><?php echo esc_html( $eyebrow ); ?></p>
			<?php endif; ?>
			<h1 id="inner-hero-heading" class="inner-hero__title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $lead !== '' ) : ?>
				<p class="inner-hero__lead"><?php echo esc_html( $lead ); ?></p>
			<?php endif; ?>
			<?php if ( $show_ctas ) : ?>
				<div class="inner-hero__ctas hero-ctas">
					<a class="btn btn-light" href="<?php echo esc_url( $contact ); ?>"><?php echo esc_html( $config['primary_label'] ); ?></a>
					<?php if ( ! empty( $config['show_secondary'] ) && $config['secondary_label'] !== '' && $config['secondary_url'] !== '' ) : ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( $config['secondary_url'] ); ?>" rel="noopener noreferrer" target="_blank" data-track="whatsapp_click" data-page-type="corporate"><?php echo esc_html( $config['secondary_label'] ); ?></a>
					<?php endif; ?>
				</div>
				<?php if ( ! empty( $config['cta_note'] ) ) : ?>
					<p class="inner-hero__cta-note"><?php echo esc_html( $config['cta_note'] ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

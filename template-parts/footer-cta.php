<?php
/**
 * Site-wide footer CTA band (above footer link columns).
 *
 * @package Ovents
 */

if ( ! ovents_show_footer_cta() ) {
	return;
}

$cta = ovents_footer_cta_config();
$is_corporate = ! empty( $cta['show_corporate'] );
?>
<section class="cta-band site-footer__cta<?php echo $is_corporate ? ' cta-band--corporate' : ''; ?>" aria-labelledby="<?php echo esc_attr( (string) $cta['heading_id'] ); ?>">
	<div class="wrap cta-band__inner">
		<p class="label-gold cta-band__eyebrow"><?php echo esc_html( $cta['eyebrow'] ); ?></p>
		<h2 id="<?php echo esc_attr( (string) $cta['heading_id'] ); ?>"><?php echo esc_html( $cta['title'] ); ?></h2>
		<p><?php echo esc_html( $cta['text'] ); ?></p>
		<div class="cta-band__actions">
			<a class="btn btn-light" href="<?php echo esc_url( $cta['primary_url'] ); ?>"><?php echo esc_html( $cta['primary_label'] ); ?></a>
			<?php if ( $is_corporate ) : ?>
				<a class="btn btn-ghost" href="<?php echo esc_url( ovents_whatsapp_corporate_url() ); ?>" rel="noopener noreferrer" target="_blank" data-track="whatsapp_click" data-page-type="corporate"><?php esc_html_e( 'WhatsApp', 'ovents' ); ?></a>
				<a class="cta-band__link" href="tel:+447447462409"><?php esc_html_e( 'Call +44 7447 462409', 'ovents' ); ?></a>
				<a class="cta-band__link" href="mailto:info@ovents.co.uk">info@ovents.co.uk</a>
			<?php endif; ?>
		</div>
	</div>
</section>
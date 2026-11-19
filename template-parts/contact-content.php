<?php
/**
 * Contact page.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
?>
<?php
get_template_part( 'template-parts/inner', 'hero' );
?>

<section id="page-content" class="section section--inner section--contact" aria-labelledby="contact-intro-heading">
	<div class="wrap inner-split inner-split--contact">
		<aside class="inner-split__copy content-prose contact-sidebar" aria-label="<?php esc_attr_e( 'Contact options and process', 'ovents' ); ?>">
			<h2 id="contact-intro-heading"><?php esc_html_e( 'Your plans, our attention', 'ovents' ); ?></h2>
			<p class="contact-response-note"><?php esc_html_e( 'We reply within one to two business days.', 'ovents' ); ?></p>

			<div class="contact-channels">
				<a class="contact-channel" href="tel:+447447462409" data-track="click_to_call">
					<span class="contact-channel__icon" aria-hidden="true"><?php echo ovents_icon( 'phone', array( 'width' => 20, 'height' => 20 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="contact-channel__text">
						<span class="contact-channel__label"><?php esc_html_e( 'Call', 'ovents' ); ?></span>
						<span class="contact-channel__value">+44 7447 462409</span>
					</span>
				</a>
				<a class="contact-channel" href="<?php echo esc_url( ovents_whatsapp_enquiry_url() ); ?>" rel="noopener noreferrer" target="_blank" data-track="whatsapp_click">
					<span class="contact-channel__icon" aria-hidden="true"><?php echo ovents_icon( 'message-circle', array( 'width' => 20, 'height' => 20 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="contact-channel__text">
						<span class="contact-channel__label"><?php esc_html_e( 'WhatsApp', 'ovents' ); ?></span>
						<span class="contact-channel__value"><?php esc_html_e( 'Message the team', 'ovents' ); ?></span>
					</span>
				</a>
				<a class="contact-channel" href="mailto:info@ovents.co.uk" data-track="email_click">
					<span class="contact-channel__icon" aria-hidden="true"><?php echo ovents_icon( 'mail', array( 'width' => 20, 'height' => 20 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="contact-channel__text">
						<span class="contact-channel__label"><?php esc_html_e( 'Email', 'ovents' ); ?></span>
						<span class="contact-channel__value">info@ovents.co.uk</span>
					</span>
				</a>
			</div>

			<div class="contact-panel">
				<h3 class="contact-panel__title"><?php esc_html_e( 'What happens next', 'ovents' ); ?></h3>
				<ol class="contact-process">
					<li>
						<span class="contact-process__step" aria-hidden="true">1</span>
						<div>
							<strong><?php esc_html_e( 'Enquiry', 'ovents' ); ?></strong>
							<p><?php esc_html_e( 'Tell us about your date, location and priorities.', 'ovents' ); ?></p>
						</div>
					</li>
					<li>
						<span class="contact-process__step" aria-hidden="true">2</span>
						<div>
							<strong><?php esc_html_e( 'Free consultation', 'ovents' ); ?></strong>
							<p><?php esc_html_e( 'We explore scope, timing and how we can help.', 'ovents' ); ?></p>
						</div>
					</li>
					<li>
						<span class="contact-process__step" aria-hidden="true">3</span>
						<div>
							<strong><?php esc_html_e( 'Itemised proposal', 'ovents' ); ?></strong>
							<p><?php esc_html_e( 'Transparent next steps, with no obligation.', 'ovents' ); ?></p>
						</div>
					</li>
				</ol>
			</div>

			<div class="contact-meta">
				<p class="contact-meta__line"><strong><?php esc_html_e( 'Areas we serve', 'ovents' ); ?></strong> — <?php esc_html_e( 'London and UK-wide, including Essex, Hertfordshire, Surrey, Kent and Sussex.', 'ovents' ); ?></p>
				<p class="contact-meta__line"><strong><?php esc_html_e( 'Office hours', 'ovents' ); ?></strong> — <?php esc_html_e( '9am to 5pm, Monday to Friday', 'ovents' ); ?></p>
			</div>
		</aside>

		<div class="inner-split__form contact-form-panel" id="enquiry-form">
			<h2 class="contact-form-panel__title"><?php esc_html_e( 'Enquiry form', 'ovents' ); ?></h2>
			<p class="form-intro"><?php esc_html_e( 'Prefer to write? Share your plans below and we will be in touch.', 'ovents' ); ?></p>
			<?php echo do_shortcode( '[ovents_enquiry_form]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
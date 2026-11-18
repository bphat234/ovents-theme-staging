<?php
/**
 * Footer template.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
$privacy = get_page_by_path( 'privacy-policy' );
$terms   = get_page_by_path( 'terms-of-use' );
?>
<footer class="site-footer" id="site-footer">
	<?php get_template_part( 'template-parts/footer', 'cta' ); ?>
	<div class="wrap footer-grid">
		<div class="footer-col">
			<p class="footer-label">Explore</p>
			<ul>
				<li><a href="<?php echo esc_url( $home . '/' ); ?>">Home</a></li>
				<li><a href="<?php echo esc_url( $home . '/about/' ); ?>">About</a></li>
				<li><a href="<?php echo esc_url( $home . '/portfolio/' ); ?>">Portfolio</a></li>
				<li><a href="<?php echo esc_url( $home . '/blog/' ); ?>">Journal</a></li>
				<li><a href="<?php echo esc_url( $home . '/contact/' ); ?>">Contact</a></li>
			</ul>
		</div>
		<div class="footer-col">
			<p class="footer-label">Services</p>
			<ul>
				<li><a href="<?php echo esc_url( $home . '/weddings/' ); ?>">Weddings</a></li>
				<li><a href="<?php echo esc_url( $home . '/corporate-events/' ); ?>">Corporate</a></li>
				<li><a href="<?php echo esc_url( $home . '/parties/' ); ?>">Parties</a></li>
			</ul>
		</div>
		<div class="footer-col">
			<p class="footer-label">Company</p>
			<ul>
				<?php if ( $privacy ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $privacy ) ); ?>">Privacy policy</a></li>
				<?php endif; ?>
				<?php if ( $terms ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $terms ) ); ?>">Terms of use</a></li>
				<?php endif; ?>
				<li><a href="<?php echo esc_url( $home . '/faq/' ); ?>">FAQ</a></li>
			</ul>
		</div>
		<div class="footer-col">
			<p class="footer-label">Contact</p>
			<p class="footer-contact-lines">
				<a class="icon-text-link" href="tel:+447447462409">
					<?php echo ovents_icon( 'phone', array( 'width' => 16, 'height' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					+44 7447 462409
				</a>
				<a class="icon-text-link" href="mailto:info@ovents.co.uk">
					<?php echo ovents_icon( 'mail', array( 'width' => 16, 'height' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					info@ovents.co.uk
				</a>
				<a class="icon-text-link" href="<?php echo esc_url( ovents_instagram_profile_url() ); ?>" rel="noopener noreferrer" target="_blank">
					<?php echo ovents_icon( 'instagram', array( 'width' => 16, 'height' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					Instagram
				</a>
			</p>
		</div>
	</div>
	<div class="wrap footer-legal">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Ovents LTD, registered in England &amp; Wales, company no. 11531903. All rights reserved.</span>
		<span class="footer-legal-links">
			<?php if ( $privacy ) : ?>
				<a href="<?php echo esc_url( get_permalink( $privacy ) ); ?>">Privacy</a>
			<?php endif; ?>
			<?php if ( $terms ) : ?>
				<a href="<?php echo esc_url( get_permalink( $terms ) ); ?>">Terms</a>
			<?php endif; ?>
		</span>
	</div>
</footer>
<?php if ( ovents_whatsapp_float_visible() ) : ?>
<a
	class="whatsapp-float"
	href="<?php echo esc_url( ovents_whatsapp_enquiry_url() ); ?>"
	rel="noopener"
	target="_blank"
	aria-label="<?php esc_attr_e( 'Chat with Ovents on WhatsApp', 'ovents' ); ?>"
	data-track="whatsapp_click"
>
	<span class="whatsapp-float__tooltip"><?php esc_html_e( 'Chat on WhatsApp', 'ovents' ); ?></span>
	<?php echo ovents_whatsapp_icon( 28 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</a>
<?php endif; ?>
<div class="callbar" aria-label="<?php esc_attr_e( 'Mobile quick actions', 'ovents' ); ?>">
	<a href="tel:+447447462409" data-track="click_to_call"><?php esc_html_e( 'Call', 'ovents' ); ?></a>
	<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Enquire', 'ovents' ); ?></a>
</div>
<div id="ovents-consent-banner" class="consent-banner" hidden>
	<p><?php esc_html_e( 'We use cookies for analytics to improve this site. Choose whether to allow analytics storage.', 'ovents' ); ?></p>
	<div class="consent-banner__actions">
		<button type="button" class="btn btn-primary" data-consent-accept><?php esc_html_e( 'Accept', 'ovents' ); ?></button>
		<button type="button" class="btn btn-ghost" data-consent-reject><?php esc_html_e( 'Reject', 'ovents' ); ?></button>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>

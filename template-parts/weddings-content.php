<?php
/**
 * Weddings page sections.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
$img  = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/img/' . ltrim( $file, '/' ) ) );
};
?>
<?php
get_template_part( 'template-parts/inner', 'hero' );
?>

<section id="page-content" class="section section--inner" aria-labelledby="weddings-intro-heading">
	<div class="wrap inner-split">
		<figure class="inner-split__media">
			<?php ovents_render_manifest_image( 'content-erica-samuel-first-dance' ); ?>
		</figure>
		<div class="inner-split__copy content-prose">
			<h2 id="weddings-intro-heading">Wherever you&rsquo;re starting from.</h2>
			<p>Some couples come to us before a venue is chosen. Others have most of the suppliers booked, and need a calm coordinator on the day. We will meet you where you are, and take it from there.</p>
			<p>We are based in London and work across England, Scotland, Wales and Northern Ireland, including Essex, Hertfordshire, Surrey, Kent and Sussex.</p>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--tiers" aria-labelledby="weddings-tiers-heading">
	<div class="wrap">
		<h2 id="weddings-tiers-heading" class="centered">How we can help</h2>
		<div class="service-tiers">
			<article class="service-tier">
				<h3>Full Wedding Planning</h3>
				<p>From the first ideas through to the wedding day: timelines, suppliers, and a plan that stays realistic for your budget and your guest list.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about planning</a>
			</article>
			<article class="service-tier">
				<h3>Lite planning</h3>
				<p>Support at the stage you need most — refining a plan you have started, coordinating key suppliers, or joining part-way through.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about Lite planning</a>
			</article>
			<article class="service-tier">
				<h3>On-the-Day Coordination</h3>
				<p>We work from your run sheet, liaise with suppliers, and keep the day moving, so you can be present for it.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about coordination</a>
			</article>
		</div>
	</div>
</section>

<?php
ovents_render_testimonial_proof_section( 'weddings' );
?>

<section class="section section--inner section--inner-alt section--parties-details section--weddings-details" aria-labelledby="weddings-includes-heading">
	<div class="wrap">
		<header class="weddings-details__header">
			<h2 id="weddings-includes-heading">What we look after</h2>
		</header>
		<div class="inner-split weddings-details-split inner-split--media-end">
			<figure class="inner-split__media weddings-details__media">
				<?php ovents_render_manifest_image( 'content-erica-samuel-sweetheart-table' ); ?>
			</figure>
			<div class="inner-split__copy weddings-details__copy">
				<div class="inner-feature-grid">
					<article><h3>Supplier coordination</h3><p>Every supplier briefed on timings, roles and what you have asked for.</p></article>
					<article><h3>Timelines and run sheets</h3><p>Clear schedules in the run-up, and practical run sheets for you and your team.</p></article>
					<article><h3>Guest flow</h3><p>Arrivals, the ceremony and the reception, moving calmly from one moment to the next.</p></article>
					<article><h3>Multicultural celebrations</h3><p>Support for multi-part weddings, including outfit changes, venue changes and a carefully planned guest flow.</p></article>
				</div>
				<div class="parties-process-block weddings-approach-block weddings-approach-block--in-split" aria-labelledby="weddings-approach-heading">
					<h2 id="weddings-approach-heading" class="parties-process-title">How we begin</h2>
					<div class="weddings-approach-copy">
						<p>We listen first: what matters to you, what is already booked, and where you want practical help. From there we build a clear plan, and we stay in touch in the run-up to the day.</p>
						<p>We have supported weddings in Reading, London and across the UK, with the same calm, organised approach.</p>
					</div>
				</div>
			</div>
		</div>
		<?php get_template_part( 'template-parts/service-related-links', null, array( 'exclude' => 'weddings' ) ); ?>
	</div>
</section>

<section class="section section--inner section--inner-alt section--service-faq section--weddings-faq" aria-labelledby="weddings-faq-heading">
	<div class="wrap inner-split inner-split--service-faq">
		<figure class="inner-split__media weddings-faq__media">
			<?php ovents_render_manifest_image( 'content-erica-samuel-couple' ); ?>
		</figure>
		<div class="inner-split__copy weddings-faq__copy">
			<div class="faq">
				<h2 id="weddings-faq-heading">Wedding planning questions</h2>
				<details>
					<summary>What is the difference between wedding planning and coordination?</summary>
					<p>Planning is the work before the day: research, suppliers, timelines and decisions. Coordination is the work of delivering that plan on the day. We offer both, including coordination on its own.</p>
				</details>
				<details>
					<summary>Can we book coordination without full planning?</summary>
					<p>Yes. Tell us what you have already booked, and we will outline on-the-day or Lite support.</p>
				</details>
				<details>
					<summary>Do you plan weddings outside London?</summary>
					<p>Yes. We are based in London and work across the UK.</p>
				</details>
				<details>
					<summary>Do you work on multicultural weddings?</summary>
					<p>Yes. We regularly support celebrations with more than one event, outfit changes and a detailed guest flow.</p>
				</details>
				<p class="service-faq__more"><a href="<?php echo esc_url( $home . '/faq/#faq-weddings' ); ?>">More planning FAQs</a></p>
			</div>
		</div>
	</div>
</section>


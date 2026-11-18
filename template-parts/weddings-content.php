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
			<h2 id="weddings-intro-heading">From multi-day celebrations to a single perfect day, we plan, coordinate and run it.</h2>
			<p>Some couples want help from the first venue visit. Others have most suppliers booked and need a coordinator to run the schedule on the day. We explain the difference clearly and shape support around what you have already arranged.</p>
			<p>We are based in London and work across England, Scotland, Wales and Northern Ireland, including Essex, Hertfordshire, Surrey, Kent and Sussex.</p>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--tiers" aria-labelledby="weddings-tiers-heading">
	<div class="wrap">
		<h2 id="weddings-tiers-heading" class="centered">Levels of wedding support</h2>
		<div class="service-tiers">
			<article class="service-tier">
				<h3>Full Wedding Planning</h3>
				<p>End-to-end planning from early ideas through to your wedding day. We help with timelines, supplier communication and keeping the plan realistic for your budget and guest list.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about full planning</a>
			</article>
			<article class="service-tier">
				<h3>Partial Wedding Planning</h3>
				<p>Support at the stage you need most. That might mean refining the plan you started, coordinating key suppliers or stepping in part-way through the process.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about Lite planning</a>
			</article>
			<article class="service-tier">
				<h3>On-the-Day Coordination</h3>
				<p>Professional wedding coordination on the day itself. We work from your run sheet, liaise with suppliers and help the schedule run smoothly so you can focus on the celebration.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about on-the-day coordination</a>
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
			<p class="label-gold">What we look after</p>
			<h2 id="weddings-includes-heading">What our wedding services include</h2>
		</header>
		<div class="inner-split weddings-details-split inner-split--media-end">
			<figure class="inner-split__media weddings-details__media">
				<?php ovents_render_manifest_image( 'content-erica-samuel-sweetheart-table' ); ?>
			</figure>
			<div class="inner-split__copy weddings-details__copy">
				<div class="inner-feature-grid">
					<article><h3>Supplier coordination</h3><p>Coordination and briefing so every supplier understands timings, roles and your expectations.</p></article>
					<article><h3>Timelines and run sheets</h3><p>Clear schedules in the run-up to the day and practical run sheets for you and your team.</p></article>
					<article><h3>Guest flow</h3><p>On-the-day direction so arrivals, ceremonies and receptions move calmly from one moment to the next.</p></article>
					<article><h3>Multicultural celebrations</h3><p>Support for multi-part weddings, including outfit changes, venue changes and detailed guest flows.</p></article>
				</div>
				<div class="parties-process-block weddings-approach-block weddings-approach-block--in-split" aria-labelledby="weddings-approach-heading">
					<h2 id="weddings-approach-heading" class="parties-process-title">Our wedding planning approach</h2>
					<div class="weddings-approach-copy">
						<p>We listen first. We note what matters to you, what is already booked and where you want practical help. From there we build a clear plan and stay in regular contact in the run-up to the day.</p>
						<p>We have supported weddings in Reading, London and across the UK with the same calm, organised approach.</p>
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
				<h2 id="weddings-faq-heading">Wedding planning FAQs</h2>
				<details>
					<summary>What is the difference between wedding planning and coordination?</summary>
					<p>Planning covers the work before the day: research, supplier contact, timelines and decisions. Coordination focuses on delivering the plan on the day, managing suppliers and the schedule. We offer both, including on-the-day coordination without full planning.</p>
				</details>
				<details>
					<summary>Can we book coordination without full planning?</summary>
					<p>Yes. Tell us what you have already booked and we will outline on-the-day or partial support.</p>
				</details>
				<details>
					<summary>Do you plan weddings outside London?</summary>
					<p>Yes. We are London-based and work across the UK.</p>
				</details>
				<details>
					<summary>Do you work on multicultural weddings?</summary>
					<p>Yes. We regularly support celebrations with multiple events, outfit changes and detailed guest flows.</p>
				</details>
				<p class="service-faq__more"><a href="<?php echo esc_url( $home . '/faq/#faq-weddings' ); ?>">More event planning FAQs</a></p>
			</div>
		</div>
	</div>
</section>


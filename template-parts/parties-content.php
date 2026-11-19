<?php
/**
 * Private parties page sections.
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

<section id="page-content" class="section section--inner" aria-labelledby="parties-bespoke-heading">
	<div class="wrap inner-split">
		<figure class="inner-split__media">
			<?php ovents_render_manifest_image( 'content-cupcakes' ); ?>
		</figure>
		<div class="inner-split__copy content-prose">
			<h2 id="parties-bespoke-heading">Bespoke party planning</h2>
			<p>We plan private celebrations in London and across the UK, shaping each event around your guest list, venue and budget. You should enjoy the occasion, not manage suppliers in the middle of it.</p>
			<p>We build a run sheet, brief suppliers and stay on hand on the night so you can host — not troubleshoot. We plan private parties in London and across Essex, Hertfordshire, Surrey, Kent, Sussex and the wider UK.</p>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--tiers" aria-labelledby="parties-tiers-heading">
	<div class="wrap">
		<h2 id="parties-tiers-heading" class="centered">Party planning packages</h2>
		<div class="service-tiers">
			<article class="service-tier">
				<h3>Full party package</h3>
				<p>Best when you want support from day one: vendor sourcing, budget and timeline tracking, invitations and RSVPs, run sheets and on-the-day coordination.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about full planning</a>
			</article>
			<article class="service-tier">
				<h3>Lite planning</h3>
				<p>For hosts who need help with key vendors early on or final details a few months before the party, including itinerary planning and supplier liaison.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about Lite planning</a>
			</article>
			<article class="service-tier">
				<h3>Day coordination package</h3>
				<p>For celebrations you have largely planned yourself: we join around six weeks out, refine logistics with suppliers and coordinate on the night.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about on-the-day coordination</a>
			</article>
		</div>
	</div>
</section>

<?php
ovents_render_testimonial_proof_section( 'parties' );
?>

<section class="section section--inner section--parties-celebrations" aria-labelledby="parties-celebrations-heading">
	<div class="wrap parties-celebrations-wrap">
		<header class="parties-celebrations__header">
			<p class="label-gold">Occasions</p>
			<h2 id="parties-celebrations-heading">Celebrations we plan</h2>
			<p class="parties-celebrations__lead">Private occasions we support across London and the UK, from intimate dinners to milestone parties.</p>
		</header>
		<div class="inner-split parties-celebrations-split inner-split--media-end">
			<figure class="inner-split__media parties-celebrations__media">
				<?php ovents_render_manifest_image( 'content-buffet-service' ); ?>
			</figure>
			<div class="inner-split__copy content-prose parties-celebrations__copy">
			<ul class="celebration-list">
				<li>
					<strong>Birthdays &amp; showers</strong>
					<span>Birthdays, bridal and baby showers with thoughtful timelines and supplier coordination.</span>
				</li>
				<li>
					<strong>Graduate &amp; milestones</strong>
					<span>Graduate balls and milestone celebrations planned with the same calm, organised approach.</span>
				</li>
				<li>
					<strong>Anniversaries</strong>
					<span>Intimate dinners and anniversary gatherings with venue liaison and styling direction.</span>
				</li>
				<li>
					<strong>Larger gatherings</strong>
					<span>Bigger celebrations with hosting support, guest flow and coordination on the night.</span>
				</li>
			</ul>
			</div>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--parties-details section--service-details" aria-labelledby="parties-venue-heading">
	<div class="wrap">
		<header class="service-details__header">
			<h2 id="parties-venue-heading">A celebration that feels like you</h2>
		</header>
		<div class="inner-feature-grid">
			<article><h3>Venue and supplier coordination</h3><p>We coordinate hired venues and private homes, adapting logistics to your space.</p></article>
			<article><h3>Styling and guest experience</h3><p>Theme, catering timing and welcome flow are planned so the event feels intentional from start to finish.</p></article>
			<article><h3>On-the-day direction</h3><p>We manage timing, supplier arrivals and the running order so you can be present with your guests.</p></article>
		</div>
		<div class="parties-process-block" aria-labelledby="parties-process-heading">
			<h2 id="parties-process-heading" class="parties-process-title">Our party planning process</h2>
			<ol class="approach-steps">
				<li><strong>Discover</strong> your occasion, guest list and priorities.</li>
				<li><strong>Plan</strong> suppliers, budget and schedule.</li>
				<li><strong>Coordinate</strong> setup and on-the-day direction.</li>
				<li><strong>Celebrate</strong> with you and your guests.</li>
			</ol>
		</div>
		<?php get_template_part( 'template-parts/service-related-links', null, array( 'exclude' => 'parties' ) ); ?>
	</div>
</section>

<section class="section section--inner section--inner-alt section--service-faq section--parties-faq" aria-labelledby="parties-faq-heading">
	<div class="wrap inner-split inner-split--service-faq">
		<figure class="inner-split__media service-faq__media">
			<?php ovents_render_manifest_image( 'content-balloon-celebration' ); ?>
		</figure>
		<div class="inner-split__copy service-faq__copy">
			<div class="faq">
				<h2 id="parties-faq-heading">Private party FAQs</h2>
				<details>
					<summary>Can you plan parties in private homes?</summary>
					<p>Yes. We adapt logistics to your space, including private homes, restaurants, rooftops and marquee venues.</p>
				</details>
				<details>
					<summary>Do you provide entertainment and catering contacts?</summary>
					<p>We curate trusted DJs, bands, caterers and production partners to match your brief and budget.</p>
				</details>
				<details>
					<summary>Do you offer Lite planning?</summary>
					<p>We can join at any stage, from full planning to on-the-day support.</p>
				</details>
				<details>
					<summary>Can you join mid-planning?</summary>
					<p>Yes. Many clients invite us a few weeks before the event to refine logistics and coordinate on the night.</p>
				</details>
				<p class="service-faq__more"><a href="<?php echo esc_url( $home . '/faq/#faq-parties' ); ?>">More event planning FAQs</a></p>
			</div>
		</div>
	</div>
</section>


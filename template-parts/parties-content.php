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
			<h2 id="parties-bespoke-heading">Wherever you&rsquo;re starting from.</h2>
			<p>We plan private celebrations in London and across the UK, shaped around your guest list, your venue and your budget. You should enjoy the occasion, not manage suppliers in the middle of it.</p>
			<p>We build a run sheet, brief the suppliers and stay on hand on the night, so you can host — not troubleshoot. We plan private parties in London and across Essex, Hertfordshire, Surrey, Kent, Sussex and the wider UK.</p>
			<p>Some celebrations are shared widely; others are held quietly among the people who matter. We plan both with the same care, and the same discretion.</p>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--tiers" aria-labelledby="parties-tiers-heading">
	<div class="wrap">
		<h2 id="parties-tiers-heading" class="centered">How we can help</h2>
		<div class="service-tiers">
			<article class="service-tier">
				<h3>Full party package</h3>
				<p>For when you want support from the first conversation: suppliers, budget and timeline, invitations and RSVPs, run sheets and coordination on the night.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about planning</a>
			</article>
			<article class="service-tier">
				<h3>Lite planning</h3>
				<p>For hosts who need help with key suppliers early on, or with the last details a few months before, including the itinerary and supplier liaison.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about Lite planning</a>
			</article>
			<article class="service-tier">
				<h3>Day coordination package</h3>
				<p>For celebrations you have largely planned yourself: we join around six weeks out, refine the logistics with suppliers, and coordinate on the night.</p>
				<a class="link-explore" href="<?php echo esc_url( $home . '/contact/' ); ?>">Enquire about coordination</a>
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
			<h2 id="parties-celebrations-heading">Celebrations we plan</h2>
			<p class="parties-celebrations__lead">From an intimate dinner to a milestone party, in London and across the UK.</p>
		</header>
		<div class="inner-split parties-celebrations-split inner-split--media-end">
			<figure class="inner-split__media parties-celebrations__media">
				<?php ovents_render_manifest_image( 'content-buffet-service' ); ?>
			</figure>
			<div class="inner-split__copy content-prose parties-celebrations__copy">
			<ul class="celebration-list">
				<li>
					<strong>Birthdays &amp; showers</strong>
					<span>Birthdays, bridal showers and baby showers, with thoughtful timelines and supplier coordination.</span>
				</li>
				<li>
					<strong>Graduate &amp; milestones</strong>
					<span>Graduate balls and milestone celebrations, planned with the same calm, organised approach.</span>
				</li>
				<li>
					<strong>Anniversaries</strong>
					<span>Intimate dinners and anniversary gatherings, with venue liaison and styling direction.</span>
				</li>
				<li>
					<strong>Larger gatherings</strong>
					<span>Larger celebrations, with hosting support, guest flow and coordination on the night.</span>
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
			<article><h3>Venue and supplier coordination</h3><p>Hired venues and private homes, with the logistics adapted to your space.</p></article>
			<article><h3>Styling and guest experience</h3><p>Theme, catering timings and the welcome, planned so the evening feels intentional from the first arrival.</p></article>
			<article><h3>On-the-day direction</h3><p>Timings, supplier arrivals and the running order, so you can be present with your guests.</p></article>
		</div>
		<div class="parties-process-block" aria-labelledby="parties-process-heading">
			<h2 id="parties-process-heading" class="parties-process-title">How we work</h2>
			<ol class="approach-steps">
				<li><strong>Discover</strong> your occasion, your guest list and your priorities.</li>
				<li><strong>Plan</strong> suppliers, budget and schedule.</li>
				<li><strong>Coordinate</strong> the setup, and the night itself.</li>
				<li><strong>Be there</strong> while you celebrate with your guests.</li>
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
				<h2 id="parties-faq-heading">Party planning questions</h2>
				<details>
					<summary>Can you plan parties in private homes?</summary>
					<p>Yes. We adapt the logistics to your space, including private homes, restaurants, rooftops and marquee venues.</p>
				</details>
				<details>
					<summary>Do you provide entertainment and catering contacts?</summary>
					<p>We introduce DJs, bands, caterers and production partners who suit your brief and your budget.</p>
				</details>
				<details>
					<summary>Do you offer Lite planning?</summary>
					<p>Yes. We can join at any stage, from full planning to support on the night.</p>
				</details>
				<details>
					<summary>Can you join mid-planning?</summary>
					<p>Yes. Many clients invite us a few weeks before the event to refine the logistics and coordinate on the night.</p>
				</details>
				<p class="service-faq__more"><a href="<?php echo esc_url( $home . '/faq/#faq-parties' ); ?>">More planning FAQs</a></p>
			</div>
		</div>
	</div>
</section>


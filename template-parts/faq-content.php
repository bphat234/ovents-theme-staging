<?php
/**
 * FAQ page.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
?>
<?php
get_template_part( 'template-parts/inner', 'hero' );
?>

<section id="page-content" class="section section--inner section--inner-alt section--faq-page" aria-labelledby="faq-page-heading">
	<div class="wrap faq-page-layout">
		<aside class="faq-page-intro">
			<h2 id="faq-page-heading">Planning with us</h2>
			<p class="faq-page-description">The essentials: what we plan, how we help, and how to begin.</p>
			<nav class="faq-page-nav" aria-label="<?php esc_attr_e( 'FAQ categories', 'ovents' ); ?>">
				<ul>
					<li><a href="#faq-general">General</a></li>
					<li><a href="#faq-weddings">Weddings</a></li>
					<li><a href="#faq-corporate">Corporate</a></li>
					<li><a href="#faq-parties">Parties</a></li>
					<li><a href="#faq-enquiries">Enquiries</a></li>
				</ul>
			</nav>
			<p class="faq-page-contact">
				<a class="faq-home-link" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation <span aria-hidden="true">&rarr;</span></a>
			</p>
		</aside>

		<div class="faq faq--page faq-page-questions">
			<section id="faq-general" class="faq-page-group" aria-labelledby="faq-general-heading">
				<h3 id="faq-general-heading">General</h3>
				<details>
					<summary>Where is Ovents based?</summary>
					<p>Ovents is based in London, in the United Kingdom. We plan and coordinate events across the UK, from city venues to countryside estates.</p>
				</details>
				<details>
					<summary>Which areas do you cover?</summary>
					<p>We work UK-wide, including London, Essex, Hertfordshire, Surrey, Kent, Sussex, and further afield in England, Scotland, Wales and Northern Ireland.</p>
				</details>
				<details>
					<summary>What types of events do you plan?</summary>
					<p>Weddings, corporate events and private parties, including birthdays, anniversaries, launches and milestone celebrations.</p>
				</details>
				<details>
					<summary>How far in advance should I book?</summary>
					<p>For weddings and large celebrations we recommend 9&ndash;18 months ahead. Parties and corporate events often book 3&ndash;6 months out, though we can accommodate a shorter timeline when availability allows.</p>
				</details>
				<details>
					<summary>What packages do you offer?</summary>
					<p>We offer full planning, Lite planning and on-the-day coordination. Each is shaped around your event and the level of support you need.</p>
				</details>
				<details>
					<summary>How do consultations work?</summary>
					<p>We begin with a free consultation, to understand what you have in mind, your budget and your timeline. From there we outline a proposal and clear next steps.</p>
				</details>
			</section>

			<section id="faq-weddings" class="faq-page-group" aria-labelledby="faq-weddings-heading">
				<h3 id="faq-weddings-heading">Weddings</h3>
				<details>
					<summary>How far in advance should we book a wedding planner?</summary>
					<p>We recommend enquiring 9&ndash;18 months ahead for full planning, though we can accommodate a shorter timeline when availability allows.</p>
				</details>
				<details>
					<summary>Do you plan weddings outside London?</summary>
					<p>Yes. We plan and coordinate weddings across the UK.</p>
				</details>
				<details>
					<summary>What is the difference between wedding planning and coordination?</summary>
					<p>Planning is the work before the day: research, suppliers and decisions. Coordination is the work of delivering that plan on the day. We offer both.</p>
				</details>
				<details>
					<summary>What is included in on-the-day coordination?</summary>
					<p>We manage the supplier schedule, direct the setup, cue the key moments and resolve issues discreetly, so you can stay present with your guests.</p>
				</details>
				<details>
					<summary>Can we book coordination without full planning?</summary>
					<p>Yes. Tell us what you have already booked, and we will outline on-the-day or Lite support.</p>
				</details>
				<details>
					<summary>Can you work with suppliers we have already booked?</summary>
					<p>Yes. We coordinate with the suppliers you have already booked, and we fill gaps where you need extra support.</p>
				</details>
			</section>

			<section id="faq-corporate" class="faq-page-group" aria-labelledby="faq-corporate-heading">
				<h3 id="faq-corporate-heading">Corporate</h3>
				<details>
					<summary>What types of corporate events do you manage?</summary>
					<p>Launches, conferences, awards dinners, client receptions, team celebrations and brand activations.</p>
				</details>
				<details>
					<summary>Can you work with our in-house marketing team?</summary>
					<p>Yes. We work with internal teams, agencies and AV partners, so guests meet one joined-up experience.</p>
				</details>
				<details>
					<summary>Do you offer post-event wrap-up?</summary>
					<p>Yes. We can help with supplier reconciliation and a short feedback summary where you need it.</p>
				</details>
			</section>

			<section id="faq-parties" class="faq-page-group" aria-labelledby="faq-parties-heading">
				<h3 id="faq-parties-heading">Parties</h3>
				<details>
					<summary>Can you plan private parties at hired venues?</summary>
					<p>Yes. We work with private homes, restaurants, rooftops and marquee venues across the UK.</p>
				</details>
				<details>
					<summary>Do you provide entertainment and catering contacts?</summary>
					<p>We introduce DJs, bands, caterers and other trusted suppliers who suit your brief and your budget.</p>
				</details>
				<details>
					<summary>Can you join mid-planning?</summary>
					<p>Yes. Many clients invite us a few weeks before the event to refine the logistics and coordinate on the night.</p>
				</details>
			</section>

			<section id="faq-enquiries" class="faq-page-group" aria-labelledby="faq-enquiries-heading">
				<h3 id="faq-enquiries-heading">Enquiries</h3>
				<details>
					<summary>How do we request a quote?</summary>
					<p>Use the <a href="<?php echo esc_url( $home . '/contact/' ); ?>">contact form</a>, and include your event type, date, location and guest numbers if you know them.</p>
				</details>
				<details>
					<summary>What information should we include in an enquiry?</summary>
					<p>Your event type, preferred date, location, approximate guest numbers, and the level of support you need: full planning, Lite planning, or on-the-day coordination.</p>
				</details>
				<details>
					<summary>How quickly will you respond?</summary>
					<p>We aim to respond within one to two business days. For an urgent timeline, call <a href="tel:+447447462409">+44 7447 462409</a>.</p>
				</details>
				<details>
					<summary>What does a wedding planner cost?</summary>
					<p>Every proposal is itemised after a free consultation. The cost depends on your date, location, guest numbers and the level of planning or coordination you need.</p>
				</details>
			</section>
		</div>
	</div>
</section>
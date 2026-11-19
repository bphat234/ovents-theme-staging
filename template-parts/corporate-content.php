<?php
/**
 * Corporate events page sections (client brief §3–5).
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
$img  = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/img/' . ltrim( $file, '/' ) ) );
};

$checklist_url = ovents_published_post_url( array( 'corporate-event-planning-checklist' ) );
$launch_url    = ovents_published_post_url(
	array( 'plan-product-launch-event-london', 'plan-product-launch-conference-london' )
);

$price_full = ovents_corporate_from_price( 'full' );
$price_lite = ovents_corporate_from_price( 'lite-planning' );
$price_day  = ovents_corporate_from_price( 'day' );
$any_price  = '' !== $price_full || '' !== $price_lite || '' !== $price_day;

get_template_part( 'template-parts/inner', 'hero' );
?>

<section id="page-content" class="section section--inner section--corp-intro" aria-labelledby="corp-planning-heading">
	<div class="wrap inner-split">
		<figure class="inner-split__media">
			<?php ovents_render_manifest_image( 'content-planners-table-session' ); ?>
		</figure>
		<div class="inner-split__copy content-prose">
			<h2 id="corp-planning-heading">Corporate event planning, delivered with care</h2>
			<p>Ovents is a London-based team of event coordinators. For 7 years we've coordinated birthdays, weddings and team building events, where every timing, supplier and guest moment has to be right first time. We now offer full corporate event planning, and bring that same approach to every brief.</p>
			<p>A company event asks for the same skills: a clear plan, a realistic budget, reliable suppliers and someone calm in charge on the day. We take on the organising – timelines, venues, suppliers, guest flow and run sheets – so your team can focus on your guests, your message and your business.</p>
			<p>Whether you need a full planning partner from day one or a hands-on team for the event itself, we'll shape our support around your brief and your budget. Our approach is the same for <a href="<?php echo esc_url( $home . '/weddings/' ); ?>">luxury weddings</a> and <a href="<?php echo esc_url( $home . '/parties/' ); ?>">private parties</a>.</p>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--parties-celebrations section--corporate-types" aria-labelledby="corp-types-heading">
	<div class="wrap parties-celebrations-wrap">
		<header class="parties-celebrations__header">
			<h2 id="corp-types-heading">Corporate events we plan</h2>
			<p class="parties-celebrations__lead">We plan events for companies, teams and organisations of different sizes, in London and across the UK.</p>
		</header>
		<div class="inner-split parties-celebrations-split inner-split--media-end">
			<figure class="inner-split__media parties-celebrations__media">
				<?php ovents_render_manifest_image( 'content-planners-table-hosts' ); ?>
			</figure>
			<div class="inner-split__copy content-prose parties-celebrations__copy">
				<div class="faq corporate-event-types-accordion" role="group" aria-label="<?php esc_attr_e( 'Corporate event types', 'ovents' ); ?>">
					<details>
						<summary>Conferences, seminars and networking events</summary>
						<p>Clear schedules, speaker and session timings, registration, breaks and supplier coordination, so the day runs to time.</p>
					</details>
					<details>
						<summary>Product launches and brand activations</summary>
						<p>Timelines that keep venue, AV, content and guests aligned, so your launch moment lands as planned.<?php if ( $launch_url ) : ?> See our guide on <a href="<?php echo esc_url( $launch_url ); ?>">how to plan a product launch in London</a>.<?php endif; ?></p>
					</details>
					<details>
						<summary>Galas and awards dinners</summary>
						<p>Gala dinners and awards evenings with seating plans, running orders, supplier coordination and hosting support, planned so the evening flows from arrival to final toast. As gala dinner planners, we keep every moving part on schedule.</p>
					</details>
					<details>
						<summary>Christmas parties and staff celebrations</summary>
						<p>Corporate Christmas parties and team celebrations, planned with the same attention we give a private celebration. As corporate party planners in London, we handle the venue, suppliers and timings so your team simply enjoys the night.</p>
					</details>
					<details>
						<summary>Client receptions and hospitality</summary>
						<p>Considered receptions for clients and partners, where first impressions and smooth hosting matter.</p>
					</details>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--inner section--parties-details section--corporate-details" aria-labelledby="corp-includes-heading">
	<div class="wrap">
		<h2 id="corp-includes-heading">What's included</h2>
		<div class="value-grid corporate-value-grid">
			<article class="value-card">
				<h3>Planning, budget and timeline</h3>
				<p>We build your event timeline with milestones and reminders, set up a budget tracker and keep everyone to it. You'll always know what's agreed, what's next and what it costs.</p>
			</article>
			<article class="value-card">
				<h3>Venue and supplier coordination</h3>
				<p>We source venues and vendors to suit your brief, or work with the suppliers you already use. We liaise with every supplier before the day so outstanding questions are settled early, and we work alongside your in-house marketing team, agencies and AV partners. That's our role in professional event management: coordinating the people who deliver your event, so you have one point of contact.</p>
			</article>
			<article class="value-card">
				<h3>Guest experience and on-the-day delivery</h3>
				<p>Invitations and RSVPs, itinerary and seating plans, arrival and registration flow, and a dedicated team on the day to keep everything on track. After the event we can help with supplier reconciliation and a short feedback summary.<?php if ( $checklist_url ) : ?> See <a href="<?php echo esc_url( $checklist_url ); ?>">our corporate event planning checklist</a>.<?php endif; ?></p>
			</article>
		</div>
		<div class="corporate-inline-cta">
			<p class="corporate-inline-cta__lead">Not sure which package?</p>
			<a class="btn btn-primary" href="<?php echo esc_url( ovents_corporate_contact_url() ); ?>">Book a free discovery call</a>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--tiers section--corporate-tiers" aria-labelledby="corp-tiers-heading">
	<div class="wrap">
		<h2 id="corp-tiers-heading" class="centered">Choose your level of support</h2>
		<div class="value-grid corporate-value-grid">
			<article class="value-card">
				<h3>Full package</h3>
				<?php if ( '' !== $price_full ) : ?>
					<p class="value-card__from">From <?php echo esc_html( $price_full ); ?></p>
				<?php endif; ?>
				<p>For organisations that want full planning from day one. We get involved early to find the best options and vendors for your event, then manage vendor sourcing, timeline and budget tracking, invitations and RSVPs, the itinerary and seating plan, supplier liaison and on-the-day coordination, with unlimited communication by email and phone.</p>
				<a class="link-explore" href="<?php echo esc_url( ovents_corporate_contact_url( 'full' ) ); ?>">Book a free discovery call</a>
			</article>
			<article class="value-card">
				<h3>Lite planning package</h3>
				<?php if ( '' !== $price_lite ) : ?>
					<p class="value-card__from">From <?php echo esc_html( $price_lite ); ?></p>
				<?php endif; ?>
				<p>For organisations that need help finding key vendors early on, or with the final touches a couple of months before. It includes an initial consultation, a timeline with milestones, budget planning, regular communication, an itinerary for the day, supplier liaison two weeks before, and on-the-day coordination.</p>
				<a class="link-explore" href="<?php echo esc_url( ovents_corporate_contact_url( 'lite-planning' ) ); ?>">Book a free discovery call</a>
			</article>
			<article class="value-card">
				<h3>Day coordination package</h3>
				<?php if ( '' !== $price_day ) : ?>
					<p class="value-card__from">From <?php echo esc_html( $price_day ); ?></p>
				<?php endif; ?>
				<p>For organisations that have planned their own event and want a dedicated, hands-on team on the day. We start with a consultation six weeks before, prepare the itinerary, settle outstanding supplier queries two weeks out, and coordinate the day so it runs smoothly.</p>
				<a class="link-explore" href="<?php echo esc_url( ovents_corporate_contact_url( 'day' ) ); ?>">Book a free discovery call</a>
			</article>
		</div>
		<div class="content-prose corporate-tiers__note">
			<p>
				<?php if ( $any_price ) : ?>
					<?php esc_html_e( 'Prices shown are starting points.', 'ovents' ); ?>
				<?php endif; ?>
				<?php esc_html_e( 'Every event receives a tailored quote, based on the package, the size of your event and how early we\'re involved.', 'ovents' ); ?>
				<a href="<?php echo esc_url( ovents_corporate_contact_url() ); ?>"><?php esc_html_e( 'Book a free discovery call', 'ovents' ); ?></a>
				<?php esc_html_e( 'and we\'ll talk it through.', 'ovents' ); ?>
			</p>
		</div>
	</div>
</section>

<section class="section section--inner section--corporate-process" aria-labelledby="corp-process-heading">
	<div class="wrap content-prose">
		<h2 id="corp-process-heading">How we work</h2>
		<ol class="approach-steps">
			<li><strong>Free discovery call</strong> – We learn your objectives, audience, date, location and budget. Book online, by WhatsApp or by phone; we'll reply within one to two business days.</li>
			<li><strong>Tailored proposal and quote</strong> – We recommend the right level of support and send a proposal and quote tailored to your event.</li>
			<li><strong>Planning</strong> – Timeline, budget, venue and supplier coordination, with clear responsibilities on both sides and final checks in the weeks before.</li>
			<li><strong>Delivery</strong> – Our team runs the day so you can host, followed by a short debrief and supplier wrap-up.</li>
		</ol>
		<p><a href="<?php echo esc_url( ovents_corporate_contact_url() ); ?>">Book a free discovery call</a></p>
	</div>
</section>

<section class="section section--inner section--inner-alt section--corporate-why" aria-labelledby="corp-why-heading">
	<div class="wrap inner-split">
		<figure class="inner-split__media">
			<?php ovents_render_manifest_image( 'card-service-corporate' ); ?>
		</figure>
		<div class="inner-split__copy content-prose">
			<h2 id="corp-why-heading">Why choose Ovents as your professional event planners</h2>
			<ul class="corporate-why-list">
				<li><strong>7 years of event coordination.</strong> We're a team of event coordinators who have spent 7 years coordinating birthdays, weddings and team building events – and we now offer full corporate event planning.</li>
				<li><strong>Experience where details matter.</strong> Weddings and private parties leave no room for a second attempt. That discipline – timings, suppliers, guest care – is what we bring to your corporate event.</li>
				<li><strong>Calm, dependable communication.</strong> We pride ourselves on being dependable, excellent communicators. You'll get clear replies by email, phone or WhatsApp, within one to two business days.</li>
				<li><strong>Budget-conscious planning.</strong> We help clients stay within budget, with a tracker you can see.</li>
				<li><strong>One point of contact.</strong> From the first call to the final supplier invoice, you deal with one team.</li>
			</ul>
			<p><a href="<?php echo esc_url( $home . '/about/' ); ?>">Meet the Ovents team</a></p>
		</div>
	</div>
</section>

<section class="section section--inner section--corporate-recent-event" aria-labelledby="corp-recent-event-heading">
	<div class="wrap corporate-recent-event-wrap">
		<header class="corporate-recent-event__header">
			<p class="label-gold"><?php esc_html_e( 'Recent event', 'ovents' ); ?></p>
			<h2 id="corp-recent-event-heading" class="inner-section-title"><?php esc_html_e( "The Planner's Table", 'ovents' ); ?></h2>
		</header>
		<div class="content-prose corporate-recent-event__copy">
			<p>In April 2026, Ovents organised The Planner's Table – a lunch and learn experience for wedding and event suppliers.</p>
			<p>Vendors joined us for a seated lunch, an industry session and time to connect. We planned timelines, liaised with suppliers on the day and kept the schedule moving – the same organisation and on-the-day delivery we bring to client celebrations.</p>
		</div>
		<div class="planners-table-grid" aria-label="<?php esc_attr_e( 'Photographs from The Planner’s Table', 'ovents' ); ?>">
			<?php
			foreach (
				array(
					'content-planners-table-session',
					'content-planners-table-hosts',
					'content-planners-table-speaker',
					'content-planners-table-signage',
					'content-planners-table-canapes',
					'portfolio-planners-table-2026',
				) as $manifest_name
			) {
				ovents_render_manifest_image( $manifest_name );
			}
			?>
		</div>
		<p class="corporate-recent-event__caption"><?php esc_html_e( 'The Planner’s Table, organised by Ovents, April 2026', 'ovents' ); ?></p>
		<p class="corporate-recent-event__credit"><?php esc_html_e( 'Photographs: Sure Moments HQ', 'ovents' ); ?></p>
		<p class="corporate-recent-event__link">
			<a href="https://www.instagram.com/p/DXHz-FHjgTc/" rel="noopener noreferrer" target="_blank"><?php esc_html_e( 'See the event on Instagram', 'ovents' ); ?></a>
		</p>
	</div>
</section>

<section class="section section--inner section--corporate-reviews" aria-labelledby="corp-reviews-heading">
	<div class="wrap corporate-reviews-wrap">
		<header class="corporate-reviews__header">
			<p class="label-gold"><?php esc_html_e( 'Google reviews', 'ovents' ); ?></p>
			<h2 id="corp-reviews-heading" class="inner-section-title">From our wedding and party clients</h2>
			<p class="corporate-reviews__lead">Our corporate service is built on the same organisation and on-the-day delivery our wedding and party clients describe.</p>
		</header>
		<div class="corporate-reviews-quotes">
			<figure class="testimonial testimonial--google testimonial--corporate-quote">
				<?php ovents_render_star_rating( 5 ); ?>
				<blockquote class="testimonial__quote">
					<?php echo esc_html( 'The team will spare no effort in delivering your wishes, and the attention to detail is great. Ovents is the first team I recommend whenever events are being planned.' ); ?>
				</blockquote>
				<figcaption>
					<cite>
						<strong><?php echo esc_html( 'Francis D.' ); ?></strong>
						<span class="testimonial__meta"><?php esc_html_e( 'party client', 'ovents' ); ?> · <?php esc_html_e( 'Google review', 'ovents' ); ?></span>
					</cite>
				</figcaption>
			</figure>
			<figure class="testimonial testimonial--google testimonial--corporate-quote">
				<?php ovents_render_star_rating( 5 ); ?>
				<blockquote class="testimonial__quote">
					<?php echo esc_html( 'We got there on time and everything was well managed.' ); ?>
				</blockquote>
				<figcaption>
					<cite>
						<strong><?php echo esc_html( 'Amanda L.' ); ?></strong>
						<span class="testimonial__meta"><?php esc_html_e( 'wedding client', 'ovents' ); ?> · <?php esc_html_e( 'Google review', 'ovents' ); ?></span>
					</cite>
				</figcaption>
			</figure>
		</div>
		<div class="corporate-reviews__cta">
			<?php ovents_render_google_review_cta(); ?>
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--corporate-coverage" aria-labelledby="corp-coverage-heading">
	<div class="wrap territory-split corporate-coverage-split">
		<div class="territory-split__copy corporate-coverage__copy">
			<h2 id="corp-coverage-heading">Based in London, planning across the UK</h2>
			<p>We're based in London and plan events across the UK, including Essex, Surrey, Hertfordshire, Kent and Sussex. From city venues to countryside estates, we'll coordinate suppliers, travel and timings wherever your event is held.</p>
			<p>If you're looking for an event management company in London that can also travel with you, let's talk.</p>
			<div class="corporate-coverage__foot">
				<ul class="corporate-coverage__regions" aria-label="<?php esc_attr_e( 'Areas we often plan in', 'ovents' ); ?>">
					<li>London</li>
					<li>Essex</li>
					<li>Surrey</li>
					<li>Hertfordshire</li>
					<li>Kent</li>
					<li>Sussex</li>
				</ul>
				<div class="corporate-coverage__cta">
					<a class="btn btn-primary" href="<?php echo esc_url( ovents_corporate_contact_url() ); ?>"><?php esc_html_e( 'Book a free discovery call', 'ovents' ); ?></a>
				</div>
			</div>
		</div>
		<div class="territory-split__map corporate-coverage__map">
			<img src="<?php echo $img( 'uk-map.svg' ); ?>?v=<?php echo esc_attr( OVENTS_VERSION ); ?>" width="560" height="560" loading="lazy" alt="<?php esc_attr_e( 'Illustrative map: Ovents based in London, planning corporate events across the United Kingdom.', 'ovents' ); ?>">
		</div>
	</div>
</section>

<section class="section section--inner section--inner-alt section--service-faq section--corporate-faq" aria-labelledby="corp-faq-heading">
	<div class="wrap inner-split inner-split--service-faq">
		<figure class="inner-split__media service-faq__media">
			<?php ovents_render_manifest_image( 'content-planners-table-speaker' ); ?>
		</figure>
		<div class="inner-split__copy service-faq__copy">
			<div class="faq">
				<h2 id="corp-faq-heading">Corporate event planning FAQs</h2>
				<details>
					<summary>What types of corporate events do you plan?</summary>
					<p>Conferences, seminars and networking events, product launches and brand activations, galas and awards dinners, corporate Christmas parties and staff celebrations, and client receptions.</p>
				</details>
				<details>
					<summary>Does your team have corporate event experience?</summary>
					<p>Yes – our team has coordinated team building events, alongside 7 years of coordinating weddings and birthdays. We now offer full corporate event planning, and bring the same process, supplier coordination and attention to detail to every corporate brief.</p>
				</details>
				<details>
					<summary>Can you work with our in-house team or agency?</summary>
					<p>Yes. We collaborate with internal stakeholders, agencies and AV partners and follow your brand guidelines, so guests get one joined-up experience.</p>
				</details>
				<details>
					<summary>Which areas do you cover?</summary>
					<p>We're based in London and plan events across the UK, including Essex, Surrey, Hertfordshire, Kent and Sussex.</p>
				</details>
				<details>
					<summary>How much does a corporate event planner cost?</summary>
					<p>
						<?php if ( $any_price ) : ?>
							Our packages start from <?php echo esc_html( $price_full ); ?> (Full), <?php echo esc_html( $price_lite ); ?> (Lite planning) and <?php echo esc_html( $price_day ); ?> (Day coordination).
						<?php endif; ?>
						Every event receives a tailored quote, based on the package, the size of your event and how early we're involved. <a href="<?php echo esc_url( ovents_corporate_contact_url() ); ?>">Book a free discovery call</a> and we'll talk it through.
					</p>
				</details>
				<details>
					<summary>Do you offer a post-event wrap-up?</summary>
					<p>Yes. We provide supplier reconciliation support and a feedback summary where required.</p>
				</details>
				<p class="service-faq__more"><a href="<?php echo esc_url( $home . '/faq/#faq-corporate' ); ?>">More event planning FAQs</a></p>
			</div>
		</div>
	</div>
</section>

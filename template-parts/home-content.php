<?php
/**
 * Homepage sections — Wix scroll order; SEO blocks kept where they convert.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
$img  = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/img/' . ltrim( $file, '/' ) ) );
};
$insta_url   = ovents_instagram_profile_url();
$service_img = ovents_home_service_images();
$home_h1     = function_exists( 'ovents_page_h1' ) ? ovents_page_h1() : 'Wedding & Event Planning in London and Across the UK';
?>
<section class="hero" aria-label="Event planning">
	<div class="hero-media" aria-hidden="true">
		<?php ovents_render_home_hero_picture(); ?>
	</div>
	<div class="hero-overlay" aria-hidden="true"></div>
	<div class="hero-inner">
		<div class="hero-inner__head">
			<h1 class="hero-title hero-title--primary"><?php echo esc_html( $home_h1 ); ?></h1>
		</div>
		<div class="hero-inner__foot">
			<p class="lead">From intimate weddings to corporate occasions and private celebrations, Ovents brings creativity, organisation and attention to detail to events across the UK.</p>
			<div class="hero-ctas">
				<a class="btn btn-light" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation</a>
				<a class="btn btn-ghost" href="#services">Explore our services</a>
			</div>
		</div>
	</div>
</section>

<section class="section section--intro" id="intro" aria-labelledby="intro-heading">
	<div class="wrap intro-copy">
		<h2 id="intro-heading">
			<span class="intro-heading__line">Your vision,</span>
			<span class="intro-heading__line">orchestrated with care</span>
		</h2>
		<p>Ovents LTD is a London-based event planner specialising in weddings, private parties and corporate occasions across the UK.</p>
		<p>From concept and supplier curation to flawless on-the-day coordination, we combine creative direction with meticulous production so you can be fully present for the moments that matter.</p>
		<p class="intro-process">We <strong>discover</strong> your priorities, <strong>plan</strong> schedules and suppliers, <strong>coordinate</strong> logistics on the day, and <strong>celebrate</strong> with you while we manage the running order.</p>
	</div>
</section>

<section class="services-grid" id="services" aria-label="Our services">
	<article class="service-strip" aria-labelledby="weddings-heading">
		<?php ovents_render_manifest_image( $service_img['weddings'], array( 'img_class' => 'service-strip__media' ) ); ?>
		<div class="service-strip__scrim" aria-hidden="true"></div>
		<div class="service-strip__overlay">
			<div class="service-strip__copy">
				<div class="service-strip__foot">
					<h2 id="weddings-heading">Weddings</h2>
					<p>Bespoke design and coordination tailored to your vision.</p>
					<a class="link-explore" href="<?php echo esc_url( $home . '/weddings/' ); ?>">Explore</a>
				</div>
			</div>
		</div>
	</article>

	<article class="service-strip" aria-labelledby="corporate-heading">
		<?php ovents_render_manifest_image( $service_img['corporate'], array( 'img_class' => 'service-strip__media' ) ); ?>
		<div class="service-strip__scrim" aria-hidden="true"></div>
		<div class="service-strip__overlay">
			<div class="service-strip__copy">
				<div class="service-strip__foot">
					<h2 id="corporate-heading">Corporate</h2>
					<p>High-impact events delivered with precision and premium production.</p>
					<a class="link-explore" href="<?php echo esc_url( $home . '/corporate-events/' ); ?>">Explore</a>
				</div>
			</div>
		</div>
	</article>

	<article class="service-strip" aria-labelledby="parties-heading">
		<?php ovents_render_manifest_image( $service_img['parties'], array( 'img_class' => 'service-strip__media' ) ); ?>
		<div class="service-strip__scrim" aria-hidden="true"></div>
		<div class="service-strip__overlay">
			<div class="service-strip__copy">
				<div class="service-strip__foot">
					<h2 id="parties-heading">Parties</h2>
					<p>Stylish private celebrations planned with seamless coordination.</p>
					<a class="link-explore" href="<?php echo esc_url( $home . '/parties/' ); ?>">Explore</a>
				</div>
			</div>
		</div>
	</article>
</section>

<section class="section section--ovents-way" aria-labelledby="ovents-way-heading">
	<div class="wrap ovents-way-split">
		<figure class="ovents-way__media">
			<?php ovents_render_manifest_image( 'content-tablescape-herbs' ); ?>
		</figure>
		<div class="ovents-way__copy">
			<h2 id="ovents-way-heading">
				<span class="ovents-way__title-line">Bespoke excellence in</span>
				<span class="ovents-way__title-line">every detail</span>
			</h2>
			<p>Based in London, we specialise in high-end event planning and coordination for weddings, private parties and corporate events.</p>
			<p>We focus on schedules, suppliers and guest experience so you can be present for the moments that matter.</p>
			<p class="label-gold ovents-way__why-label" id="why-heading">Why Ovents</p>
			<ul class="check-list">
				<li>Planning shaped around your brief, with clear communication throughout</li>
				<li>Supplier coordination, timelines and run sheets managed with care</li>
				<li>Calm, professional delivery on the day when timings shift</li>
			</ul>
			<p class="ovents-way__cta">
				<a class="btn btn-primary" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation</a>
			</p>
		</div>
	</div>
</section>

<section class="section section--testimonials" id="testimonials" aria-labelledby="testimonials-heading">
	<div class="wrap testimonial-section">
		<h2 id="testimonials-heading">Trusted by couples, families and brands</h2>
		<p class="sub">A selection of reflections from weddings, celebrations and corporate events we have had the honour to deliver.</p>
		<div class="testimonial-carousel" data-testimonial-carousel>
			<div class="testimonial-carousel__controls">
				<button type="button" class="testimonial-carousel__arrow testimonial-carousel__arrow--prev" data-carousel-prev aria-label="<?php esc_attr_e( 'Previous testimonial', 'ovents' ); ?>">
					<?php echo ovents_icon( 'chevron-left', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
				<div class="testimonial-carousel__frame">
					<div class="testimonial-carousel__viewport" data-carousel-viewport tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Client testimonials. Use arrow keys to browse.', 'ovents' ); ?>">
						<div class="testimonial-carousel__track" data-carousel-track>
							<?php
							foreach ( ovents_google_testimonials_for( 'home' ) as $review ) {
								ovents_render_testimonial_card( $review, array( 'mode' => 'carousel' ) );
							}
							?>
						</div>
					</div>
				</div>
				<button type="button" class="testimonial-carousel__arrow testimonial-carousel__arrow--next" data-carousel-next aria-label="<?php esc_attr_e( 'Next testimonial', 'ovents' ); ?>">
					<?php echo ovents_icon( 'chevron-right', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
			</div>
		</div>
		<?php ovents_render_google_review_cta(); ?>
	</div>
</section>

<section class="section section--portfolio-insta section--studio" id="studio" aria-labelledby="studio-heading">
	<div class="wrap">
		<h2 id="studio-heading" class="centered">Moments from our studio</h2>
		<p class="sub centered">Follow our latest weddings, parties and corporate productions on Instagram.</p>
		<p class="insta-handle centered"><a href="<?php echo esc_url( $insta_url ); ?>" rel="noopener noreferrer" target="_blank"><?php echo esc_html( ovents_instagram_handle() ); ?></a></p>
		<?php ovents_render_instagram_grid( array( 'visible' => 6, 'show_actions' => true ) ); ?>
	</div>
</section>

<section class="territory-panel territory-panel--split" aria-labelledby="territory-heading">
	<div class="wrap territory-split">
		<div class="territory-split__copy">
			<h2 id="territory-heading">Event planner based in London, serving the UK</h2>
			<p>Rooted in London, we plan and coordinate weddings, private parties and corporate events across the UK with one consistent standard of poise and precision.</p>
			<p class="territory-tag">Based in London &middot; UK-wide</p>
		</div>
		<div class="territory-split__map">
			<img src="<?php echo $img( 'uk-map.svg' ) . '?v=' . OVENTS_VERSION; ?>" width="560" height="560" alt="Illustrative map connecting our London base with cities across England, Scotland, Wales and Northern Ireland.">
		</div>
	</div>
</section>

<section class="section section--narrow section--faq-home" aria-labelledby="home-faq-heading">
	<div class="wrap faq-home-layout">
		<div class="faq-home-intro">
			<h2 id="home-faq-heading">Common questions</h2>
			<p class="faq-home-description">From where we work to how we begin, a few helpful details for planning your event.</p>
			<a class="faq-home-link" href="<?php echo esc_url( $home . '/faq/' ); ?>">Explore all FAQs <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="faq faq-home-questions">
		<details>
			<summary>Where is Ovents based?</summary>
			<p>We are based in London and plan events across the UK.</p>
		</details>
		<details>
			<summary>How do we enquire?</summary>
			<p>Use our <a href="<?php echo esc_url( $home . '/contact/' ); ?>">contact form</a> with your date, location and event type.</p>
		</details>
		<details>
			<summary>Do you plan weddings and corporate events?</summary>
			<p>Yes. We offer wedding planning and coordination, corporate events and private parties. See our <a href="#services">services</a> or contact us to discuss your event.</p>
		</details>
		</div>
	</div>
</section>


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
			<p class="lead">Celebrations that feel effortless, because every detail has already been taken care of.</p>
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
			<span class="intro-heading__line">Every event starts</span>
			<span class="intro-heading__line">differently.</span>
		</h2>
		<p>Some begin with a date, some with a venue, some with just an idea.</p>
		<p>Wherever you’re starting from, we’ll take it from there.</p>
		<p class="intro-process">We plan luxury weddings, corporate events and private parties from London, across the UK.</p>
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
					<p>A day that feels like you, held with calm and care.</p>
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
					<p>Discreet, polished events that reflect your brand.</p>
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
					<p>Celebrations for the people you love, planned so you can enjoy them.</p>
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
				<span class="ovents-way__title-line">Behind a</span>
				<span class="ovents-way__title-line">seamless day.</span>
			</h2>
			<p>Behind every calm, beautiful day is careful planning you never have to see.</p>
			<ul class="ovents-way-pillars" id="why-heading" aria-label="<?php esc_attr_e( 'How we plan', 'ovents' ); ?>">
				<li class="ovents-way-pillars__item">
					<h3 class="ovents-way-pillars__name">Planning</h3>
					<p class="ovents-way-pillars__promise">The groundwork behind a seamless day.</p>
					<p class="ovents-way-pillars__tags">Suppliers · Budgets · Timelines</p>
				</li>
				<li class="ovents-way-pillars__item">
					<h3 class="ovents-way-pillars__name">Design &amp; styling</h3>
					<p class="ovents-way-pillars__promise">Your vision, brought to life.</p>
					<p class="ovents-way-pillars__tags">Florals · Tablescapes · Décor</p>
				</li>
				<li class="ovents-way-pillars__item">
					<h3 class="ovents-way-pillars__name">On-the-day coordination</h3>
					<p class="ovents-way-pillars__promise">So you can be present.</p>
					<p class="ovents-way-pillars__tags">Run sheets · Suppliers · Guest flow</p>
				</li>
			</ul>
			<p class="ovents-way__cta">
				<a class="btn btn-primary" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation</a>
			</p>
		</div>
	</div>
</section>

<section class="section section--testimonials" id="testimonials" aria-labelledby="testimonials-heading">
	<div class="wrap testimonial-section">
		<h2 id="testimonials-heading">In their words</h2>
		<p class="sub">A few words from people we have planned with.</p>
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

<?php get_template_part( 'template-parts/portfolio/home', 'section' ); ?>

<section class="territory-panel territory-panel--split" aria-labelledby="territory-heading">
	<div class="wrap territory-split">
		<div class="territory-split__copy">
			<h2 id="territory-heading">An event planner in London, working across the UK</h2>
			<p>From London, we plan weddings, corporate events and private parties across the UK — the same calm standard, wherever the day is held.</p>
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
			<h2 id="home-faq-heading">A few questions, answered</h2>
			<p class="faq-home-description">Where we work, how we begin, and what we plan.</p>
			<a class="faq-home-link" href="<?php echo esc_url( $home . '/faq/' ); ?>">See all FAQs <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="faq faq-home-questions">
		<details>
			<summary>Where is Ovents based?</summary>
			<p>We’re based in London, and we plan events across the UK.</p>
		</details>
		<details>
			<summary>How do we enquire?</summary>
			<p>Use our <a href="<?php echo esc_url( $home . '/contact/' ); ?>">contact form</a>, and tell us your date, location and event type if you have them.</p>
		</details>
		<details>
			<summary>Do you plan weddings and corporate events?</summary>
			<p>Yes. We plan weddings, corporate events and private parties. Look at our <a href="#services">services</a>, or get in touch and tell us about your day.</p>
		</details>
		</div>
	</div>
</section>


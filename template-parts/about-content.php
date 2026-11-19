<?php
/**
 * About page — Wix-style sections.
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

<section id="page-content" class="section section--inner section--founder" aria-labelledby="founder-heading">
	<div class="wrap founder-split">
		<figure class="founder-split__media">
			<picture>
				<source
					type="image/webp"
					srcset="<?php echo $img( 'founder-portrait-480.webp' ); ?> 480w, <?php echo $img( 'founder-portrait-800.webp' ); ?> 800w, <?php echo $img( 'founder-portrait-1200.webp' ); ?> 1200w"
					sizes="(max-width: 720px) 92vw, min(22rem, 42vw)"
				>
				<img
					class="founder-portrait"
					src="<?php echo $img( 'founder-portrait-800.jpg' ); ?>"
					srcset="<?php echo $img( 'founder-portrait-480.jpg' ); ?> 480w, <?php echo $img( 'founder-portrait-800.jpg' ); ?> 800w, <?php echo $img( 'founder-portrait-1200.jpg' ); ?> 1200w"
					sizes="(max-width: 720px) 92vw, min(22rem, 42vw)"
					width="800"
					height="1200"
					alt="<?php echo esc_attr__( 'Titilope Fagbore, founder of Ovents', 'ovents' ); ?>"
					loading="lazy"
					decoding="async"
				>
			</picture>
		</figure>
		<div class="founder-split__copy content-prose">
			<h2 id="founder-heading"><?php esc_html_e( 'Meet Titilope Fagbore, Founder of Ovents', 'ovents' ); ?></h2>
			<p>
				<?php esc_html_e( 'Titilope founded Ovents with a simple belief: every celebration deserves to feel effortless for the people at its heart.', 'ovents' ); ?>
				<span class="founder-gap"><?php esc_html_e( '[How and when she started Ovents.]', 'ovents' ); ?></span>
			</p>
			<p><?php esc_html_e( 'Based in London and planning events across the UK, Titilope and her team design and deliver luxury weddings, corporate events and private parties. From the first conversation to the last guest leaving, she looks after every detail so her clients can be present and enjoy the moment.', 'ovents' ); ?></p>
			<p>
				<?php esc_html_e( 'Her approach is personal and hands-on.', 'ovents' ); ?>
				<span class="founder-gap"><?php esc_html_e( '[One or two lines on her style.]', 'ovents' ); ?></span>
			</p>
			<p><?php esc_html_e( 'Beyond client events, Titilope is investing in the wider events community. In April 2026, Ovents organised The Planner’s Table, a lunch and learn bringing together event professionals, wedding planners, coordinators and creatives for honest conversations and practical sessions.', 'ovents' ); ?></p>
			<p class="founder-gap"><?php esc_html_e( '[Optional quote in her own words.]', 'ovents' ); ?></p>
		</div>
	</div>
</section>

<section class="section section--inner section--values" aria-labelledby="about-values-heading">
	<div class="wrap values-wrap">
		<header class="values-header">
			<p class="label-gold">What guides us</p>
			<h2 id="about-values-heading" class="inner-section-title">Our values</h2>
		</header>
		<div class="value-grid">
			<article class="value-card">
				<h3>Dependability</h3>
				<p>Timelines, suppliers and guest experience managed with calm, professional delivery — including when plans shift on the day.</p>
			</article>
			<article class="value-card">
				<h3>Customer commitment</h3>
				<p>Our focus is you. We listen to what matters to you and shape our planning around your priorities, with clear communication throughout.</p>
			</article>
			<article class="value-card">
				<h3>Transparent proposals</h3>
				<p>Transparent, itemised proposals after a free consultation, so you know exactly what is included before you commit.</p>
			</article>
		</div>
		<?php if ( function_exists( 'ovents_google_testimonials_for_about_page' ) ) : ?>
		<div class="about-reviews-block">
			<p class="label-gold"><?php esc_html_e( 'Kind words', 'ovents' ); ?></p>
			<?php
			ovents_render_testimonial_bare_carousel( ovents_google_testimonials_for_about_page() );
			?>
			<div class="about-reviews-block__cta">
				<?php ovents_render_google_review_cta(); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<section class="section section--promise" aria-labelledby="promise-heading">
	<div class="wrap promise-split">
		<figure class="promise-split__media">
			<?php ovents_render_manifest_image( 'content-blossom-backdrop' ); ?>
		</figure>
		<div class="promise-split__copy">
			<h2 id="promise-heading" class="label-gold promise-heading">Our promise</h2>
			<p>At Ovents, we aim to provide a professional, quality service that surpasses your expectations.</p>
			<p>We use your feedback to improve our service and explain the scope of our support clearly at every stage.</p>
			<p class="promise-split__cta">
				<a class="link-cta" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation</a>
			</p>
		</div>
	</div>
</section>
<?php
/**
 * About page — Wix-style sections.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
?>
<?php
get_template_part( 'template-parts/inner', 'hero' );
?>

<section id="page-content" class="section section--inner" aria-labelledby="about-this-heading">
	<div class="wrap content-prose about-intro-copy">
		<h2 id="about-this-heading">This is us</h2>
		<p>We are a London-based team providing wedding, corporate and private event planning and coordination. Every service is tailored to your brief, with clear communication from enquiry to delivery.</p>
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
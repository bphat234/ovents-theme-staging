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
			<h2 id="founder-heading"><?php esc_html_e( 'Titilope Fagbore, founder of Ovents', 'ovents' ); ?></h2>
			<p>
				<?php esc_html_e( 'Titilope founded Ovents with a simple belief: every celebration deserves to feel effortless for the people at its heart.', 'ovents' ); ?>
				<?php
				$founder_gap_1 = '[How and when she started Ovents.]';
				if ( function_exists( 'ovents_portfolio_intro_is_placeholder' ) && ! ovents_portfolio_intro_is_placeholder( $founder_gap_1 ) ) :
					?>
					<span class="founder-gap"><?php echo esc_html( $founder_gap_1 ); ?></span>
				<?php endif; ?>
			</p>
			<p><?php esc_html_e( 'Based in London and planning events across the UK, she and her team design and deliver luxury weddings, corporate events and private parties. From the first conversation to the last guest leaving, she looks after every detail, so her clients can simply be present.', 'ovents' ); ?></p>
			<p>
				<?php esc_html_e( 'Her approach is personal and hands-on.', 'ovents' ); ?>
				<?php
				$founder_gap_2 = '[One or two lines on her style.]';
				if ( function_exists( 'ovents_portfolio_intro_is_placeholder' ) && ! ovents_portfolio_intro_is_placeholder( $founder_gap_2 ) ) :
					?>
					<span class="founder-gap"><?php echo esc_html( $founder_gap_2 ); ?></span>
				<?php endif; ?>
			</p>
			<p><?php esc_html_e( 'Beyond client events, Titilope is investing in the wider events community. In April 2026, Ovents organised The Planner’s Table, a lunch and learn for event professionals, wedding planners, coordinators and creatives, for honest conversations and practical sessions.', 'ovents' ); ?></p>
			<?php
			$founder_gap_3 = '[Optional quote in her own words.]';
			if ( function_exists( 'ovents_portfolio_intro_is_placeholder' ) && ! ovents_portfolio_intro_is_placeholder( $founder_gap_3 ) ) :
				?>
				<p class="founder-gap"><?php echo esc_html( $founder_gap_3 ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( function_exists( 'ovents_founder_at_work_items' ) && function_exists( 'ovents_portfolio_render_image' ) ) : ?>
<section class="section section--inner section--founder-at-work" aria-labelledby="founder-at-work-heading">
	<div class="wrap founder-at-work">
		<h2 id="founder-at-work-heading" class="founder-at-work__title inner-section-title"><?php esc_html_e( 'Behind the scenes', 'ovents' ); ?></h2>
		<div class="founder-at-work__grid">
			<?php foreach ( ovents_founder_at_work_items() as $item ) : ?>
				<figure class="founder-at-work__frame">
					<?php
					ovents_portfolio_render_image(
						'founder-at-work',
						$item['stem'],
						array(
							'widths'    => array( 800, 1600 ),
							'sizes'     => '(max-width: 720px) 92vw, (max-width: 1100px) 45vw, 30vw',
							'img_class' => 'founder-at-work__img',
							'width'     => 1280,
							'height'    => 1600,
							'alt'       => $item['alt'],
						)
					);
					?>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section section--inner section--values" aria-labelledby="about-values-heading">
	<div class="wrap values-wrap">
		<header class="values-header">
			<h2 id="about-values-heading" class="inner-section-title">What we hold to</h2>
		</header>
		<div class="value-grid">
			<article class="value-card">
				<h3>Dependability</h3>
				<p>Timelines, suppliers and the feel of the room, held with a calm hand, including when the plan has to move.</p>
			</article>
			<article class="value-card">
				<h3>Customer commitment</h3>
				<p>We listen to what matters to you, and we plan around that, with clear, steady communication throughout.</p>
			</article>
			<article class="value-card">
				<h3>Transparent proposals</h3>
				<p>After a free consultation, you receive an itemised proposal, so you can see what is included before you decide.</p>
			</article>
		</div>
		<?php if ( function_exists( 'ovents_google_testimonials_for_about_page' ) ) : ?>
		<div class="about-reviews-block">
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
			<?php
			ob_start();
			ovents_render_manifest_image( 'content-blossom-backdrop' );
			$promise_img = trim( (string) ob_get_clean() );
			if ( '' !== $promise_img ) {
				echo $promise_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( function_exists( 'ovents_manifest_image_jpeg_url' ) ) {
				$promise_src = ovents_manifest_image_jpeg_url( 'content-blossom-backdrop' );
				if ( $promise_src ) {
					printf(
						'<img class="promise-split__img" src="%s" width="800" height="1000" alt="%s" loading="lazy" decoding="async">',
						esc_url( $promise_src ),
						esc_attr__( 'Event room lit in purple, with a blossom-covered backdrop and banquet chairs.', 'ovents' )
					);
				}
			}
			?>
		</figure>
		<div class="promise-split__copy">
			<h2 id="promise-heading" class="promise-heading">Our promise</h2>
			<p>We aim to give you a calm, considered service, and to be a quiet presence you can trust.</p>
			<p>We explain clearly, at every stage, what is included, and we listen to your feedback along the way.</p>
			<p class="promise-split__cta">
				<a class="link-cta" href="<?php echo esc_url( $home . '/contact/' ); ?>">Book a free consultation</a>
			</p>
		</div>
	</div>
</section>
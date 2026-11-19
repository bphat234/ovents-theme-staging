<?php
/**
 * Portfolio page — selected celebrations and case studies (CPT).
 *
 * @package Ovents
 */
$cases = new WP_Query(
	array(
		'post_type'      => 'ovents_case',
		'post_status'    => array( 'publish' ),
		'posts_per_page' => 12,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$selected = array(
	array(
		'manifest' => 'portfolio-erica-samuel-2018',
		'title'    => 'Erica and Samuel, 2018',
	),
	array(
		'manifest' => 'portfolio-gloria-daniel-2026',
		'title'    => 'Gloria and Daniel, 2026',
	),
	array(
		'manifest' => 'portfolio-funmi-yemi-2025',
		'title'    => 'Funmi and Yemi, 2025',
	),
	array(
		'manifest' => 'portfolio-planners-table-2026',
		'title'    => 'The Planner’s Table – a lunch & learn experience, April 2026, organised by Ovents',
	),
	array(
		'manifest' => 'portfolio-balloon-celebration',
		'title'    => 'A first-birthday celebration',
	),
	array(
		'manifest' => 'portfolio-couple-evening',
		'title'    => 'An evening celebration',
	),
);
?>
<section id="page-content" class="section section--inner section--portfolio-intro">
	<div class="wrap content-prose content-prose--center">
		<p class="label-gold">Selected celebrations</p>
		<p>Real weddings, parties and an Ovents-organised industry lunch and learn. More case studies will appear here as they are approved for publication.</p>
	</div>
</section>

<section class="section section--inner section--inner-alt section--portfolio-selected" aria-labelledby="portfolio-selected-heading">
	<div class="wrap">
		<h2 id="portfolio-selected-heading" class="visually-hidden"><?php esc_html_e( 'Selected celebrations', 'ovents' ); ?></h2>
		<div class="portfolio-teaser-grid portfolio-selected-grid">
			<?php foreach ( $selected as $card ) : ?>
				<article class="portfolio-card portfolio-card--selected">
					<figure class="portfolio-card__media">
						<?php
						ovents_render_manifest_image(
							$card['manifest'],
							array(
								'img_class' => 'portfolio-card__img',
								'sizes'     => '(max-width: 720px) 92vw, 33vw',
							)
						);
						?>
					</figure>
					<div class="portfolio-card__body">
						<h3 class="portfolio-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<?php
						$row = ovents_theme_manifest_image( $card['manifest'] );
						if ( $row && ! empty( $row['credit'] ) ) :
							?>
							<p class="portfolio-card__meta"><?php echo esc_html( (string) $row['credit'] ); ?></p>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="portfolio-credits content-prose portfolio-credits--center">
			<?php esc_html_e( 'Photographs: V. Opoku Photography (Erica and Samuel, 2018); Sure Moments HQ (The Planner’s Table, 2026); Zeal Photography (Christopher Akpokodje).', 'ovents' ); ?>
		</p>
	</div>
</section>

<?php if ( $cases->have_posts() ) : ?>
	<section class="section section--inner" aria-label="<?php esc_attr_e( 'Case studies', 'ovents' ); ?>">
		<div class="wrap portfolio-grid">
			<?php
			while ( $cases->have_posts() ) {
				$cases->the_post();
				?>
				<article class="portfolio-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
					<?php else : ?>
						<p class="portfolio-card__placeholder">[REAL EVENT PHOTO]</p>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<?php if ( has_excerpt() ) : ?>
						<p class="portfolio-card__meta"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
				</article>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
<?php endif; ?>
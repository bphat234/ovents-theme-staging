<?php
/**
 * Home — three featured portfolio cards.
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
$posts = ovents_portfolio_home_featured_posts();
if ( count( $posts ) < 1 ) {
	return;
}
$insta = ovents_instagram_profile_url();
?>
<section class="section section--portfolio-home" id="portfolio" aria-labelledby="portfolio-home-heading">
	<div class="portfolio-home portfolio-home--align-services">
		<h2 id="portfolio-home-heading" class="portfolio-home__heading">Selected celebrations</h2>
		<div class="portfolio-home__grid">
			<?php
			foreach ( $posts as $post ) {
				setup_postdata( $post );
				get_template_part( 'template-parts/portfolio/card', null, array( 'post' => $post ) );
			}
			wp_reset_postdata();
			?>
		</div>
		<p class="portfolio-home__cta">
			<a class="link-explore portfolio-home__view-all" href="<?php echo esc_url( $home . '/portfolio/' ); ?>">View all work</a>
		</p>
		<p class="portfolio-home__social">
			<a href="<?php echo esc_url( $insta ); ?>" rel="noopener noreferrer" target="_blank">Follow us @ovents_ltd</a>
		</p>
	</div>
</section>
<?php
/**
 * Single portfolio event.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main" class="inner-page portfolio-single-page">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/portfolio/single', 'content' );
	}
	?>
</main>
<?php
get_footer();
<?php
/**
 * Portfolio page.
 *
 * Template Name: Portfolio
 *
 * @package Ovents
 */
get_header();
?>
<main id="main" class="inner-page">
	<?php get_template_part( 'template-parts/inner', 'hero' ); ?>
	<?php get_template_part( 'template-parts/portfolio', 'content' ); ?>
</main>
<?php
get_footer();

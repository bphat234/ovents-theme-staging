<?php
/**
 * Front page.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main">
	<?php get_template_part( 'template-parts/home', 'content' ); ?>
</main>
<?php
get_footer();

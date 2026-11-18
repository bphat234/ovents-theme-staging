<?php
/**
 * Journal category archive.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main" class="inner-page">
	<?php get_template_part( 'template-parts/inner', 'hero' ); ?>
	<section id="page-content" class="section section--inner">
		<div class="wrap">
			<?php get_template_part( 'template-parts/journal', 'feed' ); ?>
		</div>
	</section>
</main>
<?php
get_footer();

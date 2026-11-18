<?php
/**
 * Fallback index.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main">
	<?php
	if ( is_front_page() || ( is_home() && ! have_posts() ) ) {
		get_template_part( 'template-parts/home', 'content' );
	} elseif ( have_posts() ) {
		echo '<div class="wrap page-content">';
		while ( have_posts() ) {
			the_post();
			the_title( '<h1>', '</h1>' );
			the_content();
		}
		echo '</div>';
	} else {
		get_template_part( 'template-parts/home', 'content' );
	}
	?>
</main>
<?php
get_footer();

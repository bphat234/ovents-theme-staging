<?php
/**
 * Portfolio page — legacy template; CPT archive is canonical.
 *
 * Template Name: Portfolio
 *
 * @package Ovents
 */

if ( ! is_admin() && defined( 'OVENTS_PORTFOLIO_CPT' ) ) {
	$archive = get_post_type_archive_link( OVENTS_PORTFOLIO_CPT );
	if ( $archive ) {
		wp_safe_redirect( $archive, 301 );
		exit;
	}
}

get_header();
?>
<main id="main" class="inner-page">
	<?php get_template_part( 'template-parts/inner', 'hero' ); ?>
	<?php get_template_part( 'template-parts/portfolio', 'content' ); ?>
</main>
<?php
get_footer();

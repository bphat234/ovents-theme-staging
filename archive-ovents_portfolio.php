<?php
/**
 * Portfolio archive.
 *
 * @package Ovents
 */
get_header();

$current = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$base    = get_post_type_archive_link( OVENTS_PORTFOLIO_CPT );
$filters = array(
	''         => __( 'All', 'ovents' ),
	'wedding'  => __( 'Weddings', 'ovents' ),
	'party'    => __( 'Parties', 'ovents' ),
	'industry' => __( 'Our events', 'ovents' ),
);
$query   = ovents_portfolio_archive_query();
?>
<main id="main" class="inner-page portfolio-archive">
	<?php
	get_template_part(
		'template-parts/inner',
		'hero',
		array(
			'title'      => __( 'Selected celebrations', 'ovents' ),
			'image_name' => 'hero-erica-samuel-sweetheart-table',
			'lead'       => __( 'Weddings, private celebrations and events we have planned across the UK.', 'ovents' ),
			'show_ctas'  => false,
		)
	);
	?>
	<div class="wrap portfolio-archive__head">
		<nav class="portfolio-archive__filters" aria-label="<?php esc_attr_e( 'Filter portfolio', 'ovents' ); ?>">
			<?php foreach ( $filters as $key => $label ) : ?>
				<?php
				$href = $key ? add_query_arg( 'type', $key, $base ) : $base;
				$active = $current === $key || ( '' === $current && '' === $key );
				?>
				<a class="portfolio-archive__filter<?php echo $active ? ' is-active' : ''; ?>" href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</nav>
	</div>
	<div class="wrap portfolio-archive__grid">
		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/portfolio/card', null, array( 'post' => get_post(), 'compact' => true ) );
			}
			wp_reset_postdata();
		}
		?>
	</div>
</main>
<?php
get_footer();
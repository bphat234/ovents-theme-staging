<?php
/**
 * Single journal post.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main" class="inner-page">
	<?php
	while ( have_posts() ) {
		the_post();
		$cats = get_the_category();
		get_template_part( 'template-parts/inner', 'hero' );
		?>
		<article <?php post_class( 'section section--inner journal-single' ); ?>>
			<div class="wrap journal-layout journal-layout--single">
			<div class="journal-single__main content-prose content-prose--journal">
				<p class="journal-single__meta">
					<?php
					$linked = array();
					foreach ( $cats as $cat ) {
						if ( 'uncategorized' === $cat->slug ) {
							continue;
						}
						$linked[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
					}
					if ( $linked ) {
						echo implode( '<span aria-hidden="true"> · </span>', $linked );
						echo '<span aria-hidden="true"> · </span>';
					}
					?>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				</p>
				<div class="journal-single__body">
					<?php the_content(); ?>
				</div>
				<p class="journal-single__back"><a class="link-explore" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Back to the journal', 'ovents' ); ?></a></p>
			</div>
			<?php get_template_part( 'template-parts/journal', 'aside' ); ?>
			</div>
		</article>
		<?php
	}
	?>
</main>
<?php
get_footer();

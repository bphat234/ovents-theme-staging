<?php
/**
 * Journal archive: category filter and post cards.
 *
 * @package Ovents
 */

$journal_url = get_permalink( (int) get_option( 'page_for_posts' ) );
if ( ! $journal_url ) {
	$journal_url = home_url( '/blog/' );
}
$terms = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'name',
	)
);
?>
<nav class="journal-cats" aria-label="<?php esc_attr_e( 'Journal categories', 'ovents' ); ?>">
	<a class="<?php echo is_home() ? 'is-current' : ''; ?>" href="<?php echo esc_url( $journal_url ); ?>"><?php esc_html_e( 'All posts', 'ovents' ); ?></a>
	<?php foreach ( $terms as $term ) : ?>
		<?php if ( 'uncategorized' === $term->slug ) { continue; } ?>
		<a class="<?php echo is_category( $term->term_id ) ? 'is-current' : ''; ?>" href="<?php echo esc_url( get_category_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
	<?php endforeach; ?>
</nav>
<?php if ( have_posts() ) : ?>
	<div class="journal-list">
		<?php
		while ( have_posts() ) {
			the_post();
			$cats = get_the_category();
			?>
			<article <?php post_class( 'journal-card' ); ?>>
				<a class="journal-card__media" href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'medium_large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) );
					}
					?>
				</a>
				<div class="journal-card__body">
					<p class="journal-card__meta">
						<?php
						$labels = array();
						foreach ( $cats as $cat ) {
							if ( 'uncategorized' === $cat->slug ) {
								continue;
							}
							$labels[] = esc_html( $cat->name );
						}
						if ( $labels ) {
							echo '<span>' . implode( ' · ', $labels ) . '</span><span aria-hidden="true"> · </span>';
						}
						?>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</p>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
					<a class="link-explore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read', 'ovents' ); ?></a>
				</div>
			</article>
			<?php
		}
		?>
	</div>
	<nav class="journal-pager" aria-label="<?php esc_attr_e( 'Journal pages', 'ovents' ); ?>">
		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 1,
				'prev_text' => __( 'Previous', 'ovents' ),
				'next_text' => __( 'Next', 'ovents' ),
			)
		);
		?>
	</nav>
<?php else : ?>
	<div class="content-prose">
		<p>Planning tips and notes on weddings, corporate events and private celebrations. New articles will be published here.</p>
		<p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get in touch</a> to discuss your event.</p>
	</div>
<?php endif; ?>

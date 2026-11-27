<?php
/**
 * Right-hand column for the journal.
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
$exclude = is_singular( 'post' ) ? array( get_the_ID() ) : array();
$recent  = get_posts(
	array(
		'numberposts' => 5,
		'post_status' => 'publish',
		'exclude'     => $exclude,
	)
);
?>
<aside class="journal-aside" aria-label="<?php esc_attr_e( 'Journal sidebar', 'ovents' ); ?>">
	<section class="journal-aside__panel">
		<h2><?php esc_html_e( 'Categories', 'ovents' ); ?></h2>
		<ul class="journal-aside__list">
			<li>
				<a class="<?php echo is_home() ? 'is-current' : ''; ?>" href="<?php echo esc_url( $journal_url ); ?>"><?php esc_html_e( 'All', 'ovents' ); ?></a>
			</li>
			<?php foreach ( $terms as $term ) : ?>
				<?php if ( 'uncategorized' === $term->slug ) { continue; } ?>
				<li>
					<a class="<?php echo is_category( $term->term_id ) ? 'is-current' : ''; ?>" href="<?php echo esc_url( get_category_link( $term ) ); ?>">
						<span><?php echo esc_html( $term->name ); ?></span>
						<span class="journal-aside__count"><?php echo esc_html( (string) $term->count ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
	<?php if ( $recent ) : ?>
		<section class="journal-aside__panel">
			<h2><?php esc_html_e( 'Recent posts', 'ovents' ); ?></h2>
			<ul class="journal-aside__recent">
				<?php foreach ( $recent as $item ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $item ) ); ?>"><?php echo esc_html( get_the_title( $item ) ); ?></a>
						<time datetime="<?php echo esc_attr( get_the_date( 'c', $item ) ); ?>"><?php echo esc_html( get_the_date( '', $item ) ); ?></time>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>
	<section class="journal-aside__cta">
		<h2><?php esc_html_e( 'Planning an event?', 'ovents' ); ?></h2>
		<p><?php esc_html_e( 'Tell us about the celebration and we will be in touch.', 'ovents' ); ?></p>
		<a class="btn btn-light" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a free consultation', 'ovents' ); ?></a>
	</section>
</aside>

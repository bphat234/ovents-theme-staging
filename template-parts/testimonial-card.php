<?php
/**
 * Single Google review card.
 *
 * @package Ovents
 *
 * @var array $args
 */
$item = isset( $args['item'] ) ? $args['item'] : array();
$mode = isset( $args['mode'] ) ? (string) $args['mode'] : 'carousel';
$id   = isset( $item['id'] ) ? (string) $item['id'] : wp_unique_id( 't-' );
$rating = isset( $item['rating'] ) ? (int) $item['rating'] : 5;
$text   = isset( $item['full_text'] ) ? (string) $item['full_text'] : '';
$quote = $text;
if ( in_array( $mode, array( 'proof', 'slide' ), true ) && ! empty( $item['pull_quote'] ) ) {
	$quote = (string) $item['pull_quote'];
}
$full_text   = isset( $item['full_text'] ) ? (string) $item['full_text'] : '';
$show_expand = in_array( $mode, array( 'proof', 'slide' ), true ) && '' !== $full_text && $full_text !== $quote;

$figure_class = array(
	'testimonial',
	'testimonial--google',
	'testimonial--' . sanitize_html_class( $mode ),
);
if ( 'proof' === $mode ) {
	$figure_class[] = 'testimonial--review-card';
}
?>
<figure class="<?php echo esc_attr( implode( ' ', $figure_class ) ); ?>" id="testimonial-<?php echo esc_attr( $id ); ?>">
	<?php ovents_render_star_rating( $rating ); ?>
	<blockquote class="testimonial__quote">
		<?php echo esc_html( $quote ); ?>
	</blockquote>
	<?php if ( $show_expand ) : ?>
		<details class="testimonial__more">
			<summary><?php esc_html_e( 'Read full review', 'ovents' ); ?></summary>
			<p class="testimonial__full"><?php echo esc_html( $full_text ); ?></p>
		</details>
	<?php endif; ?>
	<figcaption>
		<cite>
			<strong><?php echo esc_html( $item['author'] ); ?></strong>
			<?php if ( ! empty( $item['context'] ) && in_array( $mode, array( 'proof', 'slide', 'carousel' ), true ) ) : ?>
				<span class="testimonial__meta"><?php echo esc_html( (string) $item['context'] ); ?> · <?php echo esc_html( $item['date_label'] ); ?></span>
			<?php else : ?>
				<span class="testimonial__meta"><?php echo esc_html( $item['date_label'] ); ?></span>
			<?php endif; ?>
		</cite>
	</figcaption>
</figure>
<?php
/**
 * Verbatim Google reviews (client brief 8b). Pull-quotes only omit whole sentences with …
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * GBP “Write a review” / reviews link.
 */
function ovents_google_review_url() {
	if ( defined( 'OVENTS_GOOGLE_REVIEW_URL' ) && OVENTS_GOOGLE_REVIEW_URL ) {
		return (string) OVENTS_GOOGLE_REVIEW_URL;
	}
	return 'https://g.page/r/CR-b_dmROsZ8EAI/review';
}

/**
 * @return array<int, array<string, mixed>>
 */
function ovents_google_testimonials_all() {
	return array(
		array(
			'id'          => 'amanda-l-wedding',
			'full_text'   => 'The ovents service were so professional. I really appreciate their effort towards my wedding. The bar set up was nice and they ensured that the high table had drinks and food. Titi managed well with pictures and timing to get to the reception. We got there on time and everything was well managed. The canapés were great and people enjoyed it. We appreciated the efforts. Thank you so much for ensuring that my wedding reception was smooth and beautiful. I appreciate all the staff. They were all friendly and helpful.',
			'pull_quote'  => 'The ovents service were so professional… Thank you so much for ensuring that my wedding reception was smooth and beautiful.',
			'author'      => 'Amanda L.',
			'context'     => 'Wedding',
			'date_label'  => 'Google review, March 2023',
			'rating'      => 5,
			'service_tags' => array( 'weddings', 'home' ),
		),
		array(
			'id'          => 'jude-gloria-wedding',
			'full_text'   => 'We used Ovents to coordinate our wedding and help with the planning. We truly could not have done it without them. They were such an exceptional team that ensured things were done smoothly. We also hired our their magic mirror which was a reasonable price and our guests LOVED it! Thank you so much Fred, Verina and the whole Ovents team! You made our wedding such a memorable occasion. I wish we could give you 100 stars!!',
			'pull_quote'  => 'We truly could not have done it without them… You made our wedding such a memorable occasion. I wish we could give you 100 stars!!',
			'author'      => 'Jude & Gloria',
			'context'     => 'Wedding',
			'date_label'  => 'Google review, January 2020',
			'rating'      => 5,
			'service_tags' => array( 'weddings', 'home' ),
		),
		array(
			'id'          => 'edwina-parties',
			'full_text'   => 'I used Ovents for my 25th birthday party. Amazing and hands on service throughout the planning process and actual day. They provided a magic mirror, flower wall and spotlight which was perfect as memorabilia of the day. Would recommend and definitely use in the future!',
			'pull_quote'  => 'I used Ovents for my 25th birthday party. Amazing and hands on service throughout the planning process and actual day. They provided a magic mirror, flower wall and spotlight which was perfect as memorabilia of the day. Would recommend and definitely use in the future!',
			'author'      => 'Edwina B.',
			'context'     => 'Private party',
			'date_label'  => 'Google review, February 2020',
			'rating'      => 5,
			'service_tags' => array( 'parties', 'home' ),
		),
		array(
			'id'          => 'mai-parties',
			'full_text'   => 'Let me start off by saying that Ovents is absolutely amazing! 100% satisfaction rate for me and all of my family members! Both adults and children got their faces painted by the amazing Kat, who\'s a professional face painter of 17 years! We had everyone from Joaquim Phoenix\'s Joker to Deadpool and even Pennywise!! Also as part of the event we had a fantastic photo booth with props included. We took so many pictures I lost count! The pictures printed instantly and are ready for you to take home with you. Lastly, their popcorn and candy cloud stand! They literally made a cotton candy/candy floss lover out of me with their exotic and unique flavours, my favourite was Tropival! Please if you\'re going to hire anybody for a family event do consider Ovents! They have a little something for everyone! Take it from someone who has a big and noisy family, we were all happy by the end!',
			'pull_quote'  => 'Please if you\'re going to hire anybody for a family event do consider Ovents! They have a little something for everyone!',
			'author'      => 'Mai',
			'context'     => 'Family event',
			'date_label'  => 'Google review, December 2019',
			'rating'      => 5,
			'service_tags' => array( 'parties', 'home' ),
		),
		array(
			'id'          => 'francis-general',
			'full_text'   => 'Fantastic service! I have attended a few events run by the team, and have even worked with them to plan a recent party, and through all these experiences the outcome has been amazing! The team will spare no effort in delivering your wishes, and the attention to detail is great. Ovents is the first team I recommend whenever events are being planned.',
			'pull_quote'  => 'The team will spare no effort in delivering your wishes, and the attention to detail is great. Ovents is the first team I recommend whenever events are being planned.',
			'author'      => 'Francis D.',
			'context'     => 'Events',
			'date_label'  => 'Google review, February 2020',
			'rating'      => 5,
			'service_tags' => array( 'home', 'parties' ),
		),
		array(
			'id'           => 'tee-wedding-coord-1',
			'full_text'    => 'Choosing Tee and Ovents was genuinely one of the best decisions we made for our wedding. From our very first conversation, Tee brought so much warmth, confidence and reassurance to the process. She made us feel cared for, listened to and completely supported. On the wedding day, she exceeded every expectation. Her professionalism, attention to detail and genuine passion for what she does were evident throughout. We honestly couldn’t imagine our day without her and would wholeheartedly recommend Ovents to any couple looking for a coordinator who truly goes above and beyond.',
			'pull_quote'   => 'Choosing Tee and Ovents was genuinely one of the best decisions we made for our wedding… We honestly couldn’t imagine our day without her and would wholeheartedly recommend Ovents to any couple looking for a coordinator who truly goes above and beyond.',
			'author'       => 'Anonymous',
			'context'      => 'Wedding',
			'date_label'   => 'Google review, November 2026',
			'rating'       => 5,
			'service_tags' => array( 'weddings', 'home' ),
		),
		array(
			'id'           => 'tee-wedding-coord-2',
			'full_text'    => 'Tee was exceptional at managing all the moving parts of our wedding day. From coordinating people and managing logistics to keeping everything on schedule and ensuring the day flowed seamlessly, she handled it all with such grace and professionalism. There was so much happening behind the scenes that we didn’t even have to think about because Tee had it covered. She was proactive, attentive and always seemed to know what needed to happen before we even had to ask. Our families and bridal party also noticed just how much work she put in. We are incredibly grateful for everything she did to make our day run so smoothly.',
			'pull_quote'   => 'Tee was exceptional at managing all the moving parts of our wedding day… We are incredibly grateful for everything she did to make our day run so smoothly.',
			'author'       => 'Anonymous',
			'context'      => 'Wedding',
			'date_label'   => 'Google review, November 2026',
			'rating'       => 5,
			'service_tags' => array( 'weddings', 'home' ),
		),
		array(
			'id'           => 'tee-wedding-coord-3',
			'full_text'    => 'One of the things we appreciated most about having Tee as our coordinator was the peace of mind she gave us. Weddings can be overwhelming, but her calm presence, warmth and reassuring nature made such a difference. What stood out was how genuinely she cared. We never felt like just another wedding in her calendar. She looked after us, our families and everyone involved with so much thoughtfulness. Even when things could have become stressful, Tee remained composed and ensured we could simply be present and enjoy one of the most special days of our lives. Thank you, Tee, for treating our wedding as though it mattered to you personally. We are so grateful for you and pray that Ovents continues to grow!',
			'pull_quote'   => 'One of the things we appreciated most about having Tee as our coordinator was the peace of mind she gave us… Thank you, Tee, for treating our wedding as though it mattered to you personally. We are so grateful for you and pray that Ovents continues to grow!',
			'author'       => 'Anonymous',
			'context'      => 'Wedding',
			'date_label'   => 'Google review, November 2026',
			'rating'       => 5,
			'service_tags' => array( 'weddings', 'home' ),
		),
	);
}

/**
 * @param string $tag weddings|parties|home|corporate.
 * @return array<int, array<string, mixed>>
 */
/**
 * @param string $id Testimonial id slug.
 * @return array<string, mixed>|null
 */
function ovents_google_testimonial_by_id( $id ) {
	foreach ( ovents_google_testimonials_all() as $item ) {
		if ( $item['id'] === $id ) {
			return $item;
		}
	}
	return null;
}

/**
 * @param string $tag weddings|parties|home|corporate.
 * @return array<int, array<string, mixed>>
 */
function ovents_google_testimonials_for( $tag ) {
	$tag = sanitize_key( $tag );
	return array_values(
		array_filter(
			ovents_google_testimonials_all(),
			static function ( $item ) use ( $tag ) {
				return in_array( $tag, $item['service_tags'], true );
			}
		)
	);
}

/**
 * @param int $rating 1–5.
 */
function ovents_render_star_rating( $rating ) {
	$rating = max( 1, min( 5, (int) $rating ) );
	echo '<p class="testimonial-stars" role="img" aria-label="' . esc_attr( sprintf( /* translators: %d star rating */ _n( '%d star', '%d stars', $rating, 'ovents' ), $rating ) ) . '">';
	for ( $i = 1; $i <= 5; $i++ ) {
		echo '<span class="testimonial-stars__star' . ( $i <= $rating ? ' is-filled' : '' ) . '" aria-hidden="true">★</span>';
	}
	echo '</p>';
}

/**
 * Render Google review link button.
 */
function ovents_render_google_review_cta( $label = '' ) {
	if ( '' === $label ) {
		$label = __( 'Read our reviews on Google', 'ovents' );
	}
	printf(
		'<p class="google-review-cta"><a class="btn btn-primary" href="%1$s" rel="noopener noreferrer" target="_blank" data-track="review_link_click">%2$s</a></p>',
		esc_url( ovents_google_review_url() ),
		esc_html( $label )
	);
}

/**
 * @param array<string, mixed> $item Testimonial row.
 * @param array<string, mixed> $args carousel|proof.
 */
/**
 * @param string[] $ids Testimonial id slugs.
 * @return array<int, array<string, mixed>>
 */
function ovents_google_testimonials_by_ids( $ids ) {
	$out = array();
	foreach ( $ids as $id ) {
		$row = ovents_google_testimonial_by_id( (string) $id );
		if ( $row ) {
			$out[] = $row;
		}
	}
	return $out;
}

/**
 * Reviews shown on the corporate page (wedding & party clients, full text).
 *
 * @return array<int, array<string, mixed>>
 */
function ovents_google_testimonials_for_corporate_page() {
	return ovents_google_testimonials_by_ids(
		array(
			'francis-general',
			'amanda-l-wedding',
			'jude-gloria-wedding',
		)
	);
}

/**
 * Reviews on the About page (full text carousel).
 *
 * @return array<int, array<string, mixed>>
 */
function ovents_google_testimonials_for_about_page() {
	return ovents_google_testimonials_by_ids(
		array(
			'francis-general',
			'amanda-l-wedding',
			'jude-gloria-wedding',
			'edwina-parties',
		)
	);
}

/**
 * Centred single-slide carousel — full Google review text, no card chrome.
 *
 * @param array<int, array<string, mixed>> $items Testimonial rows.
 * @param array<string, mixed>            $args mode, hint.
 */
function ovents_render_testimonial_bare_carousel( $items, $args = array() ) {
	if ( empty( $items ) ) {
		return;
	}
	$args = wp_parse_args(
		$args,
		array(
			'mode' => 'carousel',
		)
	);
	$mode = (string) $args['mode'];
	?>
	<div class="testimonial-carousel testimonial-carousel--single testimonial-carousel--bare" data-testimonial-carousel>
		<div class="testimonial-carousel__controls">
			<button type="button" class="testimonial-carousel__arrow testimonial-carousel__arrow--prev" data-carousel-prev aria-label="<?php esc_attr_e( 'Previous testimonial', 'ovents' ); ?>">
				<?php echo ovents_icon( 'chevron-left', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
			<div class="testimonial-carousel__frame">
				<div class="testimonial-carousel__viewport" data-carousel-viewport tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Client testimonials. Use arrow keys to browse.', 'ovents' ); ?>">
					<div class="testimonial-carousel__track" data-carousel-track>
						<?php
						foreach ( $items as $item ) {
							ovents_render_testimonial_card( $item, array( 'mode' => $mode ) );
						}
						?>
					</div>
				</div>
			</div>
			<button type="button" class="testimonial-carousel__arrow testimonial-carousel__arrow--next" data-carousel-next aria-label="<?php esc_attr_e( 'Next testimonial', 'ovents' ); ?>">
				<?php echo ovents_icon( 'chevron-right', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
		</div>
	</div>
	<?php
}

function ovents_render_testimonial_card( $item, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'mode' => 'carousel',
		)
	);

	get_template_part(
		'template-parts/testimonial',
		'card',
		array(
			'item' => $item,
			'mode' => $args['mode'],
		)
	);
}

/**
 * Proof section with one or more testimonials.
 *
 * @param string $tag Service tag.
 * @param string $extra_html After cards (e.g. photo placeholder).
 */
function ovents_render_testimonial_proof_section( $tag, $extra_html = '' ) {
	$items = ovents_google_testimonials_for( $tag );
	if ( empty( $items ) && 'corporate' === $tag ) {
		?>
		<section class="section section--inner section--proof section--service-reviews" aria-label="<?php esc_attr_e( 'Client proof', 'ovents' ); ?>">
			<div class="wrap service-reviews-wrap">
				<header class="service-reviews__header">
					<p class="label-gold"><?php esc_html_e( 'Kind words', 'ovents' ); ?></p>
					<h2 class="inner-section-title"><?php esc_html_e( 'Client feedback', 'ovents' ); ?></h2>
				</header>
				<div class="content-prose content-prose--center">
					<p>[CORPORATE TESTIMONIAL NEEDED]</p>
				</div>
				<div class="service-reviews__cta">
					<?php ovents_render_google_review_cta(); ?>
				</div>
			</div>
		</section>
		<?php
		return;
	}
	if ( empty( $items ) ) {
		return;
	}

	$headers = array(
		'weddings' => array(
			'title' => __( 'What couples say', 'ovents' ),
			'lead'  => __( 'Verbatim Google reviews from wedding clients.', 'ovents' ),
		),
		'parties'  => array(
			'title' => __( 'What hosts say', 'ovents' ),
			'lead'  => __( 'Verbatim Google reviews from private party and family events.', 'ovents' ),
		),
	);
	$heading_id = 'proof-reviews-' . sanitize_key( $tag );
	$header     = isset( $headers[ $tag ] ) ? $headers[ $tag ] : array(
		'title' => __( 'Kind words from our clients', 'ovents' ),
		'lead'  => __( 'Personal experiences shared on Google.', 'ovents' ),
	);
	?>
	<section class="section section--inner section--proof section--service-reviews" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
		<div class="wrap service-reviews-wrap">
			<header class="service-reviews__header">
				<p class="label-gold"><?php esc_html_e( 'Kind words', 'ovents' ); ?></p>
				<h2 id="<?php echo esc_attr( $heading_id ); ?>" class="inner-section-title"><?php echo esc_html( $header['title'] ); ?></h2>
				<?php if ( ! empty( $header['lead'] ) ) : ?>
					<p class="service-reviews__lead"><?php echo esc_html( $header['lead'] ); ?></p>
				<?php endif; ?>
			</header>
			<?php ovents_render_testimonial_bare_carousel( $items, array( 'mode' => 'carousel' ) ); ?>
			<?php
			if ( '' !== $extra_html ) {
				echo wp_kses_post( $extra_html );
			}
			?>
			<div class="service-reviews__cta">
				<?php ovents_render_google_review_cta(); ?>
			</div>
		</div>
	</section>
	<?php
}

add_shortcode(
	'ovents_google_review_link',
	function () {
		return '<a href="' . esc_url( ovents_google_review_url() ) . '" rel="noopener noreferrer" target="_blank" data-track="review_link_click">' . esc_html__( 'Leave a review on Google', 'ovents' ) . '</a>';
	}
);
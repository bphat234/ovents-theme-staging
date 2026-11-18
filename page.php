<?php
/**
 * Page template.
 *
 * @package Ovents
 */
get_header();
?>
<main id="main" class="inner-page">
	<?php
	if ( is_front_page() ) {
		get_template_part( 'template-parts/home', 'content' );
		?>
</main>
		<?php
		get_footer();
		return;
	}

	$custom_content = array( 'about' => 'about', 'contact' => 'contact', 'faq' => 'faq' );
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	if ( isset( $custom_content[ $slug ] ) ) {
		get_template_part( 'template-parts/' . $custom_content[ $slug ], 'content' );
	} else {
		while ( have_posts() ) {
			the_post();
			if ( ovents_use_hero_chrome() && ! is_front_page() ) {
				get_template_part( 'template-parts/inner', 'hero' );
			} else {
				?>
			<header class="page-hero">
				<div class="wrap">
					<p class="eyebrow">Ovents LTD</p>
					<h1><?php echo esc_html( ovents_page_h1() ); ?></h1>
				</div>
			</header>
				<?php
			}
			?>
			<section id="page-content" class="section section--inner" aria-label="<?php echo esc_attr( ovents_page_h1() ); ?>">
				<div class="wrap content-prose">
					<?php the_content(); ?>
				</div>
			</section>
			<?php
		}
		?>
	<?php } ?>
</main>
<?php
get_footer();

<?php
/**
 * Header template.
 *
 * @package Ovents
 */
$is_hero_header = ovents_use_hero_chrome();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class( $is_hero_header ? 'has-hero-header' : 'has-inner-header' ); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
<header class="site-chrome<?php echo $is_hero_header ? ' site-chrome--hero' : ' site-chrome--inner'; ?>">
	<div class="header-bar wrap<?php echo $is_hero_header ? ' header-bar--hero' : ''; ?>">
		<div class="header-contacts">
			<a class="icon-link" href="tel:+447447462409" aria-label="Call +44 7447 462409" data-track="click_to_call">
				<?php echo ovents_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<a class="icon-link" href="mailto:info@ovents.co.uk" aria-label="Email info@ovents.co.uk" data-track="email_click">
				<?php echo ovents_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-header-white.png' ) ); ?>" width="150" height="150" alt="Ovents LTD" decoding="async">
		</a>
		<button type="button" class="nav-toggle" aria-controls="site-nav" aria-expanded="false" aria-label="Open menu">
			<span class="nav-toggle-icon" aria-hidden="true">
				<?php echo ovents_icon( 'menu', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
			<span class="nav-toggle-label">Menu</span>
		</button>
	</div>
</header>
<?php get_template_part( 'template-parts/nav', 'overlay' ); ?>
<div class="nav-backdrop" hidden></div>

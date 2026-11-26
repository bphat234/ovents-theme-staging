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
		<nav class="header-nav-desktop" aria-label="Main">
			<ul class="menu-desktop">
				<li><a href="<?php echo esc_url( home_url( '/weddings/' ) ); ?>"<?php echo ( is_page( 'weddings' ) ? ' aria-current="page"' : '' ); ?>>Weddings</a></li>
				<li><a href="<?php echo esc_url( home_url( '/corporate-events/' ) ); ?>"<?php echo ( is_page( 'corporate-events' ) ? ' aria-current="page"' : '' ); ?>>Corporate</a></li>
				<li><a href="<?php echo esc_url( home_url( '/parties/' ) ); ?>"<?php echo ( is_page( 'parties' ) ? ' aria-current="page"' : '' ); ?>>Parties</a></li>
			</ul>
		</nav>
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-header-white.png' ) ); ?>" width="150" height="150" alt="Ovents LTD" decoding="async">
		</a>
		<nav class="header-nav-desktop header-nav-desktop--right" aria-label="Secondary">
			<ul class="menu-desktop">
				<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"<?php echo ( defined( 'OVENTS_PORTFOLIO_CPT' ) && ( is_post_type_archive( OVENTS_PORTFOLIO_CPT ) || is_singular( OVENTS_PORTFOLIO_CPT ) ) ? ' aria-current="page"' : '' ); ?>>Portfolio</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"<?php echo ( is_page( 'about' ) ? ' aria-current="page"' : '' ); ?>>About</a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"<?php echo ( is_page( 'blog' ) || is_singular( 'post' ) || is_home() ? ' aria-current="page"' : '' ); ?>>Journal</a></li>
				<li><a class="btn-enquire" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"<?php echo ( is_page( 'contact' ) ? ' aria-current="page"' : '' ); ?>>Enquire</a></li>
			</ul>
		</nav>
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

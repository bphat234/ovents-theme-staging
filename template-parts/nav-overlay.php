<?php
/**
 * Full-screen menu overlay (Wix-style).
 *
 * @package Ovents
 */
$home = untrailingslashit( home_url() );
?>
<nav id="site-nav" class="site-nav" aria-label="Main">
	<button type="button" class="site-nav__close" aria-label="Close menu">
		<?php echo ovents_icon( 'x', array( 'width' => 36, 'height' => 36 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</button>
	<div class="site-nav__inner">
		<ul class="menu-wix">
			<li><a href="<?php echo esc_url( $home . '/about/' ); ?>">About</a></li>
			<li class="menu-wix__services">
				<button type="button" class="menu-wix__toggle" aria-expanded="false" data-menu-expand>
					<span>Services</span>
					<?php echo ovents_icon( 'chevron-down', array( 'width' => 20, 'height' => 20, 'class' => 'menu-wix__chevron' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
				<ul class="menu-wix__sub">
					<li><a href="<?php echo esc_url( $home . '/weddings/' ); ?>">Weddings</a></li>
					<li><a href="<?php echo esc_url( $home . '/corporate-events/' ); ?>">Corporate</a></li>
					<li><a href="<?php echo esc_url( $home . '/parties/' ); ?>">Parties</a></li>
				</ul>
			</li>
			<li><a href="<?php echo esc_url( $home . '/blog/' ); ?>">Blog</a></li>
			<li><a href="<?php echo esc_url( $home . '/faq/' ); ?>">FAQ</a></li>
			<li><a href="<?php echo esc_url( $home . '/contact/' ); ?>">Contact</a></li>
			<li class="menu-wix__social">
				<a class="site-nav__instagram" href="<?php echo esc_url( ovents_instagram_profile_url() ); ?>" rel="noopener noreferrer" target="_blank" aria-label="Instagram">
					<?php echo ovents_icon( 'instagram', array( 'width' => 22, 'height' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</li>
		</ul>
	</div>
</nav>

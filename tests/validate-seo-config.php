<?php
/**
 * CLI: php tests/validate-seo-config.php
 * Asserts every focus_keyword appears in its SEO title (pages, journal, portfolio).
 */

$root = dirname( __DIR__ );
require_once $root . '/inc/seo-config.php';
require_once $root . '/inc/journal-seo-config.php';
require_once $root . '/inc/portfolio-seo-config.php';

$failed = 0;
foreach (
	array(
		'pages'     => ovents_seo_config(),
		'journal'   => ovents_journal_seo_config(),
		'portfolio' => ovents_portfolio_seo_config(),
	) as $label => $map
) {
	foreach ( $map as $slug => $row ) {
		if ( empty( $row['focus_keyword'] ) ) {
			continue;
		}
		if ( ! ovents_seo_title_contains_focus_keyword( $row['title'], $row['focus_keyword'] ) ) {
			fwrite( STDERR, "FAIL [$label] $slug: keyword not in title\n" );
			++$failed;
		}
	}
}

if ( $failed > 0 ) {
	exit( 1 );
}

echo "OK: all focus keywords appear in SEO titles.\n";
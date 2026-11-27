// Optional live smoke: BASE_URL=https://ovents.co.uk node tests/check-seo-meta.cjs
const base = process.env.BASE_URL || 'http://localhost:8091';
const slugs = ['', 'weddings/', 'corporate-events/', 'parties/', 'about/', 'contact/', 'faq/', 'blog/', 'portfolio/'];

(async () => {
	for (const slug of slugs) {
		const url = base.replace(/\/$/, '') + '/' + slug;
		const res = await fetch(url, { redirect: 'follow' });
		if (!res.ok) throw new Error(url + ' HTTP ' + res.status);
		const html = await res.text();
		if (!html.includes('<title>')) throw new Error(url + ' missing title');
		if (!html.includes('meta name="description"')) throw new Error(url + ' missing meta description');
		const articles = (html.match(/"@type":"Article"/g) || []).length;
		if (slug && !slug.startsWith('blog') && articles > 0) {
			console.warn('WARN ' + url + ': Rank Math Article still in JSON-LD (' + articles + ')');
		}
	}
	console.log('SEO meta smoke OK for', slugs.length, 'URLs at', base);
})().catch((e) => {
	console.error(e);
	process.exitCode = 1;
});
// Run against the local WordPress site: node tests/check-inner-pages.cjs
const assert = require('node:assert/strict');
(async () => {
  for (const slug of ['about', 'weddings', 'corporate-events', 'parties', 'portfolio', 'faq', 'contact']) {
    const response = await fetch('http://localhost:8091/' + slug + '/', { redirect: 'follow' });
    assert.equal(response.status, 200, slug + ' should load');
    const html = await response.text();
    assert.ok(!html.includes('class="inner-breadcrumbs"'), slug + ' must not render a breadcrumb strip');
    assert.equal((html.match(/<h1\b/g) || []).length, 1, slug + ' needs one main heading');
    assert.ok(html.indexOf('</main>') < html.indexOf('<footer'), slug + ' footer must follow main');
    assert.equal((html.match(/id="page-content"/g) || []).length, 1, slug + ' needs a content jump target');
    const hero = html.match(/<div class="inner-hero__ctas[\s\S]*?<\/div>/)[0];
    const actions = [...hero.matchAll(/href="([^"]+)"/g)].map(match => match[1]);
    assert.equal(actions.length, 2, slug + ' needs two hero actions');
    assert.notEqual(actions[0], actions[1], slug + ' actions must have distinct destinations');
    assert.ok(!html.includes('>Wedding Planning &amp; Coordination</a>'), 'Service links should be short');
    assert.ok(!html.includes('>Private Parties</a>'), 'Party links should be short');
    assert.ok(!/Fatal error|Warning:/.test(html), slug + ' should render without PHP errors');
  }
  console.log('Passed: seven inner pages, headings, main/footer boundaries, jump targets, distinct actions and short links.');
})().catch(error => { console.error(error); process.exitCode = 1; });

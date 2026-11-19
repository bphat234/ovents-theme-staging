(function () {
	var siteChrome = document.querySelector('.site-chrome');
	if (siteChrome) {
		var scrollThreshold = 24;
		function updateChromeScroll() {
			var scrolled = window.scrollY > scrollThreshold;
			siteChrome.classList.toggle('is-scrolled', scrolled);
			document.body.classList.toggle('has-scrolled-chrome', scrolled);
		}
		updateChromeScroll();
		window.addEventListener('scroll', updateChromeScroll, { passive: true });
	}

	var nav = document.getElementById('site-nav');
	var toggle = document.querySelector('.nav-toggle');
	var backdrop = document.querySelector('.nav-backdrop');
	var closeBtn = document.querySelector('.site-nav__close');

	function setNavOpen(open) {
		if (!nav || !toggle) return;
		nav.classList.toggle('is-open', open);
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
		if (backdrop) backdrop.hidden = !open;
		document.body.classList.toggle('nav-open', open);
		document.body.style.overflow = open ? 'hidden' : '';
		if (!open) {
			document.querySelectorAll('.menu-wix__services.is-expanded').forEach(function (li) {
				li.classList.remove('is-expanded');
				var btn = li.querySelector('[data-menu-expand]');
				if (btn) btn.setAttribute('aria-expanded', 'false');
			});
		}
	}

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			setNavOpen(!nav.classList.contains('is-open'));
		});
	}

	if (closeBtn) {
		closeBtn.addEventListener('click', function (e) {
			e.stopPropagation();
			setNavOpen(false);
		});
	}

	if (backdrop) {
		backdrop.addEventListener('click', function () {
			setNavOpen(false);
		});
	}

	if (nav) {
		nav.addEventListener('click', function (e) {
			if (e.target === nav) {
				setNavOpen(false);
			}
		});
	}

	if (nav) {
		nav.querySelectorAll('a[href]').forEach(function (link) {
			link.addEventListener('click', function () {
				setNavOpen(false);
			});
		});
	}

	document.addEventListener('click', function (e) {
		var btn = e.target.closest('[data-menu-expand]');
		if (!btn || !nav || !nav.contains(btn)) return;
		e.preventDefault();
		e.stopPropagation();
		var row = btn.closest('.menu-wix__services');
		if (!row) return;
		var expanded = row.classList.toggle('is-expanded');
		btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
	});

	var instaGrid = document.querySelector('[data-insta-grid]');
	var instaToggle = document.querySelector('[data-insta-toggle]');

	if (instaGrid && instaToggle) {
		instaToggle.addEventListener('click', function () {
			var expanded = instaGrid.classList.toggle('is-expanded');
			instaToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
			instaToggle.textContent = expanded ? 'Show less' : 'View all';
		});
	}

	document.querySelectorAll('[data-testimonial-carousel]').forEach(function (testimonialCarousel) {
		var viewport = testimonialCarousel.querySelector('[data-carousel-viewport]');
		var track = testimonialCarousel.querySelector('[data-carousel-track]');
		if (!viewport || !track) return;
		var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		function moveTestimonial(direction) {
			var card = track.querySelector('.testimonial');
			if (!card) return;
			var gap = parseFloat(window.getComputedStyle(track).gap) || 0;
			viewport.scrollBy({ left: direction * (card.getBoundingClientRect().width + gap), behavior: reduceMotion ? 'instant' : 'smooth' });
		}

		viewport.addEventListener('keydown', function (e) {
			if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') return;
			e.preventDefault();
			moveTestimonial(e.key === 'ArrowLeft' ? -1 : 1);
		});
	});

	document.addEventListener('click', function (e) {
		var el = e.target.closest('[data-track]');
		if (!el) return;
		var eventName = el.getAttribute('data-track');
		if (!eventName || !window.dataLayer) return;
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({ event: eventName, link_url: el.getAttribute('href') || '' });
	});

	var faqPageLayout = document.querySelector('.faq-page-layout');
	if (faqPageLayout) {
		var faqNavLinks = faqPageLayout.querySelectorAll('.faq-page-nav a[href^="#"]');
		var faqGroups = faqPageLayout.querySelectorAll('.faq-page-group');
		if (faqNavLinks.length && faqGroups.length && 'IntersectionObserver' in window) {
			function setActiveFaqNav(id) {
				faqNavLinks.forEach(function (link) {
					var active = link.getAttribute('href') === '#' + id;
					link.classList.toggle('is-active', active);
					if (active) {
						link.setAttribute('aria-current', 'true');
					} else {
						link.removeAttribute('aria-current');
					}
				});
			}
			var observer = new IntersectionObserver(
				function (entries) {
					var visible = entries
						.filter(function (entry) {
							return entry.isIntersecting;
						})
						.sort(function (a, b) {
							return b.intersectionRatio - a.intersectionRatio;
						});
					if (visible[0]) {
						setActiveFaqNav(visible[0].target.id);
					}
				},
				{ rootMargin: '-35% 0px -55% 0px', threshold: [0, 0.25, 0.5, 1] }
			);
			faqGroups.forEach(function (group) {
				observer.observe(group);
			});
			if (window.location.hash) {
				var hashId = window.location.hash.slice(1);
				if (faqPageLayout.querySelector('#' + hashId)) {
					setActiveFaqNav(hashId);
				}
			}
		}
	}
})();

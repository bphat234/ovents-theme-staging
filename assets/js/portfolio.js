(function () {
	var dataEl = document.getElementById('portfolio-lightbox-data');
	var box = document.getElementById('portfolio-lightbox');
	if (!dataEl || !box) return;

	var images = [];
	try {
		images = JSON.parse(dataEl.textContent || '[]');
	} catch (e) {
		return;
	}
	if (!images.length) return;

	var idx = 0;
	var img = box.querySelector('.portfolio-lightbox__img');
	var stage = box.querySelector('.portfolio-lightbox__stage');
	var lastFocus = null;

	function show(i) {
		idx = (i + images.length) % images.length;
		if (img) img.src = images[idx];
	}

	function open(i) {
		lastFocus = document.activeElement;
		show(i);
		box.hidden = false;
		document.body.classList.add('portfolio-lightbox-open');
		var closeBtn = box.querySelector('.portfolio-lightbox__close');
		if (closeBtn) closeBtn.focus();
	}

	function close() {
		box.hidden = true;
		document.body.classList.remove('portfolio-lightbox-open');
		if (lastFocus && lastFocus.focus) lastFocus.focus();
	}

	document.querySelectorAll('[data-lightbox-index]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			open(parseInt(btn.getAttribute('data-lightbox-index'), 10) || 0);
		});
	});

	box.querySelectorAll('[data-lightbox-close]').forEach(function (el) {
		el.addEventListener('click', close);
	});
	var prev = box.querySelector('[data-lightbox-prev]');
	var next = box.querySelector('[data-lightbox-next]');
	if (prev) prev.addEventListener('click', function () { show(idx - 1); });
	if (next) next.addEventListener('click', function () { show(idx + 1); });

	document.addEventListener('keydown', function (e) {
		if (box.hidden) return;
		if (e.key === 'Escape') close();
		if (e.key === 'ArrowLeft') show(idx - 1);
		if (e.key === 'ArrowRight') show(idx + 1);
		if (e.key === 'Tab' && stage) {
			var focusable = box.querySelectorAll('button, [href], [tabindex]:not([tabindex="-1"])');
			if (!focusable.length) return;
			var first = focusable[0];
			var last = focusable[focusable.length - 1];
			if (e.shiftKey && document.activeElement === first) {
				e.preventDefault();
				last.focus();
			} else if (!e.shiftKey && document.activeElement === last) {
				e.preventDefault();
				first.focus();
			}
		}
	});

	if (window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
		var reveal = document.querySelectorAll('.portfolio-reveal');
		if (reveal.length && 'IntersectionObserver' in window) {
			var io = new IntersectionObserver(
				function (entries) {
					entries.forEach(function (entry) {
						if (entry.isIntersecting) {
							entry.target.classList.add('is-visible');
							io.unobserve(entry.target);
						}
					});
				},
				{ rootMargin: '0px 0px -8% 0px', threshold: 0.08 }
			);
			reveal.forEach(function (el) { io.observe(el); });
		} else {
			reveal.forEach(function (el) { el.classList.add('is-visible'); });
		}
	} else {
		document.querySelectorAll('.portfolio-reveal').forEach(function (el) {
			el.classList.add('is-visible');
		});
	}
})();
(function () {
  function revealSmashBalloonFeeds() {
    if (typeof window.sbi === 'undefined' || !window.sbi.feeds) {
      return;
    }
    var feeds = window.sbi.feeds;
    if (typeof window.jQuery !== 'undefined') {
      window.jQuery.each(feeds, function (index) {
        if (!feeds[index] || !feeds[index].settings) {
          return;
        }
        feeds[index].settings.consentGiven = true;
        if (typeof feeds[index].afterConsentToggled === 'function') {
          feeds[index].afterConsentToggled();
        }
      });
    }
  }

  function updateCookieChoice(granted) {
    try {
      localStorage.setItem('ovents_consent', granted ? 'granted' : 'denied');
    } catch (e) {}
    var banner = document.getElementById('ovents-consent-banner');
    if (banner) {
      banner.hidden = true;
      banner.setAttribute('aria-hidden', 'true');
    }
    if (granted) {
      revealSmashBalloonFeeds();
    }
  }

  var cfg = window.oventsAnalytics || {};
  var id = cfg.measurementId;
  var hasGa = !!id;

  if (hasGa) {
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      window.dataLayer.push(arguments);
    }
    gtag('consent', 'default', {
      ad_storage: 'denied',
      ad_user_data: 'denied',
      ad_personalization: 'denied',
      analytics_storage: 'denied',
      wait_for_update: 500,
    });

    var script = document.createElement('script');
    script.async = true;
    script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(id);
    document.head.appendChild(script);

    gtag('js', new Date());
    gtag('config', id, { anonymize_ip: true });

    window.oventsUpdateGaConsent = function (granted) {
      gtag('consent', 'update', {
        ad_storage: granted ? 'granted' : 'denied',
        ad_user_data: granted ? 'granted' : 'denied',
        ad_personalization: granted ? 'granted' : 'denied',
        analytics_storage: granted ? 'granted' : 'denied',
      });
    };
  }

  function applyConsent(granted) {
    if (hasGa && typeof window.oventsUpdateGaConsent === 'function') {
      window.oventsUpdateGaConsent(granted);
    }
    updateCookieChoice(granted);
  }

  var banner = document.getElementById('ovents-consent-banner');
  if (!banner) {
    return;
  }

  var accept = banner.querySelector('[data-consent-accept]');
  var reject = banner.querySelector('[data-consent-reject]');

  var stored = null;
  try {
    stored = localStorage.getItem('ovents_consent');
  } catch (e) {}
  if (stored === 'granted') {
    applyConsent(true);
    return;
  }
  if (stored === 'denied') {
    applyConsent(false);
    return;
  }

  banner.hidden = false;
  banner.setAttribute('aria-hidden', 'false');
  if (accept) {
    accept.addEventListener('click', function (event) {
      event.preventDefault();
      applyConsent(true);
    });
  }
  if (reject) {
    reject.addEventListener('click', function (event) {
      event.preventDefault();
      applyConsent(false);
    });
  }
})();
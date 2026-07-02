/**
 * REMONT URALOV before/after sliders
 * Файл: /wp-content/themes/msn/js/remont-uralov.js
 * Без jQuery и без twentytwenty, чтобы не зависеть от assets/twentytwenty.css.
 */
(function () {
  'use strict';

  function initBeforeAfter(root) {
    var range = root.querySelector('.stc-ba__range');
    if (!range) return;

    function setPosition(value) {
      var n = Math.max(0, Math.min(100, Number(value) || 50));
      root.style.setProperty('--pos', n + '%');
      range.setAttribute('aria-valuenow', String(n));
    }

    setPosition(range.value);
    range.addEventListener('input', function () { setPosition(range.value); }, { passive: true });
    range.addEventListener('change', function () { setPosition(range.value); }, { passive: true });
  }

  function initAnimations() {
    if (typeof IntersectionObserver === 'undefined') return;

    var items = document.querySelectorAll('.stc-repair-card, .stc-repair-step, .stc-ba-card, .stc-repair-section-head, .stc-repair-split__media, .stc-repair-split__content');
    if (!items.length) return;

    items.forEach(function (el) { el.classList.add('stc-repair-animate'); });

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('stc-repair-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.12 });

    items.forEach(function (el) { observer.observe(el); });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.stc-ba').forEach(initBeforeAfter);
    initAnimations();
  });
}());

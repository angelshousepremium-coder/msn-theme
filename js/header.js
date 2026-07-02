/**
 * header.js - spectechcom
 * Dropdown menu + mobile panel (no UberMenu)
 */
(function () {
  'use strict';

  var stkHeader   = document.getElementById('stk-header');
  var catalogItem = document.getElementById('stk-catalog-item');
  var catalogDrop = document.getElementById('stk-dropdown-catalog');
  var overlay     = document.getElementById('stk-overlay');
  var closeTimer  = null;

  /* ── Позиционирование: по центру экрана, под шапкой ── */
  function positionDropdown() {
    if (!stkHeader || !catalogDrop) return;

    var headerRect = stkHeader.getBoundingClientRect();
    var dropW = 1100; /* фиксированная ширина */
    var maxW  = window.innerWidth - 40;
    var w     = Math.min(dropW, maxW);

    /* по центру экрана */
    var left  = Math.max(20, (window.innerWidth - w) / 2);

    catalogDrop.style.top   = headerRect.bottom + 'px';
    catalogDrop.style.left  = left + 'px';
    catalogDrop.style.width = w + 'px';
  }

  /* ── Открыть dropdown ── */
  function openDropdown() {
    clearTimeout(closeTimer);
    positionDropdown();
    catalogDrop.classList.add('is-open');
    if (catalogItem) catalogItem.classList.add('is-active');
    if (overlay) overlay.classList.add('is-active');
  }

  /* ── Запустить таймер закрытия ── */
  function scheduleClose() {
    clearTimeout(closeTimer);
    closeTimer = setTimeout(closeDropdown, 600);
  }

  /* ── Закрыть немедленно ── */
  function closeDropdown() {
    clearTimeout(closeTimer);
    if (catalogDrop) catalogDrop.classList.remove('is-open');
    if (catalogItem) catalogItem.classList.remove('is-active');
    if (overlay)     overlay.classList.remove('is-active');
  }

  function cancelClose() {
    clearTimeout(closeTimer);
  }

  /* ── Слушатели nav-item ── */
  if (catalogItem) {
    catalogItem.addEventListener('mouseenter', openDropdown);
    catalogItem.addEventListener('mouseleave', function (e) {
      /* не закрывать если мышь перешла на dropdown */
      if (catalogDrop && catalogDrop.contains(e.relatedTarget)) return;
      scheduleClose();
    });
  }

  /* ── Слушатели dropdown ── */
  if (catalogDrop) {
    catalogDrop.addEventListener('mouseenter', cancelClose);
    catalogDrop.addEventListener('mouseleave', function (e) {
      /* не закрывать если мышь перешла на nav-item */
      if (catalogItem && catalogItem.contains(e.relatedTarget)) return;
      scheduleClose();
    });
  }

  /* ── Overlay / Escape ── */
  if (overlay) overlay.addEventListener('click', closeDropdown);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeDropdown();
  });

  /* ── Ресайз ── */
  window.addEventListener('resize', function () {
    if (catalogDrop && catalogDrop.classList.contains('is-open')) positionDropdown();
  }, { passive: true });

  /* ── Мобильное меню ── */
  var burger = document.getElementById('stk-burger');
  var panel  = document.getElementById('stk-mobile-panel');
  var mClose = document.getElementById('stk-mobile-close');
  var mOver  = document.getElementById('stk-mobile-overlay');

  function openMobile() {
    if (!panel) return;
    panel.classList.add('is-active');
    document.body.style.overflow = 'hidden';
    if (burger) burger.setAttribute('aria-expanded', 'true');
  }
  function closeMobile() {
    if (!panel) return;
    panel.classList.remove('is-active');
    document.body.style.overflow = '';
    if (burger) burger.setAttribute('aria-expanded', 'false');
  }

  if (burger) burger.addEventListener('click', openMobile);
  if (mClose) mClose.addEventListener('click', closeMobile);
  if (mOver)  mOver.addEventListener('click', closeMobile);

  /* ── Аккордеоны мобильного меню ── */
  document.querySelectorAll('.stk-mob-acc__btn').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      var body     = btn.nextElementSibling;
      var expanded = btn.getAttribute('aria-expanded') === 'true';

      var nav = btn.closest('.stk-mobile-nav');
      if (nav) {
        nav.querySelectorAll('.stk-mob-acc__btn[aria-expanded="true"]').forEach(function (s) {
          if (s !== btn) {
            s.setAttribute('aria-expanded', 'false');
            s.nextElementSibling.style.maxHeight = null;
          }
        });
      }
      btn.setAttribute('aria-expanded', String(!expanded));
      body.style.maxHeight = expanded ? null : body.scrollHeight + 'px';
    });
  });

  /* ── Скролл: компактная шапка ── */
  if (stkHeader) {
    window.addEventListener('scroll', function () {
      stkHeader.classList.toggle('stk-scrolled', window.scrollY > 80);
    }, { passive: true });
  }

})();

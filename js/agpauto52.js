/**
 * АГП 52 — Landing Page JavaScript
 * Файл: /wp-content/themes/your-theme/js/agpauto52.js
 * Зависимости: нет (vanilla JS)
 */

(function () {
  'use strict';

  /* ──────────────────────────────────────────────
     1. Sticky NAV — добавляет класс .scrolled
  ────────────────────────────────────────────── */
  const nav = document.querySelector('.agp52-nav');
  if (nav) {
    const onScroll = () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ──────────────────────────────────────────────
     2. Intersection Observer — .agp52-reveal
     Элементы плавно появляются при входе в viewport
  ────────────────────────────────────────────── */
  const revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  document.querySelectorAll('.agp52-reveal').forEach((el) => {
    revealObserver.observe(el);
  });

  /* ──────────────────────────────────────────────
     3. Blueprint spec rows — staggered reveal
  ────────────────────────────────────────────── */
  const specRowObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const rows = entry.target.querySelectorAll('.agp52-blueprint__spec-row');
          rows.forEach((row, i) => {
            setTimeout(() => row.classList.add('visible'), i * 100);
          });
          specRowObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 }
  );

  const specList = document.querySelector('.agp52-blueprint__specs-list');
  if (specList) specRowObserver.observe(specList);

  /* ──────────────────────────────────────────────
     4. Height comparison bars — animate on scroll
  ────────────────────────────────────────────── */
  const barsObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.querySelectorAll('.agp52-boom__comparison-fill').forEach((bar) => {
            const w = bar.dataset.width || '60%';
            setTimeout(() => { bar.style.width = w; }, 300);
          });
          barsObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 }
  );

  const boomSection = document.querySelector('.agp52-boom');
  if (boomSection) barsObserver.observe(boomSection);

  /* ──────────────────────────────────────────────
     5. Animated counters — числа в "О компании"
  ────────────────────────────────────────────── */
  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.dataset.suffix || '';
    const duration = 1800;
    const startTime = performance.now();

    const tick = (now) => {
      const elapsed = now - startTime;
      const progress = Math.min(elapsed / duration, 1);
      // ease-out quart
      const eased = 1 - Math.pow(1 - progress, 4);
      el.textContent = Math.round(eased * target) + suffix;
      if (progress < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
  }

  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.querySelectorAll('[data-target]').forEach(animateCounter);
          counterObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 }
  );

  const companySection = document.querySelector('.agp52-company');
  if (companySection) counterObserver.observe(companySection);

  /* ──────────────────────────────────────────────
     6. Smooth anchor scroll for nav links
  ────────────────────────────────────────────── */
document.querySelectorAll('a[href^="#"]').forEach((link) => {
  link.addEventListener('click', (e) => {
    const href = link.getAttribute('href');

    if (!href || href === '#' || href.length < 2) {
      return;
    }

    const targetId = href.slice(1);
    const target = document.getElementById(targetId);

    if (!target) {
      return;
    }

    e.preventDefault();

    const offset = 80;

    window.scrollTo({
      top: target.getBoundingClientRect().top + window.scrollY - offset,
      behavior: 'smooth',
    });
  });
});

  /* ──────────────────────────────────────────────
     7. Light parallax on Hero — mouse move
     (лёгкий эффект, не перегружает)
  ────────────────────────────────────────────── */
  const heroMedia = document.querySelector('.agp52-hero__media');
  if (heroMedia) {
    let ticking = false;
    document.addEventListener('mousemove', (e) => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => {
        const x = (e.clientX / window.innerWidth - 0.5) * 18;
        const y = (e.clientY / window.innerHeight - 0.5) * 10;
        heroMedia.style.transform = `translate(${x}px, ${y}px) scale(1.04)`;
        ticking = false;
      });
    });
  }

  /* ──────────────────────────────────────────────
     8. Hotspot tooltips — hover + touch support
  ────────────────────────────────────────────── */
  document.querySelectorAll('.agp52-hotspot').forEach((hotspot) => {
    // Touch: toggle active class
    hotspot.addEventListener('click', () => {
      const isActive = hotspot.classList.contains('active');
      // close all others
      document.querySelectorAll('.agp52-hotspot.active').forEach((h) =>
        h.classList.remove('active')
      );
      if (!isActive) hotspot.classList.add('active');
    });
  });

  // Close tooltips on outside click
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.agp52-hotspot')) {
      document.querySelectorAll('.agp52-hotspot.active').forEach((h) =>
        h.classList.remove('active')
      );
    }
  });

  /* ──────────────────────────────────────────────
     9. Blueprint points — click popup
  ────────────────────────────────────────────── */
  const bpData = {
    1: { title: 'Кабина NEXT',   specs: [['Мест', '3'], ['Тип', 'NEXT']] },
    2: { title: 'Двигатель',     specs: [['Модель', 'ЯМЗ-536'], ['Мощность', '283 л.с.']] },
    3: { title: 'Стрела',        specs: [['Секций', '7'], ['Высота', '51.7 м'], ['Поворот', '360°']] },
    4: { title: 'Топливный бак', specs: [['Объём', '300 + 210 л']] },
    5: { title: 'Колёса',        specs: [['Формула', '6×6'], ['Масса', '22 500 кг']] },
  };

  document.querySelectorAll('.agp52-bp-point').forEach((point) => {
    point.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = point.dataset.id;
      const data = bpData[id];
      if (!data) return;

      // Remove existing popup
      document.querySelectorAll('.agp52-bp-popup').forEach((p) => p.remove());

      const popup = document.createElement('div');
      popup.className = 'agp52-bp-popup';
      popup.style.cssText = `
        position:absolute;
        background:var(--c-surface2);
        border:1px solid rgba(100,180,255,0.3);
        border-radius:4px;
        padding:16px 20px;
        width:200px;
        z-index:50;
        left:28px; top:-10px;
        box-shadow:0 16px 48px rgba(0,0,0,0.6);
        animation:fadeUp 0.25s var(--ease-out) forwards;
      `;

      let html = `<div style="font-family:var(--font-display);font-size:18px;color:rgba(100,180,255,0.9);margin-bottom:8px;">${data.title}</div>`;
      data.specs.forEach(([k, v]) => {
        html += `<div style="display:flex;justify-content:space-between;font-size:12px;padding:5px 0;border-bottom:1px solid var(--c-border);">
          <span style="color:var(--c-muted)">${k}</span>
          <span style="color:var(--c-white);font-weight:600">${v}</span>
        </div>`;
      });

      popup.innerHTML = html;
      point.style.position = 'relative';
      point.appendChild(popup);
    });
  });

  document.addEventListener('click', () => {
    document.querySelectorAll('.agp52-bp-popup').forEach((p) => p.remove());
  });

  /* ──────────────────────────────────────────────
     10. Specs table — row highlight on hover
  ────────────────────────────────────────────── */
  document.querySelectorAll('.agp52-specs__table tbody tr').forEach((row) => {
    row.addEventListener('mouseenter', () => {
      row.style.borderLeft = '3px solid var(--c-accent)';
    });
    row.addEventListener('mouseleave', () => {
      row.style.borderLeft = '';
    });
  });

  /* ──────────────────────────────────────────────
     11. Видео фон героя — автоплей мобайл fix
  ────────────────────────────────────────────── */
  const heroVideo = document.querySelector('.agp52-hero__video');
  if (heroVideo) {
    heroVideo.setAttribute('playsinline', '');
    heroVideo.setAttribute('muted', '');
    heroVideo.setAttribute('autoplay', '');
    heroVideo.setAttribute('loop', '');
    heroVideo.muted = true;
    heroVideo.play().catch(() => {
      // fallback: hide video, show background image
      heroVideo.style.display = 'none';
    });
  }
  

 /* ──────────────────────────────────────────────
   11. Blueprint Slider + Lightbox
────────────────────────────────────────────── */

const slides = document.querySelectorAll('.agp52-blueprint-slide');

const prevBtn = document.querySelector('.agp52-blueprint-nav.prev');
const nextBtn = document.querySelector('.agp52-blueprint-nav.next');

let current = 0;

function showSlide(index) {

  slides.forEach(slide => {
    slide.classList.remove('active');
  });

  slides[index].classList.add('active');
}

if (prevBtn && nextBtn && slides.length) {

  nextBtn.addEventListener('click', () => {

    current++;

    if (current >= slides.length) {
      current = 0;
    }

    showSlide(current);

  });

  prevBtn.addEventListener('click', () => {

    current--;

    if (current < 0) {
      current = slides.length - 1;
    }

    showSlide(current);

  });

}

/* =========================================
   LIGHTBOX
========================================= */

const lightbox = document.getElementById('agp52Lightbox');
const lightboxImg = document.getElementById('agp52LightboxImg');

if (lightbox && lightboxImg) {

  document.querySelectorAll('.agp52-blueprint-img').forEach((img) => {

    img.addEventListener('click', function () {

      lightbox.classList.add('active');

      lightboxImg.src = this.src;

    });

  });

  const closeBtn = document.querySelector('.agp52-lightbox-close');

  if (closeBtn) {

    closeBtn.addEventListener('click', () => {

      lightbox.classList.remove('active');

    });

  }

  lightbox.addEventListener('click', (e) => {

    if (e.target === lightbox) {

      lightbox.classList.remove('active');

    }

  });

}

  /* ──────────────────────────────────────────────
     12. CTA Form — простая модалка / обработчик
     (Если используется стандартная WP форма
      — замените на свой обработчик)
  ────────────────────────────────────────────── */
  document.querySelectorAll('[data-action="request"]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      // Прокрутка к форме или открытие модалки
      const ctaSection = document.querySelector('.agp52-cta');
      if (ctaSection) {
        ctaSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      // ВСТАВЬТЕ: открытие вашего попапа с формой
      // Например: document.getElementById('agp52-modal').classList.add('open');
    });
  });

})();

/* ══════════════════════════════════════════════════════════════
   НОВЫЕ МОДУЛИ: Gallery Lightbox / Video Modal / Form Modal
   ══════════════════════════════════════════════════════════════ */

(function() {
  'use strict';

  /* ── GALLERY LIGHTBOX ──────────────────────────────────────── */
  const glightbox  = document.getElementById('agp52Glightbox');
  const glImg      = document.getElementById('agp52GlightboxImg');
  const glCounter  = document.getElementById('agp52GlightboxCounter');
  const glClose    = document.getElementById('agp52GlightboxClose');
  const glPrev     = document.getElementById('agp52GlightboxPrev');
  const glNext     = document.getElementById('agp52GlightboxNext');

  if (glightbox && glImg) {
    const items = Array.from(document.querySelectorAll('.agp52-gallery__item'));
    let current = 0;

    function glOpen(index) {
      current = index;
      const img = items[current].querySelector('img');
      if (!img) return;
      glImg.src = img.src;
      glImg.alt = img.alt;
      glightbox.classList.add('open');
      document.body.style.overflow = 'hidden';
      glUpdateCounter();
    }

    function glClose_fn() {
      glightbox.classList.remove('open');
      document.body.style.overflow = '';
    }

    function glUpdateCounter() {
      if (glCounter) glCounter.textContent = (current + 1) + ' / ' + items.length;
    }

    function glGo(dir) {
      current = (current + dir + items.length) % items.length;
      glImg.style.opacity = '0';
      setTimeout(() => {
        const img = items[current].querySelector('img');
        glImg.src = img.src;
        glImg.alt = img.alt;
        glImg.style.opacity = '1';
        glUpdateCounter();
      }, 150);
    }

    items.forEach((item, i) => {
      item.addEventListener('click', () => glOpen(i));
    });

    glClose && glClose.addEventListener('click', glClose_fn);
    glPrev  && glPrev.addEventListener('click',  () => glGo(-1));
    glNext  && glNext.addEventListener('click',  () => glGo(+1));

    glightbox.addEventListener('click', (e) => {
      if (e.target === glightbox) glClose_fn();
    });

    // Клавиши
    document.addEventListener('keydown', (e) => {
      if (!glightbox.classList.contains('open')) return;
      if (e.key === 'Escape')     glClose_fn();
      if (e.key === 'ArrowLeft')  glGo(-1);
      if (e.key === 'ArrowRight') glGo(+1);
    });
  }

  /* ── VIDEO MODAL (кнопка в секции Стрела) ─────────────────── */
  const vModal     = document.getElementById('agp52VideoModal');
  const vModalClose= document.getElementById('agp52VideoModalClose');
  const vVideo     = document.getElementById('agp52BoomVideo');
  const vPlayBtn   = document.getElementById('agp52BoomPlayBtn');

  if (vModal && vPlayBtn) {
    vPlayBtn.addEventListener('click', () => {
      vModal.classList.add('open');
      document.body.style.overflow = 'hidden';
      if (vVideo) vVideo.play();
    });

    function vClose() {
      vModal.classList.remove('open');
      document.body.style.overflow = '';
      if (vVideo) { vVideo.pause(); vVideo.currentTime = 0; }
    }

    vModalClose && vModalClose.addEventListener('click', vClose);
    vModal.addEventListener('click', (e) => { if (e.target === vModal) vClose(); });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && vModal.classList.contains('open')) vClose();
    });
  }

  /* ── FORM MODAL ────────────────────────────────────────────── */
  const fModal     = document.getElementById('agp52FormModal');
  const fModalClose= document.getElementById('agp52FormModalClose');
  const fForm      = document.getElementById('agp52Form');
  const fMsg       = document.getElementById('agp52FormMsg');

  function fOpen() {
    if (!fModal) return;
    fModal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function fClose() {
    if (!fModal) return;
    fModal.classList.remove('open');
    document.body.style.overflow = '';
  }

  // Все кнопки [data-action="request"] открывают форму
  document.querySelectorAll('[data-action="request"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      fOpen();
    });
  });

  fModalClose && fModalClose.addEventListener('click', fClose);
  fModal && fModal.addEventListener('click', (e) => {
    if (e.target === fModal) fClose();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && fModal && fModal.classList.contains('open')) fClose();
  });

  /* ── ОТПРАВКА ФОРМЫ через WordPress AJAX ──────────────────── */
  if (fForm) {
    fForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitBtn = fForm.querySelector('.agp52-form__submit');
      const origText  = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span style="opacity:0.6">Отправляем...</span>';
      if (fMsg) { fMsg.textContent = ''; fMsg.className = 'agp52-form__msg'; }

      const data = new FormData(fForm);
      data.append('action', 'agp52_send_kp');

      try {
        // Берём ajaxurl из WordPress (он всегда есть в wp_head)
        const url = (typeof ajaxurl !== 'undefined') ? ajaxurl : '/wp-admin/admin-ajax.php';
        const res  = await fetch(url, { method: 'POST', body: data });
        const json = await res.json();

        if (json.success) {
          fMsg.textContent = json.data.msg;
          fMsg.className = 'agp52-form__msg agp52-form__msg--ok';
          fForm.reset();
          setTimeout(fClose, 3000);
        } else {
          fMsg.textContent = json.data.msg;
          fMsg.className = 'agp52-form__msg agp52-form__msg--error';
        }
      } catch (err) {
        fMsg.textContent = 'Ошибка сети. Позвоните нам: 8-800-600-41-42';
        fMsg.className = 'agp52-form__msg agp52-form__msg--error';
      }

      submitBtn.disabled = false;
      submitBtn.innerHTML = origText;
    });
  }

})();

(function () {
  'use strict';

  var CFG = window.stcInfoLoadV4 || window.stcInfoLoadV3 || {};
  var ACTION = 'stc_info_load_more_v3'; // PHP-обработчик V3 уже проверен и работает.

  function $(selector, root) {
    return (root || document).querySelector(selector);
  }

  function $all(selector, root) {
    return Array.prototype.slice.call((root || document).querySelectorAll(selector));
  }

  function toInt(value, fallback) {
    var n = parseInt(value, 10);
    return Number.isFinite(n) && n > 0 ? n : fallback;
  }

  function setText(el, text) {
    if (el) el.textContent = text;
  }

  function setStatus(holder, text) {
    setText($('[data-stc-info-status-v3]', holder), text || '');
  }

  function getHolder(el) {
    if (!el) return null;
    return el.closest('[data-stc-info-load-v3]');
  }

  function getAjaxUrl(holder) {
    return (holder && holder.getAttribute('data-ajax-url')) || CFG.ajaxUrl || window.ajaxurl || '/wp-admin/admin-ajax.php';
  }

  function getNonce(holder) {
    return (holder && holder.getAttribute('data-nonce')) || CFG.nonce || '';
  }

  function complete(holder) {
    var button = $('[data-stc-info-button-v3]', holder);
    holder.classList.remove('is-loading');
    holder.classList.add('is-complete');
    holder.setAttribute('data-next-page', '');
    holder.setAttribute('data-stc-info-complete', '1');
    setText(button, 'Все материалы загружены');
    setStatus(holder, 'Все материалы загружены');
  }

  function renderError(holder, err) {
    var button = $('[data-stc-info-button-v3]', holder);
    holder.classList.remove('is-loading');
    holder.removeAttribute('data-stc-info-pending');
    setText(button, 'Не удалось загрузить. Повторить');
    setStatus(holder, 'Ошибка загрузки. Подробности в Console и Network.');
    console.warn('[STC info load more v4]', err);
  }

  function appendCards(grid, html) {
    if (!html) return 0;
    var temp = document.createElement('div');
    temp.innerHTML = html;
    var cards = $all('.stc-news-card', temp);
    cards.forEach(function (card) {
      grid.appendChild(card);
    });
    return cards.length;
  }

  function loadNext(holder) {
    if (!holder || holder.getAttribute('data-stc-info-complete') === '1') return;
    if (holder.getAttribute('data-stc-info-pending') === '1') return;

    var grid = $('[data-stc-info-grid-v3]');
    var button = $('[data-stc-info-button-v3]', holder);
    if (!grid || !button) {
      console.warn('[STC info load more v4] Не найдены grid или button', { grid: grid, button: button });
      return;
    }

    var nextPage = toInt(holder.getAttribute('data-next-page'), 0);
    var maxPage = toInt(holder.getAttribute('data-max-page'), 1);

    if (!nextPage || nextPage > maxPage) {
      complete(holder);
      return;
    }

    holder.setAttribute('data-stc-info-pending', '1');
    holder.classList.add('is-loading');
    holder.classList.remove('is-complete');
    setText(button, 'Загружаем…');
    setStatus(holder, 'Загружаем материалы…');

    var body = new URLSearchParams();
    body.append('action', ACTION);
    body.append('page', String(nextPage));

    var nonce = getNonce(holder);
    if (nonce) body.append('nonce', nonce);

    fetch(getAjaxUrl(holder), {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: body.toString()
    })
      .then(function (response) {
        return response.text().then(function (text) {
          if (!response.ok) {
            throw new Error('HTTP ' + response.status + ': ' + text.slice(0, 500));
          }
          try {
            return JSON.parse(text);
          } catch (e) {
            throw new Error('JSON parse error: ' + text.slice(0, 500));
          }
        });
      })
      .then(function (json) {
        if (!json || !json.success || !json.data) {
          throw new Error('Bad AJAX response: ' + JSON.stringify(json).slice(0, 500));
        }

        var added = appendCards(grid, json.data.html || '');
        holder.classList.remove('is-loading');
        holder.removeAttribute('data-stc-info-pending');

        if (json.data.has_more && json.data.next_page) {
          holder.setAttribute('data-next-page', String(json.data.next_page));
          setText(button, 'Показать ещё материалы');
          setStatus(holder, added ? '' : 'Новых материалов в ответе не найдено.');
        } else {
          complete(holder);
        }
      })
      .catch(function (err) {
        renderError(holder, err);
      });
  }

  function setupObserver(holder) {
    if (!holder || holder.getAttribute('data-stc-info-observer-v4') === '1') return;
    holder.setAttribute('data-stc-info-observer-v4', '1');

    var sentinel = $('[data-stc-info-sentinel-v3]', holder);
    if (!sentinel || !('IntersectionObserver' in window)) return;

    var observer = new IntersectionObserver(function (entries) {
      if (entries.some(function (entry) { return entry.isIntersecting; })) {
        loadNext(holder);
      }
    }, { rootMargin: '500px 0px' });

    observer.observe(sentinel);
  }

  function boot() {
    $all('[data-stc-info-load-v3]').forEach(function (holder) {
      holder.setAttribute('data-stc-info-v4-ready', '1');
      setupObserver(holder);
    });
  }

  // Делегированный click: работает даже если init/observer не успели привязаться.
  document.addEventListener('click', function (event) {
    var button = event.target.closest('[data-stc-info-button-v3]');
    if (!button) return;
    event.preventDefault();
    loadNext(getHolder(button));
  });

  window.stcInfoLoadMoreV4 = {
    boot: boot,
    load: function () {
      loadNext($('[data-stc-info-load-v3]'));
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();

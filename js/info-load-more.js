(function () {
  'use strict';

  var CFG = window.stcInfoLoad || {};

  function toInt(value, fallback) {
    var n = parseInt(value, 10);
    return Number.isFinite(n) && n > 0 ? n : fallback;
  }

  function init(holder) {
    if (!holder || holder.getAttribute('data-stc-info-ajax-ready') === '1') return;
    holder.setAttribute('data-stc-info-ajax-ready', '1');

    var grid = document.querySelector('[data-stc-info-grid]');
    var oldButton = holder.querySelector('[data-stc-info-button]');
    var oldSentinel = holder.querySelector('[data-stc-info-sentinel]');

    if (!grid || !oldButton) return;

    // Отключаем старый HTML-loader, который ходил в /informaczionnye-materialy/page/N
    // и давал 500/404. Старый inline-скрипт читает именно data-next-url.
    holder.setAttribute('data-next-url', '');

    // Снимаем старые click-обработчики с кнопки через cloneNode.
    var button = oldButton.cloneNode(true);
    oldButton.parentNode.replaceChild(button, oldButton);

    // Снимаем старый IntersectionObserver: старый observer продолжит смотреть на удалённый sentinel,
    // а новый observer будет смотреть на свежий элемент ниже.
    var sentinel = null;
    if (oldSentinel && oldSentinel.parentNode) {
      sentinel = oldSentinel.cloneNode(false);
      oldSentinel.parentNode.replaceChild(sentinel, oldSentinel);
    }

    var ajaxUrl = holder.getAttribute('data-ajax-url') || CFG.ajaxUrl || window.ajaxurl || '/wp-admin/admin-ajax.php';
    var nonce = holder.getAttribute('data-nonce') || CFG.nonce || '';
    var maxPage = toInt(holder.getAttribute('data-max-page') || CFG.maxPage, 1);
    var nextPage = toInt(holder.getAttribute('data-next-page'), 0);

    // Совместимость со старой версией: если data-next-page нет, вычисляем по количеству карточек.
    if (!nextPage) {
      var loaded = grid.querySelectorAll('.stc-news-card').length;
      nextPage = Math.floor(loaded / 9) + 1;
      holder.setAttribute('data-next-page', String(nextPage));
    }

    var isLoading = false;
    var observer = null;

    function setButton(text) {
      button.textContent = text;
    }

    function setComplete() {
      holder.classList.remove('is-loading');
      holder.classList.add('is-complete');
      holder.setAttribute('data-next-page', '');
      holder.setAttribute('data-next-url', '');
      setButton('Все материалы загружены');
      if (observer) observer.disconnect();
    }

    function loadNext() {
      nextPage = toInt(holder.getAttribute('data-next-page'), 0);
      maxPage = toInt(holder.getAttribute('data-max-page') || CFG.maxPage, maxPage || 1);

      if (isLoading || !nextPage) return;
      if (maxPage && nextPage > maxPage) {
        setComplete();
        return;
      }

      isLoading = true;
      holder.classList.remove('is-complete');
      holder.classList.add('is-loading');
      setButton('Загружаем…');

      var body = new URLSearchParams();
      body.append('action', 'stc_info_load_more');
      body.append('page', String(nextPage));
      if (nonce) body.append('nonce', nonce);

      fetch(ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: body.toString()
      })
        .then(function (response) {
          if (!response.ok) throw new Error('HTTP ' + response.status);
          return response.json();
        })
        .then(function (json) {
          if (!json || !json.success || !json.data) throw new Error('Bad response');

          if (json.data.html) {
            var temp = document.createElement('div');
            temp.innerHTML = json.data.html;
            temp.querySelectorAll('.stc-news-card').forEach(function (card) {
              grid.appendChild(card);
            });
          }

          if (json.data.has_more && json.data.next_page) {
            holder.setAttribute('data-next-page', String(json.data.next_page));
            holder.setAttribute('data-next-url', '');
            holder.classList.remove('is-complete');
            setButton('Показать ещё материалы');
          } else {
            setComplete();
          }
        })
        .catch(function (err) {
          // В консоли будет точная причина, но на кнопке — нормальный текст.
          console.warn('[STC info load more]', err);
          holder.classList.remove('is-complete');
          setButton('Не удалось загрузить. Повторить');
        })
        .finally(function () {
          isLoading = false;
          holder.classList.remove('is-loading');
        });
    }

    button.addEventListener('click', loadNext);

    if ('IntersectionObserver' in window && sentinel) {
      observer = new IntersectionObserver(function (entries) {
        if (entries.some(function (entry) { return entry.isIntersecting; })) {
          loadNext();
        }
      }, { rootMargin: '500px 0px' });
      observer.observe(sentinel);
    }

    if (maxPage && nextPage > maxPage) {
      setComplete();
    }
  }

  function boot() {
    document.querySelectorAll('[data-stc-info-load]').forEach(init);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();

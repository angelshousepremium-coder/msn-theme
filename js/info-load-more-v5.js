/**
 * STC Info Load More v5
 * Файл: /wp-content/themes/msn/js/info-load-more-v5.js
 *
 * /informaczionnye-materialy/
 * - ручной клик по .stc-info-load-more
 * - infinite scroll при приближении к кнопке
 * - вставка новых карточек в ту же сетку, где лежат первые article
 * - fallback: вставка перед кнопкой
 */
(function () {
  'use strict';

  if (window.STCInfoLoadMoreV5Initialized) {
    return;
  }

  window.STCInfoLoadMoreV5Initialized = true;

  var debug = {
    ready: false,
    button: null,
    grid: null,
    insertMode: null,
    nextPage: null,
    loading: false,
    done: false,
    lastError: null,
    lastResponse: null,
    loadMore: function () {},
    checkNearButton: function () {},
    getNextPage: function () {
      return debug.nextPage;
    }
  };

  window.stcInfoLoadMoreV5Debug = debug;

  function isBeforeButton(el, button) {
    return !!(el.compareDocumentPosition(button) & Node.DOCUMENT_POSITION_FOLLOWING);
  }

  function findArticlesGrid(button) {
    var explicit =
      document.querySelector('[data-stc-info-grid]') ||
      document.querySelector('[data-stc-info-list]') ||
      document.querySelector('.stc-info-grid') ||
      document.querySelector('.stc-info-list') ||
      document.querySelector('.stc-info-cards') ||
      document.querySelector('.stc-info-archive__grid') ||
      document.querySelector('#stc-info-grid') ||
      document.querySelector('#stc-info-list');

    if (explicit) {
      return explicit;
    }

    var articles = Array.prototype.slice.call(document.querySelectorAll('article'))
      .filter(function (article) {
        return article && !button.contains(article) && isBeforeButton(article, button);
      });

    if (!articles.length) {
      return null;
    }

    var parents = [];

    articles.forEach(function (article) {
      var parent = article.parentElement;

      while (parent && parent !== document.body && parent !== document.documentElement) {
        if (!parent.contains(button)) {
          var directArticles = Array.prototype.slice.call(parent.children).filter(function (child) {
            return child.tagName && child.tagName.toLowerCase() === 'article';
          }).length;

          var nestedArticles = parent.querySelectorAll('article').length;

          parents.push({
            el: parent,
            directArticles: directArticles,
            nestedArticles: nestedArticles
          });
        }

        parent = parent.parentElement;
      }
    });

    parents.sort(function (a, b) {
      if (b.directArticles !== a.directArticles) {
        return b.directArticles - a.directArticles;
      }

      return b.nestedArticles - a.nestedArticles;
    });

    if (parents.length && parents[0].nestedArticles >= 2) {
      return parents[0].el;
    }

    return articles[articles.length - 1].parentElement || null;
  }

  function initStcInfoLoadMoreV5() {
    var cfg = window.stcInfoLoadMore || window.stcInfoAjax || window.stcInfo || {};

    var ajaxUrl = cfg.ajaxUrl || cfg.url || '/wp-admin/admin-ajax.php';
    var action = cfg.action || 'stc_info_load_more_v5';
    var category = cfg.category || cfg.cat || '830';
    var perPage = parseInt(cfg.perPage || cfg.postsPerPage || 9, 10);

    var button = document.querySelector(
      '[data-stc-info-load-more], .stc-info-load-more, #stc-info-load-more'
    );

    if (!button) {
      debug.lastError = 'Button not found';
      return;
    }

    var grid = findArticlesGrid(button);

    debug.button = button;
    debug.grid = grid;
    debug.insertMode = grid ? 'articles-grid-beforeend' : 'button-beforebegin';

    var nextPage = parseInt(
      button.getAttribute('data-next-page') ||
      button.getAttribute('data-page') ||
      cfg.nextPage ||
      2,
      10
    );

    if (!nextPage || nextPage < 2) {
      nextPage = 2;
    }

    debug.nextPage = nextPage;

    var loading = false;
    var done = false;
    var observer = null;
    var scrollTimer = null;

    function setState(state) {
      button.classList.remove('is-loading', 'is-done', 'is-error');

      if (state === 'loading') {
        button.classList.add('is-loading');
        button.setAttribute('aria-busy', 'true');
        debug.loading = true;
        return;
      }

      button.setAttribute('aria-busy', 'false');
      debug.loading = false;

      if (state === 'done') {
        button.classList.add('is-done');
        button.setAttribute('aria-disabled', 'true');
        debug.done = true;
        return;
      }

      if (state === 'error') {
        button.classList.add('is-error');
      }
    }

    function getData(json) {
      if (!json) {
        return {};
      }

      return json.data || json || {};
    }

    function getHtml(json) {
      var data = getData(json);
      return data.html || data.posts || json.html || json.posts || '';
    }

    function disconnectObserver() {
      if (observer) {
        observer.disconnect();
        observer = null;
      }

      window.removeEventListener('scroll', onScrollFallback);
      window.removeEventListener('resize', onScrollFallback);
    }

    function normalizeInsertedCards(container) {
      if (!container) {
        return;
      }

      Array.prototype.slice.call(container.querySelectorAll('.stc-info-card')).forEach(function (card) {
        card.classList.add('stc-animate', 'stc-visible');
      });
    }

    function insertHtml(html) {
      if (!html || !String(html).trim()) {
        return false;
      }

      if (grid) {
        grid.insertAdjacentHTML('beforeend', html);
        debug.insertMode = 'articles-grid-beforeend';
        normalizeInsertedCards(grid);
        return true;
      }

      button.insertAdjacentHTML('beforebegin', html);
      debug.insertMode = 'button-beforebegin';
      normalizeInsertedCards(button.parentElement);
      return true;
    }

    function loadMore() {
      if (loading || done) {
        return;
      }

      loading = true;
      debug.lastError = null;
      setState('loading');

      var formData = new FormData();
      formData.append('action', action);
      formData.append('page', String(nextPage));
      formData.append('cat', String(category));
      formData.append('category', String(category));
      formData.append('perPage', String(perPage));

      if (cfg.nonce) {
        formData.append('nonce', cfg.nonce);
      }

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
      })
        .then(function (response) {
          if (!response.ok) {
            throw new Error('HTTP ' + response.status);
          }

          return response.json();
        })
        .then(function (json) {
          var data = getData(json);
          var html = getHtml(json);

          debug.lastResponse = data;

          if (!html || !String(html).trim()) {
            done = true;
            setState('done');
            disconnectObserver();
            return;
          }

          insertHtml(html);

          if (data.nextPage) {
            nextPage = parseInt(data.nextPage, 10);
          } else {
            nextPage += 1;
          }

          debug.nextPage = nextPage;
          button.setAttribute('data-next-page', String(nextPage));

          if (
            data.hasMore === false ||
            (data.maxPage && nextPage > parseInt(data.maxPage, 10))
          ) {
            done = true;
            setState('done');
            disconnectObserver();
            return;
          }

          setState('idle');

          setTimeout(function () {
            checkNearButton();
          }, 300);
        })
        .catch(function (error) {
          debug.lastError = error.message || String(error);
          console.error('[STC info load more v5]', error);
          setState('error');
        })
        .finally(function () {
          loading = false;
          debug.loading = false;
        });
    }

    function checkNearButton() {
      if (loading || done) {
        return;
      }

      var rect = button.getBoundingClientRect();
      var distance = rect.top - window.innerHeight;

      if (distance < 700 && rect.bottom > -200) {
        loadMore();
      }
    }

    function onScrollFallback() {
      if (scrollTimer) {
        window.clearTimeout(scrollTimer);
      }

      scrollTimer = window.setTimeout(checkNearButton, 120);
    }

    button.addEventListener('click', function (event) {
      event.preventDefault();
      loadMore();
    });

    if ('IntersectionObserver' in window) {
      observer = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              loadMore();
            }
          });
        },
        {
          root: null,
          rootMargin: '700px 0px 700px 0px',
          threshold: 0
        }
      );

      observer.observe(button);
    }

    window.addEventListener('scroll', onScrollFallback, { passive: true });
    window.addEventListener('resize', onScrollFallback);

    debug.ready = true;
    debug.loadMore = loadMore;
    debug.checkNearButton = checkNearButton;
    debug.getNextPage = function () {
      return nextPage;
    };

    setTimeout(checkNearButton, 300);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initStcInfoLoadMoreV5);
  } else {
    initStcInfoLoadMoreV5();
  }
})();
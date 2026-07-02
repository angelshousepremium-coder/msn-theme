// STC info load more v5 final
// WordPress jQuery noConflict-safe.
(function ($) {
  'use strict';

  var cfg = window.stcInfoLoadMore || window.stcInfoAjax || window.stcInfo || {};
  var ajaxUrl = cfg.ajaxUrl || cfg.url || window.ajaxurl || '/wp-admin/admin-ajax.php';
  var action = cfg.action || 'stc_info_load_more_v5';
  var cat = parseInt(cfg.cat || cfg.category || 830, 10) || 830;
  var perPage = parseInt(cfg.perPage || 9, 10) || 9;

  var loading = false;
  var finished = false;
  var page = 1;
  var $grid;
  var $button;
  var $status;
  var observer;

  function getGrid() {
    return $('.stc-info-grid, .stc-info-cards, .stc-info-list, [data-stc-info-grid]').first();
  }

  function getButton() {
    return $('#stc-info-load-more, .stc-info-load-more, [data-stc-info-load-more]').first();
  }

  function getStatus() {
    var $el = $('.stc-info-load-status, [data-stc-info-status]').first();
    if (!$el.length && $button.length) {
      $el = $('<div class="stc-info-load-status" aria-live="polite"></div>').insertAfter($button);
    }
    return $el;
  }

  function collectExistingLinks() {
    var links = Object.create(null);
    $grid.find('.stc-info-card__link[href], article a[href]').each(function () {
      links[this.href] = true;
    });
    return links;
  }

  function appendUnique(html) {
    var existing = collectExistingLinks();
    var $tmp = $('<div/>').html(html || '');
    var $cards = $tmp.find('.stc-info-card');

    if (!$cards.length) {
      $cards = $tmp.children();
    }

    var added = 0;
    $cards.each(function () {
      var $card = $(this);
      var href = $card.find('.stc-info-card__link[href], a[href]').first().prop('href');
      if (href && existing[href]) {
        return;
      }
      if (href) {
        existing[href] = true;
      }
      $grid.append($card);
      added += 1;
    });

    return added;
  }

  function setLoadingState(isLoading) {
    loading = isLoading;
    if ($button.length) {
      $button.prop('disabled', isLoading).toggleClass('is-loading', isLoading);
      $button.text(isLoading ? 'Загружаем…' : 'Показать ещё');
    }
    if ($status.length) {
      $status.text(isLoading ? 'Загружаем материалы…' : '');
    }
  }

  function finish() {
    finished = true;
    if ($button.length) {
      $button.hide();
    }
    if (observer) {
      observer.disconnect();
    }
  }

  function loadNext() {
    if (loading || finished || !$grid.length) {
      return;
    }

    setLoadingState(true);

    $.ajax({
      url: ajaxUrl,
      method: 'POST',
      dataType: 'json',
      data: {
        action: action,
        page: page + 1,
        cat: cat,
        category: cat,
        perPage: perPage,
        nonce: cfg.nonce || ''
      }
    }).done(function (res) {
      if (!res || !res.success || !res.data) {
        throw new Error('Bad AJAX response');
      }

      var data = res.data;
      var html = data.html || data.posts || '';
      var added = appendUnique(html);

      page = parseInt(data.page || (page + 1), 10) || (page + 1);

      if (!data.hasMore || added === 0) {
        finish();
      }
    }).fail(function (xhr) {
      var msg = 'HTTP ' + xhr.status + ': ' + (xhr.responseText || '');
      console.error('[STC info load more v5]', msg);
      if ($status.length) {
        $status.text('Не удалось загрузить материалы. Обновите страницу.');
      }
    }).always(function () {
      setLoadingState(false);
    });
  }

  function setupObserver() {
    if (!$button.length || !('IntersectionObserver' in window)) {
      return;
    }

    observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          loadNext();
        }
      });
    }, {
      root: null,
      rootMargin: '500px 0px',
      threshold: 0
    });

    observer.observe($button[0]);
  }

  function inferPageFromCards() {
    var count = $grid.find('.stc-info-card').length;
    page = Math.max(1, Math.ceil(count / perPage));
  }

  $(function () {
    $grid = getGrid();
    if (!$grid.length) {
      return;
    }

    $button = getButton();
    if (!$button.length) {
      $button = $('<button type="button" id="stc-info-load-more" class="stc-info-load-more">Показать ещё</button>');
      $grid.after($button);
    }

    $status = getStatus();
    inferPageFromCards();

    $button.off('click.stcInfoV5').on('click.stcInfoV5', function (e) {
      e.preventDefault();
      loadNext();
    });

    setupObserver();

    // Если кнопка уже попала в экран при загрузке, догружаем следующую пачку.
    setTimeout(function () {
      var rect = $button[0].getBoundingClientRect();
      if (rect.top < window.innerHeight + 500) {
        loadNext();
      }
    }, 300);
  });
})(jQuery);

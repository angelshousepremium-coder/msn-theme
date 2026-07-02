/**
 * STC AJAX search suggestions
 * WordPress jQuery noConflict-safe.
 */
(function ($) {
    'use strict';

    var cfg = window.stcSearchConfig || {};
    var ajaxUrl = cfg.ajaxUrl || window.ajaxurl || '/wp-admin/admin-ajax.php';
    var minChars = parseInt(cfg.minChars || 2, 10);
    var request = null;
    var timer = null;

    function getWrap($input) {
        return $input.closest('.stc-site-search-wrap');
    }

    function getBox($input) {
        var $wrap = getWrap($input);
        var $box = $wrap.find('[data-stc-search-results]').first();
        if (!$box.length) {
            $box = $('.ajax-search').first();
        }
        return $box;
    }

    function setLoading($input, isLoading) {
        getWrap($input).toggleClass('is-loading', !!isLoading);
    }

    function hideResults($input) {
        var $box = getBox($input);
        $box.removeClass('is-visible').empty();
        setLoading($input, false);
    }

    function showResults($input, html) {
        var $box = getBox($input);
        if (!html) {
            hideResults($input);
            return;
        }
        $box.html(html).addClass('is-visible');
    }

    function runSearch($input) {
        var term = $.trim($input.val() || '');

        if (term.length < minChars) {
            hideResults($input);
            return;
        }

        if (request && request.readyState !== 4) {
            request.abort();
        }

        setLoading($input, true);
        request = $.ajax({
            url: ajaxUrl,
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'stc_ajax_search',
                nonce: cfg.nonce || '',
                term: term
            }
        }).done(function (response) {
            var html = response && response.data ? response.data.html : '';
            showResults($input, html);
        }).fail(function () {
            showResults($input, '<div class="stc-search-suggest__empty">Не удалось выполнить поиск. Попробуйте ещё раз.</div>');
        }).always(function () {
            setLoading($input, false);
        });
    }

    $(document).on('input keyup', '[data-stc-search-input], .search-form__input', function () {
        var input = this;
        clearTimeout(timer);
        timer = setTimeout(function () {
            runSearch($(input));
        }, 220);
    });

    $(document).on('focus', '[data-stc-search-input], .search-form__input', function () {
        var $input = $(this);
        if ($.trim($input.val() || '').length >= minChars) {
            runSearch($input);
        }
    });

    $(document).on('keydown', '[data-stc-search-input], .search-form__input', function (e) {
        if (e.key === 'Escape') {
            hideResults($(this));
        }
    });

    $(document).on('mousedown touchstart', function (e) {
        var $target = $(e.target);
        if (!$target.closest('.stc-site-search-wrap').length) {
            $('.stc-search-suggest').removeClass('is-visible').empty();
        }
    });

})(jQuery);

jQuery(document).ready(function($) {

    function getDirectLinks($tabspr) {
        return $tabspr.children('ul').first().children('.tab-link[data-tab]');
    }

    function switchTab($tabspr, tabId) {
        var $links = getDirectLinks($tabspr);

        $links.removeClass('current');
        $links.filter('[data-tab="' + tabId + '"]').addClass('current');

        // Важно: работаем только с панелями, на которые ссылаются прямые кнопки
        // текущего .tabspr. Не трогаем вложенные .tabspr внутри активной панели.
        $links.each(function() {
            var id = $(this).data('tab');
            if (id) {
                $('#' + id).removeClass('current').hide();
            }
        });

        $('#' + tabId).addClass('current').show();
    }

    $(document)
        .off('click.msnTabsFix', '.tabspr > ul > .tab-link[data-tab]')
        .on('click.msnTabsFix', '.tabspr > ul > .tab-link[data-tab]', function(e) {
            e.preventDefault();

            var tabId = $(this).data('tab');
            var $tabspr = $(this).closest('.tabspr');

            if (!tabId || !$tabspr.length) {
                return;
            }

            switchTab($tabspr, tabId);
        });

    $('.tabspr').each(function() {
        var $tabspr = $(this);
        var $links = getDirectLinks($tabspr);
        var $current = $links.filter('.current').first();
        var firstId = ($current.length ? $current : $links.first()).data('tab');

        if (firstId) {
            switchTab($tabspr, firstId);
        }
    });

});

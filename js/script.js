/**
 * script.js — аналитика отправки CF7 форм
 * Яндекс.Метрика + Google Analytics
 * Грузится на всех страницах (формы есть везде)
 */
jQuery(function ($) {

    $('.wpcf7 form').on('submit', function () {
        var formId = $(this).closest('.wpcf7').attr('id').split('-')[1];

        var goals = {
            'f575':  ['kp_ok',         'kp',       'kp_ok'],
            'f576':  ['lizing_ok',      'lizing',   'lizing_ok'],
            'f479':  ['consult_ok',     'consult',  'consult_ok'],
            'f366':  ['callback_ok',    'callback', 'callback_ok'],
            'f5':    ['zakazat_zvonok', 'send',     'zakazat_zvonok'],
            'f7731': ['oformit_zayavky','send',     'oformit_zayavky'],
        };

        var goal = goals[formId];
        if (!goal) return;

        if (typeof yaCounter52129636 !== 'undefined') {
            yaCounter52129636.reachGoal(goal[0]);
        }
        if (typeof gtag !== 'undefined') {
            gtag('event', goal[2], { event_category: goal[1], event_label: 'form' });
        }
    });

});

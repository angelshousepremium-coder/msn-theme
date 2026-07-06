/**
 * script.js — аналитика успешной отправки Contact Form 7.
 *
 * Срабатывает только после события wpcf7mailsent,
 * то есть после успешной отправки формы, а не при простом submit.
 *
 * Поддержка:
 * - Яндекс.Метрика через yaCounter52129636
 * - Яндекс.Метрика через ym(), если доступна
 * - Google Analytics через gtag()
 */
(function () {
    'use strict';

    var METRIKA_COUNTER_ID = 52129636;

    var goals = {
        575:  ['kp_ok',          'kp',       'kp_ok'],
        576:  ['lizing_ok',      'lizing',   'lizing_ok'],
        479:  ['consult_ok',     'consult',  'consult_ok'],
        366:  ['callback_ok',    'callback', 'callback_ok'],
        5:    ['zakazat_zvonok', 'send',     'zakazat_zvonok'],
        7731: ['oformit_zayavky','send',     'oformit_zayavky']
    };

    function sendYandexGoal(goalName) {
        if (!goalName) {
            return;
        }

        if (typeof window.yaCounter52129636 !== 'undefined' &&
            typeof window.yaCounter52129636.reachGoal === 'function') {
            window.yaCounter52129636.reachGoal(goalName);
            return;
        }

        if (typeof window.ym === 'function') {
            window.ym(METRIKA_COUNTER_ID, 'reachGoal', goalName);
        }
    }

    function sendGoogleGoal(eventName, category) {
        if (!eventName || typeof window.gtag !== 'function') {
            return;
        }

        window.gtag('event', eventName, {
            event_category: category || 'form',
            event_label: 'form'
        });
    }

    document.addEventListener('wpcf7mailsent', function (event) {
        if (!event || !event.detail || !event.detail.contactFormId) {
            return;
        }

        var formId = parseInt(event.detail.contactFormId, 10);
        var goal = goals[formId];

        if (!goal) {
            return;
        }

        sendYandexGoal(goal[0]);
        sendGoogleGoal(goal[2], goal[1]);
    }, false);
})();
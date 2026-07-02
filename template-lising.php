<?php
/**
 * Template Name: template - Лизинг
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-lising.php
 */
defined('ABSPATH') || exit;
get_header();

function stc_lising_breadcrumbs() {
    echo '<div class="stc-page-bc">';
    if ( function_exists('rank_math_the_breadcrumbs') ) {
        rank_math_the_breadcrumbs();
    } elseif ( function_exists('stc_custom_breadcrumbs') ) {
        echo stc_custom_breadcrumbs();
    }
    echo '</div>';
}

$advantages = [
    ['title' => 'Лизинг выгоднее кредита', 'text' => 'Лизинг снижает «закредитованность» баланса, повышает его ликвидность и сохраняет кредитные линии организации для других проектов.'],
    ['title' => 'Налоговые льготы', 'text' => 'Лизинговые платежи относятся на себестоимость, что уменьшает налогооблагаемую базу по налогу на прибыль.'],
    ['title' => 'Удобный график платежей', 'text' => 'График можно адаптировать под сезонность бизнеса и поступление выручки от эксплуатации техники.'],
    ['title' => 'До 75% стоимости техники', 'text' => 'Лизинг позволяет приобретать дорогостоящую технику без единовременного отвлечения значительных средств.'],
    ['title' => 'Сопутствующие услуги', 'text' => 'Регистрация и снятие с учёта, прохождение ТО, страхование имущества, юридическая экспертиза документов.'],
    ['title' => 'Постоянные поставщики', 'text' => 'Клиент может получить выгоды за счёт покупательской способности лизинговой компании: скидки и специальные условия поставки.'],
];
?>

<main id="primary" class="stc-page-modern stc-lising-page">
    <section class="stc-modern-hero stc-modern-hero--image">
        <img class="stc-modern-hero__bg" src="/wp-content/uploads/2024/05/ural-nekst-2016_2017-01-scaled-1.jpg" alt="Лизинговая программа на покупку Урал" loading="eager">
        <div class="stc-modern-container">
            <?php stc_lising_breadcrumbs(); ?>
            <div class="stc-modern-hero__grid">
                <div class="stc-modern-hero__content">
                    <span class="stc-modern-eyebrow">Фирменный лизинг</span>
                    <h1>Грузовые автомобили в лизинг под задачи вашего бизнеса</h1>
                    <p>Лизинг помогает обновить парк, модернизировать предприятие и приобрести технику без единовременного отвлечения крупного объёма собственных средств.</p>
                    <div class="stc-modern-actions">
                        <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Получить расчёт</a>
                        <a class="stc-modern-btn stc-modern-btn--ghost" href="#stc-lising-steps">Как работает</a>
                    </div>
                </div>
                <div class="stc-modern-form-panel">
                    <h3>Заявка на лизинг</h3>
                    <?php
                    if ( class_exists('FrmFormsController') ) {
                        echo FrmFormsController::get_form_shortcode(['id' => 2]);
                    } else {
                        echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section" id="stc-lising-steps">
        <div class="stc-modern-container stc-two-col">
            <div class="stc-section-head stc-section-head--sticky">
                <span class="stc-modern-eyebrow">Суть инструмента</span>
                <h2>Лизинг — альтернатива кредиту для обновления автопарка</h2>
            </div>
            <div class="stc-rich-text">
                <p><strong>Лизинг</strong> — это инвестиционный инструмент, позволяющий не отвлекать единовременно большой объём собственных средств, обновлять основные фонды и приобретать новое оборудование, автотранспорт и технику.</p>
                <p>При использовании лизинга вы получаете долгосрочный заёмный капитал, сохраняете уже имеющиеся банковские кредитные линии и оптимизируете налогооблагаемую базу предприятия.</p>
                <div class="stc-process-card">
                    <h3>Лизинг за 3 дня</h3>
                    <p>Лизинговая компания требует меньший стандартный пакет документов по сравнению с коммерческими банками, что ускоряет процедуру одобрения сделки.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-lising-advantages">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Преимущества</span>
                <h2>Почему лизинг удобен для спецтехники</h2>
            </div>
            <div class="stc-feature-grid">
                <?php foreach ($advantages as $adv) : ?>
                    <article class="stc-feature-card">
                        <span class="stc-feature-card__mark"></span>
                        <h3><?php echo esc_html($adv['title']); ?></h3>
                        <p><?php echo esc_html($adv['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-lising-subjects">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Участники сделки</span>
                <h2>Кто участвует в лизинге</h2>
            </div>
            <div class="stc-three-cards">
                <article><h3>Лизингодатель</h3><p>Юридическое лицо, которое приобретает имущество у продавца и предоставляет его лизингополучателю во временное владение и пользование.</p></article>
                <article><h3>Лизингополучатель</h3><p>Клиент, который выбирает предмет лизинга и принимает его на условиях договора.</p></article>
                <article><h3>Продавец</h3><p>Поставщик, у которого лизингодатель приобретает указанную клиентом технику.</p></article>
            </div>
        </div>
    </section>

    <section class="stc-modern-cta">
        <div class="stc-modern-container stc-modern-cta__inner">
            <div>
                <span class="stc-modern-eyebrow">Подберём условия</span>
                <h2>Рассчитаем технику, аванс и график платежей</h2>
            </div>
            <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Получить консультацию</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

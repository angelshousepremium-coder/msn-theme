<?php
/**
 * Template Name: template - Мобильный сервисный центр
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-mobilecenter.php
 */
defined('ABSPATH') || exit;
get_header();

function stc_mobile_breadcrumbs() {
    echo '<div class="stc-page-bc">';
    if ( function_exists('rank_math_the_breadcrumbs') ) {
        rank_math_the_breadcrumbs();
    } elseif ( function_exists('stc_custom_breadcrumbs') ) {
        echo stc_custom_breadcrumbs();
    }
    echo '</div>';
}

$theme_uri = get_template_directory_uri();
?>

<main id="primary" class="stc-page-modern stc-mobilecenter-page">
    <section class="stc-modern-hero stc-modern-hero--dark">
        <div class="stc-modern-container">
            <?php stc_mobile_breadcrumbs(); ?>
            <div class="stc-modern-hero__grid">
                <div class="stc-modern-hero__content">
                    <span class="stc-modern-eyebrow">Сервис на объекте</span>
                    <h1>Мобильный сервисный центр</h1>
                    <p>В рамках крупных инфраструктурных проектов применён новый подход к обслуживанию авто- и спецтехники: сервисный центр разворачивается непосредственно на строительной площадке клиента.</p>
                    <div class="stc-modern-actions">
                        <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Заказать консультацию</a>
                        <a class="stc-modern-btn stc-modern-btn--ghost" href="/servisnyj-centr">Сервисный центр</a>
                    </div>
                </div>
                <div class="stc-modern-hero__panel">
                    <div class="stc-modern-kpi"><strong>3000+ км</strong><span>протяжённость системы «Сила Сибири»</span></div>
                    <div class="stc-modern-kpi"><strong>до −62 °C</strong><span>экстремальные температуры эксплуатации</span></div>
                    <div class="stc-modern-kpi"><strong>200 ед.</strong><span>техники Урал для подрядных организаций</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section">
        <div class="stc-modern-container stc-two-col">
            <div class="stc-section-head stc-section-head--sticky">
                <span class="stc-modern-eyebrow">Справка</span>
                <h2>Проект в условиях Восточной Сибири</h2>
            </div>
            <div class="stc-rich-text">
                <p><strong>Газопроводная система «Сила Сибири»</strong> протянется больше чем на 3 тысячи километров и соединит Якутский и Иркутский центры газодобычи.</p>
                <p>Система обеспечивает транспортировку голубого топлива в регионы Дальнего Востока России и на экспорт в Китай.</p>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-story-section">
        <div class="stc-modern-container">
            <article class="stc-story-card">
                <div class="stc-story-card__image">
                    <img src="<?php echo esc_url($theme_uri . '/img/mobile1.jpg'); ?>" alt="Мобильный сервисный центр Урал" loading="lazy">
                </div>
                <div class="stc-story-card__text">
                    <span class="stc-modern-eyebrow">Эксплуатация</span>
                    <h2>В мороз и по бездорожью</h2>
                    <p>Значительная часть трассы газопровода прокладывается в условиях бездорожья по малонаселённым труднодоступным территориям Восточной Сибири.</p>
                    <p>Строительно-монтажные работы ведутся в экстремальных природно-климатических условиях: абсолютные минимальные температуры воздуха составляют от минус 62 °C в Республике Саха (Якутия) до минус 41 °C на территории Амурской области.</p>
                    <p>Маршрут проходит через участки с вечномерзлыми и скалистыми грунтами, гористую местность, болота, многочисленные ручьи и речки.</p>
                </div>
            </article>

            <article class="stc-story-card stc-story-card--reverse">
                <div class="stc-story-card__image">
                    <img src="<?php echo esc_url($theme_uri . '/img/mobile2.jpg'); ?>" alt="Техника Урал на проекте" loading="lazy">
                </div>
                <div class="stc-story-card__text">
                    <span class="stc-modern-eyebrow">Техника</span>
                    <h2>«Урал» — универсально и надёжно</h2>
                    <p>Для подрядных организаций автомобильный завод «Урал» поставил около 200 единиц техники: вахтовые автобусы «Урал NEXT» 6×6, ремонтные мастерские, топливозаправщики, трубоплетевозы и бортовые автомобили.</p>
                    <p>Техника оснащена двигателями ЯМЗ-536 мощностью 240–312 л.с. и специальной комплектацией с «северным пакетом» опций для работы в суровом климате.</p>
                    <p>Внедорожные качества автомобилей позволяют строителям добираться до труднодоступных участков местности.</p>
                </div>
            </article>
        </div>
    </section>

    <section class="stc-modern-section stc-service-contract">
        <div class="stc-modern-container">
            <div class="stc-process-card stc-process-card--wide">
                <span class="stc-modern-eyebrow">Сервисный контракт</span>
                <h2>Обслуживание техники без лишних проблем</h2>
                <p>АЗ «Урал» совместно с ООО «ПКФ «Спецтехкомплект» подписали сервисный контракт с генеральным подрядчиком проекта «Сила Сибири» и Чаяндинского НГКМ.</p>
                <p>Комплексный сервисный контракт дал подрядчикам гарантию бесперебойной работы автомобилей, снижение простоев, оптимизацию затрат на обслуживание парка и повышение остаточной стоимости техники.</p>
                <p>Технология развёртывания мобильных сервисных центров непосредственно на площадке клиента позволила оперативно решать вопросы технического обслуживания, гарантийного ремонта и поставки запасных частей.</p>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

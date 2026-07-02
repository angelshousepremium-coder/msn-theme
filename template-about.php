<?php
/**
 * Template Name: STC — О компании
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-about.php
 */
defined('ABSPATH') || exit;
get_header();

function stc_about_breadcrumbs() {
    echo '<div class="stc-page-bc">';
    if ( function_exists('rank_math_the_breadcrumbs') ) {
        rank_math_the_breadcrumbs();
    } elseif ( function_exists('stc_custom_breadcrumbs') ) {
        echo stc_custom_breadcrumbs();
    }
    echo '</div>';
}

$benefits = [
    ['icon' => '/wp-content/uploads/2025/05/2.webp', 'title' => 'Собственное производство', 'text' => 'Полный цикл изготовления фургонов и выдача ЭПТС.'],
    ['icon' => '/wp-content/uploads/2025/05/5.webp', 'title' => 'Гибкая форма оплаты', 'text' => 'Покупка автотехники в лизинг. Простая процедура оформления сделки.'],
    ['icon' => '/wp-content/uploads/2025/05/4.webp', 'title' => 'Собственное конструкторское бюро', 'text' => 'Контроль качества всех производственных процессов изготовления продукции.'],
    ['icon' => '/wp-content/uploads/2025/05/3.webp', 'title' => 'Гарантия качества', 'text' => '2 года гарантии или 100 тыс. км пробега, гарантийное и сервисное обслуживание.'],
    ['icon' => '/wp-content/uploads/2025/05/1.webp', 'title' => 'Точное соблюдение сроков', 'text' => 'Срок изготовления фургона — от 10 дней, автоцистерны — до 30 рабочих дней.'],
];

$certificates = [
    ['image' => '/wp-content/themes/msn/img/webp/Zapchasti2027.webp', 'title' => 'Свидетельство дилера по запчастям'],
    ['image' => '/wp-content/themes/msn/img/webp/TDURALAVTO.webp', 'title' => 'Свидетельство дилера по продаже автомобильной техники'],
    ['image' => '/wp-content/themes/msn/img/webp/RCS-2027.webp', 'title' => 'Сертификат сервисного центра'],
    ['image' => '/wp-content/themes/msn/img/Svidetelstvo-WMI-1-pdf-1-728x1030-1-635x900.jpg', 'title' => 'Свидетельство WMI'],
    ['image' => '/wp-content/themes/msn/img/00196-2-pdf-4-637x900.jpg', 'title' => 'Сертификат одобрения типа транспортного средства'],
    ['image' => '/wp-content/themes/msn/img/Odobrenie-tipa-28.04.202000196.P2-01.jpg', 'title' => 'Одобрение типа транспортного средства 28.04.202000196.Р2-01'],
    ['image' => '/wp-content/themes/msn/img/CDM-KMU.jpg', 'title' => 'Сертификат соответствия на монтаж КМУ'],
];

$thanks = [
    ['image' => '/wp-content/themes/msn/img/webp/Stroidormash.webp', 'title' => 'За участие в благотворительной акции «ФевроМарт» в поддержку социального центра'],
    ['image' => '/wp-content/uploads/2025/07/blagodarstvennoe-pismo-sdm-ot-zakonodatelnogo-sobraniya-sverdl.obl-2025.webp', 'title' => 'За большой вклад в развитие промышленности в Свердловской области'],
];

$hero_bg = 'https://spectechcom.ru/wp-content/uploads/2022/11/6.2-min-1536x709.jpg';
?>

<main id="primary" class="stc-page-modern stc-about-page">
    <section class="stc-modern-hero stc-modern-hero--dark">
        <div class="stc-modern-container">
            <?php stc_about_breadcrumbs(); ?>
            <div class="stc-modern-hero__grid">
                <div class="stc-modern-hero__content">
                    <span class="stc-modern-eyebrow">Группа компаний «Спецтехкомплект»</span>
                    <h1>Производим, продаём и обслуживаем спецтехнику на базе автомобилей Урал</h1>
                    <p>Спецтехкомплект — это единый производственный комплекс: разработка, изготовление, сборка автотехники, продажа готовой продукции, поставка запасных частей и сервисное сопровождение.</p>
                    <div class="stc-modern-actions">
                        <a class="stc-modern-btn stc-modern-btn--primary" href="/tehnika-v-nalichii/">Смотреть технику</a>
                        <a class="stc-modern-btn stc-modern-btn--ghost popup-with-form" href="#test-form1">Получить консультацию</a>
                    </div>
                </div>
                <div class="stc-modern-hero__image"
                     style="--stc-about-hero-bg: url('<?php echo esc_url($hero_bg); ?>');"
                     role="img"
                     aria-label="Производственный комплекс Спецтехкомплект">
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-about-intro">
        <div class="stc-modern-container stc-two-col">
            <div class="stc-section-head stc-section-head--sticky">
                <span class="stc-modern-eyebrow">О компании</span>
                <h2>25 лет в спецтехнике</h2>
            </div>
            <div class="stc-rich-text">
                <p>Сегодня Спецтехкомплект — это группа компаний, которая <strong>25 лет</strong> производит, продаёт и обслуживает спецтехнику на базе автомобилей Урал.</p>
                <p><strong>Арамильский завод «Стройдормаш»</strong> производит спецтехнику для строительного, энергетического, нефтегазового и коммунального сектора, которая успешно работает в различных климатических условиях.</p>
                <p><strong>ООО «Торговый Дом «Урал Авто»</strong> имеет статус официального дилера автомобильного завода Урал по продаже автомобильной техники и запасных частей.</p>
                <p><strong>Региональный сервисный центр «УРАЛ»</strong> предлагает услуги по капитальному ремонту и сервисному обслуживанию спецтехники марки Урал всех модификаций.</p>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-benefits-section">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Почему выбирают нас</span>
                <h2>Полный цикл: от проекта до сервиса</h2>
            </div>
            <div class="stc-benefits-layout">
                <div class="stc-benefits-image"><img src="/wp-content/uploads/2025/06/img-kopiya-2.webp" alt="Спецтехкомплект" loading="lazy"></div>
                <div class="stc-benefits-grid">
                    <?php foreach ($benefits as $benefit) : ?>
                        <article class="stc-benefit-card">
                            <img src="<?php echo esc_url($benefit['icon']); ?>" alt="" loading="lazy">
                            <h3><?php echo esc_html($benefit['title']); ?></h3>
                            <p><?php echo esc_html($benefit['text']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-docs-section">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Документы</span>
                <h2>Свидетельства и сертификаты</h2>
                <p>Документы открываются в полном размере по клику.</p>
            </div>
            <div class="stc-docs-grid zoom-gallery">
                <?php foreach ($certificates as $doc) : ?>
                    <a class="stc-doc-card" href="<?php echo esc_url($doc['image']); ?>" aria-label="Открыть документ: <?php echo esc_attr($doc['title']); ?>">
                        <span class="stc-doc-card__image"><img src="<?php echo esc_url($doc['image']); ?>" alt="<?php echo esc_attr($doc['title']); ?>" loading="lazy"></span>
                        <span class="stc-doc-card__title"><?php echo esc_html($doc['title']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-docs-section stc-docs-section--muted">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Благодарности</span>
                <h2>Социальные и отраслевые проекты</h2>
            </div>
            <div class="stc-docs-grid stc-docs-grid--small zoom-gallery">
                <?php foreach ($thanks as $doc) : ?>
                    <a class="stc-doc-card" href="<?php echo esc_url($doc['image']); ?>" aria-label="Открыть документ: <?php echo esc_attr($doc['title']); ?>">
                        <span class="stc-doc-card__image"><img src="<?php echo esc_url($doc['image']); ?>" alt="<?php echo esc_attr($doc['title']); ?>" loading="lazy"></span>
                        <span class="stc-doc-card__title"><?php echo esc_html($doc['title']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stc-modern-section stc-production-section" id="proizvodstvo">
        <div class="stc-modern-container">
            <div class="stc-section-head stc-section-head--center">
                <span class="stc-modern-eyebrow">Сервис и производство</span>
                <h2>Собственный Региональный Сервисный Центр «Урал»</h2>
                <p>Обеспечиваем полное гарантийное техническое обслуживание автотехники в собственном Региональном Сервисном Центре «Урал» в городе Арамиле Свердловской области.</p>
            </div>
            <figure class="stc-wide-image">
                <img src="https://spectechcom.ru/wp-content/uploads/2021/08/dscf41452.jpg" alt="Производственные мощности" loading="lazy">
                <figcaption>Производственные мощности</figcaption>
            </figure>
            <div class="stc-production-grid">
                <article>
                    <h3>Арамильский завод «СТРОЙДОРМАШ»</h3>
                    <ul>
                        <li>современный цех площадью 1152 кв.м.;</li>
                        <li>станочный парк, в том числе токарные и фрезерные станки;</li>
                        <li>сварочное оборудование;</li>
                        <li>покрасочная камера;</li>
                        <li>моечный комплекс.</li>
                    </ul>
                </article>
                <article>
                    <h3>Сертифицированные специалисты</h3>
                    <ul>
                        <li>навесное оборудование нестандартных конструкций;</li>
                        <li>каркасные фургоны различного назначения;</li>
                        <li>лесовозные и сортиментовозные площадки;</li>
                        <li>металловозные бункеры;</li>
                        <li>самосвальные и бортовые платформы;</li>
                        <li>усиленные подрамники для монтажа КМУ;</li>
                        <li>на все виды работ имеются сертификаты и лицензии.</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

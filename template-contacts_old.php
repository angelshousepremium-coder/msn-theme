<?php
/**
 * Template Name: Контакты
 * Template Post Type: page
 *
 * Путь: /wp-content/themes/msn/template-contacts.php
 */
defined('ABSPATH') || exit;

get_header();

$theme_uri = get_template_directory_uri();

$main_phones = [
    ['label' => '8 (800) 600-41-42', 'tel' => '88006004142', 'note' => 'бесплатно по России'],
    ['label' => '8 (343) 344-41-42', 'tel' => '83433444142', 'note' => 'Екатеринбург'],
    ['label' => '8 (343) 214-41-42', 'tel' => '83432144142', 'note' => 'отдел продаж'],
    ['label' => '8 (343) 214-41-43', 'tel' => '83432144143', 'note' => 'дополнительный'],
];

$managers = [
    [
        'role'  => 'Начальник отдела продаж',
        'name'  => 'Антон Сергеевич',
        'email' => 'Soldatov@spectechcom.ru',
        'phone' => '8 (800) 600-41-42 (доб. 116)',
        'tel'   => '88006004142',
    ],
    [
        'role'  => 'Менеджер по продажам',
        'name'  => 'Дмитрий Константинович',
        'email' => 'Bdk@spectechcom.ru',
        'phone' => '8 (800) 600-41-42 (доб. 114)',
        'tel'   => '88006004142',
    ],
    [
        'role'  => 'Менеджер по продажам',
        'name'  => 'Сергей Максимович',
        'email' => 'rsm@spectechcom.ru',
        'phone' => '8 (800) 600-41-42 (доб. 115)',
        'tel'   => '88006004142',
    ],
    [
        'role'  => 'Отдел запчастей',
        'name'  => 'Запчасти и комплектующие',
        'email' => 'o.stavceva@bk.ru',
        'phone' => '(343) 241-41-42 · (3513) 26-40-94',
        'tel'   => '83432414142',
        'note'  => 'доб. 150, 151, 152',
    ],
];

$branches = [
    [
        'city'    => 'г. Миасс',
        'title'   => 'Директор: Силин Илья',
        'address' => 'Челябинская обл., г. Миасс, ул. Готвальда, 1/1А',
        'email'   => 'tranzitavtogrupp@mail.ru',
        'phones'  => [
            ['label' => '8 (3513) 28-79-60', 'tel' => '83513287960'],
            ['label' => '8 (3513) 28-79-61', 'tel' => '83513287961'],
        ],
    ],
    [
        'city'    => 'г. Оренбург',
        'title'   => 'Директор филиала: Краснов Владимир',
        'address' => 'г. Оренбург, ул. Беляевская, 30',
        'email'   => 'stk-oren@mail.ru',
        'phones'  => [
            ['label' => '(3532) 68-54-09', 'tel' => '83532685409'],
        ],
    ],
    [
        'city'    => 'г. Пермь',
        'title'   => 'Директор филиала: Мальцев Тимофей',
        'address' => 'г. Пермь, шоссе Космонавтов, д. 393/Б',
        'email'   => 'tima-pm@mail.ru',
        'phones'  => [
            ['label' => '(342) 201-77-70', 'tel' => '83422017770'],
        ],
    ],
    [
        'city'    => 'г. Якутск',
        'title'   => 'Директор: Волков Евгений',
        'address' => 'ООО «Якутмоторсервис», г. Якутск, ул. Ушакова, 15',
        'email'   => 'torg@y-m-s.ru',
        'phones'  => [
            ['label' => '(4112) 43-00-80', 'tel' => '84112430080'],
            ['label' => '43-00-90', 'tel' => '84112430090'],
        ],
        'site' => 'http://y-m-s.ru/',
    ],
];

$benefits = [
    [
        'icon'  => $theme_uri . '/img/icons8-maintenance-100.png',
        'title' => 'Гарантийный сервис',
        'text'  => 'Бесплатный сервис весь гарантийный срок',
    ],
    [
        'icon'  => $theme_uri . '/img/icons8-stacking-100.png',
        'title' => 'Склад запчастей',
        'text'  => 'Сформированный склад запчастей постоянного спроса',
    ],
    [
        'icon'  => $theme_uri . '/img/icons8-in-transit-100.png',
        'title' => 'Доставка по России',
        'text'  => 'Возможна бесплатная доставка техники по России',
    ],
];
?>

<style id="stc-contacts-page-css">
.stc-contacts-page {
    --stc-contact-ink: #111111;
    --stc-contact-muted: #686e73;
    --stc-contact-soft: #f5f5f7;
    --stc-contact-border: #e6e6e9;
    --stc-contact-orange: var(--color-orange, #ec621f);
    --stc-contact-orange-dark: var(--color-orange-dark, #d4541a);
    --stc-contact-radius: 22px;
    background: #fff;
    color: var(--stc-contact-ink);
    overflow: hidden;
}
.stc-contacts-page * { box-sizing: border-box; }
.stc-contact-container {
    width: 100%;
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 32px;
}
.stc-contact-breadcrumbs {
    padding: 18px 0 6px;
    font-size: 12px;
    color: var(--stc-contact-muted);
}
.stc-contact-hero {
    padding: 28px 0 34px;
    border-bottom: 1px solid var(--stc-contact-border);
    background:
        radial-gradient(circle at 88% 18%, rgba(236,98,31,.12), transparent 28%),
        linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
}
.stc-contact-hero__grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 390px;
    gap: 28px;
    align-items: stretch;
}
.stc-contact-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 16px;
    color: var(--stc-contact-orange);
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .12em;
    text-transform: uppercase;
}
.stc-contact-eyebrow::before {
    content: "";
    width: 30px;
    height: 2px;
    background: currentColor;
}
.stc-contact-title {
    max-width: 760px;
    margin: 0;
    color: var(--stc-contact-ink);
    font-family: var(--font-heading, Montserrat, sans-serif) !important;
    font-size: clamp(34px, 5vw, 64px) !important;
    line-height: .98 !important;
    letter-spacing: -.05em;
    font-weight: 900 !important;
}
.stc-contact-lead {
    max-width: 720px;
    margin: 20px 0 0;
    color: var(--stc-contact-muted);
    font-size: 17px;
    line-height: 1.7;
}
.stc-contact-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 24px;
}
.stc-contact-pill {
    display: inline-flex;
    align-items: center;
    min-height: 34px;
    padding: 7px 13px;
    border: 1px solid var(--stc-contact-border);
    border-radius: 999px;
    background: #fff;
    color: var(--stc-contact-ink);
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 12px;
    font-weight: 700;
}
.stc-contact-card {
    background: #111;
    color: #fff;
    border-radius: var(--stc-contact-radius);
    padding: 28px;
    box-shadow: 0 20px 70px rgba(0,0,0,.16);
    position: relative;
    overflow: hidden;
}
.stc-contact-card::before {
    content: "";
    position: absolute;
    inset: auto -30px -70px auto;
    width: 210px;
    height: 210px;
    background: radial-gradient(circle, rgba(236,98,31,.55), transparent 68%);
    pointer-events: none;
}
.stc-contact-card__label {
    position: relative;
    z-index: 1;
    margin: 0 0 12px;
    color: rgba(255,255,255,.62);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
}
.stc-contact-card__phone {
    position: relative;
    z-index: 1;
    display: block;
    color: #fff !important;
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 28px;
    font-weight: 900;
    line-height: 1.15;
    text-decoration: none;
}
.stc-contact-card__phone:hover { color: #fff !important; opacity: .86; }
.stc-contact-card__text {
    position: relative;
    z-index: 1;
    margin: 12px 0 0;
    color: rgba(255,255,255,.74);
    line-height: 1.65;
    font-size: 14px;
}
.stc-contact-card__actions {
    position: relative;
    z-index: 1;
    display: grid;
    gap: 10px;
    margin-top: 24px;
}
.stc-contact-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 46px;
    padding: 12px 18px;
    border-radius: 999px;
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 13px;
    font-weight: 800;
    text-decoration: none !important;
    transition: transform .18s, background .18s, border-color .18s, color .18s;
}
.stc-contact-btn:hover { transform: translateY(-1px); }
.stc-contact-btn--primary {
    background: var(--stc-contact-orange);
    color: #fff !important;
}
.stc-contact-btn--primary:hover {
    background: var(--stc-contact-orange-dark);
    color: #fff !important;
}
.stc-contact-btn--ghost {
    background: transparent;
    border: 1px solid rgba(255,255,255,.24);
    color: #fff !important;
}
.stc-contact-btn--light {
    background: #fff;
    color: var(--stc-contact-ink) !important;
    border: 1px solid var(--stc-contact-border);
}
.stc-contact-section { padding: 72px 0; }
.stc-contact-section--soft { background: var(--stc-contact-soft); }
.stc-contact-section__head {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 28px;
}
.stc-contact-section__kicker {
    display: block;
    margin-bottom: 8px;
    color: var(--stc-contact-orange);
    font-size: 11px;
    font-weight: 900;
    letter-spacing: .14em;
    text-transform: uppercase;
}
.stc-contact-section__title {
    margin: 0;
    color: var(--stc-contact-ink);
    font-family: var(--font-heading, Montserrat, sans-serif) !important;
    font-size: clamp(26px, 3vw, 42px) !important;
    font-weight: 900 !important;
    line-height: 1.08 !important;
    letter-spacing: -.04em;
}
.stc-contact-section__text {
    max-width: 450px;
    margin: 0;
    color: var(--stc-contact-muted);
    line-height: 1.65;
}
.stc-contact-map-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 380px;
    gap: 22px;
    align-items: stretch;
}
.stc-contact-map {
    min-height: 520px;
    border-radius: var(--stc-contact-radius);
    overflow: hidden;
    background: #ddd;
    border: 1px solid var(--stc-contact-border);
    box-shadow: 0 12px 44px rgba(0,0,0,.08);
}
.stc-contact-map iframe {
    display: block;
    width: 100%;
    height: 100%;
    border: 0;
}
.stc-contact-info-panel {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 24px;
    border: 1px solid var(--stc-contact-border);
    border-radius: var(--stc-contact-radius);
    background: #fff;
}
.stc-contact-info-row {
    padding: 0 0 14px;
    border-bottom: 1px solid var(--stc-contact-border);
}
.stc-contact-info-row:last-child { border-bottom: 0; padding-bottom: 0; }
.stc-contact-info-row__label {
    display: block;
    margin-bottom: 4px;
    color: var(--stc-contact-muted);
    font-size: 11px;
    font-weight: 900;
    letter-spacing: .1em;
    text-transform: uppercase;
}
.stc-contact-info-row__value,
.stc-contact-info-row__value p {
    margin: 0;
    color: var(--stc-contact-ink);
    font-size: 15px;
    line-height: 1.65;
    font-weight: 650;
}
.stc-contact-info-row a { color: var(--stc-contact-orange); font-weight: 800; }
.stc-contact-phone-list {
    display: grid;
    gap: 8px;
    margin-top: 4px;
}
.stc-contact-phone-item {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 9px 0;
    border-bottom: 1px dashed var(--stc-contact-border);
}
.stc-contact-phone-item:last-child { border-bottom: 0; }
.stc-contact-phone-item a {
    color: var(--stc-contact-ink) !important;
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-weight: 900;
}
.stc-contact-phone-item span {
    color: var(--stc-contact-muted);
    font-size: 12px;
    text-align: right;
}
.stc-contact-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}
.stc-contact-person,
.stc-contact-branch {
    min-height: 100%;
    padding: 22px;
    border: 1px solid var(--stc-contact-border);
    border-radius: 18px;
    background: #fff;
    transition: transform .18s, box-shadow .18s, border-color .18s;
}
.stc-contact-person:hover,
.stc-contact-branch:hover {
    transform: translateY(-2px);
    border-color: rgba(236,98,31,.34);
    box-shadow: 0 14px 40px rgba(0,0,0,.08);
}
.stc-contact-person__role,
.stc-contact-branch__city {
    display: inline-flex;
    margin-bottom: 14px;
    color: var(--stc-contact-orange);
    font-size: 11px;
    font-weight: 900;
    letter-spacing: .08em;
    text-transform: uppercase;
}
.stc-contact-person__name,
.stc-contact-branch__title {
    margin: 0 0 14px;
    color: var(--stc-contact-ink);
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 18px;
    font-weight: 900;
    line-height: 1.22;
}
.stc-contact-meta {
    display: grid;
    gap: 7px;
    margin: 0;
    color: var(--stc-contact-muted);
    font-size: 14px;
    line-height: 1.55;
}
.stc-contact-meta a {
    color: var(--stc-contact-ink);
    font-weight: 800;
    overflow-wrap: anywhere;
}
.stc-contact-service {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    gap: 22px;
    align-items: center;
    margin-top: 22px;
    padding: 28px;
    border-radius: var(--stc-contact-radius);
    background: #111;
    color: #fff;
}
.stc-contact-service h3 {
    margin: 0 0 10px;
    color: #fff;
    font-family: var(--font-heading, Montserrat, sans-serif) !important;
    font-size: 24px !important;
    font-weight: 900;
}
.stc-contact-service p {
    margin: 0;
    color: rgba(255,255,255,.75);
    line-height: 1.65;
}
.stc-contact-service a { color: #fff; font-weight: 800; }
.stc-contact-cta {
    display: grid;
    grid-template-columns: minmax(0, .95fr) minmax(0, 1.05fr);
    gap: 22px;
    align-items: stretch;
}
.stc-contact-cta__panel {
    padding: 34px;
    border-radius: var(--stc-contact-radius);
    background: #111;
    color: #fff;
    overflow: hidden;
    position: relative;
}
.stc-contact-cta__panel::after {
    content: "";
    position: absolute;
    inset: auto -90px -120px auto;
    width: 320px;
    height: 320px;
    background: radial-gradient(circle, rgba(236,98,31,.5), transparent 66%);
}
.stc-contact-cta__panel > * { position: relative; z-index: 1; }
.stc-contact-cta h2 {
    margin: 0;
    color: #fff;
    font-family: var(--font-heading, Montserrat, sans-serif) !important;
    font-size: clamp(26px, 3vw, 42px) !important;
    font-weight: 900 !important;
    line-height: 1.08 !important;
}
.stc-contact-cta p {
    margin: 16px 0 0;
    color: rgba(255,255,255,.72);
    line-height: 1.65;
}
.stc-contact-benefits {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    margin-top: 26px;
}
.stc-contact-benefit {
    display: grid;
    grid-template-columns: 46px 1fr;
    gap: 13px;
    align-items: center;
    padding: 12px;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 16px;
    background: rgba(255,255,255,.06);
}
.stc-contact-benefit img {
    width: 38px;
    height: 38px;
    object-fit: contain;
}
.stc-contact-benefit strong {
    display: block;
    color: #fff;
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 14px;
    line-height: 1.25;
}
.stc-contact-benefit span {
    display: block;
    margin-top: 2px;
    color: rgba(255,255,255,.66);
    font-size: 13px;
    line-height: 1.4;
}
.stc-contact-form {
    padding: 28px;
    border: 1px solid var(--stc-contact-border);
    border-radius: var(--stc-contact-radius);
    background: #fff;
    box-shadow: 0 12px 44px rgba(0,0,0,.06);
}
.stc-contact-form__title {
    margin: 0 0 16px;
    color: var(--stc-contact-ink);
    font-family: var(--font-heading, Montserrat, sans-serif);
    font-size: 22px;
    font-weight: 900;
}
.stc-contact-form .wpcf7,
.stc-contact-form form { margin: 0; }
.stc-contact-form input[type="text"],
.stc-contact-form input[type="tel"],
.stc-contact-form input[type="email"],
.stc-contact-form textarea {
    width: 100% !important;
    min-height: 46px;
    border: 1px solid var(--stc-contact-border) !important;
    border-radius: 12px !important;
    padding: 12px 14px !important;
    background: #f8f8f8 !important;
    color: var(--stc-contact-ink) !important;
    box-shadow: none !important;
}
.stc-contact-form input[type="submit"],
.stc-contact-form button[type="submit"] {
    width: 100%;
    min-height: 48px;
    border: 0 !important;
    border-radius: 999px !important;
    background: var(--stc-contact-orange) !important;
    color: #fff !important;
    font-family: var(--font-heading, Montserrat, sans-serif) !important;
    font-size: 13px !important;
    font-weight: 900 !important;
    cursor: pointer;
}
.stc-contact-form input[type="submit"]:hover,
.stc-contact-form button[type="submit"]:hover { background: var(--stc-contact-orange-dark) !important; }
.stc-contact-reviews {
    display: grid;
    grid-template-columns: 320px minmax(0, 1fr);
    gap: 22px;
    align-items: stretch;
}
.stc-contact-reviews__image,
.stc-contact-reviews__widget {
    border-radius: var(--stc-contact-radius);
    background: #fff;
    border: 1px solid var(--stc-contact-border);
    overflow: hidden;
    box-shadow: 0 12px 44px rgba(0,0,0,.06);
}
.stc-contact-reviews__image {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 28px;
}
.stc-contact-reviews__image img {
    max-width: 100%;
    height: auto;
    display: block;
}
.stc-contact-reviews__widget {
    min-height: 620px;
    position: relative;
}
.stc-contact-reviews__widget iframe {
    display: block;
    width: 100%;
    height: 620px;
    border: 0;
}
.stc-contact-widget-link {
    box-sizing: border-box;
    text-decoration: none;
    color: #b3b3b3;
    font-size: 10px;
    font-family: Arial, sans-serif;
    padding: 0 20px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
    left: 0;
}
@media (max-width: 1100px) {
    .stc-contact-hero__grid,
    .stc-contact-map-grid,
    .stc-contact-cta,
    .stc-contact-reviews { grid-template-columns: 1fr; }
    .stc-contact-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .stc-contact-map { min-height: 420px; }
}
@media (max-width: 700px) {
    .stc-contact-container { padding: 0 18px; }
    .stc-contact-hero { padding-top: 18px; }
    .stc-contact-card,
    .stc-contact-info-panel,
    .stc-contact-person,
    .stc-contact-branch,
    .stc-contact-cta__panel,
    .stc-contact-form { padding: 20px; }
    .stc-contact-section { padding: 46px 0; }
    .stc-contact-section__head { display: block; }
    .stc-contact-section__text { margin-top: 12px; }
    .stc-contact-grid { grid-template-columns: 1fr; }
    .stc-contact-service { grid-template-columns: 1fr; }
    .stc-contact-phone-item { display: block; }
    .stc-contact-phone-item span { display: block; text-align: left; margin-top: 2px; }
    .stc-contact-reviews__widget,
    .stc-contact-reviews__widget iframe { min-height: 560px; height: 560px; }
}
</style>

<main id="primary" class="stc-contacts-page">

    <div class="stc-contact-container">
        <div class="stc-contact-breadcrumbs">
            <?php
            if ( function_exists('rank_math_the_breadcrumbs') ) {
                rank_math_the_breadcrumbs();
            } elseif ( shortcode_exists('stc_breadcrumbs') ) {
                echo do_shortcode('[stc_breadcrumbs]');
            }
            ?>
        </div>
    </div>

    <section class="stc-contact-hero">
        <div class="stc-contact-container">
            <div class="stc-contact-hero__grid">
                <div>
                    <span class="stc-contact-eyebrow">Контакты</span>
                    <h1 class="stc-contact-title">Группа компаний СПЕЦТЕХКОМПЛЕКТ</h1>
                    <p class="stc-contact-lead">
                        Продажа, производство, сервис и поставка спецтехники Урал. Центральный офис находится в Екатеринбурге, филиалы и партнёрские подразделения работают в регионах России.
                    </p>
                    <div class="stc-contact-pills" aria-label="Преимущества">
                        <span class="stc-contact-pill">Официальный дилер Урал</span>
                        <span class="stc-contact-pill">Сервисный центр</span>
                        <span class="stc-contact-pill">Запчасти в наличии</span>
                        <span class="stc-contact-pill">Доставка по России</span>
                    </div>
                </div>

                <aside class="stc-contact-card" aria-label="Основной контакт">
                    <p class="stc-contact-card__label">Единый номер</p>
                    <a class="stc-contact-card__phone" href="tel:88006004142">8-800-600-41-42</a>
                    <p class="stc-contact-card__text">
                        Звонок по России бесплатный. Ответим на вопросы по технике, наличию, лизингу, сервису и запасным частям.
                    </p>
                    <div class="stc-contact-card__actions">
                        <a class="stc-contact-btn stc-contact-btn--primary" href="#stc-contact-form">Заказать обратный звонок</a>
                        <a class="stc-contact-btn stc-contact-btn--ghost" href="mailto:office@spectechcom.ru">office@spectechcom.ru</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="stc-contact-section">
        <div class="stc-contact-container">
            <div class="stc-contact-section__head">
                <div>
                    <span class="stc-contact-section__kicker">Центральный офис</span>
                    <h2 class="stc-contact-section__title">Екатеринбург</h2>
                </div>
                <p class="stc-contact-section__text">Приезжайте в офис или свяжитесь с нами любым удобным способом.</p>
            </div>

            <div class="stc-contact-map-grid">
                <div class="stc-contact-map">
                    <iframe src="https://yandex.ru/map-widget/v1/-/CSW6I4p5" allowfullscreen="true" loading="lazy"></iframe>
                </div>

                <aside class="stc-contact-info-panel">
                    <div class="stc-contact-info-row">
                        <span class="stc-contact-info-row__label">Адрес</span>
                        <div class="stc-contact-info-row__value">
                            <p>г. Екатеринбург, ул. Ткачей 23,<br>Бизнес-центр Clever park, офис 22-04</p>
                        </div>
                    </div>

                    <div class="stc-contact-info-row">
                        <span class="stc-contact-info-row__label">Телефоны</span>
                        <div class="stc-contact-phone-list">
                            <?php foreach ( $main_phones as $phone ) : ?>
                                <div class="stc-contact-phone-item">
                                    <a href="tel:<?php echo esc_attr($phone['tel']); ?>"><?php echo esc_html($phone['label']); ?></a>
                                    <span><?php echo esc_html($phone['note']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="stc-contact-info-row">
                        <span class="stc-contact-info-row__label">E-mail</span>
                        <div class="stc-contact-info-row__value">
                            <a href="mailto:office@spectechcom.ru">office@spectechcom.ru</a>
                        </div>
                    </div>

                    <div class="stc-contact-info-row">
                        <span class="stc-contact-info-row__label">Часы работы</span>
                        <div class="stc-contact-info-row__value">
                            <p>ПН.- ПТ. с 8:30 до 17:30<br>СБ.- ВС. Выходной</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="stc-contact-section stc-contact-section--soft">
        <div class="stc-contact-container">
            <div class="stc-contact-section__head">
                <div>
                    <span class="stc-contact-section__kicker">Команда</span>
                    <h2 class="stc-contact-section__title">Отделы продаж и запчастей</h2>
                </div>
                <p class="stc-contact-section__text">Контакты специалистов для подбора техники, комплектации, расчёта коммерческого предложения и заказа запчастей.</p>
            </div>

            <div class="stc-contact-grid">
                <?php foreach ( $managers as $manager ) : ?>
                    <article class="stc-contact-person">
                        <span class="stc-contact-person__role"><?php echo esc_html($manager['role']); ?></span>
                        <h3 class="stc-contact-person__name"><?php echo esc_html($manager['name']); ?></h3>
                        <div class="stc-contact-meta">
                            <span>E-mail: <a href="mailto:<?php echo esc_attr($manager['email']); ?>"><?php echo esc_html($manager['email']); ?></a></span>
                            <span>Тел: <a href="tel:<?php echo esc_attr($manager['tel']); ?>"><?php echo esc_html($manager['phone']); ?></a></span>
                            <?php if ( ! empty($manager['note']) ) : ?><span><?php echo esc_html($manager['note']); ?></span><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="stc-contact-service">
                <div>
                    <h3>Региональный сервисный центр «Урал»</h3>
                    <p>
                        Свердловская обл., г. Арамиль, Новая ул., 25<br>
                        E-mail: <a href="mailto:rscural@mail.ru">rscural@mail.ru</a> · Тел: <a href="tel:83433836308">(343) 383-63-08</a>, <a href="tel:83437430724">(34374) 30-7-24</a>
                    </p>
                </div>
                <a class="stc-contact-btn stc-contact-btn--primary" target="_blank" rel="noopener" href="https://rscural.ru/">Перейти на сайт</a>
            </div>
        </div>
    </section>

    <section class="stc-contact-section">
        <div class="stc-contact-container">
            <div class="stc-contact-section__head">
                <div>
                    <span class="stc-contact-section__kicker">География</span>
                    <h2 class="stc-contact-section__title">Филиалы и партнёры</h2>
                </div>
                <p class="stc-contact-section__text">Региональные контакты для оперативной связи по технике, сервису и поставкам.</p>
            </div>

            <div class="stc-contact-grid">
                <?php foreach ( $branches as $branch ) : ?>
                    <article class="stc-contact-branch">
                        <span class="stc-contact-branch__city"><?php echo esc_html($branch['city']); ?></span>
                        <h3 class="stc-contact-branch__title"><?php echo esc_html($branch['title']); ?></h3>
                        <div class="stc-contact-meta">
                            <span><?php echo esc_html($branch['address']); ?></span>
                            <span>E-mail: <a href="mailto:<?php echo esc_attr($branch['email']); ?>"><?php echo esc_html($branch['email']); ?></a></span>
                            <?php foreach ( $branch['phones'] as $phone ) : ?>
                                <span>Тел: <a href="tel:<?php echo esc_attr($phone['tel']); ?>"><?php echo esc_html($phone['label']); ?></a></span>
                            <?php endforeach; ?>
                            <?php if ( ! empty($branch['site']) ) : ?>
                                <span><a target="_blank" rel="noopener" href="<?php echo esc_url($branch['site']); ?>">Сайт филиала</a></span>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stc-contact-section stc-contact-section--soft" id="stc-contact-form">
        <div class="stc-contact-container">
            <div class="stc-contact-cta">
                <div class="stc-contact-cta__panel">
                    <h2>Задайте вопрос специалисту</h2>
                    <p>Оставьте телефон — менеджер свяжется с вами, уточнит задачу и подскажет оптимальное решение по технике, сервису или запчастям.</p>

                    <div class="stc-contact-benefits">
                        <?php foreach ( $benefits as $benefit ) : ?>
                            <div class="stc-contact-benefit">
                                <img src="<?php echo esc_url($benefit['icon']); ?>" alt="" loading="lazy">
                                <div>
                                    <strong><?php echo esc_html($benefit['title']); ?></strong>
                                    <span><?php echo esc_html($benefit['text']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="stc-contact-form">
                    <h3 class="stc-contact-form__title">Заказать обратный звонок</h3>
                    <?php echo do_shortcode('[contact-form-7 id="612e1f9" title="Закажите обратный звонок со страницы Контакты"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-contact-section">
        <div class="stc-contact-container">
            <div class="stc-contact-section__head">
                <div>
                    <span class="stc-contact-section__kicker">Отзывы</span>
                    <h2 class="stc-contact-section__title">Отзывы о нас</h2>
                </div>
                <p class="stc-contact-section__text">Рейтинг и отзывы клиентов на Яндекс Картах.</p>
            </div>

            <div class="stc-contact-reviews">
                <div class="stc-contact-reviews__image">
                    <img src="<?php echo esc_url($theme_uri . '/img/otzivi-spectechcom.png'); ?>" alt="Отзывы клиентов" loading="lazy">
                </div>
                <div class="stc-contact-reviews__widget">
                    <iframe src="https://yandex.ru/maps-reviews-widget/1028101743?comments" loading="lazy"></iframe>
                    <a class="stc-contact-widget-link" href="https://yandex.ru/maps/org/spetstekhkomplekt/1028101743/" target="_blank" rel="noopener">Спецтехкомплект на карте Екатеринбурга — Яндекс.Карты</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

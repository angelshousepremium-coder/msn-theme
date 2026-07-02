<?php
/**
 * archive-product.php
 * Путь: /wp-content/themes/msn/archive-product.php
 */
defined('ABSPATH') || exit;

get_header('shop');
do_action('woocommerce_before_main_content');

$nav_cats = get_terms([
    'taxonomy'   => 'product_cat',
    'parent'     => 0,
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
    'number'     => 40,
]);

$current_term  = get_queried_object();
$current_id    = ($current_term instanceof WP_Term) ? $current_term->term_id : 0;
$parent_id     = ($current_term instanceof WP_Term) ? $current_term->parent   : 0;
$term          = $current_term;
$subcats       = ($term instanceof WP_Term) ? get_field('subcategory', $term) : [];
$sub_count     = is_array($subcats) ? count($subcats) : 0;
$cat_desc_html = ($term instanceof WP_Term) ? term_description($term->term_id, 'product_cat') : '';
$seo_field     = '';
if ($term instanceof WP_Term) {
    // FIX 2026-06-27: ACF term field can be returned by object, taxonomy_ID, or raw term meta.
    // This keeps the category SEO block visible after template/style changes.
    $seo_field = get_field('seo', $term);
    if (!$seo_field) {
        $seo_field = get_field('seo', $term->taxonomy . '_' . $term->term_id);
    }
    if (!$seo_field) {
        $seo_field = get_term_meta($term->term_id, 'seo', true);
    }
}

// Fallback: дочерние WP-категории если нет ACF
$child_cats = [];
if ($sub_count === 0 && $term instanceof WP_Term) {
    $res = get_terms(['taxonomy'=>'product_cat','parent'=>$term->term_id,'hide_empty'=>false,'number'=>20]);
    if (!is_wp_error($res)) $child_cats = $res;
}
$has_tiles = ($sub_count > 0 || !empty($child_cats));

// Короткое описание: первые 2 предложения
$cat_desc_short = '';
$cat_desc_rest  = '';
if ($cat_desc_html) {
    $plain = html_entity_decode(wp_strip_all_tags($cat_desc_html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $plain = str_replace("\xc2\xa0", ' ', $plain);
    preg_match_all('/[^.!?]+[.!?]+/u', $plain, $sentences);
    $all            = $sentences[0] ?? [];
    $cat_desc_short = trim(implode(' ', array_slice($all, 0, 2)));
    $cat_desc_rest  = trim(implode(' ', array_slice($all, 2)));
}
?>

<div class="stc-page">

    <!-- HERO -->
    <section class="stc-hero">
        <div class="stc-hero__inner container">
            <nav class="stc-bc"><?php echo stc_custom_breadcrumbs(); ?></nav>
            <h1 class="stc-hero__title"><?php woocommerce_page_title(); ?></h1>
        </div>
    </section>

    <!-- ВЕРХНИЙ БЛОК: 2 равные колонки -->
    <?php if ($has_tiles || $cat_desc_html) : ?>
    <section class="stc-top-block">
        <div class="stc-top-block__inner container">

            <!-- ЛЕВАЯ: все плитки подкатегорий — grid, без скролла -->
            <?php if ($has_tiles) : ?>
            <div class="stc-top-block__cats">
                <div class="stc-subcats-grid">
                <?php if ($sub_count > 0) :
                    while (have_rows('subcategory', $term)) : the_row();
                        $img  = get_sub_field('img');
                        $text = get_sub_field('text');
                        $link = get_sub_field('link');
                        $tag  = $link ? 'a' : 'div';
                        $attr = $link ? ' href="' . esc_url($link) . '"' : '';
                ?>
                <<?php echo $tag . $attr; ?> class="stc-subcat">
                    <?php if ($img) :
                        $src = !empty($img['sizes']['medium_large']) ? $img['sizes']['medium_large']
                             : (!empty($img['sizes']['large']) ? $img['sizes']['large'] : $img['url']);
                    ?>
                    <div class="stc-subcat__img">
                        <img src="<?php echo esc_url($src); ?>"
                             alt="<?php echo esc_attr($img['alt'] ?: $text); ?>"
                             loading="lazy">
                        <div class="stc-subcat__overlay"></div>
                    </div>
                    <?php endif; ?>
                    <span class="stc-subcat__label"><?php echo esc_html($text); ?></span>
                </<?php echo $tag; ?>>
                    <?php endwhile; endif; ?>

                <?php foreach ($child_cats as $cc) :
                    $tid = $cc->term_id;
                    $thu = ($tid && ($img_id = get_term_meta($tid, 'thumbnail_id', true)))
                           ? wp_get_attachment_image_url($img_id, 'medium_large') : '';
                ?>
                <a href="<?php echo esc_url(get_term_link($cc)); ?>" class="stc-subcat">
                    <?php if ($thu) : ?>
                    <div class="stc-subcat__img">
                        <img src="<?php echo esc_url($thu); ?>"
                             alt="<?php echo esc_attr($cc->name); ?>"
                             loading="lazy">
                        <div class="stc-subcat__overlay"></div>
                    </div>
                    <?php endif; ?>
                    <span class="stc-subcat__label"><?php echo esc_html($cc->name); ?></span>
                </a>
                <?php endforeach; ?>
                </div><!-- /stc-subcats-grid -->
            </div>
            <?php endif; ?>

            <!-- ПРАВАЯ: краткое описание категории -->
            <?php if ($cat_desc_html) : ?>
            <div class="stc-top-block__desc">
                <span class="stc-top-block__desc-eyebrow">О категории</span>
                <p class="stc-top-block__desc-text"><?php echo esc_html($cat_desc_short); ?></p>
                <?php if ($cat_desc_rest) : ?>
                <span class="stc-top-block__desc-more" id="stc-desc-more" hidden>
                    <?php echo esc_html($cat_desc_rest); ?>
                </span>
                <button class="stc-top-block__desc-btn" type="button"
                    onclick="document.getElementById('stc-desc-more').hidden=false;this.style.display='none'">
                    Читать далее →
                </button>
                <?php endif; ?>
                <?php if ($seo_field) : ?>
                <a class="stc-top-block__anchor" href="#stc-seo">Подробнее о технике ↓</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

    <!-- LAYOUT: sidebar + main -->
    <div class="stc-layout container">

        <aside class="stc-nav" aria-label="Категории">
            <div class="stc-nav__head">
                <span>Каталог</span>
                <button class="stc-nav__burger" aria-expanded="false" aria-controls="stc-nav-body">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
            <ul class="stc-nav__body" id="stc-nav-body">
                <?php
                /**
                 * STATIC CATEGORY NAV
                 * Категории фиксированные: порядок, картинки и подкатегории задаются здесь.
                 * Подменю НЕ открывается сервером на активной категории — только hover/focus через CSS.
                 */
                $stc_current_path = trim( (string) parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' ), PHP_URL_PATH ), '/' );

                $stc_path_is_active = static function( $path ) use ( $stc_current_path ) {
                    $path = trim( (string) $path, '/' );
                    if ( $path === '' ) {
                        return false;
                    }

                    return $stc_current_path === $path || strpos( $stc_current_path, $path . '/' ) === 0;
                };

                $stc_path_is_exact = static function( $path ) use ( $stc_current_path ) {
                    return $stc_current_path === trim( (string) $path, '/' );
                };

                $stc_static_nav = [
                    [
                        'title' => 'Спецтехника Урал',
                        'path'  => '/tehnika-v-nalichii/',
                        'img'   => '/wp-content/uploads/2019/09/ural-NEXT.png',
                        'children' => [
                            [ 'title' => 'Спецтехника Урал Некст',    'path' => '/tehnika-v-nalichii/specztehnika-ural-nekst/' ],
                            [ 'title' => 'Спецтехника Урал М',        'path' => '/tehnika-v-nalichii/specztehnika-ural-m/' ],
                            [ 'title' => 'Спецтехника Урал 4320',     'path' => '/tehnika-v-nalichii/specztehnika-ural-4320/' ],
                            [ 'title' => 'Спецтехника Урал Некст 6×4','path' => '/tehnika-v-nalichii/specztehnika-ural-nekst-6x4/' ],
                            [ 'title' => 'Спецтехника Урал 6370',     'path' => '/tehnika-v-nalichii/specztehnika-ural-6370/' ],
                            [ 'title' => 'Спецтехника Урал CNG',      'path' => '/tehnika-v-nalichii/specztehnika-ural-cng/' ],
                        ],
                    ],
                    [
                        'title' => 'Автокраны Урал',
                        'path'  => '/avtokrani-ural/',
                        'img'   => '/wp-content/uploads/2025/03/avtokrani-ural.webp',
                        'children' => [
                            [ 'title' => 'Автокраны Урал Некст', 'path' => '/avtokrani-ural/avtokrany-ural-nekst/' ],
                            [ 'title' => 'Автокраны Урал 4320',  'path' => '/avtokrani-ural/avtokrani-ural-4320/' ],
                        ],
                    ],
                    [
                        'title' => 'Автогидроподъёмники',
                        'path'  => '/avtogidropodyomniki/',
                        'img'   => '/wp-content/uploads/2026/05/agp.webp',
                        'children' => [],
                    ],
                    [
                        'title' => 'Автоцистерны Урал',
                        'path'  => '/avtotsisterny-ural/',
                        'img'   => '/wp-content/uploads/2025/03/mini21.webp',
                        'children' => [
                            [ 'title' => 'Цистерны и топливозаправщики Урал Некст', 'path' => '/avtotsisterny-ural/cisterny-i-toplivozapravshhiki-nekst/' ],
                            [ 'title' => 'Автотопливозаправщики Урал М',            'path' => '/avtotoplivozapravshhiki-ural-m/' ],
                            [ 'title' => 'Автоцистерны Урал 4320',                  'path' => '/avtotsisterny-ural/avtotsisterny-ural-4320/' ],
                            [ 'title' => 'Автотопливозаправщики АТЗ Урал М',        'path' => '/avtotsisterny-ural/avtotsisterny-ural-m/' ],
                            [ 'title' => 'Цистерны пищевые',                        'path' => '/avtotsisterny-ural/cisterny-pishevie/' ],
                            [ 'title' => 'АЦПТ Урал',                               'path' => '/avtotsisterny-ural/cisterny-pishevie/acpt-ural/' ],
                            [ 'title' => 'Цистерны химические',                     'path' => '/avtotsisterny-ural/cisterny-himicheskie/' ],
                            [ 'title' => 'Специальный технологический транспорт',    'path' => '/avtotsisterny-ural/cpecialnyj-tekhnologicheskij-transport/' ],
                            [ 'title' => 'Автобетоносмесители',                     'path' => '/avtobetonosmesiteli-ural/' ],
                            [ 'title' => 'Автотопливозаправщики',                   'path' => '/avtotsisterny-ural/avtotoplivozapravshhiki/' ],
                            [ 'title' => 'Автоцистерны нефтепромысловые',            'path' => '/avtotsisterny-ural/avtocisterny-neftepromyslovye/' ],
                            [ 'title' => 'Бензовозы',                               'path' => '/avtotsisterny-ural/benzovozy/' ],
                            [ 'title' => 'Вакуумные автоцистерны',                  'path' => '/avtotsisterny-ural/vakuumnye-avtoczisterny/' ],
                        ],
                    ],
                    [
                        'title' => 'Бортовые автомобили',
                        'path'  => '/bortovye-gruzoviki/',
                        'img'   => '/wp-content/uploads/2021/07/bort-s-kmu-nekst.jpg',
                        'children' => [
                            [ 'title' => 'Бортовые автомобили с КМУ', 'path' => '/bortovye-gruzoviki/bortovye-avtomobili-s-kmu/' ],
                            [ 'title' => 'Бортовые УРАЛ Некст',       'path' => '/bortovye-gruzoviki/ural-nekst-bortovoj/' ],
                            [ 'title' => 'Бортовые УРАЛ-M',           'path' => '/bortovye-gruzoviki/bortovye-avtomobili-ural-m/' ],
                            [ 'title' => 'Бортовые УРАЛ 4320',        'path' => '/bortovye-gruzoviki/bortovoj-ural-4320/' ],
                            [ 'title' => 'Бортовые УРАЛ-6370',        'path' => '/bortovye-gruzoviki/bortovye-avtomobili-6370/' ],
                        ],
                    ],
                    [
                        'title' => 'Вахтовый автобус Урал',
                        'path'  => '/vahtovka-ural/',
                        'img'   => '/wp-content/uploads/2025/03/ural_next_32552_5013_71mini.webp',
                        'children' => [
                            [ 'title' => 'Вахтовый автобус Урал Некст', 'path' => '/vahtovka-ural/vahtovka-ural-nekst/' ],
                            [ 'title' => 'Вахтовый автобус Урал М',     'path' => '/vahtovka-ural/vahtovka-ural-m/' ],
                            [ 'title' => 'Автобус 4320',                'path' => '/vahtovka-ural/vahtovka-ural-4320/' ],
                            [ 'title' => 'Вахтовый автобус Урал 6370',  'path' => '/vahtovka-ural/vahtovka-ural-6370/' ],
                        ],
                    ],
                    [
                        'title' => 'Коммунальная техника Урал',
                        'path'  => '/kommunalnaya-tehnika-ural/',
                        'img'   => '/wp-content/uploads/2025/03/cshr_26g.webp',
                        'children' => [
                            [ 'title' => 'Коммунальная техника Урал Некст', 'path' => '/kommunalnaya-tehnika-ural/kommunalnaya-tehnika-ural-nekst/' ],
                            [ 'title' => 'Коммунальная техника Урал М',     'path' => '/kommunalnaya-tehnika-ural/kommunalnaya-tehnika-ural-m/' ],
                            [ 'title' => 'Коммунальная техника Урал 4320',  'path' => '/kommunalnaya-tehnika-ural/kommunalnaya-tehnika-ural-4320/' ],
                            [ 'title' => 'Коммунальная техника Урал 6370',  'path' => '/kommunalnaya-tehnika-ural/kommunalnaya-tehnika-ural-6370/' ],
                            [ 'title' => 'Комбинированные дорожные машины КДМ', 'path' => '/kommunalnaya-tehnika-ural/kombinirovannye-dorozhnye-mashiny-kdm-kommunalnaja-i-uborochnaja-tehnika/' ],
                            [ 'title' => 'Мусоровозы Урал 4320',            'path' => '/kommunalnaya-tehnika-ural/musorovozy-ural-4320/' ],
                            [ 'title' => 'Шнекороторные снегоочистители',   'path' => '/shnekorotornye-snegoochistiteli-ural/' ],
                        ],
                    ],
                    [
                        'title' => 'Лесовозы Урал',
                        'path'  => '/lesovozy-ural/',
                        'img'   => '/wp-content/uploads/2025/03/455036483_w0_h0_ural_next_lesovoz.webp',
                        'children' => [
                            [ 'title' => 'Лесовозы / сортиментовозы Некст', 'path' => '/lesovozy-ural/lesovozy-ural-nekst/' ],
                            [ 'title' => 'Лесовозы / сортиментовозы Урал М', 'path' => '/lesovozy-ural/lesovozy-ural-m/' ],
                            [ 'title' => 'Лесовозы / сортиментовозы 4320',   'path' => '/lesovozy-ural/lesovozy-ural-4320/' ],
                            [ 'title' => 'Лесовозы / сортиментовозы 6370',   'path' => '/lesovozy-ural/lesovozy-ural-6370/' ],
                            [ 'title' => 'Новый Лесовоз Урал',              'path' => '/lesovozy-ural/lesovoz-ural/' ],
                        ],
                    ],
                    [
                        'title' => 'Манипуляторы для Урала',
                        'path'  => '/manipulyatory-dlya-urala/',
                        'img'   => '/wp-content/uploads/2025/03/pritsep_rospusk_t93020.webp',
                        'children' => [
                            [ 'title' => 'МАЙМАН',             'path' => '/manipulyatory-dlya-urala/majman/' ],
                            [ 'title' => 'Манипуляторы ИНМАН', 'path' => '/manipulyatory-dlya-urala/kmu-inman/' ],
                        ],
                    ],
                    [
                        'title' => 'Пожарная техника',
                        'path'  => '/pozharnaya-tehnika/',
                        'img'   => '/wp-content/uploads/2025/03/img_4953_opt_0.webp',
                        'children' => [],
                    ],
                    [
                        'title' => 'Прицепы для Урала',
                        'path'  => '/pritsepy-dlya-urala/',
                        'img'   => '/wp-content/uploads/2025/03/pricep-ural-1024x391-1.webp',
                        'children' => [
                            [ 'title' => 'Полуприцепы и прицепы-цистерны', 'path' => '/pritsepy-dlya-urala/polupricepy-i-pricepy-cisterny/' ],
                        ],
                    ],
                    [
                        'title' => 'Самосвалы Урал',
                        'path'  => '/samosvaly-ural-kupit/',
                        'img'   => '/wp-content/uploads/2025/03/ural_next_5557-6121-74_6x6mini.webp',
                        'children' => [
                            [ 'title' => 'Самосвалы Некст',                       'path' => '/samosvaly-ural-kupit/samosvaly-ural-nekst-kupit/' ],
                            [ 'title' => 'Самосвалы Урал М',                      'path' => '/samosvaly-ural-kupit/samosvaly-ural-m-kupit/' ],
                            [ 'title' => 'Самосвалы Урал 4320',                   'path' => '/samosvaly-ural-kupit/samosvaly-ural-4320-kupit/' ],
                            [ 'title' => 'Самосвалы Урал 6370',                   'path' => '/samosvaly-ural-kupit/samosvaly-ural-6370/' ],
                            [ 'title' => 'Самосвалы Урал М CNG',                  'path' => '/samosvaly-ural-kupit/samosvaly-ural-m-cng-cat/' ],
                            [ 'title' => 'Самосвалы с КМУ',                       'path' => '/samosvaly-ural-kupit/samosvaly-s-kmu/' ],
                            [ 'title' => 'Самосвал 10 м³',                        'path' => '/samosvaly-ural-kupit/samosval-10-m3/' ],
                            [ 'title' => 'Самосвал 10 тонн',                      'path' => '/samosvaly-ural-kupit/samosval-10-tn/' ],
                            [ 'title' => 'Самосвал 20 м³',                        'path' => '/samosvaly-ural-kupit/samosval-20-m3/' ],
                            [ 'title' => 'Самосвал 20 тонн',                      'path' => '/samosvaly-ural-kupit/samosval-20-tn/' ],
                            [ 'title' => 'Самосвал с двухсторонней разгрузкой',    'path' => '/samosvaly-ural-kupit/samosval-s-dvuhstoronnej-razgruzkoj/' ],
                            [ 'title' => 'Самосвал с задней разгрузкой',           'path' => '/samosvaly-ural-kupit/samosval-s-zadnej-razgruzkoj/' ],
                            [ 'title' => 'Самосвал с трехсторонней разгрузкой',    'path' => '/samosvaly-ural-kupit/samosval-s-trekhstoronnej-razgruzkoj/' ],
                            [ 'title' => 'Самосвалы 6×4',                         'path' => '/samosvaly-ural-kupit/samosvaly-nekst-6x4/' ],
                        ],
                    ],
                    [
                        'title' => 'Сортиментовоз Урал',
                        'path'  => '/lesovozy-ural/sortimentovoz-ural/',
                        'img'   => '/wp-content/uploads/2021/07/sortimentovoz.jpg',
                        'children' => [
                            [ 'title' => 'Металловозы',        'path' => '/metallovozy/' ],
                            [ 'title' => 'Трубоплетевоз Урал', 'path' => '/lesovozy-ural/trubopletevoz-ural/' ],
                        ],
                    ],
                    [
                        'title' => 'Техника для нефтегазовой отрасли',
                        'path'  => '/tehnika-dlya-neftegazovoj-otrasli/',
                        'img'   => '/wp-content/uploads/2020/05/11.jpg',
                        'children' => [
                            [ 'title' => 'Урал Некст для нефтегазовой отрасли', 'path' => '/tehnika-dlya-neftegazovoj-otrasli/ural-nekst-dlya-neftegazovoj-otrasli/' ],
                            [ 'title' => 'Нефтепромысловая техника Урал М',     'path' => '/tehnika-dlya-neftegazovoj-otrasli/tehnika-dlja-neftegazodobychi-ural-m/' ],
                            [ 'title' => 'Техника для нефтегазодобычи 4320',     'path' => '/tehnika-dlya-neftegazovoj-otrasli/ural-4320-dlya-neftegazovoj-otrasli/' ],
                            [ 'title' => 'Техника для нефтегазодобычи 6370',     'path' => '/tehnika-dlya-neftegazovoj-otrasli/ural-6370-dlya-neftegazovoj-otrasli/' ],
                            [ 'title' => 'Агрегаты исследования скважин АИС',    'path' => '/tehnika-dlya-neftegazovoj-otrasli/agregaty-issledovanija-skvazhin-ais/' ],
                            [ 'title' => 'Передвижные мастерские ПАРМ, МП',      'path' => '/furgony-ural/peredvizhnye-masterskie-parm-mp/' ],
                            [ 'title' => 'Передвижные промысловые установки',    'path' => '/tehnika-dlya-neftegazovoj-otrasli/peredvijnie-promislovie-ystanonki/' ],
                            [ 'title' => 'Цементировочные агрегаты',             'path' => '/tehnika-dlya-neftegazovoj-otrasli/cementirovochnye-agregaty/' ],
                        ],
                    ],
                    [
                        'title' => 'Тягачи Урал',
                        'path'  => '/tyagachi-ural/',
                        'img'   => '/wp-content/uploads/2021/11/sedelnyj-tyagach-ural-s35510-1.jpg',
                        'children' => [
                            [ 'title' => 'Седельный тягач Некст',     'path' => '/tyagachi-ural/sedelnyj-tyagach-nekst/' ],
                            [ 'title' => 'Седельный тягач М',         'path' => '/tyagachi-ural/tyagach-ural-m/' ],
                            [ 'title' => 'Седельный тягач 4320',      'path' => '/tyagachi-ural/tyagach-ural-4320/' ],
                            [ 'title' => 'Седельный тягач 6370',      'path' => '/tyagachi-ural/sedelnyj-tyagach-6370/' ],
                            [ 'title' => 'Седельный тягач Некст 6х4', 'path' => '/tyagachi-ural/sedelnyj-tyagach-nekst-6x4/' ],
                            [ 'title' => 'Седельные тягачи с КМУ',    'path' => '/uraly-s-manipulyatorom/sedelnye-tjagachi-s-kmu/' ],
                        ],
                    ],
                    [
                        'title' => 'Урал с КМУ',
                        'path'  => '/uraly-s-manipulyatorom/',
                        'img'   => '/wp-content/uploads/2025/03/img_947711.webp',
                        'children' => [
                            [ 'title' => 'Спецтехника с КМУ Некст', 'path' => '/uraly-s-manipulyatorom/ural-nekst-s-manipulyatorom/' ],
                            [ 'title' => 'Урал М с манипулятором',   'path' => '/uraly-s-manipulyatorom/ural-m-s-manipulyatorom/' ],
                            [ 'title' => 'Урал 4320 с КМУ',          'path' => '/uraly-s-manipulyatorom/ural-4320-s-manipulyatorom/' ],
                            [ 'title' => 'Спецтехника с КМУ 6370',   'path' => '/uraly-s-manipulyatorom/ural-6370-s-manipulyatorom/' ],
                        ],
                    ],
                    [
                        'title' => 'Фургоны Урал',
                        'path'  => '/furgony-ural/',
                        'img'   => '/wp-content/uploads/2020/05/165-original-1.png',
                        'children' => [
                            [ 'title' => 'Автомобили для перевозки взрывчатых веществ', 'path' => '/furgony-ural/avtomobili-dlja-perevozki-vzryvchatyh-veshhestv/' ],
                            [ 'title' => 'Фургоны Урал Некст',                         'path' => '/furgony-ural/furgony-ural-nekst/' ],
                            [ 'title' => 'Фургоны Урал М',                             'path' => '/furgony-ural/furgony-ural-m/' ],
                            [ 'title' => 'Фургоны Урал 4320',                          'path' => '/furgony-ural/furgony-ural-4320/' ],
                            [ 'title' => 'Фургоны Урал 6370',                          'path' => '/furgony-ural/furgony-ural-6370/' ],
                            [ 'title' => 'АРОК, АНРВ',                                 'path' => '/tehnika-dlya-neftegazovoj-otrasli/arok-anrv/' ],
                            [ 'title' => 'Грузопассажирские автомобили с КМУ',          'path' => '/gruzopassazhirskie-ural-s-kmu/' ],
                            [ 'title' => 'Транспортно-бытовые машины Урал ТБМ',         'path' => '/transportno-bitovie-mashini/' ],
                        ],
                    ],
                    [
                        'title' => 'Шасси Урал',
                        'path'  => '/shassi-ural-kupit/',
                        'img'   => '/wp-content/uploads/2025/03/shassi-next-1.webp',
                        'children' => [
                            [ 'title' => 'Шасси NEXT',     'path' => '/shassi-ural-kupit/shassi-ural-nekst/' ],
                            [ 'title' => 'Шасси Урал М',   'path' => '/shassi-ural-kupit/shassi-ural-m/' ],
                            [ 'title' => 'Шасси 4320',     'path' => '/shassi-ural-kupit/shassi-ural-4320/' ],
                            [ 'title' => 'Шасси 6370',     'path' => '/shassi-ural-kupit/shassi-ural-6370/' ],
                            [ 'title' => 'Шасси Урал 6х4', 'path' => '/shassi-ural-kupit/shassi-ural-6h4/' ],
                            [ 'title' => 'Шасси CNG',      'path' => '/shassi-ural-kupit/shassi-cng/' ],
                        ],
                    ],
                ];
                ?>

                <?php foreach ( $stc_static_nav as $item ) :
                    $has_children = ! empty( $item['children'] );
                    $is_active    = $stc_path_is_active( $item['path'] );
                    $img_url      = ! empty( $item['img'] ) ? home_url( $item['img'] ) : '';
                ?>
                <li class="stc-nav__row<?php echo $is_active ? ' is-active' : ''; ?>">
                    <a class="stc-nav__link" href="<?php echo esc_url( home_url( $item['path'] ) ); ?>">
                        <span class="stc-nav__media">
                            <?php if ( $img_url ) : ?>
                                <img
                                    class="stc-nav__thumb"
                                    src="<?php echo esc_url( $img_url ); ?>"
                                    alt="<?php echo esc_attr( $item['title'] ); ?>"
                                    loading="lazy"
                                >
                            <?php else : ?>
                                <span class="stc-nav__thumb stc-nav__thumb--placeholder" aria-hidden="true"></span>
                            <?php endif; ?>
                        </span>
                        <span class="stc-nav__text"><?php echo esc_html( $item['title'] ); ?></span>
                    </a>

                    <?php if ( $has_children ) : ?>
                    <button class="stc-nav__arrow" aria-hidden="true" tabindex="-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 6 15 12 9 18"/></svg>
                    </button>
                    <ul class="stc-nav__children">
                        <?php foreach ( $item['children'] as $child ) :
                            $child_active = $stc_path_is_exact( $child['path'] ) || $stc_path_is_active( $child['path'] );
                        ?>
                        <li class="<?php echo $child_active ? 'is-active' : ''; ?>">
                            <a href="<?php echo esc_url( home_url( $child['path'] ) ); ?>"><?php echo esc_html( $child['title'] ); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <main class="stc-main" role="main">

            <?php do_action('woocommerce_archive_description'); ?>

            <?php if (woocommerce_product_loop()) : ?>
            <div class="stc-toolbar"><?php do_action('woocommerce_before_shop_loop'); ?></div>
            <?php woocommerce_product_loop_start(); ?>
            <?php if (wc_get_loop_prop('total')) :
                while (have_posts()) : the_post();
                    do_action('woocommerce_shop_loop');
                    wc_get_template_part('content', 'product');
                endwhile;
            endif; ?>
            <?php woocommerce_product_loop_end(); ?>
            <?php do_action('woocommerce_after_shop_loop'); ?>
            <?php else : ?>
            <?php do_action('woocommerce_no_products_found'); ?>
            <?php endif; ?>

            <?php if ($seo_field) : ?>
            <div class="stc-seo" id="stc-seo">
                <p class="stc-seo__preview"><?php
                    $sp = html_entity_decode(wp_strip_all_tags($seo_field), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    preg_match_all('/[^.!?]+[.!?]+/u', $sp, $sm);
                    echo esc_html(trim(implode(' ', array_slice($sm[0] ?? [], 0, 2))));
                ?></p>
                <div class="stc-seo__full" id="stc-seo-full" style="display:none">
                    <?php echo wp_kses_post($seo_field); ?>
                </div>
                <button class="stc-seo__toggle" id="stc-seo-btn" type="button">Читать полностью</button>
            </div>
            <?php endif; ?>

        </main>
    </div>

    <!-- ПАРТНЁРЫ -->
    <section class="stc-partners-section">
        <div class="container">
            <h2 class="stc-partners-title">Дополнительные услуги</h2>
            <div class="stc-partners">

<?php
// СПРИНТ-05-v2: фоновые изображения через home_url() для работы на localhost
$pcard_svc_img   = home_url('/wp-content/uploads/2025/03/ural_next_32552_5013_71mini.webp');
$pcard_parts_img = home_url('/wp-content/uploads/2021/07/bort-s-kmu-nekst.jpg');
?>
                <a class="stc-pcard stc-pcard--svc" href="https://rscural.ru/" style="--pcard-bg: url('<?php echo esc_url($pcard_svc_img); ?>')">
                    <div class="stc-pcard__body">
                        <div class="stc-pcard__icon-wrap">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                        <h3 class="stc-pcard__title">Сервисный центр Урал</h3>
                        <p class="stc-pcard__sub">Официальный сертифицированный сервис</p>
                        <ul class="stc-pcard__list">
                            <li>Модернизации и доработки техники</li>
                            <li>Переоборудование на газ (CNG)</li>
                            <li>Установка дополнительного оборудования</li>
                            <li>Гарантийное обслуживание и ремонт</li>
                        </ul>
                        <span class="stc-pcard__cta">Перейти на сайт →</span>
                    </div>
                </a>

                <a class="stc-pcard stc-pcard--parts" href="https://z.spectechcom.ru/" style="--pcard-bg: url('<?php echo esc_url($pcard_parts_img); ?>')">
                    <div class="stc-pcard__body">
                        <div class="stc-pcard__icon-wrap">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
                        </div>
                        <h3 class="stc-pcard__title">Запчасти для Урала</h3>
                        <p class="stc-pcard__sub">От официального дилера</p>
                        <ul class="stc-pcard__list">
                            <li>Только оригинальные запчасти к а/м Урал</li>
                            <li>Более 10&thinsp;000 наименований в наличии</li>
                            <li>Выгодные цены для регионов Дальнего Востока</li>
                        </ul>
                        <span class="stc-pcard__cta">Перейти на сайт →</span>
                    </div>
                </a>

            </div>
        </div>
    </section>

</div>

<!-- CTA -->
<section class="stc-cta">
    <div class="stc-cta__inner container">
        <div class="stc-cta__left">
            <p class="stc-cta__eye">Остались вопросы?</p>
            <h2 class="stc-cta__title">Получите консультацию специалиста</h2>
            <p class="stc-cta__sub">Наш менеджер подберёт комплектацию, ответит на технические вопросы и рассчитает лизинг</p>
            <ul class="stc-cta__benefits">
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ec621f" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg><div><strong>Ответим за 15 минут</strong><span>В рабочее время</span></div></li>
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ec621f" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg><div><strong>Подберём комплектацию</strong><span>Под ваши задачи и бюджет</span></div></li>
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ec621f" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg><div><strong>Рассчитаем лизинг</strong><span>Одобрение за 1 день</span></div></li>
            </ul>
        </div>
        <div class="stc-cta__right">
            <div class="stc-cta__form-card">
                <p class="stc-cta__form-title">Оставьте заявку</p>
                <?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>
            </div>
        </div>
    </div>
</section>

<script>
(function(){
    var burger = document.querySelector('.stc-nav__burger');
    var navBody = document.getElementById('stc-nav-body');
    if (burger && navBody) {
        burger.addEventListener('click', function(){
            var e = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!e));
            navBody.classList.toggle('is-open');
        });
    }
    document.querySelectorAll('.stc-nav__row').forEach(function(row){
        var arrow = row.querySelector('.stc-nav__arrow');
        var ch    = row.querySelector('.stc-nav__children');
        if (!arrow || !ch) return;
        /* Flyout через CSS :hover — JS только подсвечивает стрелку активной категории */
        if (row.classList.contains('is-active')) {
            arrow.classList.add('is-open');
        }
    });
    var seoBtn  = document.getElementById('stc-seo-btn');
    var seoFull = document.getElementById('stc-seo-full');
    if (seoBtn && seoFull) {
        seoBtn.addEventListener('click', function(){
    seoFull.style.display = 'block';
    this.style.display = 'none';
});
    }
    function openSeo() {
    if (seoFull) seoFull.style.display = 'block';
    if (seoBtn)  seoBtn.style.display = 'none';
}

if (window.location.hash === '#stc-seo') {
    openSeo();
}

// Раскрывать SEO при клике на якорную ссылку
document.querySelectorAll('a[href="#stc-seo"]').forEach(function(a) {
    a.addEventListener('click', function() {
        openSeo();
    });
});
})();
</script>

<?php get_footer('shop'); ?>

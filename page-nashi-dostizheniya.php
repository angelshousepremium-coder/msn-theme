<?php
/**
 * Template Name: STC — Наши достижения
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-achievements.php
 *
 * Собственный вывод наград без зависимости от визуального вывода Cool Timeline.
 */
defined('ABSPATH') || exit;
get_header();

if ( ! function_exists('stc_pages_breadcrumbs') ) {
    function stc_pages_breadcrumbs() {
        echo '<div class="stc-page-bc">';
        if ( function_exists('rank_math_the_breadcrumbs') ) {
            rank_math_the_breadcrumbs();
        } elseif ( function_exists('stc_custom_breadcrumbs') ) {
            echo stc_custom_breadcrumbs();
        }
        echo '</div>';
    }
}

if ( ! function_exists('stc_timeline_extract_year') ) {
    function stc_timeline_extract_year( WP_Post $post ) {
        $year = '';
        $meta_keys = [
            'ctl_story_date', 'story_date', 'story_custom_date', 'ctl_date',
            'ctl_story_year', 'custom_date', 'timeline_date', 'cool_timeline_date',
        ];

        foreach ($meta_keys as $meta_key) {
            $meta = get_post_meta($post->ID, $meta_key, true);
            if ($meta && preg_match('/(20\d{2}|19\d{2})/u', (string) $meta, $m)) {
                return $m[1];
            }
        }

        if (preg_match('/(20\d{2}|19\d{2})/u', $post->post_title, $m)) {
            return $m[1];
        }

        $year = get_the_date('Y', $post);
        return $year ?: '';
    }
}

if ( ! function_exists('stc_timeline_post_to_item') ) {
    function stc_timeline_post_to_item( WP_Post $post ) {
        $year    = stc_timeline_extract_year($post);
        $image   = get_the_post_thumbnail_url($post, 'large');
        $content = apply_filters('the_content', $post->post_content);
        $plain   = trim(wp_strip_all_tags($content));
        $title   = trim(get_the_title($post));

        // В Cool Timeline часть старых записей названа только годом. Для карточки делаем понятный заголовок.
        if ($title === $year . ' год' || $title === $year || preg_match('/^\d{4}\s*год$/u', $title)) {
            $title = 'Награда и благодарность ' . $year . ' года';
        }

        return [
            'year'  => $year,
            'title' => $title,
            'text'  => $plain,
            'image' => $image,
        ];
    }
}

if ( ! function_exists('stc_get_timeline_posts_items') ) {
    function stc_get_timeline_posts_items() {
        $items = [];

        // 1) Сначала пробуем найти записи Cool Timeline по категории из shortcode: category="timeline-stories".
        $taxonomies = ['category', 'ctl-stories', 'ctl_story_category', 'timeline-stories', 'cool_timeline_category'];

        foreach ($taxonomies as $tax) {
            if ( ! taxonomy_exists($tax) ) {
                continue;
            }

            $term = get_term_by('slug', 'timeline-stories', $tax);
            if ( ! $term || is_wp_error($term) ) {
                continue;
            }

            $posts = get_posts([
                'post_type'      => post_type_exists('cool_timeline') ? ['cool_timeline'] : 'any',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => ['menu_order' => 'ASC', 'date' => 'ASC'],
                'order'          => 'ASC',
                'tax_query'      => [[
                    'taxonomy' => $tax,
                    'field'    => 'slug',
                    'terms'    => 'timeline-stories',
                ]],
            ]);

            foreach ($posts as $post) {
                $items[] = stc_timeline_post_to_item($post);
            }

            if (!empty($items)) {
                break;
            }
        }

        // 2) Если категория не назначена/не найдена, берём все записи post_type cool_timeline.
        // Это важно для второй страницы старого shortcode: там есть ещё записи 2010 года.
        if (empty($items) && post_type_exists('cool_timeline')) {
            $posts = get_posts([
                'post_type'      => 'cool_timeline',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => ['menu_order' => 'ASC', 'date' => 'ASC'],
                'order'          => 'ASC',
            ]);

            foreach ($posts as $post) {
                $items[] = stc_timeline_post_to_item($post);
            }
        }

        return $items;
    }
}

$fallback_items = [
    [
        'year'  => '2022',
        'title' => 'Лучший дилер по продажам в РФ',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Награда по итогам дилерской работы и продаж автомобильной техники.',
        'image' => '/wp-content/uploads/2022/06/03-1.jpg',
    ],
    [
        'year'  => '2022',
        'title' => 'Благодарность от Росгвардии',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Благодарственное письмо за вклад и сотрудничество.',
        'image' => '/wp-content/uploads/2022/05/pkf-stk-min-724x1024.jpg',
    ],
    [
        'year'  => '2021',
        'title' => '80 лет со дня основания',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Благодарность и признание партнёрского вклада.',
        'image' => '/wp-content/uploads/2021/11/img_0_0_16.jpg',
    ],
    [
        'year'  => '2019',
        'title' => 'Лучший дилер 2019 года',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Дилерская награда по итогам 2019 года.',
        'image' => '/wp-content/uploads/2020/03/img-20200306-wa0015-1-800x600.png',
    ],
    [
        'year'  => '2018',
        'title' => 'Лидер по продажам 2017',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Номинация «Лидер по продажам 2017».',
        'image' => '/wp-content/uploads/2020/03/dsc0007-1-425x600.png',
    ],
    [
        'year'  => '2016',
        'title' => 'Лидер по продажам 2016',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Номинация «Лидер по продажам 2016».',
        'image' => '/wp-content/uploads/2020/03/dsc0008-1-477x600.png',
    ],
    [
        'year'  => '2015',
        'title' => 'Лидер по продажам',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Дилерская награда в номинации «Лидер по продажам».',
        'image' => '/wp-content/uploads/2020/03/dsc0006-1-547x600.png',
    ],
    [
        'year'  => '2014',
        'title' => 'Надёжный партнёр',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Награда в номинации «Надёжный партнёр».',
        'image' => '/wp-content/uploads/2020/03/dsc0005-1-591x600.png',
    ],
    [
        'year'  => '2012',
        'title' => 'За стабильный результат',
        'text'  => 'ООО ПКФ «Спецтехкомплект». По итогам работы в 2011 году, номинация «За стабильный результат».',
        'image' => '/wp-content/uploads/2020/03/0001-3-724x1024.jpg',
    ],
    [
        'year'  => '2012',
        'title' => 'Стабильный и надёжный партнёр',
        'text'  => 'ООО ПКФ «Спецтехкомплект». По итогам работы в 2012 году, номинация «Стабильный и надёжный партнёр».',
        'image' => '/wp-content/uploads/2020/03/0001-2-1-424x600.jpg',
    ],
    [
        'year'  => '2010',
        'title' => 'Надёжный партнёр',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Номинация «Надёжный партнёр». Запись со второй страницы старого Cool Timeline.',
        'image' => '/wp-content/uploads/2020/03/dsc0004-1-397x600.png',
    ],
    [
        'year'  => '2010',
        'title' => 'Надёжный партнёр',
        'text'  => 'ООО ПКФ «Спецтехкомплект». Номинация «Надёжный партнёр». Дополнительный документ со второй страницы старого Cool Timeline.',
        'image' => '/wp-content/uploads/2020/03/0001-1-mfrh-original-724x1024.jpg',
    ],
];

$items = stc_get_timeline_posts_items();

// Защита от некорректной миграции Cool Timeline:
// на старом сайте часть записей имеет post_date=2020 и технический title,
// поэтому при динамическом сборе могут получиться 12 карточек с одинаковым "2020 год"
// и пустыми изображениями для части документов. Если данные выглядят как технические,
// используем выверенный статичный массив из текущего HTML обеих страниц Cool Timeline.
$dynamic_years = [];
$dynamic_empty_images = 0;
$dynamic_generic_titles = 0;
foreach ($items as $dynamic_item) {
    if (!empty($dynamic_item['year'])) {
        $dynamic_years[] = (string) $dynamic_item['year'];
    }
    if (empty($dynamic_item['image'])) {
        $dynamic_empty_images++;
    }
    if (!empty($dynamic_item['title']) && preg_match('/^Награда и благодарность\s+\d{4}\s+года$/u', (string) $dynamic_item['title'])) {
        $dynamic_generic_titles++;
    }
}
$dynamic_years = array_unique($dynamic_years);

if (empty($items) || count($dynamic_years) < 4 || $dynamic_empty_images > 0 || $dynamic_generic_titles > 3) {
    $items = $fallback_items;
}
?>

<main id="primary" class="stc-page-modern stc-achievements-page">
    <section class="stc-modern-hero stc-modern-hero--dark">
        <div class="stc-modern-container">
            <?php stc_pages_breadcrumbs(); ?>
            <div class="stc-modern-hero__grid">
                <div class="stc-modern-hero__content">
                    <span class="stc-modern-eyebrow">История доверия</span>
                    <h1>Наши достижения</h1>
                    <p>Награды, благодарности и свидетельства партнёрства, которые подтверждают опыт группы компаний «Спецтехкомплект» в производстве, продаже и сервисном сопровождении техники на базе Урал.</p>
                    <div class="stc-modern-actions">
                        <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Связаться с отделом продаж</a>
                        <a class="stc-modern-btn stc-modern-btn--ghost" href="/o-kompanii">О компании</a>
                    </div>
                </div>
                <div class="stc-modern-hero__panel">
                    <div class="stc-modern-kpi"><strong><?php echo esc_html(count($items)); ?></strong><span>документов и наград</span></div>
                    <div class="stc-modern-kpi"><strong>25 лет</strong><span>производим, продаём и обслуживаем спецтехнику</span></div>
                    <div class="stc-modern-kpi"><strong>УРАЛ</strong><span>официальный дилер и сервисное сопровождение</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="stc-modern-section">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Награды и благодарности</span>
                <h2>Подтверждённая репутация</h2>
                <p>Мы убрали зависимость от визуального вывода Cool Timeline: теперь страница управляется чистой разметкой и scoped CSS темы.</p>
            </div>

            <div class="stc-awards-grid">
                <?php foreach ($items as $item) : ?>
                    <article class="stc-award-card">
                        <a class="stc-award-card__media" href="<?php echo esc_url($item['image']); ?>">
                            <?php if (!empty($item['image'])) : ?>
                                <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                            <?php endif; ?>
                        </a>
                        <div class="stc-award-card__body">
                            <span class="stc-award-card__year"><?php echo esc_html($item['year']); ?> год</span>
                            <h3><?php echo esc_html($item['title']); ?></h3>
                            <p><?php echo esc_html($item['text']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stc-modern-cta">
        <div class="stc-modern-container stc-modern-cta__inner">
            <div>
                <span class="stc-modern-eyebrow">Нужна техника под задачу?</span>
                <h2>Подберём шасси, надстройку и условия поставки</h2>
            </div>
            <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Получить консультацию</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

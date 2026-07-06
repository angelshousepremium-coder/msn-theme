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



/**
 * FIX 2026-07-05: картинки в левом меню каталога.
 * Сначала берём стабильную карту по slug, затем Woo thumbnail_id.
 * Это не затрагивает верхние плитки подкатегорий и карточки товаров.
 */
if ( ! function_exists('stc_catalog_nav_thumb_url') ) {
    function stc_catalog_nav_thumb_url( $term ) {
        if ( ! ( $term instanceof WP_Term ) ) {
            return '';
        }

        $static = [
            'tehnika-v-nalichii'                    => 'uploads/2020/05/1.png',
            'bortovye-avtomobili-ural'              => 'uploads/2020/05/1.png',
            'bortovye-avtomobili'                   => 'uploads/2020/05/1.png',
            'sedelnye-tyagachi'                     => 'uploads/2020/05/7.jpg',
            'tyagachi-ural'                         => 'uploads/2020/05/7.jpg',
            'avtokrany'                             => 'uploads/2021/02/avtokrani.jpg',
            'avtokrani-ural'                        => 'uploads/2021/02/avtokrani.jpg',
            'manipulyatornye-ustanovki'             => 'uploads/2020/05/12.jpg',
            'vahtovye-avtobusy-ural'                => 'uploads/2020/05/2.png',
            'vahtovka-ural'                         => 'uploads/2020/05/2.png',
            'spetstehnika-s-kmu'                    => 'uploads/2020/05/5.png',
            'avtofurgony'                           => 'uploads/2020/05/165-original-1.png',
            'furgony-ural'                          => 'uploads/2020/05/165-original-1.png',
            'pozharnye-mashiny'                     => 'uploads/2021/03/pojarnie-mashini-ural.png',
            'shassi-ural'                           => 'uploads/2020/05/3.jpg',
            'shassi-ural-kupit'                     => 'uploads/2020/05/3.jpg',
            'lesovozy-sortimentovozy-trubopletevozy'=> 'uploads/2020/05/6.jpg',
            'tsisterny-i-toplivozapravshhiki-ural'  => 'uploads/2020/05/9.png',
            'avtotsisterny-ural'                    => 'uploads/2020/05/9.png',
            'kommunalnaya-i-uborochnaya-tehnika'    => 'uploads/2020/05/13.jpg',
            'samosvaly'                             => 'uploads/2020/05/4.png',
            'pritsepnaya-tehnika'                   => 'uploads/2020/05/8.jpg',
            'tehnika-dlya-neftegazodobychi'         => 'uploads/2020/05/11.jpg',
        ];

        if ( isset( $static[ $term->slug ] ) ) {
            return content_url( $static[ $term->slug ] );
        }

        $thumb_id = (int) get_term_meta( $term->term_id, 'thumbnail_id', true );
        if ( $thumb_id ) {
            $thumb = wp_get_attachment_image_url( $thumb_id, 'thumbnail' );
            if ( $thumb ) {
                return $thumb;
            }
        }

        return '';
    }
}

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
                <?php if (!is_wp_error($nav_cats)) :
                foreach ($nav_cats as $cat) :
                    $children = get_terms(['taxonomy'=>'product_cat','parent'=>$cat->term_id,'hide_empty'=>true]);
                    $has_ch   = !empty($children) && !is_wp_error($children);
                    $open     = ($cat->term_id === $current_id || $cat->term_id === $parent_id);
                ?>
                <li class="stc-nav__row<?php echo $open ? ' is-active' : ''; ?>">
                    <?php $nav_thumb = stc_catalog_nav_thumb_url($cat); ?>
                    <a class="stc-nav__link" href="<?php echo esc_url(get_term_link($cat)); ?>">
                        <span class="stc-nav__media" aria-hidden="true">
                            <?php if ($nav_thumb) : ?>
                                <img class="stc-nav__thumb"
                                     src="<?php echo esc_url($nav_thumb); ?>"
                                     alt=""
                                     loading="lazy"
                                     width="84"
                                     height="84">
                            <?php else : ?>
                                <span class="stc-nav__thumb stc-nav__thumb--placeholder"></span>
                            <?php endif; ?>
                        </span>
                        <span class="stc-nav__text"><?php echo esc_html($cat->name); ?></span>
                    </a>
                    <?php if ($has_ch) : ?>
                    <?php $children_id = 'stc-nav-children-' . (int) $cat->term_id; ?>
                    <button class="stc-nav__arrow"
                            type="button"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr($children_id); ?>"
                            aria-label="<?php echo esc_attr('Показать подкатегории: ' . $cat->name); ?>">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 6 15 12 9 18"/></svg>
                    </button>
                    <ul class="stc-nav__children" id="<?php echo esc_attr($children_id); ?>">
                        <?php foreach ($children as $ch) : ?>
                        <li class="<?php echo ($ch->term_id === $current_id) ? 'is-active' : ''; ?>">
                            <a href="<?php echo esc_url(get_term_link($ch)); ?>"><?php echo esc_html($ch->name); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; endif; ?>
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
// Фоновые изображения партнёрских карточек из темы msn
$pcard_svc_img   = get_theme_file_uri('/img/img-services2.jpg');
$pcard_parts_img = get_theme_file_uri('/img/img-parts2.jpg');
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
    var navMobileMq = window.matchMedia('(max-width: 860px)');

    function closeOtherNavChildren(currentChildren, currentArrow) {
        document.querySelectorAll('.stc-nav__children.is-open').forEach(function(opened){
            if (opened !== currentChildren) opened.classList.remove('is-open');
        });
        document.querySelectorAll('.stc-nav__arrow.is-open').forEach(function(openedArrow){
            if (openedArrow !== currentArrow) {
                openedArrow.classList.remove('is-open');
                openedArrow.setAttribute('aria-expanded', 'false');
            }
        });
    }

    function toggleNavRow(row, forceOpen) {
        if (!row) return;
        var arrow = row.querySelector('.stc-nav__arrow');
        var ch    = row.querySelector('.stc-nav__children');
        if (!arrow || !ch) return;

        var willOpen = (typeof forceOpen === 'boolean') ? forceOpen : !ch.classList.contains('is-open');
        closeOtherNavChildren(ch, arrow);

        ch.classList.toggle('is-open', willOpen);
        arrow.classList.toggle('is-open', willOpen);
        arrow.setAttribute('aria-expanded', String(willOpen));
    }

    // Важно: обработчик в capture-фазе. Так мы перехватываем тап по стрелке
    // раньше, чем браузер/сторонний JS успеет обработать ссылку категории.
    document.addEventListener('click', function(e){
        var arrow = e.target.closest && e.target.closest('.stc-nav__arrow');
        if (!arrow) return;

        e.preventDefault();
        e.stopPropagation();
        if (typeof e.stopImmediatePropagation === 'function') {
            e.stopImmediatePropagation();
        }

        if (!navMobileMq.matches) {
            return false;
        }

        toggleNavRow(arrow.closest('.stc-nav__row'));
        return false;
    }, true);

    // Страховка: если из-за наложения слоёв тап попал не в button, а в правую
    // зону ссылки, считаем это кликом по стрелке и не переходим в категорию.
    document.addEventListener('click', function(e){
        if (!navMobileMq.matches) return;

        var link = e.target.closest && e.target.closest('.stc-nav__link');
        if (!link) return;

        var row = link.closest('.stc-nav__row');
        if (!row || !row.querySelector('.stc-nav__children')) return;

        var rect = link.getBoundingClientRect();
        var x = typeof e.clientX === 'number' ? e.clientX : 0;
        var arrowZone = 52;

        if (x >= rect.right - arrowZone) {
            e.preventDefault();
            e.stopPropagation();
            if (typeof e.stopImmediatePropagation === 'function') {
                e.stopImmediatePropagation();
            }
            toggleNavRow(row);
            return false;
        }
    }, true);

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

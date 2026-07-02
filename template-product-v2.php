<?php
/**
 * Template Name: Страница категории товара v2
 * Путь: /wp-content/themes/msn/template-product-v2.php
 *
 * Инженерный каталог официального дилера.
 * Ориентир: Mercedes Trucks, Volvo Trucks, Caterpillar.
 */
defined('ABSPATH') || exit;

get_header();

// ── ACF поля ────────────────────────────────────────
$cat_slug      = sanitize_text_field(trim((string) get_field('product_cat_slug')));
$seotext       = get_field('seotext');
$hero_label    = get_field('hero_label')    ?: 'Официальный дилер · Завод Урал';
$hero_infobar  = get_field('hero_infobar')  ?: ''; // напр. "6×6 и 8×8 · от 273 до 420 л.с. · в наличии и под заказ"
$s1n = get_field('hero_stat_1_num')   ?: '';  $s1l = get_field('hero_stat_1_label') ?: '';
$s2n = get_field('hero_stat_2_num')   ?: '';  $s2l = get_field('hero_stat_2_label') ?: '';
$s3n = get_field('hero_stat_3_num')   ?: '';  $s3l = get_field('hero_stat_3_label') ?: '';

// ── Сортировка ───────────────────────────────────────
$orderby_param = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'price-asc';
$wc_orderby  = 'meta_value_num';
$wc_meta_key = '_price';
$wc_order    = 'ASC';
if ($orderby_param === 'price-desc') { $wc_order = 'DESC'; }
elseif ($orderby_param === 'date')   { $wc_orderby = 'date'; $wc_meta_key = ''; $wc_order = 'DESC'; }

// ── WP_Query ─────────────────────────────────────────
$posts_per_page = 15;
$paged = max(1, (int)(get_query_var('paged') ?: get_query_var('page') ?: 1));
$products_query = null;
$have_products  = false;

if ($cat_slug) {
    $qargs = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => $wc_orderby,
        'order'          => $wc_order,
        'tax_query'      => [[
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cat_slug,
        ]],
    ];
    if ($wc_meta_key) $qargs['meta_key'] = $wc_meta_key;
    $products_query = new WP_Query($qargs);
    $have_products  = $products_query->have_posts();
}

add_filter('loop_shop_columns', function(){ return 3; }, 999);
?>

<div id="primary" class="content-area stc-catalog-page">
<main id="main" class="site-main">

<!-- ── ХЛЕБНЫЕ КРОШКИ ─────────────────────────────── -->
<div class="stc-bc-wrap">
    <div class="stc-container">
        <nav class="stc-bc"><?php echo do_shortcode('[stc_breadcrumbs]'); ?></nav>
    </div>
</div>

<!-- ── HERO ───────────────────────────────────────── -->
<section class="stc-hero stc-animate">
    <div class="stc-container">

        <div class="stc-hero__topbar">
            <span class="stc-hero__label"><?php echo esc_html($hero_label); ?></span>
            <div class="stc-hero__topcta">
                <a href="#stc-cta-form" class="stc-btn stc-btn--primary">Получить КП →</a>
                <a href="#stc-products" class="stc-btn stc-btn--ghost">Смотреть технику</a>
            </div>
        </div>

        <!-- Gutenberg: изображение + H1 + текст + horsmen-vnalicii -->
        <div class="stc-hero__content">
            <?php
            if (have_posts()) {
                while (have_posts()) { the_post(); the_content(); }
            }
            ?>

            <!-- Информационная строка (ACF hero_infobar) -->
            <?php if ($hero_infobar) : ?>
            <div class="stc-hero__infobar">
                <?php
                $parts = array_map('trim', explode('·', $hero_infobar));
                foreach ($parts as $part) {
                    echo '<span class="stc-hero__infobar-item">' . esc_html($part) . '</span>';
                }
                ?>
            </div>
            <?php endif; ?>

            <!-- Блок преимуществ -->
            <div class="stc-hero__benefits">
                <span class="stc-benefit">Официальный дилер Урал</span>
                <span class="stc-benefit">Поставка по всей РФ</span>
                <span class="stc-benefit">Лизинг</span>
                <span class="stc-benefit">Гарантия завода</span>
                <span class="stc-benefit">КП за 15 минут</span>
            </div>
        </div>
<?php if ($seotext) : ?>
<a href="#stc-seo-body" class="stc-hero__more-link" id="stc-more-link" style="display:none">Подробнее ↓</a>
<?php endif; ?>
        <!-- Статистика (ACF) -->
        <?php if ($s1n || $s2n || $s3n) : ?>
        <div class="stc-hero__stats">
            <?php if ($s1n) : ?>
            <div class="stc-stat">
                <span class="stc-stat__n"><?php echo esc_html($s1n); ?></span>
                <span class="stc-stat__l"><?php echo esc_html($s1l); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($s2n) : ?>
            <div class="stc-stat">
                <span class="stc-stat__n"><?php echo esc_html($s2n); ?></span>
                <span class="stc-stat__l"><?php echo esc_html($s2l); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($s3n) : ?>
            <div class="stc-stat">
                <span class="stc-stat__n"><?php echo esc_html($s3n); ?></span>
                <span class="stc-stat__l"><?php echo esc_html($s3l); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- ── КАТАЛОГ ────────────────────────────────────── -->
<div class="stc-container stc-section" id="stc-products">

    <!-- Тулбар: счётчик + быстрые преимущества + сортировка -->
    <div class="stc-toolbar stc-animate">
        <div class="stc-toolbar__top">
            <div class="stc-toolbar__left">
                <?php if ($products_query) :
                    $n = (int)$products_query->found_posts;
                    $suffix = ($n%10===1&&$n%100!==11)?'ь':(($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20))?'я':'ей');
                ?>
                <span class="stc-toolbar__count">
                    Найдено: <strong><?php echo $n; ?> автомобил<?php echo $suffix; ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="stc-toolbar__right">
                <span class="stc-toolbar__sort-label">Сортировать:</span>
                <select class="stc-toolbar__sort" id="stc-sort">
                    <option value="price-asc">По цене ↑</option>
                    <option value="price-desc">По цене ↓</option>
                    <option value="date">По новизне</option>
                </select>
            </div>
        </div>
        <div class="stc-toolbar__perks">
            <span class="stc-toolbar__perk">В наличии на складе</span>
            <span class="stc-toolbar__perk">Лизинг</span>
            <span class="stc-toolbar__perk">КП за 15 минут</span>
            <span class="stc-toolbar__perk">Гарантия завода</span>
        </div>
    </div>

    <!-- Сетка товаров -->
    <?php if ($cat_slug && $have_products) : ?>
        <div class="stc-products-wrap">
            <ul class="stc-products-grid products columns-3">
                <?php
                while ($products_query->have_posts()) :
                    $products_query->the_post();
                    global $product;
                    $product = wc_get_product(get_the_ID());
                    if ($product && $product->is_visible()) {
                        wc_get_template_part('content', 'product');
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
        </div>

        <?php if ($products_query->max_num_pages > 1) : $big = 999999; ?>
        <nav class="stc-pagination" aria-label="Страницы каталога">
            <?php echo paginate_links([
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => $paged,
                'total'     => $products_query->max_num_pages,
                'prev_text' => '‹',
                'next_text' => '›',
                'type'      => 'list',
            ]); ?>
        </nav>
        <?php endif; ?>

    <?php elseif ($cat_slug && !$have_products) : ?>
        <p class="stc-no-products">Товары в данной категории не найдены.</p>
    <?php elseif (!$cat_slug && current_user_can('edit_pages')) : ?>
        <div class="stc-admin-notice">
            <strong>Администратор:</strong> заполните поле <em>product_cat_slug</em> в ACF на этой странице.
        </div>
    <?php endif; ?>

    <!-- Блок подбора техники -->
    <div class="stc-compare stc-animate">
        <div class="stc-compare__text">
            <h3 class="stc-compare__h">Не знаете какую модель выбрать?</h3>
            <p class="stc-compare__sub">Опишите задачу — подберём технику и подготовим КП в течение 15 минут.</p>
        </div>
        <div class="stc-compare__form">
            <?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>
        </div>
    </div>

    <!-- SEO-текст -->
    <?php if ($seotext) : ?>
    <div class="stc-seo stc-animate">
        <div class="stc-seo__label">Об автомобилях</div>
        <div class="stc-seo__body" id="stc-seo-body">
            <?php echo wp_kses_post($seotext); ?>
        </div>
        <button class="stc-seo__toggle" id="stc-seo-toggle" aria-expanded="false">
            Читать полностью <span class="stc-seo__arrow">↓</span>
        </button>
    </div>
    <?php endif; ?>

</div><!-- .stc-container -->

<!-- ── ПАРТНЁРЫ ───────────────────────────────────── -->
<div class="stc-container stc-section">
<div class="stc-partners stc-animate">

    <a href="https://rscural.ru/" class="stc-pcard stc-pcard--svc" rel="noopener">
        <div class="stc-pcard__bg" aria-hidden="true" style="background-image:url('<?php echo esc_url(get_theme_file_uri('/img/img-services2.jpg')); ?>')"></div>
        <div class="stc-pcard__content">
            <div class="stc-pcard__icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
            <h3 class="stc-pcard__title">Сертифицированные<br>сервисные центры Урал</h3>
            <ul class="stc-pcard__list">
                <li>Модернизации и доработки техники</li>
                <li>Переоборудование на газ</li>
                <li>Установка дополнительного оборудования</li>
                <li>Гарантийное обслуживание, техобслуживание и ремонт</li>
            </ul>
            <span class="stc-pcard__link">Подробнее →</span>
        </div>
    </a>

    <a href="https://z.spectechcom.ru/" class="stc-pcard stc-pcard--parts" rel="noopener">
        <div class="stc-pcard__bg" aria-hidden="true" style="background-image:url('<?php echo esc_url(get_theme_file_uri('/img/img-parts2.jpg')); ?>')"></div>
        <div class="stc-pcard__content">
            <div class="stc-pcard__icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></div>
            <h3 class="stc-pcard__title">Запчасти для автомобилей<br>Урал от официального дилера</h3>
            <ul class="stc-pcard__list">
                <li>Только оригинальные запчасти к а/м Урал</li>
                <li>Более 10 000 наименований запчастей в продаже</li>
                <li>Выгодные цены на поставку запчастей в регионы Дальнего Востока</li>
            </ul>
            <span class="stc-pcard__link">Каталог →</span>
        </div>
    </a>

</div>
</div>

<!-- ── CTA ────────────────────────────────────────── -->
<div class="stc-cta-section stc-section" id="stc-cta-form">
    <div class="stc-container">
        <div class="stc-cta stc-animate">
            <div class="stc-cta__left">
                <h2 class="stc-cta__h">Получите коммерческое предложение и консультацию специалиста</h2>
                <p class="stc-cta__sub">Подберём технику под ваши задачи и подготовим КП в течение 15 минут.</p>
                <ul class="stc-cta__perks">
                    <li>КП за 15 минут</li>
                    <li>Работаем по всей РФ</li>
                    <li>Лизинг и спецусловия</li>
                    <li>Подбор аналогов</li>
                </ul>
            </div>
            <div class="stc-cta__right">
                <?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>
            </div>
        </div>
    </div>
</div>

</main>
</div>

<script>
(function(){
    /* ── Intersection Observer — scroll анимации ── */
    function stcObserve() {
        var els = document.querySelectorAll('.stc-animate:not(.stc-visible), .stc-product-card:not(.stc-visible)');
        if (!('IntersectionObserver' in window)) {
            els.forEach(function(el){ el.classList.add('stc-visible'); });
            return;
        }
        var io = new IntersectionObserver(function(entries){
            entries.forEach(function(entry){
                if (!entry.isIntersecting) return;
                var el = entry.target;
                var delay = el.classList.contains('stc-product-card')
                    ? (Array.from(el.parentNode.children).indexOf(el) % 3) * 80 : 0;
                setTimeout(function(){ el.classList.add('stc-visible'); }, delay);
                io.unobserve(el);
            });
        }, {threshold: 0.06, rootMargin: '0px 0px -40px 0px'});
        els.forEach(function(el){ io.observe(el); });
    }
    window.stcObserve = stcObserve;
    stcObserve();

    /* Перемещаем чеклист преимуществ внутрь правой колонки hero */
    (function(){
        var benefits = document.querySelector('.stc-hero__benefits');
        var rightCol = document.querySelector('.stc-hero__content .wp-block-column:last-child, .stc-hero__content .wp-block-columns > div:last-child');
        if (benefits && rightCol) {
            var cta = rightCol.querySelector('p:last-child') || rightCol.lastElementChild;
            rightCol.insertBefore(benefits, cta ? cta : null);
            benefits.style.marginTop = '4px';
        }
    })();

    /* Переносим editorial-контент после .horsmen-vnalicii из hero в отдельную секцию */
    (function(){
        var heroContent = document.querySelector('.stc-hero__content');
        if (!heroContent) return;
        var horsmen = heroContent.querySelector('.horsmen-vnalicii');
        if (!horsmen) return;

        /* Собираем все элементы ПОСЛЕ horsmen-vnalicii */
        var extras = [];
        var el = horsmen.nextElementSibling;
        while (el) {
            /* Пропускаем пустые элементы и разделители */
            var text = el.textContent.trim();
            var isEmpty = (text === '' || text === ' ') && el.tagName !== 'HR';
            var isSep = el.tagName === 'HR';
            if (!isEmpty && !isSep) {
                extras.push(el);
            }
            el = el.nextElementSibling;
        }

        if (extras.length === 0) return;

        /* Создаём секцию редакционного контента */
        var section = document.createElement('div');
        section.className = 'stc-editorial stc-section';
        extras.forEach(function(e) { section.appendChild(e); });

        /* Вставляем перед блоком подбора техники */
        var target = document.querySelector('.stc-compare');
        if (target && target.parentNode) {
            target.parentNode.insertBefore(section, target);
        } else {
            var products = document.getElementById('stc-products');
            if (products) products.appendChild(section);
        }
    })();

    /* ── SEO раскрывашка ── */
    var btn  = document.getElementById('stc-seo-toggle');
    var body = document.getElementById('stc-seo-body');
    if (btn && body) {
        btn.addEventListener('click', function(){
            var open = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', !open);
            body.classList.toggle('stc-seo__body--open', !open);
            btn.querySelector('.stc-seo__arrow').textContent = open ? '↓' : '↑';
        });
    }

    /* ── AJAX сортировка (fetch, без перезагрузки) ── */
    var sort = document.getElementById('stc-sort');
    var grid = document.querySelector('.stc-products-wrap');

    if (sort) {
        var p = new URLSearchParams(window.location.search);
        if (p.get('orderby')) sort.value = p.get('orderby');

        sort.addEventListener('change', function(){
            var url = new URL(window.location.href);
            url.searchParams.set('orderby', this.value);
            url.searchParams.delete('paged');
            history.pushState({}, '', url.toString());
            if (grid) grid.style.opacity = '.4';
            fetch(url.toString(), {headers:{'X-Requested-With':'XMLHttpRequest'}})
                .then(function(r){ return r.text(); })
                .then(function(html){
                    var doc = new DOMParser().parseFromString(html, 'text/html');
                    var nw  = doc.querySelector('.stc-products-wrap');
                    var cnt = doc.querySelector('.stc-toolbar__count strong');
                    if (nw && grid) { grid.innerHTML = nw.innerHTML; grid.style.opacity = '1'; }
                    var tc = document.querySelector('.stc-toolbar__count strong');
                    if (cnt && tc) tc.textContent = cnt.textContent;
                    var target = document.getElementById('stc-products');
                    if (target) target.scrollIntoView({behavior:'smooth', block:'start'});
                    stcObserve();
                })
                .catch(function(){ window.location.href = url.toString(); });
        });
    }

    /* ── Infinite scroll ── */
    (function(){
        var loading = false;
        var noMore  = false;

        var pag = document.querySelector('.stc-pagination');
        if (!pag) return;
        pag.style.display = 'none';

        var sentinel = document.createElement('div');
        sentinel.id = 'stc-scroll-sentinel';
        sentinel.style.cssText = 'height:1px;margin-top:40px';
        pag.parentNode.insertBefore(sentinel, pag.nextSibling);

        var loader = document.createElement('div');
        loader.id = 'stc-loader';
        loader.innerHTML = '<div class="stc-loader-dots"><span></span><span></span><span></span></div>';
        loader.style.display = 'none';
        sentinel.parentNode.insertBefore(loader, sentinel);

        function getNextUrl(){
            var p2 = document.querySelector('.stc-pagination');
            if (!p2) return null;
            var links = p2.querySelectorAll('a');
            var cur = p2.querySelector('span.current');
            if (!cur) return null;
            var curN = parseInt(cur.textContent);
            var next = null;
            links.forEach(function(l){
                if (parseInt(l.textContent) === curN + 1) next = l.href;
            });
            if (!next) {
                var nxt = p2.querySelector('a.next, a[aria-label*="сле"]');
                if (nxt) next = nxt.href;
            }
            return next;
        }

        function loadMore(){
            if (loading || noMore) return;
            var nextUrl = getNextUrl();
            if (!nextUrl) { noMore = true; return; }
            loading = true;
            loader.style.display = 'flex';
            fetch(nextUrl, {headers:{'X-Requested-With':'XMLHttpRequest'}})
                .then(function(r){ return r.text(); })
                .then(function(html){
                    var doc   = new DOMParser().parseFromString(html, 'text/html');
                    var cards = doc.querySelectorAll('.stc-products-grid .stc-product-card');
                    var g     = document.querySelector('.stc-products-grid');
                    var np    = doc.querySelector('.stc-pagination');
                    var op    = document.querySelector('.stc-pagination');
                    if (cards.length && g) cards.forEach(function(c){ g.appendChild(c); });
                    if (np && op) op.innerHTML = np.innerHTML;
                    /* URL не меняем — infinite scroll прозрачен для браузера */
                    loading = false;
                    loader.style.display = 'none';
                    stcObserve();
                    if (!getNextUrl()) noMore = true;
                })
                .catch(function(){ loading = false; loader.style.display = 'none'; });
        }

        if ('IntersectionObserver' in window) {
            var sIO = new IntersectionObserver(function(entries){
                if (entries[0].isIntersecting) loadMore();
            }, {rootMargin:'200px'});
            sIO.observe(sentinel);
        }
    })();

})();
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var hero = document.querySelector('.page-template-template-product-v2 .stc-hero__content');
  var rightCol = document.querySelector(
    '.page-template-template-product-v2 .stc-hero__content .wp-block-columns > div:last-child,' +
    '.page-template-template-product-v2 .stc-hero__content .wp-block-column:last-child'
  );
  var link = document.getElementById('stc-more-link');

  if (!hero || !rightCol || !link) return;

  /*
   * ВАЖНО:
   * На template-product-v2 ссылка физически может быть после hero columns.
   * Переносим её внутрь правой колонки, после последнего смыслового абзаца,
   * чтобы она не выпадала под всю hero-карточку.
   */
  var paragraphs = Array.prototype.slice.call(rightCol.querySelectorAll('p'))
    .filter(function (p) {
      return p.textContent.trim().length > 20;
    });

  var target = paragraphs.length ? paragraphs[paragraphs.length - 1] : null;

  if (target && target.parentNode) {
    target.parentNode.insertBefore(link, target.nextSibling);
  } else {
    rightCol.appendChild(link);
  }

  link.style.display = 'inline-flex';

  link.addEventListener('click', function (e) {
    e.preventDefault();

    var seoBody = document.getElementById('stc-seo-body');
    var seoBtn  = document.getElementById('stc-seo-toggle');

    if (seoBody && !seoBody.classList.contains('stc-seo__body--open') && seoBtn) {
      seoBtn.click();
    }

    if (!seoBody) return;

    var offset = seoBody.getBoundingClientRect().top + window.pageYOffset - 90;

    window.scrollTo({
      top: offset,
      behavior: 'smooth'
    });
  });
});
</script>
<?php get_footer(); ?>

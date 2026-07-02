<?php
/**
 * Template Name: Цистерны и топливозаправщики
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-cisterni.php
 */
defined('ABSPATH') || exit;
get_header();

$cat_slug = sanitize_text_field(trim((string) get_field('product_cat_slug')));
$seotext  = get_field('seotext');
$s1n = get_field('hero_stat_1_num')   ?: ''; $s1l = get_field('hero_stat_1_label') ?: '';
$s2n = get_field('hero_stat_2_num')   ?: ''; $s2l = get_field('hero_stat_2_label') ?: '';
$s3n = get_field('hero_stat_3_num')   ?: ''; $s3l = get_field('hero_stat_3_label') ?: '';

// Товары
$paged = max(1, (int)(get_query_var('paged') ?: get_query_var('page') ?: 1));
$orderby_param = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'price-asc';
$wc_orderby = 'meta_value_num'; $wc_meta = '_price'; $wc_order = 'ASC';
if ($orderby_param === 'price-desc') $wc_order = 'DESC';
elseif ($orderby_param === 'date') { $wc_orderby = 'date'; $wc_meta = ''; $wc_order = 'DESC'; }
$products_query = null; $have_products = false;
if ($cat_slug) {
    $qargs = ['post_type'=>'product','post_status'=>'publish','posts_per_page'=>15,'paged'=>$paged,
              'orderby'=>$wc_orderby,'order'=>$wc_order,
              'tax_query'=>[['taxonomy'=>'product_cat','field'=>'slug','terms'=>$cat_slug]]];
    if ($wc_meta) $qargs['meta_key'] = $wc_meta;
    $products_query = new WP_Query($qargs);
    $have_products  = $products_query->have_posts();
}
add_filter('loop_shop_columns', function(){ return 3; }, 999);
?>

<div id="primary" class="content-area stc-catalog-page">
<main id="main" class="site-main">

<div class="stc-topbar-row">
    <div class="stc-container">
        <nav class="stc-bc"><?php echo do_shortcode('[stc_breadcrumbs]'); ?></nav>
        <div class="stc-topbar-cta">
            <a href="#stc-popup-kp" class="stc-btn stc-btn--primary popup-with-form">Получить КП →</a>
            <a href="#stc-products" class="stc-btn stc-btn--ghost">Смотреть каталог</a>
        </div>
    </div>
</div>

<section class="stc-hero stc-animate">
    <div class="stc-container">
        <div class="stc-hero__content">
            <?php if (have_posts()) { while (have_posts()) { the_post(); the_content(); } } ?>
            <div class="stc-hero__benefits">
                <span class="stc-benefit">Официальный дилер Урал</span>
                <span class="stc-benefit">Собственное производство</span>
                <span class="stc-benefit">Полный цикл изготовления</span>
                <span class="stc-benefit">Лизинг</span>
                <span class="stc-benefit">Гарантия 2 года</span>
                <span class="stc-benefit">КП за 15 минут</span>
            </div>
            <!-- Кнопки под видео — JS переместит в правую колонку hero -->
            <div class="stc-hero__buttons">
                <a href="#stc-popup-kp" class="stc-hero__btn stc-hero__btn--dark popup-with-form">Получить КП →</a>
                <button type="button" class="stc-hero__btn stc-hero__btn--outline"
                        onclick="if(typeof jivo_api!=='undefined')jivo_api.open()">Задать вопрос</button>
            </div>
            <?php if ($seotext) : ?>
            <!-- Подробнее — JS вставит после последнего <p> в правой колонке -->
            <a href="#stc-seo-body" class="stc-hero__more-link" id="stc-more-link" style="display:none">Подробнее ↓</a>
            <?php endif; ?>
        </div>
        <?php if ($s1n || $s2n || $s3n) : ?>
        <div class="stc-hero__stats">
            <?php if ($s1n): ?><div class="stc-stat"><span class="stc-stat__n"><?php echo esc_html($s1n); ?></span><span class="stc-stat__l"><?php echo esc_html($s1l); ?></span></div><?php endif; ?>
            <?php if ($s2n): ?><div class="stc-stat"><span class="stc-stat__n"><?php echo esc_html($s2n); ?></span><span class="stc-stat__l"><?php echo esc_html($s2l); ?></span></div><?php endif; ?>
            <?php if ($s3n): ?><div class="stc-stat"><span class="stc-stat__n"><?php echo esc_html($s3n); ?></span><span class="stc-stat__l"><?php echo esc_html($s3l); ?></span></div><?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<div class="stc-container stc-section" id="stc-products">
    <div class="stc-toolbar stc-animate">
        <div class="stc-toolbar__top">
            <div class="stc-toolbar__left">
                <?php if ($products_query) :
                    $n = (int)$products_query->found_posts;
                    $s = ($n%10===1&&$n%100!==11)?'ь':(($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20))?'я':'ей');
                ?><span class="stc-toolbar__count">Найдено: <strong><?php echo $n; ?> автомобил<?php echo $s; ?></strong></span><?php endif; ?>
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
            <span class="stc-toolbar__perk">Собственное производство</span>
            <span class="stc-toolbar__perk">Лизинг</span>
            <span class="stc-toolbar__perk">КП за 15 минут</span>
            <span class="stc-toolbar__perk">Гарантия 2 года</span>
        </div>
    </div>

    <?php if ($cat_slug && $have_products) : ?>
    <div class="stc-products-wrap">
        <ul class="stc-products-grid products columns-3">
            <?php while ($products_query->have_posts()) : $products_query->the_post();
                global $product; $product = wc_get_product(get_the_ID());
                if ($product && $product->is_visible()) wc_get_template_part('content','product');
            endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>
    <?php if ($products_query->max_num_pages > 1) : $big = 999999; ?>
    <nav class="stc-pagination"><?php echo paginate_links(['base'=>str_replace($big,'%#%',esc_url(get_pagenum_link($big))),'format'=>'?paged=%#%','current'=>$paged,'total'=>$products_query->max_num_pages,'prev_text'=>'‹','next_text'=>'›','type'=>'list']); ?></nav>
    <?php endif; ?>
    <?php elseif (!$cat_slug && current_user_can('edit_pages')): ?>
    <div class="stc-admin-notice">Заполните поле <em>product_cat_slug</em> в ACF.</div>
    <?php endif; ?>

    <div class="stc-compare stc-animate">
        <div class="stc-compare__text">
            <h3 class="stc-compare__h">Нужна цистерна под ваш проект?</h3>
            <p class="stc-compare__sub">Опишите задачу — подберём модификацию, рассчитаем стоимость и подготовим КП в течение 15 минут.</p>
        </div>
        <div class="stc-compare__form"><?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?></div>
    </div>

    <?php if ($seotext) : ?>
    <div class="stc-seo stc-animate">
        <div class="stc-seo__label">Об автоцистернах</div>
        <div class="stc-seo__body" id="stc-seo-body"><?php echo wp_kses_post($seotext); ?></div>
        <button class="stc-seo__toggle" id="stc-seo-toggle" aria-expanded="false">Читать полностью <span class="stc-seo__arrow">↓</span></button>
    </div>
    <?php endif; ?>
</div>

<!-- WHY — захардкожен для цистерн -->
<div class="stc-why-section stc-section stc-animate">
    <div class="stc-container">
        <h2 class="stc-why__h">Почему клиенты <span>выбирают нас?</span></h2>
        <div class="stc-why-grid">
        <?php
            $why_items = [
                ['icon'=>'production','title'=>'Собственное производство','desc'=>'Полный цикл изготовления цистерн и выдача ЭПТС.'],
                ['icon'=>'payment','title'=>'Гибкая форма оплаты','desc'=>'Покупка автотехники в лизинг. Простая процедура оформления сделки.'],
                ['icon'=>'design','title'=>'Собственное конструкторское бюро','desc'=>'Контроль качества всех производственных процессов изготовления продукции.'],
                ['icon'=>'warranty','title'=>'Гарантия качества','desc'=>'2 года гарантии или 100 тыс. км пробега, гарантийное и сервисное обслуживание.'],
                ['icon'=>'timing','title'=>'Точное соблюдение сроков','desc'=>'Срок изготовления автоцистерны — до 30 рабочих дней.'],
            ];
            $icons = [
                'production' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 0 4.93 19.07"/><path d="M15.54 8.46A5 5 0 1 0 8.46 15.54"/></svg>',
                'payment'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>',
                'design'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
                'warranty'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                'timing'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
            ];
            foreach ($why_items as $item) : ?>
            <div class="stc-why-card">
                <div class="stc-why-card__icon"><?php echo $icons[$item['icon']]; ?></div>
                <h3 class="stc-why-card__title"><?php echo esc_html($item['title']); ?></h3>
                <p class="stc-why-card__desc"><?php echo esc_html($item['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="stc-container stc-section"><div class="stc-partners stc-animate">
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
</div></div>

<div class="stc-cta-section stc-section" id="stc-cta-form">
    <div class="stc-container"><div class="stc-cta stc-animate">
        <div class="stc-cta__left">
            <h2 class="stc-cta__h">Получите коммерческое предложение и консультацию специалиста</h2>
            <p class="stc-cta__sub">Подберём технику под ваши задачи и подготовим КП в течение 15 минут.</p>
            <ul class="stc-cta__perks"><li>КП за 15 минут</li><li>Работаем по всей РФ</li><li>Лизинг и спецусловия</li><li>Подбор аналогов</li></ul>
        </div>
        <div class="stc-cta__right"><?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?></div>
    </div></div>
</div>
<!-- ── ПОПАП: Получить КП ──────────────────────────────── -->
<div id="stc-popup-kp" class="white-popup-block mfp-hide">
    <p class="stc-popup__title">Получить коммерческое предложение</p>
    <?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>
</div>

</main></div>

<script>
(function(){
    function stcObserve(){
        var els=document.querySelectorAll('.stc-animate:not(.stc-visible),.stc-product-card:not(.stc-visible)');
        if(!('IntersectionObserver' in window)){els.forEach(function(e){e.classList.add('stc-visible')});return}
        var io=new IntersectionObserver(function(entries){entries.forEach(function(entry){
            if(!entry.isIntersecting)return;
            var el=entry.target,d=el.classList.contains('stc-product-card')?(Array.from(el.parentNode.children).indexOf(el)%3)*80:0;
            setTimeout(function(){el.classList.add('stc-visible')},d);io.unobserve(el);
        });},{threshold:0.06,rootMargin:'0px 0px -40px 0px'});
        els.forEach(function(e){io.observe(e)});
    }
    window.stcObserve=stcObserve; stcObserve();

    /* Benefits → левая колонка, buttons → правая, Подробнее → после последнего <p> */
    (function(){
        var leftCol  = document.querySelector('.stc-hero__content .wp-block-columns > div:first-child,.stc-hero__content .wp-block-column:first-child');
        var rightCol = document.querySelector('.stc-hero__content .wp-block-columns > div:last-child,.stc-hero__content .wp-block-column:last-child');
        if(!leftCol || !rightCol) return;
        var b    = document.querySelector('.stc-hero__benefits');
        var btns = document.querySelector('.stc-hero__buttons');
        var link = document.getElementById('stc-more-link');
        if(b)    leftCol.appendChild(b);
        if(btns) rightCol.appendChild(btns);
        /* Подробнее — после последнего параграфа описания */
        if(link){
            var paras = rightCol.querySelectorAll('p.eplus-wrapper, p');
            /* ищем последний <p> перед вложенными columns (блок видео) */
            var target = null;
            for(var i = paras.length - 1; i >= 0; i--){
                if(!paras[i].closest('.wp-block-columns .wp-block-columns')){
                    target = paras[i]; break;
                }
            }
            if(target){ target.after(link); link.style.display = 'inline-flex'; }
        }
    })();

    /* Видео Rutube — клик по оверлею запускает воспроизведение */
    (function(){
        document.querySelectorAll('.rutube-video-wrapper,.rutube-video-overlay').forEach(function(el){
            var wrapper = el.classList.contains('rutube-video-wrapper') ? el : el.closest('.rutube-video-wrapper');
            if(!wrapper) return;
            var trigger = wrapper.querySelector('.rutube-video-overlay') || wrapper;
            trigger.addEventListener('click', function(){
                var iframe = wrapper.querySelector('iframe');
                if(iframe){
                    var src = iframe.src || iframe.getAttribute('src') || '';
                    if(src && src.indexOf('autoplay') === -1){
                        iframe.src = src + (src.indexOf('?') !== -1 ? '&' : '?') + 'autoplay=1&mute=0';
                    }
                }
                var overlay = wrapper.querySelector('.rutube-video-overlay');
                var playBtn = wrapper.querySelector('.rutube-video-play-button-wrapper');
                if(overlay) overlay.style.cssText = 'display:none!important';
                if(playBtn) playBtn.style.cssText = 'display:none!important';
            }, {once: true});
        });
    })();

    /* editorial JS убран — блок «Почему выбирают нас» хардкожен в stc-why-section */

    /* Подробнее → раскрыть + точный скролл к SEO (блокируем infinite scroll) */
    (function(){
        var link=document.getElementById('stc-more-link');
        if(!link)return;
        link.addEventListener('click',function(e){
            e.preventDefault();
            var seoBody=document.getElementById('stc-seo-body');
            var seoBtn=document.getElementById('stc-seo-toggle');
            /* раскрываем SEO-текст */
            if(seoBody&&!seoBody.classList.contains('stc-seo__body--open')&&seoBtn)seoBtn.click();
            if(!seoBody)return;
            /* блокируем infinite scroll на время прокрутки */
            window.stcScrollBusy=true;
            var offset=seoBody.getBoundingClientRect().top+window.pageYOffset-90;
            window.scrollTo({top:offset,behavior:'smooth'});
            setTimeout(function(){window.stcScrollBusy=false;},1600);
        });
    })();

    /* SEO */
    var btn=document.getElementById('stc-seo-toggle'),body=document.getElementById('stc-seo-body');
    if(btn&&body)btn.addEventListener('click',function(){
        var o=btn.getAttribute('aria-expanded')==='true';
        btn.setAttribute('aria-expanded',!o);body.classList.toggle('stc-seo__body--open',!o);
        btn.querySelector('.stc-seo__arrow').textContent=o?'↓':'↑';
    });

    /* AJAX сортировка */
    var sort=document.getElementById('stc-sort'),grid=document.querySelector('.stc-products-wrap');
    if(sort){
        var p=new URLSearchParams(window.location.search);
        if(p.get('orderby'))sort.value=p.get('orderby');
        sort.addEventListener('change',function(){
            var url=new URL(window.location.href);
            url.searchParams.set('orderby',this.value);url.searchParams.delete('paged');
            history.pushState({},'',url.toString());
            if(grid)grid.style.opacity='.4';
            fetch(url.toString(),{headers:{'X-Requested-With':'XMLHttpRequest'}}).then(function(r){return r.text()}).then(function(html){
                var doc=new DOMParser().parseFromString(html,'text/html');
                var nw=doc.querySelector('.stc-products-wrap'),cnt=doc.querySelector('.stc-toolbar__count strong');
                if(nw&&grid){grid.innerHTML=nw.innerHTML;grid.style.opacity='1'}
                var tc=document.querySelector('.stc-toolbar__count strong');
                if(cnt&&tc)tc.textContent=cnt.textContent;
                var t=document.getElementById('stc-products');
                if(t)t.scrollIntoView({behavior:'smooth',block:'start'});
                stcObserve();
            }).catch(function(){window.location.href=url.toString()});
        });
    }

    /* Infinite scroll */
    (function(){
        var loading=false,noMore=false,pag=document.querySelector('.stc-pagination');
        if(!pag)return;pag.style.display='none';
        var sentinel=document.createElement('div');sentinel.style.cssText='height:1px;margin-top:40px';
        pag.parentNode.insertBefore(sentinel,pag.nextSibling);
        var loader=document.createElement('div');loader.id='stc-loader';
        loader.innerHTML='<div class="stc-loader-dots"><span></span><span></span><span></span></div>';
        loader.style.display='none';sentinel.parentNode.insertBefore(loader,sentinel);
        function getNextUrl(){
            var p2=document.querySelector('.stc-pagination');if(!p2)return null;
            var cur=p2.querySelector('span.current');if(!cur)return null;
            var curN=parseInt(cur.textContent),next=null;
            p2.querySelectorAll('a').forEach(function(l){if(parseInt(l.textContent)===curN+1)next=l.href});
            if(!next){var nxt=p2.querySelector('a.next');if(nxt)next=nxt.href}return next;
        }
        function loadMore(){
            if(loading||noMore||window.stcScrollBusy)return;var nextUrl=getNextUrl();if(!nextUrl){noMore=true;return}
            loading=true;loader.style.display='flex';
            fetch(nextUrl,{headers:{'X-Requested-With':'XMLHttpRequest'}}).then(function(r){return r.text()}).then(function(html){
                var doc=new DOMParser().parseFromString(html,'text/html');
                var cards=doc.querySelectorAll('.stc-products-grid .stc-product-card'),g=document.querySelector('.stc-products-grid');
                var np=doc.querySelector('.stc-pagination'),op=document.querySelector('.stc-pagination');
                if(cards.length&&g)cards.forEach(function(c){g.appendChild(c)});
                if(np&&op)op.innerHTML=np.innerHTML;
                loading=false;loader.style.display='none';stcObserve();
                if(!getNextUrl())noMore=true;
            }).catch(function(){loading=false;loader.style.display='none'});
        }
        if('IntersectionObserver' in window)
            new IntersectionObserver(function(e){if(e[0].isIntersecting)loadMore()},{rootMargin:'200px'}).observe(sentinel);
    })();
})();
</script>
<?php get_footer(); ?>

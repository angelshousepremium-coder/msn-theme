<?php
/**
 * 404 template
 * Путь: /wp-content/themes/msn/404.php
 */
if ( ! defined('ABSPATH') ) { exit; }
get_header();
?>

<main id="primary" class="site-main stc-error-page">
    <section class="stc-error-hero">
        <div class="stc-search-container">
            <div class="stc-error-layout">
                <div class="stc-error-copy">
                    <span class="stc-search-eyebrow">Ошибка 404</span>
                    <h1>Страница не найдена</h1>
                    <p>Адрес мог измениться после обновления каталога. Найдите нужную технику через поиск или перейдите в один из основных разделов.</p>

                    <?php
                    if ( function_exists('stc_render_site_search_form') ) {
                        stc_render_site_search_form(array(
                            'placeholder' => 'Что ищем: Урал NEXT, автоцистерна, ПАРМ…',
                            'note'        => 'Поиск работает по технике, страницам, новостям и артикулам.',
                            'class'       => 'stc-site-search-wrap--404',
                        ));
                    } else {
                        get_search_form();
                    }
                    ?>

                    <div class="stc-error-actions">
                        <a class="stc-error-btn stc-error-btn--primary" href="/tehnika-v-nalichii/">Смотреть технику в наличии</a>
                        <a class="stc-error-btn" href="/contact">Связаться с менеджером</a>
                    </div>
                </div>

                <div class="stc-error-card" aria-hidden="true">
                    <div class="stc-error-code">404</div>
                    <div class="stc-error-line"></div>
                    <p>Маршрут не найден</p>
                </div>
            </div>

            <div class="stc-error-links" aria-label="Популярные разделы">
                <a href="/bortovye-avtomobili-ural">Бортовые автомобили</a>
                <a href="/vahtovye-avtobusy-ural">Вахтовые автобусы</a>
                <a href="/samosvaly">Самосвалы</a>
                <a href="/tsisterny-i-toplivozapravshhiki-ural">Цистерны</a>
                <a href="/avtofurgony">Автофургоны</a>
                <a href="/servisnyj-centr">Сервис</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

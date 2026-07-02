<?php
/**
 * Search results template
 * Путь: /wp-content/themes/msn/search.php
 */
if ( ! defined('ABSPATH') ) { exit; }
get_header();

$search_query = get_search_query();
$sku_query = null;
$sku_ids = array();

if ( $search_query && post_type_exists('product') ) {
    $sku_query = new WP_Query(array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'meta_query'     => array(
            array(
                'key'     => '_sku',
                'value'   => $search_query,
                'compare' => 'LIKE',
            ),
        ),
    ));
    if ( $sku_query->have_posts() ) {
        $sku_ids = wp_list_pluck( $sku_query->posts, 'ID' );
    }
}
?>

<main id="primary" class="site-main stc-search-page">
    <section class="stc-search-hero">
        <div class="stc-search-container">
            <?php if ( function_exists('dam_breadcrumbs') ) : ?>
                <div class="stc-search-breadcrumbs"><?php dam_breadcrumbs(); ?></div>
            <?php endif; ?>

            <span class="stc-search-eyebrow">Поиск по сайту</span>
            <h1>Результаты поиска</h1>
            <p class="stc-search-lead">
                <?php if ( $search_query ) : ?>
                    По запросу <strong>«<?php echo esc_html($search_query); ?>»</strong> показываем технику, товары, статьи и страницы сайта.
                <?php else : ?>
                    Введите модель, категорию техники или артикул, чтобы найти нужный раздел.
                <?php endif; ?>
            </p>

            <?php
            if ( function_exists('stc_render_site_search_form') ) {
                stc_render_site_search_form(array(
                    'value'       => $search_query,
                    'placeholder' => 'Например: автоцистерна, ПАРМ, 4320, седельный тягач',
                    'note'        => 'Подсказки появляются во время ввода. Можно искать по названию, категории и артикулу.',
                    'class'       => 'stc-site-search-wrap--hero',
                ));
            } else {
                get_search_form();
            }
            ?>
        </div>
    </section>

    <section class="stc-search-section">
        <div class="stc-search-container">

            <?php if ( $sku_query && $sku_query->have_posts() ) : ?>
                <div class="stc-search-block">
                    <div class="stc-search-head">
                        <span class="stc-search-eyebrow">Совпадения по артикулу</span>
                        <h2>Техника и товары</h2>
                    </div>
                    <div class="stc-search-grid">
                        <?php while ( $sku_query->have_posts() ) : $sku_query->the_post(); ?>
                            <?php get_template_part( 'template-parts/search', 'card', array('term' => $search_query) ); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( have_posts() ) : ?>
                <div class="stc-search-block">
                    <div class="stc-search-head">
                        <span class="stc-search-eyebrow">Основная выдача</span>
                        <h2>Найденные страницы</h2>
                    </div>
                    <div class="stc-search-grid">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php if ( in_array( get_the_ID(), $sku_ids, true ) ) { continue; } ?>
                            <?php get_template_part( 'template-parts/search', 'card', array('term' => $search_query) ); ?>
                        <?php endwhile; ?>
                    </div>

                    <?php if ( get_the_posts_pagination() ) : ?>
                        <nav class="stc-search-pagination" aria-label="Пагинация результатов поиска">
                            <?php
                            the_posts_pagination(array(
                                'mid_size'  => 1,
                                'prev_text' => '← Назад',
                                'next_text' => 'Вперёд →',
                            ));
                            ?>
                        </nav>
                    <?php endif; ?>
                </div>
            <?php elseif ( ! $sku_ids ) : ?>
                <div class="stc-search-empty">
                    <div class="stc-search-empty__icon">?</div>
                    <h2>Ничего не найдено</h2>
                    <p>Попробуйте сократить запрос или искать по типу техники: «автоцистерна», «самосвал», «вахтовый автобус», «ПАРМ», «шасси».</p>
                    <div class="stc-search-quicklinks">
                        <a href="/tehnika-v-nalichii/">Техника в наличии</a>
                        <a href="/tsisterny-i-toplivozapravshhiki-ural/">Цистерны</a>
                        <a href="/avtofurgony/">Автофургоны</a>
                        <a href="/contact">Связаться с менеджером</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>

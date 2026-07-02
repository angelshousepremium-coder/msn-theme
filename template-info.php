<?php
/**
 * Template Name: template - Информационные материалы
 * Template Post Type: page
 * Путь: /wp-content/themes/msn/template-info.php
 */
defined('ABSPATH') || exit;

get_header();

$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

$news_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'cat'                 => 830,
    'posts_per_page'      => 9,
    'paged'               => $paged,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
]);

$next_url = ($news_query->max_num_pages > $paged) ? get_pagenum_link($paged + 1) : '';

$stc_render_info_breadcrumbs = static function () {
    echo '<div class="stc-page-bc">';
    if (function_exists('rank_math_the_breadcrumbs')) {
        rank_math_the_breadcrumbs();
    } elseif (function_exists('stc_custom_breadcrumbs')) {
        echo stc_custom_breadcrumbs();
    }
    echo '</div>';
};
?>

<main id="primary" class="stc-page-modern stc-info-page">
    <section class="stc-modern-hero stc-modern-hero--dark">
        <div class="stc-modern-container">
            <?php $stc_render_info_breadcrumbs(); ?>

            <div class="stc-modern-hero__grid">
                <div class="stc-modern-hero__content">
                    <span class="stc-modern-eyebrow">Информационные материалы</span>
                    <h1>Новости и полезные материалы о спецтехнике Урал</h1>
                    <p>Собираем новости компании, анонсы мероприятий, обзоры техники и практические материалы по эксплуатации спецтехники на базе Урал.</p>

                    <div class="stc-modern-actions">
                        <a class="stc-modern-btn stc-modern-btn--primary" href="#stc-news-grid">Смотреть материалы</a>
                        <a class="stc-modern-btn stc-modern-btn--ghost" href="mailto:office@spectechcom.ru">Предложить новость</a>
                    </div>
                </div>

                <aside class="stc-modern-hero__panel" aria-label="Краткая информация о разделе">
                    <div class="stc-modern-kpi">
                        <strong><?php echo esc_html((int) $news_query->found_posts); ?></strong>
                        <span>материалов в разделе</span>
                    </div>
                    <div class="stc-modern-kpi">
                        <strong>УРАЛ</strong>
                        <span>техника, сервис, поставки и производство</span>
                    </div>
                    <div class="stc-modern-kpi">
                        <strong class="stc-modern-kpi__text">Связь</strong>
                        <span>office@spectechcom.ru — для новостей, анонсов и предложений</span>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="stc-modern-section" id="stc-news-grid">
        <div class="stc-modern-container">
            <div class="stc-section-head">
                <span class="stc-modern-eyebrow">Новости</span>
                <h2>Последние публикации</h2>
                <p>Мы собрали для вас полезную информацию о спецтехнике на базе Урал. Любое копирование материалов допускается только с активной ссылкой на «ПКФ Спецтехкомплект».</p>
            </div>

            <?php if ($news_query->have_posts()) : ?>
                <div class="stc-news-grid" data-stc-info-grid-v5>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                        <article class="stc-news-card">
                            <a class="stc-news-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
                                <?php else : ?>
                                    <span class="stc-news-card__placeholder">СТК</span>
                                <?php endif; ?>
                            </a>
                            <div class="stc-news-card__body">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('d.m.Y')); ?></time>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28, '…')); ?></p>
                                <a class="stc-text-link" href="<?php the_permalink(); ?>">Читать материал →</a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <?php if ($news_query->max_num_pages > 1) : ?>
                    <div class="stc-info-load-more<?php echo $next_url ? '' : ' is-complete'; ?>"
                         data-stc-info-load-v5
                         data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                         data-nonce="<?php echo esc_attr(wp_create_nonce('stc_info_load_more_v5_nonce')); ?>"
                         data-next-page="<?php echo esc_attr($paged + 1); ?>"
                         data-max-page="<?php echo esc_attr((int) $news_query->max_num_pages); ?>">
                        <button class="stc-info-load-more__btn" type="button" data-stc-info-button-v5>Показать ещё материалы</button>
                        <span class="stc-info-load-more__status" data-stc-info-status-v5>Загружаем материалы…</span>
                        <span class="stc-info-load-more__complete">Все материалы загружены</span>
                        <span class="stc-info-load-more__sentinel" data-stc-info-sentinel-v5 aria-hidden="true"></span>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="stc-empty-state">
                    <h3>Материалы пока не найдены</h3>
                    <p>Проверьте, что новости добавлены в категорию с ID 830.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="stc-modern-cta">
        <div class="stc-modern-container stc-modern-cta__inner">
            <div>
                <span class="stc-modern-eyebrow">Нужна консультация?</span>
                <h2>Подберём технику под задачу и условия поставки</h2>
            </div>
            <a class="stc-modern-btn stc-modern-btn--primary popup-with-form" href="#test-form1">Связаться со специалистом</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

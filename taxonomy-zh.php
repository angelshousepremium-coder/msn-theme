<?php
/**
 * taxonomy-zh.php
 * Путь: /wp-content/themes/msn/taxonomy-zh.php
 *
 * Архив кастомной taxonomy "zh" для доработок и дополнительного оборудования.
 */
defined('ABSPATH') || exit;

get_header('shop');
do_action('woocommerce_before_main_content');

global $wp_query;

$term = get_queried_object();

$term_title  = ($term instanceof WP_Term) ? $term->name : single_term_title('', false);
$term_desc   = ($term instanceof WP_Term) ? term_description($term->term_id, 'zh') : '';
$found_posts = isset($wp_query->found_posts) ? (int) $wp_query->found_posts : 0;
$paged       = max(1, (int) get_query_var('paged'));
$parent_term = null;
$nav_terms   = [];
$seo         = '';

if ($term instanceof WP_Term) {
    $nav_parent_id = $term->parent ? (int) $term->parent : (int) $term->term_id;
    $parent_term   = $term->parent ? get_term($term->parent, 'zh') : $term;

    $nav_terms = get_terms([
        'taxonomy'   => 'zh',
        'parent'     => $nav_parent_id,
        'hide_empty' => false,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ]);

    if (is_wp_error($nav_terms)) {
        $nav_terms = [];
    }

    if (function_exists('get_field')) {
        foreach (['seo', 'seotext'] as $field_name) {
            $seo = get_field($field_name, $term);

            if (!$seo) {
                $seo = get_field($field_name, $term->taxonomy . '_' . $term->term_id);
            }

            if (!$seo) {
                $seo = get_term_meta($term->term_id, $field_name, true);
            }

            if ($seo) {
                break;
            }
        }
    }
}

if (function_exists('wc_set_loop_prop')) {
    wc_set_loop_prop('columns', 4);
}

$parent_link = '';
if ($parent_term instanceof WP_Term && !is_wp_error($parent_term)) {
    $link = get_term_link($parent_term);
    if (!is_wp_error($link)) {
        $parent_link = $link;
    }
}
?>

<div class="stc-page stc-zh-page">

    <section class="stc-zh-hero">
        <div class="container">
            <nav class="stc-bc" aria-label="Хлебные крошки">
                <?php
                if (function_exists('stc_custom_breadcrumbs')) {
                    echo stc_custom_breadcrumbs();
                } elseif (function_exists('rank_math_the_breadcrumbs')) {
                    rank_math_the_breadcrumbs();
                }
                ?>
            </nav>

            <div class="stc-zh-hero__grid">
                <div class="stc-zh-hero__main">
                    <span class="stc-zh-eyebrow">Доработки и дополнительное оборудование</span>
                    <h1 class="stc-zh-title"><?php echo esc_html($term_title); ?></h1>

                    <?php if ($term_desc) : ?>
                        <div class="stc-zh-desc"><?php echo wp_kses_post($term_desc); ?></div>
                    <?php else : ?>
                        <p class="stc-zh-desc">
                            Подберём и установим дополнительное оборудование для спецтехники Урал:
                            доработки кабины, отопители, тахографы, лебёдки, системы контроля,
                            пожаротушение и другие решения под задачу.
                        </p>
                    <?php endif; ?>
                </div>

                <aside class="stc-zh-hero__panel" aria-label="Информация о разделе">
                    <div class="stc-zh-panel__label">Каталог</div>
                    <div class="stc-zh-panel__count"><?php echo esc_html($found_posts); ?></div>
                    <div class="stc-zh-panel__text">позиций в разделе</div>
                    <a class="stc-zh-panel__btn popup-with-form" href="#test-form1">Получить консультацию</a>
                </aside>
            </div>
        </div>
    </section>

    <div class="stc-zh-content">
        <main class="stc-main stc-zh-main">

            <?php if (!empty($nav_terms)) : ?>
                <section class="stc-zh-cats" data-stc-zh-cats aria-label="Разделы доработок и дополнительного оборудования">
                    <div class="stc-zh-cats__head">
                        <div>
                            <span class="stc-zh-cats__eyebrow">Разделы запчастей</span>
                            <h2 class="stc-zh-cats__title">Все доработки и дополнительное оборудование</h2>
                        </div>

                        <?php if ($parent_link) : ?>
                            <a class="stc-zh-cats__all <?php echo ($term instanceof WP_Term && !$term->parent) ? 'is-current' : ''; ?>"
                               href="<?php echo esc_url($parent_link); ?>">
                                Все разделы
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php $cats_list_id = 'stc-zh-cats-list-' . (($term instanceof WP_Term) ? (int) $term->term_id : 0); ?>
                    <button class="stc-zh-cats__toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($cats_list_id); ?>">
                        <span class="stc-zh-cats__toggle-dot" aria-hidden="true"></span>
                        <span class="stc-zh-cats__toggle-title">Каталог</span>
                        <span class="stc-zh-cats__toggle-icon" aria-hidden="true"></span>
                    </button>

                    <div class="stc-zh-cats__body" id="<?php echo esc_attr($cats_list_id); ?>">
                        <?php if ($parent_link) : ?>
                            <a class="stc-zh-cats__all stc-zh-cats__all--mobile <?php echo ($term instanceof WP_Term && !$term->parent) ? 'is-current' : ''; ?>"
                               href="<?php echo esc_url($parent_link); ?>">
                                Все разделы
                            </a>
                        <?php endif; ?>

                        <ul class="stc-zh-nav__list stc-zh-nav__list--archive">
                            <?php foreach ($nav_terms as $nav_term) :
                                $nav_link = get_term_link($nav_term);
                                if (is_wp_error($nav_link)) {
                                    continue;
                                }
                                $is_current = ($term instanceof WP_Term && (int) $term->term_id === (int) $nav_term->term_id);
                            ?>
                                <li>
                                    <a class="<?php echo $is_current ? 'is-current' : ''; ?>"
                                       href="<?php echo esc_url($nav_link); ?>">
                                        <span><?php echo esc_html($nav_term->name); ?></span>
                                        <em><?php echo (int) $nav_term->count; ?></em>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>

            <div class="stc-zh-toolbar">
                <div>
                    <span class="stc-zh-toolbar__label">Найдено</span>
                    <strong><?php echo esc_html($found_posts); ?> товаров</strong>
                </div>
                <a class="stc-zh-toolbar__link popup-with-form" href="#test-form1">Не нашли нужное? Подберём →</a>
            </div>

            <?php if (have_posts()) : ?>
                <ul class="products columns-4 stc-zh-products">
                    <?php
                    while (have_posts()) :
                        the_post();

                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    endwhile;
                    ?>
                </ul>

                <?php if ($wp_query->max_num_pages > 1) : ?>
                    <nav class="woocommerce-pagination stc-zh-pagination" aria-label="Пагинация товаров">
                        <?php
                        echo paginate_links([
                            'total'     => $wp_query->max_num_pages,
                            'current'   => $paged,
                            'type'      => 'list',
                            'prev_text' => '←',
                            'next_text' => '→',
                        ]);
                        ?>
                    </nav>
                <?php endif; ?>
            <?php else : ?>
                <div class="stc-zh-empty">
                    <h2>Товары в разделе пока не найдены</h2>
                    <p>Оставьте заявку — подберём доработку или оборудование под вашу задачу.</p>
                    <a class="stc-btn stc-btn--primary popup-with-form" href="#test-form1">Получить консультацию</a>
                </div>
            <?php endif; ?>

            <?php if ($seo) : ?>
                <section class="stc-seo stc-zh-seo">
                    <?php echo wp_kses_post($seo); ?>
                </section>
            <?php endif; ?>

        </main>
    </div>
</div>


<script>
(function () {
    'use strict';

    function initZhCatsAccordion() {
        var blocks = document.querySelectorAll('[data-stc-zh-cats]');
        if (!blocks.length) return;

        blocks.forEach(function (block) {
            var toggle = block.querySelector('.stc-zh-cats__toggle');
            if (!toggle) return;

            toggle.addEventListener('click', function () {
                if (window.matchMedia('(min-width: 901px)').matches) return;

                var isOpen = block.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initZhCatsAccordion);
    } else {
        initZhCatsAccordion();
    }
})();
</script>

<?php
if (function_exists('woocommerce_reset_loop')) {
    woocommerce_reset_loop();
}

do_action('woocommerce_after_main_content');
get_footer('shop');

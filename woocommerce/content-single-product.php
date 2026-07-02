<?php
/**
 * Базовый шаблон одиночного товара (вахтовки и прочие)
 * СПРИНТ-06 rev2: фиксы hero, CTA, симметрии
 *
 * @package WooCommerce/Templates
 */
defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'stc-product-page', $product ); ?>>

    <!-- ── Хлебные крошки ───────────────────── -->
    <div class="stc-product-bc">
        <?php echo do_shortcode('[stc_breadcrumbs]'); ?>
    </div>

    <!-- ── Hero ─────────────────────────────── -->
    <section class="stc-product-hero">
        <div class="stc-product-hero__inner">

            <!-- Левая: галерея WooCommerce -->
            <div class="stc-product-gallery">
                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
            </div>

            <!-- Правая: заголовок + цена + summary + форма -->
            <div class="stc-product-summary">

                <h1 class="stc-product-title"><?php the_title(); ?></h1>

                <?php if ( get_field('name') ) : ?>
                    <h2 class="stc-product-subtitle"><?php echo esc_html( get_field('name') ); ?></h2>
                <?php endif; ?>

                <?php if ( get_field('model') ) : ?>
                    <p class="stc-product-model"><?php echo esc_html( get_field('model') ); ?></p>
                <?php endif; ?>

                <div class="stc-product-price">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <hr class="stc-product-divider">

                <div class="summary entry-summary">
                    <?php do_action( 'woocommerce_single_product_summary' ); ?>
                </div>

                <hr class="stc-product-divider">

                <div class="stc-product-form-wrap">
                    <p class="stc-form-title">Оставить заявку</p>
                    <?php echo do_shortcode('[contact-form-7 id="479"]'); ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Полоса преимуществ ───────────────── -->
    <section class="stc-product-features">
        <div class="stc-product-features__inner">
            <div class="stc-feat-item">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/img/icons8-maintenance-100.png' ); ?>" alt="" width="32" height="32">
                <span class="stc-feat-item__text">Бесплатный сервис весь гарантийный срок</span>
            </div>
            <div class="stc-feat-item">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/img/icons8-stacking-100.png' ); ?>" alt="" width="32" height="32">
                <span class="stc-feat-item__text">Склад запчастей постоянного спроса</span>
            </div>
            <div class="stc-feat-item">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/img/icons8-in-transit-100.png' ); ?>" alt="" width="32" height="32">
                <span class="stc-feat-item__text">Возможна бесплатная доставка по России</span>
            </div>
        </div>
    </section>

    <!-- ── Табы WooCommerce ──────────────────── -->
    <section class="stc-product-tabs">
        <div class="stc-product-tabs__inner">
            <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
        </div>
    </section>

    <!-- ── CTA внизу ────────────────────────── -->
    <section class="stc-product-cta">
        <div class="stc-product-cta__inner">
            <p class="stc-cta-heading">Получить коммерческое предложение</p>
            <p class="stc-cta-sub">Ответим в течение 1 рабочего дня. Без навязчивых звонков.</p>
            <?php echo do_shortcode('[contact-form-7 id="479"]'); ?>
        </div>
    </section>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

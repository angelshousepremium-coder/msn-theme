<?php
/**
 * Шаблон товара: Автоцистерны + Вахтовки — v4.3
 */
defined( 'ABSPATH' ) || exit;
global $product, $post;
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) { echo get_the_password_form(); return; }

$sku        = $product->get_sku();
$short_desc = $post->post_excerpt;

$zh_terms = get_the_terms( get_the_ID(), 'zh' );
$has_zh   = $zh_terms && ! is_wp_error( $zh_terms ) && count( $zh_terms ) > 0;
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'stc-product-page', $product ); ?>>

  <!-- SEO JSON-LD -->
  <div style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);" aria-hidden="true">
    <?php do_action( 'woocommerce_single_product_summary' ); ?>
  </div>

  <!-- ── 1. HERO ────────────────────────────────────────── -->
  <div class="stc-hero">

    <div class="stc-gallery">
      <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
      <p class="stc-gallery__disclaimer">Информация носит ознакомительный характер и не является публичной офертой (ст.&nbsp;437 ГК РФ).</p>
    </div>

    <aside class="stc-panel">

      <div class="stc-panel__bc"><?php echo do_shortcode( '[stc_breadcrumbs]' ); ?></div>

      <h1 class="stc-panel__title"><?php the_title(); ?></h1>

      <div class="stc-panel__info-row">
        <div class="stc-panel__info-left">
          <?php if ( get_field( 'name' ) ) : ?>
            <p class="stc-panel__subtitle"><?php echo esc_html( get_field( 'name' ) ); ?></p>
          <?php endif; ?>
          <?php if ( $sku ) : ?>
            <div class="stc-panel__sku">Арт.&nbsp;<strong><?php echo esc_html( $sku ); ?></strong></div>
          <?php endif; ?>
        </div>
        <div class="stc-panel__price">
          <?php echo $product->get_price_html(); ?>
        </div>
      </div>

      <?php if ( $short_desc ) : ?>
        <div class="stc-panel__specs"><?php echo wp_kses_post( $short_desc ); ?></div>
      <?php endif; ?>

      <div class="stc-panel__actions">
        <div class="stc-btn-row-2">
          <?php if ( $has_zh ) : ?>
            <a class="stc-btn-primary popup-with-form" href="#stc-kp-<?php the_ID(); ?>">Оформить заявку</a>
            <div class="stc-btn-placeholder"></div>
            <div id="stc-kp-<?php the_ID(); ?>" class="white-popup-block mfp-hide form-search zap-kp">
              <p>Оформить заявку</p>
              <?php echo do_shortcode( '[contact-form-7 id="7731"]' ); ?>
            </div>
          <?php else : ?>
            <a class="stc-btn-primary popup-with-form" href="#stc-kp-<?php the_ID(); ?>">Получить КП</a>
            <a class="stc-btn-secondary popup-with-form" href="#stc-liz-<?php the_ID(); ?>">Рассчитать лизинг</a>
            <div id="stc-kp-<?php the_ID(); ?>" class="white-popup-block mfp-hide form-search zap-kp">
              <p>Получить КП</p>
              <?php echo do_shortcode( '[contact-form-7 id="575"]' ); ?>
            </div>
            <div id="stc-liz-<?php the_ID(); ?>" class="white-popup-block mfp-hide form-search who-cs">
              <p>Рассчитать лизинг</p>
              <?php echo do_shortcode( '[contact-form-7 id="576"]' ); ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="stc-panel__callback">
          <?php echo do_shortcode( '[contact-form-7 id="6d8f14a"]' ); ?>
        </div>
      </div>

    </aside>
  </div><!-- /.stc-hero -->


  <!-- ── 2. ТАБЫ + ПОХОЖИЕ ТОВАРЫ ──────────────────────── -->
  <section class="stc-tabs-section">
    <div class="stc-tabs-section__inner">
      <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
    </div>
  </section>


  <!-- ── 3. «С НАМИ ВЫГОДНО» — 8 карточек, стиль Image 2 ─ -->
  <section class="stc-advantages">
    <div class="stc-advantages__inner">
      <h2 class="stc-advantages__title">С нами выгодно работать</h2>
      <div class="stc-advantages__grid">

        <div class="stc-adv-card">
          <i class="fa fa-certificate stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Официальный дилер АЗ «Урал». Прямые поставки с завода, гарантия производителя</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-database stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Сформированный склад запчастей постоянного спроса. Оригинальные и аналоговые позиции</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-wrench stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Бесплатная выездная сервисная бригада на весь гарантийный срок</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-users stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Лойяльность всех лизинговых компаний РФ. Аванс от 10%, одобрение за 1 день</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-truck stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Доставка по всей России любым способом. Возможна бесплатная доставка</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-cogs stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Переоборудование и любые доработки спецтехники по требованию заказчика</p>
        </div>

        <div class="stc-adv-card">
          <i class="fa fa-check-circle-o stc-adv-card__icon" aria-hidden="true"></i>
          <p class="stc-adv-card__text">Собственная служба технического контроля. Полный цикл: разработка → сборка → сервис</p>
        </div>

        <div class="stc-adv-card stc-adv-card--accent">
          <div class="stc-adv-card__number">2&nbsp;<span>года</span></div>
          <p class="stc-adv-card__text">Гарантии или 100&nbsp;000&nbsp;км пробега. Гарантийное и сервисное обслуживание</p>
        </div>

      </div>
    </div>
  </section>


  <!-- ── 4. CTA СПЛИТ ─────────────────────────────────── -->
  <section class="stc-cta-split">
    <div class="stc-cta-split__orange">
      <div class="stc-cta-split__content stc-animate">
        <p class="stc-cta-split__heading">Получить коммерческое предложение</p>
        <p class="stc-cta-split__sub">Ответим в течение&nbsp;1 рабочего дня.</p>
        <a href="tel:88006004142" class="stc-cta-split__phone">8&nbsp;800&nbsp;600-41-42</a>
      </div>
      <svg class="stc-cta-split__deco" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="320" cy="200" r="180" stroke="white" stroke-opacity=".07" stroke-width="60"/>
        <circle cx="320" cy="200" r="100" stroke="white" stroke-opacity=".07" stroke-width="40"/>
      </svg>
    </div>
    <div class="stc-cta-split__form">
      <p class="stc-cta-split__form-label">Заполните форму</p>
      <?php echo do_shortcode( '[contact-form-7 id="479"]' ); ?>
    </div>
  </section>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<script>
(function(){
  if(typeof IntersectionObserver==='undefined')return;
  var o=new IntersectionObserver(function(e){e.forEach(function(i){if(i.isIntersecting){i.target.classList.add('stc-visible');o.unobserve(i.target);}});},{threshold:.08});
  document.querySelectorAll('.stc-animate,.stc-adv-card').forEach(function(el){o.observe(el);});
})();
</script>

<?php
/**
 * Блок особенностей — Вахтовки (vakhtovki)
 * Редизайн v3: stc-animate для IntersectionObserver
 */
defined( 'ABSPATH' ) || exit;
$icons = get_template_directory_uri() . '/img/icons/';
?>
<section class="stc-about-features">
  <div class="stc-about-features__inner">

    <div class="stc-about-item stc-animate">
      <div class="stc-about-item__icon">
        <img src="<?php echo esc_url( $icons . 'feature-volume.png' ); ?>" alt="" width="48" height="48" loading="lazy">
      </div>
      <div class="stc-about-item__body">
        <strong>Изготовим автоцистерну любого объёма</strong>
        <span>по требованию заказчика</span>
      </div>
    </div>

    <div class="stc-about-item stc-animate">
      <div class="stc-about-item__icon">
        <img src="<?php echo esc_url( $icons . 'feature-cycle.png' ); ?>" alt="" width="48" height="48" loading="lazy">
      </div>
      <div class="stc-about-item__body">
        <strong>Полный технологический цикл</strong>
        <span>Разработка · Изготовление · Сборка · Контроль · Сервис</span>
      </div>
    </div>

    <div class="stc-about-item stc-animate">
      <div class="stc-about-item__icon">
        <img src="<?php echo esc_url( $icons . 'feature-warranty.png' ); ?>" alt="" width="48" height="48" loading="lazy">
      </div>
      <div class="stc-about-item__body">
        <strong>Технологии увеличения ресурса</strong>
        <span>и снижения эксплуатационных затрат</span>
      </div>
    </div>

    <div class="stc-about-item stc-animate">
      <div class="stc-about-item__icon">
        <img src="<?php echo esc_url( $icons . 'feature-thumbs.png' ); ?>" alt="" width="48" height="48" loading="lazy">
      </div>
      <div class="stc-about-item__body">
        <strong>Всё для удобства</strong>
        <span>Доработки, дооборудование, доставка по РФ, лизинг</span>
      </div>
    </div>

  </div>
</section>

<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
<div class="col-12">
    <?php 
	  $terms = get_the_terms( $post->ID , 'zh' );
	  if ( $terms != null ){ ?>
			<div class="main-product_btn zh_btn">
			  <a class="main-product_btn1 popup-with-form" href="#oformit-zayavku">Оформить заявку</a>
			  <div id="oformit-zayavku" class="white-popup-block mfp-hide form-search zap-kp">
				<p>Оформить заявку</p>
				<?php echo do_shortcode('[contact-form-7 id="7731" title="Оформить заявку"]');?>
			  </div>
			</div>
	  <?php } else { ?>
			<div class="main-product_btn">
			  <a class="main-product_btn1 popup-with-form" href="#test-form4">ПОЛУЧИТЬ КП</a>
			  <div id="test-form4" class="white-popup-block mfp-hide form-search zap-kp">
				<p>ПОЛУЧИТЬ КП</p>
				<?php echo do_shortcode('[contact-form-7 id="575" title="Запросить КП"]');?>
			  </div>
			  <a href="#test-form5" class="main-product_btn3 popup-with-form">РАССЧИТАТЬ ЛИЗИНГ</a>
			  <div id="test-form5" class="white-popup-block mfp-hide form-search who-cs">
				<p>Рассчитать в лизинг</p>
				<?php echo do_shortcode('[contact-form-7 id="576" title="Рассчитать лизинг"]');?>
			  </div>
			</div>
	  <?php } ?>
  </div>
  <div class="col-12"><?php echo do_shortcode( '[contact-form-7 id="6d8f14a" title="Закажите обратный звонок"]'); ?></div>
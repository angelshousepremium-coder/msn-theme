<?php
if(!defined('ABSPATH')){exit;}global $product;?>
<div class="row">
  <div class="col-lg-5">
    <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class','price'));?>">
      <?php echo $product->get_price_html();?>
    </p>
  </div>
  <div class="col-lg-6">
    <div class="main-product_btn">
      <a class="main-product_btn1 popup-with-form" href="#test-form4">Оформить заявку</a>
      <div id="test-form4" class="white-popup-block mfp-hide form-search zap-kp">
        <p>Оформить заявку</p>
        <?php echo do_shortcode('[contact-form-7 id="575" title="Запросить КП"]');?>
      </div>
    </div>
  </div>
</div>

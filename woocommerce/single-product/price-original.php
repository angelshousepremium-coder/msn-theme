<?php
if(!defined('ABSPATH')){exit;}global $product;?>

<div class="row">
  <div class="col-lg-5">
    <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class','price'));?>">
      <?php echo $product->get_price_html();?>
    </p>
  </div>
  <div class="col-lg-7">
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
			  <a class="main-product_btn1 popup-with-form" href="#test-form4">Оформить заявку</a>
			  <div id="test-form4" class="white-popup-block mfp-hide form-search zap-kp">
				<p>Коммерческое предложение</p>
				<?php echo do_shortcode('[contact-form-7 id="575" title="Запросить КП"]');?>
			  </div>
			  <a href="#test-form5" class="main-product_btn3 popup-with-form">Рассчитать лизинг</a>
			  <div id="test-form5" class="white-popup-block mfp-hide form-search who-cs">
				<p>Рассчитать в лизинг</p>
				<?php echo do_shortcode('[contact-form-7 id="576" title="Рассчитать лизинг"]');?>
			  </div>
			</div>
	  <?php } ?>
  </div>
</div>
<div class="item-two">
  <div class="lf-ic">
    <?php
    $link=get_field('downprice');if($link):?>
    <a class="main-product_save_doc" href="<?php echo $link;?>">Скачать PDF</a>
    <?php endif;?>
  </div>
  <div class="rg-ic">
    <?php
    $link=get_field('downprice');if($link):?>
    <a class="print-doc" href="<?php echo $link;?>">Распечатать</a>
    <?php endif;?>
  </div>
</div>


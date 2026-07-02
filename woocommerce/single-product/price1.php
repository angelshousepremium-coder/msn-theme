<?php
if(!defined('ABSPATH')){exit;}global $product;?>

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


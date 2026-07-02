<?php
global $product;
// Extra post classes

?>
<div class="col-sm-auto col-md-2 wr-items">
	<a href="<?php the_permalink(); ?>">
	<div class="item-sale">
		<div class="triangle"></div>
		<div class="text-triangle">АКЦИЯ</div>
	</div>
	<?php $loopImg = get_field('loop-product-img', $product->get_id()); ?>
	<?php if ($loopImg) : ?>
		<img src="<?= $loopImg['url']; ?>" alt="<?= $loopImg['alt']; ?>" />
	<?php else : ?>
		<?= woocommerce_get_product_thumbnail();?>
	<?php endif; ?>
	<div class="item-sale2 text-center">
		<p><?php the_title(); ?></p>
		<?php if ( $price_html = $product->get_price_html() ) : ?>
		<?php echo $price_html;?>
		<?php endif; ?>
	</div>
	</a>
</div>
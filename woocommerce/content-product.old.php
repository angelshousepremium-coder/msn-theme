<?php
/**
 * The template for displaying product content within loops
 *
 * REDESIGN: Premium product card with hover overlay and scale effect.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$loopImg    = get_field( 'cat_file', $product->get_id() );
$product_url = get_permalink( $product->get_id() );
?>
<li <?php wc_product_class( 'stc-product-card', $product ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php echo esc_url( $product_url ); ?>" class="stc-card-link" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">

		<div class="stc-card-image-wrap">
			<?php if ( $loopImg && ! empty( $loopImg['sizes'] ) ) : ?>
				<img
					src="<?php echo esc_url( $loopImg['sizes']['medium'] ); ?>"
					alt="<?php echo esc_attr( $loopImg['alt'] ?: $product->get_name() ); ?>"
					class="stc-card-img"
					loading="lazy"
				/>
			<?php else : ?>
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			<?php endif; ?>

			<div class="stc-card-overlay">
				<span class="stc-card-cta">Подробнее <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
			</div>
		</div>

		<div class="stc-card-body">
			<h3 class="stc-card-title">
				<?php echo esc_html( $product->get_name() ); ?>
			</h3>

			<div class="stc-card-price">
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</div>
		</div>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>

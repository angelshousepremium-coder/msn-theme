<?php
/**
 * Fixed content-single-product.php
 * Variant 3: preserve theme layout but restore WooCommerce hooks and gallery placement
 */
defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Before single product (notices)
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<div class="container pr-t">
		<div class="dam_breadcrumbs"><?php echo do_shortcode('[stc_breadcrumbs]'); ?></div>

		<div class="row">

			<!-- LEFT: Gallery (keep in theme layout) -->
			
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			

			<!-- RIGHT: Summary (title, price, add-to-cart, meta, etc) -->
			<div class="col-lg-6 prdctlg6">
    <div class="main-product_text">
        <div>
            <h1 class="h1product"><?php the_title(); ?></h1> <!-- Добавили заголовок товара -->
            <h2 class="main-product_title"><?php the_field('name'); ?></h2>
            <h3 class="main-product_subtitle"><?php the_field('model'); ?></h3>
        </div>
        <div class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price'));?>">
            <?php echo $product->get_price_html();?>
        </div>
    </div>

    <div class="summary entry-summary">
        <?php
        do_action('woocommerce_single_product_summary');
        ?>
    </div>
</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<!-- block ask questions / offer blocks (preserve theme's markup) -->
	<div class="container-fluid">
		<div class="container mycontainer">
			<div class="row myrow">
				<div class="col-md-3 col-sm-12 col-12">
					<div class="offer-block">
						<img class="offer-block_img" src="<?php echo get_template_directory_uri(); ?>/img/icons8-maintenance-100.png" alt="" width="57" height="57"><span class="offer-span">Бесплатный сервис весь гарантийный срок!</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 col-12">
					<div class="offer-block"><img class="offer-block_img" src="<?php echo get_template_directory_uri(); ?>/img/icons8-stacking-100.png" alt="" width="44" height="57"><span class="offer-span">Сформированный склад запчастей постоянного спроса</span></div>
				</div>
				<div class="col-md-3 col-sm-12 col-12">
					<div class="offer-block"><img class="offer-block_img" src="<?php echo get_template_directory_uri(); ?>/img/icons8-in-transit-100.png" alt="" width="57" height="43"><span class="offer-span">Возможна бесплатная доставка по России</span></div>
				</div>
			</div>
		</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

</div> <!-- #product-## -->

<?php do_action( 'woocommerce_after_single_product' );

<?php
/**
 * Роутер одиночного товара
 *
 * Определяет нужный шаблон по категории товара:
 *   avtotsisterny-ural → content-single-product-sisterni.php
 *   furgony-ural       → content-single-product-furgoni.php
 *   всё остальное      → content-single-product-sisterni.php (вахтовки и прочие)
 *
 * После СПРИНТ-04: vahti больше не имеет отдельного файла шаблона.
 * content-single-product-sisterni.php сам определяет какой template-part подключить.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

// FIX P1: woocommerce_before_main_content перенесён ПЕРЕД циклом.
// Обёртки контента должны открываться до вывода товара.
do_action( 'woocommerce_before_main_content' );

while ( have_posts() ) : the_post();

	if ( has_term( 'avtotsisterny-ural', 'product_cat' ) ) {
		// Автоцистерны
		wc_get_template_part( 'content', 'single-product-sisterni' );

	} elseif ( has_term( 'furgony-ural', 'product_cat' ) ) {
		// Фургоны — собственный уникальный шаблон со своей секцией .why
		wc_get_template_part( 'content', 'single-product-furgoni' );

	} else {
		// Вахтовки и прочие типы — тот же шаблон что и sisterni,
		// внутри подключится single-features-vahti.php
		wc_get_template_part( 'content', 'single-product-sisterni' );
	}

endwhile;

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

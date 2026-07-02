<?php
defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($product->get_image_id() ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="col-lg-6 prdctcl6">
    <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
        
        <a class="kondicioner__link tooltip" title="Выбрать данную опцию можно в разделе - Доработки и переоборудование автотехники" href="localhost/wordpress/montazh-kondiczionera-v-kabinu-ural-nekst"></a>

        <div class="wr-sku">
            <span class="sku_wrapper"><span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>    
            <figure class="woocommerce-product-gallery__wrapper">
                <?php
                if ($product->get_image_id()) {
                    $html = wc_get_gallery_image_html($post_thumbnail_id, true);
                } else {
                    $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                    $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
                    $html .= '</div>';
                }
                echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);
                do_action('woocommerce_product_thumbnails');
                ?>
            </figure>
        </div>
    </div>
    <p style="line-height:14px;font-size:11px;color:#747474; margin-top: 15px;">Обращаем Ваше внимание на то, что вся представленная на сайте информация, касающаяся комплектаций, технических характеристик, цветовых сочетаний, а также стоимости - носит информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 (2) ГК РФ и п.1 ст.435 ГК РФ.</p>
</div>
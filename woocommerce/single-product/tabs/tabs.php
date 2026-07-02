<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

/**
 * Проверяет, есть ли реальный контент у кастомной вкладки.
 * Важно: этот же результат используется и для заголовка, и для панели,
 * чтобы не оставались пустые скрытые панели без пункта меню.
 */
if ( ! function_exists( 'msn_product_tab_has_content' ) ) {
function msn_product_tab_has_content( $tab ) {
    $title = isset( $tab['title'] ) ? wp_strip_all_tags( $tab['title'] ) : '';

    switch ( $title ) {
        case 'Характеристики':
            return (bool) ( get_field( 'char' ) || get_field( 'charimg' ) || get_field( 'char_right' ) );
        case 'Кабина':
            return (bool) ( get_field( 'kabinaimg' ) || get_field( 'kabinagallery' ) || get_field( 'kabinatext1' ) || get_field( 'kabinatext2' ) );
        case 'Двигатель':
            return (bool) ( get_field( 'dvigatelimg' ) || get_field( 'dvigtext' ) || get_field( 'group' ) );
        case 'Коробка':
            return (bool) ( get_field( 'korobka_img' ) || get_field( 'korobkatext' ) || get_field( 'tabs_korobka' ) );
        case 'Установки':
            return (bool) ( get_field( 'ustanovki_bolshoe_foto' ) || get_field( 'ustanovki_gallery' ) );
        case 'Особенности':
            return (bool) get_field( 'osobennosti_tekst' );
        case 'Видео':
            return (bool) get_field( 'dop_tekst' );
        case 'Комплектация':
            return (bool) ( get_field( 'tabll' ) || get_field( 'tabs3' ) || get_field( 'tabs31' ) || get_field( 'tabler' ) );
        case 'КМУ':
            return (bool) ( get_field( 'kmu_img' ) || get_field( 'kmutext' ) );
        case 'Прицеп-цистерна':
            return (bool) ( get_field( 'tabltraoler' ) || get_field( 'imagetrailer' ) || get_field( 'imageslider' ) );
        default:
            // Для сторонних/стандартных вкладок не ломаем вывод: если callback есть, вкладку оставляем.
            return ! empty( $tab['callback'] );
    }
}
}

$visible_tabs = array();
foreach ( $tabs as $key => $tab ) {
    if ( msn_product_tab_has_content( $tab ) ) {
        $visible_tabs[ $key ] = $tab;
    }
}

if ( ! empty( $visible_tabs ) ) : ?>

    <div class="woocommerce-tabs wc-tabs-wrapper">

        <ul class="tabs wc-tabs" role="tablist">
            <?php foreach ( $visible_tabs as $key => $tab ) : ?>
                <li class="<?php echo esc_attr( $key ); ?>_tab"
                    id="tab-title-<?php echo esc_attr( $key ); ?>"
                    role="tab"
                    aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                    <a href="#tab-<?php echo esc_attr( $key ); ?>">
                        <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php foreach ( $visible_tabs as $key => $tab ) : ?>
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab"
                 id="tab-<?php echo esc_attr( $key ); ?>"
                 role="tabpanel"
                 aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>

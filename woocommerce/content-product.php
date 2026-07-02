<?php
/**
 * content-product.php
 * Путь: /wp-content/themes/msn/woocommerce/content-product.php
 */
defined('ABSPATH') || exit;

global $product;
if (empty($product) || !$product->is_visible()) return;

$pid         = $product->get_id();
$loopImg     = get_field('cat_file', $pid);
$product_url = get_permalink($pid);
$price_html  = $product->get_price_html();
$in_stock    = $product->is_in_stock();

// ── Парсер параметров ────────────────────────────────
$map = [
    'колес'    => ['key' => 'formula',  'label' => 'Привод'],
    'формул'   => ['key' => 'formula',  'label' => 'Привод'],
    'мощност'  => ['key' => 'power',    'label' => 'Мощность'],
    'двигател' => ['key' => 'engine',   'label' => 'Двигатель'],
    'коробк'   => ['key' => 'gearbox',  'label' => 'КПП'],
    'шасси'    => ['key' => 'chassis',  'label' => 'Шасси'],
    'бак'      => ['key' => 'tank',     'label' => 'Бак, л'],
    'ёмкост'   => ['key' => 'tank',     'label' => 'Бак, л'],
    'емкост'   => ['key' => 'tank',     'label' => 'Бак, л'],
];

$found = [];
$raw   = get_field('text_for_page_tehnika_v_nalichii', $pid);

if ($raw) {
    // Формат в базе: <strong><span style="...">МЕТКА</span></strong> / <span style="color:...">ЗНАЧЕНИЕ</span>
    // Паттерн 1: <strong>...любые вложенные теги...</strong> / <span>ЗНАЧЕНИЕ</span>
    preg_match_all(
        '/<strong[^>]*>(.*?)<\/strong>\s*\/\s*<span[^>]*>([^<]{1,80})<\/span>/isu',
        $raw, $m1, PREG_SET_ORDER
    );

    // Паттерн 2: <strong>...</strong> / ТЕКСТ (без span у значения)
    if (empty($m1)) {
        preg_match_all(
            '/<strong[^>]*>(.*?)<\/strong>\s*\/\s*([^<\n]{2,80})/isu',
            $raw, $m1, PREG_SET_ORDER
        );
    }

    // Паттерн 3: strip всех тегов, ищем "МЕТКА / ЗНАЧЕНИЕ" по ключевым словам
    if (empty($m1)) {
        $clean = html_entity_decode(
            preg_replace('/<[^>]+>/', ' ', $raw),
            ENT_QUOTES | ENT_HTML5, 'UTF-8'
        );
        $clean = preg_replace('/\s+/', ' ', str_replace("\xc2\xa0", ' ', trim($clean)));
        foreach ($map as $key => $info) {
            if (preg_match('/' . preg_quote($info['label'], '/') . '[^\/]{0,20}\s*\/\s*([^\n\/]{1,60})/iu', $clean, $vm)) {
                $val_c = trim($vm[1]);
                if (mb_strlen($val_c) > 1) {
                    $found[$info['key']] = ['label' => $info['label'], 'value' => $val_c];
                }
            }
        }
    }

    $skip_values = ['нет параметра', 'не указано', 'нет данных', 'н/д', '-', '—', ''];

    foreach ($m1 as $pair) {
        // Метка: strip_tags от содержимого <strong> (может быть <span> внутри)
        $lbl_raw = mb_strtolower(trim(strip_tags(
            html_entity_decode($pair[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')
        )));
        // Значение
        $val = trim(strip_tags(
            html_entity_decode($pair[2], ENT_QUOTES | ENT_HTML5, 'UTF-8')
        ));
        $val = trim(preg_replace('/\s+/', ' ', str_replace("\xc2\xa0", ' ', $val)));

        if (mb_strlen($lbl_raw) < 2 || mb_strlen($val) < 1 || mb_strlen($val) > 80) continue;
        if (in_array(mb_strtolower($val), $skip_values)) continue;

        foreach ($map as $key => $info) {
            if (mb_strpos($lbl_raw, $key) !== false && empty($found[$info['key']])) {
                $found[$info['key']] = ['label' => $info['label'], 'value' => $val];
            }
        }
    }
}

// Берём max 3 параметра в порядке приоритета
$priority = ['formula', 'power', 'gearbox', 'chassis', 'engine', 'tank'];
$params   = [];
foreach ($priority as $k) {
    if (!empty($found[$k])) {
        $params[] = $found[$k];
        if (count($params) === 3) break;
    }
}
?>
<li <?php wc_product_class('stc-product-card', $product); ?>>
    <a href="<?php echo esc_url($product_url); ?>"
       class="stc-card-inner"
       aria-label="<?php echo esc_attr($product->get_name()); ?>">

        <!-- Фото -->
        <div class="stc-card-img-wrap">
            <?php if ($loopImg && !empty($loopImg['url'])) : ?>
                <img class="stc-card-img"
                     src="<?php echo esc_url($loopImg['sizes']['medium'] ?? $loopImg['url']); ?>"
                     alt="<?php echo esc_attr($loopImg['alt'] ?: $product->get_name()); ?>"
                     loading="lazy" width="600" height="400">
            <?php else : ?>
                <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
            <?php endif; ?>
            <span class="stc-card-badge stc-card-badge--<?php echo $in_stock ? 'instock' : 'order'; ?>">
                <?php echo $in_stock ? 'В наличии' : 'Под заказ'; ?>
            </span>
            <div class="stc-card-overlay" aria-hidden="true">
                <span class="stc-card-overlay-btn">Подробнее →</span>
            </div>
        </div>

        <!-- Тело -->
        <div class="stc-card-body">
            <h4 class="stc-card-title"><?php echo esc_html($product->get_name()); ?></h4>

            <!-- Характеристики — 3 блока -->
            <?php if (!empty($params)) : ?>
            <div class="stc-card-specs">
                <?php foreach ($params as $p) : ?>
                <div class="stc-card-spec">
                    <span class="stc-card-spec__label"><?php echo esc_html($p['label']); ?></span>
                    <span class="stc-card-spec__value"><?php echo esc_html($p['value']); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <div class="stc-card-specs stc-card-specs--empty"></div>
            <?php endif; ?>

            <?php if ($price_html) : ?>
            <div class="stc-card-price"><?php echo $price_html; ?></div>
            <?php endif; ?>

            <span class="stc-card-cta">Запросить цену →</span>
        </div>

    </a>
</li>

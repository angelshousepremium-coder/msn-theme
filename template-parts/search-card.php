<?php
/**
 * Search result card
 * Путь: /wp-content/themes/msn/template-parts/search-card.php
 */
if ( ! defined('ABSPATH') ) { exit; }
$term = '';
if ( isset($args['term']) ) {
    $term = (string) $args['term'];
}
$post_type = get_post_type();
$sku = ( $post_type === 'product' ) ? get_post_meta( get_the_ID(), '_sku', true ) : '';
$label = function_exists('stc_get_search_type_label') ? stc_get_search_type_label($post_type) : get_post_type_object($post_type)->labels->singular_name;
$thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
?>
<article class="stc-search-card">
    <a class="stc-search-card__media" href="<?php the_permalink(); ?>">
        <?php if ( $thumb ) : ?>
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else : ?>
            <span>STK</span>
        <?php endif; ?>
    </a>
    <div class="stc-search-card__body">
        <div class="stc-search-card__meta">
            <span><?php echo esc_html($label); ?></span>
            <?php if ( $sku ) : ?><span>Арт. <?php echo esc_html($sku); ?></span><?php endif; ?>
        </div>
        <h3><a href="<?php the_permalink(); ?>"><?php echo function_exists('stc_search_highlight') ? stc_search_highlight( get_the_title(), $term ) : esc_html( get_the_title() ); ?></a></h3>
        <p><?php echo function_exists('stc_get_search_excerpt') ? stc_get_search_excerpt( get_the_ID(), $term, 22 ) : esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
        <a class="stc-search-card__more" href="<?php the_permalink(); ?>">Открыть страницу →</a>
    </div>
</article>

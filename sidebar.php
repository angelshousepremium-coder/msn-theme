<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package msn
 */


 if ( is_active_sidebar( 'sidebar-1' ) && !is_tax('zh') ) : ?>
<aside id="secondary" class="widget-area">
<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-2' ) && is_tax('zh') ) : ?>
<aside id="secondary" class="widget-area">
<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
<?php endif; ?>


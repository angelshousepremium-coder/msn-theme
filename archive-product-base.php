<?php
/**
 * Базовый шаблон архива категорий товаров
 * Путь: /wp-content/themes/msn/archive-product-base.php
 *
 * СПРИНТ-05: Переработка страницы категории — новый дизайн, чистый HTML.
 * Разметка приведена в соответствие с классами из css/catalog.css.
 *
 * Роутинг (WordPress ищет файлы в корне темы по имени):
 *   archive-product-sisterni.php → require на этот файл
 *   archive-product-furgoni.php  → require на этот файл
 *   archive-product-vahti.php    → require на этот файл
 */
defined('ABSPATH') || exit;
echo '<!-- LOADED: archive-product-base.php SPRINT-05 -->';
get_header('shop');
do_action('woocommerce_before_main_content');

// Текущая категория — нужна для ACF и условного нижнего блока
$term     = get_queried_object();
$cat_slug = isset($term->slug) ? $term->slug : '';
?>

<div class="container tem2">
<div class="container-item desctop-nortopt">

	<header class="woocommerce-products-header"></header>

	<!-- ── Хлебные крошки ─────────────────────────────────── -->
	<div class="dam_breadcrumbs"><?php echo stc_custom_breadcrumbs(); ?></div>

	<!-- ── Основная двухколоночная раскладка ──────────────── -->
	<div class="stc-layout">

		<!-- Левая колонка: навигация по категориям -->
		<aside class="stc-sidebar-col" role="complementary">
			<div class="stc-sidebar-inner">
				<span class="stc-sidebar-label">Категории</span>
				<?php get_sidebar(); ?>
			</div>
		</aside>

		<!-- Правая колонка: весь контент категории -->
		<main class="stc-main-col">

			<!-- ── Заголовок и описание категории ──────────── -->
			<div class="stc-cat-header">
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php
				// Описание категории (стандартный WC action)
				$desc = term_description($term->term_id, 'product_cat');
				if ( $desc ) :
				?>
					<div class="stc-cat-desc"><?php echo wp_kses_post($desc); ?></div>
				<?php endif; ?>
			</div>

			<!-- ── Подкатегории из ACF repeater 'subcategory' ─ -->
			<?php if ( have_rows('subcategory', $term) ) : ?>
			<ul class="stc-subcats">
				<?php while ( have_rows('subcategory', $term) ) : the_row();
					$image   = get_sub_field('img');
					$content = get_sub_field('text');
					$link    = get_sub_field('link');
				?>
					<li>
						<?php if ( $link ) : ?>
							<a href="<?php echo esc_url($link); ?>" class="stc-subcat-card">
						<?php else : ?>
							<div class="stc-subcat-card">
						<?php endif; ?>

						<?php if ( $image ) : ?>
							<img src="<?php echo esc_url($image['url']); ?>"
							     alt="<?php echo esc_attr($image['alt'] ?: $content); ?>"
							     loading="lazy">
						<?php endif; ?>

						<span class="stc-subcat-label"><?php echo esc_html($content); ?></span>

						<?php echo $link ? '</a>' : '</div>'; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>

			<!-- ── Фильтры: sidebar-3 (виджеты WooCommerce) ── -->
			<?php if ( is_active_sidebar('sidebar-3') ) : ?>
			<div class="filter-tehnika" id="catalog-filters">
				<?php dynamic_sidebar('sidebar-3'); ?>
			</div>
			<?php endif; ?>

			<!-- ── Сетка товаров ───────────────────────────── -->
			<?php if ( woocommerce_product_loop() ) :

				do_action('woocommerce_before_shop_loop');

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop('total') ) :
					while ( have_posts() ) : the_post();
						do_action('woocommerce_shop_loop');
						wc_get_template_part('content', 'product');
					endwhile;
				endif;

				woocommerce_product_loop_end();

				do_action('woocommerce_after_shop_loop');

			else :
				do_action('woocommerce_no_products_found');
			endif; ?>

			<!-- ── SEO-текст категории из ACF поля 'seo' ───── -->
			<?php
			$seo = get_field('seo', $term);
			if ( $seo ) :
			?>
				<div class="seo-field">
					<?php echo wp_kses_post($seo); ?>
				</div>
			<?php endif; ?>

			<?php
			/**
			 * Нижний блок: условный по категории.
			 *
			 * Ищет: template-parts/archive-bottom-{slug}.php
			 * Фолбэк: template-parts/archive-bottom-default.php
			 *
			 * Слаги:
			 *   avtotsisterny-ural → archive-bottom-avtotsisterny-ural.php
			 *   furgony-ural       → archive-bottom-furgony-ural.php
			 *   vakhtovki и прочие → archive-bottom-default.php
			 */
			$safe_slug   = sanitize_file_name($cat_slug);
			$bottom_part = locate_template(
				'template-parts/archive-bottom-' . $safe_slug . '.php'
			);

			if ( $bottom_part ) {
				get_template_part('template-parts/archive-bottom', $safe_slug);
			} else {
				get_template_part('template-parts/archive-bottom', 'default');
			}
			?>

		</main>
		<!-- конец .stc-main-col -->

	</div>
	<!-- конец .stc-layout -->

</div>
</div>

<!-- ── CTA-форма ──────────────────────────────────────────── -->
<div class="blok_zvonok_form title lada">
	<div class="blok_1140 container">
		<div class="row">
			<div class="blok_form">
				<div class="h1m">Мы будем рады ответить на все Ваши вопросы!</div>
				<div class="h1 polosa_h">Укажите своё имя и телефон</div>
				<p>Наш менеджер свяжется с вами максимально быстро</p>
				<?php echo do_shortcode('[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>
			</div>
		</div>
	</div>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');

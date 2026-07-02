<?php
/**
 * Archive template for WooCommerce products.
 *
 * REDESIGN: Unified template — replaces archive-product-furgoni.php,
 * archive-product-sisterni.php, archive-product-vahti.php (identical duplicates removed).
 *
 * OWL Carousel removed from subcategory grid — CSS grid + scroll used instead.
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>

<div class="container stc-archive-wrap">
	<div class="container-item desctop-nortopt">

		<div class="row">
			<div class="col-12">
				<nav class="stc-breadcrumbs" aria-label="Навигация">
					<?php echo stc_custom_breadcrumbs(); ?>
				</nav>
			</div>
		</div>

		<div class="row stc-archive-layout">

			<!-- Sidebar -->
			<div class="col col-lg-2 ver-tabs stc-sidebar">
				<?php get_sidebar(); ?>
			</div>

			<!-- Main content -->
			<div class="col-lg-10 stc-archive-main">

				<header class="stc-archive-header">
					<h1 class="stc-archive-title"><?php woocommerce_page_title(); ?></h1>
					<?php do_action( 'woocommerce_archive_description' ); ?>
				</header>

				<!-- Subcategories (ACF repeater) -->
				<?php
				$term = get_queried_object();
				if ( have_rows( 'subcategory', $term ) ) :
				?>
				<div class="stc-subcats">
					<?php while ( have_rows( 'subcategory', $term ) ) : the_row();
						$image   = get_sub_field( 'img' );
						$content = get_sub_field( 'text' );
						$link    = get_sub_field( 'link' );
					?>
					<div class="stc-subcat-card">
						<?php if ( $link ) : ?>
							<a href="<?php echo esc_url( $link ); ?>" class="stc-subcat-link">
						<?php endif; ?>
							<div class="stc-subcat-img-wrap">
								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy" />
							</div>
							<?php if ( $content ) : ?>
								<span class="stc-subcat-label"><?php echo esc_html( $content ); ?></span>
							<?php endif; ?>
						<?php if ( $link ) : ?>
							</a>
						<?php endif; ?>
					</div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>

				<!-- Filter -->
				<div class="filter-tehnika stc-filter">
					<?php if ( is_active_sidebar( 'sidebar-3' ) && is_tax( '' ) || is_shop() ) : ?>
						<div id="secondary" class="sidebar-container" role="complementary">
							<div class="widget-area"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
						</div>
					<?php endif; ?>
				</div>

				<!-- Product loop -->
				<?php if ( woocommerce_product_loop() ) :
					do_action( 'woocommerce_before_shop_loop' );
					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();
					do_action( 'woocommerce_after_shop_loop' );
				else :
					do_action( 'woocommerce_no_products_found' );
				endif; ?>

				<!-- SEO text -->
				<div class="seo-field">
					<?php
					$seo = get_field( 'seo', $term );
					echo $seo;
					?>
				</div>

				<!-- Service blocks -->
				<div class="inner_content">
					<div class="blcok_spec">
						<div class="spec_services_list list_for">
							<a class="item_spec item_inline" href="https://rscural.ru/">
								<span class="top_spec">
									<span class="img_spec serv"></span>
									<span class="price_spec">Сертифицированные сервисные центры Урал</span>
								</span>
								<span class="bottom_spec">
									<span class="title_spec">🗸 Модернизации и доработки техники<br>
🗸 Переоборудование на газ<br>
🗸 Установка дополнительного оборудования<br>
🗸 Гарантийное обслуживание, техобслуживание и ремонт</span>
									<span class="btn_list">Подробнее</span>
								</span>
							</a>
							<a class="item_spec item_inline" href="https://z.spectechcom.ru/">
								<span class="top_spec">
									<span class="img_spec"></span>
									<span class="price_spec">Запчасти для автомобилей Урал от официального дилера</span>
								</span>
								<span class="bottom_spec">
									<span class="title_spec">🗸 Только оригинальные запчасти к а/м Урал<br>
🗸 Более 10 000 наименований запчастей в продаже<br>
🗸 Выгодные цены на поставку запчастей в регионы Дальнего Востока</span>
									<span class="btn_list">Подробнее</span>
								</span>
							</a>
						</div>
					</div>
				</div>

			</div><!-- /.stc-archive-main -->
		</div><!-- /.row -->
	</div>
</div>

<!-- Callback form -->
<div class="blok_zvonok_form title lada">
	<div class="blok_1140 container">
		<div class="row">
			<div class="blok_form">
				<div class="h1m">Мы будем рады ответить на все Ваши вопросы!</div>
				<div class="h1 polosa_h">Укажите своё имя и телефон</div>
				Наш менеджер свяжется с вами максимально быстро
				<?php echo do_shortcode( '[contact-form-7 id="479" title="Получить консультацию специалиста"]' ); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer( 'shop' ); ?>

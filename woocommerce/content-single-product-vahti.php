<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see	 https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
	<div class="container pr-t">
			<div class="dam_breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
		<div class="row">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action('woocommerce_before_single_product_summary');
			?>
			<div class="col-lg-5 prdctlg5">
				<div class="main-product_text">
				<div>
					<h2 class="main-product_title"><?php the_field('name'); ?></h2>
					<h3 class="main-product_subtitle"><?php the_field('model'); ?></h3>
					</div>
														  <!--<div class="col-lg-5">
    <p class="ask">
    Цена по запросу
    </p>
  </div> -->

    <div class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class','price'));?>">
      <?php echo $product->get_price_html();?>
    </div>
				</div>

				<div class="summary entry-summary">
					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action('woocommerce_single_product_summary');
					?>

				</div>

			</div>
			<!-- end col-lg-6 -->

		</div>
		<!-- end row -->
	</div>
	<!-- end container -->

	<!-- block ask questions -->
	<div class="container">
<div class="about-feature">
          
          <div class="about-feature-item">
            <img src="/wp-content/uploads/2025/05/volume-3.png" alt="icon">
            <p><strong>Изготовим автоцистерну любого объема</strong><br> по требованию заказчика</p>
          </div>

          
          <div class="about-feature-item">
            <img src="/wp-content/uploads/2025/05/360-view-1.png" alt="icon">
            <p><strong>Полный технологический цикл производства</strong><br>Разработка-Изготовление-Сборка-Контроль-Сервис</p>
          </div>

          
          <div class="about-feature-item">
            <img src="/wp-content/uploads/2025/05/warranty-2.png" alt="icon">
            <p><strong>Технологии для увеличения срока эксплуатации</strong><br> и уменьшения затрат</p>
          </div>

          
          <div class="about-feature-item">
            <img src="/wp-content/uploads/2025/05/thumbs-up.png" alt="icon">
            <p><strong>Все для удобства</strong><br>Доработки и дооборудование.<br> Доставка по РФ бесплатно. Лизинг.</p>
          </div>

                  </div></div>
	<!-- end ask questions -->



	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>
</div>
<section class="why">
      <div class="container">
        <h2 class="h2s">Почему клиенты <span>выбирают нас?</span></h2>
        <div class="why-list">
                    <img src="/wp-content/uploads/2025/05/img-kopiya.webp" alt="img" class="why-img">

          
          <div class="why-list-item">
            <div class="why-list-item-inner">
              <img src="/wp-content/uploads/2025/05/2.webp" alt="icon">
              <p class="tit">Собственное производство</p>
              <p class="desc">Полный цикл изготовления цистерн и выдача ЭПТС.</p>
            </div>
          </div>

          
          <div class="why-list-item">
            <div class="why-list-item-inner">
              <img src="/wp-content/uploads/2025/05/5.webp" alt="icon">
              <p class="tit">Гибкая форма оплаты</p>
              <p class="desc">Покупка автотехники в лизинг. Простая процедура оформления сделки</p>
            </div>
          </div>

          
          <div class="why-list-item">
            <div class="why-list-item-inner">
              <img src="/wp-content/uploads/2025/05/4.webp" alt="icon">
              <p class="tit">Собственное конструкторское бюро</p>
              <p class="desc">Контроль качества всех производственных процессов изготовления продукции.</p>
            </div>
          </div>

          
          <div class="why-list-item">
            <div class="why-list-item-inner">
              <img src="/wp-content/uploads/2025/05/3.webp" alt="icon">
              <p class="tit">Гарантия качества</p>
              <p class="desc">2 года гарантии или 100 тыс. км. пробега, гарантийное и сервисное обслуживание</p>
            </div>
          </div>

          
          <div class="why-list-item">
            <div class="why-list-item-inner">
              <img src="/wp-content/uploads/2025/05/1.webp" alt="icon">
              <p class="tit">Точное соблюдение сроков</p>
              <p class="desc">Срок изготовления автоцистерны - до 30 рабочих дней.</p>
            </div>
          </div>

                  </div>
      </div>
    </section>
<div class="blok_zvonok_form title lada">
	<div class="blok_1140 container">
		<div class="row">
			<div class="blok_form">
				<div class="h1m">
				Мы будем рады ответить на все Ваши вопросы!				</div>
				<div class="h1 polosa_h">
					 Укажите своё имя и телефон
				</div>
				 Наш менеджер свяжется с вами максимально быстро
	    <?php echo do_shortcode( '[contact-form-7 id="479" title="Получить консультацию специалиста"]'); ?>		</div>
		</div>
	</div>
</div>



<?php do_action('woocommerce_after_single_product'); ?>
<?php
 defined('ABSPATH')||exit;get_header('shop');do_action('woocommerce_before_main_content');?>
<div class="container tem2"><div class="container-item desctop-nortopt">
	<header class="woocommerce-products-header">
		<?php if(apply_filters('woocommerce_show_page_title',true)):?><?php endif;?>
		
	</header>
		
	<div class="row"><div class="dam_breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div></div>

	<div class="row">

		<div class="col col-lg-2 ver-tabs"> 
			<?php get_sidebar();?>
		</div>
		<div class="col-lg-9">
			<h1 class="woocommerce-products-header__title page-title"> <?php woocommerce_page_title();?> </h1>
				<?php do_action('woocommerce_archive_description');?>
					<div class="horsmen"> <?php /*  echo wpv_show_curent_tax(); */?></div>
					<div class="horsmen-vnalicii"> 
						<?php 
							$term=get_queried_object(); 
							if(have_rows('subcategory',$term)):?>
								<ul class="slides row"> 
									<?php while(have_rows('subcategory',$term)):the_row();$image=get_sub_field('img');$content=get_sub_field('text');$link=get_sub_field('link');?>
										<li class="slide"> 
											<?php if($link):?> 
												<a href="<?php echo $link;?>"> 
											<?php endif;?>
											<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt']?>" />
											<?php if($link):?>
												<h2> <?php echo $content;?></h2> 
												</a> 
											<?php endif;?>
										</li> 
									<?php endwhile;?>
								</ul> 
							<?php endif;?>
					</div>
			
			<div class="filter-tehnika"> 
				<?php if(is_active_sidebar('sidebar-3')&&is_tax('')||is_shop()):?>
					<div id="secondary" class="sidebar-container" role="complementary">
						<div class="widget-area"> <?php dynamic_sidebar('sidebar-3');?></div>
					</div> 
				<?php endif;?>
			</div>
			<style>.product-thumbnail-wrapper img{display:none}</style>
			<?php if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
} ?>
<div class="seo-field"> <?php $term=get_queried_object();$seo=get_field('seo',$term);echo $seo;?></div>

<div class="inner_content">
<div class="blcok_spec">
<div class="spec_services_list list_for">
   <a class="item_spec item_inline" href="https://rscural.ru/">
   
  	 <span class="top_spec">
   		<span class="img_spec serv"></span>
   		<span class="price_spec">
				Сертифицированные сервисные центры Урал
<i class="fa fa-rub" aria-hidden="true"></i></span>
  	 </span>
   	<span class="bottom_spec">
   		<span class="title_spec">🗸 Модернизации и доработки техники<br>
🗸 Переоборудование на газ<br>
🗸 Установка дополнительного оборудования<br>
🗸 Гарантийное обслуживание, техобслуживание и ремонт<br></span>
  		 <span class="btn_list">Подробнее</span>
   	</span>
    
   </a>
   <a class="item_spec item_inline" href="https://z.spectechcom.ru/">
   
  	 <span class="top_spec">
   		<span class="img_spec"></span>
   		<span class="price_spec">
				Запчасти для автомобилей Урал от официального дилера <i class="fa fa-rub" aria-hidden="true"></i></span>
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
		</div>

<script type="text/javascript">
              $(document).ready (function delshow() {
              jQuery(".product-thumbnail-wrapper a").each(function(){
                var gi=jQuery(this).attr("data-product_id");
                $.post(
  "/index.php",
  {
    param1: gi,
    param2: 2
  },
  onAjaxSuccess
);
              });
            })
function onAjaxSuccess(data)
{
  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
  var sg=data.split('|');
if (sg[0]!='no'){
//  alert(sg[1]);
//  alert(sg[0]);
  jQuery("#product-row-"+sg[1]+" .product-thumbnail-wrapper img").css('height','125px');
  jQuery("#product-row-"+sg[1]+" .product-thumbnail-wrapper img").attr('src',sg[0]);
  jQuery("#product-row-"+sg[1]+" .product-thumbnail-wrapper img").css('display','block');
}
else {
jQuery("#product-row-"+sg[1]+" .product-thumbnail-wrapper img").css('display','block');
}
}
          </script>
            <!-- end col-md-9 col-lg-9 col-xl-10 -->
</div>
</div>
</div>


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

<?php  get_footer('shop');
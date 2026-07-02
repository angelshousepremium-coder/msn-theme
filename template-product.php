<?php
/* Template Name: Страница категории товара */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="container-pr">
		<div class="dam_breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<div class="seotext">
			<?php
             $term = get_queried_object();
             $seo = get_field('seotext', $term);
             echo $seo;
			?>
			</div>	
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

<!-- end conainer-pr -->
		</main><!-- #main -->
	</div><!-- #primary -->

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
<?php
// get_sidebar();
get_footer();

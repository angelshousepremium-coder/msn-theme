<?php
/*
* Template name: template - Информационные материалы
*/
 get_header(); ?>
<div class="container-item desctop-nortopt">
<div class="dam_breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
<section class="info_slider owl-carousel">
	<div class="slide" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/slide1.jpg);">
		<div class="container2">
			<p>УРАЛ - ВСЕГДА УНИКАЛЬНЫЕ РЕШЕНИЯ, ОРИЕНТИРОВАННЫЕ НА КЛИЕНТА.</p>
		</div>
	</div>
	<div class="slide" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/slide2.jpg);">
		<div class="container2">
			<p>УРАЛ - НА СЛУЖБЕ В МИРНОЕ И ВОЕННОЕ ВРЕМЯ.</p>
		</div>
	</div>
</section>	
<section class="info_sec">
	<div class="container2">
		<p>Мы собрали для вас самую интересную и полезную информацию о спецтехнике на базе Урал. <br>Если У вас есть интересные, новости, анонсы, объявления пишите на наш <span>email: office@spectechcom.ru</span>, мы будем признательны. <br>Любое копирование материалов, только с активной ссылкой на <a href="localhost/wordpress/">“ПКФ Спецтехкомплект”</a></p>
	</div>
</section>
<section class="info_posts">
	<div class="container">
		<div class="block flex">
			<?php
global $post;
$args = array( 'numberposts' => 9 , 'category' => 830, 'orderby' => 'date');
$myposts = get_posts( $args );
foreach( $myposts as $post ){ setup_postdata($post);
?>
<div class="iw-get-post">
<div class="post-img"><?php the_post_thumbnail('thumbnail'); ?></div>
<div class="post-txt">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php the_excerpt(); ?>
<div class="post-date"><?php echo get_the_date('j F Y'); ?></div>
</div>
</div>
<?php
}
wp_reset_postdata();
?>
		</div>		
	</div>

</section>
</div>
<?php get_footer(); ?>
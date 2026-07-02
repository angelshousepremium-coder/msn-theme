<?php
if(!defined('ABSPATH')){exit;}$tabs=apply_filters('woocommerce_product_tabs',array());if(!empty($tabs)):?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
	<?php  $i=0;foreach($tabs as $key=>$tab){$i++;}?>
		<ul class="tabs wc-tabs" role="tablist">
			<?php  foreach($tabs as $key=>$tab):$bool=false;
			    switch($tab['title'])
				{
				case 'Характеристики':if(get_field('char') or get_field('charimg')){$bool=true;}break;
				case 'Кабина':if(get_field('kabinaimg') or get_field('kabinagallery') or get_field('kabinatext1') or get_field('kabinatext2')){$bool=true;}break;
				case 'Двигатель':if(get_field('dvigatelimg') or get_field('dvigtext')){$bool=true;}break;
				case 'Коробка':if(get_field('korobka_img') or get_field('korobkatext')){$bool=true;}break;
				case 'Особенности':if(get_field('osobennosti_tekst') ){$bool=true;}break;
				case 'Видео':if(get_field('dop_tekst') ){$bool=true;}break;
				case 'Комплектация':if(get_field('tabll') or get_field('tabs3') or get_field('tabs31') or get_field('tabler')){$bool=true;}break;
				case 'КМУ':if(get_field('kmu_img') or get_field('kmutext')){$bool=true;}break;
				case 'Прицеп-цистерна':if(get_field('tabltraoler') or get_field('imagetrailer') or get_field('imageslider')){$bool=true;}break;
				}
				if($bool==true){?>
				<li class="<?php echo esc_attr($key);?>_tab" id="tab-title-<?php echo esc_attr($key);?>" role="tab" aria-controls="tab-<?php echo esc_attr($key);?>">
					<a href="#tab-<?php echo esc_attr($key);?>"><?php echo apply_filters('woocommerce_product_'.$key.'_tab_title',esc_html($tab['title']),$key);?></a>
				</li>	
			<?php  }endforeach;?>
		</ul>
		
		<?php foreach($tabs as $key=>$tab):?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key);?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key);?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr($key);?>">
				<?php if(isset($tab['callback'])){call_user_func($rr=$tab['callback'],$key,$tab);}?>
			</div>
		<?php endforeach;?>
	</div>

<?php endif;?>

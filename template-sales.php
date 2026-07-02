<?php
/* Template Name: Распродажи и акции */
get_header();
?>
<!-- section sales -->
<div class="sec2-h">
	<div class="container-fluid section4">
	<div class="container11">
		<h2 class="entry-title text-center"><span class="underline underline--dotted">РАСПРОДАЖА</span></h2>
		<div class="justify-content-md-center" style="text-align:center;">
			<?php echo do_shortcode("[sale_products columns='4' per_page='200']"); ?>
		</div>
	</div>
	</div>
		</div>
	<!-- end sales section -->
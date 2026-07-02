<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package msn
 */

get_header();
?>
<div class="container-item desctop-nortopt">

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
<div class="container">
<div class="dam_breadcrumbs">
		<?php echo do_shortcode('[stc_breadcrumbs]'); ?>
	</div>
</div>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.


		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
// get_sidebar();
get_footer();

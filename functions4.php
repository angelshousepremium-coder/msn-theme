<?php
/**
 * msn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package msn
 */
 add_filter( 'frm_use_inbox', '__return_false' );
 /* ============================
    Редирект с wp-admin
=========================== */
 add_action( 'init', 'blockusers_init' );
 function blockusers_init() {
	 if ( is_admin() && ! current_user_can( 'administrator' ) && ! current_user_can( 'editor' ) && ! current_user_can( 'shop_staff' )&& ! current_user_can( 'shop_manager' )&&
		 ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		 wp_redirect( home_url() );
		 exit;
	 }
}

/* ============================
    Редирект с wp-login.php
=========================== */

add_action('init','redirect_login_page');


function redirect_login_page() {
    $page_viewed = basename($_SERVER['REQUEST_URI']);
    $result = strpos($page_viewed, 'wp-login.php');


    if($result !== false) {
        wp_redirect( home_url( '/404/' ) );
        exit;
    }
}

/* ============================
    Смена адресов на новый
=========================== */

add_filter('site_url', 'wplogin_filter', 10, 3);

function wplogin_filter( $url, $path, $orig_scheme ) {
    $old = array( "/(wp-login.php)/");
    $new = array( "7x6Hmm7G.php");
    return preg_replace( $old, $new, $url, 1);
}

add_action('wp_logout','logout_page');
function logout_page() {  
    $login_page  = home_url( 'wp-admin' );  
    wp_redirect( $login_page . "?loggedout=true" );  
    exit;  
}

include_once(WP_PLUGIN_DIR.'/advanced-custom-fields-pro/acf.php'); 

add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);


add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );



// Display fontawesome search icon in menus and toggle search form 

function add_search_form($items, $args) {
if( $args->theme_location == 'primary' )
       $items .= '<li class="search"><a class="search_icon"><i class="fa fa-search"></i></a><div style="display:none;" class="spicewpsearchform">'. get_search_form(false) .'</div></li>';
       return $items;
}
add_filter('wpcf7_form_elements', function($content) {
  $content = str_replace('<span', '<div', $content);
  $content = str_replace('</span', '</div', $content);
  return $content;
});

add_filter( 'wpcf7_validate_text', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_text*', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_textarea', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_textarea*', 'no_urls_allowed', 10, 3 );
function no_urls_allowed( $result, $tag ) {

	$tag = new WPCF7_Shortcode( $tag );

	$type = $tag->type;
	$name = $tag->name;

	$value = isset( $_POST[$name] )
		? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
		: '';

	// If this is meant to be a URL field, do nothing
	if ( 'url' == $tag->basetype || stristr($name, 'url') ) {
		return $result;
	}

	// Check for URLs
	$value = $_POST[$name];
	$not_allowed = array( 'http://', 'https://', 'www.', '[url', '<a ', ' seo ', '.com', '.net', '.org', '.xyz', '.ga', '.ru', '.ly' );
	foreach ( $not_allowed as $na ) {
		if ( stristr( $value, $na ) ) {
			$result->invalidate( $tag, 'URLs are not allowed' );
			return $result;
		}
	}
	return $result;
}

//Оптимизация//
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// Disable Gutenberg editor.
/*add_filter('use_block_editor_for_post_type', '__return_false', 10);*/

// Don't load Gutenberg-related stylesheets.
/*add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );*/

function remove_block_css() {
   /* wp_dequeue_style( 'wp-block-library' ); // Wordpress core*/
    wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce
    wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}


add_action( 'wp_print_styles',     'my_deregister_styles', 100 );

function my_deregister_styles()    { 
   //wp_deregister_style( 'amethyst-dashicons-style' ); 
   //wp_deregister_style( 'dashicons' ); 
}

// ПРАВИЛЬНОЕ ПОДКЛЮЧЕНИЕ СКРИПТОВ
// УДАЛЯЕМ ВСЕ СТАРЫЕ ПОДКЛЮЧЕНИЯ СКРИПТОВ
function clean_script_loading() {
    // Удаляем все старые обработчики
    remove_action('wp_enqueue_scripts', 'theme_scripts');
    remove_action('wp_enqueue_scripts', 'my_scripts_method'); 
    remove_action('wp_enqueue_scripts', 'msn_scripts');
    remove_action('wp_enqueue_scripts', 'proper_theme_scripts');
}
add_action('wp_head', 'clean_script_loading', 1);

// ПРАВИЛЬНОЕ ПОДКЛЮЧЕНИЕ СКРИПТОВ
function final_theme_scripts() {
    // 1. jQuery (WordPress встроенная)
    wp_enqueue_script('jquery');
    
    // 2. OWL Carousel из CDN (гарантированно работает)
    wp_enqueue_script(
        'owl-carousel',
        'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
        array('jquery'),
        '2.3.4',
        false // В HEAD - ОБЯЗАТЕЛЬНО!
    );
    
    // 3. Основные скрипты с явными зависимостями
    wp_enqueue_script(
        'webazex',
        get_template_directory_uri() . '/js/main.js',
        array('jquery', 'owl-carousel'), // Явно указываем зависимости
        null,
        true
    );
    
    wp_enqueue_script(
        'msn-js',
        get_template_directory_uri() . '/js/common.js',
        array('jquery', 'owl-carousel'),
        null,
        true
    );
    
    // Остальные скрипты
    wp_enqueue_script(
        'msn-ajax-search',
        get_theme_file_uri("/js/ajax-search.js"),
        array('jquery'),
        "",
        true
    );
    
    wp_enqueue_script(
        'tabs-fix',
        get_stylesheet_directory_uri() . '/js/tabs-fix.js',
        array('jquery'),
        null,
        true
    );
    
    wp_enqueue_script(
        'script.js',
        get_stylesheet_directory_uri() . '/js/script.js',
        array(),
        null,
        true
    );

    // header.js — dropdown меню, бургер, overlay
    wp_enqueue_script(
        'stk-header',
        get_stylesheet_directory_uri() . '/js/header.js',
        array('jquery'),
        null,
        true
    );
    
    // Убираем defer/async у критичных скриптов
    add_filter('script_loader_tag', 'final_script_loader', 10, 3);
}

function final_script_loader($tag, $handle, $src) {
    // Скрипты, которые НЕЛЬЗЯ загружать с defer/async
    $critical_scripts = array('jquery', 'owl-carousel', 'webazex', 'msn-js');
    
    if (in_array($handle, $critical_scripts)) {
        // Убираем все defer и async
        $tag = str_replace(array(' defer', ' async'), '', $tag);
    }
    
    // Только script.js можно загружать с defer
    if ($handle === 'script.js') {
        $tag = str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}

add_action('wp_enqueue_scripts', 'final_theme_scripts', 1); // Самый высокий приоритет

// Стили
function final_theme_styles() {
    $css = get_stylesheet_directory_uri() . '/css/';
    $tpl = get_page_template_slug();

    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('msn-style', get_stylesheet_uri());
    wp_enqueue_style('stc-header', $css . 'header.css',    ['msn-style'], '2.1');
    wp_enqueue_style('stc-footer', $css . 'footer.css',    ['msn-style'], '2.1');

    if ( $tpl === 'template-home.php' )
        wp_enqueue_style('stc-home', $css . 'home.css', ['msn-style'], '2.1');

    if ( is_product_category() || is_post_type_archive('product') )
        wp_enqueue_style('stc-catalog', $css . 'catalog.css', ['msn-style'], '2.1');

    if ( in_array($tpl, ['template-cisterni.php', 'template-furgoni.php']) )
        wp_enqueue_style('stc-catalog-v2', $css . 'catalog-v2.css', ['msn-style'], '2.1');

    if ( $tpl === 'template-product-v2.php' ) {
        wp_enqueue_style('stc-product',    $css . 'product.css',    ['msn-style'], '2.1');
        wp_enqueue_style('stc-catalog',    $css . 'catalog.css',    ['msn-style'], '2.1');
        wp_enqueue_style('magnific-popup', $css . 'magnific-popup.css', [], '1.1.0');
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], '4.7.0');
    }

    if ( is_product() ) {
        wp_enqueue_style('stc-product',    $css . 'product.css',    ['msn-style'], '2.1');
        wp_enqueue_style('stc-sticky-cta', $css . 'sticky-cta.css', ['msn-style'], '2.1');
        // Font Awesome — CDN (локальные файлы не работают на localhost)
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], '4.7.0');
    }

    if ( is_product() || in_array($tpl, ['template-cisterni.php', 'template-furgoni.php']) )
        wp_enqueue_style('magnific-popup', $css . 'magnific-popup.css', [], '1.1.0');
}
add_action('wp_enqueue_scripts', 'final_theme_styles');

// УБИРАЕМ ОПАСНЫЕ OUTPUT BUFFER ЗАМЕНЫ
// Закомментирован опасный код, который может ломать сайт
/*
add_action( 'template_redirect', function(){
    ob_start( function( $buffer ){
        $buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
        $buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
        return $buffer;
    });
});
*/

add_theme_support('html5', array('search-form'));

if ( ! function_exists( 'msn_setup' ) ) :
	
	function msn_setup() {
	
		load_theme_textdomain( 'msn', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

	
		add_theme_support( 'post-thumbnails' );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'msn_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height'  => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'msn_setup' );

// Для отрабатывания шоркодов
add_filter('widget_text','do_shortcode');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function msn_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'msn_content_width', 640 );
}
add_action( 'after_setup_theme', 'msn_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function msn_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'msn' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'msn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'msn_widgets_init' );

function msn_widgets_init_zh() {
	register_sidebar( array(
		'name'          => esc_html__( 'Запчасти-страница', 'msn' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'msn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'msn_widgets_init_zh' );

function msn_widgets_init_filter_th() {
	register_sidebar( array(
		'name'          => esc_html__( 'Фильтры для Техники', 'msn' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'msn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'msn_widgets_init_filter_th' );

function msn_widgets_search() {
	register_sidebar( array(
		'name'          => esc_html__( 'Поиск по артикулам', 'msn' ),
		'id'            => 'header-s',
		'description'   => esc_html__( 'Add widgets here.', 'msn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'msn_widgets_search' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// This theme uses wp_nav_menu() in one location.
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array( // создаём любое количество областей
		  'main_menu' => 'Primary',
		  'foot_menu' => 'Footer',
		  'mobile_menu' => 'Мобильное меню'
		)
	);
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB': $currency_symbol = '₽'; break;
     }
     return $currency_symbol;
}

// Удаление хлебных крошек woocommerce
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// remove unused field on checkout page (Не нужные поля для заказа)
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
   unset($fields['order']['order_comments']);
   unset($fields['billing']['billing_first_name']);
   unset($fields['billing']['billing_last_name']);
   unset($fields['billing']['billing_company']);
   unset($fields['billing']['billing_address_1']);
   unset($fields['billing']['billing_address_2']);
   unset($fields['billing']['billing_city']);
   unset($fields['billing']['billing_postcode']);
   unset($fields['billing']['billing_country']);
   unset($fields['billing']['billing_state']);
   unset($fields['billing']['billing_phone']);
   return $fields;
}

// Удаление стилей woocommerce
/** Disable All WooCommerce  Styles and Scripts Except Shop Pages*/
add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99 );
function dequeue_woocommerce_styles_scripts() {
if ( function_exists( 'is_woocommerce' ) ) {

# Styles
// wp_dequeue_style( 'woocommerce-general' );
// wp_dequeue_style( 'woocommerce-layout' );
// wp_dequeue_style( 'woocommerce-smallscreen' );
// wp_dequeue_style( 'woocommerce_frontend_styles' );
wp_dequeue_style( 'woocommerce_fancybox_styles' );
wp_dequeue_style( 'woocommerce_chosen_styles' );
wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
# Scripts
 wp_dequeue_script( 'wc_price_slider' );
// wp_dequeue_script( 'wc-single-product' );
//wp_dequeue_script( 'wc-add-to-cart' );
 wp_dequeue_script( 'wc-cart-fragments' );
//wp_dequeue_script( 'wc-checkout' );
 wp_dequeue_script( 'wc-add-to-cart-variation' );
// wp_dequeue_script( 'wc-single-product' );
// wp_dequeue_script( 'wc-cart' );
// wp_dequeue_script( 'wc-chosen' );
// wp_dequeue_script( 'woocommerce' );
wp_dequeue_script( 'prettyPhoto' );
 wp_dequeue_script( 'prettyPhoto-init' );
// wp_dequeue_script( 'jquery-blockui' );
// wp_dequeue_script( 'jquery-placeholder' );
// wp_dequeue_script( 'fancybox' );
// wp_dequeue_script( 'jqueryui' );
}
}

// Taxonomy category shortcode
function cat_func($atts) {
    extract(shortcode_atts(array(
            'class_name'    => 'cat-post',
            'totalposts'    => '-1',
            'category'      => '',
            'thumbnail'     => 'false',
            'excerpt'       => 'true',
            'orderby'       => 'post_date'
            ), $atts));

    $output = '<div class="'.$class_name.'">';
    global $post;
    $args = array(
        'posts_per_page' => $totalposts, 
        'orderby' => $count,
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'zh',
                'field' => 'slug',
                'terms' => array( $category)
            )
        ));
    $myposts = NEW WP_Query($args);


    while($myposts->have_posts()) {
        $myposts->the_post();
        $output .= '<div class="cat-post-list">';
        if($thumbnail == 'true') {
        $output .= '<div class="cat-post-images">'.get_the_post_thumbnail($post->ID, 'thumbnail').'</div>';
        }
        $output .= '<div class="cat-content"><span class="cat-post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
        if ($excerpt == 'true') {
            $output .= '<span class="cat-post-excerpt">'.get_the_excerpt().'</span>';
        }
        $output .= '</div>
            <div class="cat-clear"></div>
        </div>';
    };
    $output .= '</div>';
    wp_reset_query();
    return $output;
}
add_shortcode('inventory-category', 'cat_func');

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
	// список параметров: http://wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy('zh', array('product'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Запчасти',
			'singular_name'     => 'Запчасть',
			'search_items'      => 'Поиск Запчасти',
			'all_items'         => 'Все Запчасти',
			'view_item '        => 'Просмотр Запчасти',
			'parent_item'       => 'Родитель запчастей',
			'parent_item_colon' => 'Родитель запчастей:',
			'edit_item'         => 'Редактировать Запчасти',
			'update_item'       => 'Обновить Запчасти',
			'add_new_item'      => 'Добавить рубрику для Запчастей',
			'new_item_name'     => 'Новые Запчасти Имя',
			'menu_name'         => 'Запчасти',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => true,
		'rewrite'				=> true,
		// //'update_count_callback' => '_update_post_term_count',
		      //   'rewrite' => array( 

        //     'slug' => 'dorabotki',
        //     'with_front' => true,
        //     'hierarchical' => true,

        // ),
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	) );
}

// Вывод подкатегорий текущих запчастей
function wpv_show_curent_tax() {
  if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
	$subtermid = $term->term_id;
   	  
	 $taxonomies = array( 
    'zh',
  );

  $args = array(
    'orderby'           => 'count',
	'order'             => 'DESC',
    'hide_empty'        => false, 
    'fields'            => 'all',
    'parent'            => 0,
    'hierarchical'      => true,
    'child_of'          => 0,
    'pad_counts'        => false,
    'cache_domain'      => 'core'    
  );

  $terms = get_terms($taxonomies, $args);
    foreach ( $terms as $term ) {
        $subterms = get_terms($taxonomies, array(
          'parent'   => $subtermid,
          'hide_empty' => false
          ));
        $return .= '<select class="list_cat" onchange="location = this.value;">';

        foreach ( $subterms as $subterm ) {

          //return sub terms (not working :( )
          $return .= sprintf(
			   '<option value="'.get_term_link($subterm).'" class="term-'.$subterm->term_id.'" >'.$subterm->name.'<span>('.$subterm->count.')</span></option>',
          $subterm->term_id,
          $subterm->name,
		  $subterm->count,
          $subterm->description
          );
          $return .= '</option>'; //end subterms li
        }            
        $return .= '</select>'; //end subterms ul

    } //end foreach term

  $return .= '</select>';
return $return;
	  
  }
}
// add_shortcode('zhsubterms', 'wpv_show_curent_tax');

// Вывод подкатегорий текущих товаров
function wpv_show_curent_tax_new() {
if( is_tax('product_cat') ) {
                        $cat = get_queried_object();
                        $cat_id = $cat->term_id;
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'title_li' => '',
                            'child_of' => $cat_id,
							'orderby' => 'count',
						'order' => 'DESC',
							'show_option_none' => '',
							
                        );
                        wp_list_categories($args);
	}
 }

// Не выводить товар в общей технике
function custom_pre_get_posts_query( $q ) {
    $tax_query = (array) $q->get( 'tax_query' );
if ( is_post_type_archive('product') ) {

    $tax_query[] = array(
           'taxonomy' => 'zh',
           'field' => 'slug',
           'terms' => array( 'antivandalnyj-monitor','dooborudovanie-kabiny','sdvoennaja-kabina','spalnoe-mesto','dooborudovanie-salona-vahtovogo-avtobusa','kondicionery','importnye','otechestvennye','lebedki','opasnye-gruzy-dopog','severnyj-variant-dorabotka','tahografy','ustanovka-dopolnitelnyh-opcij','ustanovka-sistemy-kontrolja-rashoda-topliva','ustanovka-sistemy-pozharotushkenija' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );
    $q->set( 'tax_query', $tax_query );
}
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' ); 

//Вывод категории в запчастях сайдбаре
function wpv_show_category_zh() {
$zhcattwo = wp_list_categories( array(
    'orderby'    => 'count',
	'order'    => 'DESC',
    'show_count' => true,
	'child_of' => 311,
	'depth' => 1,
	'hide_empty' => false,
	'title_li' => '',
	'hide_title_if_empty' => true,
    'taxonomy'   => 'zh' //i guess campaign_action  is your  taxonomy 
));
}
add_shortcode('zhcattwo', 'wpv_show_category_zh');

//удаление цены со списка
add_filter( 'woocommerce_get_price_html', 'bbloomer_price_free_zero_empty', 100, 2 );
 function bbloomer_price_free_zero_empty( $price, $product ){
if ( '' === $product->get_price() || 0 == $product->get_price() ) {
    $price = '';
} 
 
return $price;
}

// Удалить распродажу woocommerce
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// удалить подробнее woocommerce. Возможно корзина
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//Добавление правильных хлебных крошек в Запчасти
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );
function yoast_seo_breadcrumb_append_link( $links ) {
    global $post;
    if ( has_term ( '', 'zh'  )&& is_single() ) {
		
$terms = get_the_terms( $post->ID , 'zh' ); 
                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term, 'zh' );
					} 				
        $breadcrumb[] = array(
            'url' => $term_link,
            'text' => $term->name,
        );
        array_splice( $links, 2, -1, $breadcrumb );
    }
    return $links;
}

add_action( 'woocommerce_after_shop_loop_item_title', 'shop_sku' );
function shop_sku(){
global $product;
echo '<span itemprop="productID" class="sku"> ' . $product->get_sku(). '</span>';
}

//Вывод атрибутов в товар
function isa_woocommerce_all_pa(){
  
    global $product;
    $attributes = $product->get_attributes();
  
    if ( ! $attributes ) {
        return;
    }
  
    $out = '<ul class="custom-attributes">';
  
    foreach ( $attributes as $attribute ) {
  
  
        // skip variations
        if ( $attribute->get_variation() ) {
        continue;
        }
        $name = $attribute->get_name();
        if ( $attribute->is_taxonomy() ) {
  
            $terms = wp_get_post_terms( $product->get_id(), $name, 'all' );
            // get the taxonomy
            $tax = $terms[0]->taxonomy;
            // get the tax object
            $tax_object = get_taxonomy($tax);
            // get tax label
            if ( isset ( $tax_object->labels->singular_name ) ) {
                $tax_label = $tax_object->labels->singular_name;
            } elseif ( isset( $tax_object->label ) ) {
                $tax_label = $tax_object->label;
                // Trim label prefix since WC 3.0
                if ( 0 === strpos( $tax_label, 'Product ' ) ) {
                   $tax_label = substr( $tax_label, 8 );
                }                
            }
  
  
            $out .= '<li class="' . esc_attr( $name ) . '">';
            $out .= '<span class="attribute-label">' . esc_html( $tax_label ) . ': </span> ';
            $out .= '<span class="attribute-value">';
            $tax_terms = array();
            foreach ( $terms as $term ) {
                $single_term = esc_html( $term->name );
                // Insert extra code here if you want to show terms as links.
                array_push( $tax_terms, $single_term );
            }
            $out .= implode(', ', $tax_terms);
            $out .= '</span></li>';
 
        } else {
            $value_string = implode( ', ', $attribute->get_options() );
            $out .= '<li class="' . sanitize_title($name) . ' ' . sanitize_title( $value_string ) . '">';
            $out .= '<span class="attribute-label">' . $name . ': </span> ';
            $out .= '<span class="attribute-value">' . esc_html( $value_string ) . '</span></li>';
        }
    }
  
    $out .= '</ul>';
  
    echo $out;
}
add_action('woocommerce_after_shop_loop_item_title', 'isa_woocommerce_all_pa', 25);

/**
 *Убрать пагинацию и вывести 30 товаров
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  $cols = 30;
  return $cols;
}

// Убрать product и product-category
add_filter( 'request', 'change_requerst_vars_for_product_cat' );
add_filter( 'term_link', 'term_link_filter', 10, 3 );
add_filter( 'post_type_link', 'wpp_remove_slug', 10, 3 );
add_action( 'pre_get_posts', 'wpp_change_request' );
 
function change_requerst_vars_for_product_cat($vars) {
 
    global $wpdb;
    if ( ! empty( $vars[ 'pagename' ] ) || ! empty( $vars[ 'category_name' ] ) || ! empty( $vars[ 'name' ] ) || ! empty( $vars[ 'attachment' ] ) ) {
      $slug   = ! empty( $vars[ 'pagename' ] ) ? $vars[ 'pagename' ] : ( ! empty( $vars[ 'name' ] ) ? $vars[ 'name' ] : ( ! empty( $vars[ 'category_name' ] ) ? $vars[ 'category_name' ] : $vars[ 'attachment' ] ) );
      $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s", array( $slug ) ) );
      if ( $exists ) {
        $old_vars = $vars;
        $vars     = array( 'product_cat' => $slug );
        if ( ! empty( $old_vars[ 'paged' ] ) || ! empty( $old_vars[ 'page' ] ) ) {
          $vars[ 'paged' ] = ! empty( $old_vars[ 'paged' ] ) ? $old_vars[ 'paged' ] : $old_vars[ 'page' ];
        }
        if ( ! empty( $old_vars[ 'orderby' ] ) ) {
          $vars[ 'orderby' ] = $old_vars[ 'orderby' ];
        }
        if ( ! empty( $old_vars[ 'order' ] ) ) {
          $vars[ 'order' ] = $old_vars[ 'order' ];
        }
      }
    }
 
    return $vars;
 
  }
  
function term_link_filter( $url, $term, $taxonomy ) {
 
    $url = str_replace( "/product-category/", "/", $url );
    return $url;
 
  }
 
function wpp_remove_slug( $post_link, $post, $name ) {
 
    if ( 'product' != $post->post_type || 'publish' != $post->post_status ) {
      return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
 
  }
 
function wpp_change_request( $query ) {
 
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query[ 'page' ] ) ) {
      return;
    }
    if ( ! empty( $query->query[ 'name' ] ) ) {
      $query->set( 'post_type', array( 'post', 'product', 'page' ) );
    }
 
}

// убрать заголовок в товаре
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

//убрать слово любой в фильтре
add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
function translate_text($translated) {
$translated = str_ireplace('Подытог', 'Итого', $translated);
$translated = str_ireplace('Таблица размеров', 'Характеристики', $translated);
$translated = str_ireplace('Хит продаж', 'Хит', $translated);
$translated = str_ireplace('О бренде', 'О производителе', $translated);
$translated = str_ireplace('Новый', 'Новинка', $translated);
$translated = str_ireplace('Любой', '', $translated);
return $translated;
}
// убрать лупу с продукта
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
 add_action( 'wp', 'remove_image_zoom_support', 100 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// убрать в наличии
function my_wc_hide_in_stock_message( $html, $text, $product ) {
	$availability = $product->get_availability();
	if ( isset( $availability['class'] ) && 'in-stock' === $availability['class'] ) {
		return '';
	}
	return $html;
}
add_filter( 'woocommerce_stock_html', 'my_wc_hide_in_stock_message', 10, 3 );

//убрать лупу с товара
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs($tabs ) {
$post = get_the_ID();
    // 1) Removing tabs

    unset( $tabs['description'] );              // Remove the description tab
    // unset( $tabs['reviews'] );               // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab


    // 2 Adding new tabs and set the right order
    // 
	
    $tabs['attrib_desc_tab'] = array(
        'title'     => __( 'Характеристики', 'woocommerce' ),
        'priority'  => 100,
        'callback'  => 'woo_attrib_desc_tab_content'
    );
    $tabs['qty_pricing_tab'] = array(
        'title'     => __( 'Кабина', 'woocommerce' ),
        'priority'  => 110,
        'callback'  => 'woo_qty_pricing_tab_content'
    );
    $tabs['other_products_tab'] = array(
        'title'     => __( 'Двигатель', 'woocommerce' ),
        'priority'  => 120,
        'callback'  => 'woo_other_products_tab_content'
    );	
	
	 $tabs['box'] = array(
        'title'     => __( 'Коробка', 'woocommerce' ),
        'priority'  => 130,
        'callback'  => 'woo_box_tab_content'
    );

    $tabs['settings_tab'] = array(
        'title'     => __( 'Установки', 'woocommerce' ),
        'priority'  => 135,
        'callback'  => 'woo_settings_tab_content'
    );

    $tabs['features_box_tab'] = array(
        'title'     => __( 'Особенности', 'woocommerce' ),
        'priority'  => 140,
        'callback'  => 'woo_features_box_tab_content'
    );

    $tabs['extratab_tab'] = array(
        'title'     => __( 'Видео', 'woocommerce' ),
        'priority'  => 190,
        'callback'  => 'woo_extratab_tab_content'
    );

	$spectovar = get_field('spectovar', 'option');
	if ( is_single( $spectovar) )  {
	 $tabs['features'] = array(
        'title'     => __( 'Комплектация', 'woocommerce' ),
        'priority'  => 140,
        'callback'  => 'woo_features_tab_content'
	);
	}
	$tovarkmu = get_field('tovarkmu', 'option');
	 if ( is_single( $tovarkmu) )  {
	$tabs['kmu'] = array(
        'title'     => __( 'КМУ', 'woocommerce' ),
		'priority'  => 150,
        'callback'  => 'woo_kmu_tab_content'
	 );
	}
	$tovartrailer = get_field('tovartrailer', 'option');
	if ( is_single($tovartrailer) ){
	$tabs['trailer'] = array(
        'title'     => __( 'Прицеп-цистерна', 'woocommerce' ),
        'priority'  => 160,
        'callback'  => 'woo_trailer_tab_content'
	 );
	}
    return $tabs;
}

// New Tab contents
// Таб Характеристики
function woo_attrib_desc_tab_content() {
global $post;
?>
<?php echo '<div class="row tab-item1">';?>
<?php echo '<div class="col-lg-6">';?>
<?php the_field('char');?>
<?php echo '</div>';?>
<?php echo '<div class="col-lg-6">';?>
<?php 
$image = get_field('charimg');
if( !empty($image) ):?>
<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>
<?php echo '<div class="char_right">';?>
<?php the_field('char_right');?>
<?php echo '</div>';?>
<?php echo '</div>';?>
<?php echo '</div>';?>
<?php
}
// Таб кабины
function woo_qty_pricing_tab_content() {
global $post;
?>
<?php echo '<div class="row tab-item-gallery">';?>
<?php echo '<div class="col-lg-6">';?>
<?php
$kabinaimg  = get_field('kabinaimg');
$kabinaimgs = get_field('kabinagallery');
if ( $kabinaimg || $kabinaimgs ) : ?>
<ul class="zoom-gallery kabinagallery">
  <?php if ( $kabinaimg ) : ?>
  <li class="kabinagallery__main">
    <a href="<?php echo esc_url($kabinaimg['url']); ?>">
      <img src="<?php echo esc_url($kabinaimg['url']); ?>" alt="<?php echo esc_attr($kabinaimg['alt']); ?>" />
    </a>
  </li>
  <?php endif; ?>
  <?php if ( $kabinaimgs ) : foreach ( $kabinaimgs as $kimg ) : ?>
  <li>
    <a href="<?php echo esc_url($kimg['url']); ?>">
      <img src="<?php echo esc_url($kimg['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($kimg['alt']); ?>" />
    </a>
  </li>
  <?php endforeach; endif; ?>
</ul>
<?php endif; ?>
<?php echo '<div class="kabinatext1">';?>
<?php the_field('kabinatext1');?>
<?php echo '</div>';?>
<?php echo '</div>';?>
<?php echo '<div class="col-lg-6">';?>
<?php the_field('kabinatext2');?>
<?php echo '</div>';?>
<?php echo '</div>';?>
<?php
}
// Таб двигателя
function woo_other_products_tab_content() {
global $post;
?>
<?php echo '<div class="row tab-item">';?>
<?php echo '<div class="col-lg-3">';?>
<?php 
$image = get_field('dvigatelimg');
if( !empty($image) ):?>
<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>
<?php echo '</div>';?>
<?php echo '<div class="col-lg-6">';?>
<?php the_field('dvigtext');?>
<?php echo '</div>';?>
<?php echo '</div>';?>

<?php echo '<div class="row tab-item">';?>
<?php echo '<div class="col-lg-12">';?>
<?php
$hero = get_field('group');	
if( $hero ):?>

<div class="tabspr">
	<ul class="i-tab1">
		<li class="tab-link current" data-tab="tab-1">Описание</li>
		<li class="tab-link" data-tab="tab-2">Характеристики</li>
		<li class="tab-link" data-tab="tab-3">Применение</li>
	</ul>
	<div id="tab-1" class="tabcontent1 current">
		<div class="row">
			<div class="col-lg-6">
				<?php echo $hero['descriptgr1'];?>
			</div>
			<div class="col-lg-6">
				<?php echo $hero['descriptgr2'];?>
			</div>
		</div>
	</div>
	<div id="tab-2" class="tabcontent2">
		<?php echo $hero['tablgr2'];?>
	</div>
	<div id="tab-3" class="tabcontent2">
		<?php echo $hero['passgr3'];?>
	</div>
</div>
<?php endif;?>
<?php echo '</div>';?>
<?php echo '</div>';?>

<?php
}

// Таб коробки
function woo_box_tab_content() {
global $post;
?>
<?php echo '<div class="row tab-item">';?>
<?php echo '<div class="col-lg-3">';?>
<?php 
$image = get_field('korobka_img');
if( !empty($image) ):?>
<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>
<?php echo '</div>';?>
<?php echo '<div class="col-lg-6">';?>
<?php the_field('korobkatext');?>
<?php echo '</div>';?>
<?php echo '</div>';?>

<?php echo '<div class="row tab-item">';?>
<?php echo '<div class="col-lg-12">';?>
<?php
$hero = get_field('tabs_korobka');	
if( $hero ):?>

<div class="tabspr">
	<ul class="i-tab2">
		<li class="tab-link current" data-tab="tab-1-1">Описание</li>
		<li class="tab-link" data-tab="tab-2-1">Характеристики</li>
		<li class="tab-link" data-tab="tab-3-1">Применение</li>
	</ul>
	<div id="tab-1-1" class="tabcontent2 current">
		<div class="row">
			<div class="col-lg-6">
				<?php echo $hero['desl'];?>
			</div>
			<div class="col-lg-6">
				<?php echo $hero['desr'];?>
			</div>
		</div>
	</div>
	<div id="tab-2-1" class="tabcontent2">
		<?php echo $hero['tablchark'];?>
	</div>
	<div id="tab-3-1" class="tabcontent2">
		<?php echo $hero['tabl31'];?>
	</div>
</div>
<?php endif;?>
<?php echo '</div>';?>
<?php echo '</div>';?>

<?php
}

// Таб Установки (товар)
function woo_settings_tab_content() {
global $post;
?>

<?php echo '<div class="row tab-item">';?>
<?php echo '<div class="col-lg-12">';?>
<div class="settings__main__img">

<?php 
$image = get_field('ustanovki_bolshoe_foto');
if( !empty($image) ):?>

<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>

</div>

<?php 
$images = get_field('ustanovki_gallery');

if( $images ):?>
    <ul class="zoom-gallery kabinagallery settings__gallery">
<?php foreach( $images as $image ):?>
            <li>
                <a href="<?php echo $image['url'];?>">
                     <img src="<?php echo $image['sizes']['thumbnail'];?>" alt="<?php echo $image['alt'];?>" />
                </a>
                <p><?php echo $image['caption'];?></p>
            </li>
<?php endforeach;?>
    </ul>

<?php endif;?>

<?php echo '</div>';?>

<?php echo '</div>';?>

<?php
}

function woo_features_box_tab_content() {
global $post;
?>
<div class="row tab-item">
<?php echo '<div class="col-lg-12">';?>
<?php the_field('osobennosti_tekst');?>
<?php echo '</div>';?>
</div>
<?php
}

// Видео
function woo_extratab_tab_content() {
global $post;
?>
<div class="row tab-item">
<?php echo '<div class="col-lg-12">';?>
<?php the_field('dop_tekst');?>
<?php echo '</div>';?>
</div>

<?php
}

// Таб особенности
function woo_features_tab_content() {
global $post;
?>
<div class="row tab-item1">
<div class="col-lg-6">
<div class="stc-tabll-wrap">
  <div class="stc-tabll-inner">
    <?php the_field('tabll');?>
  </div>
  <div class="stc-tabll-fade"></div>
</div>
<button type="button" class="stc-tabll-btn" data-open="Показать всё" data-close="Свернуть">
  Показать всё <i class="fa fa-chevron-down"></i>
</button>
</div>

<div class="col-lg-6">
<?php 
$image = get_field('tabs3');
if( !empty($image) ):?>
<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>

<?php 
$images = get_field('tabs31');
if( $images ):?>
    <ul class="zoom-gallery kabinagallery">
<?php foreach( $images as $image ):?>
            <li>
                <a href="<?php echo $image['url'];?>">
                     <img src="<?php echo $image['sizes']['thumbnail'];?>" alt="<?php echo $image['alt'];?>" />
                </a>
                <p><?php echo $image['caption'];?></p>
            </li>
<?php endforeach;?>
    </ul>
<?php endif;?>

<?php the_field('tabler');?>
</div>
</div>
	
<?php
}

// Таб КМУ
function woo_kmu_tab_content() {
	global $post;
?>
	<div class="row tab-item">
		<div class="col-lg-6">
			<?php echo get_field('kmutext');?>
		</div>
		<div class="col-lg-6">
			<?php 
				$image = get_field('kmu_img');
				if( !empty($image) ):?>
					<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
						<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
					</a>
				<?php endif;?>	
		</div>
	</div>
	<div class="tabspr">
	<div class="row tab-item">
	<div class="col-lg-12">
		<ul class="i-tab2">
			<li class="tab-link" data-tab="tab-55-1">Характеристики</li>
			<li class="tab-link" data-tab="tab-55-2">Грузоподъемность</li>
			<li class="tab-link" data-tab="tab-55-3">Другие модели</li>
		</ul>
		<?php $hero = get_field('tabs_kmu');?>
		<div id="tab-55-1" class="tabcontent2 current">
			<?php echo $hero['tablchark123'];?>
		</div>
		<div id="tab-55-2" class="tabcontent2">
			<?php echo $hero['tabl31223'];?>
		</div>
		<div id="tab-55-3" class="tabcontent2">
			<?php echo $hero['tabl3122'];?>
		</div>
	</div>
	</div>
	</div>
<?php
}

// Таб цистерна
function woo_trailer_tab_content() {
global $post;
?>

<div class="row tab-item1">
<div class="col-lg-6">
<?php the_field('tabltraoler');?>
</div>
<div class="col-lg-6">
<?php 
$image = get_field('imagetrailer');
if( !empty($image) ):?>
<a class="image-popup-no-margins" href="<?php echo $image['url'];?>">
<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
</a>
<?php endif;?>

<?php 
$images = get_field('imageslider');
if( $images ):?>
    <ul class="zoom-gallery kabinagallery">
<?php foreach( $images as $image ):?>
            <li>
                <a href="<?php echo $image['url'];?>">
                     <img src="<?php echo $image['sizes']['thumbnail'];?>" alt="<?php echo $image['alt'];?>" />
                </a>
                <p><?php echo $image['caption'];?></p>
            </li>
<?php endforeach;?>
    </ul>
<?php endif;?>
</div>
</div>

<?php
}

/** AJAX корзина **/

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) { 
	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
} else { 
	add_filter( 'add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
}

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	$count = $woocommerce->cart->get_cart_contents_count();
	//$count = get_cart_contents_count();
	?>
	<a class="cart-link" href="<?php echo wc_get_cart_url();?>" title="Смотреть корзину">
		<!--<span class="dashicons dashicons-cart"></span>-->
		
		<?php if ( $count > 0 ) :?>
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/Empty_blue.png" class="cart-img"/>
			<span class="cart-contents-count">В корзине товаров -<?php echo esc_html( $count );?>шт.</span>
		<?php else :?>
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/cart-empty.png" class="cart-img"/>
		<?php endif;?>
	</a>
	<?php
	$fragments['a.cart-link'] = ob_get_clean();
	
	return $fragments;
}

// хуки на сессии
add_action('init', '_session_start', 1);
add_action('wp_logout', '_session_destroy');
add_action('wp_login', '_session_destroy');

function _session_start() 
{
	if( ! session_id()) session_start();
}

function _session_destroy() 
{
	session_destroy();
}

// возвращаем html код мини-корзины
function the_mini_cart($ts)
{
	$cart_link = wc_get_cart_url(); // ссылка на корзину
	
	// список продуктов
	$products = ! empty($_SESSION['products']) ? $_SESSION['products'] : array(); 
	
	// вывод формы
	ob_start();
	?>
	<div id="mini-cart">
		<h3>Составить коммерческое предложение на покупку</h3>
		<p><?= $ts?></p>
		<p><span>с указанными опциями<span></p>
		<div class="product-list">
			<?php foreach ($products as $product_id => $qnt) : $product = wc_get_product($product_id); if ( ! $product) continue;?>
				<p>
					<a class="delete-item" data-id="<?= $product_id?>">X</a>
					<?= $product->get_name()?>
				</p>
			<?php endforeach;?>
		</div>
		<div class="to-cart">
			<a href="<?= $cart_link?>">перейти к списку</a>
			<?php if ($products) :?><script>jQuery('#mini-cart .to-cart').show();</script><?php endif?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

// хуки на ajax добавление корзины
add_action( 'wp_ajax_add_to_cart', 'add_to_cart' ); 
add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart' );
 
function add_to_cart() 
{
	$product_id = ! empty($_POST['product_id']) ? $_POST['product_id'] : false;
	if ( ! $product_id) die('unknown product id');

	if ( ! isset($_SESSION['products'])) $_SESSION['products'] = array();
	$_SESSION['products'][$product_id] = 1;

	// выводим обновленную корзину
	echo the_mini_cart($_GET['ts']);
 	exit; // завершили
}

// хуки на удаление из корзины
add_action( 'wp_ajax_remove_from_cart', 'remove_from_cart' ); 
add_action( 'wp_ajax_nopriv_remove_from_cart', 'remove_from_cart' );
 
function remove_from_cart() 
{
	$product_id = ! empty($_POST['product_id']) ? $_POST['product_id'] : false;
	if ( ! $product_id) die('unknown product id');

	if ( ! isset($_SESSION['products'])) $_SESSION['products'] = array();
	unset($_SESSION['products'][$product_id]);

	// выводим обновленную корзину
	echo the_mini_cart($_GET['ts']);
 	exit; // завершили
}

// хуки на отправку корзины
add_action( 'wp_ajax_mini_order_send', 'mini_order_send' ); 
add_action( 'wp_ajax_nopriv_mini_order_send', 'mini_order_send' );
 
function mini_order_send() 
{
	//http_response_code(404);
	$name  = ! empty($_POST['name'])  ? $_POST['name'] : false;
	$email = ! empty($_POST['email']) ? $_POST['email'] : false;
	$phone = ! empty($_POST['phone']) ? $_POST['phone'] : false;
	$data  = ! empty($_POST['data'])  ? json_decode(str_replace('\"', '"', $_POST['data'])) : false;
	$ts    = @$_SESSION['last_product_session'];
	
	if (empty($ts) || empty($name) || empty($email) || empty($phone) || empty($data)) die('bad params');
	
	$user_data = array(
		"<p><b>Для:</b> $ts</p>",
		"<p><b>Имя:</b> $name</p>",
		"<p><b>E-mail:</b> $email</p>",
		"<p><b>Телефон:</b> $phone</p>",
	);

	$order_data = [];
	foreach ($data as $item)
	{
		$order_data[] = "<tr>\n<td>$item->product</td>\n<td>$item->quantity</td>\n</tr>";
	}
	
	add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
	
	$headers = array(
		"From: Robot <no-reply@{$_SERVER['HTTP_HOST']}>\r\n",
		"Reply-To: <$email>\r\n",
	);
	wp_mail(
		get_option('admin_email'),
		
		"Запрос коммерческого предложения с: {$_SERVER['HTTP_HOST']}",
		
		"<h4>С сайта {$_SERVER['HTTP_HOST']} был сделан запрос коммерческого предложения:</h4>\n" .
		"<hr>" . join("\n", $user_data) . "\n<br><br>\n" .
		"<table>\n<tr>\n<th>Наименование</th>\n<th>Количество</th>\n</tr>\n" . join("\n", $order_data) . "\n</table>",
		
		$headers
	);
	
	echo "1";
	exit;
}

/*** Attributes shortcode callback.*/
function so_39394127_attributes_shortcode( $atts ) {
    global $product;
    if( ! is_object( $product ) || ! $product->has_attributes() ){
        return;
    }
    // parse the shortcode attributes
    $args = shortcode_atts( array(
        'attributes' => array_keys( $product->get_attributes() ), // by default show all attributes
    ), $atts );
    // is pass an attributes param, turn into array
    if( is_string( $args['attributes'] ) ){
        $args['attributes'] = array_map( 'trim', explode( '|' , $args['attributes'] ) );
    }
    // start with a null string because shortcodes need to return not echo a value
    $html = '';
    if( ! empty( $args['attributes'] ) ){
        foreach ( $args['attributes'] as $attribute ) {
            // get the WC-standard attribute taxonomy name
            $taxonomy = strpos( $attribute, 'pa_' ) === false ? wc_attribute_taxonomy_name( $attribute ) : $attribute;
            if( taxonomy_is_product_attribute( $taxonomy ) ){
                // Get the attribute label.
                /*$attribute_label = wc_attribute_label( $taxonomy );*/
                // Build the html string with the label followed by a clickable list of terms.
                // heads up that in WC2.7 $product->get_ID() needs to be $product->get_id()
                $html .= get_the_term_list( $product->get_ID(), $taxonomy, '<div class="bullet-arrow"></div>' );
            }
        }
        // if we have anything to display, wrap it in a <ul> for proper markup
        // OR: delete these lines if you wish to return the <li> elements
        if( $html ){
            $html = '<div class="product-attributes">' . $html . '</div>';
        }
    }
    return $html;
}
add_shortcode( 'display_attributes', 'so_39394127_attributes_shortcode' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Основные настройки',
		'menu_title'	=> 'Настройка сайта',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

//добавляем картинку с поля пункта меню на фронт
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	foreach( $items as &$item ) {
		$icon = get_field('img-cat', $item);
		if( $icon ) {
			$item->title = '<span class="mnu-icon-cat" style="background-image: url(' . $icon['url'] . ');"></span>' . $item->title;
		}
	}
	return $items;
}

function filter_woocommerce_product_get_image( $image, $_this, $size, $attr, $placeholder ) {
 
   $fild=get_field('cat_file', $_this->id);

   if(isset($fild['sizes']['medium'])) {

       $image='<img width="250" height="140" src="'.$fild['sizes']['medium'].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 300px) 100vw, 300px">';
    } else {
        $image = $image;
    } 
    return $image;
}
add_filter ( 'woocommerce_product_get_image', 'filter_woocommerce_product_get_image', 10, 5);

function wpdocs_dequeue_dashicon() {
if (current_user_can( 'update_core' )) {
return;
}
wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ============================
    Запрещаем автозаполнение полей Contact form 7
=========================== */

add_filter( 'wpcf7_form_elements', 'imp_wpcf7_form_elements' );
function imp_wpcf7_form_elements( $content ) {
    $str_pos = strpos( $content, 'name="text-492"' );
    if ($str_pos) {
        $content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );     
    }

    $str_pos = strpos( $content, 'name="email-620"' );
    if ($str_pos) {
        $content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );
    }

    return $content;
}

add_filter( 'wpcf7_form_autocomplete', function ( $autocomplete ) {
    $autocomplete = 'off';
    return $autocomplete;
}, 10, 1 );


add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}
// отключаем xmlrpc.php
add_filter('xmlrpc_enabled', '__return_false');
remove_action( 'wp_head', 'rsd_link' );

function remove_output_structured_data() {
remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 );
}
add_action( 'init', 'remove_output_structured_data' );

// Заменяем тег <H2> на <H3> у подкатегорий
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'custom_woocommerce_template_loop_category_title', 10 );
function custom_woocommerce_template_loop_category_title( $category ) {
	echo '<h3 class="woocommerce-loop-category__title">';
	echo esc_html( $category->name );
	if ( $category->count > 0 ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $category->count ) . ')</mark>', $category );
	}
	echo '</h3>';
}
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );
// Заменяем тег <H2> на <p> у товаров
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'custom_woocommerce_template_loop_product_title', 10 );
function custom_woocommerce_template_loop_product_title() {
	echo '<p class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</p>';
}

add_action( 'wp_footer', 'redirect_cf7' );
function redirect_cf7() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
   if ( '575' == event.detail.contactFormId ) {
    location = '/uspeshnaya-otpravka-formy-poluchit-kp';
    }   else if ( '576' == event.detail.contactFormId ) {
                 location = '/uspeshnaya-otpravka-zayavki-na-lizing';
	}	else if ( '366' == event.detail.contactFormId ) {
                 location = '/uspeshnaya-otpravka-zayavki-zakazat-zvonok-so-straniczy-tovara';
	}	else if ( '479' == event.detail.contactFormId ) {
                 location = '/otpravka-formy-konsultacziya';
	}	else if ( '14267' == event.detail.contactFormId ) {
                 location = '/uspeshnaya-otpravka-zayavki-zakazat-zvonok-so-straniczy-kontakty';
    }   else    {
                 location = '/uspeshnaya-otpravka-formy';
    }
}, false );
</script>
<?php
}

function remove_from_admin_bar($wp_admin_bar) { $wp_admin_bar->remove_node('rank-math'); } add_action('admin_bar_menu', 'remove_from_admin_bar', 999);
/*add_filter('wpcf7_autop_or_not', '__return_false');*/

add_image_size( 'featured-image', 1920, 600, true );

add_shortcode('getMainSlider', 'getMainSlider');

function getMainSlider() {
    $ret = '<div class="main-slider owl-carousel">';

    $aargs = array(
        'numberposts'      => 10,
        'category'         => 1169,
        'post_type'        => 'post',
        'suppress_filters' => true,
        'orderby'          => 'post_date',
        'order'            => 'DESC'
    );

    $aposts = get_posts($aargs);

    if (!$aposts) return '';

    foreach ($aposts as $apost) {
        $a_post_id = $apost->ID;
        $apmeta = get_post_meta($a_post_id);
        
        $thumb_id = get_post_thumbnail_id($a_post_id);
        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
        $bg_image = ($thumb_url) ? $thumb_url[0] : '';

        // Применяем фильтры к контенту (важно для обработки HTML внутри поста)
        $post_content = apply_filters('the_content', $apost->post_content);
        
        // Класс для новогоднего баннера
        $special_class = ($a_post_id == 15800) ? ' ny-holiday-slide' : '';

        $ret .= '<div class="item" style="background-image: url(' . esc_url($bg_image) . ')">
            <div class="container">
                <div class="text slide-id-' . $a_post_id . $special_class . '">';

if($a_post_id != 16271){
    $ret .= '<div class="banner-title">' . esc_html($apost->post_title) . '</div>';
}

$ret .= '<div class="banner-description">' . $post_content . '</div>';

        if (!empty($apmeta['ssylka'][0])) {
            $ret .= '<a href="' . esc_url($apmeta['ssylka'][0]) . '" class="button white">Подробнее</a>';
        }

        $ret .= '       </div>
                    </div>
                 </div>';
    }

    $ret .= '</div>';
    return $ret;
}

/**
 * Vesrion: 1.0
 */

add_action( 'init', [ Collapse_Admin_Bar::class, 'init' ] );

final class Collapse_Admin_Bar {

	public static function init(): void {
		add_action( 'admin_bar_init', [ __CLASS__, 'hooks' ] );
	}

	public static function hooks(): void {
		// remove html margin bumps
		remove_action( 'wp_head', '_admin_bar_bump_cb' );

		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'collapse_styles' ] );
	}

	public static function collapse_styles(): void {
		$styles = <<<CSS
			#wpadminbar {
				transition: clip-path .3s ease 1s, background-color .2s ease 1s;
				clip-path: polygon(0 0, 32px 0, 32px 100%, 0 100%);
			}

			#wpadminbar:not( :hover ) {
				background-color: rgba(29, 35, 39, 0);
			}

			#wpadminbar:not( :hover ) .ab-item::before {
				color: #1d2327;
				transition-delay: 1s;
			}

			#wpadminbar .ab-item {
				position: relative;
			}

			#wpadminbar #wp-admin-bar-site-name > .ab-item::after {
				content: '';
				position: absolute;
				top: 7px;
				left: 7px;
				z-index: -1;
				width: 20px;
				height: 20px;
				border-radius: 50%;
				background-color: #fff;
				opacity: .8;
				transition: opacity .2s ease 1s;
			}

			#wpadminbar:hover #wp-admin-bar-site-name > .ab-item::after {
				opacity: 0;
				transition-delay: 0s;
			}

			#wpadminbar:not( :hover ) > * {
				pointer-events: none;
			}

			#wpadminbar:hover {
				transition-delay: 0s;
				clip-path: polygon(0 0, 100% 0, 100% 100vh, 0 100vh);
			}

			@media screen and ( max-width: 782px ) {
				#wpadminbar {
					clip-path: polygon(0 0, 50px 0, 50px 100%, 0 100%);
				}
			}
			CSS;

		wp_register_style( 'collapse-admin-bar', false ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_add_inline_style( 'collapse-admin-bar', $styles );
		wp_enqueue_style( 'collapse-admin-bar' );
	}

}

add_shortcode('portable_hook', function($atts){
	ob_start();
        $atts = shortcode_atts( array(
            'hook_name' => 'no foo'
        ), $atts, 'portable_hook' );
		do_action($atts['hook_name']);
	return ob_get_clean();
});

/* === WP CORE SCRIPT FIXES (AUTO-ADDED) === */
add_action( 'wp_head', function() {
    wp_enqueue_script( 'wp-i18n' );
    wp_enqueue_script( 'underscore' );
}, 1 );

add_filter( 'script_loader_tag', function( $tag, $handle ) {

    $core = [
        'underscore',
        'wp-util',
        'wp-i18n',
        'wp-hooks',
        'wp-element',
        'wp-polyfill',
    ];

    if ( in_array( $handle, $core ) ) {
        return str_replace(['defer','async'], '', $tag);
    }

    return $tag;
}, 10, 2 );
/* === END FIXES === */

/**
 * Spectechcom — кастомные хлебные крошки + JSON-LD + стили + primary category logic
 *
 * Вставить в конец functions.php или подключаемого файла.
 */

/**
 * Найти primary category для товара
 * 1) Проверяет Yoast Primary Term (_yoast_wpseo_primary_product_cat)
 * 2) Ищет WPSEO (Yoast) или WP_Term meta if available (robust)
 * 3) Если нет — выбирает самую «глубокую» (max depth) категорию из product_cat
 * 4) Если и этого нет — возвращает первый термин
 */
function stc_get_primary_product_cat( $post_id = 0 ) {
    if ( ! $post_id ) $post_id = get_the_ID();
    if ( ! $post_id ) return false;

    // 1) Yoast primary product category meta (common)
    $yoast_key = '_yoast_wpseo_primary_product_cat';
    $primary_id = get_post_meta( $post_id, $yoast_key, true );
    if ( $primary_id ) {
        $term = get_term( (int) $primary_id, 'product_cat' );
        if ( $term && ! is_wp_error( $term ) ) {
            return $term;
        }
    }

    // 2) Rank Math primary (if any) -- Rank Math stores different meta, try fallback (example)
    // (Rank Math doesn't have a single official primary term meta like WPSEO, so skip complex handling)

    // 3) Basic fallback: choose the deepest category (max ancestor count)
    $terms = get_the_terms( $post_id, 'product_cat' );
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return false;
    }

    $best = null;
    $best_depth = -1;
    foreach ( $terms as $t ) {
        $anc = get_ancestors( $t->term_id, 'product_cat' );
        $depth = is_array( $anc ) ? count( $anc ) : 0;
        // prefer deeper (more specific); tie-breaker: lower term_id
        if ( $depth > $best_depth || ( $depth == $best_depth && $t->term_id < $best->term_id ) ) {
            $best = $t;
            $best_depth = $depth;
        }
    }

    return $best;
}

/**
 * Построить массив элементов хлебных крошек (для HTML и JSON-LD)
 * Возвращает упорядоченный массив элементов: [ ['name'=>..., 'url'=>...], ... ]
 */
function stc_build_breadcrumb_items() {
    global $post;

    $items = array();

    // Always add home as first
    $items[] = array(
        'name' => __('Главная', 'spectechcom'),
        'url'  => home_url( '/' ),
    );

    // WooCommerce product category archive
    if ( is_product_category() ) {
        $cat = get_queried_object();
        if ( $cat && isset( $cat->term_id ) ) {
            $parents = get_ancestors( $cat->term_id, 'product_cat' );
            $parents = array_reverse( $parents );
            foreach ( $parents as $parent_id ) {
                $term = get_term( $parent_id, 'product_cat' );
                if ( $term && ! is_wp_error( $term ) ) {
                    $items[] = array( 'name' => $term->name, 'url' => get_term_link( $term ) );
                }
            }
            $items[] = array( 'name' => single_cat_title( '', false ), 'url' => '' );
        }
        return $items;
    }

    // Single product
    if ( is_product() ) {
        $primary = stc_get_primary_product_cat( $post->ID );
        if ( $primary ) {
            $parents = get_ancestors( $primary->term_id, 'product_cat' );
            $parents = array_reverse( $parents );
            foreach ( $parents as $parent_id ) {
                $term = get_term( $parent_id, 'product_cat' );
                if ( $term && ! is_wp_error( $term ) ) {
                    $items[] = array( 'name' => $term->name, 'url' => get_term_link( $term ) );
                }
            }
            // main category link
            $items[] = array( 'name' => $primary->name, 'url' => get_term_link( $primary ) );
        } else {
            // fallback: any product_cat
            $terms = get_the_terms( $post->ID, 'product_cat' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                $t = array_shift( $terms );
                $parents = get_ancestors( $t->term_id, 'product_cat' );
                $parents = array_reverse( $parents );
                foreach ( $parents as $parent_id ) {
                    $term = get_term( $parent_id, 'product_cat' );
                    if ( $term && ! is_wp_error( $term ) ) {
                        $items[] = array( 'name' => $term->name, 'url' => get_term_link( $term ) );
                    }
                }
                $items[] = array( 'name' => $t->name, 'url' => get_term_link( $t ) );
            }
        }
        // finally product title
        $items[] = array( 'name' => get_the_title(), 'url' => '' );
        return $items;
    }

    // Page with parent(s)
    if ( is_page() ) {
        if ( $post ) {
            $parents = get_post_ancestors( $post );
            if ( $parents ) {
                $parents = array_reverse( $parents );
                foreach ( $parents as $parent_id ) {
                    $items[] = array( 'name' => get_the_title( $parent_id ), 'url' => get_permalink( $parent_id ) );
                }
            }
            $items[] = array( 'name' => get_the_title( $post ), 'url' => '' );
        }
        return $items;
    }

    // Single blog post (not product)
    if ( is_single() && 'product' !== get_post_type() ) {
        $cats = get_the_category();
        if ( $cats ) {
            $cat = $cats[0];
            $parents = get_ancestors( $cat->term_id, 'category' );
            $parents = array_reverse( $parents );
            foreach ( $parents as $parent_id ) {
                $term = get_term( $parent_id, 'category' );
                if ( $term && ! is_wp_error( $term ) ) {
                    $items[] = array( 'name' => $term->name, 'url' => get_term_link( $term ) );
                }
            }
            $items[] = array( 'name' => $cat->name, 'url' => get_term_link( $cat ) );
        }
        $items[] = array( 'name' => get_the_title(), 'url' => '' );
        return $items;
    }

    // Category archive (blog)
    if ( is_category() ) {
        $items[] = array( 'name' => single_cat_title( '', false ), 'url' => '' );
        return $items;
    }

    // Fallback: just show current title if available
    if ( is_singular() && $post ) {
        $items[] = array( 'name' => get_the_title( $post ), 'url' => '' );
    }

    return $items;
}

/**Before After***/
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_script('jquery'); // jQuery

  // CSS
  wp_enqueue_style(
    'twentytwenty',
    get_template_directory_uri() . '/assets/css/twentytwenty.css'
  );

  // JS
  wp_enqueue_script(
    'event-move',
    get_template_directory_uri() . '/assets/js/jquery.event.move.min.js',
    ['jquery'],
    null,
    true
  );

  wp_enqueue_script(
    'twentytwenty',
    get_template_directory_uri() . '/assets/js/jquery.twentytwenty.js',
    ['jquery', 'event-move'],
    null,
    true
  );

});


// JS для сворачиваемой таблицы комплектации
add_action('wp_footer', function () {
  if ( ! is_product() ) return;
  ?>
  <script>
  (function(){
    var btn = document.querySelector('.stc-tabll-btn');
    if (!btn) return;
    var inner = document.querySelector('.stc-tabll-inner');
    var fade  = document.querySelector('.stc-tabll-fade');
    if (!inner || !fade) return;

    // Если контент короче max-height — скрываем кнопку
    if (inner.scrollHeight <= 600) {
      btn.style.display = 'none';
      fade.style.display = 'none';
      inner.style.maxHeight = 'none';
      return;
    }

    btn.addEventListener('click', function() {
      var isOpen = inner.classList.toggle('is-open');
      fade.classList.toggle('is-hidden', isOpen);
      btn.innerHTML = isOpen
        ? btn.getAttribute('data-close') + ' <i class="fa fa-chevron-up"></i>'
        : btn.getAttribute('data-open')  + ' <i class="fa fa-chevron-down"></i>';
    });
  })();
  </script>
  <?php
});

add_action('wp_footer', function () {
  if ( ! is_page('remont-uralov') ) return;
  ?>
  <script>
    jQuery(window).on('load', function () {
      jQuery('.before-after').twentytwenty({
        before_label: 'До',
        after_label: 'После',
        default_offset_pct: 0.5
      });
    });
  </script>
  <?php
});

/* ══════════════════════════════════════════════
   АГП 52 — два дизайна, раздельные ассеты
   page-agp52.php     → agp52.css / agp52.js
   page-agpauto52.php → agpauto52.css / agpauto52.js
══════════════════════════════════════════════ */

function agp52_enqueue_assets() {
    if ( is_page_template( 'page-agp52.php' ) ) {
        wp_enqueue_style(  'agp52-style',  get_template_directory_uri() . '/css/agp52.css',  [], '1.1.0' );
        wp_enqueue_script( 'agp52-script', get_template_directory_uri() . '/js/agp52.js',    [], '1.1.0', true );
    }
    if ( is_page_template( 'page-agpauto52.php' ) ) {
        wp_enqueue_style(  'agp52-style',  get_template_directory_uri() . '/css/agpauto52.css', [], '1.1.0' );
        wp_enqueue_script( 'agp52-script', get_template_directory_uri() . '/js/agpauto52.js',   [], '1.1.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'agp52_enqueue_assets' );

function agp52_body_class( $classes ) {
    if ( is_page_template( [ 'page-agp52.php', 'page-agpauto52.php' ] ) ) {
        $classes[] = 'agp52-page';
    }
    return $classes;
}
add_filter( 'body_class', 'agp52_body_class' );

function agp52_localize_ajax() {
    if ( is_page_template( [ 'page-agp52.php', 'page-agpauto52.php' ] ) ) {
        echo '<script>var ajaxurl = "' . esc_url( admin_url( 'admin-ajax.php' ) ) . '";</script>' . "\n";
    }
}
add_action( 'wp_head', 'agp52_localize_ajax' );

add_action( 'wp_ajax_agp52_send_kp',        'agp52_send_kp_handler' );
add_action( 'wp_ajax_nopriv_agp52_send_kp', 'agp52_send_kp_handler' );

function agp52_send_kp_handler() {
    if ( ! isset( $_POST['agp52_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['agp52_nonce'] ) ), 'agp52_send_kp' ) ) {
        wp_send_json_error( [ 'msg' => 'Ошибка безопасности.' ] );
    }

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $phone   = sanitize_text_field( $_POST['phone']   ?? '' );
    $email   = sanitize_email(      $_POST['email']   ?? '' );
    $comment = sanitize_textarea_field( $_POST['comment'] ?? '' );

    if ( empty( $phone ) ) {
        wp_send_json_error( [ 'msg' => 'Укажите номер телефона.' ] );
    }

    $to      = 'i.thor.ii@gmail.com';
    $subject = 'Запрос КП: АГП 52 с сайта';
    $body    = "Запрос КП на АГП 52\n\n"
             . "Имя:         {$name}\n"
             . "Телефон:     {$phone}\n"
             . "Email:       {$email}\n"
             . "Комментарий:\n{$comment}\n\n"
             . "Источник: " . home_url( '/agp-52' );

    $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];
    if ( $email ) $headers[] = "Reply-To: {$name} <{$email}>";

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'msg' => 'Спасибо! Менеджер свяжется с вами в течение 1 часа.' ] );
    } else {
        wp_send_json_error( [ 'msg' => 'Ошибка отправки. Позвоните: 8-800-600-41-42' ] );
    }
}

add_action( 'wp_ajax_agp52_send_kp',        'agp52_add_smtp_for_kp', 1 );
add_action( 'wp_ajax_nopriv_agp52_send_kp', 'agp52_add_smtp_for_kp', 1 );

function agp52_add_smtp_for_kp() {
    add_action( 'phpmailer_init', 'agp52_smtp_config' );
}

function agp52_smtp_config( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.yandex.ru';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 465;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Username   = 'popov.vip.evgeni@yandex.ru';
    $phpmailer->Password   = 'ВАШ_ПАРОЛЬ_ПРИЛОЖЕНИЯ'; // ← заменить
    $phpmailer->From       = 'popov.vip.evgeni@yandex.ru';
    $phpmailer->FromName   = 'АГП 52 — Спецтехкомплект';
    $phpmailer->CharSet    = 'UTF-8';
}
/**Before After END ***/

/**
 * Вывод HTML крошек (как у тебя)
 * Можно использовать как: echo stc_custom_breadcrumbs();
 * Также доступен шорткод [stc_breadcrumbs]
 */
function stc_custom_breadcrumbs() {
    $items = stc_build_breadcrumb_items();
    if ( empty( $items ) || ! is_array( $items ) ) return '';

    $html = '<div class="dam_breadcrumbs">';
    $count = count($items);

    foreach ($items as $index => $it) {
        $name = wp_kses_post($it['name']);
        $url  = isset($it['url']) ? $it['url'] : '';

        $is_last = ($index === $count - 1);

        if ($is_last) {
            // последний элемент — всегда span.last
            $html .= '<span class="last">' . $name . '</span>';
        } else {
            // обычная ссылка + разделитель
            $html .= '<a href="' . esc_url($url) . '">' . $name . '</a>';
            $html .= '<span class="separator">  </span>';
        }
    }

    $html .= '</div>';
    return $html;
}

add_shortcode( 'stc_breadcrumbs', 'stc_custom_breadcrumbs' );

/**
 * JSON-LD: выводим ItemList в head
 * Строим на основе тех же элементов, чтобы HTML и JSON совпадали
 */
function stc_breadcrumbs_jsonld() {
    $items = stc_build_breadcrumb_items();
    if ( empty( $items ) || ! is_array( $items ) ) return;

    // Build item list for schema
    $list = array();
    $position = 1;
    foreach ( $items as $it ) {
        $name = wp_strip_all_tags( $it['name'] );
        $url  = isset( $it['url'] ) && $it['url'] ? esc_url( $it['url'] ) : null;

        if ( $url ) {
            $list[] = array(
                '@type'    => 'ListItem',
                'position' => $position,
                'name'     => $name,
                'item'     => $url,
            );
        } else {
            // for the last item (current page) include as ListItem with no item URL
            $list[] = array(
                '@type'    => 'ListItem',
                'position' => $position,
                'name'     => $name,
            );
        }
        $position++;
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => $list,
    );

    // Output JSON-LD safely
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'stc_breadcrumbs_jsonld', 5 );



/**
 * Inline CSS для .dam_breadcrumbs (можно вынести в css файл)
 */
function stc_breadcrumbs_inline_css() {
    ?>
    <style>
    /* Spectechcom breadcrumbs styles */
    .dam_breadcrumbs { font-size: 14px; line-height: 1.3; color: #333; }
    .dam_breadcrumbs a { color: #0a4b8c; text-decoration: none; margin-right: 6px; }
    .dam_breadcrumbs a:hover { text-decoration: underline; }
    .dam_breadcrumbs .separator { color: #999; margin: 0 6px; }
    .dam_breadcrumbs .last { color: #222; font-weight: 600; }
    @media (max-width: 768px) {
        .dam_breadcrumbs { font-size: 13px; }
    }
    </style>
    <?php
}
add_action( 'wp_head', 'stc_breadcrumbs_inline_css', 6 );

/**
 * OPTIONAL: Автоматически заменить вывод RankMath breadcrumbs в контексте темы
 * Если в теме где-то вызывается rank_math_the_breadcrumbs(), этот фильтр отключит его.
 */
add_filter( 'rank_math/frontend/breadcrumb/show', '__return_false' );

?>
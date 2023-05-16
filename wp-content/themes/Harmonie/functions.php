<?php
require get_theme_file_path('/inc/scripts.php');
require get_theme_file_path('/inc/customizer/customizer.php');

/******      costum Functions       ********/
require get_theme_file_path('/inc/my-functions/mini-functions.php');

/********       Custom Fonctions            ******/
require get_theme_file_path('/inc/my-functions/pagination.php');

/****** Account Hooks & Functions ********/
require get_theme_file_path('/inc/my-functions/gutenberg.php');

/******         ACF Filters      ********/
require get_theme_file_path('/inc/my-functions/acf-filters.php');

/******         ACF Actions      ********/
require get_theme_file_path('/inc/my-functions/acf-actions.php');

/******         Wish List API Route      ********/
require get_theme_file_path('/inc/my-functions/wishlist-route.php');



add_filter('show_admin_bar', '__return_false');
add_action('after_setup_theme', 'harmonie_features');
function harmonie_features()
{
    add_theme_support('title-tag');
    add_theme_support('comments');
    add_theme_support('woocommerce');


    /*          images sizes            */
    add_image_size('siteLogo', 130, 70);
    add_image_size('ProductThumb', 306, 340, true);
    add_image_size('ModalThumb', 416, 460, true);
    add_image_size('ModalThumbMed', 270, 300, true);
    add_image_size('ModalThumbSmall', 237, 262, true);

    add_image_size('ModalSliderThumb', 50, 55, true);
    add_image_size('sideCartImg', 75, 81, true);
    add_image_size('singleProductThumb', 800, 800, true);
    add_image_size('cartImg', 61, 61, true);
    add_image_size('aboutUsImg', 708, 430, true);
    add_image_size('homeCatSec', 1050, 360, true);
    add_image_size('offreSecProduct', 429, 150, true);
    add_image_size('brands', 166, 80, true);
    add_image_size('menuBanner', 305, 145, true);
}


function harmonie_store_category_lists()
{
    $category_lists = array();
    $category_lists[0] = __('Select Category', 'gaga-lite');
    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'hierarchical' => 0, // 1 for yes, 0 for no  
        'hide_empty' => 0,
        'exclude' => 1 //list of product_cat id that you want to exclude (string/array).
    );
    $all_categories = get_categories($args);

    return $all_categories;
}

// disable updates 
add_filter('auto_update_plugin', '__return_false');


/****** Ajax Filter System ********/
require get_theme_file_path('/inc/my-functions/ajax-filter.php');

/****** Single Product Hooks ********/
require get_theme_file_path('/inc/woo_hooks/single-product-hooks.php');

/****** Cart Hooks & Functions ********/
require get_theme_file_path('/inc/woo_hooks/cart-hooks.php');

/****** Checkout Hooks & Functions ********/
require get_theme_file_path('/inc/woo_hooks/checkout-hooks.php');

/****** Account Hooks & Functions ********/
require get_theme_file_path('/inc/woo_hooks/account-hooks.php');



global $default_image;
$default_image = 'https://placehold.jp/808080/ffffff/306x340.jpg?text=No%20image%20available';



// add_theme_support('woocommerce');

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
    // $cols contains the current number of products per page based on the value stored on Options –> Reading
    // Return the number of products you wanna show per page.
    $cols = 9;
    return $cols;
}

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'MAD':
            $currency_symbol = 'MAD';
            break;
    }
    return $currency_symbol;
}

/**
 * Remove p tag from contact from 7
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Redirect to Home page after logout
 */
function auto_redirect_after_logout()
{
    wp_safe_redirect(home_url());
    exit;
}
add_action('wp_logout', 'auto_redirect_after_logout');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts()
{
    echo '<style>
    .image-full-with-acf{
        text-align: center;
    }
    .image-full-with-acf .acf-image-uploader{
        justify-content: center;
        display: flex;
    }
    .gr_spinner{
        display: flex;
        justify-content: center;
        padding-bottom: 10px;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield; /* Firefox */
    }
  </style>';
}


function my_enqueue_scripts($hook)
{
    // Only enqueue the script on the edit page for the relevant post type
    if ($hook == 'post.php' && (get_post_type() == 'page' || get_post_type() == 'product')) {
        wp_enqueue_script('my-script', get_theme_file_uri('/src/js/modules/admin-side.js'), array('jquery'), '1.0', true);
        $root_url =  str_replace('http://', 'https://', get_site_url());
        wp_localize_script('my-script', 'harmoniedata', array(
            'root_url' => $root_url,
        ));
    }
}
add_action('admin_enqueue_scripts', 'my_enqueue_scripts');


add_action('rest_api_init', 'register_author_api');

function register_author_api()
{
    // register_rest_field('wishlist', 'product_id', array(
    //     'get_callback' => function () {
    //         return get_field('product_id');
    //     },
    // ));
    register_rest_field('wishlist', 'author', array(
        'get_callback' => function () {
            return get_the_author_meta('ID');
        },
    ));
}


function my_custom_menu()
{
    register_nav_menus(
        array(
            'footer_left' => __('Footer Left'),
            'footer_middle' => __('Footer Middle'),
            'footer_right' => __('Footer Right')
        )
    );
}
add_action('init', 'my_custom_menu');


add_filter('ai1wm_exclude_content_from_export', 'exclude_files_migration');
function exclude_files_migration($exclude_filters)
{
    $exclude_filters[] = 'themes/harmonie/node_modules';
    return $exclude_filters;
}

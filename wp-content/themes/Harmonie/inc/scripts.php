<?php
function harmonieScripts()
{
    /*********************** CSS Declaration ****************/
    wp_enqueue_style('fonts', get_theme_file_uri('/src/css/fonts.css'));
    wp_enqueue_style('icons', get_theme_file_uri('/src/css/vendor/ecicons.min.css'));
    /*********************** JS Declaration ****************/
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_theme_file_uri('/src/js/vendor/jquery-3.5.1.min.js'), array(), '3.5.1', true);
    wp_enqueue_script('popper', get_theme_file_uri('/src/js/vendor/popper.min.js'), array('jquery'), false, true);
    wp_enqueue_script('bootstrap', get_theme_file_uri('/src/js/vendor/bootstrap.min.js'), array('jquery'), false, true);
    wp_enqueue_script('jquery-migrate', get_theme_file_uri('/src/js/vendor/jquery-migrate-3.3.0.min.js'), array('jquery'), '3.3.0', true);
    wp_enqueue_script('modernizr', get_theme_file_uri('/src/js/vendor/modernizr-3.11.2.min.js'), array('jquery'), '3.11.2', true);

    //Main Scripts
    wp_enqueue_script('main', get_theme_file_uri('/build/header.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('mainPlugin', get_theme_file_uri('/build/pluginHeader.js'), array('jquery'), '1.0.0', true);

    wp_enqueue_style('globalPlug', get_theme_file_uri('/build/css/globalStylePlug.css'));
    wp_enqueue_style('global', get_theme_file_uri('/build/css/globalSt.css'));
    wp_enqueue_style('header', get_theme_file_uri('/build/css/headerSt.css'));

    // Home Page
    if (is_front_page()) {
        wp_enqueue_script('home', get_theme_file_uri('/build/home.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('pluginHome', get_theme_file_uri('/build/pluginHome.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('homePlug', get_theme_file_uri('/build/css/homeStylePlug.css'));
        wp_enqueue_style('home', get_theme_file_uri('/build/css/homeSt.css'));
    }

    // Shop Page
    if (is_shop() || is_archive() || is_search()) {
        wp_enqueue_script('shop', get_theme_file_uri('/build/shop.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('nouislider', get_theme_file_uri('/src/js/plugins/nouislider.js'), array('jquery'), false, true);
        wp_enqueue_script('pluginShop', get_theme_file_uri('/build/pluginShop.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('shopPlug', get_theme_file_uri('/build/css/shopStylePlug.css'));
        wp_enqueue_style('shop', get_theme_file_uri('/build/css/shopSt.css'));
    }

    // Single Product 
    if (is_product()) {
        wp_enqueue_script('product', get_theme_file_uri('/build/product.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('pluginProduct', get_theme_file_uri('/build/pluginProduct.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('productPlug', get_theme_file_uri('/build/css/productStylePlug.css'));
        wp_enqueue_style('product', get_theme_file_uri('/build/css/productSt.css'));

        /*********************** Overriding Woocommerce JS ****************/
        wp_deregister_script('wc-single-product');
        wp_enqueue_script('wc-single-product', get_theme_file_uri('/src/js/modules/wc-single-product.js'), array('jquery'), null, true);
    }

    // Cart Page 
    if (is_page('cart')) {
        wp_enqueue_script('cart', get_theme_file_uri('/build/cart.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('cart', get_theme_file_uri('/build/css/cartSt.css'));
    }

    // CheckOut Page 
    if (is_checkout()) {
        wp_enqueue_script('checkout', get_theme_file_uri('/build/checkout.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('checkout', get_theme_file_uri('/build/css/checkoutSt.css'));
    }

    // FAQ Page 
    if (is_page('faq')) {
        wp_enqueue_script('faq', get_theme_file_uri('/build/faq.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('faq', get_theme_file_uri('/build/css/faqSt.css'));
    }

    // WishList Page 
    if (is_page('wishlist')) {
        wp_enqueue_script('wishlist', get_theme_file_uri('/build/wishlist.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('pluginWishlist', get_theme_file_uri('/build/pluginWishlist.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_style('wishlistPlug', get_theme_file_uri('/build/css/wishlistStylePlug.css'));
        wp_enqueue_style('wishlist', get_theme_file_uri('/build/css/wishlistSt.css'));
    }

    // 404 Page 
    if (is_404()) {
        wp_enqueue_style('page404', get_theme_file_uri('/build/css/404.css'));
    }

    // About US 
    if (is_page('about-us')) {
        wp_enqueue_style('about-us', get_theme_file_uri('/build/css/aboutUsSt.css'));
    }

    // Contact Us 
    if (is_page('contact-us')) {
        wp_enqueue_style('contact-us', get_theme_file_uri('/build/css/contactUsSt.css'));
    }

    // Login 
    if (is_page('login') || is_page('register')) {
        wp_enqueue_style('Clogin', get_theme_file_uri('/build/css/loginSt.css'));
    }

    // Account
    if (is_page('my-account')) {
        wp_enqueue_style('my-account', get_theme_file_uri('/build/css/myAccountSt.css'));
    }

    if (is_page('privacy-policy')) {
        wp_enqueue_style('terms', get_theme_file_uri('/build/css/terms.css'));
    }

    wp_localize_script('main', 'harmoniedata', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
    // Responsive Style
    wp_enqueue_style('responsive', get_theme_file_uri('/build/css/responsive.css'));
}
add_action('wp_enqueue_scripts', 'harmonieScripts');

/**
 * Disable contact form block styles (front-end).
 */
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

add_action('wp_enqueue_scripts', 'load_wpcf7_scripts');
function load_wpcf7_scripts()
{
    if (is_page('contact-us')) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }
        if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
        }
    }
}

/**
 * Disable WooCommerce block styles (front-end).
 */
function themesharbor_disable_woocommerce_block_styles()
{
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('woocommerce-general-css');
    wp_dequeue_style('woocommerce-layout-css');
    wp_dequeue_style('wp-mediaelement');
    wp_dequeue_style('newsletter-css');
}
add_action('wp_enqueue_scripts', 'themesharbor_disable_woocommerce_block_styles');
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

<?php

$show_default_orderby    = 'menu_order' === apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby', 'menu_order'));
$catalog_orderby_options = apply_filters(
    'woocommerce_catalog_orderby',
    array(
        'menu_order' => __('Default sorting', 'woocommerce'),
        'popularity' => __('Popularity', 'woocommerce'),
        'rating'     => __('Average rating', 'woocommerce'),
        'date'       => __('Latest', 'woocommerce'),
        'price'      => __('Low to high', 'woocommerce'),
        'price-desc' => __('High to low', 'woocommerce'),
    )
);

$default_orderby = wc_get_loop_prop('is_search') ? 'relevance' : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby', ''));
// phpcs:disable WordPress.Security.NonceVerification.Recommended
$orderby = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : $default_orderby;
// phpcs:enable WordPress.Security.NonceVerification.Recommended

if (wc_get_loop_prop('is_search')) {
    $catalog_orderby_options = array_merge(array('relevance' => __('Relevance', 'woocommerce')), $catalog_orderby_options);

    unset($catalog_orderby_options['menu_order']);
}

if (!$show_default_orderby) {
    unset($catalog_orderby_options['menu_order']);
}

if (!wc_review_ratings_enabled()) {
    unset($catalog_orderby_options['rating']);
}

if (!array_key_exists($orderby, $catalog_orderby_options)) {
    $orderby = current(array_keys($catalog_orderby_options));
}

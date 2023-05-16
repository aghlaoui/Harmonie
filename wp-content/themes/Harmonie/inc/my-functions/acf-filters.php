<?php

/**
 * Add options to ACF select field
 * 
 */
add_filter('acf/load_field/name=home_slider_product', 'acf_load_product_field_choices');
function acf_load_product_field_choices($field)
{
    $field['choices'] = array();

    $products = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));

    if (is_array($products) && !empty($products)) {
        foreach ($products as $product) {
            $post_title = sanitize_text_field($product->post_title);
            $field['choices'][$product->ID] = $post_title;
        }
    }
    return $field;
}

add_filter('acf/load_field/name=hpt_parent_category', 'home_product_tab_categories');
function home_product_tab_categories($field)
{
    $field['choices'] = array();

    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'pad_counts' => true
    ));

    if (!empty($categories)) {
        foreach ($categories as $category) {
            if ($category->count > 0 && $category->parent == 0) {
                $field['choices'][$category->term_id] = $category->name;
            }
        }
    }

    return $field;
}

add_filter('acf/load_field/name=hbs_category', 'home_banner_section_categories');
function home_banner_section_categories($field)
{
    $field['choices'] = array();

    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'pad_counts' => true
    ));

    $field['choices'][0] = 'Sélectionner une catégorie';
    if (!empty($categories)) {
        foreach ($categories as $category) {
            if ($category->count > 0 && $category->slug != 'uncategorized') {
                $field['choices'][$category->term_id] = $category->name;
            }
        }
    }

    return $field;
}

add_filter('acf/load_field/name=hsc_category', 'home_category_section_categories');
function home_category_section_categories($field)
{
    $field['choices'] = array();

    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'pad_counts' => true
    ));

    $field['choices'][0] = 'Sélectionner une catégorie';
    if (!empty($categories)) {
        foreach ($categories as $category) {
            if ($category->count > 0 && $category->slug != 'uncategorized') {
                $field['choices'][$category->term_id] = $category->name;
            }
        }
    }

    return $field;
}


add_filter('acf/load_field/name=the_product_select', 'testing_section_categories');
function testing_section_categories($field)
{
    $field['choices'] = array();

    $products = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));

    if (is_array($products) && !empty($products)) {
        foreach ($products as $product) {
            $post_title = sanitize_text_field($product->post_title);
            $field['choices'][$product->ID] = $post_title;
        }
    }
    return $field;
}


add_filter('acf/load_field/name=hp_offer_selectProduct', 'offer_section_products');
function offer_section_products($field)
{
    $field['choices'] = array();

    $products = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));

    if (is_array($products) && !empty($products)) {
        foreach ($products as $product) {
            $post_title = sanitize_text_field($product->post_title);
            $field['choices'][$product->ID] = $post_title;
        }
    }
    return $field;
}

add_filter('acf/load_field/name=mb_product', 'menu_banner_product');
function menu_banner_product($field)
{
    $field['choices'] = array();

    $products = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));

    if (is_array($products) && !empty($products)) {
        foreach ($products as $product) {
            $post_title = sanitize_text_field($product->post_title);
            $field['choices'][$product->ID] = $post_title;
        }
    }
    return $field;
}


add_filter('acf/load_field/name=wtsp_manager', 'wtsp_manager_list');
function wtsp_manager_list($field)
{
    $field['choices'] = array();

    $users = get_users(array('role__in' => array('shop_manager', 'administrator')));

    if (!empty($users)) {
        foreach ($users as $user) {
            $user_name = sanitize_text_field($user->display_name);
            $field['choices'][$user->ID] = $user_name;
        }
    }
    return $field;
}

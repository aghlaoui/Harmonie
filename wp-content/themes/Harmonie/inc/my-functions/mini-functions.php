<?php

function formatted_navbar_list($id)
{
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => $id
    ));
    foreach ($categories as $category) {
        $permalink = esc_url(get_category_link($category->term_id));
        $name = sanitize_text_field($category->name);
        $list_item = sprintf('<li><a href="%s">%s</a></li>', $permalink, $name);
        echo $list_item;
    }
}

function testfunction()
{
    // First, get the current category object
    $current_category = get_queried_object();
    $the_parent = '';
    // Check if this is a WooCommerce product category
    if (is_a($current_category, 'WP_Term') && $current_category->taxonomy === 'product_cat') {

        // Get the parent category ID
        $parent_category_id = $current_category->parent;

        // If the category has a parent, get the parent category object
        if ($parent_category_id) {
            $parent_category = get_term($parent_category_id, 'product_cat');

            // Get the grandparent category ID
            $grandparent_category_id = $parent_category->parent;

            // If the category has a grandparent, get the grandparent category object
            if ($grandparent_category_id) {
                $grandparent_category = get_term($grandparent_category_id, 'product_cat');
                $the_parent = $grandparent_category->term_id;
            } else {
                $the_parent = $parent_category->term_id;
            }
        } else {
            $the_parent = $current_category->term_id;
        }
    }
    return $the_parent;
}


function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

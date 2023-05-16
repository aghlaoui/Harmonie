<?php

add_action('rest_api_init', 'register_wishlist');
function register_wishlist()
{
    register_rest_route('ecommerce/v1', 'wishlist', array(
        'methods' => 'POST',
        'callback' => 'addToWishlist'
    ));
    register_rest_route('ecommerce/v1', 'wishlist', array(
        'methods' => 'DELETE',
        'callback' => 'RemoveFromWishlist'
    ));
}

function addToWishlist($data)
{
    if (is_user_logged_in()) {
        $product_id = sanitize_text_field($data['product_id']);
        $existInWishList = new WP_Query(array(
            'post_type' => 'wishlist',
            'author' => get_current_user_id(),
            'meta_query' => array(
                array(
                    'key' => 'product_id',
                    'compare' => '=',
                    'value' => $product_id
                )
            )
        ));
        if ($existInWishList->found_posts == 0 && get_post_type($product_id) == 'product') {
            return wp_insert_post(array(
                'post_type' => 'wishlist',
                'post_status' => 'publish',
                'author' => get_current_user_id(),
                'meta_input' => array(
                    'product_id' => $product_id
                )
            ));
        } else {
            die("You can only add item to your wish list once");
        }
    } else {
        die("user not loged in");
    }
}

function RemoveFromWishlist($data)
{
    $wish_id = sanitize_text_field($data['wish_id']);
    if (get_current_user_id() == get_post_field('post_author', $wish_id) && get_post_type($wish_id) == 'wishlist') {
        wp_delete_post($wish_id, true);
        return 'Item Removed';
    } else {
        return 'You Cannot Perform This Action';
    }
}

// Limit Wishlist Items Per User

add_filter('wp_insert_post_data', 'limitWishlistItems', 10, 2);
function limitWishlistItems($data, $postarr)
{
    if ($data['post_type'] == 'wishlist') {
        if (count_user_posts(get_current_user_id(), 'wishlist') > 15 && !$postarr['ID']) {
            die("limits reached");
        }
    }
    return $data;
}

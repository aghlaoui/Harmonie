<?php
$default_image = 'https://placehold.jp/808080/ffffff/306x340.jpg?text=No%20image%20available';
$product_id = get_the_ID();
$title = sanitize_text_field(get_the_title());
$thumbnail = (get_the_post_thumbnail_url($product_id)) ? esc_url(get_the_post_thumbnail_url($product_id, 'ProductThumb')) : $default_image;
$permalink = get_the_permalink();



/****       WooCommerce Data        ****/
$product = wc_get_product($product_id);
$attachment_ids = $product->get_gallery_image_ids();
// print("<pre>" . print_r($product, true) . "</pre>");
if ($attachment_ids) {
    $first_image_id = $attachment_ids[0];
    // Display the image URL
    $image_url = esc_url(wp_get_attachment_image_url($first_image_id, 'ProductThumb'));
    $gallery_av = true;
} else {
    $gallery_av = false;
}
$short_description = sanitize_text_field($product->get_short_description());
/****       getting products variations      ****/

$variation_product = new WC_Product_Variable($product_id);
$variations = $variation_product->get_available_variations();
//print("<pre>" . print_r($variations, true) . "</pre>");
$init_colors = array();
$init_sizes = array();
if ($variations) {
    // print("<pre>" . print_r($variations, true) . "</pre>");

    foreach ($variations as $value) {
        /*****  Creating Colors And Images Array *****/
        if (isset($value['attributes']['attribute_pa_color'])) {
            $product_color_image = $value['image']['url'];
            $product_color_image = str_replace(".jpg", "-306x340.jpg", $product_color_image);
            $product_colors =  $value['attributes']['attribute_pa_color'];
            $newArrayColor = array(
                $product_colors => array(
                    "image_url" => $product_color_image
                )
            );
            array_push($init_colors, $newArrayColor);
        }
        /*****  Creating Sizes And Prices Array *****/
        if (isset($value['attributes']['attribute_pa_size'])) {
            $product_sizes = $value['attributes']['attribute_pa_size'];
            $v_display_price = $value['display_price'];
            $v_regular_price = $value['display_regular_price'];
            $newArraySizes = array(
                $product_sizes => array(
                    "regular_price" => $v_regular_price,
                    "display_price" => $v_display_price
                ),
            );
            if ($v_display_price != $v_regular_price) {
                array_push($init_sizes, $newArraySizes);
            }
        } else {
            if ($value['display_regular_price'] != $value['display_price']) {
                $regular_price = $value['display_regular_price'];
                $display_price = $value['display_price'];
            } else {
                $regular_price = $value['display_regular_price'];
                $display_price = null;
            }
        }
    }
    /**** Remove Duplicates From Colors Array ****/
    $colors = array_map('json_encode', $init_colors);
    $colors = array_unique($colors);
    $colors = array_map('json_decode', $colors, array_fill(0, count($colors), true));
    /**** Remove Duplicates From Sizes Array ****/
    $sizes = $init_sizes;
    $sizes = array_map('json_encode', $init_sizes);
    $sizes = array_unique($sizes);
    $sizes = array_map('json_decode', $sizes, array_fill(0, count($sizes), true));
    /*********    Product Type       **********/
    $product_type = "variable";
} else {
    $colors = null;
    $sizes = null;
    $regular_price = $product->get_regular_price();
    $display_price = $product->get_sale_price();
    /*********    Product Type       **********/
    $product_type = "simple";
}
// print("<pre>" . print_r($colors, true) . "</pre>");
// print("<pre>" . print_r($sizes, true) . "</pre>");

/****** Check for Variations Available *****/
if (!$sizes && !$colors) {
    $style = 'style = "margin-bottom: 22px;"';
    $av_variable = 'none';
} else if ($sizes && !$colors) {
    $av_variable = 'size';
    $style = null;
} else if (!$sizes && $colors) {
    $av_variable = 'color';
    $style = null;
} else {
    $av_variable = 'both';
    $style = null;
}

// rating 
$average_rating = $product->get_average_rating();
$review_count = $product->get_review_count();
// print("<pre>" . print_r($product, true) . "</pre>");

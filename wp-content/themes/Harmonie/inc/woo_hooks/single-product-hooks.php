<?php

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//breadcrumbs

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content', 'harmonie_breadcrumb', 20);
function harmonie_breadcrumb()
{
    global $post;
?>
    <div class="sticky-header-next-sec  ec-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title"><?php the_title() ?></h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                                <?php
                                $terms = get_the_terms($post->ID, 'product_cat');

                                if ($terms) {
                                    foreach ($terms as $term) {
                                        if ($term->parent == 0) {
                                            echo '<li class="ec-breadcrumb-item active">' .  $term->name . '</li>';
                                        } else {
                                            echo '<li class="ec-breadcrumb-item active">' .  $term->name . '</li>';
                                        }
                                    }
                                } else {
                                    echo '<li class="ec-breadcrumb-item active">Global</li>';
                                }
                                ?>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?
}
/*********      PAGE CONTENT     *********/
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
//slider 
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
add_action('woocommerce_before_single_product_summary', 'harmonie_show_product_images', 20);

function harmonie_show_product_images()
{
    global $post;
    $product = new WC_product($post->ID);
    $attachment_ids = $product->get_gallery_image_ids();

?>
    <div class="single-pro-img single-pro-img-no-sidebar">
        <div class="single-product-scroll">
            <?php
            if ($attachment_ids) {
                $thumbHTML = '<div class="single-product-cover">';
                $navHTML = '<div class="single-nav-thumb">';
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = esc_url(wp_get_attachment_image_url($attachment_id, 'singleProductThumb'));
                    $thumbHTML .= '<div class="single-slide zoom-image-hover">';
                    $thumbHTML .= '<img class="img-responsive" src="' . $image_url . '" alt="">';
                    $thumbHTML .= '</div>';
                }
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = esc_url(wp_get_attachment_image_url($attachment_id, 'sideCartImg'));
                    $navHTML .= '<div class="single-slide">';
                    $navHTML .= '<img class="img-responsive" src="' . $image_url . '" alt="">';
                    $navHTML .= '</div>';
                }
                $thumbHTML .= '</div>';
                $navHTML .= '</div>';

                echo $thumbHTML;
                echo $navHTML;
            } else {
                global $default_image;
                $thumbnail = (get_the_post_thumbnail_url($post->ID)) ? esc_url(get_the_post_thumbnail_url($post->ID, 'singleProductThumb')) : $default_image;
                $singleImgHTML = '<div class="single-slide zoom-image-hover">';
                $singleImgHTML .= '<img class="img-responsive" src="' . $thumbnail . '" alt="">';
                $singleImgHTML .= '</div>';

                echo $singleImgHTML;
            }
            ?>
        </div>
    </div>
<?php

}

// Rating 

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'harmonie_template_single_rating', 9);
function harmonie_template_single_rating()
{
    global $product;
    $average      = $product->get_average_rating();

    $ratingHTML = '<div class="ec-single-rating-wrap"><div class="ec-single-rating">';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $average) {
            $ratingHTML .= '<i class="ecicon eci-star fill"></i>';
        } else {
            $ratingHTML .= '<i class="ecicon eci-star-o"></i>';
        }
    }
    $ratingHTML .= '</div>';
    if ($average == 0) {
        $ratingHTML .= '<span class="ec-read-review"><a href="#ec-spt-nav-review">Soyez le premier à évaluer ce produit</a></span>';
    } else {
        $ratingHTML .= '<span class="ec-read-review"><a href="#ec-spt-nav-review">Évaluer ce produit</a></span>';
    }
    $ratingHTML .= '</div>';
    echo $ratingHTML;
}

// The Price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'harmonie_template_single_price', 22);
function harmonie_template_single_price()
{
    global $product;

    $price = $product->get_price();
    $sku = sanitize_text_field($product->get_sku());
    $stock_status = sanitize_text_field($product->get_stock_status());

    $priceHTML = '<div class="ec-single-price-stoke">';
    // Price section
    if ($price) {
        $priceHTML .= '<div class="ec-single-price"> <span class="ec-single-ps-title">A partir de</span> <span class="new-price">' . $price . ' MAD</span> </div>';
    } else {
        $priceHTML .= '<div class="ec-single-price"> <span class="ec-single-ps-title">Veuillez sélectionner un prix</span> </div>';
    }
    //SKU And Stock Status Section
    $priceHTML .= '<div class="ec-single-stoke">';

    if ($stock_status) {
        $priceHTML .= '<span class="ec-single-ps-title">' . strtoupper($stock_status) . '</span>';
    }
    if ($sku) {
        $priceHTML .= '<span class="ec-single-sku">SKU#: ' . strtoupper($sku) . '</span>';
    }
    $priceHTML .= '</div></div>';

    echo $priceHTML;
}

// Short Description 

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'harmonie_template_single_excerpt', 20);
function harmonie_template_single_excerpt()
{
    global $post;

    $short_description = wp_kses_post($post->post_excerpt);

    if (!$short_description) {
        return;
    }
?>
    <div class="ec-single-desc"><?php echo $short_description ?></div>
<?
}


// Variations Select Option 
function harmonie_wc_dropdown_variation_attribute_options($args = array())
{
    $args = wp_parse_args(
        apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args),
        array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'required'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __('Choose an option', 'woocommerce'),
        )
    );

    // Get selected value.
    if (
        false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product
    ) {
        $selected_key = 'attribute_' . sanitize_title($args['attribute']);
        // phpcs:disable WordPress.Security.NonceVerification.Recommended
        $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
        // phpcs:enable WordPress.Security.NonceVerification.Recommended
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
    $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $class                 = $args['class'];
    $required              = (bool) $args['required'];
    $show_option_none      = (bool) $args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

    if (empty($options) && !empty($product) && !empty($attribute)) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[$attribute];
    }

    $html  = '<select id="' . esc_attr($id) . '" class="form-select' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '"' . ($required ? ' required' : '') . '>';
    $html .= '<option value="">' . esc_html($show_option_none_text) . '</option>';

    if (!empty($options)) {
        if ($product && taxonomy_exists($attribute)) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ($terms as $term) {
                if (in_array(
                    $term->slug,
                    $options,
                    true
                )) {
                    $html .= '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product)) . '</option>';
                }
            }
        } else {
            foreach ($options as $option) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title(
                    $args['selected']
                ) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
                $html    .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product)) . '</option>';
            }
        }
    }

    $html .= '</select>';

    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args);
}

//Remove Product Meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Add Product Details

add_action('woocommerce_after_single_product_summary', 'Harmonie_output_product_data_tabs', 10);

function Harmonie_output_product_data_tabs()
{
    global $product;

    $details = sanitize_textarea_field($product->get_description());
    $more_details = sanitize_textarea_field($product->get_short_description());
    $product_tabs = apply_filters('woocommerce_product_tabs', array());
    $product_reviews_tab = $product_tabs['reviews'];
?>
    <div class="ec-single-pro-tab">
        <div class="ec-single-pro-tab-wrapper">
            <?php
            wc_get_template('custom/product-tabs.php', array(
                'details' => $details,
                'more_details' => $more_details,
                'review_tab' => $product_reviews_tab

            ));
            ?>
        </div>
    </div>
<?php
}

// Registring New Related Products

add_action('realted_products_section', 'related_products_function');
function related_products_function()
{
    $args = array(
        'posts_per_page' => 4,
        'columns'        => 4,
        'orderby'        => 'rand', // @codingStandardsIgnoreLine.
    );

    woocommerce_related_products(apply_filters('woocommerce_output_related_products_args', $args));
}

// Adding Count Down

add_action('woocommerce_single_product_summary', 'harmonie_template_single_coutdown', 21);
function harmonie_template_single_coutdown()
{
    global $product;
    // print("<pre>" . print_r($product, true) . "</pre>");

    $product_id = $product->get_id();
    $end_date = get_field('sales_end_date', $product_id);
    $start_date = date('Y/m/d H:i:s');
    $stock = $product->get_stock_quantity();

    if ($end_date && strtotime($end_date) > strtotime($start_date)) {
        wc_get_template('custom/count-down.php', array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'stock' => $stock
        ));
    }
}


/******    Reviews     ********/
//gravatar 

remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);
add_action('woocommerce_review_before', 'harmonie_review_display_gravatar', 10);

function harmonie_review_display_gravatar($comment)
{
    $gravatar = '<div class="ec-t-review-avtar">';
    $gravatar .= get_avatar($comment, apply_filters('woocommerce_review_gravatar_size', '90'), '');
    $gravatar .= '</div>';

    echo $gravatar;
}

// Rating starts

function hr_get_rating_html($rating, $count = 0)
{
    $html = '';
    $ratingRevHTML = '<div class="ec-t-review-rating">';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $ratingRevHTML .= '<i class="ecicon eci-star fill"></i>';
        } else {
            $ratingRevHTML .= '<i class="ecicon eci-star-o"></i>';
        }
    }
    $ratingRevHTML .= '</div>';

    echo $ratingRevHTML;
}

// Rating text 

remove_action('woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10);
add_action('woocommerce_review_comment_text', 'harmonie_review_display_comment_text', 10);

function harmonie_review_display_comment_text()
{
    echo '<div class="ec-t-review-bottom"><p>';
    comment_text();
    echo '</p></div>';
}

// Wish List Button
add_action('woocommerce_after_add_to_cart_button', 'add_to_wishlist', 10, 1);

function add_to_wishlist($product)
{
    // Wish List Button Logic
    $wishlist_status = 'no';
    $in_wishlist = '';
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $wishprod = new WP_Query(array(
            'post_type' => 'wishlist',
            'meta_query' => array(
                array(
                    'key' => 'product_id',
                    'compare' => '=',
                    'value' => $product->get_id()
                )
            ),
            'author' => $user_id
        ));
        $in_wishlist = ($wishprod->found_posts) ? 'active' : '';
        $wishlist_status = ($wishprod->found_posts) ? 'yes' : 'no';
        $wishlist_statusAttr = ($wishlist_status == 'yes') ? 'data-wishid ="' . $wishprod->posts[0]->ID . '" ' : '';

        printf(
            '<div class="ec-single-wishlist">
						<a class="ec-btn-group wishlist %s" %s title="Wishlist">
                            <i class="fi-rr-heart"></i>
                        </a>
					</div>',
            $in_wishlist,
            $wishlist_statusAttr
        );
    } else {
        echo '<div class="ec-single-wishlist"><a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a></div>';
    }
}

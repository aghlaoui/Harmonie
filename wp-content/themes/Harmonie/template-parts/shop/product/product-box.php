<?php
if ($box_type == 'archive') {
    $headClass = 'col-lg-4';
}
if ($box_type == 'single') {
    $headClass = 'col-lg-3';
}

?>
<?php if ($count == 1) :  ?>
    <div class="myAlert-top alert-wishlist alert-danger"></div>
<?php endif; ?>

<div class="<?php echo ($headClass) ? $headClass : 'col-lg-4' ?> col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">

                <a href="<?php echo $permalink ?>" class="<?php echo ($gallery_av) ? 'image' : '' ?>">
                    <img class="main-image" src="<?php echo $thumbnail ?>" alt="Product" />
                    <?php if ($gallery_av) { ?>
                        <img class="hover-image" src="<?php echo $image_url ?>" alt="Product" />
                    <?php } ?>
                </a>

                <?php
                // Delete The Product From The Wish List
                if (is_page('wishlist')) {
                    echo '<span class="ec-com-remove ec-remove-wish"><a href="javascript:void(0)">×</a></span>';
                }
                ?>

                <?php
                // Product Flags
                if ($product->is_on_sale()) {
                    $flags_HTML = '';
                    // Discount Percentage Calulation
                    $average = 0;
                    $average_regular = 0;
                    if ($variations) {
                        foreach ($variations as $value) {
                            $value_object = wc_get_product($value['variation_id']);
                            $vr_price =  $value_object->get_regular_price();
                            $vs_price =  $value_object->get_sale_price();
                            $v_average = intval($vr_price) - intval($vs_price);
                            if ($v_average > $average) {
                                $average = $v_average;
                                $average_regular = intval($vr_price);
                            }
                        }
                    } else {
                        $r_price = $product->get_regular_price();
                        $s_price = $product->get_sale_price();
                        $average = intval($r_price) - intval($s_price);
                        $average_regular = intval($r_price);
                    }
                    $discount_percentage = round($average / $average_regular * 100);

                    $flags_HTML .= sprintf('<span class="percentage">%.0f%%</span>', $discount_percentage);

                    // Sale And New Flags 
                    $product_date_create = strtotime($product->get_date_created());
                    $current_time = current_time('timestamp');
                    $days_diff = floor(($current_time - $product_date_create) / (69 * 60 * 24));
                    if (!is_page('wishlist')) {
                        if ($days_diff <= 10) {
                            $flags_HTML .= '<span class="flags"> <span class="new">New</span> </span>';
                        } else {
                            $flags_HTML .= '<span class="flags"> <span class="sale">Sale</span> </span>';
                        }
                    }

                    echo $flags_HTML; // Print The Flags
                }

                ?>


                <a href="#" class="quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal<?php echo '_' . $count ?>"><i class="fi-rr-eye"></i></a>

                <div class="ec-pro-actions" data-id="<?php echo $product_id ?>">
                    <!-- <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                    <?php
                    if ($product_type == 'simple') {
                        $addToCart_attr = 'data-id="' . $product_id . '"';
                    } else {
                        $addToCart_attr = 'onclick="window.open(' . "'" . esc_url(get_the_permalink()) . "'" . ", '_blank')" . '"';
                    }
                    ?>
                    <button title="Add To Cart" <?php echo ($addToCart_attr) ? $addToCart_attr : '' ?> data-type="<?php echo $product_type ?>" class="add-to-cart"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>

                    <?php
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
                                    'value' => $product_id
                                )
                            ),
                            'author' => $user_id
                        ));
                        $in_wishlist = ($wishprod->found_posts) ? 'active' : '';
                        $wishlist_status = ($wishprod->found_posts) ? 'yes' : 'no';
                        $wishlist_statusAttr = ($wishlist_status == 'yes') ? 'data-wishid ="' . $wishprod->posts[0]->ID . '" ' : '';

                        printf(
                            '<a class="ec-btn-group wishlist %s" %s title="Wishlist">
                                <i class="fi-rr-heart"></i>
                             </a>',
                            $in_wishlist,
                            $wishlist_statusAttr
                        );
                    } else {
                        echo '<a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="ec-pro-content">
            <h5 class="ec-pro-title"><a href="<?php echo $permalink ?>"><?php echo $title ?></a></h5>

            <div class="ec-pro-rating">
                <?php
                $rating_count = 1;
                $rating_HTML = '';
                while ($rating_count <= 5) {
                    if ($rating_count < $average_rating) {
                        $rating_HTML .= '<i class="ecicon eci-star fill"></i>';
                    } else {
                        $rating_HTML .= '<i class="ecicon eci-star"></i>';
                    }
                    $rating_count++;
                }
                echo $rating_HTML;
                ?>
            </div>

            <span class="ec-price">
                <?php
                /***********      Pricing Logic        ***********/
                if ($sizes) {
                    foreach ($sizes as $size) { ?>
                        <span class="old-price"><?php echo $size[key($size)]['regular_price'] ?> MAD</span>
                        <span class="new-price"><?php echo $size[key($size)]['display_price'] ?> MAD</span>
                    <?php break;
                    }
                } else {
                    ?>
                    <?php if ($display_price) { ?>
                        <span class="old-price"><?php echo $regular_price ?> MAD</span>
                        <span class="new-price"><?php echo $display_price ?> MAD</span>
                    <?php } else { ?>
                        <span class="new-price"><?php echo $regular_price ?> MAD</span>
                    <?php } ?>
                <?php
                } ?>
            </span>

            <div class="ec-pro-option" <?php echo (isset($style)) ? $style : '' ?>>
                <?php if ($colors) { ?>
                    <div class="ec-pro-color">
                        <span class="ec-pro-opt-label">Color</span>
                        <ul class="ec-opt-swatch ec-change-img">
                            <?php
                            foreach ($colors as $color) {
                            ?>
                                <li class="active">
                                    <a href="#" class="ec-opt-clr-img" data-src="<?php echo $color[key($color)]['image_url'] ?>" data-src-hover="<?php echo $color[key($color)]['image_url'] ?>" data-Color="<?php echo key($color); ?>">
                                        <span style="background-color:<?php echo key($color); ?>;"></span>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                if ($sizes) {
                ?>
                    <div class="ec-pro-size">
                        <span class="ec-pro-opt-label">Size</span>
                        <ul class="ec-opt-size">
                            <?php
                            $active = true;
                            foreach ($sizes as $size) {
                                if ($active) {
                                    echo "<li class='active'>";
                                    $active = false;
                                } else {
                                    echo "<li>";
                                }
                            ?>
                                <a href="#" class="ec-opt-sz" data-old="<?php echo $size[key($size)]['regular_price'] ?> MAD" data-new="<?php echo $size[key($size)]['display_price'] ?> MAD" data-size="<?php echo strtoupper(key($size)) ?>"><?php echo strtoupper(key($size)) ?></a></li>
                            <?php
                            }

                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
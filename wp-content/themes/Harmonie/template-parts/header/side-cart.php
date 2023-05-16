<!-- ekka Cart Start -->
<?php
/****** Getting Card Data  *****/
global $woocommerce;
$items = $woocommerce->cart->get_cart();
// print("<pre>" . print_r($items, true) . "</pre>");
?>
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">My Cart</span>
                <button class="ec-close">×</button>
            </div>
            <?php
            $total = 0;
            if (!empty($items)) { ?>
                <ul class="eccart-pro-items">
                    <?php

                    foreach ($items as $values) {
                        $product =  wc_get_product($values['data']->get_id());
                        //print("<pre>" . print_r($product, true) . "</pre>");

                        $title = sanitize_text_field($product->get_name());
                        $price = $product->get_price();
                        $quantity = $values['quantity'];

                        $imageID = $product->get_image_id();
                        $imageUrl = esc_url(wp_get_attachment_image_url($imageID, 'sideCartImg'));

                        $productLink = esc_url($product->get_permalink());

                        $key = $values['key'];

                        $productTotal = $price * $quantity;
                        $total = $total + $productTotal;
                    ?>
                        <li>
                            <a href="<?php echo $productLink ?>" class="sidekka_pro_img"><img src="<?php echo $imageUrl ?>" alt="product"></a>
                            <div class="ec-pro-content">
                                <a href="<?php echo $productLink ?>" class="cart_pro_title"><?php echo $title ?></a>
                                <span class="cart-price"><span><?php echo $price ?> MAD</span> x <p class="qty" style="display: inline-flex;"><?php echo $quantity ?></p></span>
                                <div class="qty-plus-minus" data-itemqty="">
                                    <input class="qty-input" type="text" name="ec_qtybtn" value="<?php echo $quantity ?>" />
                                </div>
                                <a href="javascript:void(0)" class="remove" data-key="<?php echo $key ?>">×</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else {
            ?>
                <ul class="eccart-pro-items">
                    <li>
                        <p class="emp-cart-msg">Your cart is empty!</p>
                    </li>
                </ul>
            <?php
            } ?>
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Total :</td>
                            <td class="text-right primary-color"><?php echo $total ?> MAD</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn cart-buttons">
                <a href="<?php echo esc_url(site_url('/cart')) ?>" class="btn btn-primary">View Cart</a>
                <a href="<?php echo esc_url(site_url('/checkout')) ?>" class="btn btn-secondary">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- ekka Cart End -->
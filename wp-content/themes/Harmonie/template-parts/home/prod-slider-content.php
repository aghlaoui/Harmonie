<?php while (have_rows($box, $id)) : the_row() ?>
    <?php while (have_rows('hp_slider', $id)) : the_row() ?>
        <?php
        $product_id = get_sub_field('the_product_select');
        $_product = wc_get_product($product_id);
        $permalink = esc_url(get_permalink($product_id));
        $average_rating = $_product->get_average_rating();
        $reviews_count = $_product->get_review_count();
        // Pricing logic 
        $regular_price = ($_product->get_regular_price()) ? $_product->get_regular_price() : $_product->get_price();
        $sale_price = $_product->get_sale_price();
        if ($sale_price) {
            $price = sprintf('<span class="old-price">%s %s</span><span class="new-price">%s MAD</span>', $regular_price, get_woocommerce_currency_symbol(), $sale_price);
        } else {
            $price = sprintf('<span class="new-price">%s %s</span>', $regular_price, get_woocommerce_currency_symbol());
        }
        $total_sales = $_product->get_total_sales();
        // Custome details 
        while (have_rows('details')) {
            the_row();
            $title = (!empty(get_sub_field('title'))) ? sanitize_text_field(get_sub_field('title')) : sanitize_text_field($_product->get_title());
            $description = (!empty(get_sub_field('description')))  ? sanitize_textarea_field(get_sub_field('description')) : esc_html($_product->get_short_description());
            $image_id = (!empty(get_sub_field('image'))) ? get_sub_field('image') : $_product->get_image_id();
        }
        $image_url = wp_get_attachment_image_src($image_id, 'ProductThumb');
        //countDown logic
        $countDown_field = get_field('sales_end_date', $product_id);
        $start_date = date('Y/m/d H:i:s');
        $end_date = ($countDown_field) ? $countDown_field : date('Y/m/d H:i:s', strtotime($start_date . ' +1 day'));
        ?>
        <div class="ec-fs-product">
            <div class="ec-fs-pro-inner">
                <div class="ec-fs-pro-image-outer col-lg-6 col-md-6 col-sm-6">
                    <div class="ec-fs-pro-image">
                        <a href="<?php echo $permalink ?>" class="image">
                            <img class="main-image" src="<?php echo esc_url($image_url[0]) ?>" alt="Product" />
                        </a>
                    </div>
                </div>
                <div class="ec-fs-pro-content col-lg-6 col-md-6 col-sm-6">
                    <h5 class="ec-fs-pro-title">
                        <a href="<?php echo $permalink ?>"><?php echo $title ?></a>
                    </h5>
                    <div class="ec-fs-pro-rating">
                        <span class="ec-fs-rating-icon">
                            <?php
                            $count = 1;
                            $rating_HTML = '';
                            while ($count <= 5) {
                                if ($count < $average_rating) {
                                    $rating_HTML .= '<i class="ecicon eci-star fill"></i>';
                                } else {
                                    $rating_HTML .= '<i class="ecicon eci-star"></i>';
                                }
                                $count++;
                            }
                            echo $rating_HTML;
                            ?>
                        </span>
                        <span class="ec-fs-rating-text"><?php echo $reviews_count ?> avis</span>
                    </div>
                    <div class="ec-fs-price">
                        <?php echo $price ?>
                    </div>

                    <div class="countdowntimer"><span data-start="<?php echo $start_date ?>" data-end="<?php echo $end_date ?>" id="ec-fs-count-<?php echo $coundown_count ?>"></span></div>
                    <div class="ec-fs-pro-desc"><?php echo $description ?></div>
                    <div class="ec-fs-pro-book">Total des ventes : <span><?php echo $total_sales ?></span></div>
                    <div class="ec-fs-pro-btn">
                        <a href="<?php echo $permalink ?>" class="btn btn-lg btn-secondary">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
        <?php $coundown_count++; ?>
    <?php endwhile; ?>
<?php endwhile; ?>
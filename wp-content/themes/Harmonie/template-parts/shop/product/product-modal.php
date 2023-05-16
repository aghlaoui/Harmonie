<div class="modal fade" id="ec_quickview_modal<?php echo '_' . $count ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <!-- Swiper -->
                        <div class="qty-product-cover">
                            <?php
                            if ($gallery_av) {
                                foreach ($attachment_ids as $attachment_id) {
                                    $image_url = esc_url(wp_get_attachment_image_url($attachment_id, 'ModalThumb'));
                                    $image_srcset = esc_attr(wp_get_attachment_image_srcset($attachment_id, 'ModalThumb'));
                                    $image_sizes = esc_attr(wp_get_attachment_image_sizes($attachment_id, 'ModalThumb'));
                            ?>
                                    <div class="qty-slide">
                                        <img class="img-responsive" src="<?php echo $image_url ?>" srcset="<?php echo $image_srcset ?>" sizes="<?php echo $image_sizes ?>" alt="">
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <?php if ($gallery_av) { ?>
                            <div class="qty-nav-thumb">
                                <?php
                                foreach ($attachment_ids as $attachment_id) {
                                    $image_url = esc_url(wp_get_attachment_image_url($attachment_id, 'ModalSliderThumb'));
                                ?>
                                    <div class="qty-slide">
                                        <img class="img-responsive" src="<?php echo $image_url ?>" alt="">
                                    </div>
                                <?php } ?>

                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="quickview-pro-content">
                            <h5 class="ec-quick-title">
                                <a href="<?php echo $permalink ?>"><?php echo $title ?></a>
                            </h5>
                            <div class="ec-quickview-rating">
                                <?php
                                $rating_count = 1;
                                $rating_HTML = '';
                                $review_count_HTML = '<span>(' . $review_count . ')</span>';
                                while ($rating_count <= 5) {
                                    if ($rating_count < $average_rating) {
                                        $rating_HTML .= '<i class="ecicon eci-star fill"></i>';
                                    } else {
                                        $rating_HTML .= '<i class="ecicon eci-star"></i>';
                                    }
                                    $rating_count++;
                                }
                                echo $rating_HTML . $review_count_HTML;
                                ?>
                            </div>

                            <div class="ec-quickview-desc"><?php echo $short_description ?></div>
                            <div class="ec-quickview-price">
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
                            </div>

                            <div class="ec-pro-variation">

                                <?php if ($colors) : ?>
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>Couleur</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <?php foreach ($colors as $color) { ?>
                                                    <li><span style="background-color:<?php echo key($color); ?>;"></span></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($sizes) : ?>
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <span>Taille</span>
                                        <div class="ec-pro-variation-content">
                                            <ul class="ec-opt-size">
                                                <?php
                                                $sizecount = 1;
                                                foreach ($sizes as $size) {
                                                    $size_label = strtoupper(key($size));
                                                    $size_liClass = ($sizecount == 1) ? ' class="active"' : '';
                                                    printf(
                                                        '<li %s>
                                                            <a href="#" class="ec-opt-sz" data-tooltip="Small">%s</a>
                                                        </li>',
                                                        $size_liClass,
                                                        $size_label
                                                    );
                                                    $sizecount++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="ec-quickview-qty">

                                <?php if (!$variations) : ?>
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                <?php endif; ?>

                                <div class="ec-quickview-cart">
                                    <?php
                                    echo sprintf(
                                        '<button class="btn btn-primary modal-add-to-cart" %s data-type="%s">
                                            <i class="fi-rr-shopping-basket"></i>Add To Cart 
                                         </button>',
                                        $addToCart_attr,
                                        $product_type
                                    );
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
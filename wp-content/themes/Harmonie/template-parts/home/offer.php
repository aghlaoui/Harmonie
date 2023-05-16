<?php $id = $args['ID'] ?>
<?php if (have_rows('hp_offer_section', $id) && get_field('activate_hp_offer_section', $id)) : ?>
    <?php while (have_rows('hp_offer_section', $id)) : the_row() ?>
        <?php
        $title = sanitize_text_field(get_sub_field('title'));
        $subtitle = sanitize_text_field(get_sub_field('subtitle'));
        $desciption = sanitize_textarea_field(get_sub_field('description'));
        $price = get_sub_field('price') . ' ' . get_woocommerce_currency_symbol();
        $background_image = esc_url(get_sub_field('background_image')['url']);
        $product_image = esc_url(get_sub_field('product_image')['sizes']['offreSecProduct']);
        $permalink = esc_url(get_permalink(get_sub_field('hp_offer_selectProduct')));
        ?>
        <section class="section ec-offer-section section-space-p section-space-m" style="background-image: url(<?php echo $background_image ?>);">
            <h2 class="d-none">Offer</h2>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center ec-offer-content">
                        <h2 class="ec-offer-title"><?php echo $title ?></h2>
                        <h3 class="ec-offer-stitle" data-animation="slideInDown"><?php echo $subtitle ?></h3>
                        <span class="ec-offer-img" data-animation="zoomIn">
                            <img src="<?php echo $product_image ?>" alt="offer image" /></span>
                        <span class="ec-offer-desc"><?php echo $desciption ?></span>
                        <span class="ec-offer-price"><?php echo $price ?> Seulement</span>
                        <a class="btn btn-primary" href="<?php echo $permalink ?>" data-animation="zoomIn">Acheter</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
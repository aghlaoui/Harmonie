<?php
$id = $args['ID'];
?>
<?php if (have_rows('slider', $id) && get_field('activate_carrousel', $id)) : ?>
    <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">

                <?php while (have_rows('slider', $id)) : the_row() ?>
                    <?php
                    $title = sanitize_text_field(get_sub_field('title'));
                    $subtitle = sanitize_text_field(get_sub_field('subtitle'));
                    $description = sanitize_text_field(get_sub_field('description'));
                    $image = esc_url(get_sub_field('image')['url']);
                    $urlId = get_sub_field('home_slider_product');
                    $url = esc_url(get_permalink($urlId));
                    ?>
                    <div class="ec-slide-item swiper-slide d-flex ec-slide-1" style="background-image: url('<?php echo $image ?>')">
                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                    <div class="ec-slide-content slider-animation">
                                        <h1 class="ec-slide-title"><?php echo $title ?></h1>
                                        <h2 class="ec-slide-stitle"><?php echo $subtitle ?></h2>
                                        <p><?php echo $description ?></p>
                                        <a href="<?php echo $url ?>" class="btn btn-lg btn-secondary">Commander</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
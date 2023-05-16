<?php $id = $args['ID']; ?>
<?php if (have_rows('banner', $id) && get_field('activate_banner', $id)) : ?>
    <section class="ec-banner section section-space-p">
        <h2 class="d-none">Banner</h2>
        <div class="container">
            <!-- ec Banners Start -->
            <div class="ec-banner-inner">
                <!--ec Banner Start -->
                <div class="ec-banner-block ec-banner-block-2">
                    <div class="row">

                        <?php while (have_rows('banner', $id)) : the_row() ?>
                            <?php
                            $init_title = sanitize_text_field(get_sub_field('title'));
                            $title = str_replace(',', '<br>', $init_title);
                            $sub_title = sanitize_text_field(get_sub_field('subtitle'));
                            $desciption = sanitize_text_field(get_sub_field('description'));
                            $image = esc_url(get_sub_field('image')['sizes']['aboutUsImg']);
                            $cat_id = get_sub_field('hbs_category');
                            $url = get_category_link($cat_id);
                            ?>
                            <div class="banner-block col-lg-6 col-md-12 margin-b-30" data-animation="slideInRight">
                                <div class="bnr-overlay">
                                    <img src="<?php echo $image ?>" alt="" />
                                    <div class="banner-text">
                                        <span class="ec-banner-stitle"><?php echo $sub_title ?></span>
                                        <span class="ec-banner-title"><?php echo $title ?></span>
                                        <span class="ec-banner-discount"><?php echo $desciption ?></span>
                                    </div>
                                    <div class="banner-content">
                                        <span class="ec-banner-btn"><a href="<?php echo $url ?>">Commander</a></span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    </div>
                    <!-- ec Banner End -->
                </div>
                <!-- ec Banners End -->
            </div>
        </div>
    </section>
<?php endif; ?>
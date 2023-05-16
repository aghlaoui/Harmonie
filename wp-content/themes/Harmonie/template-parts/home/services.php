<?php
$id = $args['ID'];
$aboutUs_id = $args['aboutUsID'];
?>
<?php if (have_rows('services_box', $aboutUs_id) && get_field('hp_services_act', $id)) : ?>

    <section class="section ec-services-section section-space-p" id="services">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                <?php while (have_rows('services_box', $aboutUs_id)) : the_row() ?>
                    <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                        <?php
                        $icon = sanitize_text_field(get_sub_field('icon'));
                        $title = sanitize_text_field(get_sub_field('title'));
                        $description = sanitize_text_field(get_sub_field('description'));
                        ?>
                        <div class="ec_ser_inner">
                            <div class="ec-service-image">
                                <i class="<?php echo $icon ?>"></i>
                            </div>
                            <div class="ec-service-desc">
                                <h2><?php echo $title ?></h2>
                                <p><?php echo $description ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
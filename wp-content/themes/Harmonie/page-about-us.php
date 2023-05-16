<?php get_header() ?>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Qui sommes-nous ?</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Qui sommes-nous ?</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec About Us page -->
<?php
$id = get_the_ID();
$title = sanitize_text_field(get_the_title());
$subheading = sanitize_text_field(get_field('subheading', $id));
$description = get_field('description', $id);
$description_title = sanitize_text_field($description['title']);
$image = esc_url(get_the_post_thumbnail_url($id, 'aboutUsImg'));
?>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title"><?php echo $title ?></h2>
                    <h2 class="ec-title"><?php echo $title ?></h2>
                    <p class="sub-title mb-3"><?php echo $subheading ?></p>
                </div>
            </div>
            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-6 ec-cms-block ec-abcms-block text-center">
                        <div class="ec-cms-block-inner">
                            <img class="a-img" src="<?php echo $image ?>" alt="about">
                        </div>
                    </div>

                    <div class="col-md-6 ec-cms-block ec-abcms-block text-center">
                        <div class="ec-cms-block-inner">
                            <h3 class="ec-cms-block-title"><?php echo $description_title ?></h3>
                            <?php while (have_rows('description', $id)) : the_row() ?>
                                <?php while (have_rows('p_description')) : the_row() ?>
                                    <p><?php echo sanitize_textarea_field(get_sub_field('paragraphs')) ?></p>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--  services Section Start -->
<?php if (get_field('sercies_activate', $id) || have_rows('services_box', $id)) : ?>

    <section class="section ec-services-section section-space-p" id="services">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                <?php while (have_rows('services_box', $id)) : the_row() ?>
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
<!--services Section End -->

<?php get_footer() ?>
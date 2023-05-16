<?php
get_header()
?>

<?php while (have_posts()) : the_post() ?>
    <?php $id = get_the_ID() ?>
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title"><?php echo esc_html(get_the_title()) ?></h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                                <li class="ec-breadcrumb-item active"><?php echo esc_html(get_the_title()) ?></li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->
    <section class="ec-page-content section-space-p terms_condition_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title"><?php echo sanitize_text_field(get_the_title()); ?></h2>
                        <h2 class="ec-title"><?php echo sanitize_text_field(get_the_title()); ?></h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <?php while (have_rows('pp_paragraph', $id)) : the_row() ?>
                            <div class="col-sm-12 ec-cms-block">
                                <div class="ec-cms-block-inner">
                                    <h3 class="ec-cms-block-title"><?php echo sanitize_text_field(get_sub_field('title')) ?></h3>
                                    <p><?php echo sanitize_textarea_field(get_sub_field('paragraph')) ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>
<?php get_footer() ?>
<?php get_header() ?>

<?php while (have_posts()) : the_post() ?>

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
                        <!-- <p class="sub-title mb-3">Welcome to the ekka multivendor marketplace</p> -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <?php echo the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>
<?php get_footer() ?>
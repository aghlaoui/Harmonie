<?php

use Automattic\Jetpack\Redirect;

if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('login')));
}
get_header();
?>

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Wishlist</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Wishlist</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Ec Wishlist page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <!-- Compare Content Start -->
            <div class="ec-wish-rightside col-lg-12 col-md-12">
                <!-- Compare content Start -->
                <div class="ec-compare-content">
                    <div class="ec-compare-inner">
                        <div class="row margin-minus-b-30">

                            <?php
                            // Getting Post Ids For Wishlist To The Current User
                            $wishlist = new WP_Query(array(
                                'post_type' => 'wishlist',
                                'posts_per_page' => -1,
                                'author' => get_current_user_id(),
                            ));
                            $product_ids = array();
                            while ($wishlist->have_posts()) {
                                $wishlist->the_post();
                                $id = get_the_ID();
                                $product_ids[] = get_field('product_id', $id);
                            }
                            wp_reset_postdata();

                            // Getting The Products For The Current User
                            if ($wishlist->found_posts > 0) {
                                $count = 1;
                                $products = new WP_Query(array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1,
                                    'post__in' => $product_ids
                                ));

                                while ($products->have_posts()) {
                                    $products->the_post();

                                    require get_theme_file_path('template-parts/shop/product/products-variables.php');
                                    $quickView = true;
                                    $paginationAv = true;
                                    $box_type = 'single';

                                    require get_theme_file_path('template-parts/shop/product/product-box.php');

                                    require get_theme_file_path('template-parts/shop/product/product-modal.php');

                                    $count++;
                                }
                                wp_reset_postdata();
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <!--compare content End -->
                <?php
                if ($wishlist->found_posts <= 0) {
                    echo '<div class="ec-wish-rightside col-lg-12 col-md-12"><p class="emp-wishlist-msg">Votre wishlist est vide !</p></div>';
                }
                ?>
            </div>
            <!-- Compare Content end -->
        </div>
    </div>
</section>

<?php get_footer() ?>
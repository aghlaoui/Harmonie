<div class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <!-- Header Top social Start -->
            <?php if (have_rows('sm_media', 'option')) : ?>
                <div class="col text-left header-top-left d-none d-lg-block">
                    <div class="header-top-social">
                        <span class="social-text text-upper">Follow us on:</span>
                        <ul class="mb-0">
                            <?php
                            while (have_rows('sm_media', 'option')) {
                                the_row();
                                $icon = sanitize_text_field(get_sub_field('plateforme'));
                                $url = esc_url(get_sub_field('link'));
                                printf(
                                    '<li class="list-inline-item">
                                        <a class="hdr-%s" href="%s" >
                                            <i class="ecicon eci-%s"></i>
                                        </a>
                                    </li>',
                                    $icon,
                                    $url,
                                    $icon
                                );
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Header Top social End -->
            <!-- Header Top Message Start -->
            <div class="col text-center header-top-center">
                <div class="header-top-message text-upper">
                    <?php echo sanitize_text_field(get_theme_mod('header_message')) ?>
                </div>
            </div>
            <!-- Header Top Message End -->

            <!-- Header Top responsive Action -->
            <div class="col d-lg-none ">
                <div class="ec-header-bottons">
                    <!-- Header User Start -->
                    <div class="ec-header-user dropdown">
                        <button class="dropdown-toggle" data-bs-toggle="dropdown" aria-label="user"><i class="fi-rr-user"></i></button>
                        <?php if (!is_user_logged_in()) : ?>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="<?php echo esc_url(wp_registration_url()) ?>">Register</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url(site_url('checkout')) ?>">Checkout</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url(wp_login_url()) ?>">Login</a></li>
                            </ul>
                        <?php else : ?>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="<?php echo esc_url(site_url('my-account')) ?>">Compte</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url(site_url('checkout')) ?>">Checkout</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url(wp_logout_url()) ?>">Logout</a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <!-- Header User End -->
                    <!-- Header Cart Start -->
                    <a href="<?php echo esc_url(site_url('wishlist')) ?>" class="ec-header-btn ec-header-wishlist">
                        <div class="header-icon"><i class="fi-rr-heart"></i></div>
                        <?php
                        if (is_user_logged_in()) {
                            $wishlist_query = new WP_Query(array(
                                'post_type' => 'wishlist',
                                'author' => get_current_user_id()
                            ));
                            $wishlist_count = $wishlist_query->found_posts;
                        } else {
                            $wishlist_count = 0;
                        }
                        ?>
                        <span class="ec-header-count"><?php echo $wishlist_count ?></span>
                    </a>
                    <!-- Header Cart End -->
                    <!-- Header Cart Start -->
                    <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                        <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                        <span class="ec-header-count cart-count-lable"><?php echo count(WC()->cart->get_cart()) ?></span>
                    </a>
                    <!-- Header Cart End -->
                    <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                        <i class="fi fi-rr-apps"></i>
                    </a>
                    <!-- Header menu Start -->
                    <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                        <i class="fi fi-rr-menu-burger"></i>
                    </a>
                    <!-- Header menu End -->
                </div>
            </div>
            <!-- Header Top responsive Action -->
        </div>
    </div>
</div>
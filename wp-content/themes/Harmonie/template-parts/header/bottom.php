<div class="ec-header-bottom d-none d-lg-block">
    <div class="container position-relative">
        <div class="row">
            <div class="ec-flex">
                <!-- Ec Header Logo Start -->
                <div class="align-self-center">
                    <div class="header-logo">
                        <?php $logo = (is_ssl()) ? str_replace('http://', 'https://', esc_url(get_theme_mod('site_logo'))) : esc_url(get_theme_mod('site_logo')) ?>
                        <a href="<?php echo esc_url(home_url()) ?>"><img src="<?php echo $logo ?>" alt="Site Logo" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->

                <!-- Ec Header Search Start -->
                <div class="align-self-center">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="<?php echo esc_url(site_url('/')) ?>">
                            <input class="form-control ec-search-bar" placeholder="Rechercher des produits..." type="text" name="s">
                            <button class="submit" type="submit" aria-label="Search"><i class="fi-rr-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->

                <!-- Ec Header Button Start -->
                <div class="align-self-center">
                    <div class="ec-header-bottons">

                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown" aria-label="user"><i class="fi-rr-user"></i></button>
                            <?php if (!is_user_logged_in()) : ?>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="<?php echo esc_url(site_url('register')) ?>">Register</a></li>
                                    <li><a class="dropdown-item" href="<?php echo esc_url(site_url('checkout')) ?>">Checkout</a></li>
                                    <li><a class="dropdown-item" href="<?php echo esc_url(site_url('login')) ?>">Login</a></li>
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
                        <!-- Header wishlist Start -->
                        <a href="<?php echo esc_url(site_url('wishlist')) ?>" class="ec-header-btn ec-header-wishlist">
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
                            <div class="header-icon"><i class="fi-rr-heart"></i></div>
                            <span class="ec-header-count"><?php echo $wishlist_count ?></span>
                        </a>
                        <!-- Header wishlist End -->
                        <!-- Header Cart Start -->
                        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                            <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                            <span class="ec-header-count cart-count-lable"><?php echo count(WC()->cart->get_cart()) ?></span>
                        </a>
                        <!-- Header Cart End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
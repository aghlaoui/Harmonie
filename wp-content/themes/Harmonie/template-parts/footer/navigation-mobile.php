<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i class="fi-rr-menu-burger"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle">
                    <i class="fi-rr-shopping-bag"></i>
                    <span class="ec-cart-noti ec-header-count cart-count-lable"><?php echo count(WC()->cart->get_cart()) ?></span>
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="<?php echo esc_url(home_url()) ?>" class="ec-header-btn"><i class="fi-rr-home"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="<?php echo esc_url(site_url('wishlist')) ?>" class="ec-header-btn">
                    <i class="fi-rr-heart"></i>
                    <span class="ec-cart-noti wishlist-res">
                        <?php // wishlist get number product
                        if (is_user_logged_in()) {
                            $wishlist_query = new WP_Query(array(
                                'post_type' => 'wishlist',
                                'author' => get_current_user_id()
                            ));
                            echo $wishlist_count = $wishlist_query->found_posts;
                        } else {
                            echo 0;
                        }
                        ?>
                    </span>
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="<?php echo esc_url(site_url('login')) ?>" class="ec-header-btn"><i class="fi-rr-user"></i></a>
            </div>

        </div>
    </div>
</div>
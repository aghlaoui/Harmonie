<div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
    <div class="ec-menu-title">
        <span class="menu_title">My Menu</span>
        <button class="ec-close">×</button>
    </div>
    <div class="ec-menu-inner">
        <div class="ec-menu-content">
            <ul>
                <li><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                <li>
                    <a href="javascript:void(0)">Vêtements</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:void(0)">Vêtements Femme</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(39) ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Vêtements Homme</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(38) ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Chaussures Femme</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(55) ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Chaussures Homme</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(56) ?>
                            </ul>
                        </li>

                        <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img class="img-responsive" src="<?php echo get_theme_file_uri('/src/images/menu-banner/1.jpg') ?>" alt=""></a>
                        </li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Consoles</a>
                    <ul class="sub-menu">
                        <?php formatted_navbar_list(50) ?>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Téléphones</a>
                    <ul class="sub-menu">
                        <?php formatted_navbar_list(46) ?>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo esc_url(site_url('shop')) ?>">Shop</a></li>
                        <li><a href="<?php echo esc_url(site_url('login')) ?>">Connection</a></li>
                        <li><a href="<?php echo esc_url(site_url('register')) ?>">Inscription</a></li>
                        <li><a href="<?php echo esc_url(site_url('about-us')) ?>">Qui Somme Nous</a></li>
                        <li><a href="<?php echo esc_url(site_url('cart')) ?>">Cart</a></li>
                        <li><a href="<?php echo esc_url(site_url('my-account')) ?>">Mon Compte</a></li>
                        <li><a href="<?php echo esc_url(site_url('contact-us')) ?>">Contacter Nous</a></li>
                        <li><a href="<?php echo esc_url(site_url('faq')) ?>">FAQ</a></li>
                        <li><a href="<?php echo esc_url(site_url('privacy-policy')) ?>">Privacy Policy</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="header-res-lan-curr">
            <!-- Social Start -->
            <div class="header-res-social">
                <div class="header-top-social">
                    <ul class="mb-0">
                        <?php
                        while (have_rows('sm_media', 'option')) {
                            the_row();
                            $icon = sanitize_text_field(get_sub_field('plateforme'));
                            $url = esc_url(get_sub_field('link'));
                            printf(
                                '<li class="list-inline-item">
                                        <a class="hdr-%s" href="%s">
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
            <!-- Social End -->
        </div>
    </div>
</div>
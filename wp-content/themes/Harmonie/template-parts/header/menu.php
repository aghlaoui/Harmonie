<div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
    <div class="container position-relative">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <div class="ec-main-menu">
                    <ul>
                        <li <?php echo (is_home()) ? 'class="active"' : '' ?>><a href="<?php echo esc_url(home_url()) ?>">Accueil</a></li>
                        <li class="dropdown position-static"><a href="javascript:void(0)">Vêtements</a>
                            <ul class="mega-menu d-block">
                                <li class="d-flex">
                                    <ul class="d-block">
                                        <li class="menu_title"><a href="javascript:void(0)">Vêtements Femme</a></li>
                                        <?php formatted_navbar_list(39) ?>
                                    </ul>
                                    <ul class="d-block">
                                        <li class="menu_title"><a href="javascript:void(0)">Vêtements Homme</a></li>
                                        <?php formatted_navbar_list(38) ?>
                                    </ul>
                                    <ul class="d-block">
                                        <li class="menu_title"><a href="javascript:void(0)">Chaussures Femme</a></li>
                                        <?php formatted_navbar_list(55) ?>
                                    </ul>
                                    <ul class="d-block">
                                        <li class="menu_title"><a href="javascript:void(0)">Chaussures Homme</a></li>
                                        <?php formatted_navbar_list(56) ?>
                                    </ul>
                                </li>

                                <?php if (have_rows('m_banners', 'options')) : ?>

                                    <li>
                                        <ul class="ec-main-banner w-100">
                                            <?php
                                            while (have_rows('m_banners', 'options')) {
                                                the_row();
                                                $image = esc_url(get_sub_field('banner_img')['sizes']['menuBanner']);
                                                $url = esc_url(get_permalink(get_sub_field('mb_product')));

                                                printf(
                                                    '<li>
                                                        <a class="p-0" href="%s">
                                                            <img class="img-responsive" src="%s" alt="">
                                                         </a>
                                                    </li>',
                                                    $url,
                                                    $image
                                                );
                                            }
                                            ?>
                                        </ul>
                                    </li>

                                <?php endif; ?>

                            </ul>
                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">Consoles</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(50) ?>

                            </ul>
                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">Téléphones</a>
                            <ul class="sub-menu">
                                <?php formatted_navbar_list(46) ?>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="javascript:void(0)">Pages</a>
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
            </div>
        </div>
    </div>
</div>
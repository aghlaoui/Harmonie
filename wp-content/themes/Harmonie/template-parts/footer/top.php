<div class="footer-top section-space-footer-p">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-3 ec-footer-contact">
                <div class="ec-footer-widget">
                    <div class="ec-footer-logo">
                        <a href="#">
                            <?php $logo = (is_ssl()) ? str_replace('http://', 'https://', esc_url(get_theme_mod('site_logo'))) : esc_url(get_theme_mod('site_logo')) ?>
                            <img src="<?php echo $logo ?>" alt="">
                            <img class="dark-footer-logo" src="<?php echo $logo ?>" alt="Site Logo" style="display: none;" />
                        </a>
                    </div>
                    <h4 class="ec-footer-heading">Contactez nous:</h4>
                    <div class="ec-footer-links">
                        <ul class="align-items-center">
                            <li class="ec-footer-link">
                                <?php
                                $adress = sanitize_text_field(get_theme_mod('office_adress'));
                                echo str_replace(',', ',<br>', $adress);
                                ?>
                            </li>
                            <li class="ec-footer-link">
                                <span>Appelez-nous :</span>
                                <a href="<?php echo sanitize_text_field(get_theme_mod('phone_number')) ?>"><?php echo sanitize_text_field(get_theme_mod('phone_number')) ?></a>
                            </li>
                            <li class="ec-footer-link">
                                <span>Email:</span>
                                <a href="<?php echo sanitize_text_field(get_theme_mod('email_adress')) ?>"><?php echo sanitize_text_field(get_theme_mod('email_adress')) ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2 ec-footer-info">
                <div class="ec-footer-widget">
                    <h4 class="ec-footer-heading">Informations</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_left',
                            'menu_class' => 'align-items-center',
                            'container_class' => 'ec-footer-links',
                            'add_li_class' => 'ec-footer-link'
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2 ec-footer-account">
                <div class="ec-footer-widget">
                    <h4 class="ec-footer-heading">Compte</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_middle',
                            'menu_class' => 'align-items-center',
                            'container_class' => 'ec-footer-links',
                            'add_li_class' => 'ec-footer-link'
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2 ec-footer-service">
                <div class="ec-footer-widget">
                    <h4 class="ec-footer-heading">Liens</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_right',
                            'menu_class' => 'align-items-center',
                            'container_class' => 'ec-footer-links',
                            'add_li_class' => 'ec-footer-link'
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 ec-footer-news">
                <div class="ec-footer-widget">
                    <h4 class="ec-footer-heading">Newsletter</h4>
                    <div class="ec-footer-links">
                        <ul class="align-items-center">
                            <li class="ec-footer-link">Recevez des mises à jour instantanées sur nos nouveaux produits et nos promotions spéciales !</li>
                        </ul>
                        <div class="ec-subscribe-form">
                            <?php
                            global $wp;
                            echo do_shortcode('[newsletter_form form="1" confirmation_url="' . home_url($wp->request) . '"]');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
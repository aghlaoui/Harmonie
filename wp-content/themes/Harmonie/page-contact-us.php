<?php
/*
Template Name: Contact Us
*/
get_header();
?>
<?php
$mapUrl = (get_field('map_url', get_the_ID())) ? esc_url(get_field('map_url', get_the_ID())) : '';
?>
<!-- Ec Contact Us page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-common-wrapper">
                <div class="ec-contact-leftside">
                    <div class="ec-contact-container">
                        <div class="ec-contact-form">
                            <?php echo do_shortcode('[contact-form-7 id="321" title="contact us form"]') ?>
                        </div>
                    </div>
                </div>
                <div class="ec-contact-rightside">
                    <div class="ec_contact_map">
                        <div class="ec_map_canvas">
                            <?php if (!empty($mapUrl)) : ?>
                                <iframe id="ec_map_canvas" src="<?php echo $mapUrl ?>"></iframe>
                                <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                            <?php else : ?>
                                <img src="https://placehold.jp/8a8a8a/ffffff/708x430.jpg?text=Pas%20de%20localisation%20disponible%20&css=%7B%22border-radius%22%3A%225px%22%7D" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ec_contact_info">
                        <h1 class="ec_contact_info_head">Contactez nous</h1>
                        <ul class="align-items-center">
                            <li class="ec-contact-item">
                                <i class="ecicon eci-map-marker" aria-hidden="true"></i>
                                <span>Address : </span>
                                <?php
                                $adress = sanitize_text_field(get_theme_mod('office_adress'));
                                echo str_replace(',', ',<br>', $adress);
                                ?>
                            </li>

                            <li class="ec-contact-item align-items-center">
                                <i class="ecicon eci-phone" aria-hidden="true"></i>
                                <span>Tel :</span>
                                <a href="<?php echo sanitize_text_field(get_theme_mod('phone_number')) ?>"><?php echo sanitize_text_field(get_theme_mod('phone_number')) ?></a>
                            </li>

                            <li class="ec-contact-item align-items-center">
                                <i class="ecicon eci-envelope" aria-hidden="true"></i>
                                <span>Email:</span>
                                <a href="<?php echo sanitize_text_field(get_theme_mod('email_adress')) ?>"><?php echo sanitize_text_field(get_theme_mod('email_adress')) ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <img src="" alt="">
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>
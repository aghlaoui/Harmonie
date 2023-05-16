<div class="footer-bottom">
    <div class="container">
        <div class="row align-items-center">
            <!-- Footer social Start -->
            <?php if (have_rows('sm_media', 'options')) : ?>
                <div class="col text-left footer-bottom-left">
                    <div class="footer-bottom-social">
                        <span class="social-text text-upper">Follow us on:</span>
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
            <?php endif; ?>
            <!-- Footer social End -->
            <!-- Footer Copyright Start -->
            <div class="col text-center footer-copy">
                <div class="footer-bottom-copy ">
                    <div class="ec-copy">
                        <?php
                        $sitename = esc_html(get_bloginfo('name'));
                        $year = date('Y');
                        $url = esc_url(home_url());

                        printf(
                            'Copyright © %d 
                            <a class="site-name text-upper" href="%s">%s
                                <span>.</span>
                            </a>. 
                             All Rights Reserved',
                            $year,
                            $url,
                            $sitename
                        );
                        ?>
                    </div>
                </div>
            </div>
            <!-- Footer Copyright End -->
            <!-- Footer payment -->
            <div class="col footer-bottom-right">
                <div class="footer-bottom-payment d-flex justify-content-end">
                    <div class="payment-link">
                        <?php $pay_img = esc_url(get_field('method_payment', 'option')); ?>
                        <img src="<?php echo $pay_img ?>" alt="payment">
                    </div>

                </div>
            </div>
            <!-- Footer payment -->
        </div>
    </div>
</div>
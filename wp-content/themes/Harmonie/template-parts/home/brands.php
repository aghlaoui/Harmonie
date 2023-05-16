<?php $id = $args['ID'] ?>
<?php if (have_rows('hp_brand', $id) && get_field('activate_hp_brand_section', $id)) : ?>
    <section class="section ec-brand-area section-space-p">
        <h2 class="d-none">Brand</h2>
        <div class="container">
            <div class="row">
                <div class="ec-brand-outer">
                    <ul id="ec-brand-slider">
                        <?php while (have_rows('hp_brand', $id)) : the_row() ?>
                            <li class="ec-brand-item" data-animation="zoomIn">
                                <div class="ec-brand-img">
                                    <?php
                                    $url = esc_url(get_sub_field('website_url'));
                                    $image = esc_url(get_sub_field('image')['sizes']['brands']);
                                    $html = '<a href="%s"><img alt="brand" title="brand" src="%s" /></a>';
                                    echo sprintf($html, $url, $image);
                                    ?>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
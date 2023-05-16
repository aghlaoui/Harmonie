<?php $id = $args['ID'] ?>
<?php if (get_field('activate_product_sliders', $id)) : ?>
    <section class="section ec-fre-spe-section section-space-p" id="offers">
        <div class="container">
            <div class="row">
                <!--  Feature Section Start -->
                <div class="ec-fre-section col-lg-6 col-md-6 col-sm-6 margin-b-30" data-animation="slideInRight">
                    <div class="col-md-12 text-left">
                        <div class="section-title">
                            <h2 class="ec-bg-title">Articles en vedette</h2>
                            <h2 class="ec-title">Articles en vedette</h2>
                        </div>
                    </div>

                    <div class="ec-fre-products">
                        <?php
                        $coundown_count = 1;
                        $box = 'right_box';
                        require get_theme_file_path('template-parts/home/prod-slider-content.php');
                        ?>
                    </div>
                </div>
                <!--  Feature Section End -->
                <!--  Special Section Start -->
                <div class="ec-spe-section col-lg-6 col-md-6 col-sm-6" data-animation="slideInLeft">
                    <div class="col-md-12 text-left">
                        <div class="section-title">
                            <h2 class="ec-bg-title">Offre à durée limitée</h2>
                            <h2 class="ec-title">Offre à durée limitée</h2>
                        </div>
                    </div>

                    <div class="ec-spe-products">
                        <?php
                        $box = 'left_box';
                        require get_theme_file_path('template-parts/home/prod-slider-content.php');
                        ?>
                    </div>
                </div>
                <!--  Special Section End -->
            </div>
        </div>
    </section>
<?php endif; ?>
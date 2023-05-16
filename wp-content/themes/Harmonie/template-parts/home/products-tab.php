<?php if (get_field('product_tab_act', $args['ID'])) : ?>

    <section class="section ec-product-tab section-space-p" id="collection">
        <div class="container">
            <div class="row">
                <div class="myAlert-top wishlist-alert alert-danger"></div>
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Notre meilleure collection</h2>
                        <h2 class="ec-title">Notre meilleure collection</h2>
                        <p class="sub-title">Parcourir la collection des meilleurs produits</p>
                    </div>
                </div>
                <!-- Tab Start -->
                <div class="col-md-12 text-center">
                    <ul class="ec-pro-tab-nav nav justify-content-center">

                        <?php
                        $parent_id =  get_field('hpt_parent_category', $args['ID']);
                        $child_cats = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'child_of' => $parent_id,
                            'parent' => $parent_id,
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 4,
                        ));
                        $count = 0;
                        ?>
                        <?php foreach ($child_cats as $cat) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($count == 0) ? 'active' : '' ?>" data-bs-toggle="tab" href="#tab-pro-for-<?php echo esc_html($cat->slug) ?>"><?php echo $cat->name ?></a>
                            </li>
                            <?php $count++; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <?php

            ?>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- Product tab start -->
                        <?php
                        $g_count = 0;
                        $count = 1;
                        ?>
                        <?php foreach ($child_cats as $cat) : ?>
                            <div class="tab-pane fade <?php echo ($g_count == 0) ? 'show active' : '' ?>" id="tab-pro-for-<?php echo esc_html($cat->slug) ?>">
                                <div class="row">
                                    <?php
                                    $term_id = $cat->term_id;
                                    $query = new WP_Query(array(
                                        'post_type'      => 'product',
                                        'meta_key' => 'total_sales',
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'posts_per_page' => 6,
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'term_id',
                                                'terms'    => $cat->term_id, // replace with the ID of the category you want to get products from
                                            ),
                                        ),
                                    ));

                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        // Product Box and Modal
                                        require get_theme_file_path('template-parts/shop/product/products-variables.php');
                                        $quickView = true;
                                        $paginationAv = true;
                                        $box_type = 'single';

                                        require get_theme_file_path('template-parts/shop/product/product-box.php');
                                        require get_theme_file_path('template-parts/shop/product/product-modal.php');

                                        $count++;
                                    }
                                    wp_reset_postdata();
                                    ?>


                                    <div class="col-sm-12 shop-all-btn"><a href="<?php echo esc_url(get_category_link($term_id)) ?>">La collection complète</a></div>
                                </div>
                            </div>
                            <?php $g_count++; ?>
                        <?php endforeach; ?>
                        <!-- ec 1st Product tab end -->

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
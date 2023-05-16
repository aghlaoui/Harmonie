<?php $id = $args['ID'] ?>
<?php if (have_rows('cs_category', $id) && get_field('activate_cs_category', $id)) : ?>
    <section class="section ec-category-section section-space-p" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Our Top Collection</h2>
                        <h2 class="ec-title">Top Categories</h2>
                        <p class="sub-title">Browse The Collection of Top Categories</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!--Category Nav Start -->
                <div class="col-lg-3">
                    <ul class="ec-cat-tab-nav nav">

                        <?php $count = 0 ?>
                        <?php while (have_rows('cs_category', $id)) : the_row() ?>
                            <?php
                            $light_icon = esc_url(get_sub_field('icon_light')['sizes']['cartImg']);
                            $dark_icon = esc_url(get_sub_field('icon_dark')['sizes']['cartImg']);
                            $cat_id = get_sub_field('hsc_category');
                            $category = get_term($cat_id);
                            $cat_name = sanitize_text_field($category->name);
                            $product_count = $category->count;
                            ?>
                            <li class="cat-item">
                                <a class="cat-link<?php echo ($count == 0) ? ' active' : '' ?>" data-bs-toggle="tab" href="#tab-cat-<?php echo $cat_id ?>">
                                    <div class="cat-icons">
                                        <img class="cat-icon" src="<?php echo $dark_icon ?>" alt="cat-icon">
                                        <img class="cat-icon-hover" src="<?php echo $light_icon ?>" alt="cat-icon">
                                    </div>
                                    <div class="cat-desc">
                                        <span><?php echo $cat_name ?></span>
                                        <span><?php echo $product_count ?> Produits</span>
                                    </div>
                                </a>
                            </li>
                            <?php $count++; ?>
                        <?php endwhile; ?>

                    </ul>

                </div>
                <!-- Category Nav End -->
                <!--Category Tab Start -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <?php $count = 0 ?>
                        <?php while (have_rows('cs_category', $id)) : the_row() ?>
                            <?php
                            $cat_id = get_sub_field('hsc_category');
                            $back_image = esc_url(get_sub_field('image')['sizes']['homeCatSec']);
                            $url = esc_url(get_category_link($cat_id));
                            ?>
                            <div class="tab-pane fade<?php echo ($count == 0) ? ' show active' : '' ?>" id="tab-cat-<?php echo $cat_id ?>">
                                <div class="row">
                                    <img src="<?php echo $back_image ?>" alt="" />
                                </div>
                                <span class="panel-overlay">
                                    <a href="<?php echo $url ?>" class="btn btn-primary">Voir tout</a>
                                </span>
                            </div>
                            <?php $count++; ?>
                        <?php endwhile; ?>

                    </div>
                    <!-- Category Tab End -->
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
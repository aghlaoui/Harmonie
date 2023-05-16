<div id="shop_sidebar">
    <?php $categories = harmonie_store_category_lists(); ?>
    <div class="ec-sidebar-heading">
        <h1>Filter Products By</h1>
    </div>
    <div class="ec-sidebar-wrap">
        <!-- Sidebar Category Block -->
        <?php if (is_shop()) : ?>
            <div class="ec-sidebar-block">
                <div class="ec-sb-title">
                    <h3 class="ec-sidebar-title">Category</h3>
                </div>
                <div class="ec-sb-block-content">
                    <ul>
                        <li>
                            <div class="ec-sidebar-block-item item-category">
                                <input id="0" type="checkbox" checked />
                                <a data-id="" href="#!">All</a>
                                <span class="checked"></span>
                            </div>
                        </li>
                        <?php foreach ($categories as $category) {
                            if ($category->category_parent == 0) {
                        ?>
                                <li>
                                    <div class="ec-sidebar-block-item item-category">
                                        <input id="<?php echo $category->term_id; ?>" type="checkbox" />
                                        <a data-id="<?php echo $category->term_id; ?>" href="#!"><?php echo $category->name ?></a>
                                        <span class="checked"></span>
                                    </div>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <!-- Sidebar Size Block -->
        <div class="ec-sidebar-block">
            <div class="ec-sb-title">
                <h3 class="ec-sidebar-title">Size</h3>
            </div>
            <div class="ec-sb-block-content">
                <ul>
                    <?php
                    $size_terms = get_terms("pa_size");

                    foreach ($size_terms as $size) {
                    ?>
                        <li>
                            <div id="0" class="ec-sidebar-block-item item-size">
                                <input id="<?php echo $size->term_id ?>" type="checkbox" />
                                <a data-sid="<?php echo $size->term_id ?>" href="#!"><?php echo $size->name ?></a>
                                <span class="checked"></span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- Sidebar Color item -->
        <div class="ec-sidebar-block ec-sidebar-block-clr">
            <div class="ec-sb-title">
                <h3 class="ec-sidebar-title">Color</h3>
            </div>
            <div class="ec-sb-block-content">
                <ul>
                    <?php $color_terms =  get_terms('pa_color'); ?>
                    <?php foreach ($color_terms as $term) : ?>
                        <li>
                            <div class="ec-sidebar-block-item item-color">
                                <span data-colorID="<?php echo esc_html($term->term_id) ?>" style="background-color:<?php echo esc_html($term->name) ?>;"></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Sidebar Price Block -->
        <div class="ec-sidebar-block">
            <div class="ec-sb-title">
                <h3 class="ec-sidebar-title">Price</h3>
            </div>
            <div class="ec-sb-block-content es-price-slider">
                <div class="ec-price-filter">
                    <div id="ec-sliderPrice" class="filter__slider-price" data-min="0" data-max="250" data-step="10"></div>
                    <div class="ec-price-input">
                        <label class="filter__label min-price">
                            <input data-min="" data-max="" type="text" id="filter-price-min" class="filter__input ec-price-input__min">
                        </label>
                        <span class="ec-price-divider"></span>
                        <label class="filter__label max-price">
                            <input type="text" class="filter__input ec-price-input__max" id="filter-price-max">
                        </label>
                        <button class="btn btn-primary btn-jelly filter-btn">
                            <i class="fi fi-rr-search"></i> <!-- Replace this with the class of the search icon you want to use -->
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
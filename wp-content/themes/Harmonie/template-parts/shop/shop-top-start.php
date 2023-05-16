<?php
require get_theme_file_path('inc/woo_functions/products-filter-by.php');
?>
<div class="ec-pro-list-top d-flex">
    <div class="col-md-6 ec-grid-list">
        <div class="ec-gl-btn">
            <button class="btn btn-grid active"><i class="fi-rr-apps"></i></button>
            <button class="btn btn-list"><i class="fi-rr-list"></i></button>
        </div>
    </div>
    <!-- Add those style to the form of select sorting = display: inherit; width: 100%; -->
    <div class="col-md-6 ec-sort-select">
        <?php
        wc_get_template(
            'loop/orderby.php',
            array(
                'catalog_orderby_options' => $catalog_orderby_options,
                'orderby'                 => $orderby,
                'show_default_orderby'    => $show_default_orderby,
            )
        );
        ?>
    </div>
</div>
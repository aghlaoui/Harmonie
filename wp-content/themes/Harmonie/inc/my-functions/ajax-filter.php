<?php

function filter_projects()
{

    $catID = (!empty($_POST['id'])) ? filter_var($_POST['id']) : '';
    $sizeID = (!empty($_POST['sizeid'])) ? filter_var($_POST['sizeid']) : '';
    $colorID = (!empty($_POST['colorid'])) ? filter_var($_POST['colorid']) : '';
    $minprice = (!empty($_POST['pricemin'])) ? filter_var($_POST['pricemin']) : '';
    $maxprice = (!empty($_POST['pricemax'])) ? filter_var($_POST['pricemax']) : '';
    $tax_query = array();
    $meta_query = array();

    $search_term = (!empty($_POST['search'])) ? filter_var($_POST['search']) : '';

    if (!empty($catID)) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms' => $catID,
            'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            'type' => 'numeric'
        );
    }
    if (!empty($sizeID)) {
        $tax_query[] = array(
            'taxonomy' => 'pa_size',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms' => $sizeID,
            'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        );
    }
    if (!empty($colorID)) {
        $tax_query[] = array(
            'taxonomy' => 'pa_color',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms' => $colorID,
            'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        );
    }

    if (!empty($minprice) || !empty($maxprice)) {
        $meta_query[] = array(
            array(
                'key'     => '_price',
                'value'   => array($minprice, $maxprice),
                'type'    => 'numeric',
                'compare' => 'BETWEEN',
            )
        );
    }


    $ajaxposts = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        's' => $search_term
    ]);
    $count = 1;
    $totalProducts = $ajaxposts->found_posts;
    $response = '';

    if ($ajaxposts->have_posts() && (!empty($tax_query) || !empty($meta_query))) {
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $quickView = null;
            $paginationAv = false;
            require(get_theme_file_path('template-parts/shop/product/products-variables.php'));

            ob_start();
            require(get_theme_file_path('template-parts/shop/product/product-box.php'));
            require get_theme_file_path('template-parts/shop/product/product-modal.php');
            $response .= ob_get_clean();
            $count++;
        endwhile;
        wp_reset_postdata();
    } else {

        ob_clean();
?>
        <div class="col-12 col-md-6 mx-auto empty-filter">
            <div class="card border-gray p-4">
                <div class="card-body text-center">
                    <span class="fa-stack fa-lg">
                        <i class="fi fi-rr-sad"></i>
                    </span>
                    <h3 style="margin: 0 !important;" class="ec-fw-normal ec-fc card-title mt-4">
                        Il n'y a pas de produit disponible. Changez la sélection du filtre.
                    </h3>
                </div>
            </div>
        </div>
<?php

        $response .= ob_get_clean();
    }
    echo $response;
    exit;
}
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

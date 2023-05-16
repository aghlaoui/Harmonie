<?php

use Automattic\Jetpack\My_Jetpack\Product;

global $wp_query;
$count = 1;
$totalProducts = $wp_query->found_posts;
if (have_posts()) {
    while (have_posts()) {

        the_post();
        require get_theme_file_path('template-parts/shop/product/products-variables.php');
        $quickView = true;
        $paginationAv = true;
        $box_type = 'archive';
?>

        <!-- product box -->
        <?php require get_theme_file_path('template-parts/shop/product/product-box.php') ?>
        <!-- product box -->
        <!-- Modal -->
        <?php require get_theme_file_path('template-parts/shop/product/product-modal.php') ?>
        <!-- Modal end -->
<?php
        $count++;
    }
} else {
    echo '<div class="ec-wish-rightside col-lg-12 col-md-12"><p class="emp-wishlist-msg">Aucun résultat trouvé!</p></div>';
}

?>
<?php
get_header();
$id = get_the_ID();
?>

<!-- Main Slider Start -->
<?php get_template_part('template-parts/home/slider', null, array('ID' => $id)); ?>
<!-- Main Slider End -->

<!-- Product tab Area Start -->
<?php get_template_part('template-parts/home/products-tab', null, array('ID' => $id)); ?>
<!-- ec Product tab Area End -->

<!-- ec Banner Section Start -->
<?php get_template_part('template-parts/home/banner', null, array('ID' => $id)); ?>
<!-- ec Banner Section End -->

<!--  Category Section Start -->
<?php get_template_part('template-parts/home/category', null, array('ID' => $id)); ?>
<!-- Category Section End -->

<!--  Feature & Special Section Start -->
<?php get_template_part('template-parts/home/prod-slider', null, array('ID' => $id)); ?>
<!-- Feature & Special Section End -->

<!--  services Section Start -->
<?php
$about_page = get_page_by_path('about-us');
$aboutUs_id = $about_page->ID;
get_template_part('template-parts/home/services', null, array('aboutUsID' => $aboutUs_id, 'ID' => $id));
?>
<!--services Section End -->

<!--  offer Section Start -->
<?php get_template_part('template-parts/home/offer', null, array('ID' => $id)); ?>
<!-- offer Section End -->

<!-- Ec Brand Section Start -->
<?php get_template_part('template-parts/home/brands', null, array('ID' => $id)); ?>
<!-- Ec Brand Section End -->

<?php get_footer() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <?php wp_head() ?>

</head>

<body>
    <?php
    $home_url = home_url();
    ?>
    <!-- <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> -->

    <!-- Header start  -->
    <header class="ec-header">

        <!--Ec Header Top Start -->
        <?php get_template_part('template-parts/header/top') ?>
        <!-- Ec Header Top  End -->

        <!-- Ec Header Bottom  Start -->
        <?php get_template_part('template-parts/header/bottom') ?>
        <!-- Ec Header Button End -->

        <!-- Header responsive Bottom  Start -->
        <?php get_template_part('template-parts/header/bottom-mobile') ?>
        <!-- Header responsive Bottom  End -->

        <!-- EC Main Menu Start -->
        <?php get_template_part('template-parts/header/menu') ?>
        <!-- Ec Main Menu End -->

        <!-- ekka Mobile Menu Start -->
        <?php get_template_part('template-parts/header/mobile-menu') ?>
        <!-- ekka mobile Menu End -->

    </header>
    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <?php get_template_part('template-parts/header/side-cart') ?>
    <!-- ekka Cart End -->
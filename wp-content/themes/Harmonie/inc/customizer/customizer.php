<?php
add_action('customize_register', 'harmonie_customizer_register');
function harmonie_customizer_register($wp_customize)
{
    /*********************************    Logo Costmizer       ************************************/
    require get_theme_file_path('inc/customizer/logo.php', array('wp_customize' => $wp_customize));

    /*********************************    Header Message       ************************************/
    require get_theme_file_path('inc/customizer/header-msg.php', array('wp_customize' => $wp_customize));

    /*********************************    Site Details       ************************************/
    require get_theme_file_path('inc/customizer/details.php', array('wp_customize' => $wp_customize));

    /*********************************    Footer Offer       ************************************/
    require get_theme_file_path('inc/customizer/footer-offer.php', array('wp_customize' => $wp_customize));
}

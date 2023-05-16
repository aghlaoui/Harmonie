<?php
add_action('acf/init', 'acf_options_creating');
function acf_options_creating()
{
    $parent = acf_add_options_page(array(
        'page_title'    => __('Paramètres généraux du thème'),
        'menu_title'    => __('Paramètres du site'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

<?php

$wp_customize->add_section('footer_offer', array(
    'title' => __('Footer Offer', 'harmonie'),
    'description' => __('Edit The Top Footer Offer', 'harmonie'),
    'priority' => 200
));


$wp_customize->add_setting('offer_text', array(
    'default' => '',
    'type' => 'theme_mod'
));

$wp_customize->add_setting('offer_link', array(
    'default' => '',
    'type' => 'theme_mod'
));


$wp_customize->add_control('offer_text', array(
    'type' => 'textarea',
    'label' => __('Offer Text', 'harmonie'),
    'section' => 'footer_offer',
    'settings' => 'offer_text',
));


$choices = array('' => 'Selectioner Un Produit');

$products = get_posts(array(
    'post_type' => 'product',
    'numberposts' => -1,
    'post_status' => 'publish'
));
foreach ($products as $product) {
    $choices[$product->ID] = $product->post_title;
}

$wp_customize->add_control('offer_link', array(
    'type' => 'select',
    'label' => __('Offer Product', 'harmonie'),
    'section' => 'footer_offer',
    'settings' => 'offer_link',
    'choices' => $choices
));

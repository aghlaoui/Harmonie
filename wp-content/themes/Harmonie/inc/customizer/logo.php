<?php
// logos section

$wp_customize->add_section('site_details', array(
    'title'         => __('Site Details', 'harmonie'),
    'description'   => __('Edit description and logo', 'harmonie'),
    'priority'      => 200
));


$wp_customize->add_setting('site_logo', array(
    'default' => '',
    'type'    => 'theme_mod'
));
$wp_customize->add_setting('site_description', array(
    'default' => '',
    'type'    => 'theme_mod'
));


$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
    'label' => __('logo', 'harmonie'),
    'section' => 'site_details',
    'settings' => 'site_logo',
    'size' => 'siteLogos'
)));
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'site_description', array(
    'label' => __('Site description', 'harmonie'),
    'section' => 'site_details',
    'settings' => 'site_description',
    'type' => 'textarea'
)));

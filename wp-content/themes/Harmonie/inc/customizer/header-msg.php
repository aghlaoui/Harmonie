<?php
// Header Message

$wp_customize->add_section('header_message', array(
    'title'         => __('Header Message', 'harmonie'),
    'description'   => __('Edit The Top Header Message', 'harmonie'),
    'priority'      => 200
));


$wp_customize->add_setting('header_message', array(
    'default' => '',
    'type'    => 'theme_mod'
));


$wp_customize->add_control('header_message', array(
    'type' => 'textarea',
    'label' => __('Header Message', 'harmonie'),
    'section' => 'header_message',
    'settings' => 'header_message',
));

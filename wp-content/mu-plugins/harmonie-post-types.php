<?php
add_action('init', 'harmonie_post_types', 15);

function harmonie_post_types()
{
    register_post_type('wishlist', array(
        'show_in_rest' => true,
        'supports' => array('title'),
        'rewrite' => array('slug' => 'testimonials'),
        'public' => false,
        'show_ui' => false,
        'menu_icon' => 'dashicons-testimonial',
        'labels' => array(
            'name' => 'wishlist',
        ),
    ));
}

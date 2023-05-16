<?php

/**
 * Remove Editor From a Page
 */

function remove_editor_from_specific_page()
{
    global $pagenow;
    $home_page_id = 206;
    $about_us = 301;
    $faq = 535;
    $privacy_policy = 3;
    if (!('post.php' == $pagenow && isset($_GET['post']) && ($about_us == $_GET['post'] || $_GET['post'] == $home_page_id || $_GET['post'] == $faq || $_GET['post'] == $privacy_policy)))
        return;
    remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'remove_editor_from_specific_page');

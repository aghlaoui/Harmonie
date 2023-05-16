<?php
function harmoniePagination()
{
    global $paged; // current page 
    if (empty($paged)) $paged = 1; // paged is empty on the first page 
    global $wp_query;
    $pages = $wp_query->max_num_pages; // number of all pages 

    if (!$pages) $pages = 1;

    if ($pages != 1) {
        echo '<ul class="ec-pro-pagination-inner">';
        if ($paged > 1) echo '<li><a class="previous" href="' . get_pagenum_link($paged - 1) . '"><i class="ecicon eci-angle-left"></i> Previous </a></a></li>';

        for ($page = 1; $page <= $pages; $page++) {
            if ($page == $paged) {
                echo '<li><a href="' . get_pagenum_link($page) . '" class="active">' . $page . '</a></li>';
            } else {
                echo '<li><a href="' . get_pagenum_link($page) . '">' . $page . '</a></li>';
            }
        }

        if ($paged < $pages) echo '<li><a class="next" href="' . get_pagenum_link($paged + 1) . '">Next <i class="ecicon eci-angle-right"></i></a></li>';
        echo '</ul>';
    }
}

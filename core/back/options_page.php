<?php



/**
 * Add the top level menu page.
 */
function tsubaki_options_page() {
    add_menu_page(
        'Dashboard Builder',
        'Dashboard Builder',
        'manage_options',
        'ed',
        'tsubaki_options_page_html'
    );
}

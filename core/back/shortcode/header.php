<?php

if( !function_exists('tsubaki_dashboard_shortcode_enqueue') ) {
    function tsubaki_dashboard_shortcode_enqueue()
    {
        //        global $post;
        //        if (has_shortcode($post->post_content, 'm_shortcode')) {

        //load in footer
        wp_register_script('tsubaki_dashboard_shortcode_js', TSUBAKI_DASHBOARD . '/assets/js/frontend.js', [], 1.0, 1);
        wp_enqueue_script('tsubaki_dashboard_shortcode_js');


        wp_register_style('tsubaki_dashboard_shortcode', TSUBAKI_DASHBOARD . '/assets/css/frontend.css', [], 1.0);
        wp_enqueue_style('tsubaki_dashboard_shortcode');


        //        }
    }

}

<?php
/**
 * Plugin Name: Tsubaki Dashboard builder
 * Plugin URI: https://github.com/Tsubaki-k/tsubaki-dashboard-builder
 * Description: Custom Dashboard builder
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Version: 1.0.0
 * Author: Tsubaki
 * Author URI: https://github.com/Tsubaki-k/tsubaki-dashboard-builder
 **/

define( 'TSUBAKI_DASHBOARD', plugins_url( '', __FILE__ ) );

if (!defined('ABSPATH')) {
    return 'what are you trying to do?';
    exit;
}

require 'core/back/assets_include.php';
require 'core/back/dashboard_settings_init.php';

require 'core/front/woo_account_custom_tabs.php';

require 'core/back/field_tabs_cb.php';
require 'core/back/options_page.php';
require 'core/back/options_page_html.php';
require 'core/back/section_developers_callback.php';

require 'core/back/shortcode/shortcode_handler.php';
require 'core/back/shortcode/shortcode_home_handler.php';

require 'core/back/shortcode/header.php';


add_action( 'admin_head'        , 'custom_admin_css');
add_action( 'admin_footer'      , 'custom_admin_js' );
add_action( 'admin_init'        , 'tsubaki_settings_init');
add_action( 'admin_menu'        , 'tsubaki_options_page' );
add_action( 'wp_enqueue_scripts', 'tsubaki_dashboard_shortcode_enqueue',99 );

// register dashboard
if( !is_admin() ) {
    add_shortcode( 'tsubaki_dashboard_shortcode'     ,  'tsubaki_dashboard_shortcode_handler' );
    add_shortcode( 'tsubaki_dashboard_shortcode_home',  'tsubaki_dashboard_shortcode_home_handler' );
}

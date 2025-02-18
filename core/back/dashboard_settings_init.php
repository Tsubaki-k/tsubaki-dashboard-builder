<?php

/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */
function tsubaki_settings_init() {

    // Register a new setting for "ed" page.
    register_setting( 'ed', 'tsubaki_options', 'tsubaki_validate_options' );

    // Register a new section in the "ed" page.
    add_settings_section(
        'tsubaki_section_developers',
        __( 'Custom Dashboard Tab builder', 'ed' ),
        'tsubaki_section_developers_callback',
        'ed'
    );

    $settings_field = array();

    for( $i = 1; $i <= 50; $i++ ) {
        $settings_field[ 'tab-label-' . $i ]     = 'tab_label' . $i;
        $settings_field[ 'tab-icon-' . $i ]      = 'tab_icon' . $i;
        $settings_field[ 'tab-link-' . $i ]      = 'tab_link' . $i;
        $settings_field[ 'tab-shortcode-' . $i ] = 'tab_shortcode' . $i;
    }


    // Register a new field in the "tsubaki_section_developers" section, inside the "ed" page.
    add_settings_field(
        'tsubaki_field_pill',
        '',
        'tsubaki_field_tabs_cb',
        'ed',
        'tsubaki_section_developers',
    );    // Register a new field in the "tsubaki_section_developers" section, inside the "ed" page.


}


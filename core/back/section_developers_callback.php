<?php

/**
 * Developers section callback function.
 *
 * @param array $args The settings array, defining title, id, callback.
 */
function tsubaki_section_developers_callback( $args )
{
    ?>
    <p id="<?php echo esc_attr($args[ 'id' ]); ?>" >
        <?php echo __('you can use <b>[tsubaki_dashboard_shortcode]</b> anywhere you want, to get this dashboard tabs', 'ed'); ?>
    </p >
    <?php
}
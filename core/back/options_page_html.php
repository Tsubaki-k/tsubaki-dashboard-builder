<?php
/**
 * Top level menu callback function
 */
function tsubaki_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'tsubaki_messages', 'tsubaki_message', __( 'Settings have saved', 'ed' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'tsubaki_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <!--        <form action="http://localhost/tsubaki/wp-content/plugins/tsubaki-dashboard/core/getForm.php" method="post" class="tsubaki-dashboard">-->
        <form action="options.php" method="post" class="tsubaki-dashboard">
            <?php
            // output security fields for the registered setting "ed"
            settings_fields( 'ed' );
            // output setting sections and their fields
            // (sections are registered for "ed", each field is registered to a specific section)
            do_settings_sections( 'ed' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

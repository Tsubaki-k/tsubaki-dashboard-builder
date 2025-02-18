<?php
//
// The beating heart of Carousel
// This function Also called in mahsita_tabs_handler()
//
if ( ! function_exists( 'tsubaki_dashboard_shortcode_home_handler' ) ) {
    function tsubaki_dashboard_shortcode_home_handler( $atts ){


        // Attributes of Shortcode
        $value = shortcode_atts( array(), $atts );


        $options = get_option( 'tsubaki_options' );
        $sidebar_lists = array();
        $main_lists = array();

        foreach ($options as $key => $val) {

            $number = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            $sidebar_lists[$number]['id']     = 'tab' . $number;
            $main_lists[$number]['id']        = 'tabcontent' . $number;
            $sidebar_lists[$number]['number'] = $number;
            $main_lists[$number]['number']    = $number;

            if (strpos($key, 'name') > 1) {
                $sidebar_lists[$number]['name'] = $val;

            } elseif (strpos($key, 'link') > 0) {
                $sidebar_lists[$number]['link'] = $val;

            } elseif (strpos($key, 'shortcode') > 0) {
                $main_lists[$number]['shortcode'] = $val;
            }
        }

//        $userId = get_current_user_id();
//        $table_name = $wpdb->prefix . 'edd_orders';
//        $status = 'complete';
//        global $wpdb;
//        $prepared_statement = $wpdb->prepare( "SELECT * FROM $table_name WHERE user_id = 1 ", $userId );
//        $values = $wpdb->get_col( 'total' );


        global $wpdb;

        $table_name = $wpdb->prefix . 'edd_orders';

        $field_name = 'total';
        $user_id = get_current_user_id();

        $prepared_statement = $wpdb->prepare( "SELECT {$field_name} FROM {$table_name} WHERE  user_id = $user_id ");
        $values = $wpdb->get_col( $prepared_statement );

        $price = 0;
        foreach ( $values as $total ){
            $price = $price + round( $total, 0);
        }

        $total_price = number_format($price);
        $purchased_count = count($values);

        $userData = get_userdata( $user_id );
        $registered_date =  date("Y/m/d", strtotime($userData->user_registered));



        //start buffering *** With buffering, content will load the exact place that have to be there! ***
        ob_start();

        // Start HTML of Carousel
        echo '<div class="ed--dashboard">';

//        var_dump();
//        var_dump($values);

//        return;
//        foreach ( as $q){
        ?>





            <div class="ed-flex">
                <div class="tsubaki_home_card">
                    <p class="title">Purchased products</p>
                    <span class="number"><?php echo $purchased_count; ?></span>
                </div>
                <div class="tsubaki_home_card">
                    <p class="title">Payed amount</p>
                    <span class="number"><?php echo $total_price; ?></span>
                </div>
                <div class="tsubaki_home_card">
                    <p class="title">registered date</p>
                    <span class="number"><?php echo $registered_date; ?></span>
                </div>
            </div>

        <?php

        //end HTML
        echo  '</div>';

        //stop buffering
        $output = ob_get_clean();
        return $output;

    }
}






<?php

if (!function_exists('tsubaki_dashboard_shortcode_handler')) {
    function tsubaki_dashboard_shortcode_handler($atts)
    {
        // Redirect if the user is not logged in
        if (!is_user_logged_in()) {
            wp_redirect(wp_login_url(get_permalink()));
            exit;
        }

        // Get the current page URL
        $current_page_url = get_permalink();
        $current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';

        // Fetch stored options
        $options = get_option('tsubaki_options', []) ? get_option('tsubaki_options' , [])[1] : [];

        // Ensure options are an array
        if (!is_array($options) || empty($options)) {
            return '<p>No tabs available.</p>';
        }

        // Default to the first tab if no tab is selected or the selected tab is invalid
        $valid_tabs = array_column($options, 'link');
        if (!$current_tab || !in_array($current_tab, $valid_tabs, true)) {
            $current_tab = $options[array_key_first($options)]['link'];
        }

        // Start buffering
        ob_start();
        ?>

        <div class="dashboard-container ed-flex">
            <div class="dashboard-sidebar">
                <ul class="tabs">
                    <?php foreach ($options as $tab) :
                        $class = ($tab['link'] === $current_tab) ? 'active' : '';
                        if ( filter_var( $tab['link'], FILTER_VALIDATE_URL ) ) {
                            // $tab['link'] is a valid URL, so leave it as-is.
                            $tab_url = esc_url( $tab['link'] );
                        } else {
                            // $tab['link'] is assumed to be a slug, so add it as a query argument.
                            $tab_url = esc_url( add_query_arg( 'tab', esc_attr( $tab['link'] ), $current_page_url ) );
                        }
                        ?>
                        <li>
                            <a class="ds-link tab <?php echo esc_attr($class); ?>" href="<?php echo $tab_url; ?>">
                                <img src="<?php echo esc_url($tab['icon']); ?>" width="35px" height="35px" alt="<?php echo esc_attr($tab['label']); ?>">
                                <?php echo esc_html($tab['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="dashboard-main">
                <?php
                // Find the selected tab data
                $selected_tab = array_filter($options, fn($tab) => $tab['link'] === $current_tab);
                if (!empty($selected_tab)) :
                    $selected_tab = array_shift($selected_tab);

                    // Ensure 'page_id' exists in the tab data
                    $page_id = isset($selected_tab['page_id']) ? intval($selected_tab['page_id']) : 0;

                    // Fetch the page content
                    $page_post = ($page_id > 0) ? get_post($page_id) : null;
                    $page_content = ($page_post) ? apply_filters('the_content', $page_post->post_content) : '<p>Content not available.</p>';
                    ?>
                    <div class="ed-tab tabcontent active">
                        <?php echo $page_content; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }

    // Register the shortcode
    add_shortcode('tsubaki_dashboard_shortcode', 'tsubaki_dashboard_shortcode_handler');
}
?>

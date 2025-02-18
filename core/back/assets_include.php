<?php
function custom_admin_css()
{
    $url = TSUBAKI_DASHBOARD . '/assets/css/admin.css';
    echo '<link rel="stylesheet" id="tsubaki_dashboard_shortcodeddd" href="' . $url . '">';
}

function custom_admin_js()
{
    $url = TSUBAKI_DASHBOARD . '/assets/js/admin.js';
    echo '"<script type="text/javascript" src="' . $url . '"></script>"';
}

<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active('amp/amp.php') && is_single()) {
    global $wp;
    $mobile_match = '/Mobile|iP(hone|od|ad)|Android|BlackBerry|IEMobile|Kindle|NetFront|Silk-Accelerated|(hpw|web)OS|Fennec|Minimo|Opera M(obi|ini)|Blazer|Dolfin|Dolphin|Skyfire|Zune/';
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if(strpos($current_url, '/amp/') === false && preg_match($mobile_match, $_SERVER['HTTP_USER_AGENT'])) {
        header_remove();
        header('Location: ' . $current_url . '/amp/');
        exit;
    }
}

?>

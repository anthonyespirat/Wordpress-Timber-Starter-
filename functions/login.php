<?php
//login function
function redirect_page_login() {
    $login_page = home_url('/login');
    $serv_request = basename($_SERVER['REQUEST_URI']);

    if($serv_request == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
} 
add_action('init', 'redirect_page_login');


function logout_redirect () {
    wp_redirect(home_url());
    exit;
}
add_action('wp_logout', 'logout_redirect');

function login_fail() {
    $login_page = home_url('/login');
    wp_redirect($login_page . '?login=fail');
}
add_filter('wp_login_failed', 'login_fail');


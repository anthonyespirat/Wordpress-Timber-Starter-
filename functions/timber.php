<?php 

function get_log_usernamme () {
    $current_user = wp_get_current_user();
    return $current_user->user_login;
};



/**
 * My custom Twig functionality.
 *
 * @param \Twig\Environment $twig
 * @return \Twig\Environment
 */
function add_to_twig( $twig ) {
    $twig->addFunction( new Timber\Twig_Function( 'get_log_usernamme', 'get_log_usernamme' ) );
    
    return $twig;
};
    add_filter( 'timber/twig', 'add_to_twig' );
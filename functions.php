<?php 

require_once(__DIR__ . '/vendor/autoload.php');

$timber = new Timber\Timber();

require_once(__DIR__ . '/functions/timber.php');
require_once(__DIR__ . '/functions/login.php');
require_once(__DIR__ . '/functions/menu.php');


function add_stylesheets() {
    wp_enqueue_style( 'bulma', 'https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
}
function add_scripts() {
    wp_enqueue_script( 'my-js', get_template_directory_uri() . '/assets/js/main.js', false );
}
add_action( 'wp_enqueue_scripts', 'add_stylesheets' );
add_action( 'wp_enqueue_scripts', 'add_scripts' );

function set_scripts_type_attribute( $tag, $handle, $src ) {
    if ( 'my-js' === $handle ) {
        $tag = '<script type="module" src="'. $src .'"></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'set_scripts_type_attribute', 10, 3 );



function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');







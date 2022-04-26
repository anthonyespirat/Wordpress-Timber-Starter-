<?php
add_theme_support( 'menus' );
function add_menu_context( $context ) {
  // So here you are adding data to Timber's context object, i.e...
  $context['foo'] = 'I am some other typical value set in your functions.php file, unrelated to the menu';
  
  // Now, in similar fashion, you add a Timber Menu and send it along to the context.
  $context['menu'] = new \Timber\Menu( 'primary-menu' );
  
  return $context;
}
add_filter( 'timber/context', 'add_menu_context' );
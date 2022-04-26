<?php
/**
 * Template Name: Login Page
 * Description: Custom Login Page
 */

 $context = Timber::context();
 $context['args'] = array(
    'redirect' => home_url()
 );
if(is_user_logged_in()){
   wp_redirect(home_url());
   exit;
}
Timber::render('login.twig', $context);
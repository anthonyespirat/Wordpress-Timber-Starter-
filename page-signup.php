<?php
/**
 * Template Name: Signup Page
 * Description: Custom Signup Page
 */

$context = Timber::context();

if(is_user_logged_in()){
   wp_redirect(home_url());
   exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

   $user_id = null;
   $password = $_POST['user_pass'];

   $uppercase = preg_match('@[A-Z]@', $password);
   $lowercase = preg_match('@[a-z]@', $password);
   $number    = preg_match('@[0-9]@', $password);
   //$specialChars = preg_match('@[^\w]@', $password);
   
   if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      $user_id = new WP_Error('Password', 'Password should be at least 8 characters in length and should include at least one upper case letter, one number');  
   }

   $data = array(
      'user_login'           => esc_sql($_POST['user_login']), // the user's login username.
      'user_pass'            => esc_sql($password),
      'user_email'           => esc_sql($_POST['user_email']), 
      'show_admin_bar_front' => false // display the Admin Bar for the user 'true' or 'false'
   );

   if(!is_wp_error($user_id)) {
      try {
         $user_id = wp_insert_user( $data );

         $creds = array(
            'user_login'   => ($data['user_login']),
            'user_password'=> ($data['user_pass']),
            'remember'     => 'false'
         );
         $autologin_user = wp_signon( $creds, true );
         wp_set_current_user($autologin_user->ID);
         wp_redirect(home_url());

      } catch(WP_Error $error) {
         $user_id= $error;      }
   }


   $context['user_id'] = $user_id;
   Timber::render('signup.twig', $context);

} else {
   Timber::render('signup.twig', $context);
}


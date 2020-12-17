<?php

function add_script_to_menu_page($hook){
      //Enqueue jquery  if it's not
      if (!wp_script_is( 'jquery', 'enqueued' )) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery');
        wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array('jquery'), '3.5.1', false );
      }

    if($hook=='settings_page_l_loader_admin_page'){
      //Register top admin bar css and js
          wp_register_style( 'l-loader-admin-css', plugins_url( '../assets/css/main.css' , __FILE__ ), false, '1.0.0' );
          wp_enqueue_style( 'l-loader-admin-css');
          wp_enqueue_media();
          wp_register_script( 'l-loader-options-page-script', plugins_url( '../assets/js/l-loader-file-uploader.js' , __FILE__ ), array('jquery'), '1.0.0', true );
          wp_enqueue_script( 'l-loader-options-page-script' );
      }

      //Update loader ajax script
      wp_register_script( 'l-loader-ajax-script', plugins_url( '../assets/js/l-loader-ajax.js' , __FILE__ ), array('jquery'), '1.0.0', true );
      wp_enqueue_script( 'l-loader-ajax-script' );
      wp_localize_script('ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url('admin-ajax.php')));

}


add_action( 'admin_enqueue_scripts', 'add_script_to_menu_page' );

function admin_bar_enqueue_scripts(){
  //Update loader ajax script
  wp_enqueue_media();
  wp_register_script( 'l-loader-admin-bar-ajax', plugins_url( '../assets/js/l-loader-admin-bar-ajax.js' , __FILE__ ), array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'l-loader-admin-bar-ajax' );
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_enqueue_scripts');
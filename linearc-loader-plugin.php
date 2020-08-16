<?php
/**
 * Plugin Name: Linearc Loader
 * Plugin URI: http://www.linearc.biz/our-works/
 * Description: This creates a nice loader for our sites.
 * Version: 1.5.2
 * Author: Isakiye Afasha
 * Author URI: http://www.iamafasha.com
 */


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/inc/noprive-function.php';
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/inc/plugin-surport.php';
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/inc/admin-function.php';
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/inc/enqueue.php';
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/inc/ajax-request-handler.php';
require_once plugin_dir_path( __DIR__ ).'wp-linearc-loader/classes/Updater.php';

if ( is_admin() ) {
    new Updater( __FILE__, 'Linearc-Inc', "wp-linearc-loader" ,"0345013c4ec53e41c7523332c1c61ef2fc745a41" );
}


function update_adminbar($wp_adminbar) {
  
    // add SitePoint menu item
    $wp_adminbar->add_node([
      'id' => 'linearc_loader',
      'title'  => '<span class="ab icon"></span>'.'Site Loader',
      'href' => esc_url( admin_url( 'options-general.php?page=l_loader_admin_page' ) ),
      'meta' => false
    ]);

        // add Forum sub-menu item
        $wp_adminbar->add_node([
            'id' => 'linearc_loader_upload',
            'title' => 'Change Loader',
            'parent' => 'linearc_loader',
            'meta' => [
              'id'=>'change-l-loader-file-admin-bar'
            ]
            
        ]);
        
        $status =  esc_attr( get_option( 'l_loader_status' ) );
        $status =($status=="")?"1":$status;
        // add Forum sub-menu item
        $wp_adminbar->add_node([
          'id' => 'linearc_loader_deactivate',
          'title' => ($status=="1")?"Deactivate":"Activate",
          'parent' => 'linearc_loader',
          'data-l-status'=>($status=="1")?"1":"0",
          'meta' => [
            'class'=>($status=="1")?"1":"0",
            'data-l-status'=>($status=="1")?"1":"0",
            'data-test' => 'data-test content'
          ]
        ]);
  
  }
  
  // admin_bar_menu hook
  add_action('admin_bar_menu', 'update_adminbar', 999);

//add_action( $tag:string, $function_to_add:callable, 1, $accepted_args:integer )

//wp_get_plugin_file_editable_extensions( $plugin:string )
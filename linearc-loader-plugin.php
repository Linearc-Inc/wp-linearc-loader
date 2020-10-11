<?php
/**
 * Plugin Name: Site Loader
 * Plugin URI: https://www.linearc.biz/profile/
 * Description: This creates a nice loader for your wordpress site.
 * Version: 1.5.20
 * Author: Isakiye Afasha
 * Author URI: http://www.iamafasha.com
 * GitHub Plugin URI: https://github.com/Linearc-Inc/wp-linearc-loader
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function l_loader_plugin_dir_path(){
  return plugin_dir_path(__FILE__);
}
function l_loader_plugin_dir_url(){
  return plugin_dir_url( __FILE__ );
}

require_once plugin_dir_path( __FILE__ ).'/inc/noprive-function.php';
require_once plugin_dir_path( __FILE__ ).'/inc/plugin-surport.php';
require_once plugin_dir_path( __FILE__ ).'/inc/admin-function.php';
require_once plugin_dir_path( __FILE__ ).'/inc/enqueue.php';
require_once plugin_dir_path( __FILE__ ).'/inc/ajax-request-handler.php';
require_once plugin_dir_path( __FILE__ ).'/classes/Updater.php';

if ( is_admin() ) {
    new Linearc\Plugin\Loader\Updater( __FILE__, 'Linearc-Inc', "wp-linearc-loader" ,"0345013c4ec53e41c7523332c1c61ef2fc745a41" );
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


  function add_plugin_link( $plugin_actions, $plugin_file ) {
 
    $new_actions = array();
    if ( basename( plugin_dir_path( __FILE__ ) ) . '/linearc-loader-plugin.php' === $plugin_file ) {
      $new_actions['cl_settings'] = sprintf( __( '<a target="_blank" style="color:green" href="%s">Buy me a cup of coffee</a>', 'https://flutterwave.com/pay/rbyeiijtezwx' ), esc_url('https://flutterwave.com/pay/rbyeiijtezwx') );
    }
 
    return array_merge( $new_actions, $plugin_actions );
}
add_filter( 'plugin_action_links', 'add_plugin_link', 10, 2 );
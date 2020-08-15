<?php

//Color picker
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle',  plugins_url('linearc-loader/assets/js/my-color-picker-script.js', '' ), array( 'wp-color-picker' ), false, true );
}
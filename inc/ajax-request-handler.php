<?php
add_action( 'wp_ajax_change_loader_status_action', 'change_loader_status_action' );
function change_loader_status_action() {
    // A default response holder, which will have data for sending back to our js file
    $response = array(
    	'error' => false,
    );
    
    if (!(trim($_POST['new_status']) == '1' || trim($_POST['new_status']) == '0')) {
    	$response['error'] = true;
    	$response['error_message'] = 'Something is wrong';
    	exit(json_encode($response));
    }
    update_option( 'l_loader_status',trim($_POST['new_status']),true);
    exit();
}


add_action( 'wp_ajax_toggle_loader_status_action', 'toggle_loader_status_action' );
function toggle_loader_status_action() {
    $current_status=get_option( 'l_loader_status');
    if($current_status=='1'){
        update_option( 'l_loader_status','0',true);
    }else{
        update_option( 'l_loader_status','1',true);
    }
    exit(get_option( 'l_loader_status'));
}

add_action( 'wp_ajax_change_l_loader_file_action', 'change_l_loader_file_action' );
function change_l_loader_file_action() {
    exit(update_option( 'l_loader_file',trim($_POST['l_loader_file'])));
}
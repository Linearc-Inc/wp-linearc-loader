<?php



function sunset_add_admin_page() {
	
	//Generate Sunset Admin Sub Pages
	add_submenu_page( 'options-general.php', 'Site Loader Options', 'Site Loader', 'manage_options', 'l_loader_admin_page', 'l_loader_admin_page_callback' );
}
add_action( 'admin_menu', 'sunset_add_admin_page' );

function l_loader_admin_page_callback(){
    require_once( l_loader_plugin_dir_path().'inc/templates/loader-settings.php' );
}

//Activate custom settings
add_action( 'admin_init', 'sunset_custom_settings' );

function sunset_custom_settings() {
    register_setting( 'l-loader-group', 'l_loader_type' );
    register_setting( 'l-loader-group', 'l_loader_file' );
	register_setting( 'l-loader-group', 'l_loader_bg_color' );
    register_setting( 'l-loader-group', 'l_loader_status' );
    register_setting( 'l-loader-group', 'l_loader_custom_CSS' );
    register_setting( 'l-loader-group', 'l_loader_width' );
    register_setting( 'l-loader-group', 'l_loader_height' );

    add_settings_section( 'l-loader-options', 'Page Loader Option', 'l_page_loader_options', 'l_loader_admin_page');
    
    add_settings_field( 'l-loader-type', 'Loader Type', 'l_loader_type_call_back', 'l_loader_admin_page', 'l-loader-options');
    add_settings_field( 'l-loader-file', 'Loader File', 'l_loader_file_calllback', 'l_loader_admin_page', 'l-loader-options');
	add_settings_field( 'l-loader-size', 'Loader Size', 'l_loader_size_calllback', 'l_loader_admin_page', 'l-loader-options');
	add_settings_field( 'l-loader-bg_color', 'Background-color', 'l_loader_bg_color_calllback', 'l_loader_admin_page', 'l-loader-options');
	add_settings_field( 'l-loader-status', 'Loader Status', 'l_loader_status_calllback', 'l_loader_admin_page', 'l-loader-options');
	add_settings_field( 'l-loader-custom-css', 'Loader Status', 'l_loader_custom_CSS_calllback', 'l_loader_admin_page', 'l-loader-options');
}

function l_page_loader_options($X)
{   

    $loader_file = esc_attr( get_option( 'l_loader_file', l_loader_plugin_dir_url().'assets/images/default-loader.gif'));

    echo "<h3>Loader preview</h3>";
    $file_type= 'image';
    switch ($file_type) {
        case 'image':
            echo '<img src="'.$loader_file.'" width="100px" height="100px" id="l-loading-file-preview" style="display:block"  alt="" />';
            break;

        case 'video':
            echo '<video width="100px" src="'.$loader_file.'" controls>Your browser does not support the video tag.</video>';
            break;
        case 'markup':
            echo $loader_file;
            break;
        default:
            echo '';
            break;
    }

    echo "<hr/>";

}
function l_loader_type_call_back()
{
    $loader_type = esc_attr( get_option( 'l_loader_type' ), "image");
    echo "<select name='l_loader_type' id='l_loader_type' >
            <option ". ( ($loader_type == "html") ? 'selected' : '') ." value='html' > Icon/SVG OR Markup </option>
            <option ". ( ($loader_type == "image") ? 'selected' : '') ." value='image' > Image </option>
            <option ". ( ($loader_type == "video") ? 'selected' : '') ." value='video' > File </option>
         </select>";
}
function l_loader_status_calllback($X)
{  
    $loader_status = esc_attr( get_option( 'l_loader_status' ) );
    if($loader_status==0){
        echo '<button data-ajax-url="'.admin_url( 'admin-ajax.php').'" type="button" id="l-toggle-loader-status" class="button button-success" value="1" >Activate</button>';
        return;
    }
    echo '<button data-ajax-url="'.admin_url( 'admin-ajax.php').'" type="button" id="l-toggle-loader-status" class="button button-danger" value="0" >Deactivate</button>';
}
function l_loader_file_calllback($X)
{
    $loader_file = esc_attr( get_option( 'l_loader_file' ) , l_loader_plugin_dir_url().'assets/images/default-loader.gif' );
    $loader_type = esc_attr( get_option( 'l_loader_type' ), "file");
    if($loader_type == "image" || $loader_type == "video"){
     echo '<button
                type="button" 
                class="button icon-button button-secondary upload-loader-file-button" 
                value="Replace"
                id="upload-loader-file-button">
                    <span class="l-loader-icon dashicons-before dashicons-format-image"></span> Replace
                    </button>';
        echo '<input type="hidden" id="l_loader_file" name="l_loader_file" value="'.$loader_file.'" />';
        
        }else if($loader_type == "html"){
            echo '<input type="text" id="l_loader_file" name="l_loader_file" value="'.$loader_file.'" />';
        }

    echo '<button 
            type="button" 
            class="button icon-button button-secondary" 
            id="remove-custom-loader"
            data-default-loader="'.l_loader_plugin_dir_url().'assets/images/default-loader.gif">
                <span data-default-loader="'.l_loader_plugin_dir_url().'assets/images/default-loader.gif" 
                    class="l-loader-icon dashicons-before dashicons-no"></span> Reset to Default
            </button>';


}

function l_loader_size_calllback($x)
{
    $l_loader_width = esc_attr( get_option( 'l_loader_width'));
    $l_loader_height = esc_attr( get_option( 'l_loader_height'));

    echo '<input placeholder="width eg.300px" name="l_loader_width" value="'.$l_loader_width.'" id="l_loader_width" type="text" />';
    echo '<input placeholder="height eg.300px" name="l_loader_height" value="'.$l_loader_height.'"  id="l_loader_height" type="text" />';
}
function l_loader_bg_color_calllback($X)
{   
    $value = esc_attr( get_option( 'l_loader_bg_color' , "#fff" ));
    echo '<input class="my-color-field" type="text" value="'.$value.'" name="l_loader_bg_color" data-default-color="#fff" />';
}
function l_loader_custom_CSS_calllback()
{
    $value = esc_attr( get_option( 'l_loader_custom_CSS', '#preloader{
        /*Loader container CSS */
        }
        
        #preloader>.loader-wrap{
        /*Loader CSS*/
        }' ));

    echo '
    <textarea style="min-width:50%" rows="5" name="l_loader_custom_CSS" id="l_loader_custom_CSS" >'.$value.'</textarea>';
}



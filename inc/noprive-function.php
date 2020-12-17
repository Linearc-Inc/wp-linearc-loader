<?php

function l_loader_style_callback() {
    $loader_page_background =  esc_attr( get_option( 'l_loader_bg_color' ) );
    $loader_page_background=$loader_page_background==""?"#fff":$loader_page_background;
    $l_loader_width = esc_attr( get_option( 'l_loader_width','100px'));
    $l_loader_height = esc_attr( get_option( 'l_loader_height', '100px'));
    $l_loader_z_index = esc_attr( get_option( 'l_loader_z_index', 99));

    $custom_css = esc_attr( get_option( 'l_loader_custom_CSS', '#preloader{
        /*Loader container CSS */
        }
        
        #preloader>.loader-wrap{
        /*Loader CSS*/
        }' ));

    echo "<style>

    ".$custom_css."

    .loader {
        background-color:".$loader_page_background.";
        position: fixed;
        overflow:hidden;
        z-index:".$l_loader_z_index.";
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .loader-wrap{
     display:flex;
     justify-content:center;
     align-items:center;
     width:".$l_loader_width.";
     height:".$l_loader_height.";
    }
    .loader img {
        width: 100%;
        height:100%;
    }
    
    .loader.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }
    
    @keyframes fadeOut {
        0% { display:flex;  }
        99.999% {
            opacity: 0;
            visibility: hidden;
            display:flex;
         }
        100% {
            opacity: 0;
            visibility: hidden;
            display:none
        }

    }
        </style>";
}
function l_loader_html_callback(){
    $loader = esc_attr( get_option( 'l_loader_file', l_loader_plugin_dir_url().'assets/images/default-loader.gif' ) );
    $loader_type = esc_attr( get_option( 'l_loader_type' ), "image");

    echo '<div id="preloader" class="loader">
            <div class="loader-wrap">
            ';

    if($loader_type=="image"){
        echo '<img src="'.$loader.'" alt="Loading..." />';
    }else if ($loader_type=="video") {
        echo '<video src="'.$loader.'" autoplay" /></video>';
    }else if ($loader_type=="html"){
        $loader =get_option( 'l_loader_file');
        echo $loader;
    }
    echo '
            </div>
         </div>
        <script>
        window.addEventListener("load", function () {
            if (jQuery("#preloader").length) {
                jQuery("#preloader").delay(100).fadeOut("slow", function() {
                    jQuery(this).remove();
                });
                }
            });
    </script>
    ';
}
function start_of_website()
{
$status =  esc_attr( get_option( 'l_loader_status' ) );
 if($status=='0'){
     return;
 }
 add_action( 'wp_head', 'l_loader_style_callback' ,1 );
 add_action( 'wp_head', 'l_loader_html_callback' ,4 );
}
add_action( 'init', 'start_of_website' );


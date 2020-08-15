<?php

function l_loader_style_callback() {
    $loader_page_background =  esc_attr( get_option( 'l_loader_bg_color' ) );
    $loader_page_background=$loader_page_background==""?"#fff":$loader_page_background;
    echo "<style>
    .loader {
        background-color:".$loader_page_background.";
        position: fixed;
        z-index: 99;
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
    }
    .loader img {
        width: 100px;
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
    $loader = esc_attr( get_option( 'l_loader_file' ) );
    $loader=$loader==""?plugin_dir_url( 'linearc-loader/assets/images',__FILE__).'images/default-loader.gif':$loader;

    echo '
        <div class="loader">
            <script>
                window.addEventListener("load", function () {
                    const loader = document.querySelector(".loader");
                    loader.className += " hidden"; // class "loader hidden"
                });
            </script>
            <div class="loader-wrap">
                <img src="'.$loader.'" alt="Loading..." />
                <!-- <div class="text">Loading</div> -->
            </div>
        </div>
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


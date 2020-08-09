<?php
/**
 * Plugin Name: Linearc Loader
 * Plugin URI: http://www.linearc.biz.com/our-works/
 * Description: This creates a nice loader for our sites.
 * Version: 1.0
 * Author: Isakiye Afasha
 * Author URI: http://www.iamafasha.com
 */

function l_loader_style_callback() {
    echo "<style>
    .loader {
        position: fixed;
        z-index: 99;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
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
add_action( 'wp_head', 'l_loader_style_callback' ,1 );


function l_loader_html_callback(){
    echo '
        <div class="loader">
            <script>
                window.addEventListener("load", function () {
                    const loader = document.querySelector(".loader");
                    loader.className += " hidden"; // class "loader hidden"
                    console.log(loader);
                });
            </script>
            <div class="loader-wrap">
                <img src="'.plugin_dir_url( __FILE__ ) . 'images/default-loader.gif" alt="Loading..." />
                <!-- <div class="text">Loading</div> -->
            </div>
        </div>
    ';
}

add_action( 'wp_body_open', 'l_loader_html_callback' ,1 );

//add_action( $tag:string, $function_to_add:callable, 1, $accepted_args:integer )

//wp_get_plugin_file_editable_extensions( $plugin:string )
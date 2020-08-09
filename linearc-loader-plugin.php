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

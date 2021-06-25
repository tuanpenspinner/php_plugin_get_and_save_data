<?php
/**
 * Plugin Name: Get data api
 * Description: Simple button to get data from api
 * Author: PayME - Web Team
 * Version: 1.0.0
 * Text Domain: get-data-api
 * 
 */

if (!defined('ABSPATH')) {
    echo 'What are you trying to do?';
    exit;
}

define('GET_DATA_VERSION', '1.0.0');
define('GET_DATA_PLUGIN_URL', plugin_dir_url(__FILE__));
define('GET_DATA_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(GET_DATA_PLUGIN_DIR . 'includes/request.php');
require_once(GET_DATA_PLUGIN_DIR . 'includes/connectDb.php');

register_activation_hook( __FILE__, 'DBP_tb_create' );

class ProductListApi {
    public function __construct() {

        // create menu in dashboard
        add_action("admin_menu", array($this, "create_menu"));

        // add assets(js,css,etc)
        add_action("wp_enqueue_scripts", array($this, "load_assets"));
        
    }
   
    public function load_assets() {

        wp_enqueue_style(
            'get-data-api',
            GET_DATA_PLUGIN_DIR . '/css/get-data-api.css',
            array(),
           'GET_DATA_VERSION'
        );
    }

    public function create_menu() {
        add_menu_page("Get Data From API", "Get Data From API", 4, "get-data-from-api", array($this,"getDataFromAPI"));
    }

    public function getDataFromAPI() {
        ?> <button style="    
        border: none;
        background: #4f94d4;
        border-radius: 5px;
        padding: 10px 15px;
        margin-top: 30px;
        color: white;
        "
        id="get-api-button"
       
        >
        Hello</button> 

        <p class="hide"
        id="show-data-api"
        style="
        text-align: center;
        background-color: green;
        color: white;
        width: 100px;
        padding: 10px 40px;
        margin: auto;
        transition: .4s;
        font-size: 16px;
        "
        ></p>

        <style>
        .hide {
            display: none;
        }
        
        </style>
        <script type="text/javascript">
              
                jQuery(document).ready(function($){
                    $("#get-api-button").hover(function(){
                        $(this).css("background-color", "green");
                        $(this).css("cursor", "pointer");
                        }, function(){
                        $(this).css("background-color", "#4f94d4");
                    });
                    $('#get-api-button').click(function() {
                        $.ajax({
                            url: "/wp-content/plugins/GET-DATA-API/includes/request.php", 
                            type: "GET",
                            data:{action:'get_data'},
                            success: function(data) {
                                $('#show-data-api').html('Success!');
                                $('#show-data-api').removeClass('hide');

                                setTimeout(() => {
                                    $('#show-data-api').addClass('hide');

                                }, 3000);
                            
                            },
                            error: function() {
                                $('#show-data-api').html('Please try again!');
                            }
                        })           
                        
                    })
                   
                });
            </script>

       
        <?php
   
    }
}


new ProductListApi();

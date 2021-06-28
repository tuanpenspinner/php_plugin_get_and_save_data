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
        
    }

    public function create_menu() {
        add_menu_page("Get Data From API", "Get Data From API", 'administrator', "get-data-from-api", array($this,"front_end_dashboard"));
    }

    public function front_end_dashboard() {
        include_once("view/button_api_data.php");
    }

}


new ProductListApi();

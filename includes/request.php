<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Automattic\WooCommerce\Client;




class RequestAPI {
    // get JSON array
    public static function get_Json_data($json)
    {
        return json_decode($json, JSON_PRETTY_PRINT);
    }

   // call request
   public static function request($region = 'VN', $limit = '50') {
    $region = urldecode(trim($region));
    $limit = urldecode(trim($limit));
    $url= "https://openapi.etsy.com/v2/listings/active?api_key=ymwirwn29it7yeo77b6600na&taxonomy_id=66&region=$region&limit=$limit";

    $cURL = curl_init();
    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);
    curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($cURL);
 
    curl_close($cURL);

    if ($result) {
        return self::get_Json_data($result);
    } 
    return false;
   }
//    ymwirwn29it7yeo77b6600na
   public static function get_products_list($data_arr = [], $api_key) {
       if ($data_arr) {
         $return = [];
         foreach ($data_arr as $data) {

                $url= urldecode("https://openapi.etsy.com/v2/listings/active?api_key=$api_key&taxonomy_id=66&limit=$data->limit&location=$data->region");

                $cURL = curl_init();
                curl_setopt($cURL, CURLOPT_URL, $url );
                curl_setopt($cURL, CURLOPT_HTTPGET, true);
                curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ));
                curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($cURL);
                echo  $result;

                curl_close($cURL);
             
         }
         
         if ($result) {
        
            return self::get_Json_data($result);
         
        } 
        
       }

       return false;
   }
   public static function add_products($data_arr = [], $consumer_key,$consumer_secret) {
    $woocommerce = new Client(
        'http://localhost/tuannt', 
        $consumer_key, 
        $consumer_secret,
        [
            'wp_api' => true,
            'version' => 'wc/v3'
        ]
    );
    $data = [
        'create' => [
            [
                'name' => 'Test ssf',
                'type' => 'simple',
                'regular_price' => '21.99',
                'virtual' => true,
                'downloadable' => true,
                'downloads' => [
                    [
                        'name' => 'Woo Single',
                        'file' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
                    ]
                ],
                'categories' => [
                    [
                        'id' => 11
                    ],
                    [
                        'id' => 13
                    ]
                ],
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
                    ]
                ]
            ],
            [
                'name' => 'New Premium Quality',
                'type' => 'simple',
                'regular_price' => '21.99',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
                'categories' => [
                    [
                        'id' => 9
                    ],
                    [
                        'id' => 14
                    ]
                ],
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                    ],
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
                    ]
                ]
            ]
        ]
    ];
    
    print_r($woocommerce->post('products/batch', $data));
    return false;
    
   }


   public static function get_image_product($listing_id) {
    return "https://openapi.etsy.com/v2/listings/{$listing_id}/images?api_key=ymwirwn29it7yeo77b6600na";
   }
}

add_action('wp_ajax_get_data', 'get_data_ajax');

function get_data_ajax() {
    global $wpdb; // this is how you get access to the database
  
    $arr_data = new stdClass;
    $arr_data -> region = 'Vietnam';
    $arr_data -> limit = '50';

    $api_key = ($_POST['data'][0]['value']); // in json 
    $consumer_key = ($_POST['data'][1]['value']); // in json 
    $consumer_secret = ($_POST['data'][2]['value']); // in json 

    $dataFromApi = RequestAPI::get_products_list(array( $arr_data ), $api_key);
    // $dataAdd = RequestAPI::add_products(array( $dataFromApi  ),$consumer_key,$consumer_secret);

}



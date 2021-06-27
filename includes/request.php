<?php
include_once dirname(__FILE__) . '/../models/data.php';

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

                $url= urldecode("https://openapi.etsy.com/v2/listings/active?$api_key&taxonomy_id=66&limit=$data->limit&location=$data->region");

                $cURL = curl_init();
                curl_setopt($cURL, CURLOPT_URL, $url );
                curl_setopt($cURL, CURLOPT_HTTPGET, true);
                curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ));
                curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($cURL);
                curl_close($cURL);
             
         }
         if ($result) {
            return self::get_Json_data($result);
        } 
        
       }

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

    $api_key = $_GET["api_key"];
    $type_handle_data = $_GET["type"];

    $dataFromApi = RequestAPI::get_products_list(array( $arr_data ), $api_key);

    $data = new ProductData( $dataFromApi );

    if( $type_handle_data == 'new') {
        $data->insert_data();
    
    } else if ($type_handle_data == 'delete') {
        $data->insert_delete_data();
    }
    
   
    // $data->insert_data();

  }
   
// if ($_GET['action']  == 'get_data' ){
//     // echo '<pre>' .print_r(RequestAPI::get_products_list(['VN'], ['50'])).  '</pre>';die();

//     $dataFromApi = RequestAPI::get_products_list(['VN'], ['50']);

//     $data = new ProductData( $dataFromApi );
//     $data->insert_data();


//     // $listing_id = $dataFromApi['listing_id'];

//     // $sql = "INSERT INTO dbp_api_data(listing_id)VALUES('$listing_id')";
//     // if(!mysql_query($sql))
//     // {
//     //     die('Error : ' . mysql_error());
//     // }
// }


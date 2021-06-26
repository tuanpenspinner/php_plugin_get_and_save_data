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

   public static function get_products_list($region_arr = [], $limit_arr = []) {
       if ($region_arr || $limit_arr) {
         $return = [];
         foreach ($region_arr as $region) {
             foreach ( $limit_arr as $limit) {
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
             }
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
  
    $dataFromApi = RequestAPI::get_products_list(['VN'], ['50']);
  
    $data = new ProductData( $dataFromApi, $wpdb );

    $data->insert_data();
//   if($data->insert_data())  {
//     echo "Thành công";
//   } 
//   else {
//       echo "thất bại";
//   }

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


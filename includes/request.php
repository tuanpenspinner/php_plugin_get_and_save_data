<?php

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


if ($_GET['action']  == 'get_data' ){
    echo 'aaaa';
   echo '<pre>' .print_r(RequestAPI::get_products_list(['VN'], ['50'])).  '</pre>';die();
}


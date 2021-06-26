<?php

class ProductData {
    private $data;
    private $wpdb;
     // Constructor with DB
     public function __construct($data) {
        $this->data = $data;
        // $this->$wpdb = $wpdb;
        // echo '<pre>' .print_r(array($data['results'][0]['listing_id'])).  '</pre>';die();
        // echo '<pre>' .print_r($data).  '</pre>';die();
    }

      
      // Create Category
    public function insert_data() {
        // Create Query
    
        global $wpdb;
        $table_name = $wpdb->prefix . 'dbp_api_data';

        $listing_id =  $this->data['results'][0]['listing_id'];
             
        echo  $listing_id;

        $data = array('listing_id' => $listing_id );
        $format = array('%d');
        $result_check = $wpdb->insert($table_name,$data,$format);
        // $result_check = $wpdb->insert(
        //     $table_name, 
        //     array('listing_id' => 123465),
        //     array('%d') // use for string format
        // );

        // $result_check = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}dbp_api_data");


        if($result_check){
            // echo 'successfully inserted.';
            echo $result_check;
         }else{
            echo 'Error';
            // $wpdb->show_error();
         }
        // $wpdb->show_error();

    // Prepare Statement

    }

}
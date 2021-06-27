<?php

class ProductData {
    private $data;
    private $wpdb;
     // Constructor with DB
     public function __construct($data) {
        $this->data = $data;
    }

      
      // Create Category
    public function insert_data() {
        // Create Query
    
        global $wpdb;
        $table_name = $wpdb->prefix . 'dbp_api_data';

        // $listing_id =  $this->data['results'][0]['listing_id'];
        $format = array('%d');
        if ($this->data) {
            foreach ($this->data['results'] as $row) 
            {
                $data=array(
                    'listing_id'=> $row['listing_id'],
                );
        
                $result_check = $wpdb->insert($table_name,$data,$format);
    
                if($result_check){
                    echo 'successfully inserted.';
                 }else{
                    echo 'Error';
                    // $wpdb->show_error();
                 }
            }
        } else echo 'Error';

      
    }

    public function insert_delete_data() {
        // Create Query
    
        global $wpdb;
        $table_name = $wpdb->prefix . 'dbp_api_data';

        // $listing_id =  $this->data['results'][0]['listing_id'];
            
        // Delete data before insert

        $check_exist_data =  $wpdb->query( "SELECT * FROM $table_name" );


        if($check_exist_data != 0) {
            $delete_results = $wpdb->query( "DELETE FROM $table_name" );

            if( $delete_results ) {
                $format = array('%d');
                if ($this->data) {
                    foreach ($this->data['results'] as $row) 
                    {
                        $data=array(
                            'listing_id'=> $row['listing_id'],
                        );
                
                        $result_check = $wpdb->insert($table_name,$data,$format);
            
                        if($result_check){
                            echo 'successfully inserted.';
                         }else{
                            echo 'Error';
                            // $wpdb->show_error();
                         }
                    }
                } else {
                    echo 'Error';
                }
                
            }  
        } else {
            ProductData::insert_data();
        }
 

       
      
       
    }



}
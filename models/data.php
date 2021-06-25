<?php


class ProductData {
    private $data;
    private $table = 'dbp_api_data';


     // Constructor with DB
     public function __construct($data) {
        $this->data = $data;
        // echo '<pre>' .print_r(array($data['results'][0]['listing_id'])).  '</pre>';die();
        // echo '<pre>' .print_r($data).  '</pre>';die();
    }

      
      // Create Category
    public function create() {
        // Create Query
    $query = 'INSERT INTO ' . $this->table . ' 
    SET
    ' . array($this->data['results'][0]['listing_id']) . ' = :listing_id ';


    // Prepare Statement

    }

}
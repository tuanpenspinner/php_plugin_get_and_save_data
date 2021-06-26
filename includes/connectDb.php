<?php 

// function DBP_tb_create() {
//   global $wpdb;

//   $DBP_tb_name=$wpdb->prefix .'dbp_api_data';
//   $charset_collate = $wpdb->get_charset_collate();

  // $DBP_query="CREATE TABLE $DBP_tb_name (
  //   id int(10) NOT NULL AUTO_INCREMENT,
  //   listing_id char (20) DEFAULT '',
  //   states bit DEFAULT '1', /* 1 == true; 0 == false*/
  //   user_ids char (20) DEFAULT '',
  //   category_id char (20) DEFAULT '',
  //   title nvarchar (20) DEFAULT '',
  //   descriptions nvarchar (20) DEFAULT '',
  //   price money (20) DEFAULT '',
  //   currency_code char (20) DEFAULT '',
  //   quantity char (20) DEFAULT '',
  //   tags nvarchar (20) DEFAULT '',
  //   materials nvarchar (20) DEFAULT '',
  //   urls varchar (20) DEFAULT '',
  //   views char (20) DEFAULT '',
  //   num_favorers char (20) DEFAULT '',
  //   shipping_template_id char (20) DEFAULT '',
  //   processing_min char (20) DEFAULT '',
  //   processing_max char (20) DEFAULT '',
  //   who_made nvarchar (20) DEFAULT '',
  //   is_supply char (20) DEFAULT '',
  //   when_made char (20) DEFAULT '',
  //   item_weight char (20) DEFAULT '',
  //   item_weight_unit char (20) DEFAULT '',
  //   item_length char (20) DEFAULT '',
  //   item_width char (20) DEFAULT '',
  //   item_height char (20) DEFAULT '',
  //   item_dimensions_unit char (20) DEFAULT '',
  //   is_private bit DEFAULT 'false',
  //   taxonomy_id char (20) DEFAULT '',
  //   taxonomy_path char (20) DEFAULT '',
  // ) $charset_collate;
  // ";

// require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

//    dbDelta($DBP_query);
// }

function DBP_tb_create() {

  global $wpdb;

  $table_name = $wpdb->prefix . 'dbp_api_data';

  $charset_collate = $wpdb->get_charset_collate();
  

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
    listing_id(20) int,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}


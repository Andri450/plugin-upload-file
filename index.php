<?php

/*
Plugin Name: upload-download-file
Plugin URI: 
Description: Manage file sdn 1.
Author: Harapan Negeri
Author URI: https://sdn1sabahbalau.000webhostapp.com/
Version: 0.1
*/

if ( !defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, "activate_myplugin" );

register_uninstall_hook( __FILE__, "deactivate_myplugin" );

function activate_myplugin() {
	init_db_myplugin();
    init_db_myplugin2();
    init_db_myplugin3();
}

function deactivate_myplugin() {
    delete_db_myplugin();
    delete_db_myplugin2();
    delete_db_myplugin3();
}

function delete_db_myplugin() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'artikel_custom';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function delete_db_myplugin2() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reward_code';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function delete_db_myplugin3() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'parameter_reward';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function init_db_myplugin2() {

    // WP Globals
	global $table_prefix, $wpdb;

    // Customer Table
	$table_nam2 = $table_prefix . 'reward_code';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$table_nam2'" ) != $table_nam2 ) {

		// Query - Create Table
		$sql = "CREATE TABLE `$table_nam2` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `text_code` varchar(500) NOT NULL, ";
		$sql .= " `status_aktif` varchar(500) NOT NULL, ";
		$sql .= " `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,";
        $sql .= " `tgl_eksekusi` DATETIME,";
		$sql .= " PRIMARY KEY `id` (`id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	
		// Create Table
		dbDelta( $sql );
	}

}

function init_db_myplugin3() {

    // WP Globals
	global $table_prefix, $wpdb;

    // Customer Table
	$table_nam3 = $table_prefix . 'parameter_reward';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$table_nam3'" ) != $table_nam3 ) {

		// Query - Create Table
		$sql = "CREATE TABLE `$table_nam3` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `parameter_muncul` varchar(500) NOT NULL, ";
        $sql .= " `parameter_iklan` varchar(500) NOT NULL, ";
		$sql .= " `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,";
		$sql .= " PRIMARY KEY `id` (`id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	
		// Create Table
		dbDelta( $sql );

        $wpdb->insert($table_nam3, array(
            'parameter_muncul' => 3,
            'parameter_iklan' => 3,
        ));
	}

}

function init_db_myplugin() {

	// WP Globals
	global $table_prefix, $wpdb;

	// Customer Table
	$table_nam = $table_prefix . 'upload_file';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$table_nam'" ) != $table_nam ) {

		// Query - Create Table
		$sql = "CREATE TABLE `$table_nam` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `nama_file` varchar(500) NOT NULL, ";
		$sql .= " `lokasi` varchar(500) NOT NULL, ";
		$sql .= " `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,";
		$sql .= " PRIMARY KEY `id` (`id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	
		// Create Table
		dbDelta( $sql );
	}

}

?>
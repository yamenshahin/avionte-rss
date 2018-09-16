<?php

/**
 * Result content HTML layout.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 */
function result_content() {
	global $wpdb;
	$table_name = $wpdb->prefix . "avionte";
	
	return 'Hello World';
    
}

/**
 * Fetch result by ajax.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 */
add_action( 'wp_ajax_fetch_result', 'fetch_result' );
add_action( 'wp_ajax_nopriv_fetch_result', 'fetch_result' );
function fetch_result() {
    echo  result_content();
    /**
	 * This is required to terminate immediately and return a proper response.
	 *
	 * @since    1.0.0
	 */
    wp_die();
}

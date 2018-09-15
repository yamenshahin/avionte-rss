<?php

/**
 * Fetch rss manually or via cron job.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 */
function insert_rss_database() {
	global $wpdb;
    $table_name = $wpdb->prefix . "avionte";
    /**
     * Empty table for reuse.
     *
     * @since    1.0.0
     */
    $wpdb->query("TRUNCATE TABLE $table_name");   
	$myXMLData = simplexml_load_file(get_option('avionte_url_option'));

    $items = $myXMLData->channel->item;
    foreach( $items as $item ) {
        $item_id = $item->guid;
        $link = $item->link;
        $title = $item->title;
        $content = $item->description;

        $DOM = new DOMDocument();
        @$DOM->loadHTML( $item->description  );
        $rows = $DOM->getElementsByTagName("tr");

        for ($i = 0; $i < $rows->length; $i++) {
            $cols = $rows->item($i)->getElementsbyTagName("td");
            switch ($i) {
                case 0:
                    //Do nothing
                    break;
                case 1:
                    $location = $cols->item(1)->nodeValue;
                    break;
                case 2:
                    $summary = $cols->item(1)->nodeValue;
                    break;
                case 3:
                    //Do nothing
                    break;
                case 4:
                    $category = $cols->item(1)->nodeValue;
                    break;
                case 5:
                    #Do nothing
                    break;
                case 6:
                    $salary = $cols->item(1)->nodeValue;
                    break;
                case 7:
                    #Do nothing
                    break;
                case 8:
                    #Do nothing
                    break;
                case 9:
                    #Do nothing
                    break;
                case 10:
                    $keywords = $cols->item(1)->nodeValue;
                    break;
                default:
                    #Do nothing
            }
        }

        
         
        $wpdb->insert( 
            $table_name, 
            array( 
                'item_id' => $item_id, 	
                'link' => $link, 	
                'content' => $content, 	
                'title' => $title, 	
                'location' => $location,	
                'summary' => $summary,	
                'category' => $category,
                'salary_min' => 1,	
                'salary_max' => 2, 	
                'keywords' => $keywords
            ) 
        );
    }		
}

/**
 * Fetch rss by ajax.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 */
add_action( 'wp_ajax_fetch_rss', 'fetch_rss' );
function fetch_rss() {
    insert_rss_database();
    /**
	 * This is required to terminate immediately and return a proper response.
	 *
	 * @since    1.0.0
	 */
    wp_die();
}
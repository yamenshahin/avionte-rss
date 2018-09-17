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
function result_content($keywords, $salary, $category, $location) {
	global $wpdb;
	$table_name = $wpdb->prefix . "avionte";
	$results = $wpdb->get_results( "SELECT * FROM `wp_avionte`
	 WHERE `location` LIKE '%$location%' 
	 AND `category` LIKE '%$category%' 
	 AND `salary_min` <= $salary AND `salary_max` >= $salary 
	 AND `keywords` LIKE '%$keywords%' ", OBJECT );
	$content = '';
	if($results) {
		foreach($results as $result) {
			$content .= 

			'<li>
                <a href="?item_id='.$result->item_id.'">
                    <div class="position">
                        <p>'.$result->title.'</p>
                    </div>
                    <div class="location">
                        <p>'.$result->location.'</p>
                    </div>
                </a>
                <div class="application_link">
                    <a href="'.$result->link.'" target="_blank" class="avionte-button">Apply Now</a>
                </div>
            </li>';

		}
	}
	return $content;
    
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
    echo  result_content($_POST['keywords'], $_POST['salary'], $_POST['category'], $_POST['location']);
    /**
	 * This is required to terminate immediately and return a proper response.
	 *
	 * @since    1.0.0
	 */
    wp_die();
}

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
function result_content($keywords = NULL, $salary = NULL, $category = NULL, $location = NULL) {
	global $wpdb;
	$table_name = $wpdb->prefix . "avionte";

	if($salary) {
		$salary_query = "AND `salary_min` <= $salary AND `salary_max` >= $salary";
	} else {
		$salary_query = '';
	}

	$results = $wpdb->get_results( "SELECT * FROM $table_name
	 WHERE `location` LIKE '%$location%' 
	 AND `category` LIKE '%$category%' 
	 $salary_query	
	 AND `keywords` LIKE '%$keywords%' ", OBJECT );
	$content = '';
	if($results) {
		foreach($results as $result) {
			$applay_URL = parse_url($result->link, PHP_URL_SCHEME).':/'.parse_url($result->link, PHP_URL_HOST).'/talent/apply?postingId='.$results[0]->item_id;
			$button_html = '<button class="avionte-button" type="button" onclick="window.open(\''.$applay_URL.'\', \'_blank\')">Apply Now</button>';
			$content .= 

			'<li>
                <a class="position-info" href="/job-list/?item_id='.$result->item_id.'">
                    <div class="position">
                        <p class="position-title">'.$result->title.'</p>
                        <p class="position-summary">'.$result->summary.'</p>
                    </div>
                    <div class="location">
                        <p>'.$result->location.'</p>
                    </div>
                </a>
                <div class="application_link">
                    '.$button_html.'
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

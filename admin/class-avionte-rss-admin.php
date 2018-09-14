<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin
 * @author     Yamen Shahin <yamenshahin@gmail.com>
 */
class Avionte_Rss_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->create_db_table();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Avionte_Rss_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Avionte_Rss_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/avionte-rss-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Avionte_Rss_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Avionte_Rss_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/avionte-rss-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Include admin page.
	 *
	 * @since    1.0.0
	 */

	public function include_admin_page() {
		ob_start();
		include (plugin_dir_path( __FILE__ ) . 'partials/avionte-rss-admin-display.php');
		$content = ob_get_clean();
	}
	/**
	 * Add admin page
	 *
	 * @since    1.0.0
	 */
	public function add_admin_page() {
		add_menu_page( 
			'Avionte RSS Options', 
			'Avionte RSS', 
			'manage_options', 
			'avionte_rss_options', 
			function() {
				ob_start();
				include (plugin_dir_path( __FILE__ ) . 'partials/avionte-rss-admin-display.php');
				$content = ob_get_clean();
				echo $content;
			}, 
			'dashicons-tickets', 
			6 
		);
	}
	/**
	 * Create database table.
	 *
	 * @since    1.0.0
	 */
	public function create_db_table() {

		global $wpdb;

		$table_name = $wpdb->prefix . "avionte";
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			item_id text NOT NULL,
			link longtext NOT NULL,
			content longtext NOT NULL,
			title text,
			location text,
			summary text,
			category text,
			salary_min INT,
			salary_max INT,
			keywords text,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );


	}

}

function insert_rss_database() {
	static $is_called = false;
	if(!$is_called) {
		$is_called = true;
		$myXMLData = simplexml_load_file('https://abb.avionte.com/job-board.rss');

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

			global $wpdb;
			$table_name = $wpdb->prefix . "avionte";

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
	

	
}

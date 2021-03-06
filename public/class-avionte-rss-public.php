<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/public
 * @author     Yamen Shahin <yamenshahin@gmail.com>
 */
class Avionte_Rss_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'avionte_rss', array( $this, 'avionte_rss_shortcode' ) );
		add_filter( 'page_template', array( $this, 'avionte_page_template' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/avionte-rss-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'avionte_rss_theme', plugin_dir_url( __FILE__ ) . 'css/avionte-rss-public-theme.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/avionte-rss-public.js', array( 'jquery' ), $this->version, true );
		
		/**
		* Add ajax_url to front-end.
		*
		* @since    1.0.0
		*/
		wp_localize_script( $this->plugin_name, 'frontend_ajax_url', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

	/**
	* Add Shortcode avionte_rss.
	*
	* @since    1.0.0
	*/

	public function avionte_rss_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'url'  => 'https://abb.avionte.com/job-board.rss'
			),
			$atts
		);
		ob_start();
		include (plugin_dir_path( __FILE__ ) . 'partials/avionte-rss-public-display.php');
		$content = ob_get_clean();
		
		// run shortcode parser recursively
		$content = do_shortcode($content);
		return $content;
	
	}

	/**
	* Fill public form values from the database.
	*
	* @since    1.0.0
	*/
	public function get_from_value($col) {
		global $wpdb;
		$table_name = $wpdb->prefix . "avionte";
		
		/**
		 * Select one col from the database and removes duplicate values from the array.
		 *
		 * @since    1.0.0
		 */
		$form_values =  array_unique($wpdb->get_col( "SELECT $col FROM $table_name" ));
		return $form_values;
	}

	/**
	* Return the single page based on item_id.
	*
	* @since    1.0.0
	*/
	public function get_single_page($item_id) {
		global $wpdb;
		$table_name = $wpdb->prefix . "avionte";
		$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE `item_id` = '$item_id' ", OBJECT );
		return $results;
	}

	/**
	* Add page template avionte for displaying single page.
	*
	* @since    1.0.0
	*/
	public function avionte_page_template( $page_template )
	{
		if ( is_page( 'job-list' ) ) {
			$page_template = plugin_dir_path( __FILE__ ) . 'partials/page-avionte-template.php';
		}
		return $page_template;
	}
}

/**
 * Include Fetch result
 *
 * @since    1.0.0
 */
include (plugin_dir_path( __FILE__ ) . 'fetch-result.php');

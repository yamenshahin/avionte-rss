<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/yamenshahin/
 * @since             1.0.0
 * @package           Avionte_Rss
 *
 * @wordpress-plugin
 * Plugin Name:       Avionte RSS
 * Plugin URI:        https://github.com/yamenshahin/avionte-rss
 * Description:       Avionte RSS is a WordPress plugin that allow Avionte RSS to be stored and displayed via WordPress. Also allow the rss feed to be searchable via simple shortcode.
 * Version:           1.0.0
 * Author:            Yamen Shahin
 * Author URI:        https://github.com/yamenshahin/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       avionte-rss
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-avionte-rss-activator.php
 */
function activate_avionte_rss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-avionte-rss-activator.php';
	Avionte_Rss_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-avionte-rss-deactivator.php
 */
function deactivate_avionte_rss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-avionte-rss-deactivator.php';
	Avionte_Rss_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_avionte_rss' );
register_deactivation_hook( __FILE__, 'deactivate_avionte_rss' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-avionte-rss.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_avionte_rss() {

	$plugin = new Avionte_Rss();
	$plugin->run();

}
run_avionte_rss();

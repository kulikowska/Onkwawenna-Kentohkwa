<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           onkwawenna_kentohkwa
 *
 * @wordpress-plugin
 * Plugin Name:       Onkwawenna Kentohkwa 
 * Plugin URI:        http://example.com/onkwawenna_kentohkwa-uri/
 * Description:       Neato Mohawk Language Plugin 
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       onkwawenna_kentohkwa
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'onkwawenna_kentohkwa_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-onkwawenna_kentohkwa-activator.php
 */
function activate_onkwawenna_kentohkwa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-onkwawenna_kentohkwa-activator.php';
	onkwawenna_kentohkwa_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-onkwawenna_kentohkwa-deactivator.php
 */
function deactivate_onkwawenna_kentohkwa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-onkwawenna_kentohkwa-deactivator.php';
	onkwawenna_kentohkwa_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_onkwawenna_kentohkwa' );
register_deactivation_hook( __FILE__, 'deactivate_onkwawenna_kentohkwa' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-onkwawenna_kentohkwa.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_onkwawenna_kentohkwa() {

	$plugin = new onkwawenna_kentohkwa();
	$plugin->run();

}
run_onkwawenna_kentohkwa();

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeregion.com/
 * @since             1.0.0
 * @package           Themeregion_Companion
 *
 * @wordpress-plugin
 * Plugin Name:       ThemeRegion Companion
 * Plugin URI:        https://themeregion.com/extensions/themeregion-companion/
 * Description:       This plugin comes with all the core libraries of themeregion themes.
 * Version:           1.1.3
 * Author:            ThemeRegion
 * Author URI:        https://themeregion.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       themeregion-companion
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'THEMEREGION_COMPANION_VERSION', '1.1.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-themeregion-companion-activator.php
 */
function activate_themeregion_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-themeregion-companion-activator.php';
	Themeregion_Companion_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-themeregion-companion-deactivator.php
 */
function deactivate_themeregion_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-themeregion-companion-deactivator.php';
	Themeregion_Companion_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_themeregion_companion' );
register_deactivation_hook( __FILE__, 'deactivate_themeregion_companion' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-themeregion-companion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_themeregion_companion() {

	$plugin = new Themeregion_Companion();
	$plugin->run();

}
run_themeregion_companion();

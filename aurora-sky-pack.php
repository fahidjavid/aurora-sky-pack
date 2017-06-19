<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fahidjavid.com
 * @since             1.0.0
 * @package           Aurora_Sky_Pack
 *
 * @wordpress-plugin
 * Plugin Name:       Aurora Sky Pack
 * Plugin URI:        https://www.fahidjavid.com/plugin/aurora-sky-pack
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Fahid Javid
 * Author URI:        https://www.fahidjavid.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aurora-sky-pack
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aurora-sky-pack-activator.php
 */
function activate_aurora_sky_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aurora-sky-pack-activator.php';
	Aurora_Sky_Pack_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aurora-sky-pack-deactivator.php
 */
function deactivate_aurora_sky_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aurora-sky-pack-deactivator.php';
	Aurora_Sky_Pack_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aurora_sky_pack' );
register_deactivation_hook( __FILE__, 'deactivate_aurora_sky_pack' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aurora-sky-pack.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aurora_sky_pack() {

	$plugin = new Aurora_Sky_Pack();
	$plugin->run();

}
run_aurora_sky_pack();

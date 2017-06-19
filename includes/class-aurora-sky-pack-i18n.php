<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.fahidjavid.com
 * @since      1.0.0
 *
 * @package    Aurora_Sky_Pack
 * @subpackage Aurora_Sky_Pack/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Aurora_Sky_Pack
 * @subpackage Aurora_Sky_Pack/includes
 * @author     Fahid Javid <fahidjavid@gmail.com>
 */
class Aurora_Sky_Pack_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'aurora-sky-pack',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.fahidjavid.com
 * @since      1.0.0
 *
 * @package    Aurora_Sky_Pack
 * @subpackage Aurora_Sky_Pack/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Aurora_Sky_Pack
 * @subpackage Aurora_Sky_Pack/includes
 * @author     Fahid Javid <fahidjavid@gmail.com>
 */
class Aurora_Sky_Pack {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Aurora_Sky_Pack_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'aurora-sky-pack';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Aurora_Sky_Pack_Loader. Orchestrates the hooks of the plugin.
	 * - Aurora_Sky_Pack_i18n. Defines internationalization functionality.
	 * - Aurora_Sky_Pack_Admin. Defines all hooks for the admin area.
	 * - Aurora_Sky_Pack_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-aurora-sky-pack-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-aurora-sky-pack-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-aurora-sky-pack-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-aurora-sky-pack-public.php';

		$this->loader = new Aurora_Sky_Pack_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Aurora_Sky_Pack_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Aurora_Sky_Pack_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Aurora_Sky_Pack_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/**
		 * Meta Boxes Stuff
		 */
		// Deactivate Meta Box Plugin and related extensions if Installed
		add_action( 'init', function () {

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			// Meta Box Plugin
			if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
				deactivate_plugins( 'meta-box/meta-box.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box plugin has been deactivated!', 'aurora-sky-pack' ); ?></strong>
							<?php esc_html_e( 'Its functionality is embedded within the Inspiry Tours plugin.', 'aurora-sky-pack' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'aurora-sky-pack' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Columns Extension
			if ( is_plugin_active( 'meta-box-columns/meta-box-columns.php' ) ) {
				deactivate_plugins( 'meta-box-columns/meta-box-columns.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Columns plugin has been deactivated!', 'aurora-sky-pack' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Inspiry Tours plugin.', 'aurora-sky-pack' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'aurora-sky-pack' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Tabs Extension
			if ( is_plugin_active( 'meta-box-tabs/meta-box-tabs.php' ) ) {
				deactivate_plugins( 'meta-box-tabs/meta-box-tabs.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Tabs plugin has been deactivated!', 'aurora-sky-pack' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Inspiry Tours plugin.', 'aurora-sky-pack' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'aurora-sky-pack' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Show Hide Extension
			if ( is_plugin_active( 'meta-box-show-hide/meta-box-show-hide.php' ) ) {
				deactivate_plugins( 'meta-box-show-hide/meta-box-show-hide.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Show Hide plugin has been deactivated!', 'aurora-sky-pack' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Inspiry Tours plugin.', 'aurora-sky-pack' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'aurora-sky-pack' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Group Extension
			if ( is_plugin_active( 'meta-box-group/meta-box-group.php' ) ) {
				deactivate_plugins( 'meta-box-group/meta-box-group.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Group plugin has been deactivated!', 'aurora-sky-pack' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Inspiry Tours plugin.', 'aurora-sky-pack' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'aurora-sky-pack' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

		} );

		// Embedded meta box plugin
		if ( ! class_exists( 'RWMB_Core' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box/meta-box.php' );
		}

		/**
		 * Meta Box Plugin Extensions
		 */

		// Columns extension
		require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-columns/meta-box-columns.php' );

		// Show Hide extension
		require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php' );

		// Tabs extension
		require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-tabs/meta-box-tabs.php' );

		// Group extension
		require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-group/meta-box-group.php' );

		// Term Meta extension
		require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/mb-term-meta/mb-term-meta.php' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Aurora_Sky_Pack_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Aurora_Sky_Pack_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

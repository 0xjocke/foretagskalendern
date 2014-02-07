<?php
/**
 * Plugin Name.
 *
 * @package   Företagskalendern
 * @author    joachim.bachstatter@fortnox.com
 * @license   GPL-2.0+
 * @link      http://fortnox.com
 * @copyright 2014 Fortnox
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package   Företagskalendern
 * @author    joachim.bachstatter@fortnox.com
 */
class Foretagskalendern {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   0.1
	 *
	 * @var     string
	 */
	const VERSION = '0.1';

	/**
	 * @TODO - Rename "plugin-name" to the name your your plugin
	 *
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since   0.1
	 *
	 * @var     string
	 */
	protected $plugin_slug = 'foretagskalendern';

	/**
	 * Instance of this class.
	 *
	 * @since   0.1
	 *
	 * @var     string
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     0.1
	 */
	private function __construct() {

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );
		/* 
		 * Hook up shortcode.
		 */
		add_shortcode( 'add_foretagskalender', array($this,'getform'));
		/* 
		 * Add javascript (jQuery) and css to shortcode
		 */
		add_action( 'wp_enqueue_scripts', array($this, 'style_and_script')); 

	}
	/**
	 * Return the plugin slug.
	 *
	 * @since    0.1
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    0.1
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */

	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    0.1
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    0.1
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    0.1
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    0.1
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	 /**
	 * Add javascript (jQuery) and css.
	 *Also adds a object containing path to plugin directory
	 *
	 * @since    0.1
	 */

	public function style_and_script(){
          wp_enqueue_style( 'form.css', plugins_url() . "/foretagskalendern/public/views/form/css/form.css" );
          wp_enqueue_script( 'public.js', plugins_url() . "/foretagskalendern/public/js/build/public.js", array('jquery'));
          $plugindir = plugins_url();
          wp_localize_script('public.js', 'fk_plugin_url', array('directory' => __($plugindir))); 
     } 

     /**
	 * Get form and return it
	 *
	 * @since    0.1
	 *
	 *@return String 	Html with the form.
	 */

	public function getform(){
          $html = file_get_contents(plugins_url() . "/foretagskalendern/public/views/form/form.html");
          return $html;
     }
}

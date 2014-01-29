<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Företagskalendern
 * @author    joachim.bachstatter@fortnox.com
 * @license   GPL-2.0+
 * @link      http://fortnox.com
 * @copyright 2014 Fortnox
 *
 * @wordpress-plugin
 * Plugin Name:       Företagskalendern
 * Plugin URI:        @TODO
 * Description:       Håll koll på alla dina viktiga datum
 * Version:           0.1
 * Author:            Joachim Bachstätter
 * Author URI:        @TODO
 * Text Domain:       plugin-name-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/bachstatter/foretagskalendern
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-foretagskalendern.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Foretagskalendern', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Foretagskalendern', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'Foretagskalendern', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
	Vi behöver inte köra ajax i adminpanelen? //jocke
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-foretagskalendern-admin.php' );
	add_action( 'plugins_loaded', array( 'Foretagskalendern_Admin', 'get_instance' ) );

}

Uncomment admin page for testing
 */
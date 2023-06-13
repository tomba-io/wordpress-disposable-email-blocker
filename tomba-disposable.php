<?php

/**
 * @link              https://tomba.io/
 * @since             1.0.0
 * @package           Tomba_Disposable
 *
 * @wordpress-plugin
 * Plugin Name:       Disposable email blocker
 * Plugin URI:        https://wordpress.org/plugins/tomba-disposable
 * Description:       Identify and block disposable Email, temporary email addresses with our Free Email Address Online Verification API
 * Version:           1.0.0
 * Author:            Tomba Email Finder
 * Author URI:        https://tomba.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tomba-disposable
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TOMBA_DISPOSABLE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tomba-disposable-activator.php
 */
function activate_tomba_disposable()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-tomba-disposable-activator.php';
	Tomba_Disposable_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tomba-disposable-deactivator.php
 */
function deactivate_tomba_disposable()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-tomba-disposable-deactivator.php';
	Tomba_Disposable_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_tomba_disposable');
register_deactivation_hook(__FILE__, 'deactivate_tomba_disposable');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-tomba-disposable.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tomba_disposable()
{

	$plugin = new Tomba_Disposable();
	$plugin->run();
}
run_tomba_disposable();

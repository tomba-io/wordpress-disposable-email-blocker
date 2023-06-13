<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://tomba.io/
 * @since      1.0.0
 *
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/includes
 * @author     tomba.io <b.mohamed@tomba.io>
 */
class Tomba_Disposable_i18n
{


    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'tomba-disposable',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}

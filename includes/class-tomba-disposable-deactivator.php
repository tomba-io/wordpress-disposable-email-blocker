<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://tomba.io/
 * @since      1.0.0
 *
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/includes
 * @author     tomba.io <b.mohamed@tomba.io>
 */
class Tomba_Disposable_Deactivator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {

        delete_option('tomba_disposable');
    }
}

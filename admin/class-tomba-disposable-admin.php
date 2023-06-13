<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tomba.io/
 * @since      1.0.0
 *
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tomba_Disposable
 * @subpackage Tomba_Disposable/admin
 * @author     tomba.io <b.mohamed@tomba.io>
 */
class Tomba_Disposable_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        if (isset($_POST['reset_options'])) {
            activate_tomba_disposable();
        }
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tomba_Disposable_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tomba_Disposable_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/tomba-disposable-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tomba_Disposable_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tomba_Disposable_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/tomba-disposable-admin.js', array('jquery'), $this->version, true);
    }

    /**
     * Add a new menu item in the WordPress dashboard
     *
     * @since    1.0.0
     */
    public function register_settings_page()
    {

        add_submenu_page(
            'options-general.php',                             // parent slug
            __('Tomba Disposable', 'tomba-disposable'),      // page title
            __('Tomba Disposable', 'tomba-disposable'),      // menu title
            'manage_options',                        // capability
            'tomba-disposable',                           // menu_slug
            array($this, 'display_settings_page')  // callable function
        );
    }
    /**
     * Display the settings page content for the page we have created.
     *
     * @since    1.0.0
     */
    public function display_settings_page()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/tomba-disposable-admin-display.php';
    }

    public function disposable_message_input($args)
    {
        $field_id = $args['id'];
        $field_name = $args['name'];
        $field_value = $args['value'];
        ?>
        <input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id ?>" value="<?php echo esc_attr($field_value); ?>" class="regular-text" />

        <?php
    }
    public function webmail_message_input($args)
    {

        $field_id = $args['id'];
        $field_name = $args['name'];
        $field_value = $args['value'];
        ?>
        <input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id ?>" value="<?php echo esc_attr($field_value); ?>" class="regular-text" />

        <?php
    }

    public function webmail_block_checkbox($args)
    {
        $field_id = $args['id'];
        $field_name = $args['name'];
        $field_description = $args['description'];
        $checked = $args['checked'];
        ?>
    
        <label>
            <input type="checkbox" id="<?php echo $field_id ?>" name="<?php echo $field_name; ?>" value="on" <?php  echo (($checked === 'on') ? ' checked' : 'unchecked') ?> />
            <span class="description"><?php echo esc_html($field_description); ?></span>
        </label>

        <?php
    }

    /**
     * Registers settings fields with WordPress
     */
    public function register_fields()
    {
        // add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

        $options = get_option('tomba_disposable');
        $disposable_message = $options['disposable_message'];
        $webmail_message = $options['webmail_message'];
        $webmail_checkbox = isset($options['webmail_block']) ? $options['webmail_block'] : 'off';

        add_settings_field(
            'tomba_disposable_message',
            apply_filters($this->plugin_name . 'label-disposable', esc_html__('Disposable Error Message', 'disposable_message')),
            array($this, 'disposable_message_input'),
            $this->plugin_name,
            'tomba_disposable',
            array(
                'description'   => 'This message displays on the input if the email is Disposable.',
                'name'          => 'tomba_disposable[disposable_message]',
                'id'            => 'disposable_message',
                'value'             => $disposable_message,
            )
        );

        add_settings_field(
            'tomba_webmail_message',
            apply_filters($this->plugin_name . 'label-webmail', esc_html__('Webmail Error Message', 'webmail_message')),
            array($this, 'webmail_message_input'),
            $this->plugin_name,
            'tomba_disposable',
            array(
                'description'   => 'This message displays on the input if the email is Webmail.',
                'name'          => 'tomba_disposable[webmail_message]',
                'id'            => 'webmail_message',
                'value'             => $webmail_message,
            )
        );

        add_settings_field(
            'tomba_webmail_block',
            apply_filters($this->plugin_name . 'label-block', esc_html__('Webmail Block', 'webmail_block')),
            array($this, 'webmail_block_checkbox'),
            $this->plugin_name,
            'tomba_disposable',
            array(
                'description'   => 'This Detect and Block webmail emails.',
                'name'          => 'tomba_disposable[webmail_block]',
                'id'            => 'webmail_block',
                'checked'         => $webmail_checkbox,
            )
        );
    }
    /**
     * Registers settings sections with WordPress
     *
     * @since    1.0.0
     */
    public function register_sections()
    {

        // add_settings_section( $id, $title, $callback, $menu_slug );
        add_settings_section(
            'tomba_disposable',
            apply_filters($this->plugin_name . 'section-title-options', esc_html__('Configuration', 'configuration')),
            null,
            $this->plugin_name
        );
    }
    /**
     * Register the settings for our settings page.
     *
     * @since    1.0.0
     */
    public function register_settings()
    {

        register_setting(
            'tomba_disposable',
            'tomba_disposable',
        );
    }
    public function validate_options($input)
    {
    }
}

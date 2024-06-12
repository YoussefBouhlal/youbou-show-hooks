<?php
/**
 * Settings page functionalities.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks\Admin;

use YoubouShowHooks\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Install class
 */
class Settings_page {

    const SETTINGS_ID = 'youbou_show_hooks_settings';

    /**
     * Initialize class
     */
    public function init() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        add_action( 'admin_menu', array( $this, 'add_page' ) );
        add_action( 'init', array( $this, 'register_settings' ) );
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts_styles( $hook_suffix ) {
        if ( 'settings_page_youbou-show-hooks' === $hook_suffix ) {
            $assets = include Utils::plugin_path() . '/build/admin-settings.asset.php';

            wp_enqueue_style( 
                'youbou-show-hooks-settings',
                Utils::plugin_url() . '/build/admin-settings.css',
                array_filter(
                    $assets['dependencies'],
                    function ( $style ) {
                        return wp_style_is( $style, 'registered' );
                    }
                ),
                $assets['version'],
            );

            wp_enqueue_script(
                'youbou-show-hooks-settings',
                Utils::plugin_url() . '/build/admin-settings.js',
                $assets['dependencies'],
                $assets['version'],
                array(
                    'in_footer' => true,
                )
            );
        }
    }

    /**
     * Add page to admin menu
     */
    public function add_page() {
        add_options_page(
            __( 'Youbou Show Hooks', 'youboushowhooks' ),
            __( 'Youbou Show Hooks', 'youboushowhooks' ),
            'manage_options',
            'youbou-show-hooks',
            array( $this, 'render_page' )
        );
    }

    /**
     * Render settings page
     */
    public function render_page() {
        printf(
            '<div class="wrap" id="youbou-show-hooks">%s</div>',
            esc_html__( 'Loading…', 'youboushowhooks' )
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {

        $default = array(
            'pluginsStatus' => $this->plugins_status(),
            'message'       => __( 'This is the default text.', 'youbou-show-hooks' ),
        );
        $schema  = array(
            'type'       => 'object',
            'properties' => array(
                'pluginsStatus' => array(
                    'type' => 'array',
                ),
                'message' => array(
                    'type' => 'string',
                ),
            ),
        );

        register_setting(
            'options',
            self::SETTINGS_ID,
            array(
                'type'         => 'object',
                'default'      => $default,
                'show_in_rest' => array(
                    'schema' => $schema,
                ),
            )
        );
    }

    /**
     * Get all plugins
     */
    private function plugins_status() {
        $plugins = wp_get_active_and_valid_plugins();
        // $plugins = array_keys( $plugins );

        // error_log( print_r( $plugins, true ) );
    }
}

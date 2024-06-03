<?php
/**
 * Settings page functionalities.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Install class
 */
class Settings_page {

    /**
     * Initialize class
     */
    public function init() {

        add_action( 'admin_menu', array( $this, 'add_page' ) );
    }

    /**
     * Add page to admin menu
     */
    public function add_page() {

        add_submenu_page(
            'tools.php',
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

        echo 'Hello,';
        echo 'Use Gutenberg blocks Here!';

    }
}

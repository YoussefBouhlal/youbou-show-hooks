<?php
/**
 * Plugin Name: Youbou Show Hooks
 * Plugin URI: https://github.com/YoussefBouhlal/youbou-show-hooks.git
 * Description: Show all hooks that are being used on the current page.
 * Version: 1.0.0
 * Author: Youssef Bouhlal
 * Author URI: https://youssefbouhlal.com
 * Textdomain: youboushowhooks
 * Domain Path: /languages
 * Requires PHP: 7.4
 *
 * @package YoubouShowHooks
 */

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

define( 'YOUBOUSHOWHOOKS_PATH', plugin_dir_path( __FILE__ ) );
define( 'YOUBOUSHOWHOOKS_URL', plugin_dir_url( __FILE__ ) );
define( 'YOUBOUSHOWHOOKS_VERSION', '1.0.0' );

require_once 'includes/class-plugin.php';

/**
 * Get YoubouShowHooks Instance.
 *
 * @return \YoubouShowHooks\Plugin|null
 */
function youboushowhooks() {
	return \YoubouShowHooks\Plugin::get_instance();
}

youboushowhooks();
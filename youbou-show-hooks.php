<?php
/**
 * Plugin Name:       Youbou Show Hooks
 * Plugin URI:        https://github.com/YoussefBouhlal/youbou-show-hooks.git
 * Description:       Show all hooks that are being used on the current page.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Youssef Bouhlal
 * Author URI:        https://youssefbouhlal.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       youboushowhooks
 * Domain Path:       /languages
 *
 * @package YoubouShowHooks
 */

namespace YoubouShowHooks;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

const VERSION     = '1.0.0';
const PLUGIN_FILE = __FILE__;

require __DIR__ . '/vendor/autoload.php';

$main = new Main();
$main->init();
